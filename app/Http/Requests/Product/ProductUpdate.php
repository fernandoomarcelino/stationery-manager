<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProductUpdate
 * @package App\Http\Requests\Product
 *
 * @OA\Schema(
 *     title="ProductUpdateRequest",
 *     schema="ProductUpdateRequest",
 *     description="The request to update product"
 * )
 */
class ProductUpdate extends FormRequest
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
     *   format="number",
     *   description="price",
     *   title="price"
     * )
     * @var double
     */
    private $price;

    /**
     * @OA\Property(
     *   format="string",
     *   description="image",
     *   title="image"
     * )
     * @var string
     */
    private $image;

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
            'price' => 'required|numeric|min:0',
            'image' => 'required|string|nullable',
        ];
    }
}
