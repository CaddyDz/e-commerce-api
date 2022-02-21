<?php

declare(strict_types=1);

namespace Docs;

/**
 * @OA\Post(
 *     tags={"admin"},
 *     path="/api/v1/admin/create",
 *     summary="Create an admin",
 *     security={ {"bearer": {}} },
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/x-www-form-urlencoded",
 *              @OA\Schema(
 *                  required={"first_name","last_name","email","password","password_confirmation","avatar","address","phone_number"},
 *                  type="object",
 *                  @OA\Property(
 *                     property="first_name",
 *                     description="Admin first name",
 *                     type="string"
 *                  ),
 *                  @OA\Property(
 *                     property="last_name",
 *                     description="Admin last name",
 *                     type="string"
 *                  ),
 *                  @OA\Property(
 *                     property="email",
 *                     description="Admin Email",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     description="Admin password",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="password_confirmation",
 *                     description="Admin password confirmation",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="avatar",
 *                     description="Admin Avatar image UUID",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="address",
 *                     description="Admin address",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="phone_number",
 *                     description="Admin phone number",
 *                     type="string"
 *                 ),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Page not found"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable Entity"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     ),
 * )
 */
class admin_create
{
}
