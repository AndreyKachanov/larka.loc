<?php

namespace App\Http\Controllers;

use App\Services\CourtSessions\CourtSessionsService;
use App\Services\CourtSessions\RedisService;
use Illuminate\Http\Request;

class CourtHearingsController extends Controller
{
    /**
     * @var CourtSessionsService
     */
    private CourtSessionsService $service;

    public function __construct(CourtSessionsService $service)
    {
        $this->service = $service;
    }

    public function hcac()
    {
        dd(RedisService::getAll()->sortBy('key')->values());

        $fields = $this->service->getFields();

        //dump($fields);
        $items = $this->service->convertItems($moreCurrentDateItems);
        //dd($items);

        return view('court_hearings.hcac', [
            'fields' => $fields,
            'items' => $items
        ]);
    }

    public function apel_hcac()
    {
        dd(2);
    }
}
