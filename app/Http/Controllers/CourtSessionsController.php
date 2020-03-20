<?php

namespace App\Http\Controllers;

use App\Services\CourtSessions\CourtSessionsService;
use App\Services\CourtSessions\RedisService;
use Carbon\Carbon;
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
        //$fields[] = [
        //    'key' => 'key',
        //    'sortable' => true
        //];
        //dd($fields);
        $items = $this->service->getCurrentDayItemsFromRedis();
        //$items = $this->service->getCurrentTimeItemsFromRedis();
        //dd($items);

        //dd(Carbon::parse($items[0]['Час'])->format('Y-m-d H:i:s'));
        //$items = array_slice($items, 0, 3);

        //$items1[0] = $items[0];
        //$items1[1] = $items[1];

        //$items = [
        //    [
        //        "Час" => "2020-03-20 10:30:00",
        //        "Склад суду" => " Біцюк А.В.",
        //        "Номер справи" => "991/2200/20",
        //        "Сторони по справі"=> "",
        //        "Суть позову"=> "",
        //        "Зал"=>  "5"
        //    ],
        //    [
        //        "Час" => "2020-03-20 10:31:00",
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
