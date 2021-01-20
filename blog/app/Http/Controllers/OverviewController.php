<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\w3lifehacks;
use App\comments;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OverviewController extends Controller
{

    public function index()
    {

        $listhacks = w3lifehacks::all();
        $users = User::all();
        $comments = comments::all();

        return view('overview', [
            'listhacks' => $listhacks,
            'users' => $users,
            'comments' =>$comments
        ], compact('comments'));

    }
    public function store(Request $request)
    {

        $request->validate([
            'body' => 'required',
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        comments::create($input);
        // $users = User::has('comments')->get();
        return back()->with(['status' => 'Comment added!']);
    }

    public function destroy($id)
    {
        // delete
        $comments = comments::findorFail($id);
        $comments->delete();

        
        return back()->with(['status' => 'Comment deleted!']);
    }
}
