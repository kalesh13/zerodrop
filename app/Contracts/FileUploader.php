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

    /**
     * Returns true, if the uploaded file is an image or pdf conversion and
     * needs a resize.
     * 
     * @return bool
     */
    public function needsResize();

    /**
     * Check if this uploader restricts upload only to administrators. If so, 
     * determine whether the user is allowed to upload files through this uploader.
     * 
     * If no user is passed as argument, authenticated user is checked.
     * 
     * @param \App\Models\User $user
     * @return bool
     */
    public function isUploadAllowedForUser($user = null);
}
