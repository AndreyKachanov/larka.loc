<?php

namespace App\Entity;


use App\Traits\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static count()
 * @method static create(array $array)
 * @method static first()
 */
class Contact extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'contacts';

    public function stars()
    {
        return $this->morphOne(Star::class, 'starrable');
    }
}
