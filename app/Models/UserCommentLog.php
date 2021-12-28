<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommentLog extends Model
{
    use HasFactory;

    protected $table = 'user_comment_log';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','type','dateTime','author','content'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function authorData(){
        return $this->belongsTo(User::class,'author');
    }



}
