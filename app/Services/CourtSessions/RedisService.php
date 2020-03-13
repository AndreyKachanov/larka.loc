<?php

namespace App\Services\CourtSessions;

use Illuminate\Support\Facades\Redis;

class RedisService
{
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
     * RedisClient constructor.
     * @param string $date
     * @param string $number
     * @param string $judges
     * @param string $involved
     * @param string $description
     * @param int $room
     */
    public function __construct(
        string $date,
        string $number,
        string $judges,
        string $involved = null,
        string $description = null,
        int $room = null
    )
    {
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
            'date'      => $this->date,
            'number' => $this->number,
            'judges' => $this->judges,
            'involved' => $this->involved,
            'description' => $this->description,
            'room' => $this->room
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
     * @return array
     */
    public static function getAll()
    {
        $keys = Redis::keys('client:*');
        //dd($keys);
        $clients = [];
        foreach ($keys as $key) {
            dd($key);
            $stored = Redis::hgetall($key);
            dd($stored);
            $client = new self(
                $stored['date'],
                $stored['number'],
                $stored['judges'],
                $stored['involved'],
                $stored['description'],
                $stored['room']
            );
            $clients[] = $client;
            dd($client);
        }
        return $clients;
    }

    /**
     * @param string $date
     * @param string $number
     * @return string
     */
    static public function getKey(string $date, string $number): string {
        return 'client:' . strtotime($date) . '_' . str_replace('/', '_', $number);
    }
}
