<?php
// DB 연결
include('./conn.php');

// 게시판 데이터 조회 쿼리
$sql = "SELECT * FROM board ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

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
            margin-bottom: 10px;
        }

        .board-item a {
            color: blue;
            text-decoration: underline;
        }

        .board-item:hover {
            transform: translateY(-9px);
        }
    </style>
</head>
<body>
<h1>🐸 게시판 🐸</h1>

<div class="board-container">
    <!-- DB에서 가져온 데이터 처리 -->
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="board-item">
                <p>제목: <?= htmlspecialchars($row['title']) ?></p>
                <p>이름: <?= htmlspecialchars($row['username']) ?></p>
                <p>학년: <?= htmlspecialchars($row['grade']) ?></p>
                <p>내용: <?= nl2br(htmlspecialchars($row['detail'])) ?></p>
                <p>
                    사진:
                    <!-- 만약에 사진을 안 올렸으면 없다고 보여주기 -->
                    <?php if (!empty($row['file'])): ?>
                        <a href="<?= htmlspecialchars($row['file']) ?>" target="_blank">사진 보기</a>
                    <?php else: ?>
                        없음
                    <?php endif; ?>
                </p>
            </div>
        <?php endwhile; ?>
    <!-- 등록된 게시물이 없으면 없다고 보이기 -->
    <?php else: ?>
        <p style="text-align:center">등록된 게시물이 없습니다.</p>
    <?php endif; ?>
</div>

<?php mysqli_close($conn); ?>
</body>
</html>
