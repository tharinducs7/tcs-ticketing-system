<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserRoles;
use App\Models\Modules;
use App\User;
use App\Models\UserRolePermissions;
Use Alert;
use DB;
class UsersController extends Controller
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
            $User = User::get();
            view()->share('elements', $User);
            return view('users.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $User = User::get();
            view()->share('elements', $User);

            $UserRoles = UserRoles::get();
            view()->share('UserRoles', $UserRoles);

            return view('users.form');
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

                $request->validate([
                    'name' => 'required',
                  
                    'role_code' => 'required',
                   
                    'email' => 'required|E-Mail',
                    'password' => 'required',
                    
                ]
               );


                $name='';
                if($request->hasfile('image'))
                {
                    $image=$request->file('image');
                    $storage_path='uploads/profile/';                      
                    $image->move($storage_path,$image->getClientOriginalName());
                    $name = $storage_path.''.$image->getClientOriginalName();
                }

                $User = User::create([
                    'name' => $request->name,
                    'image' => $name,
                    'role_code' => $request->role_code,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),

                    
                ]);

               
                return redirect()->route('users-all-list')->with('success', 'Created Successfully!');
                    
                }
                catch (Exception $e)
                {
                    return redirect()->route('users-create')->with('error', 'Error!');
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
            $User= User::find($id);
            view()->share('element', $User);

            $UserRoles = UserRoles::get();
            view()->share('UserRoles', $UserRoles);

            

            return view('users.form');
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $User= User::find($id);
            view()->share('element', $User);
           
            $UserRoles = UserRoles::get();
            view()->share('UserRoles', $UserRoles);
            
            return view('users.form');
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

                $request->validate([
                    'name' => 'required',
                    'role_code' => 'required',
                    'email' => 'required|E-Mail',
                    'password' => 'required',
                   
                ]
               );

               $name='';
               if($request->hasfile('image'))
               {
                   $image=$request->file('image');
                   $storage_path='uploads/profile/';                      
                   $image->move($storage_path,$image->getClientOriginalName());
                   $name = $storage_path.''.$image->getClientOriginalName();
               }

                $User=User::where('id',$id)->first();
                $User->name=$request->name;
                $User->image = $name;
                $User->role_code = $request->role_code;
                $User->email = $request->email;
                $User->password = Hash::make($request->password);
                $User->save();
                
                return redirect()->route('users-all-list')->with('success', 'Updated Successfully!');
    
            } catch (Exception $e) {
    
                return redirect()->route('users-edit',$id)->with('error', 'Error!');
    
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
            $User = User::find($id);
            $User->delete();

            return redirect()->route('users-all-list')->with('success', 'Deleted Successfully!');
        }
}
