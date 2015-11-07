<?php

namespace P3\Http\Controllers;

use Response;
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
    const FORMAT = 'txt';
    const TEXT = 'Empty file';

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
              'format'      =>   'in:txt,csv,json',
              ]; 
    }

    private function getValues($request) {
      return [
        'users'     => ($request->exists('users') )     ? $request->get('users')    :     self::USERS_NUMBER,
        'birthdate' => ($request->exists('birthdate') )  ? $request->get('birthdate') :  self::BIRTHDATE,
        'profile'   => ($request->exists('profile') )   ? $request->get('profile')  :     self::PROFILE,
        'country'   => ($request->exists('country') )   ? $request->get('country')  :     self::COUNTRY,
        'gender'    => ($request->exists('gender') )    ? $request->get('gender')   :     self::GENDER,
        'format'    => ($request->exists('format') )    ? $request->get('format')   :     self::FORMAT,
        'generated_text' => ($request->exists('generated_text') ) ? $request->get('generated_text'):     self::TEXT,
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

            // // set output of data
            if( $values['format']=='txt'){
              // implode text and show every new user in new line
              $users[$i] = implode("\r\n", $users[$i]);  
            }elseif( $values['format']=='csv'){
              // add delimiter ; and new line in template thro loop
              $csv_line = '"';
                  $csv_line .= implode('";"', $users[$i]).'"';
              $users[$i] = $csv_line;
            }elseif( $values['format']=='json'){
              // convert array when finish all loop
            }
          

        } // end of: for ($i=0; $i < $values['users']; $i++) {
        
        if( $values['format']=='json'){
              $users = json_encode($users, JSON_FORCE_OBJECT);
        }

        return $users;
    }

  /**
   * Send file to user
   *
   * @return suited header and content of file
   */
    public function postDownload(Request $request){
      // standard validation data, do not generate new, only print to file existing
      $this->validate($request, $this->getValidationRules());
      $values = $this->getValues($request);

      $filename = "users.".$values['format'];

      $handle = fopen($filename, 'w+');
      file_put_contents($filename, $values['generated_text']);
      fclose($handle); 
        
      if( $values['format'] == 'txt' ){
        $headers = array('Content-Type' => 'text/plain');
        return Response::download($filename, 'users.txt', $headers);
      }else{
        $headers = array('Content-Type' => 'text/'.$values['format']); 
        return Response::download($filename, 'users.'.$values['format'], $headers);  
      }

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
