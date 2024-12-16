<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoardProject</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <table>
    <?php
    include('./conn.php');

    // 게시판 데이터 조회 쿼리
    $sql = "select * from board order by created_at desc";
    $result = mysqli_query($conn, $sql);
    $cnt = mysqli_num_rows($result);

    ?>
    </table>
</body>
