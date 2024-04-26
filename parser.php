<?php
function changeToUpper($inputString, $arrIndex) {
    $modifiedString = '';
    $length = mb_strlen($inputString);
    for ($i = 0; $i < $length; $i++) {
      $char = mb_substr($inputString, $i, 1, 'UTF-8');
      if (in_array($i, $arrIndex)) {
        $modifiedString .= mb_strtoupper($char, 'UTF-8');
      } else {
           $modifiedString .= $char;
      }
    }
    return $modifiedString;
}

function changeCaseSymetricly($inputString) {
    $modifiedString = '';
    $indexForUpper = [];
   $length = mb_strlen($inputString);
   for ($i = 0; $i < $length; $i++) {
       $char = mb_substr($inputString, $i, 1, 'UTF-8');
       if (mb_strtoupper($char, 'UTF-8') === $char) {
           $modifiedString .= mb_strtolower($char, 'UTF-8');
           array_push($indexForUpper, $length - 1 -$i);
       } else {
           $modifiedString .= $char;
       }
   }
   return changeToUpper($modifiedString, $indexForUpper);
}

function reverseLetters($word) {
   $reversedWord = '';
   for ($i = mb_strlen($word, 'UTF-8') - 1; $i >= 0; $i--) {
       $reversedWord .= mb_substr($word, $i, 1, 'UTF-8');
   }
   return $reversedWord;
}

function reverseWord($word) {
    preg_match_all('/[\p{L}]+|[\p{P}`]+/u', $word, $matches);
    $letters = $matches[0];
    print_r($letters);
    // Reverse the letters only
    $reversedLetters = [];
    foreach ($letters as $item) {
        if (preg_match('/\p{L}/u', $item)) {
            $reversedLetters[] = changeCaseSymetricly(reverseLetters($item));  // Reverse the letters
        } else {
            $reversedLetters[] = $item;  // Maintain the original punctuation, hyphen or apostrophe
        }
    }

    // Join the reversed letters and the original punctuations hyphens and apostrophes
    $result = '';
    $j = 0;
    for ($i = 0; $i < count($letters); $i++) {
        $result .= $reversedLetters[$i];
    }
    return $result;
}

function solutionToTask($inputString) {
    $words = preg_split('/\s+/', $inputString);
    $processedWords = "";
    foreach($words as $word) {
        $processedWords .= reverseWord($word) . " ";
    }
    return trim($processedWords);
}

function testResolution() {
    $input1 = 'Cat';
    if(solutionToTask($input1) === 'Tac') {
        echo "Test: $input1 ---> Succeed\n";        
    }
    
    $input2 = 'Мышь';
    if(solutionToTask($input2) === 'Ьшым') {
        echo "Test: $input2 ---> Succeed\n";        
    }
    
    $input3 = 'houSe';
    if(solutionToTask($input3) === 'esuOh') {
        echo "Test: $input3 ---> Succeed\n";        
    }
    
    $input4 = 'домИК';
    if(solutionToTask($input4) === 'кимОД') {
        echo "Test: $input4 ---> Succeed\n";        
    }
    
    $input5 = 'elEpHant';
    if(solutionToTask($input5) === 'tnAhPele') {
        echo "Test: $input5 ---> Succeed\n";        
    }
    
    $input6 = 'cat,';
    if(solutionToTask($input6) === 'tac,') {
        echo "Test: $input6 ---> Succeed\n";        
    }
    
    $input6 = 'Зима:';
    if(solutionToTask($input6) === 'Амиз:') {
        echo "Test: $input6 ---> Succeed\n";        
    }
    
    $input7 = "is 'cold' now";
    if(solutionToTask($input7) === "si 'dloc' won") {
        echo "Test: $input7 ---> Succeed\n";        
    }
    
    $input8 = 'это «Так» "просто"';
    if(solutionToTask($input8) ===  'отэ «Кат» "отсорп"') {
        echo "Test: $input8 ---> Succeed\n";        
    }
    
    $input9 = 'third-part';
    if(solutionToTask($input9) === 'driht-trap') {
        echo "Test: $input9 ---> Succeed\n";        
    }
    
    $input10 = "can`t";
    if(solutionToTask($input10) === "nac`t") {
        echo "Test: $input10 ---> Succeed\n";        
    }
}

//Simple unit test
testResolution();
