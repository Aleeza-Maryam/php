<!-- - Task 2: Write a program to display grade based on marks.
Example:
90+ = A
80+ = B
70+ = C
Below 70 = Fail
-  -->
<?php
$marks = 85; // You can change this value to test with different marks
if ($marks >= 90) {
    echo "Grade: A";
} elseif ($marks >= 80) {
    echo "Grade: B";
} elseif ($marks >= 70) {
    echo "Grade: C";
} else {
    echo "Grade: Fail";
}