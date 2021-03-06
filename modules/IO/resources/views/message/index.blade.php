@extends('layouts.app')
@section('content')
<ol class="breadcrumb bc-3">
    <li>
        <a href="/"><i class="fa fa-home"></i></a>
    </li>
    <li>
        <a href="{{route('messages.index')}}">{{trans('table.messages')}}</a>
    </li>
    <li class="active">
        <strong>Table</strong>
    </li>
</ol>
<form class="form-group row" id="formFilter" action="{{route('messages.index')}}" method="POST">
    <div class="col-sm-2 form-group">
        <label for="'per_page'">{{__('label.per_page')}}</label>
        <select name="'per_page'" class="form-control selectFilter" id="'per_page'">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
        </select>
    </div>
    <div class="col-sm-7 form-group">
        <label for="name">{{__('label.search')}}</label>
        <input name="name" class="form-control inputFilter" id="name">
    </div>
    <div class="col-sm-2 form-group">
        <label for="is_active">{{__('label.is_active')}}</label>
        <select name="is_active" class="form-control selectFilter" id="is_active">
            <option value="">All</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>
    <div class="col-sm-1 form-group">
        <label>{{__('label.action')}}</label>
        <a class="btn btn-primary btn-block" href="{{route('messages.create')}}"><i class="fa fa-plus"></i></a>
    </div>
</form>
<div  id="table">
    @include('io::message.table')
</div>
@endsection

@push('js')
    <script src="{{asset('build/form-filter.js')}}"></script>
    <script>
        Menu('#IOMenu', '#messageMenu')
    </script>
@endpush
