<?php

namespace App\Services\Files;

use App\Contracts\FileUploader;
use App\Exceptions\FileSaveException;
use Illuminate\Support\Facades\File as SystemFile;

abstract class BaseFileUploader implements FileUploader
{
    /**
     * File uploader properties.
     * 
     * @var \App\Contracts\UploaderProperties
     */
    protected $uploader;

    /**
     * Creates a new file handler service.
     * 
     * @param \App\Contracts\UploaderProperties $uploader
     */
    public function __construct($uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * Performs the validation that has to be done before saving the file.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateBeforeSave()
    {
        return true;
    }

    /**
     * Validates the file at the given path after saving the file.
     * 
     * @param string $full_path
     * @throws \Exception on failed validation
     */
    public function validateAfterSave($full_path)
    {
        if (!SystemFile::exists($full_path)) {
            throw new FileSaveException('Error saving file');
        }
    }

    /**
     * Performs validation on the mime and file size.
     * 
     * @param \Symfony\Component\HttpFoundation\File\File $file
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateMimeAndSizeOfFile($file)
    {
        $mime_rule = 'mimes:' . implode(',', $this->uploader->allowedMimes());
        $size_rule = 'max:' . $this->uploader->allowedSize();

        validator(
            ['file' => $file],
            ['file' => [$mime_rule, $size_rule]]
        )->validate();
    }
}
