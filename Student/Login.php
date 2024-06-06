<?php
include"../connect.php";
$email=filterReq("email");
$password=md5($_POST['password']);

$stmt = $con->prepare("SELECT * FROM `student` WHERE email='$email' AND password='$password'");
$stmt->execute();
$data=$stmt->fetch(PDO::FETCH_ASSOC);
$count =$stmt->rowCount();
if($count>0)
{
    echo json_encode(array("status"=>"success","data"=>$data));
}
else
{
    printFail("Email Not exists");
}
    ?>