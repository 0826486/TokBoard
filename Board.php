<?php
$username = $_POST['username'];
$title = $_POST['title'];
$grade = $_POST['grade'];
$phone = $_POST['phone'];
$detail = $_POST['detail'];

$filePath = '';
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $upload = 'uploads/';
    $fileName = basename($_FILES['file']['name']);
    $filePath = $upload . $fileName;

    if (!is_dir($upload)) {
        mkdir($upload);
    }
}

include('./conn.php');

// SQL 인젝션 방지
$username = mysqli_real_escape_string($conn, $username);
$title = mysqli_real_escape_string($conn, $title);
$grade = mysqli_real_escape_string($conn, $grade);
$phone = mysqli_real_escape_string($conn, $phone);
$detail = mysqli_real_escape_string($conn, $detail);
$filePath = mysqli_real_escape_string($conn, $filePath);

$sql = "INSERT INTO board (username, title, grade, phone, detail, file) VALUES ('$username', '$title', '$grade', '$phone', '$detail', '$filePath')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('작성 완료 되었습니다.'); window.location.href='View.php';</script>";
} else {
    echo "<script>alert('작성 실패: " . mysqli_error($conn) . "');</script>";
}

mysqli_close($conn);
?>