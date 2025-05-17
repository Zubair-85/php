<?php
require_once("connection.php");
$error = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>
    
<?php 

if(isset($_POST["submit"])){
    extract($_POST);

    if(empty($name)){
        $error['name'] = "Product name is required";
    }

    if(empty($price)){
        $error['price'] = "Product price is required";
    }

    
    $image_name = $_FILES['image']['name'];
    $image_type = $_FILES['image']['type'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];


if(empty($image_name)){
    $error['image'] = "Image is required";
} 


    if($image_type == "image/jpg" || $image_type == "image/jpeg" || $image_type == "image/png") {
        
}else{
    $error['type'] = "image only accept jpg/jpeg/png format";
}

if($image_size > 1000000){
    $error['size'] = "Image size must be smaller than 1MB";
}




if(empty($error)){
    date_default_timezone_set("Asia/karachi");
    $image_name = date("Y-m-d_h-i-s") . "-" . $image_name;

$sql = "INSERT INTO products(name,price,image)VALUES('". $name ."', '". $price ."', '". $image_name ."')";

$data = mysqli_Query($conn, $sql);

if($data){
    if(move_uploaded_file($image_tmp_name, "image/". $image_name)){
        $msg = "Insert successfully and image uploaded";
    }else{
        $error["image"] = "image not move to folder";
    }
}else{
    die("Error". $conn->error);
}


}



}


?>


<div class="container mt-3">

<?php
if(!empty($msg)){
    ?>

<div class="alert alert-success alert-dismissible">
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
<strong>Success!</strong> <?php  echo $msg; ?>

</div>
<?php } ?>

















<div class="container">
    
<form action="" method="POST" enctype="multipart/form-data">


<h2 class="text-white bg-dark rounded text-center">ADD PRODUCTS</h2>

Name: <input type="text" name="name" id="name" class="form-control">

Price: <input type="text" name="price" id="price" class="form-control">

Image: <input type="file" name="image" id="image" class="form-control">
<br>
<input type="submit" name="submit" value="Upload" class="btn btn-primary w-100">











</form>
</div>





</body>
</html>