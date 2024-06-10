<?php
include "../connect.php";

// Assuming filterReq is a function to sanitize the input
$courseName = filterReq('name');
$TeacherId = filterReq('Teacher_id');

// Check if the teacher exists
$stmt = $con->prepare("SELECT COUNT(*) FROM `teacher` WHERE `id` = ?");
$stmt->execute(array($TeacherId));
$teacherExists = $stmt->fetchColumn();

if (!$teacherExists) {
    die(json_encode(array("status" => "fail", "message" => "Invalid Teacher ID")));
}

// Prepare the INSERT statement
$stmt = $con->prepare("INSERT INTO `courses` (`name`, `Teacher_id`) VALUES (?, ?)");

try {
    $stmt->execute(array($courseName, $TeacherId));
    echo json_encode(array("status" => "success"));
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { 
        echo json_encode(array("status" => "fail", "message" => "This teacher is already associated with a course"));
    } else {
        echo json_encode(array("status" => "fail", "message" => $e->getMessage()));
    }
}
?>
