<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    use HasFactory;

    protected $table = 'wishes';

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'wish_at',
        'file_name',
        'file_path',
    ];

    public function user() {
     return $this->belongsTo('App\models\User');
   }

    public function subscribes() {
      return $this->hasMany('App\models\Subscribe');
    }
}
