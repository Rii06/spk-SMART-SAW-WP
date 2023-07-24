@extends('layout.layout')

@section('content')
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" action="{{ route('kriteria.update', ':id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editNamaKriteria">Nama Kriteria</label>
                            <input type="text" class="form-control" id="editNamaKriteria" name="nama_kriteria" required>
                        </div>
                        <div class="form-group">
                            <label for="editJenis">Jenis</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis" id="editJenisBenefit"
                                        value="benefit" required>
                                    Benefit
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis" id="editJenisCost"
                                        value="cost" required>
                                    Cost
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editBobot">Bobot</label>
                            <input type="number" class="form-control" id="editBobot" name="bobot" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Kriteria Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kriteria.store') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputNamaKriteria">Nama Kriteria</label>
                            <input type="text" class="form-control" id="exampleInputNamaKriteria" name="nama_kriteria"
                                placeholder="Nama Kriteria" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputJenis">Jenis</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis"
                                        id="exampleInputJenisBenefit" value="benefit" required>
                                    Benefit
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis" id="exampleInputJenisCost"
                                        value="cost" required>
                                    Cost
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputBobot">Bobot</label>
                            <input type="number" class="form-control" id="exampleInputBobot" name="bobot"
                                placeholder="Bobot" required>
                        </div>
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
                            <th>Nama Kriteria</th>
                            <th>Jenis</th>
                            <th>Bobot</th>
                            <th>Bobot Relatif</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $kriteria)
                            <tr>
                                <td>{{ $kriteria->nama_kriteria }}</td>
                                <td>{{ $kriteria->jenis }}</td>
                                <td>{{ $kriteria->bobot }}</td>
                                @php
                                    $relatif = $kriteria->bobot / $sumbobot;
                                @endphp
                                <td>{{ $relatif }}</td>
                                <td>
                                    <button class="btn btn-success"
                                        onclick="openEditModal('{{ $kriteria->id }}', '{{ $kriteria->nama_kriteria }}', '{{ $kriteria->jenis }}', '{{ $kriteria->bobot }}')">Edit</button>
                                    <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data kriteria?')">Hapus</button>
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
        var editNamaKriteria = document.getElementById('editNamaKriteria');
        var editJenisBenefit = document.getElementById('editJenisBenefit');
        var editJenisCost = document.getElementById('editJenisCost');
        var editBobot = document.getElementById('editBobot');
        var editForm = document.getElementById('editForm');

        function openEditModal(id, namaKriteria, jenis, bobot) {
            editNamaKriteria.value = namaKriteria;
            if (jenis === 'benefit') {
                editJenisBenefit.checked = true;
            } else if (jenis === 'cost') {
                editJenisCost.checked = true;
            }
            editBobot.value = bobot;
            editForm.action = editForm.action.replace(':id', id);
            $('#editModal').modal('show');
        }

        const createNewButton = document.getElementById('createNewButton');
        const createModal = document.getElementById('createModal');

        createNewButton.addEventListener('click', function() {
            $(createModal).modal('show');
        });
    </script>
@endsection
