<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientStore extends FormRequest
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
            'name' => 'required|string|max:256',
            'email' => 'required|unique:clients|email',
            'phone' => 'required',
            'date_birth' => 'required|date|date_format:Y-m-d',
            'address' => 'required|string|max:256',
            'complement' => 'required|string|max:256',
            'neighborhood' => 'required|string|string|max:256',
            'zipcode' => 'required|string',
        ];
    }
}
