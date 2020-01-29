@extends('admin.layouts.app_admin')
@section('content')
{{$request}}
<div class="container" style=" border: 4px solid grey;">
    <div class="container">
        <form  class="needs-validation" action="{{route('admin.order.create')}}" method="get">
        @csrf
        <label for="">Кол-во позиций</label>
        <input for="" class="form-control" type="text" name="summ" placeholder="Автозаполнение" value="{{ $request->count }}" readonly>
        <br>
        @for($i = 0 ; $i < ($request->count) ; $i++ )
            <div class="form-row">
                <div class="col-md-6 mb-6">
                <label for=""><h3>Вид</h3></label>
                    <select name="count{{$i}}" class="form-control" >
                    @foreach($position as $posit)            
                    <option>
                        {{$posit->name}}
                    </option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-6">
                <label for="validationCustom02"><h3>Кол-во</h3></label>
                <input type="number" min="10" class="form-control" name="amount{{$i}}" placeholder="Кол-во" required>
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