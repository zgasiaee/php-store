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
    <style>
        .form-box{
            min-height: 250px;
            margin:  180px 450px 10px 0 ;
        }
        .form-box .form-input form .input{
            width: 50%;
            margin-bottom:30px;
        }
        .error-box{
            min-height: 250px;
            margin-top:  140px ;
        }
        .logo-box #home{
            left: 90%;
            direction: rtl;
            font-size: 17px;
            padding-left: 10px;
        }
        .logo-box #home a{
            text-decoration: none;
            color:#4d4d4d ;
            font-size: 15px;
            padding-right: 7px;
            font-family: 'iran-sans';
        }
    </style>
    <?php require_once "connection/connect.php"?>
    <?php require_once "connection/common.php"?>
    <?php

    function isUserPass($password){
        global $connect,$users;
        $sql=("SELECT `token` FROM `$users` WHERE `token`=?");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$password);
        $result->execute();
        if($result->rowCount()){
            return $result;
        }
        return false;

    }

    function resetPass($password,$resetPassword){
        global $connect,$users;
        $password=hashData($password,'sha1');
        $resetPassword=sanitize($resetPassword);
        $sql=("UPDATE `$users` SET `password`=? WHERE `token`=?");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$password);
        $result->bindValue(2,$resetPassword);
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
        <i class="fa fa-phone" id="call"><span>72904</span></i>
        <i class="fa fa-home" id="home"><a href="store.php" class="home">خانه</a></i>

    </div>
    <div class="center">
        <img src="pic/logo.png" alt="">
    </div>
</div>

<div class="card-form">
    <div class="form-box">

        <div class="submit-box">بازیابی رمز عبور<i class="fa fa-lock"></i></div>

        <div class="form-input">
            <form action="" method="post">

                <input type="password" name="new_password" placeholder="رمز عبور جدید" autocomplete="off" class="input">
                <input type="password" name="repeat_new_password" placeholder="تکرار رمز عبور جدید" autocomplete="off" class="input">


                <input type="submit" value="تغییر رمز"  name="change" class="submit">


            </form>

        </div>
    </div>



    <?php

    $change=null;
    $errors=array();
    $hasError=false;


    if(isset($_GET['pass']) and !empty($_GET['pass'])){
        $change=isUserPass($_GET['pass']);

        if(isset($_POST['change'])){
            if(!empty($_POST['new_password']) and !empty($_POST['repeat_new_password']) and strlen($_POST['new_password'])>=7 and strlen($_POST['repeat_new_password'])>=7 and $_POST['repeat_new_password']==$_POST['new_password']){

               $change=resetPass($_POST['new_password'],$_GET['pass']);
               if($change){
                   echo '<script>
                   $(function() {
                      swal({text:"رمز عبور با موفقیت تغییر یافت", icon:"success", button:"بستن",timer:5000  }) });
                    </script>';
               }

            }
            else{

                if(empty($_POST['new_password'])){
                    $hasError=true;
                    $errors[]='لطفا رمز عبور خود را وارد نمایید';
                }
                if(empty($_POST['repeat_new_password'])){
                    $hasError=true;
                    $errors[]='لطفا تکرار رمز عبور خود را وارد نمایید';
                }
                if(empty($_POST['new_password'])<7){
                    $hasError=true;
                    $errors[]='رمز عبور نمی تواند کمتر از 7 کاراکتر باشد';
                }
                if(empty($_POST['repeat_new_password'])<7){
                    $hasError=true;
                    $errors[]=' تکرار رمز عبور نمی تواند کمتر از 7 کاراکتر باشد';
                }
            if($_POST['repeat_new_password']!=$_POST['new_password']){
                $hasError=true;
                $errors[]='رمز عبور با تکرار آن یکسان نیست';
            }

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


