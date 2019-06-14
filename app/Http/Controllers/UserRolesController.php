<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRoles;
use App\Models\Modules;
use App\Models\UserRolePermissions;
Use Alert;
use DB;
class UserRolesController extends Controller
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
            $UserRoles = UserRoles::get();
           
            
            view()->share('elements', $UserRoles);
            return view('user_roles.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $Modules = Modules::get();
            view()->share('elements', $Modules);
            return view('user_roles.form');
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
                    'code' => 'required',
                ],
                [
                    'name.required' => 'User Role name is required!',
                    'code.required' => 'User Role code is required!!',
                  
                ]);


                $UserRoles = UserRoles::create([
                    'name' => $request->name,
                    'code' => $request->code,
                ]);

                //dd($request->element);
                foreach ($request->element as $key=>$value)
                {
                    $module_code=0;
                    $is_enable=0;
                    $can_create=0;
                    $can_read=0;
                    $can_update=0;
                    $can_delete=0;
                  
                    foreach($value as $index=>$element){
                     
                        if(!empty($value[0])){
                            $module_code=$value[0][0];
                        }
                        if(!empty($value[1])){
                            $is_enable=1;
                        }
                        if(!empty($value[2])){
                            $can_create=1;
                        }
                        if(!empty($value[3])){
                            $can_read=1;
                        }
                        if(!empty($value[4])){
                            $can_update=1;
                        }
                        if(!empty($value[5])){
                            $can_delete=1;
                        }
                       
                    }

                    $data[] = [
                        'role_code' =>$UserRoles->code,
                        'module_code' =>$module_code,
                        'is_enable' => $is_enable,
                        'can_create' =>$can_create,
                        'can_read' => $can_read,
                        'can_update' =>$can_update,
                        'can_delete' => $can_delete
                    ];
                }
               
                DB::table('user_role_permissions')->insert($data);
                return redirect()->route('user-roles-all-list')->with('success', 'Created Successfully!');
                    
                }
                catch (Exception $e)
                {
                    return redirect()->route('user-roles-create')->with('error', 'Error!');
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
            $UserRoles= UserRoles::find($id);
            view()->share('elementur', $UserRoles);

            $Modules = Modules::get();
            view()->share('elements', $Modules);

            return view('user_roles.form');
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $UserRoles= UserRoles::find($id);
            view()->share('elementur', $UserRoles);

            $Modules = Modules::get();
            view()->share('elements', $Modules);

            
           
            return view('user_roles.form');
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
                    'code' => 'required',
                ],
                [
                    'name.required' => 'User Role name is required!',
                    'code.required' => 'User Role code is required!!',
                  
                ]);

                $UserRoles=UserRoles::where('id',$id)->first();
                $UserRoles->name=$request->name;
                $UserRoles->save();

                DB::table('user_role_permissions')->where('role_code',$UserRoles->code)->delete();
                
                foreach ($request->element as $key=>$value)
                {
                    $module_code=0;
                    $is_enable=0;
                    $can_create=0;
                    $can_read=0;
                    $can_update=0;
                    $can_delete=0;
                    foreach($value as $index=>$element){
                       
                        if(!empty($value[0])){
                         //   dd($value[0][0]);
                            $module_code=$value[0][0];
                        }
                        if(!empty($value[1])){
                            $is_enable=1;
                        }
                        if(!empty($value[2])){
                            $can_create=1;
                        }
                        if(!empty($value[3])){
                            $can_read=1;
                        }
                        if(!empty($value[4])){
                            $can_update=1;
                        }
                        if(!empty($value[5])){
                            $can_delete=1;
                        }
                       
                    }
                  //  dd($value[$index]);
                    $data[] = [
                        'role_code' =>$UserRoles->code,
                        'module_code' =>$module_code,
                        'is_enable' => $is_enable,
                        'can_create' =>$can_create,
                        'can_read' => $can_read,
                        'can_update' =>$can_update,
                        'can_delete' => $can_delete
                    ];
                    
                }
                //dd($data);
                DB::table('user_role_permissions')->insert($data);



                return redirect()->route('user-roles-all-list')->with('success', 'Updated Successfully!');
    
            } catch (Exception $e) {
    
                return redirect()->route('user-roles-edit',$id)->with('error', 'Error!');
    
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
            $UserRoles = UserRoles::find($id);
            $UserRoles->delete();

            return redirect()->route('user-roles-all-list')->with('success', 'Deleted Successfully!');
        }
}
