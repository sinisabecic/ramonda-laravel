<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false; //? ne moze niko ko nije autorizovan
        return true; //? moze svako
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * ? Ovo je posebni Validator koji sam napravio za kreiranje posta
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts,title|max:255',
            'content' => 'required'
        ];
    }
}
