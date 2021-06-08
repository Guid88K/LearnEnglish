<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GrammarRequest;
use App\Http\Resources\GrammarResource;
use App\Models\Grammar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GrammarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return GrammarResource::collection(Grammar::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return GrammarResource
     */
    public function store(GrammarRequest $request)
    {
        $grammar = Grammar::create($request->validated());
        return new GrammarResource($grammar);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return GrammarResource
     */
    public function show(Grammar $grammar)
    {

        return new GrammarResource($grammar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return GrammarResource
     */
    public function update(GrammarRequest $request, Grammar $grammar)
    {
        $grammar->update($request->validated());
        return new GrammarResource($grammar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grammar $grammar)
    {
        $grammar->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
