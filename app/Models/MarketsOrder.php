<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class MarketsOrder
 * @package App\Models
 * @version August 31, 2019, 11:18 am UTC
 *
 * @property \App\Models\Product product
 * @property \App\Models\Option[] options
 * @property \App\Models\Order order
 * @property double price
 * @property integer quantity
 * @property integer product_id
 * @property integer order_id
 */
class MarketsOrder extends Model
{

    public $table = 'markets_orders';
    


    public $fillable = [
        'price',
        'quantity',
        'markets_id',
        'order_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'double',
        'quantity' => 'integer',
        'markets_id' => 'integer',
        'order_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'price' => 'required',
        'markets_id' => 'required|exists:markets,id',
        'order_id' => 'required|exists:orders,id'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
//        'options'
    ];

    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    public function getCustomFieldsAttribute()
    {
        $hasCustomField = in_array(static::class,setting('custom_field_models',[]));
        if (!$hasCustomField){
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields','custom_fields.id','=','custom_field_values.custom_field_id')
            ->where('custom_fields.in_table','=',true)
            ->get()->toArray();

        return convertToAssoc($array,'name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function markets()
    {
        return $this->belongsTo(\App\Models\Market::class, 'markets_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    // public function options()
    // {
    //     return $this->belongsToMany(\App\Models\Option::class, 'product_order_options');
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id', 'id');
    }
//        /**
//    * @return \Illuminate\Database\Eloquent\Collection
//    */
//    public function getOptionsAttribute()
//    {
//        return $this->options()->get(['options.id', 'options.name']);
//    }
}
