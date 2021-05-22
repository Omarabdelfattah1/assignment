<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Crud;
class CrudController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'feild1' => 'required',
            'feild2' => 'required'
        ]);

        Crud::create($request->except('_token'));

        Mail::send('mail',[],function($message){
            $message->to('omar.abdelfattah.shehata@gmail.com','Omar')->subject('Hello');
        });

        return redirect('/');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Crud $crud)
    {
        return view('welcome')->with('cruds',Crud::paginate(10))->with('crud',$crud);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crud $crud)
    {
        
        $request->validate([
            'feild1' => 'required',
            'feild2' => 'required'
        ]);

        $crud->update($request->except('_token'));

        Mail::send('mail',[],function($message){
            $message->to('omar.abdelfattah.shehata@gmail.com','Omar')->subject('Hello');
        });
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Crud::destroy($id);
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
}
