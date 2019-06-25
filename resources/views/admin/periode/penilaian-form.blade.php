<form action="{{ route('nilai.update', $periode->id) }}" method="POST">
    @csrf
    @method('put')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle">No</th>
                <th rowspan="2" style="vertical-align: middle">Aspek Penilaian</th>
                <th colspan="5" style="text-align: center">Nilai</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periode->nilai->groupBy('kategori')->sortKeys() as $grouped)
                <tr>
                    <th colspan="9"> {{ $grouped->first()->kategori }}</th>
                </tr>
                @foreach ($grouped as $nilai)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $nilai->aspek }}</td>
                        @for ($i = 1; $i < 6; $i++)
                            <td style="width: 50px;">
                                <div class="custom-control custom-radio">
                                <input type="radio" 
                                    class="custom-control-input" 
                                    name="{{ $nilai->id }}" id="{{ $nilai->id }}{{ $i }}" 
                                    value="{{ $i }}" 
                                    {{ $nilai->nilai == $i ? 'checked=checked' : '' }} 
                                    {{ $periode->tidakBisaDiedit() ? 'disabled=disabled' : '' }}
                                >
                                <label for="{{ $nilai->id }}{{ $i }}" class="custom-control-label"></label>
                                </div>
                            </td>
                        @endfor
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td colspan="2">Total Nilai</td>
                <td colspan="6">{{ $periode->totalNilai() }}</td>
            </tr>
            <tr>
                <td colspan="2">Rata-rata Nilai</td>
                <td colspan="6">{{ $periode->rataNilai() }}</td>
            </tr>
            <tr>
                <td colspan="2">Element Penilaian</td>
                <td colspan="6">{{ $periode->nilai->count() }}</td>
            </tr>
        </tbody>
    </table>
    <div class="button-group">
        <button type="submit" class="btn btn-success btn-block btn-lg">
            <i class="ti-save"></i> Simpan
        </button>
    </div>
</form>