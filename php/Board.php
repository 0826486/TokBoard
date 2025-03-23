<?php
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$grade = isset($_POST['grade']) ? trim($_POST['grade']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$detail = isset($_POST['detail']) ? trim($_POST['detail']) : '';

$filePath = '';

// 파일 확장자 검증
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt'];
    $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "<script>alert('허용되지 않은 파일 형식입니다.'); window.history.back();</script>";
        exit;
    }
}

include('./conn.php');

$sql = "INSERT INTO board (username, title, grade, phone, detail) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssss", $username, $title, $grade, $phone, $detail);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('작성 완료되었습니다.'); window.location.href='View.php';</script>";
} else {
    error_log("DB Insert Error: " . mysqli_error($conn));
    echo "<script>alert('작성에 실패하였습니다. 관리자에게 문의하세요.');</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>