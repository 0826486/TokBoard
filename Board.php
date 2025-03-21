<?php
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$grade = isset($_POST['grade']) ? trim($_POST['grade']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$detail = isset($_POST['detail']) ? trim($_POST['detail']) : '';

$filePath = '';

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // 파일명 중복 방지
    $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid('file_', true) . '.' . $fileExtension;
    $filePath = $uploadDir . $fileName;

    if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        error_log("파일 업로드 실패: " . $_FILES['file']['name']);
        echo "<script>alert('파일 업로드에 실패했습니다.'); window.history.back();</script>";
        exit;
    }
}

include('./conn.php');

// SQL 인젝션 방지 및 데이터 입력
$sql = "INSERT INTO board (username, title, grade, phone, detail, file) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssss", $username, $title, $grade, $phone, $detail, $filePath);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('작성 완료되었습니다.'); window.location.href='View.php';</script>";
} else {
    error_log("DB Insert Error: " . mysqli_error($conn));
    echo "<script>alert('작성에 실패하였습니다. 관리자에게 문의하세요.');</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>