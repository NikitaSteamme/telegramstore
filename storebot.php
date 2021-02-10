<?php
include('vendor/autoload.php'); //Подключаем библиотеку
use Telegram\Bot\Api;
use RestClient\Client;


$telegram = new Api(''); //Устанавливаем токен, полученный у BotFather
$result = $telegram -> getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя

$text = $result["message"]["text"]; //Текст сообщения
$chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
$name = $result["message"]["from"]["username"]; //Юзернейм пользователя
$keyboard = [["Открыть"]]; //Клавиатура



if($text){
    if ($text == "/start") {
        $reply = "Добро пожаловать в бота-дворецкого! Если вы имеете доступ, пожалуйста, используйте 
        команду /open или кнопку \"Открыть\" на виртуальной клавиатуре для открытия двери. Вопросы по работе данного бота можно задать в Viber чате дома";
        $reply_markup = $telegram->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false ]);
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup ]);

    }elseif ($text == "/open" or $text == "Открыть") {

    }else{
        $reply = "В доступе отказано";
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'parse_mode'=> 'HTML', 'text' => $reply ]);
    }
}else{
    $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение." ]);
}
