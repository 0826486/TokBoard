<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoardProject</title>
    <link rel="stylesheet" href="index.css">
    <style>
        h1 {
            text-align: center;
            margin-top: 40px;
        }

        .board-container {
            margin-top: 40px;
        }

        .board-item {
            margin: 20px auto;
            padding: 20px 15px;
            border: 1px solid #ddd;
            border-radius: 9px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            transition: transform 0.3s ease; 
        }

        .board-item p {
            margin-left: 20px;
            margin-bottom: 50px;
            margin-top: 40px;
        }

        .board-item:hover {
            transform: translateY(-9px);
        }
    </style>
</head>
<body>
    <table>
    <h1>🐸 게시판 🐸</h1>

    <div class="board-container">
        <div class="board-item">
            <p>제목 : </p>
            <p>이름 : </p>
            <p>학년 : </p>
            <p>내용 : </p>
            <p>사진 보기</p>
        </div>
    </div>
    <?php
    include('./conn.php');

    // 게시판 데이터 조회 쿼리
    $sql = "select * from board order by created_at desc";
    $result = mysqli_query($conn, $sql);
    $cnt = mysqli_num_rows($result);

    ?>
    </table>
</body>
