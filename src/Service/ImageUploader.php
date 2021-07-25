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
     * @return string|null
     */
    public function upload(string $image, string $tmp): ?string
    {
        $localImage = self::PATH_TO_DIRECTORY;
        if (!empty($image)) {
            if (!ImageUploader::isExtensionAllowed($image)) {
                return null;
            }
            if (!move_uploaded_file($tmp, $localImage . $image)) {
                return null;
            }
        }
        return $image;
    }

    /**
     * Check if extension of uploaded file allowed
     *
     * @param string $image
     * @return bool
     */
    public static function isExtensionAllowed(string $image): bool
    {
        $fileType = pathinfo($image, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'PNG', 'JPG', 'JPEG');
        if (!in_array($fileType, $allowTypes)) {
            return false;
        }
        return true;
    }

}
