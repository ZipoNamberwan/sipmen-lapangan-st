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
                            <li class="breadcrumb-item"><a href="/receiving">Penerimaan Dokumen</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card-wrapper">
                <!-- Custom form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Tambah Penerimaan Dokumen</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form id="formadd" autocomplete="off" method="post" action="/receiving" class="needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-control-label">Kecamatan <span class="text-danger">*</span></label>
                                    <select id="subdistrict" name="subdistrict" class="form-control" data-toggle="select" name="subdistrict" required>
                                        <option value="0" disabled selected> -- Pilih Kecamatan -- </option>
                                        @foreach ($subdistricts as $subdistrict)
                                        <option value="{{ $subdistrict->id }}" {{ old('subdistrict') == $subdistrict->id ? 'selected' : '' }}>
                                            [{{ $subdistrict->code}}] {{ $subdistrict->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('subdistrict')
                                    <div class="text-valid mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-control-label">Desa <span class="text-danger">*</span></label>
                                    <select id="village" name="village" class="form-control" data-toggle="select" name="village">
                                    </select>
                                    @error('village')
                                    <div class="text-valid mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-control-label">SLS <span class="text-danger">*</span></label>
                                    <select id="sls" name="sls" class="form-control" data-toggle="select" name="sls">
                                    </select>
                                    @error('sls')
                                    <div class="text-valid mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div>
                                        <label class="form-control-label" for="exampleDatepicker">Tanggal Terima <span class="text-danger">*</span></label>
                                        <input name="date" class="form-control @error('date') is-invalid @enderror" placeholder="Pilih Tanggal" type="date" value="{{ @old('date') }}">
                                        @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label class="form-control-label" for="validationCustomUsername">Apakah ada Peta WS? <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="map">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Ya"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label class="form-control-label" for="validationCustomUsername">Apakah ada L1? <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="l1">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Ya"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div>
                                        <label class="form-control-label" for="exampleDatepicker">Jumlah L2 <span class="text-danger">*</span></label>
                                        <input name="l2" class="form-control @error('l2') is-invalid @enderror" placeholder="Jumlah L2" type="number" value="{{ @old('l2') }}">
                                        @error('l2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div>
                                        <label class="form-control-label" for="exampleDatepicker">Pengirim <span class="text-danger">*</span></label>
                                        <input name="sender" class="form-control @error('sender') is-invalid @enderror" placeholder="Nama Pengirim" type="text" value="{{ @old('sender') }}">
                                        @error('sender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div>
                                        <label class="form-control-label" for="exampleDatepicker">Catatan (Jika Ada)</label>
                                        <input name="note" class="form-control @error('note') is-invalid @enderror" placeholder="Nama Pengirim" type="text" value="{{ @old('note') }}">
                                        @error('note')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" onclick="onAdd()" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#subdistrict').on('change', function() {
            console.log('load village')
            loadVillage('0');
        });
        $('#village').on('change', function() {
            loadSls('0');
        });
    });


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
                            '[' + element.code + '] ' + element.name + '</option>');
                    } else {
                        $('#sls').append('<option value=\"' + element.id + '\">' + '[' +
                            element.code + '] ' + element.name + '</option>');
                    }
                });
            }
        });
    }

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
                            '[' + element.code + '] ' + element.name + '</option>');
                    } else {
                        $('#village').append('<option value=\"' + element.id + '\">' + '[' +
                            element.code + '] ' + element.name + '</option>');
                    }
                });

                @if(@old('sls') != null) loadSls('{{@old("sls")}}') @endif
            }
        });
    }

    @if(@old('village') != null) loadVillage('{{@old("village")}}') @endif
</script>

<script>
    function onAdd() {
        event.preventDefault();

        var e = document.getElementById("subdistrict");
        var subdistrict
        if (e.selectedIndex != 0 && e.selectedIndex != -1)
            subdistrict = e.options[e.selectedIndex].text;

        var e = document.getElementById("village");
        var village
        if (e.selectedIndex != 0 && e.selectedIndex != -1)
            village = e.options[e.selectedIndex].text;

        var e = document.getElementById("sls");
        var sls
        if (e.selectedIndex != 0 && e.selectedIndex != -1)
            sls = e.options[e.selectedIndex].text;

        if (subdistrict != null && village != null && sls != null) {
            Swal.fire({
                title: 'Mohon Periksa Lagi Identitas Dokumen',
                text: 'Apakah yakin akan menerima dokumen ini? \n' + subdistrict + ', ' + village + ', ' + sls,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formadd').submit();
                }
            })
        } else {
            document.getElementById('formadd').submit();
        }
    }
</script>

@endsection