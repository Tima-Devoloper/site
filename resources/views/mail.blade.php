<?php $i=0; ?>
<div class="container">
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-dark">
                <tr>
                    <td>#</td>
                    <td>Позиция</td>
                    <td>Кол-во</td>
                    <td>Дата поставки</td>
                </tr>
                 @foreach($subOrders as $subOrder)
                    <tr>
                        <th scope="row">{{ ++$i}}</th>
                        <td>{{$positions::where('id',$subOrder->position_id)->first()->name}}</td>
                        <td>{{$subOrder->number}}</td>
                        <td><?php echo date("d.m.Y H:i", strtotime($order->delivery_date)); ?></td>
                    </tr>
                @endforeach     
            </table>
        </div>
    </div>
</div>