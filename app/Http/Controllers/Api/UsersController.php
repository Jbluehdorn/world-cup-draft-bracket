<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Team;

class UsersController extends Controller
{
    public function getScore($sub) {
        $teams = $this->show($sub)->teams()->get();

        $score = 0;

        foreach($teams as $team) {
            $score += $team->score;
        }

        return $score;
    }

    public function getTeams($sub) {
        return $this->show($sub)->teams()->orderBy('score', 'desc')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        foreach($users as $user) {
            $user['score'] = $this->getScore($user->sub);
        }

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sub)
    {
        return User::where('sub', 'LIKE', '%'.$sub.'%')->first();
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
        //
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
