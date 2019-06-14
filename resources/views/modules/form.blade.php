@extends('layouts.wysheit')
@section('optional_css')
@include('css.datepicker')
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
                {{-- <div class="card-header">
                    <h5> {{ ucfirst(trans($singular)) }} information</h5>
                    <div class="card-header-right">
                            <a href="/{{Request::segment(1)}}/create"
                                class="btn btn-grd-info waves-effect waves-light f-right d-inline-block md-trigger"> 
                                <i class="fa fa-plus"></i> Create New
                            </a>
                        </div>
                </div> --}}
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
                    <form id="main" method="post" @if(Request::segment(2)=='create') action="{{ route($url.'-store') }}" @else action="{{ route($url.'-update',$element->id) }}"  @endif  novalidate="" _lpchecked="1">
                       @csrf 
                        <div class="col-lg-12 row">
                        <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Module Name</label>
                            <div class="col-sm-8">
                                <input @if(Request::segment(2)=='view') readonly @endif type="text" class="form-control" name="md_name" @if(isset($element)) value="{{ old('md_name', $element->md_name) }}" @else value="{{ old('md_name') }}" @endif>
                                <span class="messages"></span>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Module Code</label>
                            <div class="col-sm-7">
                                    <input @if(Request::segment(2)=='view') readonly @endif type="text" class="form-control" name="md_code" @if(isset($element)) value="{{ old('md_code', $element->md_code) }}" @else value="{{ old('md_code') }}" @endif>
                                <span class="messages"></span>
                            </div>
                           
                        </div>
                        </div>

                        <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Module URL</label>
                                    <div class="col-sm-8">
                                        <input @if(Request::segment(2)=='view') readonly @endif type="text" class="form-control" name="url" @if(isset($element)) value="{{ old('url', $element->url) }}" @else value="{{ old('url') }}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Module Icon</label>
                                    <div class="col-sm-7">
                                            <input @if(Request::segment(2)=='view') readonly @endif type="text" class="form-control" name="icon" @if(isset($element)) value="{{ old('icon', $element->icon) }}" @else value="{{ old('icon') }}" @endif>
                                        <span class="messages"></span>
                                    </div>
                                   
                                </div>
                                </div>

                        <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Create</th>
                                            <th>Read</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            
                                            <td>
                                                <div class="checkbox-color checkbox-success">
                                                    <input id="create" name="can_create" type="checkbox" @if(isset($element))  @if($element->can_create=='on') checked @endif @endif >
                                                        <label for="create">
                                                            Create
                                                        </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="checkbox-color checkbox-info">
                                                    <input id="read" name="can_read"  type="checkbox" @if(isset($element))  @if($element->can_read=='on') checked @endif @endif >
                                                        <label for="read">
                                                            Read
                                                        </label>
                                                </div> 
                                            </td>
                                            <td>
                                                <div class="checkbox-color checkbox-warning">
                                                    <input  id="update" name="can_update"  type="checkbox" @if(isset($element))  @if($element->can_update=='on') checked @endif @endif >
                                                      <label for="update">
                                                         Update
                                                      </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="checkbox-color checkbox-danger">
                                                    <input  id="delete" name="can_delete" type="checkbox" @if(isset($element))  @if($element->can_delete=='on') checked @endif @endif >
                                                    <label for="delete">
                                                        Delete
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if(Request::segment(2)!='view') 
                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-grd-success m-b-0"><i class="fa fa-save"></i> SAVE </button>
                            </div>
                        </div>
                        @endif
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

@endsection
