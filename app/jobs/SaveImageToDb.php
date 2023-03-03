<?php

namespace App\jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Image;

class SaveImageToDb
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(string $pathToImage, string $name)
    {
        $this->pathToImage = $pathToImage;
        $this->name = $name;
    }

    public function handle()
    {
        try {
            $files = new Image();
            $files->name = $this->name;
            $files->src = $this->pathToImage;
            $files->save();
        } catch (\Error $message) {
            Log::error($message);
        }
    }
}
