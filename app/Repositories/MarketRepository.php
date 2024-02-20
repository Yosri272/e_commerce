<?php

namespace App\Repositories;

use App\Models\Market;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class MarketRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @method Market findWithoutFail($id, $columns = ['*'])
 * @method Market find($id, $columns = ['*'])
 * @method Market first($columns = ['*'])
 */
class MarketRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'name_ar',
        'description',
        'address',
        'latitude',
        'longitude',
        'price',
        'discount_price',
        'package_items_count',
        'phone',
        'mobile',
        'long_time',
        'expires_at',
        'information',
        'delivery_fee',
        'default_tax',
        'delivery_range',
        'available_for_delivery',
        'closed',
        'admin_commission',
        'category_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Market::class;
    }

    /**
     * get my markets
     */

    public function myMarkets()
    {
        return Market::join("user_markets", "market_id", "=", "markets.id")
            ->where('user_markets.user_id', auth()->id())->get();
    }

    public function myActiveMarkets()
    {
        return Market::join("user_markets", "market_id", "=", "markets.id")
            ->where('user_markets.user_id', auth()->id())
            ->where('markets.active','=','1')->get();
    }

}
