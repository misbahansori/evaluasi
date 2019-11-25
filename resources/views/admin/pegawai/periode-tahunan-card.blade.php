<div class="card">
    <div class="card-header bg-white d-flex justify-content-between">
        <h4>Penilaian Tahunan</h5>
        @can('tambah periode')
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#periodeTahunanModal">
                <i class="ti ti-pencil"></i> Tambah
            </button>
        @endcan
    </div>
    <div class="card-body">
        <table class="table">
            @forelse ($pegawai->periodeTahunan as $periode)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $periode->bulan->nama }} {{ $periode->tahun }}</td>
                    <td class="d-flex">
                        <a href="{{ route('periode.show', [$pegawai->id, $periode->id]) }}" class="mr-1 btn btn-success btn-sm">
                            <i class="ti-view-list-alt"></i> Detail
                        </a>
                        @can('cetak periode')
                            <form action="{{ route('report', 'hasil-evaluasi') }}" method="POST" target="__blank" class="d-inline-block">
                                @csrf
                                <input type="hidden" name="periode_id" value="{{ $periode->id }}">
                                <button class="mr-1 btn btn-info btn-sm d-inline-block" type="submit">
                                    <i class="ti-printer"></i> Cetak
                                </button>
                            </form>
                        @endcan
                        @can('hapus periode')
                            <form action="{{ route('periode.destroy', [$pegawai->id, $periode->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="mr-1 btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus')">
                                    <i class="ti-trash"></i> Hapus
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><i>Belum ada data penilaian tahunan.</i></td>
                </tr>
            @endforelse
        </table>
    </div>
</div>
