@extends('layout.master')

@section('title', 'Customer Management')

@section('content')
<router-view></router-view>
@endsection

@push('script')
<script src="{{asset('js/customer-management.js')}}"></script>
@endpush