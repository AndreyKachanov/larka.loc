<?php

namespace App\Entity\User;

use App\Entity\BaseModel;
use App\Entity\Post;
use App\Traits\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\User\Role
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\User\User[] $rUsers
 * @property-read int|null $r_users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\User\Role whereUpdatedAt($value)
 * @method static count()
 * @method static create(array $array)
 * @method static first()
 * @method static find(int $int)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\Post[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entity\User\Permission[] $rPermissions
 * @property-read int|null $r_permissions_count
 */
class Role extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'roles';

    public function rUsers()
    {
        return $this->hasMany(User::class);
    }

    public function posts()
    {
        return $this->hasManyThrough(Post::class, User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rPermissions()
    {
        return $this->belongsToMany(Permission::class, PermissionRoles::getTableName())
                    ->withPivot(['created_at', 'updated_at', 'test'])
                    ->as('membership');
    }
}
