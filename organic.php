<?php
session_start();
?>

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
    <link rel="stylesheet" href="style/jquery.bxslider.css">
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="js/js.js"></script>
    <script src="js/jquery.bxslider.js"></script>
    <script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .product-container{
            padding-top: 140px;
        }
        .name-group{
            width: 500px;
            height: 50px;
            border-radius: 40px;
            font-family: 'iran-sans';
            font-size: 20px;
            color: #fff3cd;
            text-align: center;
            line-height: 50px;
            background-color: #35a43f;
            margin: auto;
            margin-top: 50px;
        }
    </style>
    <?php require_once "connection/connect.php"?>
    <?php require_once "connection/common.php"?>
    <?php

    function info($group=1){
        global $connect,$tbl;
        $sql=("SELECT * FROM `$tbl` WHERE `groups`=? ");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$group);
        $result->execute();
        if($result->rowCount()){
            return $result;
        }
        return  false;
    }

    function login($username,$password,$det){
        global $connect,$users,$tblLog;

        $username=sanitize($username);
        $_SESSION['realpass'] =$password;
        $password=hashData($password,'sha1');

        $sql=("SELECT * FROM `$users` WHERE `username`=?  AND `password`=?");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$username);
        $result->bindValue(2,$password);
        $result->execute();

        if($result->rowCount()){
            $row=$result->fetch(PDO::FETCH_ASSOC);

            $sql=("INSERT `$tblLog` SET `userId`=? ,`userIp`=? , `browser`=? , `email`=? , `userName`=? , `detailes`=? ");
            $result=$connect->prepare($sql);

            $result->bindValue(1,$row["id"]);
            $result->bindValue(2,$_SERVER["REMOTE_ADDR"]);
            $result->bindValue(3,browser($_SERVER["HTTP_USER_AGENT"]));
            $result->bindValue(4,$row["email"]);
            $result->bindValue(5,$row["username"]);
            $result->bindValue(6,$det);
            $result->execute();

            return $result;

        }
        return false;
    }

    ?>
</head>
<body>



<div class="box">
    <div class="logo-box">
        <i class="fa fa-shopping-cart" id="cart"></i>
        <i class="fa fa-phone" id="call">
            <span>72904</span>
        </i>
        <div class="login">
            <span >???????? ???? ???????? ????????????</span>
            <div class="login-page">
                <div class="login-box">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="text" name="username_log" placeholder="?????? ????????????" autocomplete="off" class="input">
                            <span class="border"></span>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password_log" placeholder="?????? ????????" autocomplete="off" class="input">
                            <span class="border"></span>
                        </div>

                        <a  class="forget" href="resetPassword.php">?????????????? ?????? ????????<i class="fa fa-lock"></i></a>
                        <input type="submit" value="????????"  name="login" class="submit">
                        <a  class="forget submit-text" href="#">?????? ?????? ?????????? ????????</a>
                        <a href="submit.php" class="submit">?????? ??????</a>
                    </form>

                </div>
            </div>
        </div>
        <i class="fa fa-user" id="user"></i>


    </div>
    <div class="center">
        <img src="pic/logo.png" alt="">
    </div>
    <div class="header">
        <div class="info-left">
            <a href="cart.php" class="shop"><i class="fa fa-shopping-cart" id="cart"></i></a>
            <a href="fruites.php">????????</a>
            <a href="vegetable.php">??????????????</a>
            <a href="organic.php">??????????????</a>
        </div>
        <div class="info-right">
            <i class="fab fa-instagram"></i>
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-telegram-plane"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-whatsapp"></i>
        </div>

    </div>
</div>


<?php

$log=null;

if(isset($_POST['login'])){
    if(!empty($_POST['password_log']) and !empty($_POST['username_log'])){

        $log=login($_POST['username_log'],$_POST['password_log'],"????????");

    if($_POST['username_log']=='modir'):?>

        <script>
            location.href="http://localhost/store/admin.php?tab=1"
        </script>

    <?php endif; ?>


    <?php
    if($log){

    echo '<script>
                           $(function() {  
                              swal({text:"???? ???????????? ???????? ????????", icon:"success", button:"????????",timer:3000  }) })            
                   </script>';
    ?>
        <script>
            location.href="http://localhost/store/store.php?username=<?php echo $_POST['username_log']?>"
        </script>
        <?php
    }

    else{
        echo '<script>
                          $(function() {
                             swal({text:"?????? ???????????? ???? ?????? ???????? ???????? ????????", icon:"error", button:"????????",timer:3000  }) })
                 </script>';
    }


    }
}

?>

<?php if(isset($_SESSION['username'])): ?>
    <script>
        $('.login ').css('display','none')
    </script>
    <div class="user-box">
        <a id="exit" href="?username=<?php echo $_SESSION['username']?>&exit=1">????????</a>
        <a href="#" id="user_name"> <?php echo $_SESSION['username'] ;?>?????? ??????????  </a>
    </div>

    <script>
        $('#exit').click(function () {
            $('.login ').css('display','block')
            $('#user_name ').css('display','none')
            $('.user-box input').css('display','none')
            <?php
            if(isset($_GET['exit'])){
                unset($_SESSION["cart_item"]);
                unset($_SESSION["username"]);
                login($_GET['username'],$_SESSION['realpass'],"????????");
                header("Location:http://localhost/store/store.php");
            }
            ?>
        })
    </script>


<?php endif; ?>

<div class="product-container" >
    <div class="name-group">??????????????</div>
    <div class="product-box" >

        <?php
        $group=null;

        $group=info(3);
        if($group){
            $rows=$group->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row):?>

                <div class="product">
                    <div class="product-img">
                        <img src="pic/<?php echo $row['pic'] ?>.jpg" alt="">
                    </div>
                    <div class="product-info">
                        <form method="post"  action="store.php?action=add&id=<?php echo $row["id"]; ?>&quantity=<?php if(isset($_POST['buy'])) { echo $_POST['quantity']; } ?>">
                            <div class="name"><?php echo $row['name'] ?></div>
                            <div class="price"> <?php echo $row['price'] .' '. '??????????' ?></div>
                            <div class="value">
                                <i class="fa fa-angle-left" data-id="decrease"></i>
                                <input  value="1" class="amount" name="quantity">
                                <i class="fa fa-angle-right" data-id="increase" ></i>
                            </div>
                            <input type="button" class="weight" value="<?php echo $row['amount'] ?>">

                            <input type="submit" class="buy" value="????????" name="buy">
                        </form>
                        <?php
                        if(isset($_POST['buy'])) {
                            echo '<script>
                          $(function() {
                             swal({text:"?????????? ???? ???????????? ???? ?????? ???????? ?????????? ????", icon:"success", button:"????????",timer:3000  }) })
                                 </script>';
                        }
                        ?>
                    </div>

                </div>
            <?php endforeach;} ?>
    </div>
</div>


</body>
</html>
