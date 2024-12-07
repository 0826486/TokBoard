<?php

// 이미지 폴더 없으면 만들기
$uploads = 'up/';

if(!is_dir($uploads)) {
    mkdir($uploads);
}

?>