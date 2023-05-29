@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <strong>Sistem Layanan Pemerintahan</strong>
                        <div class="col-md-12">
                            <hr class="border border-dark border-2 opacity-100">
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-3 shadow m-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/icon/icons8-mail-100.png')}}" alt="E-Surat">
                                    </div>
                                    <div class="bg-light p-3 m-2 text-center">E-Surat</div>
                                </div>
                                <div class="col-md-3 shadow m-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/icon/icons8-money-transfer-100.png')}}" alt="E-Dokumen Anggaran">
                                    </div>
                                    <div class="bg-light p-3 m-2 text-center">E-Dokumen Anggaran</div>
                                </div>
                                <div class="col-md-3 shadow m-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/icon/icons8-goal-100.png')}}" alt="E-Surat">
                                    </div>
                                    <div class="bg-light p-3 m-2 text-center">E-Kinerja</div>
                                </div>
                                <div class="col-md-3 shadow m-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/icon/icons8-repository-100.png')}}" alt="PPID">
                                    </div>
                                    <div class="bg-light p-3 m-2 text-center">PPID</div>
                                </div>
                                <div class="col-md-3 shadow m-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/icon/icons8-fingerprint-100.png')}}" alt="E-Presensi">
                                    </div>
                                    <div class="bg-light p-3 m-2 text-center">E-Presensi</div>
                                </div>
                                <div class="col-md-3 shadow m-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/icon/icons8-positive-dynamic-100.png')}}" alt="Open Data">
                                    </div>
                                    <div class="bg-light p-3 m-2 text-center">Open Data</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <strong>Pengumuman</strong>
                        <div class="col-md-12">
                            <hr class="border border-dark border-2 opacity-100">
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <div class="row bg-light p-3 w-75 overflow-hidden">
                                        <div class="col-md-2 bg-primary"><img src="{{ asset('assets/img/icon/icons8-megaphone-100.png')}}" width="50" height="50" alt="Pengumuman" class="float-start mx-auto d-block"></div>
                                        <div class="col-md-10">
                                            <div>
                                                <strong>E-Kinerja sedang maintenance sementara sampai batas waktu tertentu</strong><br>
                                            </div>
                                            <small>Admin, 11:30 27 Juni 2023</small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

</div>

@endsection