<?php

class Information {

    private $language;
    private $informationTable;
    private $informationInfo = array(
    );
    protected $id;


    function __construct($language) {

        $this->language = $language;
        $this->informationTable = "information_" . $this->language;
    }


    public function editInformationOne($insertArray) {


        $check = DB::table($this->informationTable)
                ->where('name', $insertArray['type'] . '_' . $insertArray['number'])
                ->update(array(
            'value' => $insertArray['text']
                )
        );



        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function editInformationTwo($insertArray) {


        $check = DB::table($this->informationTable)
                ->where('name', $insertArray['type'] . '_head_' . $insertArray['number'])
                ->update(array(
            'value' => $insertArray['head']
                )
        );

        $check2 = DB::table($this->informationTable)
                ->where('name', $insertArray['type'] . '_text_' . $insertArray['number'])
                ->update(array(
            'value' => $insertArray['text']
                )
        );

        if ($check > 0 || $check2 > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function getInformation() {
        $returnArray = array();

        $object = DB::table($this->informationTable)
                ->get();

        foreach ($object as $value) {
            $returnArray[$value->name] = $value->value;
        }

        return $returnArray;
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
