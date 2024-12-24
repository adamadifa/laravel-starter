@extends('layouts.app')
@section('titlepage', 'Realisasi Kegiatan')
@section('content')
    <div class="row">
        <div class="col">
            <form action="#">
                <x-input-with-icon label="Tanggal" name="tanggal" value="{{ date('Y-m-d') }}" datepicker="flatpickr-date" icon="ti ti-calendar" />
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col" id="getrealisasikegiatan"></div>
    </div>
    <div class="floating-button">
        <a href="{{ route('realisasikegiatan.create') }}" class="btn btn-primary btn-circle btn-lg">
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
            function getAktifitas() {
                // alert('test');
                let tanggal = $('#tanggal').val();
                $("#getrealisasikegiatan").html(`<div class="sk-wave sk-primary" style="margin:auto">
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                <div class="sk-wave-rect"></div>
                </div>`);
                $.ajax({
                    method: "POST",
                    url: "{{ route('realisasikegiatan.getrealisasikegiatan') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggal: tanggal
                    },
                    cache: false,
                    success: function(data) {
                        $('#getrealisasikegiatan').html(data);
                    }
                })
            }

            getAktifitas();
            $('#tanggal').change(function() {
                // alert('test');
                getAktifitas();
            });

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
