@extends('layout.master')

@section('title', 'Undefined Management')

@section('content')
<router-view></router-view>
<vue-progress-bar></vue-progress-bar>
@endsection

@push('script')
<script src="{{asset('js/pxk-management.js')}}"></script>
@endpush