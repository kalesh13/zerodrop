<?php

namespace App\Services\Files;

use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;

class UrlFile extends BaseFileUploader
{
    /**
     * The url from which files has to be saved.
     * 
     * @var string
     */
    protected $url;

    /**
     * Creates a new file handler that saves files from urls.
     * 
     * @param string $url
     * @param \App\Contracts\UploaderProperties $uploader
     */
    public function __construct($url, $uploader)
    {
        $this->url = $url;

        parent::__construct($uploader);
    }

    /**
     * Saves the file from url into downloads directory.
     * 
     * @return string relative url of the saved file.
     */
    public function save()
    {
        // Add timestamp to the filename. The file url's usually comes with 
        // file extension attached to it. So we won't be doing it.
        $filename = time() . '-' . basename($this->url);

        $path = public_path('downloads/' . $filename);

        // Because we are downloading files from the internet, we will use a 
        // seperate folder to save them. If the downloads folder does not exists, 
        // create the folder.
        if (!File::exists(public_path() . '/downloads/')) {
            File::makeDirectory(public_path() . '/downloads/');
        }

        // Download the files to the location.
        file_put_contents($path, file_get_contents($this->url));

        return '/downloads/' . $filename;
    }

    /**
     * Validates the file at the given path after saving the file.
     * 
     * @param string $full_path
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateAfterSave($full_path)
    {
        parent::validateAfterSave($full_path);

        $file = new SymfonyFile($full_path, false);

        return $this->validateMimeAndSizeOfFile($file);
    }
}
