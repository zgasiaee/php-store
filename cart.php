<?php
session_start();

if(isset($_SESSION['action']) and isset($_SESSION['id']) and isset($_SESSION['quantity']) and isset($_SESSION['username'])){
        $action=$_SESSION['action'];
        $ID = $_SESSION['id'] ;
        $quantity= $_SESSION['quantity'];
        $username=$_SESSION['username'];
}
 if(isset($_GET['action'])){
    $action=$_GET['action'];
}
require_once 'connection/connect.php';
require_once 'connection/common.php';

if(!empty($action)) {
    switch($action) {

        case "add":
            if(!empty($quantity)) {
                $id=$ID;
                $result=infoById($id);
                while($productByCode=$result->fetch(PDO::FETCH_ASSOC)){
                    $itemArray = array($productByCode["code"]=>array('name'=>$productByCode["name"],'code'=>$productByCode["code"], 'id'=>$productByCode["id"], 'quantity'=>$quantity, 'price'=>$productByCode["price"], 'amount'=>$productByCode["amount"] ));
                    if(!empty($_SESSION["cart_item"])) {
                        if(in_array($productByCode["code"],array_keys($_SESSION["cart_item"]))) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                if($productByCode["code"] == $k) {
                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                    }
                                    $_SESSION["cart_item"][$k]["quantity"] += $quantity;
                                }
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        }
                    }  else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
            }
            break;

        case "remove":
            if(!empty($_SESSION["cart_item"])) {

                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k){
                        unset($_SESSION["cart_item"][$k]);
                    }
                    if(empty($_SESSION["cart_item"])){
                        unset($_SESSION["cart_item"]);
                    }

                }


            }
            break;

    }
}
?>
<?php

function infoById($id){
    global $connect,$tbl;
    $sql=("SELECT * FROM `$tbl` WHERE `id`=?");
    $result=$connect->prepare($sql);
    $result->bindValue(1,$id);
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
<HTML>
<HEAD>
    <TITLE>سبد خرید</TITLE>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="style/store.css">
    <link href="style/cart.css" type="text/css" rel="stylesheet" />
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="js/js.js"></script>
    <script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <style>
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
            position: absolute;
            top: 35%;
            left: 33%;
        }
       .user-box{
               flex-direction: row-reverse;
         }
       .user-box a,.user-box div{
           direction: ltr;
       }
       .login{
           direction: ltr;
       }

    </style>
</HEAD>
<BODY>


<div class="box">
    <div class="logo-box">
        <i class="fa fa-shopping-cart" id="cart"><span><?php if(isset($_SESSION['cart_item'])){echo count($_SESSION['cart_item']);} ?></span></i>
        <i class="fa fa-phone" id="call">
            <span>72904</span>
        </i>
        <div class="login">
            <span >ورود به حساب کاربری</span>
            <div class="login-page">
                <div class="login-box">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="text" name="username_log" placeholder="نام کاربری" autocomplete="off" class="input">
                            <span class="border"></span>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password_log" placeholder="رمز عبور" autocomplete="off" class="input">
                            <span class="border"></span>
                        </div>

                        <a  class="forget" href="resetPassword.php">فراموشی رمز عبور<i class="fa fa-lock"></i></a>
                        <input type="submit" value="ورود"  name="login" class="submit">
                        <a  class="forget submit-text" href="#">ثبت نام نکرده اید؟</a>
                        <a href="submit.php" class="submit">ثبت نام</a>
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
            <a href="#" class="shop"><i class="fa fa-shopping-cart" id="cart"><span><?php if(isset($_SESSION['cart_item'])){echo count($_SESSION['cart_item']);} ?></span></i></a>
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
</div>

<?php

$log=null;

if(isset($_POST['login'])){
    if(!empty($_POST['password_log']) and !empty($_POST['username_log'])){

        $log=login($_POST['username_log'],$_POST['password_log'],"ورود");

    if($_POST['username_log']=='modir'):?>

        <script>
            location.href="http://localhost/store/admin.php?tab=1"
        </script>

    <?php endif; ?>


    <?php
    if($log){

    echo '<script>
                           $(function() {  
                              swal({text:"با موفقیت وارد شدید", icon:"success", button:"بستن",timer:3000  }) })            
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
                             swal({text:"نام کاربری یا رمز عبور درست نیست", icon:"error", button:"بستن",timer:3000  }) })
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
        <a id="exit" href="?username=<?php echo $_SESSION['username']?>&exit=1">خروج</a>
        <a href="#" id="user_name"> <?php echo $_SESSION['username'] ;?>خوش آمدید  </a>
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
                login($_GET['username'],$_SESSION['realpass'],"خروج");
                header("Location:http://localhost/store/store.php");
            }
            ?>
        })
    </script>


<?php endif; ?>
<div class="name-group">سبد خرید</div>

<div id="shopping-cart">

    <?php
    if(isset($_SESSION["cart_item"])){
        $total_quantity = 0;
        $total_price = 0;
        ?>

        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <colgroup>
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 5%;">
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 5%;">
            </colgroup>
            <tbody>
            <tr class="tbl_header">
                <th >نام</th>
                <th >قیمت واحد</th>
                <th >جزییات سفارش</th>
                <th >تعداد</th>
                <th >جمع هزینه</th>
                <th>حذف</th>
            </tr>

            <?php
            foreach ($_SESSION["cart_item"] as $item){
               $item_price = $item["quantity"]*intval($item["price"]);
                ?>
                <tr class="body">
                    <td style="font-weight: 700"><?php echo $item["name"]; ?></td>
                    <td ><?php echo $item["price"] . ' ' . 'تومان' ?></td>
                    <td ><?php echo $item["amount"]?></td>
                    <td ><?php echo $item["quantity"]; ?></td>
                    <td ><?php echo  number_format($item_price,3) . ' ' . 'تومان'  ?></td>
                    <td class="remove"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><i class="fa fa-trash"></i></a></td>
                </tr>
                <?php
                $total_quantity += $item["quantity"];
                $total_price += (intval($item["price"])*$item["quantity"]);
                $_SESSION['totalPrice']=$total_price;
            }
            ?>
            </tbody>
        </table>
        <div class="price-total">مبلغ قابل پرداخت: <?php echo ' ' . number_format($total_price, 3) . ' ' . 'تومان'; ?></div>
        <?php
    } else {
        echo '<script>
                           $(function() {
                              swal({text:"سبد خرید شما خالی است", icon:"error", button:"بستن",timer:3000  }) })
                   </script>';
    }
    ?>

</div>


</BODY>
</HTML>