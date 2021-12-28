<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarItems extends Model
{
    use HasFactory;

    protected $table = 'car_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_data_id','location','paper_type'
    ];

    public function carData(){
        return $this->belongsTo(CarData::class);
    }
}
