@extends('layout.master')

@section('title', 'Role Management')

@section('content')
<router-view></router-view>
@endsection

@push('script')
<script src="{{asset('js/role-management.js')}}"></script>
@endpush