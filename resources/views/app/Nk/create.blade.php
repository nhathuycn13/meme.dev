@extends('layout.master')

@section('title', 'Fuck ya JS!!!')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Phieu Nhap Kho</h3>
    </div>
    <div class="panel-body">
        <table class="table">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>1</td>
                <td>
                    <select name="products[]" id="">
                        <option value=""></option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection

@push('script')
<script !src="">
    $(document).ready(function () {

    });
</script>
@endpush
