<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Blog
 *
 * @author Manager
 */
class Blog extends Staff {

    private $language;
    private $blogTable;
    private $blogInfo = array(
        'id' => '',
        'active' => '',
        'header' => '',
        'text' => '',
        'tags' => '',
        'date' => '',
    );
    protected $langId;
    protected $id;
    protected $paginate;


    function __construct($language, $id = null) {
        $this->id = $id;
        $this->paginate = 2;
        $this->language = $language;
        $this->blogTable = "blog_" . $this->language;
        $this->langId = null;
    }


    public function setLangId($langId) {
        $this->langId = $langId;
    }


    public function setUpBlogInfo($isactive = NULL) {
        return parent::setUpInfo($isactive);
    }


    public function setUpAllBlogInfo($isactive = NULL, $paginate = null) {
        return parent::setUpAllInfo($isactive);
    }


    public function insertBlogInfo($blogArray = array()) {
        return parent::insertInfo($this->blogInfo, $this->langId, $blogArray);
    }


    public function updateBlogInfo($blogArray = array()) {
        return parent::updateInfo($this->blogInfo, $blogArray);
    }


    public function deleteBlogInfo() {
        return parent::deleteInfo();
    }


    public function checkAndInsert() {
        $cnt = DB::table($this->blogTable)->where('id', $this->id)->count();
        if ($cnt == 0) {
            $this->setLangId($this->id);
            $this->insertBlogInfo($this->blogInfo);
        } else {
            $newBlog = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $this->id);
            $newBlog->setLangId($this->id);
            $newBlog->checkAndInsert();
        }
    }


    public function getPaginateBlog() {
        $paginateArray['items'] = parent::setUpAllInfo('ActiveOnly', $this->paginate);
        $paginateArray['links'] = $this->getAllInfo('ActiveOnly', $this->paginate)->links("layouts.paginator");
        return $paginateArray;
    }


    protected function getInfo($id, $isactive = NULL) {
        $returnArray = array();
        if ($isactive != NULL) {
            $returnArray = DB::table($this->blogTable)
                    ->where('id', $id)
                    ->where('active', 1)
                    ->get();
        } else {
            $returnArray = DB::table($this->blogTable)
                    ->where('id', $id)
                    ->get();
        }
        if (empty($returnArray)) {
            App::abort(404);
        }

        return $returnArray;
    }


    protected function getAllInfo($isactive = NULL, $paginate = null) {

        if ($paginate != null) {
            return DB::table($this->blogTable)
                            ->where('active', 1)->orderBy('id', 'desc')->paginate($paginate);
        }

        if ($isactive != null) {
            return DB::table($this->blogTable)
                            ->where('active', 1)->get();
        }


        return DB::table($this->blogTable)->get();
    }


    public function fo() {
        return DB::table($this->blogTable)
                        ->where('active', 1)->simplePaginate(2);
    }


    protected function insertAnotherLanguage($getId) {
        $newBlog = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language);
        $newBlog->setLangId($getId);
        $newBlog->checkAndDeleteId($newBlog->blogTable, $getId, 'id');
        return $newBlog->insertBlogInfo($this->blogInfo);
    }


    protected function deleteAnotherLanguage($id) {
        $newBlog = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $id);
        $newBlog->setLangId($id);
        return $newBlog->deleteBlogInfo();
    }


    protected function insertRecord($insertArray) {
        return DB::table($this->blogTable)->insertGetId(
                        array('id' => $this->langId,
                            'active' => $insertArray['active'],
                            'header' => $insertArray['header'],
                            'text' => $insertArray['text'],
                            'date' => $insertArray['date'],
                            'tags' => $insertArray['tags']
        ));
    }


    protected function updateRecord($insertArray) {
        $check = DB::table($this->blogTable)
                ->where('id', $this->id)
                ->update(array(
            'header' => $insertArray['header'],
            'text' => $insertArray['text'],
            'tags' => $insertArray['tags'],
            'active' => $insertArray['active'],
            'date' => $insertArray['date']
                )
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function deleteRecord($id) {
        $cnt = DB::table($this->blogTable)->where('id', $id)->count();
        if ($cnt == 0) {
            return true;
        }
        $check = DB::table($this->blogTable)->where('id', $id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

}
