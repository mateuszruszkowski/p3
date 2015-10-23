<?php

namespace P3\Http\Controllers;

use Illuminate\Http\Request;
use P3\Http\Requests;
use P3\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('main.index');
    }

   
}
