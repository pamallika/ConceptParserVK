<?php

namespace app;

use App\jobs\DownloadImages;
use App\jobs\SaveImageToDb;

class ImageHelper
{
    public function downloadImage(array $links, string $email):void
    {
        DownloadImages::dispatch($links, $email);
    }

    public function saveImageDb(array $links, string $name = ''):void
    {
        SaveImageToDb::dispatch($links, $name);
    }
}
