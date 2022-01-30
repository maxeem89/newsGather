<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSettingRequest extends FormRequest
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
                    'category_id' => 'required|exists:categories,id',
                    ];
            case "PUT":
            case "PATCH":

                return [

                ];
        }

    }
}
