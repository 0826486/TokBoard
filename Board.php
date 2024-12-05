<?php
// 사용자가 입력한 값 받아오기
$username = $_POST['username'];
$title = $_POST['title'];
$grade = $_POST['grade'];
$phone = $_POST['phone'];
$detail = $_POST['detail'];
$file = $_FILES['file'];

// DB 연결
include('./conn.php');

// 쿼리 날리기
$sql = "insert into board(username, title, grade, phone, detail, file) values('$username', '$title', '$grade', '$phone', '$detail', '$file')";
mysqli_query($conn, $sql);

?>