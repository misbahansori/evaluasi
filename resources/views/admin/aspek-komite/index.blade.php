@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Master Data Aspek Komite</h4>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('aspek-komite.create') }}" class="btn btn-primary btn-sm ml-4">
                            <i class="ti ti-pencil"></i> Tambah Aspek Komite
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach ($listKomite as $komite)
                                <a class="nav-item nav-link{{ $komite->id == $listKomite->first()->id ? ' active' : '' }}" id="nav-{{ $komite->id }}-tab" data-toggle="tab" href="#nav-{{ $komite->id }}" role="tab" aria-controls="nav-{{ $komite->id }}" aria-selected="true">{{ $komite->nama }}</a>
                            @endforeach                           
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        @foreach ($listKomite as $komite)
                            <div class="tab-pane fade{{ $komite->id == $listKomite->first()->id ? ' show active' : '' }}" id="nav-{{ $komite->id }}" role="tabpanel" aria-labelledby="nav-{{ $komite->id }}">
                                <table class="table table-bordered">
                                    <tbody>
                                        @forelse ($komite->aspekKomite->groupBy('kategori')->sortKeys() as $grouped)
                                            <tr>
                                                <th colspan="9"> {{ $grouped->first()->kategori }}</th>
                                            </tr>
                                            @foreach ($grouped as $aspekKomite)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $aspekKomite->nama }}</td>
                                                    <td style="width: 175px"> 
                                                        <div class="button-group">
                                                            <form action="{{ route('aspek-komite.destroy', $aspekKomite) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                    
                                                                <a href="{{ route('aspek-komite.edit', $aspekKomite) }}" class="btn btn-info btn-sm">
                                                                    <i class="ti ti-pencil-alt"></i> Edit
                                                                </a>
                                                                
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus?');">
                                                                    <i class="ti ti-trash"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center font-italic">Tidak ada data. Silahkan tambah aspek komite</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
