@extends('manageOfProduction.layouts.app')
@section('content')
<div class="container" style=" border: 4px solid grey;">
    <div class="container" ><br>
        <form action="{{ route('subOrder.updateManageOfProduction',$subOrder )}}" method="post">
            <input type="hidden" name="_method" value="put">
            @csrf
                <input type="hidden" name="id" value="{{$subOrder->id}}">
                <div class="form-group">
                    <label for="">Позиция</label>
                    <input for="" class="form-control" type="text" name="position_name" placeholder="Автозаполнение" value="{{\App\PositionName::where('id',$subOrder->position_id)->first()->name}}" readonly>
                </div>

                <div class="form-group">
                    <label for="">Заявка (шт)</label>
                    <input type="text" class="form-control"  name="number" value="{{$subOrder->number }}"  readonly>
                </div>

                <div class="form-group">
                    <label for="">Сделано(шт)</label>
                    <input type="number" class="form-control"  name="orders_made" max="{{$subOrder->number }}" value="{{$subOrder->orders_made }}"  required>
                </div>   
                <button type="submit" class="btn btn-primary">Изменить</button> 
                
        </form>
        <br>
    </div>
</div>
@endsection