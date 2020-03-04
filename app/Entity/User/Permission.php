<?php

namespace App\Entity\User;

use App\Traits\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Entity\User\Permission
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Permission whereUpdatedAt($value)
 * @method static count()
 * @method static create(array $array)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\User\Role[] $rRoles
 * @property-read int|null $r_roles_count
 */
class Permission extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'permissions';

    public function rRoles()
    {
        return $this->belongsToMany(Role::class, PermissionRoles::getTableName())
            ->withPivot(['created_at', 'updated_at', 'test'])
            ->as('membership');
    }
}
