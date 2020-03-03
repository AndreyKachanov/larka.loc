<?php

namespace App\Entity\User;

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
 */
class Permission extends Model
{
    //
}
