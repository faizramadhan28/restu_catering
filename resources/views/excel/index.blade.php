<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Transaksi</th>
            <th>Tanggal Transaksi</th>
            <th>Uang Keluar</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($kas as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item->nama_transaksi }}</td>
            <td>{{ $item->tgl_transaksi }}</td>
            <td>{{ $item->uang_keluar }}</td>
        </tr>
    @endforeach
    </tbody>
</table>