<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit();
}


$token = "6940662203:AAHd3x20CI1IquypFzCNM5kFOw7n46wetyU";
$chat_id = "-1001919018003";

var_dump($_POST);
if ( ! empty( $_POST ) ) {
    $name  = htmlspecialchars($_POST['name']);
    $phone  = htmlspecialchars($_POST['tel']);
    $email  = htmlspecialchars($_POST['email']);
    $company  = htmlspecialchars($_POST['com']);
    $position  = htmlspecialchars($_POST['pos']);
    $select  = htmlspecialchars($_POST['select']);



    //Тело сообщения для отправки в телеграмм
    $txt = "Регистрация на $select %0A";
    $txt = "  %0A";
    $txt .= "Имя: $name %0A";
    $txt .= "Телефон: $phone %0A";
    $txt .= "Email: $email %0A";
    $txt .= "Компания: $company %0A";
    $txt .= "Должность: $position %0A";

    try {
        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

        if ( $sendToTelegram ) {
            echo json_encode('Спасибо! Ваша заявка принята. Мы свяжемся с вами в ближайшее время.');
        } else {
            echo json_encode('Ошибка отправки!');
        }

        die();

    } catch (Exception $e) {
        echo json_encode("Ошибка: $e->getMessage()");
    }
} else {
    echo json_encode("Тело сообщения пустое");
}
?>