@extends('admin.layouts.app_admin')
@section('content')
<div class="container" style=" border: 4px solid grey;">
    <br>
    <h1 style="text-align:center;  " >
    Интрументы
    </h1><hr>
    <div class="container"><!--Заявки-->
        <br>
        <h2 style="text-align:center;  " >
        Заявки
        </h2>
        <div class="row">
            <div><!--Создать заявку-->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                Создать заявку
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('order.store')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <div class="container">
                                        <div class="container">
                                            <label for="">Сколько позиций создать</label>
                                            <select name="count" class="form-control" id="exampleFormControlSelect1">
                                            @for($i=1;$i < 8 ; $i++)
                                            <option>{{$i}}</option>
                                            @endfor</select><br>
                                        </div>
                                        
                                        <div class="container">
                                            <label for="">Кому</label>
                                            <select name="shopper_id" class="form-control" >
                                            @foreach($shoppers as  $shopper )
                                            <option value="{{$shopper->id}}">{{$shopper->name}}</option>
                                            @endforeach</select>
                                        </div><br>


                                        <div class="container">
                                            <label for="inputDate">Дата поставки</label>
                                            <input type="date" name="delivery_date" min="{{date('m.d.Y', strtotime(time()))}}" class="form-control" required>
                                                                                        
                                        </div>
                                    <br><br>
                                    <button type="submit" class="btn btn-primary">Начать</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </div><br><br>
            <div>
                <a href="{{ route('order.index')}}">
                    <button class="btn btn-primary">
                        Активные
                    </button>
                </a>
            </div><br><br>
            <div>
                <a href="{{ route('order.indexReady')}}">
                    <button class="btn btn-secondary">
                        Готовые
                    </button>
                </a>
            </div>
            <div>
            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orderParam">
            Запустить модальное окно
            </button>

            <!-- Modal -->
            <div class="modal fade" id="orderParam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('order.paramSearch') }}" method="post" >
                            @csrf
                                <h5>От</h5>
                                <input type="date" class="form-control" name="min_date" required>
                                <h5>До</h5>
                                <input type="date" class="form-control" name="max_date" required>
                                <h5>Компании</h5>
                                <select name="shopper_name" class="form-control" >
                                @foreach($shoppers as  $shopper )
                                <option value="{{$shopper->id}}" >{{$shopper->name}}</option>
                                @endforeach</select>
                                <br>
                                <button  type="submit" class="btn btn-primary">Отправить</button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div><hr>
    <div class="container"><!--Покупатели-->
        <br>
        <h2 style="text-align:center;  " >
        Покупатели
        </h2>
        <div class="row">
            <div ><!--Создать покупателя-->
                <a href="{{ route('shopper.create')}}">
                    <button class="btn btn-secondary" type="submit">Создать покупателя</button>
                </a>
            </div><br><br>
            <div><!--Редактировать-->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shopperEdit">
                Редактировать покупателя
                </button>

                <!-- Modal -->
                <div class="modal fade" id="shopperEdit" tabindex="-1" role="dialog" aria-labelledby="shopperEdit" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shopperEdit">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="admin/shopper/$shoppers/edit" method="get">
                        @csrf
                        <label for=""><h3>Сколько позиций создать</h3></label>
                                        <select name="shopper_name" class="form-control" id="exampleFormControlSelect1">
                                        @foreach($shoppers as  $shopper )
                                        <option>{{$shopper->name}}</option>
                                        @endforeach</select>
                        <br>
                        <button type="submit">Отправить</button>

                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div><hr>
<br>
</div><br>

@endsection
