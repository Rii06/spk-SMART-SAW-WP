@extends('layout.layout')
@section('content')
    <div class="modal fade" id="inputDataModal" tabindex="-1" aria-labelledby="inputDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputDataModalLabel">Input Data Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('data.store') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputNamaData">Nama Data</label>
                            <input type="text" class="form-control" id="inputNamaData" name="nama_data"
                                placeholder="Nama Data" required>
                        </div>
                        @foreach ($kriteria as $kriteriaItem)
                            <div class="form-group">
                                <label for="inputNilai{{ $kriteriaItem->id }}">{{ $kriteriaItem->nama_kriteria }}</label>
                                <input type="number" class="form-control" id="inputNilai{{ $kriteriaItem->id }}"
                                    name="nilai[{{ $kriteriaItem->id }}]" required>
                                <input type="hidden" name="kriteria_id[]" value="{{ $kriteriaItem->id }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Basic Table</h4>
            <button type="button" class="btn btn-info btn-fw" id="createNewButton">Create New</button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Data</th>
                            @foreach ($kriteria as $kriteriaItem)
                                <th>{{ $kriteriaItem->nama_kriteria }}</th>
                            @endforeach
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->nama_data }}</td>
                                @foreach ($kriteria as $kriteriaItem)
                                    <td>
                                        @php
                                            $isi = $isiData
                                                ->where('id_data', $d->id)
                                                ->where('id_kriteria', $kriteriaItem->id)
                                                ->where('id_app', session('appId'))
                                                ->first();
                                        @endphp
                                        {{ $isi ? $isi->nilai : '-' }}
                                    </td>
                                @endforeach
                                <td>
                                    <form action="{{ route('data.destroy', $d->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const createNewButton = document.getElementById('createNewButton');
        const inputDataModal = document.getElementById('inputDataModal');

        createNewButton.addEventListener('click', function() {
            $(inputDataModal).modal('show');
        });
    </script>
@endsection
