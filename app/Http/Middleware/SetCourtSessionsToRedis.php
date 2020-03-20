<?php

namespace App\Http\Middleware;

use App\Services\CourtSessions\CourtSessionsService;
use App\Services\CourtSessions\RedisService;
use Carbon\Carbon;
use Closure;
use Exception;

class SetCourtSessionsToRedis
{
    private CourtSessionsService $service;

    public function __construct(CourtSessionsService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        if (RedisService::getCountKeys() === 0) {
            $fetchedItems = $this->service->fetchItems();
            $this->service->checkFetchedItems($fetchedItems);
            RedisService::insertToRedis($fetchedItems);
        }

        return $next($request);
    }
}
