<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Result extends Model
{
    protected $fillable = ['quest_id', 'min_score', 'max_score', 'desc'];

    public function questionnaire(){
    	return $this->belongsTo(\App\Questionnaire::class);
    }

    public static function getResult($id){
    	return DB::table('results')
    		->select('min_score', 'max_score', 'desc')
    		->where('quest_id', $id)
            ->get();
    }
}
