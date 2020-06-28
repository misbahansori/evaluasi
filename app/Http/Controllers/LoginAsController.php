<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginAsController extends Controller
{
    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('permission:login-as');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.login-as.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::loginUsingId($request->user_id);

        return redirect()->route('home');
    }
}
