<?php
include('./conn.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$post_sql = "SELECT * FROM board WHERE id = $id";
$post_result = mysqli_query($conn, $post_sql);
$post = mysqli_fetch_assoc($post_result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $comment_sql = "INSERT INTO comments (post_id, name, content) VALUES ($id, '$name', '$content')";
    mysqli_query($conn, $comment_sql);
    header("Location: post.php?id=$id");
    exit();
}

$comment_sql = "SELECT * FROM comments WHERE post_id = $id ORDER BY created_at DESC";
$comment_result = mysqli_query($conn, $comment_sql);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>TokBoard</title>
    <style>
        body {
            font-family: 'Pretendard', sans-serif;
            background: #f9f7f3;
            padding: 40px;
            color: #333;
        }

        .post {
            background: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 40px;
            max-width: 800px;
            margin: 0 auto 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .post img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .post h2 {
            font-size: 1.8rem;
            margin-bottom: 12px;
        }

        .post p {
            margin: 8px 0;
        }

        .comment-box {
            max-width: 800px;
            margin: 0 auto 40px;
            padding: 20px;
            background: #fffefc;
            border: 1px solid #e2d6c2;
            border-radius: 12px;
        }

        .comment-box h3 {
            margin-bottom: 16px;
            color: #4e6c50;
        }

        .comment-box input,
        .comment-box textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .comment-box button {
            background: #4e6c50;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .comment-box button:hover {
            background: #3b5741;
        }

        .comment-list {
            max-width: 800px;
            margin: 0 auto;
        }

        .comment {
            background: #ffffff;
            border: 1px solid #ddd;
            padding: 16px;
            margin-bottom: 16px;
            border-radius: 8px;
        }

        .comment .name {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .back-btn {
            margin: 20px auto;
            display: block;
            text-align: center;
        }

        .back-btn a {
            text-decoration: none;
            background: #aaa;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .back-btn a:hover {
            background: #888;
        }
    </style>
</head>

<body>

    <div class="post">
        <?php if ($post): ?>
            <?php if (!empty($post['file'])): ?>
                <img src="<?= htmlspecialchars($post['file']) ?>" alt="이미지">
            <?php endif; ?>
            <h2><?= htmlspecialchars($post['title']) ?></h2>
            <p>👤 작성자: <?= htmlspecialchars($post['username']) ?> / 🎓 학년: <?= htmlspecialchars($post['grade']) ?></p>
            <p>📝 내용:</p>
            <p><?= nl2br(htmlspecialchars($post['detail'])) ?></p>
        <?php else: ?>
            <p>게시글을 찾을 수 없습니다.</p>
        <?php endif; ?>
    </div>

    <div class="comment-list">
        <h3>📋 댓글 목록</h3>
        <?php while ($comment = mysqli_fetch_assoc($comment_result)): ?>
            <div class="comment">
                <div class="name">💬 <?= htmlspecialchars($comment['name']) ?></div>
                <div class="content"><?= nl2br(htmlspecialchars($comment['content'])) ?></div>
                <div class="date" style="font-size: 0.85rem; color: #888;"><?= $comment['created_at'] ?></div>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="comment-box">
        <h3>댓글 남기기 🐸</h3>
        <form method="post">
            <input type="text" name="name" placeholder="닉네임" required />
            <textarea name="content" rows="4" placeholder="댓글을 입력하세요" required></textarea>
            <button type="submit">댓글 등록</button>
        </form>
    </div>

    <div class="back-btn">
        <a href="view.php">← 돌아가기</a>
    </div>

</body>

</html>