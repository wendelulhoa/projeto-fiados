<table class="table card-table table-vcenter text-nowrap">
    <thead>
        <tr>
            <th>data compra</th>
            <th>valor</th>
        </tr>
    </thead>
    <tbody id="">
        @foreach ($purchases as $item)
            <tr>
                <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                <td>R$ : {{moneyConvert($item->amount ?? 0.00)}}</td>
            </tr>
        @endforeach
    </tbody>
</table>