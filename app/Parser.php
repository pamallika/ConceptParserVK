<?php

namespace app;

use Illuminate\Support\Facades\Log;

class Parser
{
    /**
     * Путь к файлу XML
     * @param string $xml
     */
    public function __construct(string $xml)
    {
        $this->xml = simplexml_load_file($xml);
    }

    public function getFlower():array
    {
        try {
            $result = [];
            foreach ($this->xml->flowers as $flower) {
                $result[] = $flower;
            }
        } catch (\Error $message) {
            Log::error($message);
        } finally {
            return $result;
        }
    }
    public function getTiltle():array
    {
        try {
            $result = [];
            foreach ($this->xml->flowers as $flower) {
                $result[] = $flower->title;
            }
        } catch (\Error $message) {
            Log::error($message);
        } finally {
            return $result;
        }
    }
    public function getDescription():array
    {
        try {
            $result = [];
            foreach ($this->xml->flowers as $flower) {
                $result[] = $flower->description;
            }
        } catch (\Error $message) {
            Log::error($message);
        } finally {
            return $result;
        }
    }
    public function getSpecies():array
    {
        try {
            $result = [];
            foreach ($this->xml->flowers as $flower) {
                foreach ($flower->species as $species) {
                    $result[] = $species;
                }
            }
        } catch (\Error $message) {
            Log::error($message);
        } finally {
            return $result;
        }
    }
    public function getGenus():array
    {
        try {
            $result = [];
            foreach ($this->xml->flowers as $flower) {
                foreach ($flower as $genus) {
                    $result[] = $genus;
                }
            }
        } catch (\Error $message) {
            Log::error($message);
        } finally {
            return $result;
        }
    }
    public function getPhotos()
    {
        try {
            $result = [];
            $i = 1;
            $photoTagName = "photo$i";
            foreach ($this->xml->flowers as $flower) {
                while (isset($flower->$photoTagName)) {
                    $result[] = $flower->$photoTagName;
                    $i++;
                    $photoTagName = "photo$i";
                }
            }
        } catch (\Error $message) {
            Log::error($message);
        } finally {
            return $result;
        }
    }

}
