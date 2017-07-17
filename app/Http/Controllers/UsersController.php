<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\PrivateMessage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::where('username', $username)->first();
        // Log::info($user);
        return view('users.show', [
            'user' => $user
        ]);
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

    /** a quien sigo
    */
    public function follows($username){
        $user = User::where('username', $username)->first();
        return view('users.follows', [
            'user' => $user,
            'follows' => $user->follows,
        ]);
    }

    public function followers($username){
        $user = User::where('username', $username)->first();
        return view('users.follows', [
            'user' => $user,
            'follows' => $user->followers,
        ]);
    }

    public function follow($username, Request $request){
        $user = $this->findByUsername($username);
        $me = $request->user();

        $me->follows()->attach($user);

        return redirect("/".$username)->withSuccess('Follewed');
    }



    public function unfollow($username, Request $request){
        $user = $this->findByUsername($username);
        $me = $request->user();

        $me->follows()->detach($user);

        return redirect("/".$username)->withSuccess('not followed');
    }

    public function sendPrivateMessage($username, Request $request) {
        $user = $this->findByUsername($username);
        $me = $request->user();
        $message = $request->input('message');

        $conversation = Conversation::between($me, $user);

        // $conversation = Conversation::create();
        // $conversation->users()->attach($me);
        // $conversation->users()->attach($user);

        $privateMessage = PrivateMessage::create([
            'conversation_id' => $conversation->id,
            'user_id' => $me->id,
            'message' => $message,
        ]);

        return redirect('/conversations/'.$conversation->id);
    }

    public function showConversation(Conversation $conversation) {
        // Le digo al objeto que quiero que tenga dentro los usuario y mensajes privados
        $conversation->load('users', 'privateMessages');
        // dd($conversation);
        return view('users.conversation', [
            'conversation' => $conversation,
            'user' => auth()->user(),
        ]);
    }

    private function findByUsername($username) {
       return  User::where('username', $username)->firstOrFail();
    }


}
