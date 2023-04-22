<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

        "name"=>"required|between:3,255",
        "email"=>"required|unique:users,email,".$this->id,
        "bio"=>"required|max:500",
        "date_birth"=>"sometimes|required|after:01/01/1900|before:01/01/2000",
          "title"=>"sometimes|required|max:255",
        ];
    }

    public function messages()
    {
        return [


        ];
    }

}
