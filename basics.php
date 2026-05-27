<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        Name : <input type="text" name="name">
        Email : <input type="text" name="email">
        Phone number : <input type="text" name="phonenumber">
        <input type="submit" value="submit" name="submit">
    </form>
    <?php
          if(isset($_POST["submit"])){
            $name=$_POST["name"];
            $email=$_POST["email"];
            $phone=$_POST["phonenumber"];

            echo "info";
            echo "name " .$name ."email".$email ."phone" .$phone;
          }
    ?>
</body>
</html>