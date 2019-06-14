<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modules;
Use Alert;

class ModulesController extends Controller
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
            $Modules = Modules::get();
            view()->share('elements', $Modules);
            return view('modules.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('modules.form');
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

                Modules::create($request->all());
                return redirect()->route('modules-all-list')->with('success', 'Created Successfully!');
                    
                } catch (Exception $e) {
        
                    return redirect()->route('modules-create')->with('error', 'Error!');
        
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
            $Modules= Modules::find($id);
            view()->share('element', $Modules);
            return view('modules.form');
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $Modules= Modules::find($id);
            view()->share('element', $Modules);
            return view('modules.form');
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

                Modules::find($id)->update($request->all());
                return redirect()->route('modules-all-list')->with('success', 'Updated Successfully!');
    
            } catch (Exception $e) {
    
                return redirect()->route('modules-edit',$id)->with('error', 'Error!');
    
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
            $Modules = Modules::find($id);
            $Modules->delete();

            return redirect()->route('modules-all-list')->with('success', 'Deleted Successfully!');
        }
}
