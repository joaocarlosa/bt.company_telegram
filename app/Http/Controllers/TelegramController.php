<?php

namespace App\Http\Controllers;

use App\Models\Update;
use App\Models\Message;
use App\Models\Photo;
use App\Services\TelegramService;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

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
        $updates = json_decode(json_encode($updates), true);
        
        DB::beginTransaction();
        try {
            foreach ($updates['result'] as $update) {
                $this->processUpdate($update);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
        
        return response()->json(['status' => 'success', 'result' => $updates['result']]);
    }
    
    private function processUpdate($update)
    {
        if (Update::where('update_id', $update['update_id'])->doesntExist()) {
            $this->storeUpdate($update);
            $this->storeMessage($update);
            $this->storePhotos($update);
        }
    }
    
    private function storeUpdate($update)
    {
        Update::create(['update_id' => $update['update_id']]);
    }
    
    private function storeMessage($update)
    {
        Message::forceCreate([
            'message_id' => $update['message']['message_id'],
            'from_id' => $update['message']['from']['id'],
            'from_name' => $update['message']['from']['first_name'],
            'chat_id' => $update['message']['chat']['id'],
            'chat_name' => $update['message']['chat']['first_name'],
            'text' => $update['message']['text'] ?? null,
            'date' => $update['message']['date'],
        ]);
    }
    
    private function storePhotos($update)
    {
        if (isset($update['message']['photo'])) {

            usort($update['message']['photo'], function($a, $b) {
                return ($b['width'] * $b['height']) <=> ($a['width'] * $a['height']);
            });

            $largestPhoto = $update['message']['photo'][0];
            $filePath = $this->downloadAndSavePhoto($largestPhoto['file_id'], $largestPhoto['width'], $largestPhoto['height']);

            Photo::forceCreate([
                'file_id' => $largestPhoto['file_id'],
                'file_unique_id' => $largestPhoto['file_unique_id'],
                'file_size' => $largestPhoto['file_size'],
                'width' => $largestPhoto['width'],
                'height' => $largestPhoto['height'],
                'message_id' => $update['message']['message_id'],
                'file_path' => $filePath
            ]);
        }
    }

    private function downloadAndSavePhoto($fileId, $width, $height)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $client = new Client();

        $response = $client->get("https://api.telegram.org/bot{$botToken}/getFile?file_id={$fileId}");
        $response = json_decode((string) $response->getBody(), true);

        $fileTelegramPath = $response['result']['file_path'];

        $image = $client->get("https://api.telegram.org/file/bot{$botToken}/{$fileTelegramPath}")->getBody();

        $filePath = "public/telegram_photos/{$fileId}_{$width}x{$height}.jpg";
        Storage::put($filePath, $image);

        return $filePath; 
    }

    public function showPhotos()
    {
        $photos = Photo::all();

        
        return view('show-photos', ['photos' => $photos]);
    }

    

}
