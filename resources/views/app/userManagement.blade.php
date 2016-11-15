@extends('layout.master')

@section('title', 'User Management')

@section('content')
<router-view></router-view>
@endsection

@push('script')
<script src="{{asset('js/user-management.js')}}"></script>
@endpush