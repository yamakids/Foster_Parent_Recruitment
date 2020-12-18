<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    private static $listName = [1 => '応募', 2 => '契約中', 3 => '引き取り済み', 4 => '引き渡し確認完了'];

    public function getStatusName() {
         return self::$listName[$this->status];
   }

    public function wish() {
     return $this->belongsTo('App\models\Wish');
   }
   public function user() {
     return $this->belongsTo('App\models\User');
   }
}
