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
                <h5>{{ ucwords(trans(str_replace('-',' ', $title))) }}</h5>
                <span></span>
                    <span> 
                        @if(Request::segment(2)=='create')
                            Create a new  {{ ucwords(trans(str_replace('-', ' ', $singular))) }} 
                        @endif
                        @if(Request::segment(2)=='view')
                            View {{ ucwords(trans(str_replace('-', ' ', $singular))) }}  details
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
                    <li class="breadcrumb-item"><a href="#!">{{ ucwords(trans(str_replace('-', ' ', Request::segment(1)))) }}</a>
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
                                 <h5>{{ ucwords(trans(str_replace('-',' ', $singular))) }} information</h5>
                        </div>
                    </div>
                <div class="card-block">
                    <form id="main" method="post" @if(Request::segment(2)=='create') action="{{ route($url.'-store') }}" @else action="{{ route($url.'-update',$element->id) }}"  @endif  novalidate="" _lpchecked="1" enctype="multipart/form-data">
                       @csrf 
                        <div class="col-lg-12 row">
                        <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Customer Name</label>
                            <div class="col-sm-8">
                                <input readonly type="text" class="form-control" name="name" @if(isset($User)) value="{{ old('name', $User->name) }}" @else value="{{ Auth::user()->name }}" @endif>
                                <input @if(Request::segment(2)=='view' ) readonly @endif type="hidden" class="form-control" name="client_id" @if(isset($element)) value="{{ old('client_id', $element->client_id) }}" @else value="{{ Auth::user()->id }}" @endif>
                                <span class="messages"></span>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Support Type</label>
                            <div class="col-sm-8">
                                <select @if(Request::segment(2)=='view') disabled @endif  class="form-control js-example-basic-single" name="type">     
                                    <option value="general"
                                           @if(isset($element))
                                           @if(old('type',$element->type)=='general')
                                           selected="selected"
                                           @endif
                                           @endif
                                           >General Department</option>
                                    <option value="technical"
                                           @if(isset($element))
                                           @if(old('type',$element->type)=='technical')
                                           selected="selected"
                                           @endif
                                           @endif
                                           >Technical Department</option>
                                    <option value="finance"
                                           @if(isset($element))
                                           @if(old('type',$element->type)=='finance')
                                           selected="selected"
                                           @endif
                                           @endif
                                           >Finance Department</option>
                                    </select>
                                <span class="messages"></span>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input @if(Request::segment(2)=='view' ) readonly @endif type="text" class="form-control" name="title" @if(isset($element)) value="{{ old('title', $element->title) }}" @else value="{{ old('title') }}" @endif>
                                    <span class="messages"></span>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                            <textarea @if(Request::segment(2)=='view' ) readonly @endif  class="form-control max-textarea" maxlength="10000" rows="5" name="description"> @if(isset($element)) {{  $element->title }} @else  @endif </textarea>
                                      
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Attachment (Image)</label>
                                        <div class="col-sm-10">
                                            <input @if(Request::segment(2)=='view' ) readonly @endif type="file" class="form-control" name="image" @if(isset($element)) value="{{ old('image', $element->image) }}" @else value="{{ old('image') }}" @endif>
                                            <span class="messages"></span>
                                        </div>
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
@include('scripts.select2')
@endsection
