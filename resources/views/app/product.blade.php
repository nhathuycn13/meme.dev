@extends('layout.master')

@section('title', 'Customer Management')

@section('content')
<router-view></router-view>
@endsection

@push('script')
<script src="{{asset('js/product-management.js')}}"></script>
@endpush