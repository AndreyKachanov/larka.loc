<?php

namespace App\Entity;

use App\Traits\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'stars';

    public function starrable()
    {
        return $this->morphTo();
    }
}
