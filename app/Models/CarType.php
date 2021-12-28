<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;

    protected $table = 'car_type';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','parent_id'
    ];

    public function carData(){
        return $this->belongsTo(CarData::class);
    }
    public function childrenType(){
        return CarType::where('parent_id',$this->id)->get();
    }
}
