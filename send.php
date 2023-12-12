<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit();
}


//id бота
$token = "6940662203:AAHd3x20CI1IquypFzCNM5kFOw7n46wetyU";
//В chat_id вставляем id группы
$chat_id = "-1001919018003";

var_dump($_POST);
if ( ! empty( $_POST ) ) {
    $select  = htmlspecialchars($_POST['selforum']);
    $name  = htmlspecialchars($_POST['n']);
    $phone  = htmlspecialchars($_POST['t']);
    $email  = htmlspecialchars($_POST['e']);
    $company = htmlspecialchars($_POST['c']);
    $position = htmlspecialchars($_POST['p']);

    //Тело сообщения для отправки в телеграмм
    $txt = "Форум: $select %0A";
    $txt = "Имя: $name %0A";
    $txt .= "Телефон: $phone %0A";
    $txt .= "Email: $email";
    $txt = "Компания: $company %0A";
    $txt = "Должность: $position %0A";

    try {
        $headers = 'From: form@'.$site."\r\n".
                'X-Mailer: PHP/' . phpversion();

        //Передаем сообщение в телеграмм
        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

        if ( $mail && $sendToTelegram ) {
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