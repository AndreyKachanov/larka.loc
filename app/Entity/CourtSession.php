<?php

namespace App\Entity;

use App\Traits\EloquentGetTableNameTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static count()
 */
class CourtSession extends Model
{
    use EloquentGetTableNameTrait;

    protected $table = 'court_sessions';
}
