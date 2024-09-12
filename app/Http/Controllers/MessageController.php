<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;


class MessageController extends ApiController
{
    // Display a listing of the messages.
    public function index($id)
    {
        $messages =  Messages::whereIn('id', function($query) {
            $query->from('messages')->groupBy('room_id')->selectRaw('MAX(id)');
         })->paginate(10);
         
   
        return response()->json($messages);
    }

    // Store a newly created message in storage.
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'content' => 'required|string|max:255',
            'from_id' => 'required|exists:users,id',
            'to_id' => 'required|exists:users,id',
            'room_id' =>  'required'
        ]);

        $message = new Messages();
        $message->content = $request->input('content');
        $message->from_id= $validated['from_id'];
        $message->to_id = $validated['to_id'];
        $message->room_id = $validated['room_id'];
        $message->save();

        return $this->successResponse($message,"success send message",200);
    }

    // Display the specified message.
    public function show($room_id)
    {
        $message = Messages::where('room_id', $room_id)
        // ->get()
        ->simplePaginate(2);

        return $this->successResponse($message,"success get message",200);
    }

    // Update the specified message in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $message = Messages::where('id', $id)
            ->where('from_id', $id)
            ->firstOrFail();

        $message->content = $request->input('content');
        $message->save();

        return response()->json($message);
    }

    // Remove the specified message from storage.
    public function destroy($id)
    {
        $message = Messages::where('id', $id)
            ->where('from_id', $id)
            ->firstOrFail();

        $message->delete();

        return response()->json(null, 204);
    }
}