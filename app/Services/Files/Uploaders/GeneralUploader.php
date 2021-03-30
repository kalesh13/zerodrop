<?php

namespace App\Services\Files\Uploaders;

class GeneralUploader extends BaseUploaderProperties
{
    /**
     * The mimes supported by this uploader.
     * 
     * @return array
     */
    public function allowedMimes()
    {
        return ['jpeg', 'png', 'jpg', 'csv', 'txt', 'pdf', 'mp4', 'mov', 'ogg', 'qt'];
    }

    /**
     * The maximum allowed file size of this uploader.
     * 
     * @return int
     */
    public function allowedSize()
    {
        return 24576;
    }
}
