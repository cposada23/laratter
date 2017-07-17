<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class PagesController extends Controller
{
    public function home () {

        // $messages = [
        //     [
        //         'id' => 1,
        //         'content' => 'Este es mi primer mensaje',
        //         'image' => 'http://lorempixel.com/600/338?1',
        //     ],
        // ];

        // $messages = Message::all();

        $messages = Message::latest()->paginate(10);
        // dd($messages);
        $links = [
            '/' => 'Home',
            '/acerca' => 'Acerca de nosotros'
        ];
        app('log')->info($links);
        // console.log("hola");
        // error_log($links);
        // print_r($links);
        return view('welcome', [
            'messages' => $messages,
            'links' => $links,
        ]);
    }
}
