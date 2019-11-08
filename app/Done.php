<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Done extends Model
{
    protected $fillable = ['user_id', 'total_score', 'quest_id'];

    public function questionnaire(){
    	return $this->belongsTo(\App\Questionnaire::class);
    }

    public static function getDone($id){
        return DB::table('dones')
            ->select('name', 'avatar', 'dones.user_id as done_id')
            ->join('users', 'users.id', '=', 'dones.user_id')
            ->where('quest_id', $id)
            ->groupBy('user_id')
            ->paginate(10);
    }
}
