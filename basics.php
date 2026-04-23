<?php

use function PHPSTORM_META\type;

echo "Hello";
$var=42;
/*
This is a multi-line comment
that spans multiple lines
*/
echo "<br>";

$var1;
$var2;
$var3=123;
echo "<br>";
echo $var3;
echo "By";

class Myclass{

}
$obj = new MyClass();
// Constants
// PHP mein define() ka istemal Constants banane ke liye kiya jata hai.
define('PI',3.14);
echo "<br>";
echo PI;

// arrays
$fruits=['apple','banana','cherry'];
// assisiated array
$info=['first_name'=>'Ali','last_name'=>'Khan'];
echo "<br>";
echo $fruits[0];
echo "<br>";
echo $info['first_name'];
echo "<br>";
// 2d aray
$array2d=[[1,2,3,4],
[5,6,7,8]];
echo $array2d[0][1];
class Person{
    public $name;
    public function saymyname(){
        echo "Hello , my name is " . $this->name;    //or echo "Hello , my name is  $this->name"; agr dot ni lgaein ge to uskopta ni chle ga string kide rkhtm ho ri
    }
}
$person=new Person;
$person->name="Ahmad";
$person->saymyname();
if ($variable === null) {
echo "The variable is NULL.";
}

$varname="age";
$$varname=25;      //creates a variable age with the value of 5
echo $age;

// (&) symbol to create a reference.

$var6=25;
$var7=&$var6;
echo $var7;
$a=2;
$b="2";
if($a!==$b){
    echo "not equal";    //datatype ko dkehe ga
}
else{
    echo "equal";
}
// Spaceship (<=>) Operator (PHP 7.0 and later):
// • Compares two values and returns:
// • 1 if the left operand is greater
// • 0 if they are equal
// • -1 if the right operand is greater
$c=5;
$d=7;
echo $c<=>$d;   //-1
$result = $a << 2;
echo $result;
// left shift multiple right divide

$floatValue = 3.14;
$intValue = (int)$floatValue;
echo gettype($intValue);
$value = "Hello";

?>
