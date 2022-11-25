<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetails;
use App\Models\Agency;

/**
 * @property int     $agency_id
 * @property boolean $is_approved
 * @property int     $created_at
 * @property int     $updated_at
 */
class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
        'agency_id', 'is_approved', 
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
        'agency_id' => 'int', 'is_approved' => 'boolean', 
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // protected $appends = [
    //     'order_details_count',
    // ];
    // Scopes...

    // Functions ...
    // public function getOrderDetailsCountAttribute()
    // {
    //     return $this->details->count();
    // }

    // Relations ...

    public function getOrderAgencyDetailsCountAttribute()
    {
        if (!session()->get('agency')) {
            return 0;
        }
        $orders_details = OrderDetails::with('fishType')->where('order_id', $this->id)->get();

        $agency_details = [];
        foreach ($orders_details as $key => $order_item) {
            if ($order_item->item->agency_id == session()->get('agency')->id) {
                $agency_details[] = $order_item->item;
            }
        }
        return count($agency_details);
    }

    public function agency()
    {
        return $this->belongsTo('App\Models\Agency');
    }

    public function details()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
