<?php

namespace P3\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use P3\Http\Requests;
use P3\Http\Controllers\Controller;
use Badcow\LoremIpsum\Generator as LoremIpsumGen;

class LoremGenController extends Controller
{
    private $LoremIpsumGen = null;
    const PARAGRAPHS_NUMBER = 3;
    const GENERATED_TEXT = 'Nic nie zostało wygenerowane.';
    
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
    public function postDownload()
    {
      $numberOfParagraphs = $this->getParagraphsNumber();
      $paragraphs = $this->getLipsumGen()->getParagraphs($numberOfParagraphs);
      $values['generated'] = $_POST['generated_text'];
        
      $filename = "lorem_ipsum.txt";

      $handle = fopen($filename, 'w+');
      file_put_contents($filename, $values['generated']);
      fclose($handle); 
        
      $headers = array('Content-Type' => 'text/plain');
      return Response::download($filename, (String)$filename, $headers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        return view("content.loremgenerator", ["paragraphsNumber" => self::PARAGRAPHS_NUMBER]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postIndex(Request $request)
    {
        $numberOfParagraphs = $this->getParagraphsNumber();
        $paragraphs = $this->getLipsumGen()->getParagraphs($numberOfParagraphs);
        return view("content.loremgenerator", ["paragraphs" => $paragraphs, "paragraphsNumber" => strval($numberOfParagraphs)] );
    }

}
