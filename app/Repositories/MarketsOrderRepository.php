<?php

namespace App\Repositories;

use App\Models\MarketsOrder;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MarketsOrderRepository
 * @package App\Repositories
 * @version August 31, 2019, 11:18 am UTC
 *
 * @method MarketsOrder findWithoutFail($id, $columns = ['*'])
 * @method MarketsOrder find($id, $columns = ['*'])
 * @method MarketsOrder first($columns = ['*'])
*/
class MarketsOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'price',
        'quantity',
        'markets_id',
        'order_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MarketsOrder::class;
    }
}
