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
        // $request->validate($this->validationRules());
        $data = $request->all();
        $form = $data['form'];
        $form["apartment_id"] = $data['ap_id'];
        $newMessage = new Message();
        // $newMessage->fill($data['ap_id']);
        $newMessage->fill($form);
        $newMessage->save();
        return $request;
    }

    private function validationRules(){
        return [
            'ap_id' => 'required'|'numeric',
            'form' => [
                'name' => 'required'|'string'|'max:255',
                'surname' => 'required'|'string'|'max:255',
                'email' => 'required'|'string'|'email'|'max:255',
                'text' => 'required',
            ]
        ];
    }
}
