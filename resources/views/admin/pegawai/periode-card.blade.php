<div class="col-md-4">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between">
            <h4>Penilaian</h5>
            @can('tambah periode')
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    <i class="ti ti-pencil"></i> Tambah Penilaian
                </button>
            @endcan
        </div>
        <div class="card-body">
            <table class="table">
                @forelse ($pegawai->periode as $periode)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $periode->bulan->nama }} {{ $periode->tahun }}</td>
                        <td>
                            <form action="{{ route('periode.destroy', [$pegawai->id, $periode->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <a href="{{ route('periode.show', [$pegawai->id, $periode->id]) }}" class="btn btn-success btn-sm">
                                    <i class="ti-view-list-alt"></i> Detail
                                </a>
                                @can('hapus periode')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus')">
                                        <i class="ti-trash"></i> Hapus
                                    </button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center"><i>Belum ada data</i></td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>