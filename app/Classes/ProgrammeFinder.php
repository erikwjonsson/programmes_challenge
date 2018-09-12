<?php namespace App\Classes;

class ProgrammeFinder {

  public function findProgrammes($file, $search) {
    $json = $this->readProgrammesDataFile($file);
    $programmes = $this->extractProgrammes($json);
    $slice_titles = $this->extractSliceTitles($programmes); // => ['archersomnibusthe', 'archersthe']
    $matching_title_indexes = $this->matchTitles($slice_titles, $search); // => [0, 7]
    $programmes = $this->findProgrammesByIndex($programmes, $indexes);
    return $programmes;
  }

  public function readProgrammesDataFile($file) {
    // https://www.w3schools.com/php/php_file_open.asp
    $file = fopen("./Data/programme_source_data.txt", "r") or die("Unable to open file!");

    // https://www.tutorialrepublic.com/php-tutorial/php-json-parsing.php
    $string = fread($file,filesize("source-data.txt"));
    //$arr = var_dump(json_decode($data, true));
    $json_data = json_decode($string, true);
    return $json_data;
  }

  public function hello() {
    echo 'SAY HELLO!';
  }

  public function extractProgrammes($json_data) {
    //echo 'look here';
    // HOW TO PRINT ARRAY https://stackoverflow.com/questions/20017409/how-to-solve-php-error-notice-array-to-string-conversion-in
    //print_r($arr['atoz']['tleo_titles'][0]['slice_title']);
    $programmes = $json_data['atoz']['tleo_titles'];
    return $programmes;
  }

  public function extractSliceTitles($programmes) {
    $slice_titles = array();
    $arrlength = count($programmes);

    for($x = 0; $x < $arrlength; $x++) {
      // PUSH https://www.w3schools.com/php/func_array_push.asp
      //array_push($slice_titles, $titles[$x]['slice_title'], $x);
      array_push($slice_titles, $programmes[$x]['slice_title']);
      print_r($programmes[$x]['slice_title']);
        echo "<br>";
    }

    print_r($slice_titles);
    return $slice_titles;
  }

  public function matchTitles($slice_titles, $search) {
    echo "matches ";
    $matching_title_indexes = array();
    $arrlength = count($slice_titles);
    for($x = 0; $x < $arrlength; $x++) {
      // PUSH https://www.w3schools.com/php/func_array_push.asp
      //array_push($slice_titles, $titles[$x]['slice_title'], $x);
      echo "<br>";
      //print_r($slice_titles[$x]);
      echo "<br>";
      //echo $search;
      if (strpos($slice_titles[$x], $search) !== false) { // change to true later.
        echo "IT IS TRUE";
        // array_push($matching_titles, $slice_titles[$x]);
        array_push($matching_title_indexes, $x); // HERE WE PUSH THE INDEX INSTEAD OF THE MATCHING TITLE.
      }
    }
    echo "<br>";
    echo "THE RESULT";
    print_r($matching_title_indexes);
    echo "<br>";
    echo strpos("thearchers", "archer");
    echo "SEVENS";
    echo strpos("I love php, I love php too!","php");
    return $matching_title_indexes;
  }

  
  public function findProgrammesByIndex($programmes, $indexes) {
    $programmes = array();
    $arrlength = count($indexes);

    for($x = 0; $x < $arrlength; $x++) {
      $matching_programme = $programmes[$indexes[$x]];
      array_push($programmes, $matching_programme);
    }
    return $programmes;
  }
}

?>
