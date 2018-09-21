<div class="form-group">
    <label for="nik" class="col">NIK (Nomor Induk Kependudukan)</label>
    <div class="col-md-8">
        <input id="nik" type="text" class="form-control{{ $errors->has('nik') ? ' is-invalid' : '' }}" name="nik" value="{{ old('nik', @$pegawai->nik) }}">
        @if ($errors->has('nik'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nik') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="nbm" class="col">NBM (Nomor Baku Muhammadiyah)</label>
    <div class="col-md-5">
        <input id="nbm" type="text" class="form-control{{ $errors->has('nbm') ? ' is-invalid' : '' }}" name="nbm" value="{{ old('nbm', @$pegawai->nbm) }}">
        @if ($errors->has('nbm'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nbm') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="nama" class="col">Nama Lengkap</label>
    <div class="col">
        <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama', @$pegawai->nama) }}">
        @if ($errors->has('nama'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nama') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="jenis_kelamin" class="col">Jenis Kelamin</label>
    <div class="col-md-5">
        <div class="custom-control custom-radio custom-control-inline">
            <input class="custom-control-input" name="jenis_kelamin" type="radio" id="Laki-laki" value="L" {{ old('jenis_kelamin', @$pegawai->jenis_kelamin) == 'L' ? 'checked' : '' }}>
            <label class="custom-control-label" for="Laki-laki">Laki-laki</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input class="custom-control-input" name="jenis_kelamin" type="radio" id="Perempuan" value="P" {{ old('jenis_kelamin', @$pegawai->jenis_kelamin) == 'P' ? 'checked' : '' }}>
            <label class="custom-control-label" for="Perempuan">Perempuan</label>
        </div>
        @if ($errors->has('jenis_kelamin'))
            <span class="text-danger" role="alert">
                <small>
                    <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                </small>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="tempat_lahir" class="col">Tempat Lahir</label>
    <div class="col-md-8">
        <input id="tempat_lahir" type="text" class="form-control{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" name="tempat_lahir" value="{{ old('tempat_lahir', @$pegawai->tempat_lahir) }}">
        @if ($errors->has('tempat_lahir'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tempat_lahir') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="tanggal_lahir" class="col">Tanggal Lahir</label>
    <div class="col-md-6">
        <input id="tanggal_lahir" type="text" class="form-control{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" name="tanggal_lahir" value="{{ old('tanggal_lahir', @$pegawai->tanggal_lahir) }}">
        @if ($errors->has('tanggal_lahir'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tanggal_lahir') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="alamat" class="col">Alamat</label>
    <div class="col">
        <textarea id="alamat" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" rows="3">{{ old('alamat', @$pegawai->alamat) }}</textarea>
        @if ($errors->has('alamat'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('alamat') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="no_hp" class="col">No HP</label>
    <div class="col-md-8">
        <input id="no_hp" type="text" class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" name="no_hp" value="{{ old('no_hp', @$pegawai->no_hp) }}">
        @if ($errors->has('no_hp'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('no_hp') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="tanggal_masuk" class="col">Tanggal Masuk</label>
    <div class="col-md-6">
        <input id="tanggal_masuk" type="text" class="form-control{{ $errors->has('tanggal_masuk') ? ' is-invalid' : '' }}" name="tanggal_masuk" value="{{ old('tanggal_masuk', @$pegawai->tanggal_masuk) }}">
        @if ($errors->has('tanggal_masuk'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tanggal_masuk') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="unit" class="col">Unit</label>
    <div class="col-md-6">
        <select name="unit" id="unit" class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}">
            <option value="" selected disabled>--- Silahkan pilih unit ---</option>
            @foreach ($listUnit as $unit)
                <option value="{{ $unit->id }}" {{ old('unit', @$pegawai->unit->id) == $unit->id ? 'selected=selected' : '' }}>{{ $unit->nama }}</option>
            @endforeach
        </select>
        @if ($errors->has('unit'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('unit') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="formasi" class="col">Formasi</label>
    <div class="col-md-6">
        <select name="formasi" id="formasi" class="form-control{{ $errors->has('formasi') ? ' is-invalid' : '' }}">
            <option value="" selected disabled>--- Silahkan pilih formasi ---</option>
            @foreach ($listFormasi as $formasi)
                <option value="{{ $formasi->id }}" {{ old('formasi', @$pegawai->formasi->id) == $formasi->id ? 'selected=selected' : '' }}>{{ $formasi->nama }}</option>
            @endforeach
        </select>
        @if ($errors->has('formasi'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('formasi') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="bagian" class="col">Bagian</label>
    <div class="col-md-6">
        <select name="bagian" id="bagian" class="form-control{{ $errors->has('bagian') ? ' is-invalid' : '' }}">
            <option value="" selected disabled>--- Silahkan pilih bagian ---</option>
            @foreach ($listBagian as $bagian)
                <option value="{{ $bagian->id }}" {{ old('bagian', @$pegawai->bagian->id) == $bagian->id ? 'selected=selected' : '' }}>{{ $bagian->nama }}</option>
            @endforeach
        </select>
        @if ($errors->has('bagian'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('bagian') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group">
    <div class="col">
        <button type="submit" class="btn btn-primary">
            <i class="ti-save"></i> Simpan
        </button>
    </div>
</div>