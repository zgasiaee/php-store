<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="fa" />
    <title>Document</title>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="style/submit.css">
    <link rel="stylesheet" href="style/cart.css">
    <script src="node_modules/chart.js/dist/chart.js"></script>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <?php require_once "connection/connect.php"?>
    <?php require_once "connection/common.php"?>
    <?php require_once "connection/jdf.php"?>
    <?php

    global $connect;
    date_default_timezone_set("Asia/Tehran");

    function toPersianNum($number)
    {
        $number = str_replace("1","۱",$number);
        $number = str_replace("2","۲",$number);
        $number = str_replace("3","۳",$number);
        $number = str_replace("4","۴",$number);
        $number = str_replace("5","۵",$number);
        $number = str_replace("6","۶",$number);
        $number = str_replace("7","۷",$number);
        $number = str_replace("8","۸",$number);
        $number = str_replace("9","۹",$number);
        $number = str_replace("0","۰",$number);
        return $number;
    }

    function get_user_num(){
        global $connect,$users;

        $sql=("SELECT * FROM `$users` ");
        $result=$connect->prepare($sql);
        $result->execute();
        if($result->rowCount()){
            return $result->rowCount();
        }
        return  false;
    }

    function get_product_num(){
        global $connect,$tbl;

        $sql=("SELECT * FROM `$tbl`");
        $result=$connect->prepare($sql);
        $result->execute();
        if($result->rowCount()){
            return $result->rowCount();
        }
        return  false;
    }

    function get_product_num_group($groups){
        global $connect,$tbl;

        $sql=("SELECT * FROM `$tbl` WHERE `groups`=?");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$groups);
        $result->execute();
        if($result->rowCount()){
            return $result->rowCount();
        }
        return  false;
    }

    function delete($id){
        global $connect,$tbl;

        $sql=("DELETE FROM $tbl WHERE `id`=?");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$id);
        $result->execute();
        return $result;

    }

    function product($group){
        global $connect,$tbl;

        $sql=("SELECT * FROM $tbl WHERE `groups`=?");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$group);
        $result->execute();

        if($result->rowCount()){
            return $result;
        }

        return false;
    }

    function allProduct(){
        global $connect,$tbl;

        $sql=("SELECT * FROM $tbl ORDER BY `id` DESC");
        $result=$connect->prepare($sql);
        $result->execute();

        if($result->rowCount()){
            return $result;
        }

        return false;
    }


    $delete = null;
    if (isset($_GET["id"] ) and $_GET['action'] == 'remove') {

        $delete = delete($_GET["id"]);

        if ($delete) {
            echo '<script>
                   $(function() {
                      swal({text:"محصول موردنظر با موفقیت حذف شد", icon:"success", button:"بستن",timer:3000  }) })
                    </script>';
        }

    }

    function addProduct($name,$amount,$price,$code,$groups,$pic){
        global $connect,$tbl;

        $name=sanitize($name);
        $amount=sanitize($amount);
        $price=sanitize($price);
        $code=sanitize($code);

        $sql=("INSERT `$tbl` SET `name`=? , `amount`=? , `price`=? , `code`=? , `groups`=? , `pic`=? ");

        $result=$connect->prepare($sql);
        $result->bindValue(1,$name);
        $result->bindValue(2,$amount);
        $result->bindValue(3,$price);
        $result->bindValue(4,$code);
        $result->bindValue(5,$groups);
        $result->bindValue(6,$pic);
        $result->execute();
        return $result;
    }

    function selectData($id){
        global $connect,$tbl;
        $sql=("SELECT * FROM `$tbl` WHERE `id`=? ");
        $result=$connect->prepare($sql);
        $result->bindValue(1,$id);
        $result->execute();
        if($result->rowCount()){
            return $result;
        }
        return false;
    }


    if(isset($_POST["update"])) {

        $updateUser=null;

        if(!empty($_POST["name"]) and !empty($_POST["amount"]) and !empty($_POST["price"]) and !empty($_POST["code"])){

            function update($id,$name,$amount,$price,$code,$groups){
                global $connect,$tbl;

                $sql=("UPDATE `$tbl` SET `name`=? , `amount`=? , `price`=? , `code`=? , `groups`=?   WHERE `id`=?");

                $result=$connect->prepare($sql);
                $result->bindValue(1,$name);
                $result->bindValue(2,$amount);
                $result->bindValue(3,$price);
                $result->bindValue(4,$code);
                $result->bindValue(5,$groups);
                $result->bindValue(6,$id);
                $result->execute();
                return $result;
            }

            $updateUser=update($_GET['id'],$_POST["name"],$_POST["amount"],$_POST["price"],$_POST["code"],$_POST["groups"]);
            if($updateUser){
                echo '<script>
                   $(function() {
                      swal({text:"اطلاعات با موفقیت بروزرسانی گردید", icon:"success", button:"بستن",timer:3000  }) })
                    </script>';
                header("Location:http://localhost/store/admin.php?tab=2");
            }
            else{
                echo '<script>
                   $(function() {
                      swal({text:"بروزرسانی اطلاعات با شکست مواجه شد", icon:"error", button:"بستن",timer:3000  }) })
                    </script>';
            }

        }

    }

    function user_report(){
        global $connect,$tblLog;
        $sql=("SELECT * FROM `$tblLog` ");
        $result=$connect->prepare($sql);
        $result->execute();
        if($result->rowCount()){
            return $result;
        }
        return false;
    }

    function jalali($date=null){

        $array=explode(" ",$date);

        list($year,$month,$day) = explode("-",$array[0]);
        list($hour,$minute,$second) = explode(":",$array[1]);
        $time=mktime($hour,$minute,$second,$month,$day,$year);

        return jdate("تاریخ: Y/m/d  زمان:H:i:s",$time);

    }


    ?>

