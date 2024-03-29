<?php
    session_start();
    include("connect.php");
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
                <li><a href="index.php?menu=com">หน้าหลัก</a></li>
                <li><a href="#">เกี่ยวกับ</a></li>
                <li><a href="newprod.php">เพิ่มสินค้า</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-left">
                <li  class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        สินค้าของเรา <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="showproduct.php?category=1">Amd</a></li>
                        <li><a href="showproduct.php?category=2">Intel</a></li>
                        <li><a href="showproduct.php?category=3">Kingson</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if(isset($_SESSION['id'])){
                ?>
                <li  class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="glyphicon glyphicon-user"></i>
                        <?php echo $_SESSION['name'];?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">โปรไฟล์</a></li>
                        <li><a href="#">รายการสั่งซื้อ</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">ออกจากระบบ</a></li>
                    </ul>
                </li>
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
    <div class="container text-center">
        <div class="jumbotron">
            <h1>JOJO Shop</h1>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem inventore minima quae aperiam officiis nihil quas officia vel ducimus harum dignissimos sequi ex eveniet blanditiis ipsam, asperiores, esse autem at.</p>
        </div>
    </div>
    <div class="container">
        <h2 class="text-center">Shop</h2>
        <div class="row">
        <?php
                $sql = "SELECT * FROM product ORDER BY id";
                $result = $conn->query($sql);
                if(!$result){
                    echo "Error during data retrieval" . $conn->error;
                }
                else{
                    //ดึงข้อมูล
                    while($prd=$result->fetch_object()){
            ?>        
                    <div class="col-lg-3 col-md-4 col-sm-6 col-sx-12">
                        <div class="thumbnail">
                            <a href="product.php?pid=<?php echo $prd->id; ?>">
                                <img src="img/<?php echo $prd->picture ?>"alt="">
                            </a>
                            <div class="caption">
                                <h3><?php echo $prd->name; ?></h3>
                                <p><?php  echo $prd->description; ?></p>
                                <p><strong>Price: <?php echo $prd->price ?></strong> บาท</p>
                                <p><Strong>Stock: </Strong><?php echo $prd->unitInStock;?></p>
                                <p>
                                    <a href="#" class="btn btn-success">Add to basket</a>
                                    <a href="editproduct.php?pid=<?php echo $prd->id ?>" class="btn btn-warning"><i class="glyphicon glyphicon-road"></i></a>
                                    <a href="deletproduct.php?pid=<?php echo $prd->id ?>" class="btn btn-danger lnkDelete"><i class="glyphicon glyphicon-trash"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".lnkDelete").click(function(){
                if(confirm("confirm delete?")){
                    return true;
                }else{
                    return false;
                }
            });
        });
    </script>
</body>
</html>