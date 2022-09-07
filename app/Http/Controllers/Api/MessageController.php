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
        $request->validate($this->validationRules());
        $data = $request->all();
        $newMessage = new Message();
        $newMessage->fill($data);
        $newMessage->save();
        return $request;
    }

    private function validationRules(){
        return [
            'apartment_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'text' => 'required',
        ];
    }
}
