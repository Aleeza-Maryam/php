<?php
$product_name="Laptop";
$price=200000;
$isavail=true;

echo "Product Name: " . $product_name;
echo "<br>";
echo "<br>";

echo "Price: " . $price;
echo "<br>";
echo "<br>";

echo "Availability: " . ($isavail ? "In Stock" : "Out of Stock");

?>