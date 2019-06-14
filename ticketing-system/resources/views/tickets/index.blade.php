@extends('layouts.wysheit')
@section('optional_css')
@include('css.datatables')
@endsection
@section('content')

<!-- Page-header start -->
<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="icofont icofont-home"></i>
            </div>
            <div class="d-inline-block">
                    @php 
                    $title = Request::segment(1);
                    @endphp
                <h5>{{ ucwords(trans(str_replace('-',' ', $title))) }}</h5>
                <span>Information about all the {{$title}}</span>
            </div>
        </div>
        <div class="col">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="#!">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!"> {{ ucwords(trans(str_replace('-', ' ', $title))) }}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">{{ ucfirst(trans(Request::segment(2))) }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->
<!-- Page-body start -->
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
               <div class="card-header">
                    <div class="card-header-left">
                        <a href="/{{Request::segment(1)}}/create"
                            class="btn btn-grd-info waves-effect waves-light f-right d-inline-block md-trigger"> 
                            <i class="fa fa-plus"></i> Create New
                        </a>
                    </div>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option" style="width: 190px;">
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                        </ul>
                    </div>
                </div>

                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Support Type</th>
                                    <th>Status</th>
                                    <th width=20%; colspan=2>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($elements as $element)
                                <tr>
                                    <td>{{ $element->id }}</td>
                                    <td>{{ date('Y-m-d', strtotime($element->created_at)) }}</td>
                                    <td>{{ $element->title }}</td>
                                    <td>{{ ucwords(trans(str_replace('-',' ', $element->type))) }}</td>
                                    <td>
                                    @if($element->status==0)
                                        Pending
                                    @endif
                                    @if($element->status==1)
                                        On Process
                                    @endif
                                    @if($element->status==2)
                                        Solved
                                    @endif
                                    @if($element->status==3)
                                        Closed
                                    @endif
                                    </td>
                                    <td> 
                                            <a href="/{{Request::segment(1)}}/answer/{{ $element->id }}" class="btn btn-grd-success btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="REPLY"><i class="fa fa-reply"></i></a>
                                             @if(Auth::user()->user_role=='UR001')
                                            {{--  <a href="/{{Request::segment(1)}}/update/{{ $element->id }}" class="btn btn-grd-info btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="UPDATE"><i class="ti-pencil"></i></a> --}}
                                             @endif
                                             @if(Auth::user()->user_role=='AD001')
                                             <a href="/{{Request::segment(1)}}/answer/{{ $element->id }}" class="btn btn-grd-success btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="REPLY"><i class="fa fa-reply"></i></a>
                                             @endif
                                             
                                         </td>  
                                </tr>
                               @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Support Type</th>
                                    <th>Status</th>
                                    <th width=20%; colspan=2>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('after_scripts')

@include('scripts.datatables')




@endsection
