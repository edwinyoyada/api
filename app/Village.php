<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    public function district()
    {
        return $this->belongsTo("App\District");
    }


}
