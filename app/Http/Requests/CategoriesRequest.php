<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriesRequest extends FormRequest
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
        switch ($this->method()) {
            case "POST":
                return [

                    'name' => ['required', 'max:255', 'min:3',
                        Rule::unique('categories')->where(function ($query) {
                            return $query->where('name', $this->name)
                                ->where('resources_id', $this->resources_id);
                        }),],
                    'sub_link' => 'required|min:3',
                    'resources_id' => ["required",
                        Rule::unique('categories')->where(function ($query) {
                            return $query->where('sub_link', $this->sub_link)
                                ->where('resources_id', $this->resources_id);
                        }),],
                    'target_element' => "required_if:api,0",
                    'regex' => "required_if:api,0",
                    'target_news_title' => "required_if:api,0",
                    'target_news_body' => "required_if:api,0",
                ];
            case "PUT":
            case "PATCH":

                return [
                    'name' => ['required', 'max:255',
                        Rule::unique('categories')->where(function ($query) {
                            return $query->where('name', $this->name)
                                ->where('resources_id', $this->resources_id)
                                ->whereNotIn('id', [$this->id]);
                        }), 'min:3'],
                    'sub_link' => 'required|min:3',
                    'resources_id' => ["required",
                        Rule::unique('categories')->where(function ($query) {
                            return $query->where('sub_link', $this->sub_link)
                                ->where('resources_id', $this->resources_id)
                                ->whereNotIn('id', [$this->id]);
                        }),],
                    'target_element' => "required_if:api,0",
                    'regex' => "required_if:api,0",
                    'target_news_title' => "required_if:api,0",
                    'target_news_body' => "required_if:api,0",
                ];
        }

    }
}
