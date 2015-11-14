<?php
class userSeeder extends Seeder
{
  public function run()
  {
    DB::table('users')->delete();
    
    User::create(array(
    	'username' => 'alex',
        'password' => Hash::make('bornborn'),
    ));
  }
}