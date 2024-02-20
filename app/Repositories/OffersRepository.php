<?php
/**
 * File name: OffersRepository.php
 * Last modified: 2020.09.12 at 20:01:58
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Repositories;

use App\Models\Offers;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OffersRepository
 * @package App\Repositories
 * @version September 1, 2020, 7:27 pm UTC
 *
 * @method Offers findWithoutFail($id, $columns = ['*'])
 * @method Offers find($id, $columns = ['*'])
 * @method Offers first($columns = ['*'])
*/
class OffersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order',
        'text',
        'text_ar',
        'button',
        'text_position',
        'text_color',
        'button_color',
        'background_color',
        'indicator_color',
        'image_fit',
        'product_id',
        'market_id',
        'expires_at',
        'enabled'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Offers::class;
    }
}
