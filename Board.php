<?php
// 사용자가 입력한 값 받아오기
$name = $_POST['name'];
$title = $_POST['title'];
$grade = $_POST['grade'];
$phone = $_POST['phone'];
$detail = $_POST['detail'];
$file = $_FILES['file'];

// DB 연결
include('./conn.php');


?>