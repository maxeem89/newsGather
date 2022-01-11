<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourcesRequest extends FormRequest
{
    protected $redirect;
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
                    'name' => 'required|max:255|unique:resources,name|min:3',
                    'link' => 'required|unique:resources,link|min:3',
                    'api' => 'numeric',

                ];
            case "PUT":
            case "PATCH":
                return [
                    'name' => 'required|max:255|unique:resources,name,'.$this->id.',id|min:3',
                    'link' => 'required|unique:resources,link,'.$this->id.',id|min:3',
                    'api' => 'numeric'
                ];
        }

    }
}
