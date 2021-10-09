<?php


    namespace App\Lib\Interfaces;


    interface FileReader
    {
        public function getContentsOfFile(string $path): string;
        public function formatContentsOfFile(string $contents): array;
    }