<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

class adminMotorcycleControllerTest extends TestCase {

    protected $arrayRegex = array('"', '#', '<', '>');
    protected $arrayInt = array('"', 'a', 'Ф', '.', ',');


    public function __construct() {
        // We have no interest in testing Eloquent
    }


    public function setUp() {
        parent::setUp();
    }


    public function testMotorcyclesIndex() {
        $this->call('GET', 'admin/motorcycles');
        $this->assertResponseOk();
    }


    public function testMotorcyclesCreate() {

        $this->call('GET', 'admin/motorcycles/create');
        $this->assertResponseOk();
    }


    public function testMotorcyclesStore() {
        $input = array(
            'lang' => 'ru',
            'id' => null,
            'ru_active' => 0,
            'ru_model' => 'SX-250',
            'ru_power' => '232',
            'ru_weight' => 11,
            'ru_description' => 'yaya'
        );

        $crawler = $this->client->request('GET', '/admin/motorcycles/create');

        $testValidationRegexRu = $this->validationFormRegex($input, 'ru');
        foreach ($testValidationRegexRu as $inputArray1) {
            $this->call('POST', '/admin/motorcycles', $inputArray1);
            $this->assertSessionHasErrors('ru_model');
            $this->assertSessionHasErrors('ru_power');
            $this->assertSessionHasErrors('ru_description');
        }

        $testValidationIntRu = $this->validationFormInt($input, 'ru');
        foreach ($testValidationIntRu as $inputArray3) {
            $this->call('POST', '/admin/motorcycles', $inputArray3);
            $this->assertSessionHasErrors('ru_weight');
        }

        $this->call('POST', '/admin/motorcycles', $input);
        $this->assertRedirectedTo('admin/motorcycles');
        $crawler = $this->client->request('GET', '/admin/motorcycles');
        $found = $crawler->filter('body:contains("SX-250")');
        $this->assertGreaterThan(0, count($found));
    }


    public function testMotorcyclesEdit() {
        $this->call('GET', 'admin/motorcycles/1/edit');
        $this->assertResponseOk();
    }


    public function testMotorcyclesUpdate() {
        $input = array(
            'lang' => 'ru',
            'id' => 1,
            'ru_model' => 'SX-251',
            'ru_power' => '232',
            'ru_weight' => 11,
            'ru_description' => 'yaya'
        );

        $inputEn = array(
            'lang' => 'en',
            'id' => 1,
            'en_model' => 'SX-251',
            'en_power' => '232',
            'en_weight' => 11,
            'en_description' => 'yaya'
        );


        $crawler = $this->client->request('GET', '/admin/motorcycles/1/edit');
        $crawler = $this->client->request('PUT', '/admin/motorcycles/1', $input);
        $this->assertRedirectedTo('/admin/motorcycles/1/edit');

        $testValidationRegexRu = $this->validationFormRegex($input, 'ru');
        foreach ($testValidationRegexRu as $inputArray1) {
            $this->call('PUT', 'admin.motorcycles.update', $inputArray1);
            $this->assertSessionHasErrors('ru_model');
            $this->assertSessionHasErrors('ru_power');
            $this->assertSessionHasErrors('ru_description');
        }

        $testValidationRegexEn = $this->validationFormRegex($inputEn, 'en');
        foreach ($testValidationRegexEn as $inputArray2) {
            $this->call('PUT', 'admin.motorcycles.update', $inputArray2);
            $this->assertSessionHasErrors('en_model');
            $this->assertSessionHasErrors('en_power');
            $this->assertSessionHasErrors('en_description');
        }


        $testValidationIntRu = $this->validationFormInt($input, 'ru');
        foreach ($testValidationIntRu as $inputArray3) {
            $this->call('PUT', 'admin.motorcycles.update', $inputArray3);
            $this->assertSessionHasErrors('ru_weight');
        }

        $testValidationIntEn = $this->validationFormInt($inputEn, 'en');
        foreach ($testValidationIntEn as $inputArray4) {
            $this->call('PUT', 'admin.motorcycles.update', $inputArray4);
            $this->assertSessionHasErrors('en_weight');
        }


        $crawler = $this->client->request('GET', '/admin/motorcycles');
        $found = $crawler->filter('body:contains("SX-251")');
        $this->assertGreaterThan(0, count($found));
    }


    public function testMotorcyclesShow() {
        $crawler = $this->client->request('GET', '/admin/motorcycles/1');
        $found = $crawler->filter('body:contains("SX-251")');
        $this->assertGreaterThan(0, count($found));
    }

    
     public function testMotorcyclesDelete() {
        $crawler = $this->client->request('GET', '/admin/motorcycles');
        $this->call('DELETE', '/admin/motorcycles/1');
        $crawler = $this->client->request('GET', '/admin/motorcycles/1');
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
            $returnArray[$i][$lang . '_model'] = $value;
            $returnArray[$i][$lang . '_power'] = $value;
            $returnArray[$i][$lang . '_description'] = $value;
            $i++;
        }

        return $returnArray;
    }


    private function validationFormInt($inputArray, $lang) {

        $returnArray = array();
        $i = 0;
        foreach ($this->arrayInt as $name => $value) {
            $returnArray[$i] = $inputArray;
            $returnArray[$i][$lang . '_weight'] = $value;
            $i++;
        }

        return $returnArray;
    }

}
