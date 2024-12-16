<?php
// 사용자가 입력한 값 받아오기
$username = $_POST['username'];
$title = $_POST['title'];
$grade = $_POST['grade'];
$phone = $_POST['phone'];
$detail = $_POST['detail'];

// 파일 업로드 처리
$filePath = '';
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $upload = 'uploads/'; // 업로드 폴더 경로
    $fileName = basename($_FILES['file']['name']);
    $filePath = $upload . $fileName;

    // 업로드 폴더가 없는 경우 생성
    if (!is_dir($upload)) {
        mkdir($upload);
    }

    // 파일 이동
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        echo "<script>alert('파일 업로드 성공');</script>";
    } else {
        echo "<script>alert('파일 업로드 실패');</script>";
        $filePath = '';
    }
}

// DB 연결
include('./conn.php');

// SQL 인젝션 방지
$username = mysqli_real_escape_string($conn, $username);
$title = mysqli_real_escape_string($conn, $title);
$grade = mysqli_real_escape_string($conn, $grade);
$phone = mysqli_real_escape_string($conn, $phone);
$detail = mysqli_real_escape_string($conn, $detail);
$filePath = mysqli_real_escape_string($conn, $filePath);

// SQL 쿼리 작성
$sql = "insert into board (username, title, grade, phone, detail, file) values ('$username', '$title', '$grade', '$phone', '$detail', '$filePath')";

// 쿼리 실행 및 결과 확인
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('작성 완료 되었습니다.'); window.location.href='View.php';</script>";
} else {
    echo "<script>alert('작성 실패: " . mysqli_error($conn) . "');</script>";
}

// DB 연결 종료
mysqli_close($conn); 
?>