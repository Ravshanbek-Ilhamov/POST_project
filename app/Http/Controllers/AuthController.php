<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/user-page')->with('success', 'You are logged in!');
        }else{
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->IP_address = $request->ip();
            $user->save();
    
            return redirect('/')->with('success', 'User Registered successfully. Please Login!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/posts')->with('success', 'You have been logged out.');
    }


    public function userPage(){
        $categories = Category::all();
        $posts = Post::paginate(9);
        return view('user.userPage',[

            'categories'=>$categories,
            'posts'=>$posts
        ]);
    }

    

}
