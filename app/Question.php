<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    protected $fillable = ['number', 'question', 'quest_id'];

    public function questionnaire(){
    	return $this->belongsTo(\App\Questionnaire::class);
    }
    public function answer(){
    	return $this->hasMany(\App\Answer::class);
    }

    public static function test($id, $edit = false){
    	$db = DB::table('questions')
			->where('quest_id', $id)
			->select('id', 'number', 'question')
			->get();
        
        if($edit) foreach($db as $key) $data[] = [
            'number' => $key->number,
            'question' => $key->question,
            'answer' => DB::table('answers')->select('answer', 'score')->where('q_id', $key->id)->get()
        ];
        else foreach($db as $key) $data[] = [
			'number' => $key->number,
			'question' => $key->question,
			'answer' => DB::table('answers')->select('answer', 'score')->where('q_id', $key->id)
				->inRandomOrder()
				->get()
		];

    	return $data;
    }
    public static function total($id){
    	return DB::table('questions')
    		->where('quest_id', $id)
    		->count();
    }
}
