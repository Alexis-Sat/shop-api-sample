<?php

namespace App\Console\Commands;

use App\Models\Good;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class SendOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending orders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $responses = Http::pool(fn(Pool $pool) => [
            $pool->post('http://127.0.0.1:8000/api/order', [
                'userId' => 1,
                'goods' => [
                    ['id' => 1,
                        'count' => 200],
                    ['id' => 2,
                        'count' => 20.0],
                ]
            ]),
            $pool->post('http://127.0.0.1:8000/api/order', [
                'userId' => 1,
                'goods' => [
                    ['id' => 1,
                        'count' => 400],
                    ['id' => 2,
                        'count' => 40.0],
                ]
            ]),
            $pool->post('http://127.0.0.1:8000/api/order', [
                'userId' => 1,
                'goods' => [
                    ['id' => 1,
                        'count' => 100],
                    ['id' => 2,
                        'count' => 2.0],
                ]
            ]),
            $pool->post('http://127.0.0.1:8000/api/order', [
                'userId' => 1,
                'goods' => [
                    ['id' => 1,
                        'count' => 200.0],
                    ['id' => 2,
                        'count' => 12.0],
                ]
            ]),
            $pool->post('http://127.0.0.1:8000/api/order', [
                'userId' => 1,
                'goods' => [
                    ['id' => 1,
                        'count' => 10.0],
                    ['id' => 2,
                        'count' => 1.0],
                ]
            ]),
        ]);


        $results = collect($responses)->map(fn($response) => json_encode($response));

        dd($results, json_encode(User::where('id', 1)->first()->orders), json_encode(Good::select(['name', 'count'])->get()));
    }
}
