@extends('admin.layouts.app_admin')
@section('content')
<div class="container">
    <div class="container">
        <form action="{{ route('subOrder.update',$subOrder )}}" method="post">
            <input type="hidden" name="_method" value="put">
            @csrf
                <input type="hidden" name="id" value="{{$subOrder->id}}">
                <div class="form-group">
                    <label for="">Имя</label>
                    <input for="" class="form-control" type="text" name="position_name" placeholder="Автозаполнение" value="{{\App\PositionName::where('id',$subOrder->position_id)->first()->name}}" readonly>
                </div>

                <div class="form-group">
                    <label for="">Кол-во</label>
                    <input type="text" class="form-control"  name="number" value="{{$subOrder->number }}"  required>
                </div>
       
                <button type="submit" class="btn btn-primary">Изменить</button> 
                
        </form>
    </div>
</div>
@endsection