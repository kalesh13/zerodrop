<?php

namespace App\Services\Files\Uploaders;

use App\Contracts\UploaderProperties;

abstract class BaseUploaderProperties implements UploaderProperties
{
    /**
     * The maximum allowed file size of this uploader.
     * 
     * @return int
     */
    public function allowedSize()
    {
        return 8192;
    }

    /**
     * Returns the error message for invalid uploads. Certain filetypes are allowed 
     * for administrators only. If normal users try to upload those file types, this 
     * error has to be shown to them.
     * 
     * @return string
     */
    public function notAllowedMessage()
    {
        return 'Not authorized to upload files of type' . implode(', ', $this->allowedMimes());
    }
}
