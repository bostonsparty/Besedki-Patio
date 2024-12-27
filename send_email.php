<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));

    // Валидация данных
    if (empty($name) || empty($phone) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Некорректные данные.']);
        exit;
    }

    // Настройка почты
    $to = 'artbask@bk.ru'; // Замените на ваш email
    $subject = 'Новый запрос на обратный звонок';
    $message = "Имя: $name\nТелефон: $phone\nEmail: $email";
    $headers = "From: noreply@example.com\r\nContent-Type: text/plain; charset=utf-8";

    // Отправка письма
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Данные успешно отправлены.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка отправки письма.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неверный метод отправки.']);
}
?>
