<?php

namespace App\Services\Files\Uploaders;

class ImageUploader extends BaseUploaderProperties
{
    /**
     * The mimes supported by this uploader.
     * 
     * @return array
     */
    public function allowedMimes()
    {
        return ['jpeg', 'png', 'jpg'];
    }
}
