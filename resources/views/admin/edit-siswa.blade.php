<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="siswa_id" name="siswa_id">

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required pattern="[A-Za-z ]+" title="Hanya huruf yang diizinkan">
                    </div>

                    <div class="form-group">
                        <label for="NIM">NIM</label>
                        <input type="text" class="form-control" id="NIM" name="NIM" required pattern="\d{14}" title="Harus 14 digit angka">
                    </div>

                    <div class="form-group">
                        <label for="prodi_id">Prodi</label>
                        <select class="form-control" id="prodi_id" name="prodi_id" required>
                            @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rows for Nilai and SKS -->
                    @foreach(range(1, 8) as $semester)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nilai_s{{ $semester }}">Nilai S{{ $semester }}</label>
                                <input type="number" class="form-control" id="nilai_s{{ $semester }}" name="nilai_s{{ $semester }}" min="0" max="4.00" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sks_s{{ $semester }}">SKS S{{ $semester }}</label>
                                <input type="number" class="form-control" id="sks_s{{ $semester }}" name="sks_s{{ $semester }}" min="1" max="24" step="1">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Perbarui</button>
                </div>
            </form>


        </div>
    </div>
</div>