<?php

namespace App\Contracts;

interface UploaderProperties
{
    /**
     * The mimes supported by this uploader.
     * 
     * @return array
     */
    public function allowedMimes();

    /**
     * The maximum allowed file size of this uploader.
     * 
     * @return int
     */
    public function allowedSize();

    /**
     * Returns true if the file mime-type has to be allowed only by 
     * administrators.
     * 
     * @return bool
     */
    public function isAdministratorOnly();

    /**
     * Returns the error message for invalid uploads. Certain filetypes are allowed 
     * for administrators only. If normal users try to upload those file types, this 
     * error has to be shown to them.
     * 
     * @return string
     */
    public function notAllowedMessage();
}
