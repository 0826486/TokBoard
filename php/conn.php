<?php
$host = 'localhost';    // DB 서버 주소
$id = 'root';           // 사용자 이름
$pass = '111111';       // 비밀번호
$db = 'testdb';         // 데이터베이스 이름

// DB 연결
$conn = mysqli_connect($host, $id, $pass, $db);

?>