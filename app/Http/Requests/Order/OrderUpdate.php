<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OrderUpdate
 * @package App\Http\Requests\Order
 *
 * @OA\Schema(
 *     title="OrderUpdateRequest",
 *     schema="OrderUpdateRequest",
 *     description="The request to update order"
 * )
 */
class OrderUpdate extends FormRequest
{
    /**
     * @OA\Property(
     *   format="integer",
     *   description="client_id",
     *   title="client_id"
     * )
     * @var integer
     */
    private $client_id;

    /**
     * @OA\Property(
     *   format="array",
     *     @OA\Items(
     *          type="integer",
     *          @OA\Items()
     *      ),
     *   description="products",
     *   title="products"
     * )
     * @var array
     */
    private $products;

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
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array',
            'products.*' => ['product_id' => 'exists:products,id'],
        ];
    }
}
