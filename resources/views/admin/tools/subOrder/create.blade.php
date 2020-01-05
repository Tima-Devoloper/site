@extends('admin.layouts.app_admin')
@section('content')
<div class="container">
    <div class="container">
        <form  class="needs-validation" action="{{ route('subOrder.store')}}" method="post">
        @csrf
        <input type="hidden" name="summ" value="{{ $request->count }}" >
        <input type="hidden" name="order_number" value="{{ $order->id}}">
        <br>
        @for($i = 0 ; $i < ($request->count) ; $i++ )
            <div class="form-row">
                <div class="col-md-6 mb-6">
                <label for=""><h3>Вид</h3></label>
                    <select name="{{$i}}" class="form-control" >
                    @foreach($position as $posit)            
                    <option value="{{$posit->id}}">
                        {{$posit->name}}
                    </option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-6">
                <label for="validationCustom02"><h3>Кол-во</h3></label>
                <input type="" class="form-control" name="{{1000+ $i}}" placeholder="Кол-во" required>
                </div>
            </div>
            <hr>
            <br>
        @endfor

        <input type="submit" class="btn btn-primary" value="отправить">
        </form>
    </div>
</div>
@endsection