<!DOCTYPE html>
<html>
<head>
<title>Compare Two Numbers</title>
</head>
<body>
<h2>Compare Two Numbers</h2>
<form method="post">
Enter First Number:
<input type="number" name="num1"><br><br>
Enter Second Number:
<input type="number" name="num2"><br><br>
<input type="submit" name="scompare" value="Compare">
</form>
<?php
if(isset($_POST['scompare'])){
$num1 = $_POST['num1'];
$num2 = $_POST['num2'];
if($num1 > $num2){
echo "First number is greater than second number";
}
elseif($num1 < $num2){
echo "Second number is greater than first number";
}
else{
echo "Both numbers are equal";
}
}
?>
</body>
</html>