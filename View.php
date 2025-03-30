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
    <title>TokBoard</title>
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
            display: flex;
            align-items: center;
        }
        .board-item:hover {
            transform: translateY(-9px);
        }
        .board-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<h1>🐸 게시판 🐸</h1>
<div class="board-container">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="board-item">
                <?php if (!empty($row['file'])): ?>
                    <img src="<?= htmlspecialchars($row['file']) ?>" alt="게시물 이미지">
                <?php endif; ?>
                <div>
                    <p>제목: <?= htmlspecialchars($row['title']) ?></p>
                    <p>이름: <?= htmlspecialchars($row['username']) ?></p>
                    <p>학년: <?= htmlspecialchars($row['grade']) ?></p>
                    <p>내용: <?= nl2br(htmlspecialchars($row['detail'])) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center">등록된 게시물이 없습니다.</p>
    <?php endif; ?>
</div>

<?php mysqli_close($conn); ?>
</body>
</html>
