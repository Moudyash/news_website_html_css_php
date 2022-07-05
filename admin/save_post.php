<?php
include "config.php";
$conn = mysqli_connect ("localhost", "root", "", "news-site") or die("Connection failed:" . mysqli_connect_error ());

if (isset($_FILES['fileToUpload'])) {
    $errors = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_temp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $array = explode ('.', $file_name);
    $file_ext = end ($array);
$extensions=array("jpeg","jpg","png");
if(in_array($file_ext,$extensions) === false){
    $errors []="this extension not allowed,please choose a JPG or PNG file";
}

if($file_size > 2097152){
    $errors []="File size must be 2mb or lower";

}
if (empty($errors) == true){
    move_uploaded_file ($file_temp,"upload/".$file_name);
}else{
    print_r ($errors);
    die();
}
}


session_start ();

$title = mysqli_real_escape_string ($conn, $_POST['post_title']);

$description = mysqli_real_escape_string ($conn, $_POST['post_title']);
$title = mysqli_real_escape_string ($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string ($conn, $_POST['category']);
$date = date ("d M,Y");
$author = $_SESSION['user_id'];
$sql = "INSERT INTO post(title,description,category,psot_date,author,post_img)
        VALUES('{$title}','{$description}','{$category}','{$date}','{$author}','{$file_name}')";
$sql1="UPDATE catrgory SET post =post+1 WHERE  category_id ={$category}";
if (mysqli_multi_query ($conn,$sql1)){
    header("Location: {$hostname}/admin/post.php");

}else echo "<div class='alert alert-danger'>Failed</div>";
?>
