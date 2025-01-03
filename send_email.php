<?php
// Указываем, что возвращаем JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));

    // Проверяем, что все данные заполнены и корректны
    if (empty($name) || empty($phone) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Пожалуйста, заполните все поля корректно.'
        ]);
        exit;
    }

    // Настраиваем отправку письма
    $to = 'artbask@bk.ru'; // Замените на ваш email
    $subject = 'Новый запрос на обратный звонок';
    $message = "Имя: $name\nТелефон: $phone\nEmail: $email";
    $headers = "From: noreply@example.com\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8";

    // Пробуем отправить письмо
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode([
            'success' => true,
            'message' => 'Данные успешно отправлены.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка при отправке письма.'
        ]);
    }
} else {
    // Если запрос не POST, возвращаем ошибку
    echo json_encode([
        'success' => false,
        'message' => 'Метод запроса должен быть POST.'
    ]);
}
?>
