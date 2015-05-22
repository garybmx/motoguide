<?php

class Contact {

    private $language;
    private $contactTable;
    private $contactInfo = array(
        'contact_id' => 1,
        'address' => '',
        'phone' => '',
        'mail' => ''
    );
    protected $langId;
    protected $id;


    function __construct($language) {
        $this->id = 1;
        $this->language = $language;
        $this->contactTable = "contacts_" . $this->language;
        $this->langId = null;
        $this->createContact();
    }


    public function setLangId($langId) {
        $this->langId = $langId;
    }


    public function editContact($insertArray) {
        
        $arrayCheck = $this->arrayCheck($insertArray, $this->contactInfo);
        if (empty($insertArray) || $arrayCheck === false) {
            return false;
        }


        $check = DB::table($this->contactTable)
                ->where('contact_id', $this->id)
                ->update(array(
            'address' => $insertArray['address'],
            'phone' => $insertArray['phone'],
            'mail' => $insertArray['mail']
                )
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function createContact() {

        $cnt = DB::table($this->contactTable)->where('contact_id', $this->id)->count();
        if ($cnt == 0) {
            $this->setLangId($this->id);
            $this->insertContact();
            if ($this->langId == null) {
                $newContact = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language);
                $newContact->setLangId($this->id);
                $newContact->createContact();
            }
        }
    }


    public function getContact() {
        $returnArray = array();
        $cnt = DB::table($this->contactTable)->where('contact_id', $this->id)->count();
        if ($cnt == 0) {
            $this->createContact();
        }
        $object = DB::table($this->contactTable)
                ->where('contact_id', $this->id)
                ->get();

        foreach ($object as $value) {
            foreach ($value as $name => $val) {
                $returnArray[$name] = $val;
            }
        }

        return $returnArray;
    }


    public function insertContact() {
        return DB::table($this->contactTable)->insert(
                        array('contact_id' => $this->id,
                            'address' => '',
                            'mail' => '',
                            'phone' => ''
        ));
    }


    protected function arrayCheck($checkArray, $defaultArray) {

        $returnArray = array_diff_key($checkArray, $defaultArray);

        if (empty($returnArray)) {
            return true;
        } else {
            return false;
        }
    }

}
