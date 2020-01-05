@extends('manageOfProduction.layouts.app')
@section('content')
<?php $i=0; ?>
<div class="container">
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-dark">
                <tr>
                    <td>#</td>
                    <td>Позиция</td>
                    <td>Кол-во</td>
                    <td>Сделано</td>
                    <td>Дата поставки</td>
                    <td></td>
                </tr>
                 @foreach($subOrders as $subOrder)
                    <tr>
                        <th scope="row">{{ ++$i}}</th>
                        <td>{{$positions::where('id',$subOrder->position_id)->first()->name}}</td>
                        <td>{{$subOrder->number}}</td>
                        <td>
                        
                        <?php
                        
                        print_r($subOrder->orders_made);    
                        
                        $onePercentNumber = $subOrder->number / 100 ;
                        $remained = $subOrder->number - $subOrder->orders_made  ;
                        echo ' штук ,' ,' ' , $remainedPercent = floor( 100 - ( $remained / $onePercentNumber ) )  ,' %'; 
                        ?>
                        
                        </td>
                        <td><?php echo date("d.m.Y H:i", strtotime($order->delivery_date)); ?></td>
                        <td><a href='{{ route("subOrder.editManageOfProduction" ,$subOrder->id) }}'><button class="btn btn-primary">Редактировать</button></a></td>
                    </tr>
                @endforeach     
            </table>
        </div>
    </div>
</div>
@endsection