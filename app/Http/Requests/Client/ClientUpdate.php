<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ClientUpdate
 * @package App\Http\Requests\Client
 *
 * @OA\Schema(
 *     title="ClientUpdateRequest",
 *     schema="ClientUpdateRequest",
 *     description="The request to update Client"
 * )
 */
class ClientUpdate extends FormRequest
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
        $data = $this->all();
        return [
            'id' => 'required|exists:clients,id',
            'name' => 'required|string|max:256',
            'email' => 'required|email|unique:clients,email,' . $data['id'],
            'phone' => 'required',
            'date_birth' => 'required|date|date_format:Y-m-d',
            'address' => 'required|string|max:256',
            'complement' => 'required|string|max:256',
            'neighborhood' => 'required|string|string|max:256',
            'zipcode' => 'required|string',
        ];
    }
}
