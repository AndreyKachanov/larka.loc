<?php


namespace App\Http\Controllers;

use App\Entity\User\User;

class Test2Controller extends Controller
{
    public function __invoke(User $user)
    {
        dd($user);
    }
}
