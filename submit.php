<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="style/store.css">
    <link rel="stylesheet" href="style/submit.css">
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/js.js"></script>
    <?php require_once "connection/connect.php"?>
    <?php require_once "connection/common.php"?>
    <?php

    function submit($username,$password,$firstname,$lastname,$email,$token=0){
        global $connect,$users;

        $username=sanitize($username);
        $firstname=sanitize($firstname);
        $lastname=sanitize($lastname);
        $email=sanitize($email);
        $realPass=$password;
        $password=hashData($password,'sha1');

        $sql=("INSERT `$users` SET `username`=? , `password`=? , `firstname`=? , `lastname`=? , `email`=? , `token`=?");

        $result=$connect->prepare($sql);
        $result->bindValue(1,$username);
        $result->bindValue(2,$password);
        $result->bindValue(3,$firstname);
        $result->bindValue(4,$lastname);
        $result->bindValue(5,$email);
        $result->bindValue(6,$token);
        $result->execute();
        return $result;
    }



    function user_exist($username){
        global $connect,$users;
        $username=sanitize($username);
        $sql=("SELECT `username` FROM `$users` WHERE `username`=?");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$username);
        $result->execute();
        if($result->rowCount()){
            return $result;
        }
        return false;
    }

    ?>
</head>
<body>

<div class="header">
    <div class="info-left">
        <a href="fruites.php">میوه</a>
        <a href="vegetable.php">سبزیجات</a>
        <a href="organic.php">ارگانیک</a>
    </div>
    <div class="info-right">
        <i class="fab fa-instagram"></i>
        <i class="fab fa-facebook-f"></i>
        <i class="fab fa-telegram-plane"></i>
        <i class="fab fa-twitter"></i>
        <i class="fab fa-whatsapp"></i>
    </div>

</div>

<div class="box">
    <div class="logo-box">
        <i class="fa fa-shopping-cart" id="cart"></i>
        <i class="fa fa-phone" id="call">
            <span>72904</span>
        </i>


    </div>
    <div class="center">
        <img src="pic/logo.png" alt="">
    </div>
</div>

<div class="card-form">
<div class="form-box">

<div class="submit-box">ثبت نام<i class="fa fa-user"></i></div>

            <div class="form-input">
                <form action="" method="post">

                 <input type="text" name="firstname" placeholder="نام" autocomplete="off" class="input">
                 <input type="text" name="lastname" placeholder="نام خانوادگی" autocomplete="off" class="input">
                 <input type="password" name="password" placeholder="رمز عبور" autocomplete="off" class="input">
                 <input type="text" name="email" placeholder="ایمیل" autocomplete="off" class="input">
                 <input type="text" name="username" placeholder="نام کاربری" autocomplete="off" class="input">


                        <input type="submit" value="ثبت نام"  name="submit" class="submit">



                </form>

            </div>
</div>



<?php

$log=null;
$errors=array();
$hasError=false;
$exist=null;


if(isset($_POST['submit'])){
    if(!empty($_POST['password']) and !empty($_POST['username']) and !empty($_POST['firstname']) and !empty($_POST['lastname']) and !empty($_POST['email']) and filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) and strlen($_POST["password"])>=7 ){

        $exist=user_exist($_POST['username']);
        if($exist){
            echo '<script>
                           $(function() {
                              swal({text:"کاربری با این نام کاربری قبلا ثبت شده است", icon:"error", button:"بستن",timer:5000  }) })
              </script>';
        }
        else{
            $log=submit($_POST['username'],$_POST['password'],$_POST['firstname'],$_POST['lastname'],$_POST['email'],'0');

            echo '<script>
                           $(function() {
                              swal({text:"اطلاعات با موفقیت ثبت گردید", icon:"success", button:"بستن",timer:5000  }) })
              </script>';
        }

    }
    else{
        if(empty($_POST['firstname'])){
            $hasError=true;
          $errors[]='لطفا نام خود را وارد نمایید';
        }
        if(empty($_POST['lastname'])){
            $hasError=true;
            $errors[]='لطفا نام خانوادگی خود را وارد نمایید';
        }
        if(empty($_POST['username'])){
            $hasError=true;
            $errors[]='لطفا نام کاربری خود را وارد نمایید';
        }
        if(empty($_POST['email'])){
            $hasError=true;
            $errors[]='لطفا ایمیل خود را وارد نمایید';
        }
        if(empty($_POST['password'])){
            $hasError=true;
            $errors[]='لطفا رمز عبور خود را وارد نمایید';
        }
        if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
            $hasError=true;
            $errors[]='لطفا فرمت ایمیل معتبر وارد نمایید';
        }
        if(strlen($_POST["password"])<7){
            $hasError=true;
            $errors[]='رمز عبور نمی تواند کمتر از 7 کاراکتر باشد';
        }
    }
}

?>

<div class="error-box" id="error">

    <?php
    if($hasError){
        foreach ($errors as $error): ?>
            <div class="error"><?php echo $error ?></div>
     <?php endforeach;}?>
</div>
</div>

</body>
</html>

