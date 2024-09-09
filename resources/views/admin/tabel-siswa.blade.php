@extends('layout')

@section('konten')
<div class="container">
    <h1>Tabel data Mahasiswa</h1>
    <table class="table">
        <thead class="table-secondary">
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswas as $siswa)
            <tr>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->NIM }}</td>
                <td>{{ $siswa->prodi->nama_prodi }}</td>
                <td>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#editModal"
                        data-id="{{ $siswa->id }}"
                        data-nama="{{ $siswa->nama }}"
                        data-nim="{{ $siswa->NIM }}"
                        data-no_hp="{{ $siswa->no_hp }}"
                        data-prodi_id="{{ $siswa->prodi_id }}"
                        data-semester_berjalan="{{ $siswa->semester_berjalan }}"
                        data-angkatan="{{ $siswa->angkatan }}"
                        @foreach(range(1, 8) as $semester)
                        data-nilai_s{{ $semester }}="{{ $siswa->{"nilai_s{$semester}"} ?? '' }}"
                        data-sks_s{{ $semester }}="{{ $siswa->{"sks_s{$semester}"} ?? '' }}"
                        @endforeach>Perbarui</button>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('admin.edit-siswa')

<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);

        // Set the values from data attributes
        modal.find('.modal-body #siswa_id').val(button.data('id'));
        modal.find('.modal-body #nama').val(button.data('nama'));
        modal.find('.modal-body #NIM').val(button.data('nim'));
        modal.find('.modal-body #no_hp').val(button.data('no_hp'));
        modal.find('.modal-body #prodi_id').val(button.data('prodi_id'));
        modal.find('.modal-body #semester_berjalan').val(button.data('semester_berjalan'));
        modal.find('.modal-body #angkatan').val(button.data('angkatan'));

        // Additionally bind nilai and sks for all semesters
        @foreach(range(1, 8) as $semester)
        modal.find('.modal-body #nilai_s{{ $semester }}').val(button.data('nilai_s{{ $semester }}'));
        modal.find('.modal-body #sks_s{{ $semester }}').val(button.data('sks_s{{ $semester }}'));
        @endforeach

        modal.find('form').attr('action', '{{ url("admin/siswa/update") }}/' + button.data('id'));
    });
</script>


@endsection