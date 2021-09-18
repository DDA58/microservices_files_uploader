<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFilesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [];

        foreach ($this->files->all() as $input_name => $file) {
            $rules[$input_name] = 'required|file|max:1024';
        }

        return $rules;
    }
}
