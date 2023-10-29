<?php
header('Content-Type: text/html; charset=utf-8');
 
/* https://api.telegram.org/bot1759765759:AAF-Ug-nYjskb5j92ARpIK5srMd6Pb1S4bw/getUpdates,
где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */
 
//Переменная $name,$phone, $mail получает данные при помощи метода POST из формы
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$text = $_POST['message'];
 
//в переменную $token нужно вставить токен, который нам прислал @botFather
$token = "1978408271:AAF7IIoAYeqGN2YMPfH57s9P-XYygbPqRWE";

/* Принимаем значения UTM-меток */
$utm_source = $_POST['utm_source']; //полученное из формы name=utm_source
$utm_medium = $_POST['utm_medium']; //полученное из формы name=utm_medium
$utm_campaign = $_POST['utm_campaign']; //полученное из формы name=utm_campaign
$utm_content = $_POST['utm_content']; //полученное из формы name=utm_content
$utm_term = $_POST['utm_term']; //полученное из формы name=utm_term
$headers  = 'MIME-Version: 1.0' . "\r\n"; // заголовок соответствует формату плюс символ перевода строки
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // указывает на тип посылаемого контента
//mail($to, $tema, $message, $headers, $utm_source, $utm_medium, $utm_campaign, $utm_content, $utm_term); //отправляет получателю на емайл значения этих переменных
 
//нужна вставить chat_id (Как получить chad id, читайте ниже)
$chat_id = "-589511320";
 
//Далее создаем переменную, в которую помещаем PHP массив
$arr = array(
  'Имя пользователя: ' => $name,
  'Телефон: ' => $phone,
  'Email: ' => $email,
  'Сообщение: ' => $text,
  'Источник: ' => $utm_source,
  'Домен: ' => $utm_medium,
  'Название обьявления: ' => $utm_content,
  'Ключевое слово: ' => $utm_term,
  'Название компании: ' => $utm_campaign,
);
 
//При помощи цикла перебираем массив и помещаем переменную $txt текст из массива $arr
foreach($arr as $key => $value) {
  $txt .= "<b>".$key."</b> ".$value."%0A";
};
 
//Осуществляется отправка данных в переменной $sendToTelegram
$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
 
//Если сообщение отправлено, напишет "Thank you", если нет - "Error"
//if ($sendToTelegram) {
  //echo "";
//} else {
 // echo "Error";
//}


// Отправляем
if ($sendToTelegram) {
    $message = 'Данные отправлены!';
} else {
    $message = 'Ошибка отправки!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>
