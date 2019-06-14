@extends('layouts.wysheit')
@section('optional_css')
@include('css.modals')
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
                    <li class="breadcrumb-item"><a
                            href="#!">{{ ucwords(trans(str_replace('-', ' ', Request::segment(1)))) }}</a>
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
        <div class="col-sm-12 row">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Support Ticket :: {{ $element->id }}</h5>
                        <div class="card-header-right">
                            <a href="{{url()->previous()}}"
                                class="btn btn-grd-info waves-effect waves-light f-right d-inline-block md-trigger">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-block">
                        <ul class="feed-blog">
                            <li class="active-feed">
                                <div class="feed-user-img">
                                    <img src="/{{  $User->image }} " class="img-radius "
                                        alt="User-Profile-Image">
                                </div>
                                <h6><span class="label label-primary">@if(isset($User)) {{ $User->name }} : @endif
                                    </span> {{$element->title}} : <small
                                        class="text-muted">{{ date('Y-m-d', strtotime($element->created_at)) }}</small>
                                </h6>
                                <p class="m-b-15 m-t-15">To <b> @
                                        {{ ucwords(trans(str_replace('-',' ', $element->type))) }} Department ,</b><br>
                                    {{$element->description }}</p>
                                <div class="row">
                                    @if(!empty($element->image))
                                    <div class="col-auto text-center">
                                        <img src="{{url($element->image)}}" alt="img" class="img-fluid img-100"><br>
                                        <button type="button" class="btn btn-default btn-sm waves-effect"
                                            data-toggle="modal" data-target="#default-Modal">Zoom Image</button>
                                    </div>
                                    @endif
                                </div>
                            </li>
                            @if(isset($element->image))
                            <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{$element->title}} </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{url($element->image)}}" alt="img" class="img-fluid img-300"><br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect "
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @foreach ($replies as $item)
                            @php
                            $Replier = App\User::find($item->reply_by);
                            @endphp
                            <li class="diactive-feed">
                                <div class="feed-user-img">
                                <img src="/{{$Replier->image}}" class="img-radius "
                                        alt="User-Profile-Image">
                                </div>
                                <h6><span class="label label-success">{{$Replier->name}}</span> 
                                    @if(!empty($item->moved_to))
                                    Moved to <span class="text-c-blue m-10">
                                        {{ ucwords(trans(str_replace('-',' ', $item->moved_to))) }} Department ,
                                        @endif
                                    </span>
                                    @if(!empty($item->moved_from))
                                    From <span class="text-c-blue m-10"> 
                                        {{ ucwords(trans(str_replace('-',' ', $item->moved_from))) }} Department ,
                
                                    </span>
                                    @endif
                                    <small class="text-muted">
                                        {{ $Replier->created_at }}</small></h6>
                                <p class="m-b-15 m-t-15 ">{{-- <b> @ {{ $User->name }} ,</b> --}}
                                    {{ $item->description }} </p>
                            </li>
                            @endforeach
                            <form id="main" method="post" action="{{ route($url.'-answered',$element->id) }}"
                                novalidate="" _lpchecked="1">
                                @csrf
                                <input @if(Request::segment(2)=='answer' ) readonly @endif type="hidden"
                                    class="form-control" name="reply_by" value="{{ Auth::user()->id }}">
                                <input @if(Request::segment(2)=='answer' ) readonly @endif type="hidden"
                                    class="form-control" name="ticket_id" value="{{ $element->id }}">
                                @if($element->status!=2)
                                <li class="active-feed">
                                    <div class="feed-user-img">
                                        <img src="/{{ Auth::user()->image }}" class="img-radius "
                                            alt="User-Profile-Image">
                                    </div>
                                    <div class="col-lg-12 row">
                                        <div class="col-lg-7">
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label">Change Incident Type</label>
                                                <div class="col-sm-7">
                                                    <select @if(Request::segment(2)=='view' ) disabled @endif
                                                        class="form-control js-example-basic-single" name="moved_to">
                                                        <option value="general" @if(isset($element))
                                                            @if(old('type',$element->type)=='general')
                                                            selected="selected"
                                                            @endif
                                                            @endif
                                                            >General Department</option>
                                                        <option value="technical" @if(isset($element))
                                                            @if(old('type',$element->type)=='technical')
                                                            selected="selected"
                                                            @endif
                                                            @endif
                                                            >Technical Department</option>
                                                        <option value="finance" @if(isset($element))
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
                                        <div class="col-lg-5">
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label">Change Priority</label>
                                                <div class="col-sm-7">
                                                    <select @if(Request::segment(2)=='view' ) disabled @endif
                                                        class="form-control js-example-basic-single" name="priority">
                                                        <option value="Normal" @if(isset($element))
                                                            @if(old('Normal',$element->priority)=='Normal')
                                                            selected="selected"
                                                            @endif
                                                            @endif
                                                            >Normal</option>
                                                        <option value="Medium" @if(isset($element))
                                                            @if(old('Medium',$element->priority)=='Medium')
                                                            selected="selected"
                                                            @endif
                                                            @endif
                                                            >Medium</option>
                                                        <option value="High" @if(isset($element))
                                                            @if(old('type',$element->priority)=='High')
                                                            selected="selected"
                                                            @endif
                                                            @endif
                                                            >High</option>
                                                    </select>
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <textarea @if(Request::segment(2)=='view' ) readonly @endif
                                                    class="form-control max-textarea" maxlength="10000" rows="5"
                                                    name="description" placeholder="type your reply"> </textarea>
                                                <span class="messages"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                            <div class="form-group row">
                                                <label class="col-sm-5 col-form-label">Ticket Status</label>
                                                <div class="col-sm-7">
                                                    <select @if(Request::segment(2)=='view' ) disabled @endif
                                                        class="form-control js-example-basic-single" name="status">
                                                        <option value="1" @if(isset($element))
                                                            @if(old('status',$element->status)=='1')
                                                            selected="selected"
                                                            @endif
                                                            @endif
                                                            >On Process</option>
                                                        <option value="2" @if(isset($element))
                                                            @if(old('status',$element->status)=='2')
                                                            selected="selected"
                                                            @endif
                                                            @endif
                                                            >Solved</option>
                                                    </select>
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                        </div>

                                    @if(Request::segment(2)!='view')
                                    <div class="col-lg-12">
                                        <div class="form-group row">

                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-grd-success m-b-0"><i
                                                        class="fa fa-save"></i> SUBMIT </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </li>
                                @else  

                                You can't reply to a Sloved Ticket!
                                @endif
                            </form>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('after_scripts')

@include('scripts.modals')

@endsection
