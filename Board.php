<?php
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$grade = isset($_POST['grade']) ? trim($_POST['grade']) : '';
$detail = isset($_POST['detail']) ? trim($_POST['detail']) : '';

$filePath = '';

include('./conn.php');

$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (!empty($_FILES['file']['name'])) {
    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
        $filePath = $targetFilePath
    } else {
        echo "<script>alert('파일 업로드에 실패하였습니다.'); history.back();</script>";
        exit;
    }
}

$sql = "INSERT INTO board (username, title, grade, detail, file) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssss", $username, $title, $grade, $detail, $filePath);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('작성 완료되었습니다.'); window.location.href='View.php';</script>";
} else {
    error_log("DB Insert Error: " . mysqli_error($conn));
    echo "<script>alert('작성에 실패하였습니다. 관리자에게 문의하세요.');</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
