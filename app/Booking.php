<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'customer_id', 'cleaner_id'];

    public function customer() {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function cleaner() {
        return $this->belongsTo('App\Cleaner', 'cleaner_id');
    }
    
}
