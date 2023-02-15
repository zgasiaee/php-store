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
            margin:  200px 450px 10px 0 ;
        }
        .form-box .form-input form .input{
            width: 50%;
            margin-bottom:30px;
        }
        .error-box{
            min-height: 250px;
            margin-top:  140px ;
        }
    </style>
    <?php require_once "connection/connect.php"?>
    <?php require_once "connection/common.php"?>
    <?php

    function email_exist($email){
        global $connect,$users;
        $email=sanitize($email);
        $sql=("SELECT `email` FROM `$users` WHERE `email`=?");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$email);
        $result->execute();
        if($result->rowCount()){
            return $result;
        }
        return false;
    }

    function send_email($email,$body,$subject){

        require_once "phpmailer/class.phpmailer.php";
        $mail=new PHPMailer(true);

        try {
            $mail->IsSMTP();
            $mail->Host="smtp.gmail.com";
            $mail->SMTPAuth=true;
            $mail->Username='zgasiaeee@gmail.com';
            $mail->Password='0024963909';
            $mail->SMTPSecure='ssl';
            $mail->Port=465;
            $mail->IsHTML(true);
            $mail->Subject=$subject;
            $mail->Body=$body;
            $mail->FromName='سایت فروش محصولات کشاورزی';
            $mail->CharSet='utf-8';
            $mail->AddAddress($email,"cue");
            $mail->ContentType="text/html;charset=utf-8";
            $mail->Send();

            echo '<script>
                   $(function() {
                      swal({text:"لینک فعال سازی با موفقیت ارسال شد", icon:"success", button:"بستن",timer:3000  }) })
                    </script>';

        }catch (Exception $error){
            echo '<script>
                   $(function() {
                      swal({text:"ایمیل ارسال نشد", icon:"error", button:"بستن",timer:3000  }) })
                    </script>';
        }
        $mail->SmtpClose();
        return $mail;
    }

    function reset_password($email,$password){
        global $connect,$users;
        $sql=("UPDATE `$users` SET  `token`=?  WHERE `email`=?");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$password);
        $result->bindValue(2,$email);
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

        <div class="submit-box">بازیابی رمز عبور<i class="fa fa-lock"></i></div>

        <div class="form-input">
            <form action="" method="post">

                <input type="text" name="email" placeholder="ایمیل" autocomplete="off" class="input">


                <input type="submit" value="بازیابی"  name="reset" class="submit">


            </form>

        </div>
    </div>



    <?php

    $log=null;
    $errors=array();
    $hasError=false;
    $exist=null;


    if(isset($_POST['reset'])){
        if(!empty($_POST['email']) and filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)  ){

            $exist=email_exist($_POST['email']);

            if($exist){
                echo '<script>
                           $(function() {
                              swal({text:"لینک فعال سازی با موفقیت ارسال شد", icon:"success", button:"بستن",timer:5000  }) })
              </script>';

                $time=round(microtime(true));
                $token=sha1($_POST["email"]) . $time;
                $setPass=$token;
                $subject="بازیابی کلمه عبور";
                $body='<<section style=" width: 650px; height: 300px; border-radius: 20px;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;background-color: #f7f7f7; margin: 150px auto;">
    <div style=" width: 100%;height: 70px; background-color: #43b64c; border-radius: 30px 0 30px 0;color: #ffffff; font-size: 20px; text-align: center; line-height: 70px;">درخواست بازیابی رمز عبور</div>
    <a href="http://localhost/store/newPassword.php?pass='.$setPass.'" style="  width: 100%; color: tomato; font-size: 20px; text-decoration: none; margin-top: 50px; text-align: center; cursor: pointer; display: block; font-weight: 600;">برای بازیابی رمز عبور خود اینجا را کلیک کنید</a>
    <span style=" width: 100%;color: #3a4047; font-size: 13px; text-decoration: none; margin-top: 80px; text-align: center; display: block;letter-spacing: 0.4px;">اگر این درخواست از طرف شما نبوده است لطفا آن را نادیده بگیرید</span>
</section>';
                $sendToken=send_email($_POST["email"],$body,$subject);
                reset_password($_POST['email'],$setPass);

            }
            else{
                echo '<script>
                           $(function() {
                              swal({text:"کاربری با این ایمیل ثبت نشده است", icon:"error", button:"بستن",timer:5000  }) })
              </script>';
            }

        }
        else{

            if(empty($_POST['email'])){
                $hasError=true;
                $errors[]='لطفا ایمیل خود را وارد نمایید';
            }
            if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                $hasError=true;
                $errors[]='لطفا فرمت ایمیل معتبر وارد نمایید';
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

