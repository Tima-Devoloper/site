@extends('admin.layouts.app_admin')
@section('content')
 <!-- Злесь я специально открываю классическим методом php для того чтобы она не высвечывалась при открытии скобками -->
<?php
// Ниже я присваиваю переменной shopper ту модел которую мы ридактиреум чтобы дальше было удобно работать 
$shopper = \App\Shoppper::where('name', $request->shopper_name)->first();
?>

<div class="container">
    <form action="{{ route('shopper.update',$shopper )}}" method="post">
        <input type="hidden" name="_method" value="put">
        @csrf

            <input type="hidden" name="id" value="{{$shopper->id}}">
            <div class="form-group">
                <label for="">Имя</label>
                <input type="text" class="form-control"  name="name" placeholder="Имя" value="{{$shopper->name }}" required>
            </div>

            <div class="form-group">
                <label for="">Адресс</label>
                <input type="text" class="form-control"  name="adress" value="{{$shopper->adress }}"  required>
            </div>
            
            <button type="submit" class="btn btn-primary">Отправить</button> 
            
    </form>
</div>
@endsection