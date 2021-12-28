<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVersion extends Model
{
    use HasFactory;

    protected $table = 'user_version';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','column','value','content'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public static function version_log( $user=null ){
        $log_array = ['name','phone','address','email'];
        $new_data=$user->getDirty();
        foreach ($new_data as $key => $value){
            if (in_array($key,$log_array)){
                $data = [
                    'user_id'=>$user->id,
                    'column'=>$key,
                    'value'=>$value,
                    'content'=>'修改 '.$key.' 從 "'.$user->getOriginal($key).'" 改為 "'.$value.'"',
                ];
                UserVersion::create($data);
            }
        }
    }

}
