<?php

namespace App\Repositories;

use App\Interfaces\GoodRepositoryInterface;
use App\Models\Good;

class GoodRepository implements GoodRepositoryInterface
{


    /**
     * @param array $data
     * @return mixed
     */
    public function update(array $data ): mixed
    {
      return Good::whereId($data['item_id'])->update(['count'=>  $data['stored_quantity'] -  $data['order_amount']]);
    }


}
