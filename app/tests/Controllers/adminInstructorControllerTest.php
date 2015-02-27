<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

class adminInstructorControllerTest extends TestCase {

    protected $arrayRegex = array('"', '#', '<', '>');
    protected $arrayInt = array('"', 'a', 'Ф', '.', ',');


    public function __construct() {
        // We have no interest in testing Eloquent
    }


    public function setUp() {
        parent::setUp();
    }


    public function testInstructorsIndex() {
        $this->call('GET', 'admin/instructors');
        $this->assertResponseOk();
    }


    public function testInstructorsCreate() {

        $this->call('GET', 'admin/instructors/create');
        $this->assertResponseOk();
    }


    public function testInstructorsStore() {
        $input = array(
            'lang' => 'ru',
            'id' => null,
            'ru_active' => 0,
            'ru_name' => 'SX-250',
            'ru_lastname' => '232',
            'ru_age' => 11,
            'ru_expirience' => 'yaya'
        );

        $crawler = $this->client->request('GET', '/admin/instructors/create');

        $testValidationRegexRu = $this->validationFormRegex($input, 'ru');
        foreach ($testValidationRegexRu as $inputArray1) {
            $this->call('POST', '/admin/instructors', $inputArray1);
            $this->assertSessionHasErrors('ru_name');
            $this->assertSessionHasErrors('ru_lastname');
            $this->assertSessionHasErrors('ru_expirience');
        }

        $testValidationIntRu = $this->validationFormInt($input, 'ru');
        foreach ($testValidationIntRu as $inputArray3) {
            $this->call('POST', '/admin/instructors', $inputArray3);
            $this->assertSessionHasErrors('ru_age');
        }

        $this->call('POST', '/admin/instructors', $input);
        $this->assertRedirectedTo('admin/instructors');
        $crawler = $this->client->request('GET', '/admin/instructors');
        $found = $crawler->filter('body:contains("SX-250")');
        $this->assertGreaterThan(0, count($found));
    }


    public function testInstructorsEdit() {
        $this->call('GET', 'admin/instructors/1/edit');
        $this->assertResponseOk();
    }


    public function testInstructorsUpdate() {
        $input = array(
            'lang' => 'ru',
            'id' => 1,
            'ru_name' => 'SX-251',
            'ru_lastname' => '232',
            'ru_age' => 11,
            'ru_expirience' => 'yaya'
        );

        $inputEn = array(
            'lang' => 'en',
            'id' => 1,
            'en_name' => 'SX-251',
            'en_lastname' => '232',
            'en_age' => 11,
            'en_expirience' => 'yaya'
        );


        $crawler = $this->client->request('GET', '/admin/instructors/1/edit');
        $crawler = $this->client->request('PUT', '/admin/instructors/1', $input);
        $this->assertRedirectedTo('/admin/instructors/1/edit');

        $testValidationRegexRu = $this->validationFormRegex($input, 'ru');
        foreach ($testValidationRegexRu as $inputArray1) {
            $this->call('PUT', 'admin.instructors.update', $inputArray1);
            $this->assertSessionHasErrors('ru_name');
            $this->assertSessionHasErrors('ru_lastname');
            $this->assertSessionHasErrors('ru_expirience');
        }

        $testValidationRegexEn = $this->validationFormRegex($inputEn, 'en');
        foreach ($testValidationRegexEn as $inputArray2) {
            $this->call('PUT', 'admin.instructors.update', $inputArray2);
            $this->assertSessionHasErrors('en_name');
            $this->assertSessionHasErrors('en_lastname');
            $this->assertSessionHasErrors('en_expirience');
        }


        $testValidationIntRu = $this->validationFormInt($input, 'ru');
        foreach ($testValidationIntRu as $inputArray3) {
            $this->call('PUT', 'admin.instructors.update', $inputArray3);
            $this->assertSessionHasErrors('ru_age');
        }

        $testValidationIntEn = $this->validationFormInt($inputEn, 'en');
        foreach ($testValidationIntEn as $inputArray4) {
            $this->call('PUT', 'admin.instructors.update', $inputArray4);
            $this->assertSessionHasErrors('en_age');
        }


        $crawler = $this->client->request('GET', '/admin/instructors');
        $found = $crawler->filter('body:contains("SX-251")');
        $this->assertGreaterThan(0, count($found));
    }


    public function testInstructorsShow() {
        $crawler = $this->client->request('GET', '/admin/instructors/1');
        $found = $crawler->filter('body:contains("SX-251")');
        $this->assertGreaterThan(0, count($found));
    }


    public function testInstructorsDelete() {
        $crawler = $this->client->request('GET', '/admin/instructors');
        $this->call('DELETE', '/admin/instructors/1');
        $crawler = $this->client->request('GET', '/admin/instructors/1');
        $found = $crawler->filter('body:contains("SX-251")');
        $this->assertEquals(0, count($found));
    }


    public function tearDown() {
        Mockery::close();
    }


    private function validationFormRegex($inputArray, $lang) {

        $returnArray = array();
        $i = 0;
        foreach ($this->arrayRegex as $name => $value) {
            $returnArray[$i] = $inputArray;
            $returnArray[$i][$lang . '_name'] = $value;
            $returnArray[$i][$lang . '_lastname'] = $value;
            $returnArray[$i][$lang . '_expirience'] = $value;
            $i++;
        }

        return $returnArray;
    }


    private function validationFormInt($inputArray, $lang) {

        $returnArray = array();
        $i = 0;
        foreach ($this->arrayInt as $name => $value) {
            $returnArray[$i] = $inputArray;
            $returnArray[$i][$lang . '_age'] = $value;
            $i++;
        }

        return $returnArray;
    }

}
