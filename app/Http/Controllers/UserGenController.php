<?php

namespace P3\Http\Controllers;

use Illuminate\Http\Request;
use P3\Http\Requests;
use P3\Http\Controllers\Controller;
use Faker\Factory as Faker;

class UserGenController extends Controller
{
    // TODO define const

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view("usergen.index");
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postIndex(Request $request)
    {
        $this->validate($request, [
            "users" => "required|integer|min:1"
        ]);
        //Create user generator
        $faker = $this->getFaker();
        $num_users = $request->input('users');
        $birthdate = $request->input('birthdate'); 
        $profile = $request->input('profile'); 

        $users = Array(); //for store users

        //Generate users
        for ($i=0; $i < $num_users; $i++) {
            $users[$i] = Array("name" => $this->faker->name);
            if (!empty($birthdate)){
                $users[$i] = array_merge($users[$i], Array("birthdate" => $this->faker->dateTimeThisCentury->format("Y-m-d")));
            }
            if (!empty($profile)){
                $users[$i] = array_merge($users[$i], Array("profile" => $this->faker->text));
            }
        }
       
        return view("usergen.index", ["users" => $users, "birthdate"=>$birthdate, "profile"=>$profile]);
    }


}
