<?php

namespace App\Services;

use GuzzleHttp\Client;

class TelegramService
{
    protected $client;
    protected $telegram_bot_token;

    public function __construct()
    {
        $this->telegram_bot_token = env('TELEGRAM_BOT_TOKEN');
        $this->client = new Client([
            'base_uri' => 'https://api.telegram.org/bot' . $this->telegram_bot_token . '/'
        ]);
    }

    public function sendMessage($chat_id, $message)
    {
        $response = $this->client->post('sendMessage', [
            'query' => [
                'chat_id' => $chat_id,
                'text' => $message
            ]
        ]);

        return json_decode($response->getBody());
    }

    public function getUpdates()
    {
        $response = $this->client->get('getUpdates');
        return json_decode($response->getBody());
    }

        
}
