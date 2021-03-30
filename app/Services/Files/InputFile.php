<?php

namespace App\Services\Files;

class InputFile extends BaseFileUploader
{
    /**
     * The uploaded file.
     * 
     * @var \Symfony\Component\HttpFoundation\File\File
     */
    protected $file;

    /**
     * Creates a new request input file handler service.
     * 
     * @param \Symfony\Component\HttpFoundation\File\File $file
     * @param \App\Contracts\UploaderProperties $uploader
     */
    public function __construct($file, $uploader)
    {
        $this->file = $file;

        parent::__construct($uploader);
    }

    /**
     * Saves the form input file into uploads directory.
     * 
     * @return string relative url of the saved file.
     */
    public function save()
    {
        if (!$this->file) {
            return '';
        }
        // Get the filename loaded with timestamp. This also adds 
        // extension to the file name if it is missing.
        $file_name = $this->getFileName($this->file);

        // Move the file to upload directory. All the files are 
        // stored in the upload directory only.
        $this->file->move(public_path('/uploads'), $file_name);

        // Return the relative url to the file. Full urls are no 
        // good for the application, so stick to relative urls.
        return "/uploads/$file_name";
    }

    /**
     * Validates the uploaded file for mime type and max allowed size.
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateBeforeSave()
    {
        parent::validateBeforeSave();

        $this->validateMimeAndSizeOfFile($this->file);
    }

    /**
     * Gets the file name with timestamp attached to it. Certain files may not 
     * have an extension attached to it, so add the extension also to the filename.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    public function getFileName($file)
    {
        // Replace all the underscores in the filename
        // with dashes, so that the filenames are SEO friendly.
        $file_name = str_replace(['_', ' '], '-', $file->getClientOriginalName());

        // Remove all the special characters, except alphanumeric
        // and dashes.
        $file_name = preg_replace("/[^\w-]/", '', $file_name);

        // Replace the extension from the filename if it already have
        // extension attached to it in the name. We will add the extension
        // for all the files later.
        $file_name = str_replace($file->getClientOriginalExtension(), '', $file_name);

        // Remove the extension dot from the file if it
        // exists
        $file_name = rtrim($file_name, '.');

        // Attach the file extension to the filename. Might look like
        // an overkill, but had issues on testing when the file had no extension
        // attached to it.
        $file_name .= '.' . $file->getClientOriginalExtension();

        // Add the timestamp in front of the filename, so that
        // all the file uploads are unique.
        return $file_name = time() . '-' . $file_name;
    }
}
