<?php

namespace App\Entity\User;


use App\Traits\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\User\PermissionRoles
 *
 * @method static count()
 * @property int $permission_id
 * @property int $role_id
 * @property string|null $test
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\PermissionRoles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\PermissionRoles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\PermissionRoles query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\PermissionRoles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\PermissionRoles wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\PermissionRoles whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\PermissionRoles whereTest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\PermissionRoles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PermissionRoles extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'permission_roles';
}
