<?php

namespace App\Entity\User;

use App\Entity\Post;
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
 * @mixin \Eloquent
 */
class Role extends Model
{
    public function rUsers()
    {
        return $this->hasMany(User::class);
    }

    public function posts()
    {
        return $this->hasManyThrough(Post::class, User::class);
    }
}
