<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CleanerCity extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cleaner_cities';

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
    protected $fillable = ['cleaner_id', 'city_id'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function cleaner()
    {
        return $this->belongsTo('App\Cleaner');
    }


}
