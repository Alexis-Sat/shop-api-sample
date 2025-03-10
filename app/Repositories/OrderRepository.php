<?php

namespace App\Repositories;

use App\Interfaces\GoodRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Good;
use App\Models\Order;
use Exception;

/**
 *
 */
class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var GoodRepositoryInterface
     */
    protected GoodRepositoryInterface $goodRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(GoodRepositoryInterface $goodRepository)
    {
        $this->goodRepository = $goodRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function store(array $data): mixed
    {
        $goods = Good::all();

        $order = Order::create([
            'user_id' => $data['userId'],
            'status' => Order::ADDED,
        ]);

        foreach ($data['goods'] as $item) {
            $good = $this->isAvailableGood($goods, $item);

            if ($good === false) throw new Exception('Not available');

            $order->items()->create([
                'good_id' => $item['id'],
                'amount' => $item['count'],
                'price' => $item['count'] * $goods->get($good)->price,
            ]);

            $this->goodRepository->update(['item_id' => $item['id'], 'order_amount' => $item['count'], 'stored_quantity' => $goods->get($good)->count]);
        }

        return $order->items;

    }

    /**
     * @param $goods
     * @param $orderItem
     * @return mixed
     */
    public function isAvailableGood($goods, $orderItem): mixed
    {
        return $goods->search(function ($item, $key) use ($orderItem) {
            return ($item->id == $orderItem['id'] && $item->count - $orderItem['count'] > 0);
        });

    }


}
