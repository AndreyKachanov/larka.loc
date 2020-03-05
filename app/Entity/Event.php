<?php

namespace App\Entity;

use App\Traits\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static count()
 * @method static create(array $array)
 */
class Event extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'events';

    public function stars()
    {
        return $this->morphToMany(Star::class, 'starrable');
    }
}
