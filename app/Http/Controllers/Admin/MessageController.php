<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    public function index( Apartment $apartment) {
        $response = Gate::inspect('view', $apartment);
        // $response = Gate::inspect('viewAny');

        if ($response->allowed()) {
            $messages = Message::query()->where('apartment_id', $apartment->id)->get();
            return view('admin.messages.index', compact('messages'));
        } else {
            return view('admin.policy',compact("response"));
        }  
    }
}
