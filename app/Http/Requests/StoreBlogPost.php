<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Validator;
class StoreBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts|max:255',
            'description' => 'required|max:100',
            'content' => 'required',
            'categoryId' => 'required',
            'image' => 'required|file|mimes:jpeg,bmp,png,jpg'
        ];
    }
 
}
