<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Kode Transaksi</th>
            <th>Kasir</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                <td>{{ $item->kode_transaksi }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>