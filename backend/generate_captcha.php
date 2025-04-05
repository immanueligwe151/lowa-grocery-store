<?php
session_start();

$captchas = [
    'image1.jpg' => 'Aeik2',
    'image2.jpg' => 'ecb4f',
    'image3.jpg' => '7plBJ8',
    'image4.jpg' => '24qu3'
];

$captchaImage = array_rand($captchas);
$captchaCode = $captchas[$captchaImage];

$_SESSION['captcha_answer'] = $captchaCode;

echo json_encode(['image' => $captchaImage]);
?>