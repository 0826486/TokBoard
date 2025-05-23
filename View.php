<?php
include('./conn.php');

$sql = "SELECT * FROM board ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TokBoard</title>
    <link rel="stylesheet" href="index.css" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Pretendard", sans-serif;
            background-color: #f9f7f3;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding-top: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #4e6c50;
            margin-bottom: 60px;
        }

        .board-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 0 20px 40px;
        }

        .board-item {
            background-color: #fffefc;
            border: 2px solid #e2d6c2;
            border-radius: 16px;
            box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            width: 100%;
            margin-bottom: 32px;
            padding: 24px;
            display: flex;
            gap: 24px;
            transition: all 0.2s ease;
        }

        .board-item:hover {
            transform: translateY(-5px);
            box-shadow: 6px 6px 20px rgba(0, 0, 0, 0.08);
        }

        .board-item img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 12px;
            flex-shrink: 0;
            border: 1px solid #ddd;
        }

        .board-item div {
            flex: 1;
        }

        .board-item p {
            margin: 6px 0;
            color: #333;
            line-height: 1.6;
        }

        .board-item p:first-child {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #3f4e4f;
        }

        .no-posts {
            font-size: 1.2rem;
            color: #888;
            margin-top: 60px;
        }

        .home-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .btn {
            background-color: #4e6c50;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .btn:hover {
            background-color: #3b5741;
        }
    </style>
</head>

<body>
    <h1>🐸 Tok 게시판 🐸</h1>

    <div class="home-btn">
        <a href="index.html" class="btn">홈으로 돌아가기</a>
    </div>

    <div class="board-container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="board-item">
                    <?php if (!empty($row['file'])): ?>
                        <img src="<?= htmlspecialchars($row['file']) ?>" alt="게시물 이미지" />
                    <?php endif; ?>
                    <div>
                        <p><?= htmlspecialchars($row['title']) ?></p>
                        <p>👤 이름: <?= htmlspecialchars($row['username']) ?></p>
                        <p>🎓 학년: <?= htmlspecialchars($row['grade']) ?></p>
                        <p>📝 내용: <?= nl2br(htmlspecialchars($row['detail'])) ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-posts">등록된 게시물이 없습니다.</p>
        <?php endif; ?>
    </div>

    <?php mysqli_close($conn); ?>
</body>

</html>