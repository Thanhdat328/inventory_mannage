<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {   
        if(Auth::user()->role_as == 'admin'){    
            $users = User::where('role_as', 'user')->orWhere('role_as','staff')->latest()->paginate(5);
            return view('admin.index', ['users' => $users]);
        } else {
            return redirect()->route('home')->with('status', 'Unauthorized access');
        }
    }

    public function edit($id)
    {
        try {
            if(Auth::user()->role_as == 'admin'){    
                $user = User::findOrFail($id);
                return view('admin.edit', ['user' => $user]);
            }
            else {
                return redirect()->route('home')->with('status', 'Unauthorized access');
            }
        }
        catch (Exception $e) {
            return redirect()->route('home')->with('status', $e->getMessage());
        }
    }

    public function update(Request $request)
{
    try {
        // Check if the user is an admin
        if (Auth::user()->role_as == 'admin') {    
            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $request->id,
                'role_as' => 'required|string|in:admin,user',
            ]);
           
           
            // Find and update the user
            $user = User::findOrFail($request->id);
            if ($user->name == $request->name && $user->email == $request->email && $user->role_as == $request->role_as) {
                return redirect()->back()->with('error', 'No changes made to the user.');
            }
            $user->name = $request->name; 
            $user->email = $request->email;
            $user->role_as = $request->role_as;
            
            $user->save();

            return redirect()->route('admin.index')->with('success', 'User updated successfully');
        } else {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }
    } catch (\Exception $e) {
        return redirect()->route('admin.edit', $request->id)->with('error', 'Error updating user: ' . $e->getMessage());
    }
}

    
    public function create() 
    {
        if(Auth::user()->role_as == 'admin'){    
            return view('admin.create');
        }
        else {
            return redirect()->route('home')->with('status', 'Unauthorized access');
        }
    }

    public function store(Request $request) 
    {
        try {
            if(Auth::user()->role_as == 'admin'){    
                $request->validate([
                    'name' =>'required|string|max:255',
                    'email' =>'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:8|confirmed',
                    'role_as' =>'required|in:user,staff'
                ]);

                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->role_as = $request->role_as;
                $user->save();

                return redirect()->route('admin.index')->with('status', 'User created successfully');
            }
            else {
                return redirect()->route('home')->with('status', 'Unauthorized access');
            }
        } 
        catch (\Exception $e ) {
            return redirect()->route('home')->with('status', $e->getMessage());
        }
    }
    
    public function view($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json($user);
    }
}
