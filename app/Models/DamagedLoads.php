<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $quantity
 * @property int   $fish_type_id
 * @property int   $fish_load_id
 * @property int   $created_at
 * @property int   $updated_at
 */
class DamagedLoads extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'damaged_loads';

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
        'quantity', 'fish_type_id', 'fish_load_id', 'created_at', 'updated_at'
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
        'quantity' => 'double', 'fish_type_id' => 'int', 'fish_load_id' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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
}
