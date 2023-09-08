<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TelegramService;
use GuzzleHttp\Client;

class TelegramController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function getUpdates()
    {
        $updates = $this->telegramService->getUpdates();
        return response()->json($updates);
    }

    public function getFile($file_id)
    {
        $response = $this->client->get('getFile', [
            'query' => [
                'file_id' => $file_id,
            ],
        ]);
    
        return json_decode($response->getBody(), true);
    }
    
    

    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required',
            'message' => 'required',
        ]);

        $chatId = $request->input('chat_id');
        $message = $request->input('message');

        $response = $this->telegramService->sendMessage($chatId, $message);

        return response()->json($response);
    }

    public function checkUpdates()
    {
        $updates = $this->telegramService->getUpdates();

        foreach ($updates['result'] as $update) {
            if (isset($update['message']['photo'])) {
                $lastPhoto = end($update['message']['photo']);
                $file_id = $lastPhoto['file_id'];
                
                $this->downloadPhoto($file_id);
            }
        }
    }

    protected function downloadPhoto($file_id)
    {
        $fileDetails = $this->telegramService->getFile($file_id);
        
        // Construir a URL do arquivo
        $file_path = $fileDetails['result']['file_path'];
        $file_url = "https://api.telegram.org/file/bot{$this->telegramService->getBotToken()}/{$file_path}";
        
        // Baixar a foto
        $client = new Client();
        $client->get($file_url, ['sink' => 'path/to/save/image.jpg']);
    }
}
