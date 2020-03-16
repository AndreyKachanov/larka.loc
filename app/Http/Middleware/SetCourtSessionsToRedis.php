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
            RedisService::insertToRedis($fetchedItems);
        }

        return $next($request);
        //else {
        //    dd(RedisService::getAll()->sortBy('key')->values());
        //}


        //RedisService::removeOldKeys();

        //dd(config('database.redis.options.prefix'));
        //dd(RedisService::getAll());
        //dd(Redis::hgetall("shop:{$shopId}:sales"););
        //dd(Redis::hGetAll('laravel_database_client:1584095400_991_2078_20'));


        //Redis::hmset('test', [
        //    'date'      => 'date'
        //]);
        //dump(Redis::keys('*'));
        $currentDay = Carbon::now();
        //dd($currentDay);

        // если в редисе пусто
        if (RedisService::getCountKeys() === 0) {
            //dd(2);
            $fetchedItems = $this->service->getItems();
            $firstItemDay = Carbon::parse($fetchedItems[0]['date']);

            //если в fetchedItems первое заседание в понедельник, а текущий день субота или воскресенье -
            // выбираем заседания за этот понедельник, иначе делаем выборку за текущий день
            if ($firstItemDay->dayOfWeek === 1 && ($currentDay->dayOfWeek === 6 || $currentDay === 7 )) {
                //dd("1");
                $courtSessions = $this->service->getFirstMondayItems($fetchedItems);
                //dd($courtSessions);
            } else {
                $courtSessions = $this->service->getCurrentDayItems($fetchedItems);
            }
            $this->service->checkFetchedItems($courtSessions);
            RedisService::insertToRedis($courtSessions);
            //dd(Carbon::parse($fetchedItems[0]['date'])->dayOfWeek);
            ////dd($fetchedItems);
            //$currentDayItems = $this->service->getCurrentDayItems($fetchedItems);
            //dd($currentDayItems);
            //dump($beginningDayItems);
            //$currentTimeItems = $this->service->getMoreCurrentTime($fetchedItems);

            // Check court sessions for empty elements
            //$this->service->checkFetchedItems($currentDayItems);
            //RedisService::insertToRedis($currentDayItems);
        } else {
            //dd(3);
            //если в редисе есть заседания
            //получаем массив из редиса
            $courtSession = RedisService::getAll()->sortBy('key')->values();
            //dd($courtSession);
            //проверяем, заседания какого дня в нём хранятся - по дате первого элемента

            $itemDate = Carbon::parse($courtSession->first()['date']);
            //сравниваем с текущим днем
            //если это не текущий день
            if (!$itemDate->isToday()) {
                //dd($currentDay->dayOfWeek);
                //dd("2");
                //если текущий день субота или воскресенье - грузим данные за первый понедельник
                //иначе за текущий день

                if ($currentDay->dayOfWeek === 6 || $currentDay->dayOfWeek === 0) {

                    $fetchedItems = $this->service->getItems();

                    $courtSessions = $this->service->getFirstMondayItems($fetchedItems);
                } else {
                    //dd("3");
                    $fetchedItems = $this->service->getItems();
                    //dd($fetchedItems);
                    $courtSessions = $this->service->getCurrentDayItems($fetchedItems);
                    //dd($courtSessions);
                }

                $this->service->checkFetchedItems($courtSessions);
                RedisService::removeOldKeys();
                RedisService::insertToRedis($courtSessions);
            }

            //dd($courtSession->first()['date']);
        }
        //dd(Redis::keys('court_session:*'));

        dd(RedisService::getAll()->sortBy('key')->values());

        //dd("stop");
        return $next($request);
    }
}
