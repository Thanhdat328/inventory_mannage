<?php

namespace App\Http\Controllers;

use App\Models\Receiver;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiverController extends Controller
{
    public function index()
    {
        $request_user = Auth::user();
        return view('receiver.index', [
            'receivers' => Receiver::Paginate(5), 'request_user' => $request_user
        ]);
    }

    public function create(Request $request)
    {
        return view('receiver.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'email' =>'required',
            'phone' =>'required',
            'address' =>'required',
        ]);

        $receiver = new Receiver();
        $receiver->name = $request->name;
        $receiver->user_id = Auth::user()->id;
        $receiver->email = $request->email;
        $receiver->phone = $request->phone;
        $receiver->address = $request->address;
        $receiver->save();

        return redirect()->route('receiver.index');
    }

    public function edit(Request $request, $id)
    {
        $receiver = Receiver::find($id);
        return view('receiver.edit', ['receiver' => $receiver]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required',
            'email' =>'required',
            'phone' =>'required',
            'address' =>'required',
        ]);

        $receiver = Receiver::find($id);
        $receiver->name = $request->name;
        $receiver->email = $request->email;
        $receiver->phone = $request->phone;
        $receiver->address = $request->address;
        $receiver->save();

        return redirect()->route('receiver.index');
    }

    public function delete($id)
    {
        $receiver = Receiver::find($id);
        $receiver->delete();
        return redirect()->route('receiver.index');
    }

    public function view(Request $request, $id){
        $receiver = Receiver::find($id);
        return $receiver;
    }
}
