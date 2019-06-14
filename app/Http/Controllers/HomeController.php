<?php

namespace App\Http\Controllers;
use App\Models\Tickets;
use App\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(Auth::user()->role_code=='UR001'){

        $MyTicketsCount = Tickets::where('client_id',Auth::user()->id)->count();
        view()->share('MyTicketsCount', $MyTicketsCount);
        $PendingTicketsCount = Tickets::where('client_id',Auth::user()->id)->where('status',0)->count();
        view()->share('PendingTicketsCount', $PendingTicketsCount);
        $OnProTicketsCount = Tickets::where('client_id',Auth::user()->id)->where('status',1)->count();
        view()->share('OnProTicketsCount', $OnProTicketsCount);
        $SlovedTicketsCount = Tickets::where('client_id',Auth::user()->id)->where('status',2)->count();
        view()->share('SlovedTicketsCount', $SlovedTicketsCount);

        $NormalCount = Tickets::where('priority','Normal')->where('client_id',Auth::user()->id)->where('status','!=',2)->count();
        view()->share('NormalCount', $NormalCount);
        $HighCount = Tickets::where('priority','High')->where('client_id',Auth::user()->id)->where('status','!=',2)->count();
        view()->share('HighCount', $HighCount);
        $MediumCount = Tickets::where('priority','Medium')->where('client_id',Auth::user()->id)->where('status','!=',2)->count();
        view()->share('MediumCount', $MediumCount);
        
        
        }
        elseif(Auth::user()->role_code=='AD001'){

            $MyTicketsCount = Tickets::count();
            view()->share('MyTicketsCount', $MyTicketsCount);
            $PendingTicketsCount = Tickets::where('status',0)->count();
            view()->share('PendingTicketsCount', $PendingTicketsCount);
            $OnProTicketsCount = Tickets::where('status',1)->count();
            view()->share('OnProTicketsCount', $OnProTicketsCount);
            $SlovedTicketsCount = Tickets::where('status',2)->count();
            view()->share('SlovedTicketsCount', $SlovedTicketsCount);

            $NormalCount = Tickets::where('priority','Normal')->where('status','!=',2)->count();
            view()->share('NormalCount', $NormalCount);
            $HighCount = Tickets::where('priority','High')->where('status','!=',2)->count();
            view()->share('HighCount', $HighCount);
            $MediumCount = Tickets::where('priority','Medium')->where('status','!=',2)->count();
            view()->share('MediumCount', $MediumCount);

        }
        else{

            
            $MyTicketsCount = Tickets::where('type',Auth::user()->role_code)->count();
            view()->share('MyTicketsCount', $MyTicketsCount);
            $PendingTicketsCount = Tickets::where('type',Auth::user()->role_code)->where('status',0)->count();
            view()->share('PendingTicketsCount', $PendingTicketsCount);
            $OnProTicketsCount = Tickets::where('type',Auth::user()->role_code)->where('status',1)->count();
            view()->share('OnProTicketsCount', $OnProTicketsCount);
            $SlovedTicketsCount = Tickets::where('type',Auth::user()->role_code)->where('status',2)->count();
            view()->share('SlovedTicketsCount', $SlovedTicketsCount);

            $NormalCount = Tickets::where('type',Auth::user()->role_code)->where('priority','Normal')->where('status','!=',2)->count();
            view()->share('NormalCount', $NormalCount);
            $HighCount = Tickets::where('type',Auth::user()->role_code)->where('priority','High')->where('status','!=',2)->count();
            view()->share('HighCount', $HighCount);
            $MediumCount = Tickets::where('type',Auth::user()->role_code)->where('priority','Medium')->where('status','!=',2)->count();
            view()->share('MediumCount', $MediumCount);
        }

        return view('home');
    }
}
