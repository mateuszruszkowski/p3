<?php

namespace P3\Http\Controllers;

use Illuminate\Http\Request;
use P3\Http\Requests;
use P3\Http\Controllers\Controller;
use Badcow\LoremIpsum\Generator as LoremIpsumGen;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //echo \App::environment();
        $generator = new LoremIpsumGen();
        $paragraphs = $generator->getParagraphs(5);
        echo implode('<p>', $paragraphs);
        return view('main.index');
    }

   
}
