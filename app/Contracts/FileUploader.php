<?php

namespace App\Contracts;

interface FileUploader
{
    /**
     * Validates inputs before saving the file.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateBeforeSave();

    /**
     * Validates the file at the given path after saving the file.
     * 
     * @param string
     * @throws \Exception on failed validation
     */
    public function validateAfterSave($path);

    /**
     * Uploads and saves the file.
     * 
     * @return string relative url of the saved file.
     */
    public function save();
}
