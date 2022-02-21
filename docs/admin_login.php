<?php

declare(strict_types=1);

namespace Docs;

 /**
 * @OA\Post(
 *     tags={"admin"},
 *     path="/api/v1/admin/login",
 *     summary="Login an admin account",
 *     security={ {"bearer": {}} },
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/x-www-form-urlencoded",
 *              @OA\Schema(
 *                  required={"email","password"},
 *                  type="object",
 *                  @OA\Property(
 *                     property="email",
 *                     description="Admin email",
 *                     type="string"
 *                  ),
 *                  @OA\Property(
 *                     property="password",
 *                     description="Admin password",
 *                     type="string"
 *                  ),
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
class admin_login
{
}
