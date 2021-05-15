<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DictionaryResource;
use App\Models\Dictionary;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Bool_;

class DictionaryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DictionaryResource::collection(Dictionary::orderBy('updated_at', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
       
        if (!(Dictionary::where('word_eng', $data['word_eng'])->first())) {
            if ($request['image']) {
                $files = $request['image'];
                $destinationPath = 'uploads'; // upload path
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $data['image'] = $profileImage;
            } else {
                $data['image'] = '1';
            }

            $dictionary = Dictionary::create($data);
            /* return response()->json($dictionary, 201); */
            return new DictionaryResource($dictionary);
        } else {
            return response()->json(['message' => 'this word exist'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dictionary = Dictionary::findOrFail($id);
        return new DictionaryResource($dictionary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $dictionary = Dictionary::findOrFail($id);
        $data = $request->all();

        if ($data['image'] != null) {
            $files = $request['image'];
            $destinationPath = 'uploads'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $data['image'] = $profileImage;
        } else {
            $data['image'] = $dictionary->image;
        }

        $dictionary->update($data);
        /* return response()->json($dictionary, 201); */
        return new DictionaryResource($dictionary);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dictionary = Dictionary::findOrFail($id);
        $dictionary->delete();
        return response()->json(null, 204);
    }
}
