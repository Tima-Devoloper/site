@extends('admin.layouts.app_admin')
@section('content')
<div class="container"  style=" border: 4px solid grey;"><br>   
    <form action="{{ route('shopper.store')}}" method="post" >
    @csrf
        <div class="form-group">
            <label for="">Имя</label>
            <select name="user_id" class="form-control" id="exampleFormControlSelect1">
            @foreach($userShoppers as $userShopper)
            <option value="{{ $userShopper->id }}" >{{$userShopper->name}}</option>
            @endforeach</select>
        </div>
        <div class="form-group">
            <label for="">Адресс</label>
            <input type="text" class="form-control"  name="adress" placeholder="Если нету адреса напишите 0" required>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>    
    </form><br>
</div>
@endsection