</head>
<body>

<div class="big-container">
<div class="left" >
<a href="store.php" class="left-header">خروج<i class="fa fa-power-off"></i></a>
    <?php

    if(isset($_GET['tab'])){
        switch ($_GET['tab']){

               case 1:?>
                <div class="info-box">
                    <div class="item-box" style=" background-color:#68a943;">
                        <div class="titel">
                            <div class="titel-number"><?php echo toPersianNum(get_user_num()) ?> </div>
                            <div class="titel-name"> تعداد کاربران</div>
                        </div>
                        <div class="icon"><i class="fa fa-user-friends"></i></div>
                    </div>
                    <div class="item-box" style=" background-color:#03add9;">
                        <div class="titel">
                            <div class="titel-number"><?php echo toPersianNum(get_product_num()) ?> </div>
                            <div class="titel-name"> تعداد محصولات</div>
                        </div>
                        <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                    </div>
                </div>
                <canvas id="myChart" style="width:95%;height: 400px;padding: 0 20px"></canvas>
              <?php break; ?>


                <?php case 2:?>
            <div class="container mt-5 d-flex align-items-center flex-column " id="table">
                <div class="row  w-100">
                    <div class="col-lg-12 ">

                        <div class="card ">
                            <div class="card-body">
                                <ul class="nav nav-pills nav-fill">
                                    <li class="nav-item">
                                        <a class="nav-link " href="?tab=2&groups=0">همه</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="?tab=2&groups=1">میوه</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="?tab=2&groups=2">سبزیجات</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="?tab=2&groups=3">ارگانیک</a>
                                    </li>

                                    <li class="nav-item">
                                        <form action="#" method="post">
                                            <div  type="submit" class="btn btn-success btn-sm px-2 new_item" >محصول<i class="fa fa-plus" style="padding-right: 7px;"></i></div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row w-100">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped" style="text-align: center;width: 80%;margin: 20px auto;font-size: 12px">
                                    <thead>
                                    <tr>
                                        <th scope="col">نام محصول</th>
                                        <th scope="col">جزییات سفارش</th>
                                        <th scope="col">قیمت</th>
                                        <th scope="col">دسته</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                    $find=null;

                                    if(isset($_GET["groups"]) and !empty($_GET["groups"])){
                                        $find=product($_GET["groups"]);
                                    }
                                    else {
                                        $find = allProduct();
                                    }
                                    if($find){
                                        $rows=$find->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($rows as $row):?>
                                            <tr>
                                                <th><?php echo $row["name"]?></th>
                                                <th><?php echo $row["amount"] ?></th>
                                                <th><?php echo $row["price"] . ' ' . 'تومان' ?></th>
                                                <th>
                                                    <?php
                                                    switch ( $row["groups"]){
                                                        case 1:echo '<span class="btn btn-sm btn-warning " style="font-size: 12px">میوه</span>';
                                                            break;
                                                        case 2:echo '<span class="btn btn-sm btn-success" style="font-size: 12px">سبزیجات</span>';
                                                            break;
                                                        case 3:echo '<span class="btn btn-sm btn-primary" style="font-size: 12px"> ارگانیک</span>';
                                                            break;

                                                    }
                                                    ?>
                                                </th>
                                                <th>
                                                    <a href="?tab=2&id=<?php echo $row["id"]?>&action=update" class="text-info px-1"><i class="fa fa-edit"></i></a>
                                                    <a href="?tab=2&id=<?php echo $row["id"]?>&action=remove" class="text-danger px-1 " ><i class="fa fa-trash"></i></a>
                                                </th>

                                            </tr>
                                        <?php endforeach;} else echo "<div class='alert alert-warning'>متاسفانه کاربری برای نمایش وجود ندارد</div>"?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    </form>
                </div>
            </div>

            <div class="card-form " id="new" style="display: none;">
                <div class="form-box" style=" margin: 0 270px 0 0 ">

                    <div class="submit-box"><i class="fa fa-shopping-cart"></i>اضافه کردن محصول جدید</div>

                    <div class="form-input">
                        <form action="" method="post" enctype="multipart/form-data">

                            <input type="text" name="name" placeholder=" نام محصول" autocomplete="off" class="input">
                            <input type="text" name="amount" placeholder="جزییات" autocomplete="off" class="input">
                            <input type="text" name="price" placeholder="قیمت" autocomplete="off" class="input">
                            <input type="text" name="code" placeholder="کد محصول" autocomplete="off" class="input">
                            <select name="groups" class="input">
                                <option value="1">میوه</option>
                                <option value="2">سبزیجات</option>
                                <option value="3">ارگانیک</option>
                            </select>
                            <input type="file" name="userFile" class="input"  >


                            <input type="submit" value="اضافه کردن"  name="submit" class="submit">

                        </form>
                    </div>
                </div>

                <?php

                $log=null;
                $exist=null;
                $fruits_count=get_product_num_group(1);
                $vegetable_count=get_product_num_group(2);
                $organic_count=get_product_num_group(3);


                if(isset($_POST['submit'])){

                    if(!empty($_POST['name']) and !empty($_POST['amount']) and !empty($_POST['price']) and !empty($_POST['code']) and !empty($_POST['groups']) ) {

                            $folder = null;
                            $count = null;
                            switch ($_POST['groups']) {
                                case 1:
                                    $folder = 'fruites';
                                    $count = $fruits_count;
                                    break;
                                case 2:
                                    $folder = 'vegetable';
                                    $count = $vegetable_count;
                                    break;
                                case 3:
                                    $folder = 'organic';
                                    $count = $organic_count;
                                    break;
                            }

                            $info = pathinfo($_FILES['userFile']['name']);
                            if ($info['extension'] == 'jpg') {
                                $ext = 'jpg';
                                $count = $count + 1;
                                $target = 'pic' . '/' . $folder . '/' . $count . '.' . $ext;
                                move_uploaded_file($_FILES['userFile']['tmp_name'], $target);
                                $pic = $folder . '/' . $count;

                                $log = addProduct($_POST['name'], $_POST['amount'], $_POST['price'], $_POST['code'], $_POST['groups'], $pic);

                                echo '<script>
                           $(function() {
                              swal({text:"اطلاعات با موفقیت ثبت گردید", icon:"success", button:"بستن",timer:5000  }) })
                                  </script>';
                            } else {
                                echo '<script>
                           $(function() {
                              swal({text:"باشد jpg فرمت  عکس باید ", icon:"error", button:"بستن",timer:5000}) })
                                      </script>';
                            }
                        }
                    }

                ?>

            </div>

            <div class="card-form" id="edit" style="flex-direction: row;display: none">
                <div class="form-box" style=" margin: 0 270px 0 0 ">

                    <div class="submit-box"><i class="fa fa-shopping-cart"></i>ویرایش محصول</div>

                    <div class="form-input">
                        <form action="" method="post">

                            <?php
                            $update=null;
                            if(isset($_GET['id']) and $_GET['action'] == 'update'){
                                $update=selectData($_GET['id']);
                                $info=$update->fetch(PDO::FETCH_ASSOC);
                                echo '<script>
                                     $("#table").addClass("d-none").removeClass("d-flex")
                                     $("#edit").css("display","flex")
              
                                     </script>';
                            }
                            ?>

                            <input type="text" name="name" placeholder=" نام محصول" autocomplete="off" class="input" value="<?php echo $info['name'];?>">
                            <input type="text" name="amount" placeholder="جزییات" autocomplete="off" class="input" value="<?php echo $info['amount'];?>">
                            <input type="text" name="price" placeholder="قیمت" autocomplete="off" class="input" value="<?php echo $info['price'];?>">
                            <input type="text" name="code" placeholder="کد محصول" autocomplete="off" class="input" value="<?php echo $info['code'];?>">
                            <select name="groups" class="input" id="update">
                                <option value="1">میوه</option>
                                <option value="2">سبزیجات</option>
                                <option value="3">ارگانیک</option>
                            </select>

                            <script>
                                $(function () {
                                    $("#update option").each(function (index,element) {

                                        if($(element).attr("value") == <?php echo $info['groups']?>){

                                            $(element).attr("selected","selected");
                                        }
                                    })
                                })
                            </script>

                            <input type="submit" value="ویرایش"  name="update" class="submit">
                            <input type="submit" value="لغو"  name="cancel" class="submit" style="background-color: tomato;margin-top: 0px;" >

                            <?php if(isset($_POST['cancel'])): ?>
                            <script>
                                    $("#edit").css("display","none")
                                    $(".container").css("display","flex")
                                     location.href='http://localhost/store/admin.php?tab=2'
                            </script>
                            <?php endif; ?>
                        </form>

                    </div>
                </div>

            </div>

                <?php break; ?>

           <?php case 3:?>

            <div class="container mt-5 d-flex justify-content-center flex-row">
                <div class="row w-100">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped" style="font-size: 12px;text-align: center;">
                                    <thead>
                                    <tr>
                                        <th scope="col">شناسه کاربری</th>
                                        <th scope="col">IP</th>
                                        <th scope="col">نام کاربری</th>
                                        <th scope="col">ایمیل</th>
                                        <th scope="col">ساعت و تاریخ ورود</th>
                                        <th scope="col">مرورگر</th>
                                        <th scope="col">جزییات</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $find=null;
                                    $find=user_report(); ?>

                                    <?php if($find) {

                                        $rows=$find->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($rows as $row):?>

                                            <tr>
                                                <th><?php echo $row["userId"]?></th>
                                                <th><?php echo $row["userIp"]?></th>
                                                <th><?php echo $row["userName"]?></th>
                                                <th><?php echo $row["email"]?></th>
                                                <th><?php echo jalali($row["time"])?></th>
                                                <th><?php echo $row["browser"]?></th>
                                                <th><?php echo $row["detailes"]?></th>
                                            </tr>


                                        <?php endforeach;} ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php break; ?>

      <?php }} ?>


</div>
<div class="right">
    <div class="admin-header">کنترل پنل مدیریت</div>
    <div class="menue">
        <a href="?tab=1"  class="item-menue"><i class="fa fa-home"></i>صفحه اصلی</a>
        <a href="?tab=2" class="item-menue"><i class="fa fa-database"></i>مدیریت محصولات و انبار</a>
        <a href="?tab=3" class="item-menue"><i class="fa fa-user"></i>کاربران</a>
    </div>
</div>
</div>


<script>
    var xValues = ['فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند'];
    var yValues = [7,8,3,4,5,5,9,3,1,12,6,7];

    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                pointRadius: 2,
                borderColor: "rgba(255,0,0,0.5)",
                data: yValues,
                label: 'گزارش فروش سالیانه',
                tension: 0.1
            }]
        },

    });

    $(".nav-item .nav-link").addClass("text-secondary");
    $(".nav-link.active").removeClass("text-secondary").addClass("text-white").css("background-color","#777")

    $('.new_item').click(function () {

           $('#table').addClass('d-none').removeClass('d-flex')
           $('#new').css('display','flex');
           $('#edit').css('display','none');


       })


</script>
</body>
</html>



