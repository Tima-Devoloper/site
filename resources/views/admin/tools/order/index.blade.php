@extends('admin.layouts.app_admin')
@section('content')
    <div class="container">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Кому</th>
                    <th scope="col">Дата поставки</th>
                    <th>Осталось(ся)</th>  
                    <th>Сделано</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0;?>
                    @foreach($orders as $order)
                    <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>{{$shopper::where('id',$order->shopper)->first()->name}}</td>
                    <td>{{ date("d.m.Y H:i", strtotime($order->delivery_date))}}</td>
                    <td>
                    
                        <?php
                        // Здесь мы считаем и выводим время оставшееся до выполнения заказа

                        $date = new DateTime(null , new DateTimeZone('Asia/Almaty')); // Устонавливаем часавой пояс Asia/Almaty
                        $dateAlmatyUnix = strtotime($date->format('Y-m-d H:i:s') ); 
                        
                        $remained = strtotime($order->delivery_date) - $dateAlmatyUnix; 
                        
                        // Функция floor округляет дробное число в меньшую сторону
                         $day = floor($remained / 86400);

                        if($day ==  1 ){

                            echo $day ,'день';

                        }elseif($day > 1 AND $day < 5)
                        {

                            echo $day , 'дня';

                        }else
                        {
                            
                            echo $day , 'дней';
                        }

                        ?>

                    </td>
                    <td>
                    
                        <?php
                        
                        $subOrders = \App\SubOrder::where( 'order_number' , $order->id )->get();
                        
                        $number = 0;
                        $order_made = 0;

                        foreach($subOrders as $subOrder)
                        {
                            $order_made += $subOrder->orders_made;
                            $number     += $subOrder->number;      
                        }

                        if($number > 0 )
                        {
                            $onePercentOrder = $number / 100 ;
                            $restOrder = [
                                'percent' => floor(   $order_made  / $onePercentOrder ),
                                'pieces'  =>  $order_made,
                            ];
    
                            echo $restOrder['percent'] , '%  | ' , $number , '/' ,$restOrder['pieces'] , 'шт'; 
                        }else
                        {
                            echo 'Сделано';
                        }
                        ?>
                    </td>
                    <td><a href="/admin/order/{{$order->id}}"><button class="btn btn-primary">Просмотр</button></a></td>
                    </tr>
                    @endforeach
                    <tr>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection