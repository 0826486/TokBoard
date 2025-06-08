<?php
session_start();
require_once 'conn.php';

$name = $_POST['name'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// 빈 값 검사
if (empty($name) || empty($username) || empty($password)) {
    echo "<script>alert('모든 항목을 입력해 주세요.'); history.back();</script>";
    exit;
}

// 비밀번호 해시 (보안 처리)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// 중복 아이디 검사
$stmt = $conn->prepare("SELECT * FROM board_join WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('이미 사용 중인 아이디입니다.'); history.back();</script>";
    exit;
}

// 회원 정보 저장
$stmt = $conn->prepare("INSERT INTO board_join (username, password, name) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashed_password, $name);

if ($stmt->execute()) {
    // 로그인 세션 저장
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $name;

    // index.html로 리디렉션
    header("Location: index.html");
    exit;
} else {
    echo "<script>alert('회원가입에 실패했습니다.'); history.back();</script>";
    exit;
}

?>