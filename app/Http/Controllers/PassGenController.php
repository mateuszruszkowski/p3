<?php

namespace P3\Http\Controllers;

use Illuminate\Http\Request;
use P3\Http\Requests;
use P3\Http\Controllers\Controller;

class PassGenController extends Controller
{
    // define const/default values
    const WORDS_NUMBER = 3;
    const NUMBERS = 0;
    const SYMBOLS = 0;
    const MAX_LENGTH = 30;
    const SEPARATOR = '-';
    const ADD_NUM = 0;
    const ADD_SYM = 0;
    const CASES = 0; // Uppercase only first letter

    /**
     * Define validation rules for sended form
     *
     * @return Validation rules
     */
    private function getValidationRules() {
      return ['words_number' => 'integer|min:1|max:99', // must be an integer between 1 and 99
             'numbers'       => 'integer|min:0|max:10', // must be an integer between 1 and 10  
             'symbols'       => 'integer|min:0|max:10', // must be an integer between 1 and 10
             'max_length'    => 'integer|min:1|max:99', // must be an integer between 1 and 99
             'cases'         => 'integer|min:0|max:2'];
    }

    /**
     * Get or set values used to generate users
     *
     * @return array of values used to gererate users
     */
    private function getValues($request) {
      return [
        'words_number' => ($request->exists('words_number') ) ? $request->get('words_number') : self::WORDS_NUMBER,
        'numbers'   => ($request->exists('numbers') ) ? $request->get('numbers') : self::NUMBERS,
        'symbols'  => ($request->exists('symbols') ) ? $request->get('symbols') : self::SYMBOLS,
        'max_length'  => ($request->exists('max_length') ) ? $request->get('max_length') : self::MAX_LENGTH,
        'separator'  => ($request->exists('separator') ) ? $request->get('separator') : self::SEPARATOR,
        'cases'  => ($request->exists('cases') ) ? $request->get('cases') : self::CASES,
      ];
    }

    /**
     * Generating new passord
     *
     * @return generated password
     */
    private function getPassword($values) {

        // define if we add symbols/numbers or no
        $addN =  ( (int)$values['numbers'] > 0 ) ? 1: 0;
        $addS =  ( (int)$values['symbols'] > 0 ) ? 1: 0;

        // define variables
        $error = 0;
        $passArray = Array();
        $passString = '';
        $x = 0;

        // for testing polish words
        //$words = Array( 0 => 'dom', 1=>'but', 2=>'szafa', 3=>'franek', 4=>'pidzama', 5=>'szklanaka', 6=>'kubek', 7=>'biurko', 8=>'krzesło', 9=>'laptop');

        // get wordlist
        $matches = Array();
        $words = Array();

        for($i=1;$i<2;$i+=2){  // not 30 because it slow page load
            
            if( $i<10 ){    $no_page = '0'.$i;  }else{ $no_page = $i; }
            if( ($i+1) <10 ){ $no_page_plus1 = '0'.($i+1); }else{ $no_page_plus1 = $i+1; }
            $page = file_get_contents('http://www.paulnoll.com/Books/Clear-English/words-'.$no_page.'-'.$no_page_plus1.'-hundred.html');

            preg_match_all('/<li>(.*?)<\/li>/s', $page, $matches);

            foreach ($matches[1] as $key => $value) {
                $words[] = trim($value);
            }

        }

        // special chars array
        $specials_chars = Array( 0=>'!', 1=>'@', 2=> '#', 3=>'$', 4=>'%', 5=>'^', 6=>'&', 7=>'*');

        // 5 attempts to generate password with length smaller than max length
        while($x <= 5) {

            // if vars are ok let's generate password
            for($i=0;$i<$values['words_number'];$i++){
                $randValue = rand(0, count($words)-1 );
                $passArray[$i] = $words[$randValue];

                // add numbers and symbols if index is lower than number of them
                if ($i < $values['numbers'] && $addN){    $passArray[$i] .= rand(0, 9);   }
                if ($i < $values['symbols'] && $addS){    $passArray[$i] .= $specials_chars[ rand(0, 7)]; }

                //add custom cases 
                switch ($values['cases'] ) {
                    case 0:
                        $passArray[$i] = ucfirst(strtolower($passArray[$i]));
                        break;
                    case 1:
                        $passArray[$i] = strtoupper($passArray[$i]);
                        break;
                    case 2:
                        $passArray[$i] = strtolower($passArray[$i]);
                        break;
                }

            }

            // add missing numbers and symbols in needed
            if($values['numbers'] > $values['words_number'] && $addN){
                for($i=0; $i<($values['numbers']-$values['words_number']);$i++){ $passArray[$values['words_number']-1].= rand(0, 9); }
            }
            
            if($values['symbols'] > $values['words_number'] && $addS){
                for($i=0; $i<($values['symbols']-$values['words_number']);$i++){ $passArray[$values['words_number']-1].= $specials_chars[ rand(0, 7)]; }
            }

            // implode array to generated password
            $passString = implode($values['separator'], $passArray);

            # check if password length is smaller than max length, if we find suited password set $x as 10 else end loop as a 5
            if( strlen($passString) <= $values['max_length']) { 
                $x = 10; 
            }else{
                $x++;   
            }

            if($x!=10) {
                $error = "Sorry, we can't find good words to generate password shorter than max length";
            }

        }

        return $passString;

    }

    /**
     * Display form with generated password, or page to view from saved bookmark
     */
    public function getGenerated(Request $request)
    {
        // validate variables, and getting their values
        $this->validate($request, $this->getValidationRules());
        $values = $this->getValues($request);

        // if password was genereated in previous page
        if( $request->get('bookmark_name') ){
            $passString = $this->getPassword($values);  
        }elseif( $request->get('passwordg') ){
        // if password comes from saved link/bookmark
            $passString = $request->get('passwordg');      
        }else{
        // any other example
            $passString = $this->getPassword($values);    
        }
        
        return view("content.passwordgenerator", ['values' => $values, 'passString' => $passString ]);
    }


    /**
     * Display form with default values
     */
    public function getIndex(Request $request)
    {
        $this->validate($request, $this->getValidationRules());
        $values = $this->getValues($request);

        return view("content.passwordgenerator", ['values' => $values]);
    }

}
