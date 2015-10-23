<?php

namespace P3\Http\Controllers;

use Illuminate\Http\Request;
use P3\Http\Requests;
use P3\Http\Controllers\Controller;
use Badcow\LoremIpsum\Generator as LoremIpsumGen;

class LoremGenController extends Controller
{
    private $LoremIpsumGen = null;
    const PARAGRAPHS_NUMBER = 3;
    
    /**
    * Returns the controller of lorem ipsum generator if it exists or create it
    *
    * @link https://github.com/Badcow/LoremIpsum
    * @return Generator The controller lorem ipsum generator
    */
    private function getLipsumGen() {

        if ($this->LoremIpsumGen == null) {
            $this->LoremIpsumGen = new LoremIpsumGen();
        }

        return $this->LoremIpsumGen;
    }


    private function getParagraphsNumber() {
      if (isset($_POST['paragraphsNumber'])) {
          if (strlen($_POST['paragraphsNumber'])<2 && $_POST['paragraphsNumber'] != 0 && is_numeric($_POST['paragraphsNumber'])) {
            return (int)$_POST['paragraphsNumber'];
          }
      }
      return self::PARAGRAPHS_NUMBER;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view("loremgen.index", ["paragraphsNumber" => self::PARAGRAPHS_NUMBER]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postIndex()
    {
        $numberOfParagraphs = $this->getParagraphsNumber();
        $paragraphs = $this->getLipsumGen()->getParagraphs($numberOfParagraphs);
        return view("loremgen.index", ["paragraphs" => $paragraphs, "paragraphsNumber" => strval($numberOfParagraphs)] );
    }

}
