<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DictionaryResource;
use App\Models\Dictionary;
use App\Models\DictionaryUser;
use App\Models\User;

class WordForUserController extends Controller
{
    public function all_word($user_id)
    {
        $user = User::find($user_id);
       /*  $word = Dictionary::all(); */
        $all_word = $user->dictionaries()->get();
        return DictionaryResource::collection($all_word);
    }

    public function store_word_for_user($user_id, $word_id)
    {

        $checkStatment = ['user_id' => $user_id, 'dictionary_id' => $word_id];
        $relationship = DictionaryUser::where($checkStatment)->count();
        if ($relationship > 0) {
            return response()->json(['message' => 'date exist'], 500);
        } else {
            $word = Dictionary::find($word_id);
            $user = User::find($user_id);

            $word->users()->attach($user);
            return response()->json(['message' => 'success'], 200);
        }
    }
}
