<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FishLoadDetails;
use App\Models\Boat;
/**
 * @property int  $boat_id
 * @property int  $created_at
 * @property int  $updated_at
 * @property Date $expired_date
 */
class FishLoad extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fish_loads';

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
        'boat_id', 'expired_date', 'created_at', 'updated_at'
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
        'boat_id' => 'int', 
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expired_date', 'created_at', 'updated_at'
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
    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    public function details()
    {
        return $this->hasMany(FishLoadDetails::class);
    }
}
