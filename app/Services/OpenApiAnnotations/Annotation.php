<?php
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API: Clients, Products and Orders",
 *      description="API: Client, Product and Orders",
 *      @OA\Contact(
 *          name="Fernando Marcelino",
 *          email="ffernandomarcelino@gmail.com",
 *          url="https://github.com/fernandoomarcelino"
 *
 *      ),
 *     @OA\License(
 *         name="Private",
 *         url="https://github.com/fernandoomarcelino"
 *     )
 * )
 */

/**
 *  @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="L5 Swagger OpenApi dynamic host server"
 *  )
 */


/**
 * @OA\ExternalDocumentation(
 *     description="Find out more about Swagger",
 *     url="http://swagger.io"
 * )
 */


/**
 * @OA\Schema(
 *     title="Validation Error response",
 *     schema="ValidationErrorResponse",
 *     description="The validation error response",
 *     @OA\Property(
 *       property="message",
 *       format="string",
 *       description="error message",
 *       title="message"
 *     ),
 *     @OA\Property(
 *       property="errors",
 *       format="array",
 *       description="validation errors in the format: Property name: validation error",
 *       title="errors",
 *       @OA\Items (
 *        format="object", type="object",
 *               @OA\Property(property="field", format="string",title="field"),
 *               @OA\Property(property="value", format="string",title="value")
 *           )
 *    )
 * )
 */




