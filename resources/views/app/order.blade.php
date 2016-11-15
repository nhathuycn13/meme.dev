@extends('layout.master')

@section('title', 'Order Management')

@section('content')
<router-view></router-view>
<vue-progress-bar></vue-progress-bar>
@endsection

@push('script')
<script src="{{asset('js/order-management.js')}}"></script>
@endpush