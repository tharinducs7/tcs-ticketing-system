@extends('layouts.wysheit')
@section('optional_css')
@include('css.datepicker')
@include('css.select2')

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
                $singular = str_singular(Request::segment(1));
                $url = Request::segment(1);
                @endphp
                <h5>{{ ucfirst(trans($title)) }}</h5>
                <span></span>
                <span>
                    @if(Request::segment(2)=='create')
                    Create a new {{$singular}}
                    @endif
                    @if(Request::segment(2)=='view')
                    View {{$singular}} details
                    @endif
                    @if(Request::segment(2)=='update')
                    Update an exsisting {{ $singular }}
                    @endif
                </span>
            </div>
        </div>
        <div class="col">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="#!">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">{{ ucfirst(trans(Request::segment(1))) }}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">{{ ucfirst(trans(Request::segment(2))) }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <!-- Basic Inputs Validation start -->
            <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <a href="{{url()->previous()}}"
                        class="btn btn-grd-info waves-effect waves-light f-right d-inline-block md-trigger">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-header-right">
                    <h5> {{ ucfirst(trans($singular)) }} information</h5>
                </div>
            </div>
            <div class="card-block">
                <form id="main" method="post" @if(Request::segment(2)=='create' ) action="{{ route($url.'-store') }}"
                    @else action="{{ route($url.'-update',$element->id) }}" @endif novalidate="" _lpchecked="1"  enctype="multipart/form-data">
                    @csrf
                  
                    <div class="col-lg-12 row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">First Name</label>
                                <div class="col-sm-8">
                                    <input @if(Request::segment(2)=='view' ) readonly @endif type="text"
                                        class="form-control" name="name" @if(isset($element))
                                        value="{{ old('name', $element->name) }}" @else value="{{ old('name') }}"
                                        @endif>

                                    @if(Request::segment(2)=='create')
                                    <input readonly type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                    @endif
                                    @if(Request::segment(2)=='update')
                                    <input readonly type="hidden" name="updated_by" value="{{ Auth::user()->id }}">
                                    @endif

                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input required @if(Request::segment(2)=='view' ) readonly @endif type="email"
                                            class="form-control" name="email" @if(isset($element))
                                            value="{{ old('email', $element->email) }}" @else value="{{ old('email') }}"
                                            @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Profile Picture</label>
                                        <div class="col-sm-10">
                                            <input @if(Request::segment(2)=='view' ) readonly @endif type="file" class="form-control" name="image" @if(isset($element)) value="{{ old('image', $element->image) }}" @else value="{{ old('image') }}" @endif>
                                            <span class="messages"></span>
                                        </div>
                                    </div>
                                    </div>
                         
                        <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">User Role</label>
                                    <div class="col-sm-8">
                                        <select @if(Request::segment(2)=='view' ) disabled @endif
                                            class="form-control js-example-basic-single" name="role_code">
                                            @foreach ($UserRoles as $userrole)
                                            {{-- <option>Please Select</option> --}}
                                            <option value="{{$userrole->code}}" @if(isset($element))
                                                @if(old('role_code',$element->role_code)==$userrole->code)
                                                selected="selected"
                                                @endif
                                                @endif
                                                >{{$userrole->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                            </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input @if(Request::segment(2)=='view' ) readonly @endif type="password"
                                        class="form-control" name="password" 
                                        value="{{ old('password') }}">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                   
                        
                 
                        
                        <div class="col-lg-6">
                               
                          

                        @if(Request::segment(2)!='view')
                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-grd-success m-b-0"><i class="fa fa-save"></i> SAVE
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <!-- Basic Inputs Validation end -->

    </div>
</div>
</div>


@endsection
@section('after_scripts')
@include('scripts.datepicker')
@include('scripts.select2')

@endsection
