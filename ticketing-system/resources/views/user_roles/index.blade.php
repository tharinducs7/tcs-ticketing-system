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
                <h5>{{ ucwords(trans(str_replace('-', ' ', $title))) }}</h5>
                <span>Information about all the {{$title}}</span>
            </div>
        </div>
        <div class="col">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="#!">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">{{ ucwords(trans(str_replace('-', ' ', Request::segment(1)))) }}  </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">{{ ucwords(trans(str_replace('-', ' ', Request::segment(2)))) }} </a>
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
                       
                            @include('buttons._create')

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
                                    <th>User Role Name</th>
                                    <th>User Role Code</th>
                                    <th>Status</th>
                                    <th width=20%;>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($elements as $element)
                                <tr>
                                    <td>{{ $element->id }}</td>
                                    <td>{{ $element->name }}</td>
                                    <td>{{ $element->code }}</td>
                                    <td>{{ $element->active }}</td>
                                    @include('buttons._actions')
                                </tr>
                               @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                        <th>ID</th>
                                        <th>User Role Name</th>
                                        <th>User Role Code</th>
                                        <th>Status</th>
                                        <th width=20%;>Action</th>
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
