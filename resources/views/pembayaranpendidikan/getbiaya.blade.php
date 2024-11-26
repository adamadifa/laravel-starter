@php
    $total_biaya = 0;
    $total_potongan = 0;
    $total_biaya_bersih = 0;
    $total_mutasi = 0;
    $total_bayar = 0;
    $total_sisa_tagihan = 0;
    $tahun_ajaran = '';
@endphp
@foreach ($biaya as $key => $b)
    @php
        $jumlah_biaya = $b->jumlah - $b->jumlah_potongan;
        $total_biaya += $b->jumlah;
        $total_potongan += $b->jumlah_potongan;
        $total_biaya_bersih += $jumlah_biaya;
        $sisa_tagihan = $jumlah_biaya - $b->jumlah_mutasi;
        $total_sisa_tagihan += $sisa_tagihan;
        $total_mutasi += $b->jumlah_mutasi;
    @endphp
    @if ($tahun_ajaran != $b->tahun_ajaran)
        @php
            $tahun_ajaran = $b->tahun_ajaran;
        @endphp
        <tr class="table-dark">
            <td colspan="8">TAHUN AJARAN {{ $b->tahun_ajaran }}</td>
        </tr>
    @endif
    <tr>
        <td>{{ $b->kode_biaya }}</td>
        <td>{{ $b->jenis_biaya }}</td>
        <td class="text-end">{{ formatAngka($b->jumlah) }}</td>
        @if (empty($b->jumlah_potongan))
            <td>
                <a href="#" class="inputpotongan" kode_jenis_biaya="{{ Crypt::encrypt($b->kode_jenis_biaya) }}"
                    no_pendaftaran="{{ Crypt::encrypt($pendaftaran->no_pendaftaran) }}" jenis_biaya="{{ $b->jenis_biaya }}"
                    kode_biaya="{{ Crypt::encrypt($b->kode_biaya) }}">
                    <span class="badge bg-danger">Input Potongan</span>
                </a>
            </td>
        @else
            <td class="text-end ">
                <a href="#" class="inputpotongan text-danger" kode_jenis_biaya="{{ Crypt::encrypt($b->kode_jenis_biaya) }}"
                    no_pendaftaran="{{ Crypt::encrypt($pendaftaran->no_pendaftaran) }}" jenis_biaya="{{ $b->jenis_biaya }}"
                    kode_biaya="{{ Crypt::encrypt($b->kode_biaya) }}">
                    {{ formatAngka($b->jumlah_potongan) }}
                </a>
            </td>
        @endif
        <td class="text-end">{{ formatAngka($jumlah_biaya) }}</td>
        @if (empty($b->jumlah_mutasi))
            <td>
                <a href="#" class="inputmutasi" kode_jenis_biaya="{{ Crypt::encrypt($b->kode_jenis_biaya) }}"
                    no_pendaftaran="{{ Crypt::encrypt($pendaftaran->no_pendaftaran) }}" jenis_biaya="{{ $b->jenis_biaya }}"
                    kode_biaya="{{ Crypt::encrypt($b->kode_biaya) }}">
                    <span class="badge bg-info">Input Mutasi</span>
                </a>
            </td>
        @else
            <td class="text-end">
                <a href="#" class="inputmutasi text-info" kode_jenis_biaya="{{ Crypt::encrypt($b->kode_jenis_biaya) }}"
                    no_pendaftaran="{{ Crypt::encrypt($pendaftaran->no_pendaftaran) }}" jenis_biaya="{{ $b->jenis_biaya }}"
                    kode_biaya="{{ Crypt::encrypt($b->kode_biaya) }}">
                    {{ formatAngka($b->jumlah_mutasi) }}
                </a>
            </td>
        @endif
        <td></td>
        <td class="text-end">
            {{ formatAngka($sisa_tagihan) }}
        </td>
    </tr>
@endforeach
<tr class="table-dark">
    <td colspan="2">TOTAL</td>
    <td class="text-end">{{ formatAngka($total_biaya) }}</td>
    <td class="text-end">{{ formatAngka($total_potongan) }}</td>
    <td class="text-end">{{ formatAngka($total_biaya_bersih) }}</td>
    <td class="text-end">{{ formatAngka($total_mutasi) }}</td>
    <td></td>
    <td class="text-end">{{ formatAngka($total_sisa_tagihan) }}</td>
</tr>
