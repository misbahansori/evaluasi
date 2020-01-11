<!-- Modal Tambah Penilaian -->
<div class="modal fade" id="catatanModal" tabindex="-1" role="dialog" aria-labelledby="catatanModalLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <form action="{{ route('catatan.store', $periode->id) }}" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="catatanModalLabel">Tambahkan Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="tipe">Jenis Catatan</label>
                    <select name="tipe" id="tipe" class="form-control{{ $errors->has('tipe') ? ' is-invalid' : '' }}">
                        <option>Catatan</option>
                        <option>Hal yang perlu di tingkatkan</option>
                        <option>Hal yang perlu di dipertahankan</option>
                    </select>
                    @if ($errors->has('tipe'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tipe') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="isi">Isi Catatan</label>
                    <textarea name="isi" id="isi" cols="30" rows="10" class="form-control{{ $errors->has('isi') ? ' is-invalid' : '' }}">{{ old('isi') }}</textarea>
                    @if ($errors->has('isi'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('isi') }}</strong>
                        </span>
                    @endif
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

@push('js')
    @if(Session::has('errors'))
        <script>
            $(document).ready(function(){
                $('#catatanModal').modal({show: true});
            });
        </script>
    @endif
@endpush