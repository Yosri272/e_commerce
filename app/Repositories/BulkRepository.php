<?php

namespace App\Repositories;

use App\Models\Bulk;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BulkRepository
 * @package App\Repositories
 * @version April 6, 2020, 10:56 am UTC
 *
 * @method Option findWithoutFail($id, $columns = ['*'])
 * @method Option find($id, $columns = ['*'])
 * @method Option first($columns = ['*'])
*/
class BulkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'price',
        'quantity',
        'discount_price',
        'product_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Bulk::class;
    }
}
