<?php

namespace App\Http\Controllers;

use App\Services\CourtSessions\CourtSessionsService;
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
        // Get court hearings for all days
        $data = $this->service->getData();
        //dd($data);
        // Get court hearings for current day
        $currentDayItems = $this->service->getDataForCurrentDay($data);
        // Get court hearings more than current time and today
        $moreCurrentDateItems = $this->service->getMoreCurrentDate($data);
        //dd($moreCurrentDateItems);

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
