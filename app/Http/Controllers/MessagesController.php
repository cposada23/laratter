<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Http\Requests\CreateMessageRequest;
class MessagesController extends Controller
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
    public function store(CreateMessageRequest $request)
    {
        // $this->validate($request);
        // dd($request->all());
        $user = $request->user();
        $image = $request->file('image');
        $message = Message::create([
            'user_id' => $user->id,
            'content' => $request->input('message'),
            'image'   => $image->store('messages', 'public')
        ]);

        // dd($message);
        return redirect('/messages/'.$message->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //Busco por id
        // $message = Message::find($id);
        //retorno
        return view('messages.show',[
            'message'=> $message
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

    public function search(Request $request) {
        
       
        $query = $request->input('query');

        // $messages = Message::with('user')->where('content', 'LIKE', "%$query%")->get();


        // Ojo busqueda con algolia!!
        $messages = Message::search($query)->get();
        $messages->load('user');
        return view('messages.index', [
            'messages' => $messages,
        ]);
    }

}
