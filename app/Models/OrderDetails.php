<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int   $fish_type_id
 * @property int   $order_id
 * @property int   $created_at
 * @property int   $updated_at
 * @property float $quntity
 */
class OrderDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_details';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fish_type_id', 'quntity', 'order_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'fish_type_id' => 'int', 'quntity' => 'double', 'order_id' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function fishType()
    {
        return $this->belongsTo('App\Models\FishType');
    }
}
