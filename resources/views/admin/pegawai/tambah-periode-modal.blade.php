<!-- Modal Tambah Penilaian -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <form action="{{ route('periode.store', $pegawai->id) }}" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-group row">
                    <label for="bulan" class="col-sm-4 col-form-label text-md-right">Bulan</label>
                    <div class="col-md-6">
                        <select name="bulan" id="bulan" class="form-control{{ $errors->has('bulan') ? ' is-invalid' : '' }}">
                            @foreach ($listBulan as $bulan)
                                <option {{ old('bulan', date('m')) == $bulan->id ? 'selected' : '' }} value="{{ $bulan->id }}">{{ $bulan->nama }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('bulan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bulan') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-4 col-form-label text-md-right">Tahun</label>
                    <div class="col-md-6">
                        <select name="tahun" id="tahun" class="form-control{{ $errors->has('tahun') ? ' is-invalid' : '' }}">
                            @for ($i = $tahunIni - 2; $i < $tahunIni + 5; $i++)
                                <option {{ old('tahun', $tahunIni) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @if ($errors->has('tahun'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tahun') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>