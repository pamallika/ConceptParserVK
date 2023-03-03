<?php

namespace App\jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DownloadImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue,Queueable, SerializesModels;

    public function __construct(string $pathToImage, string $email)
    {
        $this->pathToImage = $pathToImage;
        $this->email = $email;
    }
    public function handle()
    {
        try {
            //download image
            header('Content-Type: image/png');
            readfile($this->pathToImage);
            //Для работы почты нужно настроить конфиги сервера поты в файле конфигов .env в корне
            Mail::send(['text' => 'mail'], ['path' => $this->pathToImage], function (string $message)
            {
                $message->to($this->email)->subject('Download images');
                $message->from('VK Group');
            });
        } catch (\Error $message) {
            Log::error($message);
        }
    }
}
