<div>
    <canvas id="myChart"></canvas>
</div>

<div class="card-footer">
    {{-- <h4>
        Dari grafik diatas dapat disimpulkan produk yang terjual paling banyak pada bulan {!!'<strong>' . $bulan . '</strong>' !!} tahun {!!'<strong>' . $tahun . '</strong>' !!} adalah {!! '<strong>' . $tertinggiProduk . '</strong>' !!} dengan total penjualan {!! '<strong>' . $tertinggiValue . '</strong>' !!} buah. Sementara untuk produk yang terjual paling sedikit pada bulan {!!'<strong>' . $bulan . '</strong>' !!} tahun {!!'<strong>' . $tahun . '</strong>' !!} adalah {!! '<strong>' . $terendahProduk . '</strong>' !!} dengan total penjualan masing - masing {!! '<strong>' . $terendahValue . '</strong>' !!} buah.
    </h4> --}}

    <h4>
        Dari grafik diatas dapat disimpulkan produk yang terjual paling banyak pada bulan {!!'<strong>' . $bulan . '</strong>' !!} tahun {!!'<strong>' . $tahun . '</strong>' !!} adalah {!! '<strong>' . $tertinggi . '</strong>' !!}. Sementara untuk produk yang terjual paling sedikit pada bulan {!!'<strong>' . $bulan . '</strong>' !!} tahun {!!'<strong>' . $tahun . '</strong>' !!} adalah {!! '<strong>' . $terendah . '</strong>' !!}.
    </h4>
</div>
<script>
    @if ($totalData == 0)
        $('body .render').html('<div class="alert alert-danger text-center">Tidak ada data pada bulan ini</div>');
    @endif

    $('body .chart-title').html('Chart Produk {{$bulan}} {{$tahun}}');

    var label = [];
    var jumlah = [];

    @foreach ($chart as $key => $value)
        label.push('{{$chart[$key]["nama_produk"]}}');
        jumlah.push('{{$chart[$key]["jumlah"]}}');
    @endforeach

    var data = {
        labels: label,
        datasets: [{
            label: 'Penjualan',
            data: jumlah,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };

    var config = {
        type: 'bar',
        data: data,
        options: {}
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>