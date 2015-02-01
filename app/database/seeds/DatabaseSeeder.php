<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      
        
   
        DB::table('tours_en')->insert(array(
            array('tourType_id' => '1', 'name' => 'testTour', 'startTime' => '2014-10-12', 'endTime' => '2014-10-14', 'description' => 'cool Tour')
        ));
        
        DB::table('tours_en')->insert(array(
            array('tourType_id' => '1', 'name' => 'testTour2', 'startTime' => '2014-10-14', 'endTime' => '2014-10-15', 'description' => 'cool Tour 2')
        ));
        
         DB::table('tours_en')->insert(array(
            array('tourType_id' => '2', 'name' => 'pasttestTour1', 'startTime' => '2014-1-14', 'endTime' => '2014-11-15', 'description' => 'cool past Tour 1')
        ));
        
         DB::table('tours_en')->insert(array(
            array('tourType_id' => '2', 'name' => 'pasttestTour2', 'startTime' => '2014-1-18', 'endTime' => '2014-11-21', 'description' => 'cool past Tour 2')
        ));
         
         
         
        DB::table('condition_en')->insert(array(
            array('tour_id' => '1', 'duration' => '2', 'level_id' => '2', 'location' => 'bulgaria')
        ));
        
        DB::table('prices_en')->insert(array(
            array('tour_id' => '1', 'name' => 'moto', 'price' => '200 eu')
        ));
        
        
        DB::table('prices_en')->insert(array(
            array('tour_id' => '1', 'name' => 'feed', 'price' => '100 eu')
        ));
        
         DB::table('levels_en')->insert(array(
            array('level_id' => '1', 'description' => 'light')
        ));
         
         
         DB::table('levels_en')->insert(array(
            array('level_id' => '2', 'description' => 'hard')
        ));
        
          DB::table('conditionfuture_en')->insert(array(
            array('tour_id' => '1', 'residence' => 'hotel', 'feed'=>'2 times a day'),
            array('tour_id' => '2', 'residence' => 'hotel', 'feed'=>'3 times a day')
              
          
        )); 
          
           DB::table('conditionpast_en')->insert(array(
            array('tour_id' => '3', 'review' => 'excellent'),
            array('tour_id' => '4', 'review' => 'very cool tour')
              
          
        )); 
         
         DB::table('clients_en')->insert(array(
            array('name' => 'Gary', 'review' => 'awesome!'),
            array('name' => 'Tania', 'review' => 'Unbeliveble!')
        
        )); 
           
           
        DB::table('tours_ru')->insert(array(
            array('tourType_id' => '1', 'name' => 'testTour', 'startTime' => '2014-10-12', 'endTime' => '2014-10-14', 'description' => 'cool Tour')
        ));
        
        
    }

    //Eloquent::unguard();
    //  $this->call('UserTableSeeder');
}
