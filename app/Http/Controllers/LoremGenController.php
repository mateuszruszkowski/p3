<?php

namespace P3\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use P3\Http\Requests;
use P3\Http\Controllers\Controller;
use Badcow\LoremIpsum\Generator as LoremIpsumGen;

class LoremGenController extends Controller
{
    // inicialization of LoremIpsumGenerator
    private $LoremIpsumGen = null;

    // inicialization of const values, used in form
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

    /**
    * Validate number of paragraphs 
    * @return Validation rules
    */
    private function getValidationRules() {
      return ['paragraphsNumber'=>'integer|min:1|max:99']; // integer between 1 and 99
    }


    /**
    * Get values of form inputs or sets defaults
    * @return Validation rules
    */
    private function getValues($request) {
      return [
        'paragraphsNumber' => ($request->exists('paragraphsNumber') ) ? $request->get('paragraphsNumber') : self::PARAGRAPHS_NUMBER
      ];
    }


    /**
     * Return file to download
     */
    public function postDownload(Request $request)
    {
      // validate form values
      $this->validate($request, $this->getValidationRules());
      $values = $this->getValues($request);

      // get generated $_POST text
      $values['generated'] = $request->get('generated_text');
      
      // set handler file name
      $filename = 'lorem_ipsum.txt';

      $handle = fopen($filename, 'w+');
        // add $_POST content to file
        file_put_contents($filename, $values['generated']);
      fclose($handle); 
      
      // download file  
      $headers = array('Content-Type' => 'text/plain');
      return Response::download($filename, (String)$filename, $headers);
    }


    /**
     * Display form with default values
     *
     */
    public function getIndex(Request $request)
    {
      // get default values
      $values = $this->getValues($request);

      // display default form
      return view('content.loremgenerator', ['values' => $values] );
    }


    /**
     * Display form and generated paragraphs
     */
    public function postIndex(Request $request)
    {
      // validate form values
      $this->validate($request, $this->getValidationRules());
      $values = $this->getValues($request);
      
      // generate paragraphs
      $paragraphs = $this->getLipsumGen()->getParagraphs($values['paragraphsNumber']);

      // display all
      return view('content.loremgenerator', ['paragraphs' => $paragraphs, 'values' => $values] );
    }

}
