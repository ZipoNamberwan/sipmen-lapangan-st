@extends('main')

@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
<link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />
<link rel="stylesheet" href="/assets/css/container.css">
<link rel="stylesheet" href="/assets/css/text.css">

@endsection

@section('container')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/receiving">Penerimaan Dokumen dari Petugas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
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
                        <h3 class="mb-0">Ubah Penerimaan Dokumen dari Petugas</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form id="formupdate" autocomplete="off" method="post" action="/receiving/{{$receiving->id}}" class="needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-control-label">Kecamatan <span class="text-danger">*</span></label>
                                    <select disabled readonly id="subdistrict" name="subdistrict" class="form-control" data-toggle="select" name="subdistrict" required>
                                        <option selected value="{{ $receiving->sls->village->subdistrict->id }}">
                                            [{{ $receiving->sls->village->subdistrict->code}}] {{ $receiving->sls->village->subdistrict->name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-control-label">Desa <span class="text-danger">*</span></label>
                                    <select disabled id="village" name="village" class="form-control" data-toggle="select" name="village">
                                        <option selected value="{{ $receiving->sls->village->id }}">
                                            [{{ $receiving->sls->village->code}}] {{ $receiving->sls->village->name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-control-label">SLS <span class="text-danger">*</span></label>
                                    <select disabled id="sls" name="sls" class="form-control" data-toggle="select" name="sls">
                                        <option selected value="{{ $receiving->sls->id }}">
                                            [{{ $receiving->sls->code}}] {{ $receiving->sls->name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div>
                                        <label class="form-control-label" for="exampleDatepicker">Tanggal Terima <span class="text-danger">*</span></label>
                                        <input name="date" class="form-control @error('date') is-invalid @enderror" placeholder="Pilih Tanggal" type="date" value="{{ @old('date', $receiving->date) }}">
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
                                        <input type="checkbox" name="map" @if($receiving->map == true) checked @endif>
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
                                        <input type="checkbox" name="l1" @if($receiving->l1 == true) checked @endif>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Ya"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div>
                                        <label class="form-control-label" for="exampleDatepicker">Jumlah L2 <span class="text-danger">*</span></label>
                                        <input name="l2" class="form-control @error('l2') is-invalid @enderror" placeholder="Jumlah L2" type="number" value="{{ @old('l2', $receiving->l2) }}">
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
                                        <input name="sender" class="form-control @error('sender') is-invalid @enderror" placeholder="Nama Pengirim" type="text" value="{{ @old('sender', $receiving->sender) }}">
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
                                        <input name="note" class="form-control @error('note') is-invalid @enderror" placeholder="Nama Pengirim" type="text" value="{{ @old('note', $receiving->note) }}">
                                        @error('note')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" id="submit" type="submit">Submit</button>
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

@endsection