<?php

interface ImageHelperInterface
{
    public function downloadImage(array $links, string $email): void;

    public function saveImageDb(array $links, string $name = ''): void;

}
