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

    public static function testCheck($id, $questId){
    	return DB::table('dones')
    		->join('questionnaires', 'questionnaires.id', '=', 'quest_id')
    		->where('dones.user_id', $id)
            ->where('questionnaires.id', $questId)
    		->count();
    }
}
