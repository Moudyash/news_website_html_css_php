<?php
$hostname="http://localhost/news-site";

$conn=mysqli_connect("localhost","root","","news-site") or die("Connection failed:".mysqli_connect_error());

if(isset($_GET['name'])){
    $userid=$_GET['id'];
    $sql = "DELETE user WHERE user_id ={$userid}";
    if (mysqli_query ($conn,$sql)){
        header ("Location: {$hostname}/admin/users.php");

    }else{
        echo  "<p> cant Delete the User Record</p>";
    }
    mysqli_close ($conn);
}


?>