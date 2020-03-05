<?php

namespace App\Entity;

use App\Traits\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Entity\Post
 *
 * @method static count()
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entity\Post whereUserId($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'posts';
}
