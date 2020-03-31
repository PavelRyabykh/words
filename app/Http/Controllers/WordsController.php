<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWordRequest;
use App\Http\Requests\DeleteWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Word;
use Illuminate\Http\Request;

class WordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateWordRequest $request)
    {
        $data = $request->all();
        $data['example'] = nl2br(htmlentities($data['example']));
        if ($result = Word::create($data)) {
            return response()->json($result);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWordRequest $request, $id)
    {
        $word = Word::findOrFail($id);
        $word->word = $request->word;
        $word->transcription = $request->transcription;
        $word->translation = $request->translation;
        $word->example = nl2br(htmlentities($request->example));
        if ($word->save()) {
            return response()->json($word, 200);
        } else {
            return response(false, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteWordRequest $reques, $id)
    {
        if (Word::where('id', $id)->delete()) {
            return response(true, 200);
        } else {
            return response(false, 400);
        }
    }
}
