<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeveloperConcern;
use Illuminate\Support\Facades\Auth;

class DevelopersConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    if (Auth::check() && Auth::user()->role === 'developer') {
        $concern = DeveloperConcern::find(1);
        return view('developersconcern.index', compact('concern'));
    }
    abort(403, 'Unauthorized access.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        $concern = DeveloperConcern::find(1);
        $concern->enableMode = $request->input('enableMode');
        $concern->msg = $request->input('msg');
        $concern->save();
        return redirect()->route('developersconcern.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
