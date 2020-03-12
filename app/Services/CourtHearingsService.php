<?php


namespace App\Services;


use Carbon\Carbon;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Collection;

class CourtHearingsService
{
    /**
     * @var Client
     */
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchData(): Collection
    {
        $dataForAllDays = [];
        $url = 'https://hcac.court.gov.ua/new.php';
        $method = 'POST';
        $headers = [
            'Cookie'           => 'PHPSESSID=qmvdf773bcv16tlqpu3p0148k7',
            'Origin'           => 'https://hcac.court.gov.ua',
            'Accept-Encoding'  => 'gzip, deflate, br',
            'Accept-Language'  => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
            'User-Agent'       => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36',
            'Content-Type'     => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Accept'           => 'application/json, text/javascript, */*; q=0.01',
            'Cache-Control'    => 'max-age=0',
            'X-Requested-With' => 'XMLHttpRequest',
            'Connection'       => 'keep-alive',
            'Referer'          => 'https://hcac.court.gov.ua/hcac/gromadyanam/hcac'
        ];

        $formParams = [
            'q_court_id' => '4910'
        ];

        $dataForAllDays = $this->getResponseByGuzzleClient($method, $url, $headers, $formParams);
        //dd($data);
        return collect($dataForAllDays);
    }

    private function getResponseByGuzzleClient(string $method, string $url, array $headers, array $formParams): array
    {
        $arr = [];
        try {
            $response = $this->client->request($method, $url, [
                'headers' => $headers,
                'form_params' => $formParams
            ])->getBody()->getContents();

            $arr = json_decode($response, true);

            if (isset($arr['error'])) {
                $error = $arr['error'];
                $errorMsg = sprintf(
                    'Response court hearrings has error. Error code - %d, error msg - %s. Class - %s, line - %d, query - %s',
                    $error['error_code'],
                    $error['error_msg'],
                    __CLASS__,
                    __LINE__,
                    $url
                );
                dd($errorMsg);
            }
        } catch (Exception $e) {
            $errorMsg = sprintf(
                'Error during Guzzle request. %s.  Class - %s, line - %d',
                $e->getMessage(),
                __CLASS__,
                __LINE__
            );
            dd($errorMsg);
        }
        return $arr;
    }

    public function getFields(): array
    {
        $arr = [];
        $columns = config('court_hearring.columns');
        foreach ($columns as $key => $value) {
            $arr[] = [
                'key' => $value['name'],
                'sortable' => $value['sortable']
            ];
        }

        return $arr;
    }

    public function getItems(array $arr): array
    {
        if (count($arr) === 0) {
            dd("arr = 0");
        }
        dd("123");

        return [
            [
                'Дата / Час' => '10.03.2020 10:00',
                'Склад суду' => 'Ткаченко О.В., Дубас В.М., Коліуш О.Л.',
                'Єдиний унікальний номер справи' => '757/870/18-к',
                'Сторони по справі' => 'Потерпілий: ПАТ "Державна продовольчо-зернова корпорація України", обвинувачений: Завадський Анатолій Юхимович, захисник: Ширант Алла Анатоліївна, захисник: Алієв Валерій Валерійович, захисник: Дорошенко Наталія Анатоліївна, захисник: Шипош Владислав Миколайович, захисник: Алімов Дмитро Володимирович, захисник: Гребенник Микола Олександрович, захисник: Бойко Дмитро Олександрович, захисник: Волошин Олексій Миколайович, захисник: Юрченко Анатолій Федорович',
                'Суть позову' => 'Прийняття пропозиції, обіцянки або одержання неправомірної вигоди службовою особою',
                'Адреса' => '03057, м. Київ, просп. Перемоги, 41',
                'Форма судочинства' => 'Кримінальне судочинство',
                'Зал судових засідань' => 7
            ],
            [
                'Дата / Час' => '10.03.2020 10:05',
                'Склад суду' => 'Ткаченко О.В., Дубас В.М., Коліуш О.Л.',
                'Єдиний унікальний номер справи' => '757/870/18-к',
                'Сторони по справі' => 'Потерпілий: ПАТ "Державна продовольчо-зернова корпорація України", обвинувачений: Завадський Анатолій Юхимович, захисник: Ширант Алла Анатоліївна, захисник: Алієв Валерій Валерійович, захисник: Дорошенко Наталія Анатоліївна, захисник: Шипош Владислав Миколайович, захисник: Алімов Дмитро Володимирович, захисник: Гребенник Микола Олександрович, захисник: Бойко Дмитро Олександрович, захисник: Волошин Олексій Миколайович, захисник: Юрченко Анатолій Федорович',
                'Суть позову' => 'Прийняття пропозиції, обіцянки або одержання неправомірної вигоди службовою особою',
                'Адреса' => '03057, м. Київ, просп. Перемоги, 41',
                'Форма судочинства' => 'Цивільне судочинство',
                'Зал судових засідань' => 8
            ],            [
                'Дата / Час' => '10.03.2020 10:05',
                'Склад суду' => 'Ткаченко О.В., Дубас В.М., Коліуш О.Л.',
                'Єдиний унікальний номер справи' => '757/870/18-к',
                'Сторони по справі' => 'Потерпілий: ПАТ "Державна продовольчо-зернова корпорація України", обвинувачений: Завадський Анатолій Юхимович, захисник: Ширант Алла Анатоліївна, захисник: Алієв Валерій Валерійович, захисник: Дорошенко Наталія Анатоліївна, захисник: Шипош Владислав Миколайович, захисник: Алімов Дмитро Володимирович, захисник: Гребенник Микола Олександрович, захисник: Бойко Дмитро Олександрович, захисник: Волошин Олексій Миколайович, захисник: Юрченко Анатолій Федорович',
                'Суть позову' => 'Прийняття пропозиції, обіцянки або одержання неправомірної вигоди службовою особою',
                'Адреса' => '03057, м. Київ, просп. Перемоги, 41',
                'Форма судочинства' => 'Цивільне судочинство',
                'Зал судових засідань' => 8
            ],            [
                'Дата / Час' => '10.03.2020 10:05',
                'Склад суду' => 'Ткаченко О.В., Дубас В.М., Коліуш О.Л.',
                'Єдиний унікальний номер справи' => '757/870/18-к',
                'Сторони по справі' => 'Потерпілий: ПАТ "Державна продовольчо-зернова корпорація України", обвинувачений: Завадський Анатолій Юхимович, захисник: Ширант Алла Анатоліївна, захисник: Алієв Валерій Валерійович, захисник: Дорошенко Наталія Анатоліївна, захисник: Шипош Владислав Миколайович, захисник: Алімов Дмитро Володимирович, захисник: Гребенник Микола Олександрович, захисник: Бойко Дмитро Олександрович, захисник: Волошин Олексій Миколайович, захисник: Юрченко Анатолій Федорович',
                'Суть позову' => 'Прийняття пропозиції, обіцянки або одержання неправомірної вигоди службовою особою',
                'Адреса' => '03057, м. Київ, просп. Перемоги, 41',
                'Форма судочинства' => 'Цивільне судочинство',
                'Зал судових засідань' => 8
            ],            [
                'Дата / Час' => '10.03.2020 10:05',
                'Склад суду' => 'Ткаченко О.В., Дубас В.М., Коліуш О.Л.',
                'Єдиний унікальний номер справи' => '757/870/18-к',
                'Сторони по справі' => 'Потерпілий: ПАТ "Державна продовольчо-зернова корпорація України", обвинувачений: Завадський Анатолій Юхимович, захисник: Ширант Алла Анатоліївна, захисник: Алієв Валерій Валерійович, захисник: Дорошенко Наталія Анатоліївна, захисник: Шипош Владислав Миколайович, захисник: Алімов Дмитро Володимирович, захисник: Гребенник Микола Олександрович, захисник: Бойко Дмитро Олександрович, захисник: Волошин Олексій Миколайович, захисник: Юрченко Анатолій Федорович',
                'Суть позову' => 'Прийняття пропозиції, обіцянки або одержання неправомірної вигоди службовою особою',
                'Адреса' => '03057, м. Київ, просп. Перемоги, 41',
                'Форма судочинства' => 'Цивільне судочинство',
                'Зал судових засідань' => 8
            ],
        ];
    }

    public function getDataForCurrentDay(Collection $collection): Collection
    {
        $collection = $collection->filter(function ($item, $key) {

            if (!isset($item['date'])) {
                dd("No key 'date' in this key ->> " . $key);
            }

            return Carbon::parse($item['date'])->isToday();
        });

        //$collection = $collection->where('date', Carbon::today());
        //dd($collection);
        return $collection;
    }

    public function getMoreCurrentDate(Collection $collection): Collection
    {
        $collection = $collection = $collection->filter(function ($item, $key) {

            if (!isset($item['date'])) {
                dd("No key 'date' in this key ->> " . $key);
            }

            //$item['date'] = '10.03.2020 15:08';

            $dateInCollection = Carbon::parse($item['date']);

            $isToday = Carbon::parse($item['date'])->isToday();
            $greaterCurrent = $dateInCollection->greaterThan(Carbon::now());

            return $isToday && $greaterCurrent;
            //
            //dump($isToday);
            //dd($greaterCurrent);

            //dd(Carbon::parse($item['date'])->greaterThan(Carbon::now()));
            //dump(Carbon::parse($item['date']));
            //dump(Carbon::now());



            //return $isToday;
        });

        return $collection;
    }

    public function convertItems(Collection $collection): array
    {
        $arr = [];
        $columns = config('court_hearring.columns');
        foreach ($columns as $column) {
            $columnKeys[] = $column['name'];
        }
        //dump($columnKeys);
        foreach ($collection as $item) {
            $item['judge'] = str_replace(',', '<br>', $item['judge']);
            //if ($key !== 'forma' || $key !== 'add_address') {
                unset($item['forma']);
                unset($item['add_address']);
                $arr[] = array_combine($columnKeys, $item);
            //}
        }

        return $arr;
    }

}
