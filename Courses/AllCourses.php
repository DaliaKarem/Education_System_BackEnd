<?php
include "../connect.php";

try {
    $stmt = $con->prepare("SELECT courses.*, courses.name AS Course_name, teacher.name AS Teacher_name, teacher.email AS Teacher_email 
                           FROM courses 
                           JOIN teacher ON courses.Teacher_id = teacher.id");

    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo json_encode(array("status" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "fail"));
    }
} catch (PDOException $e) {
    echo json_encode(array("status" => "fail", "message" => $e->getMessage()));
}
?>
