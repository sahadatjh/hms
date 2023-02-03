<?php

namespace App\Services;


class FileUploadService
{
    public const DEFAULT_PATH    = 'dynamic-assets/user/profile/';
    public const USER_PHOTO      = 'dynamic-assets/user/profile/';
    public const SITE_LOGO       = 'dynamic-assets/logo/';
    public const FAVICON_SETTING = 'dynamic-assets/favicon/';
    public const HAJJI_PHOTO     = 'dynamic-assets/hajji-photo/';
    public const PASSPORT_IMAGE  = 'dynamic-assets/passport/';
    public const VISA_IMAGE      = 'dynamic-assets/visa/';
    public const AGENT_IMAGE     = 'dynamic-assets/agents/';


    public function upload($file, $filePath = '')
    {
        $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
        $fileLocation = ($filePath) ? $filePath : self::DEFAULT_PATH;
        $file->move(public_path($fileLocation), $fileName);
        return $fileName;
    }
    public function removeImg($img, $filePath = '')
    {
        if (empty($img)) return 'No image in this request';
        $path = ($filePath)  ? public_path($filePath) . $img : public_path(self::DEFAULT_PATH) . $img;
        if (file_exists($path)) unlink($path);
    }
}
