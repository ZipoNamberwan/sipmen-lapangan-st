@extends('main')

@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
<link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />
@endsection

@section('container')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Penerimaan Dokumen</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title mb-2">Daftar Penerimaan Dokumen</h3>
                            <p class="card-text mb-0"><small>Berikut ini adalah daftar dokumen yang sudah diterima oleh Koseka</small></p>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="{{url('/receiving/create')}}" class="btn btn-primary btn-round btn-icon mb-2" data-toggle="tooltip" data-original-title="Absensi">
                                <span class="btn-inner--icon"><i class="fas fa-plus-circle"></i></span>
                                <span class="btn-inner--text">Terima Dokumen</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="datatable-id" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Identitas Wilayah</th>
                                <th>Peta WS</th>
                                <th>L1</th>
                                <th>Jumlah L2</th>
                                <th>Tanggal Terima</th>
                                <th>Nama Pengirim</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/datatables2/datatables.min.js"></script>
<script src="/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
<script src="/assets/vendor/momentjs/moment-with-locales.js"></script>

<script>
    var table = $('#datatable-id').DataTable({
        // "responsive": true,
        // "fixedColumns": true,
        // "fixedHeader": true,
        "scrollX": true,
        "order": [],
        "aLengthMenu": [
            [10, 50, -1],
            [10, 50, "All"]
        ],
        "iDisplayLength": -1,
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": '/receiving/data',
            "type": 'GET'
        },
        "columns": [{
                "responsivePriority": 1,
                "width": "15%",
                "data": "sls_name",
                "orderable": false,
                "render": function(data, type, row) {
                    if (type === 'display') {
                        return '<p class="mb-0"><span class="badge badge-primary">' + row.sls_id + '</span></p>' +
                            '<p class="mb-0"><span class="badge badge-success">' + data + '</span></p>';
                    }
                    return data;
                }
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "map",
                "render": function(data, type, row) {
                    if (type == "display") {
                        if (data == true) {
                            return '<i class="fas fa-check-circle text-success"></i>';
                        } else {
                            return '<i class="fas fa-minus-circle text-danger"></i>';
                        }
                    }
                    return data
                }
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "l1",
                "render": function(data, type, row) {
                    if (type == "display") {
                        if (data == true) {
                            return '<i class="fas fa-check-circle text-success"></i>';
                        } else {
                            return '<i class="fas fa-minus-circle text-danger"></i>';
                        }
                    }
                    return data
                }
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "l2",
            },
            {
                "responsivePriority": 2,
                "width": "10%",
                "data": "date",
            },
            {
                "responsivePriority": 2,
                "width": "10%",
                "data": "sender",
            },
            {
                "responsivePriority": 2,
                "width": "10%",
                "data": "note",
            },
            {
                "responsivePriority": 2,
                "width": "15%",
                "data": "id",
            },
        ],
        "language": {
            'paginate': {
                'previous': '<i class="fas fa-angle-left"></i>',
                'next': '<i class="fas fa-angle-right"></i>'
            }
        }
    });
</script>

<script>
    function deletesls($id, $name) {
        event.preventDefault();
        Swal.fire({
            title: 'Yakin Hapus SLS Ini?',
            text: $name,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formdelete' + $id).submit();
            }
        })
    }
</script>
@endsection