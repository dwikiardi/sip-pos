<div class="card d-block">
    <div class="card-header">
        <div class="card-title">Data Member</div>
        @can('adminAndStaff')
        <div class="card-options">
            <button class="btn btn-primary btn-add" style="margin-left: 2px">
                <i class="fa fa-plus"></i> Tambah
            </button>
        </div>
        @endcan
    </div>
    <div class="card-body">
        <table class="table table-stripped" id="tableData">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>No. Telp</th>
                <th>Alamat</th>
                <th>Poin</th>
                @can('adminAndStaff')
                <th>Aksi</th>
                @endcan
            </thead>
            <tbody>
                @foreach ($member as $member)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$member->name}}</td>
                        <td>{{$member->gender == 1 ? 'Laki - Laki' : 'Perempuan'}}</td>
                        <td>{{$member->phone}}</td>
                        <td>{{$member->address}}</td>
                        <td>{{$member->point}}</td>
                        @can('adminAndStaff')
                        <td>
                            <button class="btn btn-info btn-edit" data-id="{{$member->id}}">
                                <i class="fa fa-pencil"></i>
                            </button>
                            {{-- <button class="btn btn-danger btn-delete" data-id="{{$member->id}}">
                                <i class="fa fa-trash"></i>
                            </button> --}}
                        </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            lengthMenu: "Menampilkan _MENU_ data",
            search: "Cari:",
            emptyTable: "Tidak ada data tersedia",
            zeroRecords: "Tidak ada data yang cocok",
            loadingRecords: "Memuat data...",
            processing: "Memproses...",
            infoFiltered: "(difilter dari _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
    });
</script>