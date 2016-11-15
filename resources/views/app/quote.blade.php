@extends('layout.master')

@section('title', 'Undefined Management')

@section('content')
<section class="content-header">
    <h1>
        Báo Giá
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
    </ol>
</section>
<router-view></router-view>
<vue-progress-bar></vue-progress-bar>
@endsection

@push('script')
<script src="{{asset('js/quote-management.js')}}"></script>
@endpush