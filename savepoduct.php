<?php
    include("connect.php");
    echo ini_get("upload_max_filesize")."<br>";
    $allowedType=["jpg","jpeg","gif","png","tif","tiff"];
    $fileType=explode("/",$_FILES["filePic"]["type"]);
    $size = $_FILES["filePic"]["size"]/1024/1024;

    if(!in_array($fileType[1],$allowedType)){
        //เมื่ออัพโหลดไฟล์ไม่ตรงกับ type ใน AllowedType
        echo "Non-image file is not allowed.";
    }
    else if($size>1.00){
        echo "File siz exceeds the meximum treshold";
    }


    else{
        $name = $_POST['txtName'];
        $decs = $_POST['txtDescription'];
        $price = $_POST['txtPrice'];
        $unitInStock = $_POST['txtStock'];
        $filename = $_FILES ['filePic']['name'];
        $cty = $_POST['rdoType'];
    

    move_uploaded_file($_FILES["filePic"]["tmp_name"],"img/".$_FILES["filePic"]["name"]);
    
    $sqlInsert = "INSERT INTO product (name,description,price,unitInStock,picture,category) VALUE('$name', '$desc', '$price', '$unitInStock', '$filename','$cty')";
    //echo $sqlInsert;
    $result = $conn->query($sqlInsert);
    if($result){
        echo "<script> alert('Inser Product Complete'); </script>"; 
        header("Location: index.php");
    }
    else{
        echo "Error during insert product: ".$conn->error;
    }
    /*$sqlInsert = "INSERT INTO product (name,description,price,unitInStock,picture) VALUES ('$name','$decs','$price','$unitInStock','$filename')";
    echo $sqlInsert;
    $result = $conn->query($sqlInsert);*/
    }
    /*echo "Type: " . $_FILES["filePic"]["type"] . "<br>";
    echo "Name: " . $_FILES["filePic"]["name"] . "<br>";
    echo "Size: " . $_FILES["filePic"]["size"] . "<br>";
    echo "Temp name: " . $_FILES["filePic"]["tmp_name"] . "<br>";
    echo "Error: " . $_FILES["filePic"]["error"] . "<br>";*/
?>
