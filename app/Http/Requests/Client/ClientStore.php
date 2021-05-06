<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ClientStore
 * @package App\Http\Requests\Client
 *
 * @OA\Schema(
 *     title="ClientStoreRequest",
 *     schema="ClientStoreRequest",
 *     description="The request to create Client"
 * )
 */
class ClientStore extends FormRequest
{
    /**
     * @OA\Property(
     *   format="string",
     *   description="name",
     *   title="name"
     * )
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *   format="email",
     *   description="email",
     *   title="email"
     * )
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *   format="string",
     *   description="phone",
     *   title="phone"
     * )
     * @var string
     */
    private $phone;

    /**
     * @OA\Property(
     *   format="string",
     *   description="date_birth",
     *   title="date_birth"
     * )
     * @var string
     */
    private $date_birth;

    /**
     * @OA\Property(
     *   format="string",
     *   description="address",
     *   title="address"
     * )
     * @var string
     */
    private $address;

    /**
     * @OA\Property(
     *   format="string",
     *   description="complement",
     *   title="complement"
     * )
     * @var string
     */
    private $complement;

    /**
     * @OA\Property(
     *   format="string",
     *   description="neighborhood",
     *   title="neighborhood"
     * )
     * @var string
     */
    private $neighborhood;

    /**
     * @OA\Property(
     *   format="string",
     *   description="zipcode",
     *   title="zipcode"
     * )
     * @var string
     */
    private $zipcode;

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
