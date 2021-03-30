<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Files\FileService;

class FileController extends Controller
{
    /**
     * Public accessor for saving form input file. This endpoint is used for saving 
     * form input uploads.
     *
     * @return string
     */
    public function upload(Request $request)
    {
        $field_name = $request->upload_name ?: 'image';

        $service = new FileService($field_name);

        return [$field_name => $service->uploadFromRequest($request)];
    }
}
