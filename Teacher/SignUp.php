<?php
include"../connect.php";
$name=filterReq("name");
$email=filterReq("email");
$password=md5($_POST['password']);
//$Course_Id=filterReq("Course_Id");

$stmt = $con->prepare("SELECT * FROM `teacher` WHERE email=? OR name=?");
$stmt->execute(array($email,$password));
$count =$stmt->rowCount();
if($count>0)
{
    printFail("Email exists");
}
else{
    $stmt=$con->prepare("INSERT INTO `teacher`( `name`, `email`, `password`) VALUES (?,?,?)");
    $stmt->execute(array($name,$email,$password));
    $data=$stmt->fetch(PDO::FETCH_ASSOC);
    $count=$stmt->rowCount();
    if($count>0)
    {
        echo json_encode(array("status"=>"success"));
    }
    else{
        printFail("can't insert");
}
    
    }?>