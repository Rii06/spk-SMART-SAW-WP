@extends('layout.layout')

@section('content')
    <div class="card-group">
        <div class="card-body"></div>
        <div class="card m-5 w-25" id="createForm" style="display: none">
            <div class="card-body" style="align-content: center">
                <h4 class="card-title">Kriteria Baru</h4>
                <form class="forms-sample">
                    <div class="form-group row">
                        <label for="exampleInputNamaKriteria" class="col-sm-4 col-form-label">Nama Kriteria</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="exampleInputNamaKriteria"
                                placeholder="Nama Kriteria" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputJenis" class="col-sm-4 col-form-label">Jenis</label>
                        <div class="col-sm-8">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis" value="benefit" checked>
                                    Benefit
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jenis" value="cost"> Cost
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputBobot" class="col-sm-4 col-form-label">Bobot</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="exampleInputBobot" placeholder="Bobot" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="button" class="btn btn-dark" id="cancelButton">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body"></div>
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
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Tidak ada isi pada tabel -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script>
        const createNewButton = document.getElementById('createNewButton');
        const createForm = document.getElementById('createForm');
        const cancelButton = document.getElementById('cancelButton');

        createNewButton.addEventListener('click', function() {
            createForm.style.display = 'block';
        });

        cancelButton.addEventListener('click', function() {
            createForm.style.display = 'none';
        });
    </script>
@endsection
