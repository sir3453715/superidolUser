<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarData extends Model
{
    use HasFactory;

    protected $table = 'car_data';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','serial_number','date','time','car_type','car_model','VIN','car_code','milage','price','giveaway','how_to_know','car_situation',
        'img','notes'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function CarType(){
        $type = CarType::where('id',$this->car_type)->first();
        $parent = CarType::where('id',$type->parent_id)->first();
        return $parent->name.' '.$type->name;
    }
    public function CarModel(){
        return $this->belongsTo(CarModel::class,'car_model','id');
    }
    public function CarItems()
    {
        return $this->hasMany(CarItems::class,'car_data_id');
    }

}
