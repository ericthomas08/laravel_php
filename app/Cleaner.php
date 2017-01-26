<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cleaner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cleaners';

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
    protected $fillable = ['first_name', 'last_name', 'quality_score', 'email'];


    public function cities()
    {
        return $this->hasMany('App\CleanerCity');
    }

    public function isWorkCity($cityId) {
        foreach($this->cities as $city) {
            if ($city->city_id == $cityId) return true;
        }
        return false;
    }

    public function bookings() {
        return $this->hasMany('App\Booking', 'cleaner_id');
    }
}
