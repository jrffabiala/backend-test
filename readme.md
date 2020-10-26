- config.php is included
- database to restore is in sql folder

- admin username: admin
- admin passowrd: pass123   


Here is the answer to the 3rd question: problem-solving challenge

...

```php
<?php

function first_repeated_char($str) {
  for ($i = 0 ; $i < strlen($str) ; ++$i) {
    if (strpos($str, $str[$i], $i+1)) {
        $position = strpos($str, $str[$i], $i+1);
        echo $str[$i] . ' [' . $i . ',' . $position . ']';
        exit();
    }
  }
}

$str = '*l1J?)yn%R[}9~1"=k7]9;0[$'; 

first_repeated_char($str);

?>