<?php

namespace App\Services\Files;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Exceptions\FileSaveException;
use GuzzleHttp\Exception\RequestException;
use App\Services\Files\Uploaders\GeneralUploader;

class FileService
{
    /**
     * The name used in the request input for which a file has to be saved.
     * 
     * @var string
     */
    protected $file_field;

    /**
     * Creates a new file service that takes care of uploading files from requests
     * uploaded files, and/or from urls.
     * 
     * @param string filename from the request input.
     */
    public function __construct($file_field = 'file')
    {
        $this->file_field = $file_field;
    }

    /**
     * Uploads a file from the request and save it into the server.
     * 
     * @return string
     */
    public function uploadFromRequest(Request $request)
    {
        $uploader = $this->uploaderProperties($this->file_field);

        if ($request->hasFile($this->file_field)) {
            return $this->uploadFromFile(
                $request->file($this->file_field),
                $uploader
            );
        }
        $url = $request->input($this->file_field);

        if ($this->isUrlFile($url)) {
            return $this->uploadFromUrl($url, $uploader);
        }
        throw new FileSaveException('Unable to download files from the given url.');
    }

    /**
     * Returns a file uploader for the given form name.
     * 
     * @return \App\Contracts\UploaderProperties
     */
    protected function uploaderProperties()
    {
        return (new GeneralUploader());
    }

    /**
     * Saves the file from uploaded file.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param \App\Contracts\UploaderProperties $uploader_properties
     */
    public function uploadFromFile($file, $uploader_properties)
    {
        $fileSaver = new InputFile($file, $uploader_properties);

        return $this->upload($fileSaver);
    }

    /**
     * Saves the file from a url.
     * 
     * @param string $url
     * @param \App\Contracts\UploaderProperties $uploader_properties
     */
    public function uploadFromUrl($url, $uploader_properties)
    {
        $fileSaver = new UrlFile($url, $uploader_properties);

        return $this->upload($fileSaver);
    }

    /**
     * Uploads a file using the given file upload handler.
     * 
     * @param \App\Contracts\FileUploader $uploader
     * @return string
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public function upload($uploader)
    {
        try {
            $uploader->validateBeforeSave();

            $fullPath = public_path($uploader->save());

            $uploader->validateAfterSave($fullPath);

            return str_replace(public_path(), '', $fullPath);
        } catch (FileSaveException $e) {
            abort(422, ['errors' => [$this->form_name => [$e->getMessage()]]]);
        }
    }

    /**
     * Check if the form input is a valid url or not.
     * 
     * @param string $form_input
     * @return bool
     */
    public function isUrlFile($form_input)
    {
        if (!$form_input || !is_string($form_input)) {
            return false;
        }

        try {
            (new Client)->head($form_input);
            return $form_input;
        } catch (RequestException $e) {
        }
    }
}
