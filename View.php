<?php
include('./conn.php');

// 게시판 데이터 조회 쿼리
$sql = "select * from board order by created_at desc";
$result = mysqli_query($conn, $sql);
$cnt = mysqli_num_rows($result);


?>