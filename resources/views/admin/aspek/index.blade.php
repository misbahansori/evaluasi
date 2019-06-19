@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Master Data Aspek Penilaian</h4>
                    <a href="{{ route('aspek.create') }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-pencil"></i> Tambah Aspek Penilaian
                    </a>
                </div>

                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach ($listBagian as $bagian)
                                <a class="nav-item nav-link{{ $bagian->id == $listBagian->first()->id ? ' active' : '' }}" id="nav-{{ $bagian->id }}-tab" data-toggle="tab" href="#nav-{{ $bagian->id }}" role="tab" aria-controls="nav-{{ $bagian->id }}" aria-selected="true">{{ $bagian->nama }}</a>
                            @endforeach
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        @foreach ($listBagian as $bagian)
                            <div class="tab-pane fade{{ $bagian->id == $listBagian->first()->id ? ' show active' : '' }}" id="nav-{{ $bagian->id }}" role="tabpanel" aria-labelledby="nav-{{ $bagian->id }}">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach ($bagian->aspek->groupBy('kategori')->sortKeys() as $grouped)
                                            <tr>
                                                <th colspan="9"> {{ $grouped->first()->kategori }}</th>
                                            </tr>
                                            @foreach ($grouped as $aspek)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $aspek->nama }}</td>
                                                    <td style="width: 175px"> 
                                                        <div class="button-group">
                                                            <form action="{{ route('aspek.destroy', $aspek->id) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                    
                                                                <a href="{{ route('aspek.edit', $aspek->id) }}" class="btn btn-info btn-sm">
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
                                        @endforeach
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
