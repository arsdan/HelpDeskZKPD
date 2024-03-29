<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key  = '7026580759:AAGgiEBzJo7JTiYm6J8qCcio5YbK-IokFWM';
$bot_username = '@help_desk_zkpd_bot';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e->getMessage();
}