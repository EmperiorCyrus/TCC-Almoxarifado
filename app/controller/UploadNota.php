<?php
namespace App\Controller;

date_default_timezone_set('America/Bahia');

class UploadNota
{
    private string $dir;
    private array $file;

    public function __construct( String $uploadDir)
    {
        $this->dir = $uploadDir;
        
    }

    public function upload($fileKey)
    {
        
        //exit(var_dump(is_uploaded_file($fileKey['tmp_name'])));

        if (!isset($fileKey['name']) || !is_uploaded_file($fileKey['tmp_name'])) {
            return false;
        }
        
        $this->file = $fileKey;        
        //exit(var_dump($this->file));
        $originalName = pathinfo($this->file['name'], PATHINFO_FILENAME);
        $newFilename = $this->generateUniqueFilename($originalName);
        

        $targetPath = "{$this->dir}/{$newFilename}";

        if (move_uploaded_file($this->file['tmp_name'], $targetPath)) {
            return $targetPath;
        }
    }   

    private function generateUniqueFilename(string $originalName): string
    {
        $suffix = "_" . rand(10000, 99999) . "_" . date("YmdHis");
        return $originalName . $suffix . "." . pathinfo($this->file['name'], PATHINFO_EXTENSION);
    }
}