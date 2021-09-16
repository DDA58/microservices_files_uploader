<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Services\Uploader;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Support\Facades\Validator;


class FileController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function upload(Request $request, Uploader $uploader): Response {
        foreach (array_keys($request->files->all()) as $file) {
            $validator = Validator::make($request->files->all(), [
                $file => 'required|file|max:1024',
            ]);

            $validator->validate();
        }

        $uploader->setUser(auth()->user())->upload();

        return response()->json($uploader->getStorage()->getCollection());
    }

    public function remove(File $file): Response {
        $file->delete();

        return response()->json(['message' => 'Removed']);
    }
}
