<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Attachments;
use App\Models\Replies;
use App\User;
Use Alert;
Use DB;
use Auth;
class TicketsController extends Controller
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
            
            if(Auth::user()->role_code=='UR001'){
                $Tickets = Tickets::where('client_id',Auth::user()->id)->get();
                view()->share('elements', $Tickets);
            }
            elseif(Auth::user()->role_code=='AD001'){
                
                $Tickets = Tickets::get();
                view()->share('elements', $Tickets);
    
            }
            else{
                $Tickets = Tickets::where('type',Auth::user()->role_code)->get();
                view()->share('elements', $Tickets);
            }
            return view('tickets.index');
        }

        public function solved()
        {
        
            if(Auth::user()->role_code=='UR001'){
                $Tickets = Tickets::where('status',2)->where('client_id',Auth::user()->id)->get();
                view()->share('elements', $Tickets);
            }
            elseif(Auth::user()->role_code=='AD001'){
                
                $Tickets = Tickets::where('status',2)->get();
                view()->share('elements', $Tickets);
    
            }
            else{
                $Tickets = Tickets::where('status',2)->where('type',Auth::user()->role_code)->get();
                view()->share('elements', $Tickets);
            }

            return view('tickets.index');
        }

        public function process()
        {
            $Tickets = Tickets::where('status',1)->get();
            view()->share('elements', $Tickets);
            return view('tickets.index');
        }

        public function pending()
        {
            $Tickets = Tickets::where('status',0)->get();
            view()->share('elements', $Tickets);
            return view('tickets.index');
        }

        public function high()
        {
            $Tickets = Tickets::where('priority','High')->where('status','!=',2)->get();
            view()->share('elements', $Tickets);
            return view('tickets.index');
        }

        public function medium()
        {
            $Tickets = Tickets::where('priority','Medium')->where('status','!=',2)->get();
            view()->share('elements', $Tickets);
            return view('tickets.index');
        }
        public function normal()
        {
            $Tickets = Tickets::where('priority','Normal')->where('status','!=',2)->get();
            view()->share('elements', $Tickets);
            return view('tickets.index');
        }
        

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('tickets.form');
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

                $name='';
                if($request->hasfile('image'))
                {
                    $image=$request->file('image');
                    $storage_path='uploads/images/';                      
                    $image->move($storage_path,$image->getClientOriginalName());
                    $name = $storage_path.''.$image->getClientOriginalName();
                }
       
                $Tickets = Tickets::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $name,
                    'client_id' => $request->client_id,
                    'type' => $request->type,
                    'status' => $request->status,
                ]);

                //Tickets::create($request->all());
                return redirect()->route('support-tickets-all-list')->with('success', 'Created Successfully!');
                    
                } catch (Exception $e) {
        
                    return redirect()->route('support-tickets-create')->with('error', 'Error!');
        
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
            $Tickets= Tickets::find($id);
            view()->share('element', $Tickets);

            
            $User= User::find($Tickets->client_id);
            view()->share('User', $User);

            return view('tickets.form');
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $Tickets= Tickets::find($id);
            view()->share('element', $Tickets);
            return view('tickets.form');
        }

        public function answer($id)
        {
            $Tickets= Tickets::find($id);
            view()->share('element', $Tickets);

            $replies= Replies::where('ticket_id',$id)->get();
            view()->share('replies', $replies);

            
            $User= User::find($Tickets->client_id);
            view()->share('User', $User);
            
            return view('tickets.answer');
        }

        public function answered(Request $request)
        {
               try{

                $Tickets= Tickets::find($request->ticket_id);

                if($Tickets->priority==$request->priority){
                    $priority ="";
                }
                else
                {
                    $priority = $request->priority;
                    $Tickets->priority = $request->priority;

                   
                }
                if($Tickets->type==$request->moved_to){
                    $moved_to = "";
                    $moved_from ="";
                }
                else
                {
                    $moved_to = $request->moved_to;
                    $moved_from = $Tickets->type;
                    $Tickets->type = $request->moved_to;
                }

                $Tickets->status = $request->status;

                $Tickets->save();

               $Replies = Replies::create([
                'ticket_id' => $request->ticket_id,
                'reply_by' => $request->reply_by,
                'moved_to' => $moved_to,
                'moved_from'=> $moved_from,
                'priority' => $priority,
                'description' => $request->description,
                ]);

               

                return redirect()->back()->with('success', 'Successfull!');
                    
                } catch (Exception $e) {
        
                    return redirect()->route('support-tickets-create')->with('error', 'Error!');
        
                }

               
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

                Tickets::find($id)->update($request->all());
                return redirect()->route('support-tickets-all-list')->with('success', 'Updated Successfully!');
    
            } catch (Exception $e) {
    
                return redirect()->route('support-tickets-edit',$id)->with('error', 'Error!');
    
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
            $Tickets = Tickets::find($id);
            $Tickets->delete();

            return redirect()->route('support-tickets-all-list')->with('success', 'Deleted Successfully!');
        }
}
