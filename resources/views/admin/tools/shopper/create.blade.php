@extends('admin.layouts.app_admin')
@section('content')
<div class="container">
    <form action="{{ route('shopper.store')}}" method="post">
    @csrf
        <div class="form-group">
            <label for="">Имя</label>
            <input type="text" class="form-control"  name="name" placeholder="Имя" required>
        </div>
        <div class="form-group">
            <label for="">Адресс</label>
            <input type="text" class="form-control"  name="adress" placeholder="Если нету адреса напишите 0" required>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>    
    </form>
</div>
@endsection