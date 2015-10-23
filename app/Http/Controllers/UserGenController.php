<?php

namespace P3\Http\Controllers;

use Illuminate\Http\Request;
use P3\Http\Requests;
use P3\Http\Controllers\Controller;
use Faker\Factory as Faker;

class UserGenController extends Controller
{
    const USERS = 5;
    const BIRTHDATE = true;
    const PROFILE = false;
    const COUNTRY = false;
    const GENDER = false;
    const FORMAT = 'text';

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
      return ['users'     =>   'integer|min:1|max:99', // must be an integer between 1 and 99
              'birthdate'  =>   'boolean',  
              'profile'   =>   'boolean', 
              'country'   =>   'boolean',
              'gender'    =>   'boolean',
              'format'    =>   'in:text,csv']; 
    }

    private function getValues($request) {
      return [
        'users'     => ($request->exists('users') )     ? $request->get('users')    : self::USERS,
        'birthdate'  => ($request->exists('birthdate') )  ? $request->get('birthdate') : self::BIRTHDATE,
        'profile'   => ($request->exists('profile') )   ? $request->get('profile')  : self::PROFILE,
        'country'   => ($request->exists('country') )   ? $request->get('country')  : self::COUNTRY,
        'gender'    => ($request->exists('gender') )    ? $request->get('gender')   : self::GENDER,
        'format'    => ($request->exists('format') )    ? $request->get('format')   : self::FORMAT,
      ];
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
        $users = array();
        return view("usergen.index", ['values' => $values, 'users' => $users]);
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
       

        //Create user generator
        $faker = $this->getFaker();

        $users = Array(); //for store users

        //Generate users
        for ($i=0; $i < $num_users; $i++) {
            $users[$i] = Array("name" => $this->faker->name);
            if (BIRTHDATE){
                $users[$i] = array_merge($users[$i], Array("birthdate" => $this->faker->dateTimeThisCentury->format("Y-m-d")));
            }
            if (PROFILE){
                $users[$i] = array_merge($users[$i], Array("profile" => $this->faker->text));
            }
        }

         return view("usergen.index", ['values' => $values, 'users' => $users]);
       
    }


}
