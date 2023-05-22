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
    @if (session('success-create'))
    <div class="card my-3">
        <div class="card-body text-center">
            <i class="fa fa-check-circle fa-10x text-success mb-4"></i>
            <h3 class="card-title">Sukses</h3>
            <p class="card-text mb-1">Penerimaan dokumen berikut sudah direkam:</p>
            <h3>{{ session('success-create') }}</h3>
            <a href="{{url('/receiving/create')}}" class="btn btn-primary btn-round btn-icon mb-2" data-toggle="tooltip" data-original-title="Absensi">
                <span class="btn-inner--icon"><i class="fas fa-plus-circle"></i></span>
                <span class="btn-inner--text">Terima Dokumen Lagi</span>
            </a>
            <a href="{{url('/receiving/monitoring')}}" class="btn btn-outline-primary btn-round btn-icon mb-2" data-toggle="tooltip" data-original-title="Absensi">
                <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                <span class="btn-inner--text">Monitoring</span>
            </a>
        </div>
    </div>
    @endif

    @if (session('success-edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong> {{ session('success-edit') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    @if (session('success-delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Gagal! </strong>{{ session('success-delete') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9 mb-3">
                            <h3 class="card-title mb-2">Daftar Penerimaan Dokumen</h3>
                            <p class="card-text mb-0"><small>Tabel berikut menunjukkan daftar dokumen yang sudah diterima oleh Koseka</small></p>
                            <p class="card-text mb-0"><small>&#8226; Gunakan kotak Search untuk melakukan pencarian </small></p>
                            <p class="card-text mb-0"><small>&#8226; Klik nama kolom untuk melakukan pengurutan </small></p>
                            <p class="card-text mb-0"><small>&#8226; Gunakan tombol <i class="fas fa-edit"></i> untuk mengubah penerimaan dokumen</small></p>
                            <p class="card-text mb-0"><small>&#8226; Gunakan tombol <i class="fas fa-trash"></i> untuk membatalkan/menghapus penerimaan dokumen</small></p>
                            <p class="card-text mb-0"><small>&#8226; Dalam tampilan HP, tabel bisa di scroll ke kanan-kiri</small></p>
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
                                <th>Kecamatan</th>
                                <th>Desa</th>
                                <th>SLS</th>
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
                "responsivePriority": 2,
                "width": "5%",
                "data": "subdistrict_code",
                "render": function(data, type, row) {
                    if (type == "display") {
                        return "[" + data + "] " + row.subdistrict;
                    }
                    return data
                }
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "village_code",
                "render": function(data, type, row) {
                    if (type == "display") {
                        return "[" + data + "] " + row.village;
                    }
                    return data
                }
            },
            {
                "responsivePriority": 2,
                "width": "15%",
                "data": "sls_code",
                "render": function(data, type, row) {
                    if (type == "display") {
                        return "[" + data + "] " + row.sls;
                    }
                    return data
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
                "render": function(data, type, row) {
                    var unixTimestamp = new Date(data).getTime() / 1000 - (new Date).getTimezoneOffset() * 60;
                    if (type === 'display' || type === 'filter') {
                        return moment.unix(unixTimestamp).locale('id').format('LL');
                    }
                    return unixTimestamp;
                }
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
                "render": function(data, type, row) {
                    return "<a href=\"/receiving/" + data + "/edit\" class=\"btn btn-info btn-icon btn-sm\" data-toggle=\"tooltip\" data-original-title=\"Tambah SLS\">" +
                        "<span class=\"btn-inner--icon\"><i class=\"fas fa-edit\"></i></span>" +
                        // "<span class=\"btn-inner--text\">Selesai</span>" +
                        "</a>" +
                        "<form class=\"d-inline\" id=\"formdelete" + data + "\" name=\"formdelete" + data + "\" onsubmit=\"deleteReceiving('" + data + "','[" + row.sls_long_code + "] " + row.sls_name + "')\" method=\"POST\" action=\"/receiving/" + data + "\">" +
                        '@method("delete")' +
                        '@csrf' +
                        "<button class=\"btn btn-icon btn-outline-danger btn-sm\" type=\"submit\" data-toggle=\"tooltip\" data-original-title=\"Hapus Data\">" +
                        "<span class=\"btn-inner--icon\"><i class=\"fas fa-trash-alt\"></i></span></button></form>";
                }
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
    function deleteReceiving($id, $name) {
        event.preventDefault();
        Swal.fire({
            title: 'Batal Terima Dokumen ini?',
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