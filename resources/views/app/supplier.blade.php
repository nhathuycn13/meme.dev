@extends('layout.master')

@section('title', 'Supplier Management')

@section('content')
<router-view></router-view>
@endsection

@push('script')
<script src="{{asset('js/supplier-management.js')}}"></script>
@endpush