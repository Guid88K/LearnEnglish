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
        return DictionaryResource::collection(Dictionary::with('dictionaries')->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dictionary = Dictionary::create($request->all());
        return new DictionaryResource($dictionary);
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
        $dictionary->update($request->all());
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
