<?php

namespace Service;

class ImageUploader
{

    private const PATH_TO_DIRECTORY = __DIR__ . '/../../public/download/images/';

    public function upload($image, $tmp): string|false
    {
        $localImage = self::PATH_TO_DIRECTORY;
        $fileType = pathinfo($image, PATHINFO_EXTENSION);
        if (!empty($image)) {
            $allowTypes = array('jpg', 'png', 'jpeg', 'PNG', 'JPG', 'JPEG');
            if (!in_array($fileType, $allowTypes)) {
                return false;
            }
            if (!move_uploaded_file($tmp, $localImage . $image)) {
                return false;
            }
        }
        return $image;
    }
}
