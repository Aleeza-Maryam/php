<?php

$num1 = trim(readline("Enter the first number: "));
$num2 = trim(readline("Enter the second number: "));
$operator = trim(readline("Enter the operator (+, -, *, /): "));
// Perform the calculation based on the operator
if (!is_numeric($num1) || !is_numeric($num2)) {
    echo "Error: Please enter valid numbers.\n";
    exit;
}

$num1 = $num1 + 0;
$num2 = $num2 + 0;

$result = null;
$op = strtolower($operator);
switch ($op) {
    case '+':
        $result = $num1 + $num2;
        break;
    case '-':
        $result = $num1 - $num2;
        break;
    case '*':
    case 'x':
        $result = $num1 * $num2;
        break;
    case '/':
        if ($num2 != 0) {
            $result = $num1 / $num2;
        } else {
            echo "Error: Division by zero is not allowed.";
            exit;
        }
        break;
    default:
        // accept some word forms as well
        if ($op === 'add' || $op === 'plus') {
            $result = $num1 + $num2;
        } elseif ($op === 'subtract' || $op === 'minus') {
            $result = $num1 - $num2;
        } elseif ($op === 'multiply' || $op === 'times') {
            $result = $num1 * $num2;
        } elseif ($op === 'divide') {
            if ($num2 != 0) {
                $result = $num1 / $num2;
            } else {
                echo "Error: Division by zero is not allowed.";
                exit;
            }
        } else {
            echo "Invalid operator. Please use +, -, *, / or spell the operation (add, subtract, multiply, divide).\n";
            exit;
        }
        exit;
}
echo "Result: " . $result;
?>
