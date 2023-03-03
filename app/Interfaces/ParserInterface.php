<?php

interface ParserInterface
{
    public function getFlower():array;
    public function getTiltle():array;
    public function getDescription():array;
    public function getSpecies():array;
    public function getGenus():array;
    public function getPhotos();
    public function downloadImages():array;
    public function saveImagesToDb():array;

}
