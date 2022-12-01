<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Penerima</th>
            <th>Order Terbuat</th>
            <th>Pembayaran</th>
            <th>Status Order</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($orders as $key => $order)
        <tr>
            <td>{{ $key++ }}</td>
            <td>{{$order->nama_penerima}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->type_pembayaran->nama_pembayaran}}</td>
            <td>{{$order->status->inisial}}</td>
            <td>{{$order->total}}</td>
        </tr>
    @endforeach
    </tbody>
</table>