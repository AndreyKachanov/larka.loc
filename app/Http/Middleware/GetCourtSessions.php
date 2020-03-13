<?php

namespace App\Http\Middleware;

use App\Services\CourtSessions\CourtSessionsService;
use Closure;

class GetCourtSessions
{
    private CourtSessionsService $service;

    public function __construct(CourtSessionsService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $data = $this->service->getData();
        dd($data);
        if ($data->count() > 0) {

        }

        return $next($request);
    }
}
