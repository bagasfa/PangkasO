<table class="table table-bordered" id="table-transaksi" width="100%">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Jenis Layanan</th>
            <th scope="col">No. Antri</th>
            <th scope="col">Nama Pemesan</th>
            @if(auth()->user()->id_role != 3)
            <th scope="col">Barbershop</th>
            @endif
            <th scope="col">Hairstyle</th>
            <th scope="col">Harga</th>
            <th scope="col">Jam COD</th>
            <th scope="col">Status Order</th>
            <th scope="col">Order Selesai</th>
            @if(auth()->user()->id_role != 3)
            <th scope="col">Aksi</th>
            @endif
        </tr>
    </thead>
</table>