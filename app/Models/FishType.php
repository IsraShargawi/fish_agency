<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FishLoad;
use App\Models\Order;
use DB;
/**
 * @property string $name
 * @property int    $created_at
 * @property int    $updated_at
 */
class FishType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fish_types';

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
        'name', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'quntity',
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
        'name' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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
    public function getQuntityAttribute()
    {
        $fish_loads = FishLoad::where('expired_date', '>', now())
        ->with(['details' => function($query){
            $query->where('fish_type_id', $this->attributes['id'])
            ->select('*');
        }])
        ->get();

        $sumNotExpired = 0;
        foreach ($fish_loads as $load) {
            foreach ($load->details as $array_details) {
                $sumNotExpired += $array_details->quantity;
            }
        }

        $orders = Order::where('is_approved', true)
        //where data > oldest date in loads
        ->get();
        
        foreach ($orders as $key => $order) {
            $sumNotExpired -= OrderDetails::where('order_id', $order->id)
            ->where('fish_type_id', $this->attributes['id'])
            ->sum('quntity');
            
        }
        return $sumNotExpired.' KG';
    }
    // Relations ...
}
