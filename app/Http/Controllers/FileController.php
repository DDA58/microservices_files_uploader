<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Services\Uploader;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UploadFilesRequest;


class FileController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function upload(UploadFilesRequest $request, Uploader $uploader): Response {
        $uploader->upload();

        return response()->json($uploader->getStorage()->getCollection());
    }

    public function remove(File $file): Response {
        if ($file->user_id != auth()->user()->id) {
            abort(403);
        }

        $file->delete();

        return response()->json(['message' => 'Removed']);
    }
}
