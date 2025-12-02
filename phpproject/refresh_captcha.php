<?php
session_start();

function generateCaptcha() {
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $_SESSION['captcha_answer'] = $num1 + $num2;
    return "$num1 + $num2";
}

$newQuestion = generateCaptcha();

header('Content-Type: application/json');
echo json_encode(['question' => $newQuestion]);
?>