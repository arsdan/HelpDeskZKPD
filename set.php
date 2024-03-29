<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key  = '7026580759:AAGgiEBzJo7JTiYm6J8qCcio5YbK-IokFWM';
$bot_username = '@help_desk_zkpd_bot';
$hook_url     = 'https://vm589033.eurodir.ru/hook.php';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Set webhook
    $result = $telegram->setWebhook($hook_url);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    // echo $e->getMessage();
