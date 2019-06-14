<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Replies;
Use Alert;

class RepliesController extends Controller
{
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $Replies = Replies::get();
            view()->share('elements', $Replies);
            return view('replies.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
          
            return view('replies.form');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
               try{

                Replies::create($request->all());
                return redirect()->route('replies-all-list')->with('success', 'Created Successfully!');
                    
                } catch (Exception $e) {
        
                    return redirect()->route('replies-create')->with('error', 'Error!');
        
                }

               
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $Replies= Replies::find($id);
            view()->share('element', $Replies);
            return view('replies.form');
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $Replies= Replies::find($id);
            view()->share('element', $Replies);
            return view('replies.form');
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            try {

                Replies::find($id)->update($request->all());
                return redirect()->route('replies-all-list')->with('success', 'Updated Successfully!');
    
            } catch (Exception $e) {
    
                return redirect()->route('replies-edit',$id)->with('error', 'Error!');
    
            }
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $Replies = Replies::find($id);
            $Replies->delete();

            return redirect()->route('replies-all-list')->with('success', 'Deleted Successfully!');
        }
}
