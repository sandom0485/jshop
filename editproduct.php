<?php
    session_start();
    include("connect.php");
    if(!isset($_GET['pid']) || $_GET['pid']==""){
        header("Location:index.php");
    }
    else{
        $pid = $_GET['pid'];
    }
    $sql="SELECT * FROM product WHERE id = $pid";
    $result = $conn->query($sql);
    if(!$result){
        echo "Error : " .$conn->error;
    }
    else{
        if($result->num_rows>0){
            $prd = $result->fetch_object();
        }
        else{
            $prd=NULL;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JOJO-Shop</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle nvigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">JOJO Shop</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                    <li><a href="#">หน้าแรก</a></li>
                    <li><a href="#">เกี่ยวกับ</a></li>
                    <li><a href="#">สิ้นค้า</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if(isset($_SESSION['id'])){
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="glyphicon glyphicon-user"></i>
                            ยินดีตอนรับ <?php echo $_SESSION['name'] ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="">โปรไฟล์</a></li>
                            <li><a href="">รายการสั่งซื้อ</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="logout.php">ออกจากระบบ </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-shopping-cart"></i> (0)
                        </a>
                    </li>
                    <?php
                        }
                        else{
                    ?>
                    <li><a href="login.php">เข้าสู้ระบบ</a></li>
                    <li><a href="#">สมัครสมาชิก</a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php include("connect.php");?>
        <div class="row">
            <div class="col-md-6">
                <div class="thumbnail">
                    <img src="img/<?php echo $prd->picture ?>"alt="">
                </div>
            </div>
        <div class="col-md-6">
            <form action="updatepoduct.php" class="form-horizontal" method= "post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="control-label col-md-3">Name : </label>
                <div class="col-md-9">
                    <input type="text"name="txtName" class="form-control" value="<?php echo $prd->name; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-3">Description : </label>
                <div class="col-md-9">
                    <textarea type="text" name="txtDescription" class="form-control"><?php echo $prd->description; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-3">Price : </label>
                <div class="col-md-9">
                    <input type="text"name="txtPrice" class="form-control" value="<?php echo $prd->price; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-3">Stock :</label>
                <div class="col-md-9">
                    <input type="text"name="txtStock" class="form-control" value="<?php echo $prd->unitInStock; ?>">
                </div>
            </div>  
            <div class="form-group">
                <label for="name" class="control-label col-md-3">Product picture : </label>
                <div class="col-md-9">
                    <input type="file" name="filePic" class="form-control-file" accept="img/*">
                </div>
            </div>
            <div class="form-group">
                <label for="picture" class="control-label col-md-3">Picture: </label>
                <div class="col-md-9">
                    <input type="radio" name="rdoType" value="amd" checked required> Amd</label>
                    <input type="radio" name="rdoType" value="intel"> Intel</label>
                    <input type="radio" name="rdoType" value="kingson"> Kingson</label>
                </div>
            </div> 
            <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                        <input type="hidden" name="hdnProductId" value="<?php echo $prd->id; ?>">
                    <button type="submit" class="btn btn-primary">Save </button>
                    <button type="reset" class="btn btn-danger">Reset </button>
                </div>
            </div>  
            </form>
        </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>