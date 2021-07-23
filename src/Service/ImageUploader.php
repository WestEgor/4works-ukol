<?php

namespace Service;

/**
 * Class ImageUploader
 * Class to upload image
 *
 * @package Service
 */
class ImageUploader
{

    /**
     * Path to uploaded images
     */
    private const PATH_TO_DIRECTORY = __DIR__ . '/../../public/download/images/';

    /**
     * Upload image
     *
     * @param $image
     * @param $tmp
     * @return string|false
     */
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
