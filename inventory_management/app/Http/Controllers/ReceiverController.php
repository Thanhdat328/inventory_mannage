<?php

namespace App\Http\Controllers;

use App\Models\Receiver;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ReceiverController extends Controller
{
    public function index()
    {
        $request_user = Auth::user();
        if ($request_user->role_as == 'admin') {
            $receivers = Receiver::paginate(5);
            
            return view('receiver.index', [
                'receivers' => $receivers,
                'request_user' => $request_user
            ]);
        } else {
            return redirect()->route('home')->with('status', 'Unauthorized access.');
        }

    }

    public function create(Request $request)
    {
        return view('receiver.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' =>'required|max:255',
            'email' =>'required|max:255',
            'phone' =>'required|max:11|min:10',
            'address' =>'required|max:255',

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
        try{
            $receiver = Receiver::find($id);
            $request_user = Auth::user();
            if ($request_user->role_as == 'admin' || $request_user->id == $receiver->id) {    
                return view('receiver.edit', ['receiver' => $receiver]);
            }
            else{
                return redirect()->route('home')->with('status', 'Unauthorized access.');
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->with('status', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([

            'name' =>'required|max:100',
            'email' =>'required|max:100',
            'phone' =>'required|max:11|min:10',
            'address' =>'required|max:100',

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
