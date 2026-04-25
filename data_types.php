<?php
//String data type example
$text = "Welcome to PHP Lab This is a string variable"; 
echo $text; 
echo "<br>";
echo "<br>";
//Integer data type example
$marks = 85; 
echo "Student Marks: " . $marks; 
echo "<br>";
echo "<br>";
//Float data type example
$price = 19.99;
echo "Product Price: $" . $price;
echo "<br>";
echo "<br>";
//Boolean data type example
$isAvailable = true;
echo "Is the product available? " . ($isAvailable ? "Yes" : "No");
echo "<br>";
echo "<br>";
//Array data type example
$fruits = array("Apple", "Banana", "Orange");
echo "Fruits: " . implode(", ", $fruits);
?>
