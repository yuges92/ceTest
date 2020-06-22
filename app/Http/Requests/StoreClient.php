<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
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
            "firstName" => "required|max:255Ò",
            "lastName" => "required|max:255",
            "avatar" => "required|image|dimensions:min_width=100,min_height=100",
            "email" => "required|email",
        ];
    }
}
