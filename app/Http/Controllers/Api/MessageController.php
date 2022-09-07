<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        $form = $data['form'];
        $form["apartment_id"] = $data['ap_id'];
        $newMessage = new Message();
        // $newMessage->fill($data['ap_id']);
        $newMessage->fill($form);
        $newMessage->save();
    }
}
