<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        $this->redirect = url()->previous();
        switch ($this->method()){
            case "POST":
                return [
                    'title' => 'required|max:255|:title,title|min:3',
                    'body' => 'required|unique:news,body|min:3',
                    'resources_id' => "required",
                    'categories_id' => "required"
                ];
            case "PUT":
            case "PATCH":

                return [
                    'title' => 'required|max:255|unique:news,title,'.$this->id.',id|min:3',
                    'body' => 'required|unique:news,body,'.$this->id.',id|min:3',
                    'resources_id' => "required",
                    'categories_id' => "required"
                ];
        }

    }
}
