<?php

namespace App\Services\CourtSessions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

class RedisService
{
    private int $key;
    /**
     * @var string
     */
    private string $date;
    /**
     * @var string
     */
    private string $number;
    /**
     * @var string
     */
    private string $judges;
    /**
     * @var string
     */
    private string $involved;
    /**
     * @var string
     */
    private string $description;
    /**
     * @var int
     */
    private int $room;
    /**
     * @var string
     */
    public static string $prefix = 'court_session:';

    /**
     * RedisService constructor.
     * @param int $key
     * @param string $date
     * @param string $number
     * @param string $judges
     * @param string|null $involved
     * @param string|null $description
     * @param int|null $room
     */
    public function __construct(
        int $key,
        string $date,
        string $number,
        string $judges,
        string $involved = null,
        string $description = null,
        int $room = null
    ) {
        $this->key = $key;
        $this->date = $date;
        $this->number = $number;
        $this->judges = $judges;
        $this->involved = $involved;
        $this->description = $description;
        $this->room = $room;
    }


    public function store()
    {
        $key = self::getKey($this->date, $this->number);
        //dd($key);
        Redis::hmset($key, [
            'key'          => $this->key,
            'date'        => $this->date,
            'number'      => $this->number,
            'judges'      => $this->judges,
            'involved'    => $this->involved,
            'description' => $this->description,
            'room'        => $this->room
        ]);
    }

    /**
     * @param $date
     * @param $number
     * @return RedisService|bool
     */
    public static function find($date, $number)
    {
        $key = self::getKey($date, $number);
        $stored = Redis::hgetall($key);
        //dd($stored);
        if (!empty($stored)) {
            return new self(
                $stored['date'],
                $stored['number'],
                $stored['judges'],
                $stored['involved'],
                $stored['description'],
                $stored['room']
            );
        }
        return false;
    }


    /**
     * @return Collection
     */
    public static function getAll(): Collection
    {
        $keys = Redis::keys(self::$prefix . '*');
        //dump($keys);
        $courtSessions = [];
        $frameworkPrefix = config('database.redis.options.prefix');
        foreach ($keys as $key) {
            //dd($key);
            //dd($prefix);
            //dd(explode($prefix, $key));
            $stored = Redis::hgetall(explode($frameworkPrefix, $key)[1]);
            //dd($stored);
            //$client = new self(
            //    $stored['date'],
            //    $stored['number'],
            //    $stored['judges'],
            //    $stored['involved'],
            //    $stored['description'],
            //    $stored['room']
            //);
            $courtSessions[] = $stored;
            //dd($client);
        }
        return collect($courtSessions);
    }

    public static function removeOldKeys()
    {
        $frameworkPrefix = config('database.redis.options.prefix');
        $keys = Redis::keys(self::$prefix . '*');
        foreach ($keys as $key) {
            Redis::del(explode($frameworkPrefix, $key)[1]);
        }
    }

    /**
     * @param string $date
     * @param string $number
     * @return string
     */
    public static function getKey(string $date, string $number): string
    {
        return self::$prefix . '_' . $date . '_' . $number;
    }

    /**
     * @return int
     */
    public static function getCountKeys(): int
    {
        return count(Redis::keys(self::$prefix . '*'));
    }

    public static function insertToRedis(Collection $courtSessions)
    {
        dump("insert");
        foreach ($courtSessions as $key => $item) {
            //dd($key);
            $courtSession = new self(
                $key,
                $item['date'],
                $item['number'],
                $item['judge'],
                $item['involved'],
                $item['description'],
                (int)$item['courtroom']
            );
            $courtSession->store();
        }
    }
}
