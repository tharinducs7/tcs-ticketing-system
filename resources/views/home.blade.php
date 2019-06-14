@extends('layouts.wysheit')

@section('content')

<!-- Page-header start -->
<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="icofont icofont-home"></i>
            </div>
            <div class="d-inline-block">
                <h5>Hi, {{ Auth::user()->name }} ! </h5>
                <span>Have a nice day!</span>
            </div>
        </div>
        <div class="col">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="#!">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->

<div class="page-body">
    <div class="row">
        <!-- order-card start -->

        <div class="col-md-6 col-xl-3">
            <a href="/support-tickets/all">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">My Tickets</h6>
                        <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span>{{$MyTicketsCount}}</span>
                        </h2>
                        <p class="m-b-0"><span class="f-right"></span></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-3">
            <a href="/support-tickets/solved">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Solved Tickets</h6>
                        <h2 class="text-right"><i class="ti-tag f-left"></i><span> {{$SlovedTicketsCount}} </span></h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-3">
            <a href="/support-tickets/on-process">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">On Process Tickets</h6>
                        <h2 class="text-right"><i class="ti-reload f-left"></i><span>{{ $OnProTicketsCount }}</span>
                        </h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-3">
            <a href="/support-tickets/pending">
                <div class="card bg-c-pink order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Pending Tickets</h6>
                        <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{$PendingTicketsCount}}</span>
                        </h2>

                    </div>
                </div>
            </a>
        </div>

        <!-- social statustic start -->
        <div class="col-md-12 col-lg-4">
            <a href="/support-tickets/normal">
            <div class="card">
                <div class="card-block text-center">
                    <i class="fa fa-envelope-open text-c-blue d-block f-40"></i>
                    <h4 class="m-t-20"><span class="text-c-blue"> {{$NormalCount}} </span></h4>
                    <p class="m-b-20">Take your time and finish them!</p>
                    <button class="btn btn-primary btn-sm btn-round">Normal Priority</button>
                </div>
            </div> 
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <a href="/support-tickets/medium">
            <div class="card">
                <div class="card-block text-center">
                    <i class="fa fa-twitter text-c-green d-block f-40"></i>
                    <h4 class="m-t-20"><span class="text-c-blgreenue">{{$MediumCount }}</span></h4>
                    <p class="m-b-20">You better look at these things!</p>
                    <button class="btn btn-success btn-sm btn-round">Medium Priority</button>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
                <a href="/support-tickets/high">
            <div class="card">
                <div class="card-block text-center">
                    <i class="fa fa-puzzle-piece text-c-pink d-block f-40"></i>
                    <h4 class="m-t-20"><span class="text-c-red">{{$HighCount }}</span></h4>
                    <p class="m-b-20">Oh! finish them before they finish you!</p>
                    <button class="btn btn-danger btn-sm btn-round">High Priority</button>
                </div>
            </div>
                </a>
        </div>
        <!-- social statustic end -->
    </div>
</div>


@endsection
