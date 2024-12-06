<?php
// 사용자가 입력한 값 받아오기
$username = $_POST['username'];
$title = $_POST['title'];
$grade = $_POST['grade'];
$phone = $_POST['phone'];
$detail = $_POST['detail'];

// DB 연결
include('./conn.php');

$sql = "insert into board (username, title, grade, phone, detail, file) values ('$username', '$title', '$grade', '$phone', '$detail', '$filePath')";
// 쿼리 실행
mysqli_query($conn, $sql);

echo "<script>alert('작성 완료 되었습니다.')</script>";

mysqli_close($conn); // DB 연결 종료
?>