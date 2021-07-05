<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Excel</title>
</head>
<body>
	<table border="1" width="100%">
	    <thead>
		    <tr>
		        <th>#</th>
		        <th>ID_Antri</th>
		        <th>Jenis Layanan</th>
		        <th>Nama Pemesan</th>
		        <th>Barbershop</th>
		        <th>Hairstyle</th>
		        <th>Gender Haircut</th>
		        <th>Harga</th>
		        <th>Jam COD</th>
		        <th>Status Order</th>
		        <th>Notes Pemesan</th>
		        <th>Lokasi COD</th>
		        <th>Order Selesai</th>
		    </tr>
	    </thead>
	    <tbody>
		    @foreach($transaksi as $no => $trx)
		        <tr>
		            <td align="center">{{ $no+1 }}</td>
		            <td align="center">{{ $trx->no_antri }}</td>
		            <td align="center">{{ $trx->jenis_layanan }}</td>
		            <td>{{ $trx->user->name }}</td>
		            <td>{{ $trx->barbershop->name }}</td>
		            <td>{{ $trx->hairstyle->name }}</td>
		            <td align="center">{{ $trx->hairstyle->gender }}</td>
		            <td align="center">Rp. {{ $trx->harga }}</td>
		            <td align="center">{{ $trx->jam_booking }}</td>
		            <td align="center">{{ $trx->status }}</td>
		            <td>{{ $trx->pesan }}</td>
		            <td>@if($trx->lokasi)<a href="https://www.google.com/maps/?q={{ $trx->lokasi }}">https://www.google.com/maps/?q={{ $trx->lokasi }}</a>@endif</td>
		            <td align="center">{{ $trx->updated_at }}</td>
		        </tr>
		    @endforeach
	    </tbody>
	</table>
</body>
</html>