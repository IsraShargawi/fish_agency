<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string  $name
 * @property string  $slug
 * @property string  $description
 * @property string  $details
 * @property float   $price
 * @property int     $quantity
 * @property int     $review_able
 * @property int     $created_at
 * @property int     $updated_at
 * @property boolean $featured
 * @property boolean $status
 */
class Products extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
        'name', 'slug', 'description', 'details', 'price', 'quantity', 'featured', 'status', 'review_able', 'category_id', 'created_at', 'updated_at'
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
        'name' => 'string', 'slug' => 'string', 'description' => 'string', 'details' => 'string', 'price' => 'double', 'quantity' => 'int', 'featured' => 'boolean', 'status' => 'boolean', 'review_able' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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
