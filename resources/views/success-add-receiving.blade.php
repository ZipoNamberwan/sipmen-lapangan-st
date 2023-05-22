@extends('main')

@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
<link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />
<link rel="stylesheet" href="/assets/css/container.css">
<link rel="stylesheet" href="/assets/css/text.css">

@endsection

@section('container')
<div class="header bg-success pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/receiving">Penerimaan Dokumen dari Petugas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Status</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="card my-3">
        <div class="card-body text-center">
            <i class="fa fa-check-circle fa-10x text-success mb-4"></i>
            <h3 class="card-title">Sukses</h3>
            <p class="card-text">Anda telah Terdaftar di Kegiatan }</p>
            <a href="/" class="btn btn-primary">Home</a>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/datatables2/datatables.min.js"></script>
<script src="/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>

<script>
    var table = $('#datatable-id').DataTable({
        // "responsive": true,
        // "fixedColumns": true,
        // "fixedHeader": true,
        "scrollX": true,
        "order": [],
        "searching": false,
        "aLengthMenu": [
            [-1],
            ["All"]
        ],
        "iDisplayLength": -1,
        "columns": [{
                "responsivePriority": 1,
                "width": "12%",
            },
            {
                "responsivePriority": 2,
                "width": "7%",
            },
            {
                "responsivePriority": 2,
                "width": "7%",
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
    $(document).ready(function() {
        $('#subdistrict').on('change', function() {
            loadVillage('0');
        });
        $('#village').on('change', function() {
            loadSls('0');
        });
    });

    function loadVillage(selectedvillage) {
        let id = $('#subdistrict').val();
        $('#village').empty();
        $('#village').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
            type: 'GET',
            url: '/receiving/village/' + id,
            success: function(response) {
                var response = JSON.parse(response);
                $('#village').empty();
                $('#village').append(`<option value="0" disabled selected>Pilih Desa</option>`);
                $('#sls').empty();
                $('#sls').append(`<option value="0" disabled selected>Pilih SLS</option>`);
                response.forEach(element => {
                    if (selectedvillage == String(element.id)) {
                        $('#village').append('<option value=\"' + element.id + '\" selected>' +
                            '[' + element.code + ']' + element.name + '</option>');
                    } else {
                        $('#village').append('<option value=\"' + element.id + '\">' + '[' +
                            element.code + '] ' + element.name + '</option>');
                    }
                });
            }
        });
    }

    function loadSls(selectedsls) {
        let id = $('#village').val();
        $('#sls').empty();
        $('#sls').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
            type: 'GET',
            url: '/receiving/sls/' + id,
            success: function(response) {
                var response = JSON.parse(response);
                $('#sls').empty();
                $('#sls').append(`<option value="0" disabled selected>Pilih SLS</option>`);
                response.forEach(element => {
                    if (selectedsls == String(element.id)) {
                        $('#sls').append('<option value=\"' + element.id + '\" selected>' +
                            '[' + element.code + ']' + element.name + '</option>');
                    } else {
                        $('#sls').append('<option value=\"' + element.id + '\">' + '[' +
                            element.code + '] ' + element.name + '</option>');
                    }
                });
            }
        });
    }
</script>

@endsection