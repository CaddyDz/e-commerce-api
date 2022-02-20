<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Token
 *
 * @property int $id
 * @property string $user_uuid
 * @property string $unique_id
 * @property string $token_title
 * @property bool|null $restrictions
 * @property string|null $permissions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $last_used_at
 * @property \Illuminate\Support\Carbon|null $refreshed_at
 * @method static \Illuminate\Database\Eloquent\Builder|Token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Token query()
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereRefreshedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereRestrictions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereTokenTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereUserUuid($value)
 * @mixin \Eloquent
 */
class Token extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jwt_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_uuid',
        'unique_id',
        'token_title',
        'restrictions',
        'permissions',
        'expires_at',
        'last_used_at',
        'refreshed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'restrictions' => 'boolean',
        'expires_at' => 'datetime',
        'last_used_at' => 'datetime',
        'refreshed_at' => 'datetime',
    ];
}
