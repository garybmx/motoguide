<?php

class Level extends Staff {

    private $language;
    private $levelTable;
    private $levelInfo = array(
        'level_id' => '',
        'name' => '',
        'description' => '',
    );
    protected $langId;
    protected $id;

    function __construct($language, $id = null) {
        $this->id = $id;
        $this->language = $language;
        $this->levelTable = "levels_" . $this->language;
        $this->langId = null;
    }

    public function setLangId($langId) {
        $this->langId = $langId;
    }

    public function setUpLevelInfo() {
        return parent::setUpInfo();
    }

    public function setUpAllLevelsInfo() {
        return $this->setUpAllInfo();
    }

    public function setUpListLevelsInfo() {
        return $this->setUpListInfo();
    }

    
    protected function setUpListInfo() {
        $returnArray = array();
        $Info = $this->getListInfo();
        foreach ($Info as $value) {
            foreach ($value as $name => $val) {

                $returnArray[$value->level_id] = $val;
            }
        }

        return $returnArray;
    }
    
    protected function setUpAllInfo() {
        $returnArray = array();
        $Info = $this->getAllInfo();
        foreach ($Info as $value) {
            foreach ($value as $name => $val) {

                $returnArray[$value->level_id][$name] = $val;
            }
        }

        return $returnArray;
    }

    public function insertLevelInfo($levelArray = array()) {
        return parent::insertInfo($this->levelInfo, $this->langId, $levelArray);
    }

    public function updateLevelInfo($levelArray = array()) {
        return parent::updateInfo($this->levelInfo, $levelArray);
    }

    public function deleteLevelInfo() {
        return parent::deleteInfo();
    }

    public function checkAndInsert() {
        $cnt = DB::table($this->levelTable)->where('level_id', $this->id)->count();
        if ($cnt == 0) {
            $this->setLangId($this->id);
            $this->insertLevelInfo($this->levelInfo);
        } else {
            $newLevel = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $this->id);
            $newLevel->setLangId($this->id);

            $newLevel->checkAndInsert();
        }
    }

    protected function getInfo($id) {
        return DB::table($this->levelTable)
                        ->where('level_id', $id)
                        ->get();
    }

    
    protected function getAllInfo() {
        return DB::table($this->levelTable)->get();
    }

    protected function getListInfo() {
        return DB::table($this->levelTable)->select('level_id', 'name')->get();
    }

    
    protected function insertAnotherLanguage($getId) {
        $newLevel = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language);
        $newLevel->setLangId($getId);

        $newLevel->checkAndDeleteId($newLevel->levelTable, $getId, 'level_id');

        return $newLevel->insertLevelInfo($this->levelInfo);
    }

    protected function deleteAnotherLanguage($id) {
        $newLevel = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $id);
        $newLevel->setLangId($id);
        return $newLevel->deleteLevelInfo();
    }

    protected function insertRecord($insertArray) {
        return DB::table($this->levelTable)->insertGetId(
                        array('level_id' => $this->langId,
                            'name' => $insertArray['name'],
                            'description' => $insertArray['description']
        ));
    }

    protected function updateRecord($insertArray) {
        $check = DB::table($this->levelTable)
                ->where('level_id', $this->id)
                ->update(array(        
            'name' => $insertArray['name'],
            'description' => $insertArray['description']
                )
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

    protected function deleteRecord($id) {
        $cnt = DB::table($this->levelTable)->where('level_id', $id)->count();
        if ($cnt == 0) {
            return true;
        }
        $check = DB::table($this->levelTable)->where('level_id', $id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

}
