<?php

namespace P3\Http\Controllers;

use Illuminate\Http\Request;
use P3\Http\Requests;
use P3\Http\Controllers\Controller;
use Faker\Factory as Faker;

class UserGenController extends Controller
{
    const USERS_NUMBER = 5;
    const BIRTHDATE = true;
    const PROFILE = false;
    const COUNTRY = false;
    const GENDER = false;
    const FORMAT_TEXT = true;
    const FORMAT_CSV = false;

    // TODO add CSV generator

    // TODO add JSON generator

    private $faker = null;

    private function getFaker()
    {
      if ($this->faker == null) {
        $this->faker = Faker::create();
      }
      return $this->faker;
    }

    private function getValidationRules() {
      return ['users'       =>   'integer|min:1|max:99', // integer between 1 and 99
              'birthdate'   =>   'boolean',
              'profile'     =>   'boolean', 
              'country'     =>   'boolean',
              'gender'      =>   'boolean',
              'formatText'  =>   'boolean',
              'formatCSV'   =>   'boolean',
              ]; 
    }

    private function getValues($request) {
      return [
        'users'     => ($request->exists('users') )     ? $request->get('users')    :     self::USERS_NUMBER,
        'birthdate' => ($request->exists('birthdate') )  ? $request->get('birthdate') :  self::BIRTHDATE,
        'profile'   => ($request->exists('profile') )   ? $request->get('profile')  :     self::PROFILE,
        'country'   => ($request->exists('country') )   ? $request->get('country')  :     self::COUNTRY,
        'gender'    => ($request->exists('gender') )    ? $request->get('gender')   :     self::GENDER,
        'formatText'    => ($request->exists('formatText') )  ? $request->get('formatText')  : self::FORMAT_TEXT,
        'formatCSV'    => ($request->exists('formatCSV') )    ? $request->get('formatCSV')   : self::FORMAT_CSV,
      ];
    }

    private function getUsers($values){
        $genders = array(0=>"m",1=>"f");
        //for store users
        $users = Array(); 
        //Generate users
        for ($i=0; $i < $values['users']; $i++) {

            if ($values['gender']){
              $users[$i] = Array("gender" => $genders[rand(0,1)]);

              if($users[$i]["gender"]=="m"){
                $users[$i] = array_merge($users[$i], Array("name" => $this->faker->firstNameMale ) );
              }else{
                $users[$i] = array_merge($users[$i], Array("name" => $this->faker->firstNameFemale ) );
              }

              $users[$i]["name"] .= ' '.$this->faker->firstName;

            }else{
              $users[$i] = Array("name" => $this->faker->name);
            }

            
            if ($values['birthdate']){
                $users[$i] = array_merge($users[$i], Array("birthdate" => $this->faker->dateTimeThisCentury->format("Y-m-d")));
            }
            if ($values['profile']){
                $users[$i] = array_merge($users[$i], Array("profile" => $this->faker->sentence));
            }
            if ($values['country']){
                $users[$i] = array_merge($users[$i], Array("country" => $this->faker->country));
            }


        }
        
        return $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $this->validate($request, $this->getValidationRules());
        $values = $this->getValues($request);

        // Empty user array
        $users = array();

        return view("content.usergenerator", ['values' => $values, 'users' => $users]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postIndex(Request $request)
    {

        $this->validate($request, $this->getValidationRules());
        $values = $this->getValues($request);
      
        // Create user generator
        $faker = $this->getFaker();

        // Generate users
        $users = $this->getUsers($values);
        
        return view("content.usergenerator", ['values' => $values, 'users' => $users]);
       
    }


}
