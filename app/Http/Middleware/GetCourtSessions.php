<?php

namespace App\Http\Middleware;

use App\Services\CourtSessions\CourtSessionsService;
use App\Services\CourtSessions\RedisService;
use Closure;
use Exception;
use Illuminate\Support\Facades\Redis;

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
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {

        //dd(Redis::keys('client:*'));
        $fetchedItems = $this->service->getItems();

        $beginningDayItems = $this->service->getDataForCurrentDay($fetchedItems);
        //dd($beginningDayItems[0]);
        $currentTimeItems = $this->service->getMoreCurrentTime($fetchedItems);

        $this->service->checkFetchedItems($beginningDayItems);

        foreach ($beginningDayItems as $item) {
            $client = new RedisService(
                $item['date'],
                $item['number'],
                $item['judge'],
                $item['involved'],
                $item['description'],
                (int)$item['courtroom']
            );
            $client->store();
        }

        dd(RedisService::getAll());

        dd("stop");



        //dd(($data[1]));
        if ($data->count() > 0) {
            $data->each(function ($item) {
                if ($this->service->checkFetchedItems($item)) {
                    throw new Exception('Returned array with court.gov.ua contains empty elements');
                }
                $client = new RedisService($item['date'], $item['number'], $item['judge'], $item['involved'], $item['description'], $item['courtroom']);
                $client->store();
            });
        }
        //$date = '13.03.2020 09:00';
        //$number = '991/476/19';
        //$judges = 'Білоус І.О., Кравчук О.О., Крук Є.В.';
        //$involved = 'Потерпілий: Державне підприємство "Українська студія телевізійних фільмів "Укртелефільм", представник потерпілого: Аврахов Тарас Григорович, представник потерпілого: Погорєлий Дмитро Ігорович, обвинувачений: Підлісний Віктор Олександрович, обвинувачений: Гудзь Олександра Сергіївна, обвинувачений: Заверховський Василь Федорович, захисник: Добрянський Андрій Миколайович, захисник: Звенігородський Віталій Миколайович, захисник: Лакуша Андрій Віталійович, адвокат: Лазарева Людмила Леонідівна';
        //$description = 'Легалізація (відмивання) доходів, одержаних злочинним шляхом';
        //$room = 10;

        //$client = new RedisService($date, $number, $judges, $involved, $description, $room);
        //$client->store();

        dd(RedisService::find($date, $number));

        return $next($request);
    }
}
