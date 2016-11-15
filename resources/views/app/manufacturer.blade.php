@extends('layout.master')

@section('title', 'Product Type Management')

@section('content')
<router-view></router-view>
@endsection

@push('script')
<script src="{{asset('js/manufacturer-management.js')}}"></script>
@endpush