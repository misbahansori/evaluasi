<div class="card-header bg-white d-flex justify-content-between">
    <h4>Penilaian Bulanan</h5>
    @can('tambah periode')
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#periodeModal">
            <i class="ti ti-pencil"></i> Tambah
        </button>
    @endcan
</div>
<div class="card-body">
    <table class="table">
        @forelse ($pegawai->periodeBulanan as $periode)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $periode->namaBulan }} {{ $periode->tahun }}</td>
                <td class="d-flex justify-content-end">
                    <a href="{{ route('periode.show', [$pegawai->id, $periode->id]) }}" class="mr-1 btn btn-success btn-sm" data-toggle="tooltip" title="Detail">
                        <i class="ti-view-list-alt"></i>
                    </a>
                    @can('cetak periode')
                        <form action="{{ route('report', 'hasil-evaluasi') }}" method="POST" target="__blank" class="d-inline-block">
                            @csrf
                            <input type="hidden" name="periode_id" value="{{ $periode->id }}">
                            <button class="mr-1 btn btn-info btn-sm d-inline-block" type="submit" data-toggle="tooltip" title="Cetak">
                                <i class="ti-printer"></i>
                            </button>
                        </form>
                    @endcan
                    @can('hapus periode')
                        <form action="{{ route('periode.destroy', [$pegawai->id, $periode->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="mr-1 btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus')" data-toggle="tooltip" title="Hapus">
                                <i class="ti-trash"></i>
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center"><i>Belum ada data</i></td>
            </tr>
        @endforelse
    </table>
</div>