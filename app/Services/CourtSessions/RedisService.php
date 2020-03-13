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
        string $involved,
        string $description,
        int $room)
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
        Redis::hmset('client:' . $this->date . '_' . $this->number, [
            'id'      => $this->date,
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
        $key = 'client:' . $date . '_' . $number;
        $stored = Redis::hgetall($key);
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
        $clients = [];
        foreach ($keys as $key) {
            $stored = Redis::hgetall($key);
            $client = new Client(
                $stored['date'],
                $stored['number'],
                $stored['judges'],
                $stored['involved'],
                $stored['description'],
                $stored['room']
            );
            $clients[] = $client;
        }
        return $clients;
    }
}
