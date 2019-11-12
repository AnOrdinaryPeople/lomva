<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Done;
use App\Question;
use App\Questionnaire as Quest;
use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestController extends Controller
{
    public function getAll(){
    	return response()->json(Quest::getAll());
    }
    public function search(Request $req){
    	return response()->json(Quest::search($req->search));
    }
    public function getThisQuest($id){
    	return response()->json(Quest::getThisQuest($id));
    }
    public function test($id, $userId){
    	return response()->json([
    		'data' => Question::test($id),
    		'result' => Result::getResult($id),
    		'total' => Question::total($id)
    	]);
    }
    public function score($id, $userId, Request $req){
    	Done::create([
    		'quest_id' => $id,
    		'user_id' => $userId,
    		'total_score' => $req->score
    	]);
    	return response()->json();
    }
    public function getOwnQuest($id){
    	return response()->json(Quest::getOwnQuest($id));
    }
    public function store($id, Request $req){
    	$val = 'required|numeric|min:0';
    	$check = Validator::make($req->all(), [
    		'title' => 'required',
    		'desc' => 'required',
    		'category' => 'required|numeric|min:1|max:4',
    		'questions.*.question' => 'required',
    		'questions.*.answers.*.answer' => 'required',
    		'questions.*.answers.*.score' => $val,
    		'results.*.min' => $val,
    		'results.*.max' => $val,
    		'results.*.desc' => 'required'
    	]);
    	if($check->fails()) return response()->json($check->errors(), 422);
    	else{
    		foreach ($req->results as $key){
	    		if($key['max'] <= $key['min'] || $key['min'] >= $key['max']){
	    			$checker = 'checked';
	    			return response()->json(['error_range' => 'error range number'], 422);
	    		}
	    	}
	    	if(empty($checker)){
		    	$store = Quest::create([
		    		'title' => $req->title,
		    		'desc' => $req->desc,
		    		'category' => $req->category,
		    		'user_id' => $id,
		    	]);
		    	for($i = 0; $i < count($req->questions); $i++){
		    		$obj = $req['questions'][$i];

		    		$quest = Question::create([
			    		'number' => $i + 1,
		    			'question' => $obj['question'],
		    			'quest_id' => $store->id
			    	]);
			    	foreach ($obj['answers'] as $key) {
			    		$answer[] = [
			    			'answer' => $key['answer'],
			    			'score' => $key['score'],
			    			'q_id' => $quest->id,
			    			'created_at' => now(),
				    		'updated_at' => now()
			    		];
			    	}
		    	}
		    	foreach ($req->results as $key) $result[] = [
	    			'quest_id' => $store->id,
		    		'min_score' => $key['min'],
		    		'max_score' => $key['max'],
		    		'desc' => $key['desc'],
		    		'created_at' => now(),
		    		'updated_at' => now()
		    	];
		    	Answer::insert($answer);
		    	Result::insert($result);

		    	return response()->json(['status' => 'success']);
	    	}
    	}
    }
	public function edit($id, $userId){
		$info = Quest::getEdit($id, $userId);
		
		if(!$info) return response()->json([
			'info' => '',
			'question' => '',
			'result' => '',
		]);
		else return response()->json([
			'info' => $info,
			'question' => Question::test($id, true),
			'result' => Result::getResult($id)
		]);
	}
	public function update($id, $userId, Request $req){
		$this->store($userId, $req);
		$this->destroy($id, true);

		return response()->json(['status' => 'success']);
	}
	public function destroy($id, $checker = false){
		$q = Question::where('quest_id', $id);

		Result::where('quest_id', $id)->delete();
		
		foreach ($q->get() as $key)
			Answer::where('q_id', $key->id)->delete();

		$q->delete();
		Done::where('quest_id', $id)->delete();
		Quest::destroy($id);

		if(!$checker) return response()->json(['status' => 'success']);
	}
	public function getDone($id, $userId){
		return response()->json([
			'student' => Done::getDone($id),
			'result' => Result::getResult($id, true, $userId)
		]);
	}
	public function getUserDone($id, $userId){
		return response()->json(Done::where('quest_id', $id)
			->where('user_id', $userId)
			->get());
	}
}
