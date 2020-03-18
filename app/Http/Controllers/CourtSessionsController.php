<?php

namespace App\Http\Controllers;

use App\Services\CourtSessions\CourtSessionsService;
use App\Services\CourtSessions\RedisService;
use Illuminate\Http\Request;

class CourtSessionsController extends Controller
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
        $fields = $this->service->getFields();
        //$items = $this->service->getCurrentDayItemsFromRedis();
        $items = $this->service->getCurrentTimeItemsFromRedis();
        //dd($fields);
        //$items1[0] = $items[0];
        //$items1[1] = $items[1];

        //$items = [
        //    [
        //        "Час" => "16.03.2020 09:00",
        //        "Склад суду" => " Біцюк А.В.",
        //        "Номер справи" => "991/2200/20",
        //        "Сторони по справі"=> "",
        //        "Суть позову"=> "",
        //        "Зал"=>  "5"
        //    ],
        //    [
        //        "Час" => "16.03.2020 09:05",
        //        "Склад суду" => " Біцюк А.В.",
        //        "Номер справи" => "991/2200/20",
        //        "Сторони по справі"=> "",
        //        "Суть позову"=> "",
        //        "Зал"=>  "4"
        //    ],
        //];

        //dd($items);
        return view('court_hearings.hcac', [
            'fields' => $fields,
            'items' => $items
        ]);
    }

    public function setRoomNumber(Request $request)
    {
        if (isset($request->key)) {
            $keyFromRequest = $request->key;
            $roomFromRequest = $request->Зал;

            $itemsFromRedis = $this->service->getItemsFromRedis();
            $itemsFromRedis->transform(function ($item) use ($keyFromRequest, $roomFromRequest) {
                $item['courtroom'] = ($item['key'] === $keyFromRequest) ? $roomFromRequest : $item['courtroom'];
                return $item;
            });

            RedisService::insertToRedis($itemsFromRedis);
        }
    }

    public function apel_hcac()
    {
        dd(2);
    }
}
