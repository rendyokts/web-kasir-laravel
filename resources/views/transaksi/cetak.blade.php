<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: monospace;
            font-size: 11px;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 200px;
            margin: 0 auto;
        }

        .center {
            text-align: center;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 2px 0;
        }

        .total {
            font-weight: bold;
            margin-top: 8px;
        }

        .footer {
            text-align: center;
            margin-top: 12px;
        }

        .right {
            text-align: right;
        }

        .qty-col {
            width: 20px;
        }

        .price-col {
            width: 60px;
            text-align: right;
        }

        .subtotal-col {
            width: 70px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="center">
            <strong>KAFE ACENG</strong><br>
            Jl. Masjid At-Taufiq No.25<br>
            Jakarta Timur<br>
            -------------------------------
            <br>
            <small>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y H:i') }}</small><br>
            Kode: {{ $transaksi->kode_transaksi }}<br>
            Kasir: {{ $transaksi->user->name ?? '-' }}
        </div>

        <div class="line"></div>

        <table>
            @foreach ($transaksi->details as $item)
                <tr>
                    <td colspan="3">{{ $item->produk->nama_barang }}</td>
                </tr>
                <tr>
                    <td class="qty-col">{{ $item->qty }}x</td>
                    <td class="price-col">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td class="subtotal-col">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>

        <div class="line"></div>

        <table>
            <tr>
                <td><strong>Total</strong></td>
                <td class="right"><strong>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong></td>
            </tr>
        </table>

        <div class="footer">
            -------------------------------<br>
            Terima kasih atas kunjungan Anda!<br>
            <strong>KAFE ACENG</strong>
        </div>
    </div>
</body>

</html>
