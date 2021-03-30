<?php

namespace App\Services\Files\Uploaders;

class PdfUploader extends BaseUploaderProperties
{
    /**
     * The mimes supported by this uploader.
     * 
     * @return array
     */
    public function allowedMimes()
    {
        return ['pdf'];
    }
}
