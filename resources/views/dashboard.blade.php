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
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-1 mt-2">Penerimaan Dokumen</h5>
                            <div class="d-flex align-items-center">
                                <span class="h3 font-weight-bold mb-0">{{$receiving}} / {{$total}} SLS</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                <i class="fas fa-list"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/receiving')}}" class="btn btn-primary btn-sm btn-round btn-icon mb-2 mt-3" data-toggle="tooltip" data-original-title="Terima Dokumen">
                        <span class="btn-inner--icon"><i class="fas fa-plus-circle"></i></span>
                        <span class="btn-inner--text">Terima Dokumen</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-1 mt-2">Pengiriman Dokumen</h5>
                            <div class="d-flex align-items-center">
                                <span class="h3 font-weight-bold mb-0">7 / {{$total}} SLS</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-send"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/receiving')}}" class="btn btn-primary btn-sm btn-round btn-icon mb-2 mt-3" data-toggle="tooltip" data-original-title="Kirim Dokumen">
                        <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                        <span class="btn-inner--text">Kirim Dokumen</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-1 mt-2">Monitoring Per SLS</h5>
                            <div class="d-flex align-items-center">
                                <span class="h5 font-weight-light mb-0">Lihat Monitoring Penerimaan dan Pengiriman Dokumen</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/receiving')}}" class="btn btn-primary btn-sm btn-round btn-icon mb-2 mt-3" data-toggle="tooltip" data-original-title="Monitoring">
                        <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                        <span class="btn-inner--text">Monitoring</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title">Penerimaan dan Pengiriman Dokumen per Desa</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="datatable-id" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Kecamatan</th>
                                <th>Desa</th>
                                <th>Total SLS Diterima oleh Koseka</th>
                                <th>Total SLS Dikirim oleh Koseka</th>
                                <th>Total SLS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receivingData as $data)
                            <tr>
                                <td>{{$data['subdistrict']}}</td>
                                <td>{{$data['village']}}</td>
                                <td>{{$data['receiving_total']}}</td>
                                <td></td>
                                <td>{{$data['total']}}</td>
                            </tr>
                            @endforeach
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

@endsection