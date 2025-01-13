@extends('layouts.app')
@section('titlepage', 'Program Kerja')
@section('content')
    <div class="row">
        <div class="col">
            <form action="{{ route('programkerja.index') }}" id="myForm">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <select name="kode_ta" id="kode_ta" class="form-select select2Kodeta">
                                <option value="">Tahun Ajaran</option>
                                @foreach ($tahunajaran as $d)
                                    <option value="{{ $d->kode_ta }}"
                                        {{ Request('kode_ta') == $d->kode_ta || $ta_aktif->kode_ta == $d->kode_ta ? 'selected' : '' }}>
                                        {{ $d->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <x-input-with-icon label="Cari" value="{{ Request('cari') }}" name="cari" icon="ti ti-search" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col" id="getprogramkerja"></div>
    </div>
    <div class="floating-button">
        <a href="{{ route('programkerja.create') }}" class="btn btn-primary btn-circle btn-lg">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <style>
        .floating-button {
            position: fixed;
            bottom: 90px;
            right: 20px;
            z-index: 1000;
        }

        .btn-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <x-modal-form id="modal" size="modal-lg" show="loadmodal" title="" />
@endsection
@push('myscript')
    <script>
        $(function() {

            function getProgramkerja() {
                // alert('test');
                let cari = $('#cari').val();
                let kode_ta = $('#kode_ta').val();
                $("#getprogramkerja").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
                $.ajax({
                    method: "POST",
                    url: "{{ route('programkerja.getprogramkerjalist') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_ta: kode_ta,
                        cari: cari
                    },
                    cache: false,
                    success: function(data) {
                        $('#getprogramkerja').html(data);
                    }
                })
            }

            $("#cari").on('input', function() {
                getProgramkerja();
            });
            getProgramkerja();

            $(document).on('click', '.btnShow', function(e) {
                e.preventDefault();
                const id = $(this).attr("id");
                $('#modal').modal("show");
                $(".modal-title").text("Detail Realisasi Kegiatan");
                $("#loadmodal").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
                $.ajax({
                    method: "GET",
                    url: "/realisasikegiatan/show/" + id,
                    cache: false,
                    success: function(data) {
                        $("#loadmodal").html(data);
                    }
                })
            });
        });
    </script>
@endpush
