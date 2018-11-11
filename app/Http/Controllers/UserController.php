<?php

namespace U\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use U\Http\Requests\StoreUsers;
use U\Http\Requests\UpdateUser;
use U\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function getUsers(){
        $users = User::all()->where('id', '<>', Auth::id());
        return $users;
    }

    public function create()
    {
        return view('create');
    }

    public function store(StoreUsers $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        return $user;
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(UpdateUser $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->city = $request->city;
        $user->email =  $request->email;
        $user->hobby = $request->hobby;
        $user->admin = $request->admin == true ? 1 : 0;
        $user->save();
        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return '';
    }

    public function profile(){
        return view('user_profile');
    }

    public function getProfile(){
       return User::findOrFail(Auth::id());
    }

    public function updateHobby(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->hobby = $request->hobby;
        $user->save();
        return $user->hobby;

    }
}
