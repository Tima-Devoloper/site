@extends('shopper.layouts.app')
@section('content')
<?php

$shopperId = \App\Shoppper::where('user_id', Auth::user()->id )->first()->id;  

$orders = $orders::where('shopper_id',$shopperId)->orderBy('delivery_date', 'asc')->get();


$date = new DateTime(null , new DateTimeZone('Asia/Almaty')); // Устонавливаем часавой пояс Asia/Almaty
$dateAlmatyUnix = strtotime($date->format('Y-m-d H:i:s') ); 

?>


<div class="container">
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
                        <form action="{{ route('order.storeShopper')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <div class="container">
                                        <input type="hidden" name="shopper_id" value="{{\Auth::user()->id}}">
                                        <div class="container">
                                            <label for="">Сколько позиций создать</label>
                                            <select name="count" class="form-control" id="exampleFormControlSelect1">
                                            @for($i=1;$i < 8 ; $i++)
                                            <option>{{$i}}</option>
                                            @endfor</select><br>
                                        </div>
                                        
                                        <div class="container">
                                            <label for="inputDate">Дата поставки(Месяц/день/год::AM первая половина дня PM вторая полована дня)</label>
                                            <input type="datetime-local" name="delivery_date" min="{{date('Y-m-dTG:i', $dateAlmatyUnix)}}" class="form-control" required>
                                                                                        
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
    </div><br>
    <h1>Активные заказы</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Дата поставки <br>(День.Месяц.Год)</th>
                <th>Общее кол-во</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0;?>
                @foreach($orders as $order)
                <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{ date("d.m.Y H:i", strtotime($order->delivery_date))}}</td>
                <td>
                
                    <?php
                    
                    $subOrders = \App\SubOrder::where( 'order_number' , $order->id )->get();
                    
                    $number     = 0;
                    foreach($subOrders as $subOrder)
                    {
                        $number     += $subOrder->number;      
                    }
                    echo $number , ' пачек';

                    ?>
                </td>
                <td><a href="shopper/order/showShopper/{{$order->id}}"><button class="btn btn-primary">Просмотр</button></a></td>
                </tr>
                @endforeach
                <tr>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection