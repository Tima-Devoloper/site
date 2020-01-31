@extends('admin.layouts.app_admin')
@section('content')
<?php $i=0; ?>
<div class="contaier">
    <div class="container">
        <div class="container">
        <strong>От:{{$request->min_date}}  До: {{$request->max_date}}</strong>
        </div>
    </div>
</div>
<br>

<div class="container">
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-dark">
                <tr>
                    <td>#</td>
                    <td>Позиция</td>
                    <td>Кол-во</td>
                </tr>

                    @foreach($positions as $position)
                        <tr>
                            <th scope="row">{{ ++$i}}</th>
                            <td>{{$position->name}}</td>
                            <td>{{$fingers[$position->id]}}</td>
                            
                        </tr>
                    @endforeach     
            
            </table>
        </div>
    </div>
</div>

@endsection