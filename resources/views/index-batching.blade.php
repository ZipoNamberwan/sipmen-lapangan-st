@extends('main')

@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
<link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />
@endsection

@section('container')
<div class="header bg-success pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pengiriman Dokumen</li>
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
                        <div class="col-md-9 mb-3">
                            <h3 class="card-title mb-2">Daftar Pengiriman Dokumen Oleh Koseka</h3>
                            <p class="card-text mb-0"><small>Tabel berikut menunjukkan daftar dokumen yang sudah dikirim oleh Koseka ke Kantor</small></p>
                            <p class="card-text mb-0"><small>&#8226; Gunakan kotak Search untuk melakukan pencarian </small></p>
                            <p class="card-text mb-0"><small>&#8226; Klik nama kolom untuk melakukan pengurutan </small></p>
                            <p class="card-text mb-0"><small>&#8226; Gunakan tombol <i class="fas fa-trash"></i> untuk membatalkan/menghapus pengiriman dokumen</small></p>
                            <p class="card-text mb-0"><small>&#8226; Dalam tampilan HP, tabel bisa di scroll ke kanan-kiri</small></p>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="{{url('/receiving/create')}}" class="btn btn-primary btn-round btn-icon mb-2" data-toggle="tooltip" data-original-title="Kirim Dokumen">
                                <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                                <span class="btn-inner--text">Kirim Dokumen</span>
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
                                <th>Pengiriman ke-</th>
                                <th>Tanggal Kirim</th>
                                <th>Penerima</th>
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
            "url": '/batching/data',
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
                "data": "box_no",
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
                "data": "receiver",
            },
            {
                "responsivePriority": 2,
                "width": "15%",
                "data": "id",
                "render": function(data, type, row) {
                    return "<form class=\"d-inline\" id=\"formdelete" + data + "\" name=\"formdelete" + data + "\" onsubmit=\"deleteReceiving('" + data + "','[" + row.sls_long_code + "] " + row.sls_name + "')\" method=\"POST\" action=\"/receiving/" + data + "\">" +
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