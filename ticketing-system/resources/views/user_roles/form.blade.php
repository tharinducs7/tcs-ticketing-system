@extends('layouts.wysheit')
@section('optional_css')
@include('css.datepicker')
@endsection
@inject('UtilitiService', 'App\Services\UtilityService')
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
                <h5>{{ ucwords(trans(str_replace('-', ' ', $title))) }}</h5>
                <span></span>
                    <span> 
                        @if(Request::segment(2)=='create')
                            Create a new {{ ucwords(trans(str_replace('-', ' ', $singular))) }}
                        @endif
                        @if(Request::segment(2)=='view')
                            View {{ ucwords(trans(str_replace('-', ' ', $singular))) }} details
                        @endif
                        @if(Request::segment(2)=='update')
                            Update an exsisting {{ ucwords(trans(str_replace('-', ' ', $singular))) }}
                        @endif
                    </span>
            </div>
        </div>
        <div class="col">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item"><a href="#!">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">{{ ucwords(trans(str_replace('-', ' ',Request::segment(1)))) }} </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">{{ ucwords(trans(str_replace('-', ' ',Request::segment(2)))) }} </a>
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
                                <h5> {{ ucwords(trans(str_replace('-', ' ', $singular))) }} information</h5>
                        </div>
                    </div>
                <div class="card-block">
                    <form id="main" method="post" @if(Request::segment(2)=='create') action="{{ route($url.'-store') }}" @else action="{{ route($url.'-update',$elementur->id) }}"  @endif  novalidate="" _lpchecked="1">
                       @csrf 
                       @if ($errors->any())
                       @include('alerts.errors')
                       @endif
                        <div class="col-lg-12 row">
                        <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">User Role Name</label>
                            <div class="col-sm-8">
                                <input @if(Request::segment(2)=='view') readonly @endif type="text" class="form-control" name="name" @if(isset($elementur)) value="{{ old('name', $elementur->name) }}" @else value="{{ old('name') }}" @endif>
                                <span class="messages"></span>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">User Role Code</label>
                            <div class="col-sm-7">
                                    <input @if(Request::segment(2)=='view') readonly @endif  @if(Request::segment(2)=='update') readonly @endif type="text" class="form-control" name="code" @if(isset($elementur)) value="{{ old('code', $elementur->code) }}" @else value="{{ old('code') }}" @endif>
                                <span class="messages"></span>
                            </div>
                           
                        </div>
                        </div>
                    </div>
                 
                    <h6>Permissions</h6>
                    <div class="col-lg-12 row">
                    <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>Is Enable</th>
                                        <th>Create</th>
                                        <th>Read</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($elements as $key => $element)
                                @if(Request::segment(2)=='update')  
                                @php
                                  $permissions = $UtilitiService->getAccess($elementur->code,$element->md_code); 
                                @endphp 
                                @endif
                                @if(Request::segment(2)=='view')  
                                @php
                                  $permissions = $UtilitiService->getAccess($elementur->code,$element->md_code); 
                                @endphp 
                                @endif
                                    <tr>
                                        <th scope="row">
                                            <h4 class="sub-title">{{$element->md_name}}</h4>
                                            <input type="hidden" name="{{'element['.$element->id.'][0][]'}}" value="{{$element->md_code}}">
                                        </th>
                                        <td> 
                                            <div class="checkbox-color checkbox-primary">
                                                   
                                                    <input id="enable{{$element->id}}" name="{{'element['.$element->id.'][1][]'}}" type="checkbox"  @if(isset($permissions))  @if($permissions->is_enable=='1') checked @endif @endif  @if(Request::segment(2)=='view') disabled @endif>
                                                    <label for="enable{{$element->id}}">
                                                        Enable
                                                    </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox-color checkbox-success">
                                                <input  @if(isset($element))  @if($element->can_create=='off') disabled @endif @endif id="create{{$element->id}}" name="{{'element['.$element->id.'][2][]'}}" type="checkbox" @if(isset($permissions))  @if($permissions->can_create=='1') checked @endif @endif @if(Request::segment(2)=='view') disabled @endif>
                                                    <label for="create{{$element->id}}">
                                                        Create
                                                    </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox-color checkbox-info">
                                                <input @if(isset($element))  @if($element->can_read=='off') disabled @endif @endif  id="read{{$element->id}}" name="{{'element['.$element->id.'][3][]'}}"  type="checkbox" @if(isset($permissions))  @if($permissions->can_read=='1') checked @endif @endif @if(Request::segment(2)=='view') disabled @endif>
                                                    <label for="read{{$element->id}}">
                                                        Read
                                                    </label>
                                            </div> 
                                        </td>
                                        <td>
                                            <div class="checkbox-color checkbox-warning">
                                                <input @if(isset($element))  @if($element->can_update=='off') disabled @endif @endif  id="update{{$element->id}}" name="{{'element['.$element->id.'][4][]'}}"  type="checkbox" @if(isset($permissions))  @if($permissions->can_update=='1') checked @endif @endif @if(Request::segment(2)=='view') disabled @endif>
                                                  <label for="update{{$element->id}}">
                                                     Update
                                                  </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox-color checkbox-danger">
                                                <input @if(isset($element))  @if($element->can_delete=='off') disabled @endif @endif  id="delete{{$element->id}}" name="{{'element['.$element->id.'][5][]'}}" type="checkbox" @if(isset($permissions))  @if($permissions->can_delete=='1') checked @endif @endif @if(Request::segment(2)=='view') disabled @endif>
                                                <label for="delete{{$element->id}}">
                                                    Delete
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 row">
                    @if(Request::segment(2)!='view') 
                    <div class="form-group row">
                        <label class="col-sm-2"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-grd-success m-b-0"><i class="fa fa-save"></i> SAVE </button>
                        </div>
                    </div>
                    @endif
                    </div>
            </div>
        
          
               
        </div>
    </div>
</div>
</form>

@endsection

@section('after_scripts')

@include('scripts.datepicker')

@endsection
