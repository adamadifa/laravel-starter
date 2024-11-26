@foreach ($dokumen as $d)
    <tr>
        <td>{{ $d->jenis_dokumen }}</td>
        <td>
            @if (!empty($d->nama_file))
                @if (Storage::disk('public')->exists('/pendaftaran/persyaratan/' . $d->nama_file))
                    @php
                        $url = url('/storage/pendaftaran/persyaratan/' . $d->nama_file);
                    @endphp
                    <a href="{{ $url }}" target="_blank">
                        <i class="ti ti-paperclip me-1"></i> Lihat Dokumen
                    </a>
                @else
                    <i class="ti ti-error-404 text-danger"></i>
                @endif
            @else
                <i class="ti ti-x text-danger"></i>
            @endif
        </td>
        <td>
            <a href="#" class="deletedokumen" no_pendaftaran="{{ $d->no_pendaftaran }}" kode_dokumen="{{ $d->kode_dokumen }}">
                <i class="ti ti-trash text-danger"></i>
            </a>
        </td>
    </tr>
@endforeach
