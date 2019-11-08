<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Questionnaire extends Model
{
    protected $fillable = ['title', 'desc', 'user_id'];

    public function user(){
    	return $this->belongsTo(\App\User::class);
    }
    public function question(){
    	return $this->hasMany(\App\Question::class);
    }
    public function result(){
    	return $this->hasMany(\App\Result::class);
    }

    public static function getAll(){
        return DB::table('questionnaires')
            ->select('title', 'category', 'name', 'avatar', 'questionnaires.id as quest_id')
            ->join('users', 'users.id', '=', 'questionnaires.user_id')
            ->orderBy('questionnaires.id', 'desc')
            ->paginate(10);
    }
    public static function search($q){
        return DB::table('questionnaires')
            ->select('title', 'category', 'name', 'avatar', 'questionnaires.id as quest_id')
            ->join('users', 'users.id', '=', 'user_id')
            ->where('title', 'like', '%'.$q.'%')
            ->orWhere('name', 'like', '%'.$q.'%')
            ->orderBy('questionnaires.id', 'desc')
            ->paginate(10);
    }
    public static function getThisQuest($id){
        return DB::table('questionnaires')
            ->select('title', 'desc', 'name', 'avatar')
            ->join('users', 'users.id', '=', 'user_id')
            ->where('questionnaires.id', $id)
            ->first();
    }
    public static function getOwnQuest($id){
        return DB::table('questionnaires')
            ->select('id', 'title')
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }
    public static function getEdit($id, $userId){
        return DB::table('questionnaires')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }
}
