<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\w3lifehacks;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Str;
use Validator;
use App\User;
use View;
use Session;
use Illuminate\Support\Facades\Redirect;
use Request;
use Excel;
use Illuminate\Support\Facades\Input;
use App\Exports\UsersExport;
use Image;
use Auth;


class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the lifehacks
        $lifehacks = w3lifehacks::all();
        $users = User::all();

        // load the view and pass the life hacks
        return View::make('index', [
            'lifehacks'=> $lifehacks,
            'users' => $users
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // load the create form (app/views/CRUD/create.blade.php)
        return View::make('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
         $rules = array(
            'name'       => 'required',
            'description'      => 'required',

        );
        $lifehacks = w3lifehacks::all();

        $validator = Validator::make(Request::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('lifehacks/create')
                ->withErrors($validator)
              ->withInput(Request::except('password'));
        } else {
            // store
            $lifehack = new w3lifehacks;
            $lifehack->name       = Request::get('name');
            $lifehack->description     = Request::get('description');
            $lifehack-> user = Auth::user()->name;

            if(Request::hasFile('image')) {
                $image = Request::file('image');

                $folder = '/uploads/images/';
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = base_path("/public/uploads/images/");
                $watermark = Image::make(public_path('/images/watermark.png'));
                Image::make($image)->insert($watermark, 'bottom-right', 10, 10)->save($path . $filename);
                $lifehack->image = $filename;
            }
            
            $lifehack->save();

            // redirect
            Session::flash('message', 'Successfully created lifehack!');
            return Redirect::to('lifehacks');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // get the lifehack
        $lifehack = w3lifehacks::find($id);

        // show the view and pass the nerd to it
        return View::make('show')
            ->with('lifehack', $lifehack);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // get the nerd
        $lifehack = w3lifehacks::find($id);

        // show the edit form and pass the nerd
        return View::make('edit')
            ->with('lifehack', $lifehack);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'description'      => 'required'

        );
        $validator = Validator::make(Request::all(), $rules);

          // process the login
        if ($validator->fails()) {
            return Redirect::to('lifehacks/' . $id . '/edit')
               ->withErrors($validator)
                ->withInput(Request::except('password'));
        } else {
            // store
            $lifehack = w3lifehacks::find($id);
            $lifehack->name = Request::get('name');
            $lifehack->description = Request::get('description');

            if(Request::hasFile('image')) {
                $image = Request::file('image');

                $folder = '/uploads/images/';
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = base_path("/public/uploads/images/");
                $watermark = Image::make(public_path('/images/watermark.png'));
                Image::make($image)->insert($watermark, 'bottom-right', 10, 10)->save($path . $filename);
                $lifehack->image = $filename;
            }
            
            $lifehack->save();

            // redirect
            Session::flash('message', 'Successfully updated lifehack!');
            return Redirect::to('lifehacks');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $lifehack = w3lifehacks::find($id);
        $lifehack->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the lifehack!');
        return Redirect::to('lifehacks');
    }

    // exports users to excel
    public function export()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }





}
/** this is for authorisation -> for people to comment lifehacks that are not theirs */
/*
    public function comment($id)
    {
        $lifehack = w3lifehacks::find($id);
        $comment = new comments;
        $comment->description     = Request::get('description');
        $comment-> user = Request::get('user');
        $comment->save();

        Session::flash('message', 'Successfully added comment!');
        return Redirect::to('lifehacks');
        // show the edit form and pass the nerd

    }
    public function showcomment($id){
        $lifehack = w3lifehacks::find($id);
        return View::make('comment')
            ->with('lifehack', $lifehack);
    }

