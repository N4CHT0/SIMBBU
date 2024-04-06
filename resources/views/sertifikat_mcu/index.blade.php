@extends('layouts.main')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Sertifikat MCU</h3>
        </div>

        <div class="card-body">
            <div class="btn-group mb-3 justify-content-between">
                <a href="#" class="btn btn-danger d-flex align-items-center">
                    Export Data Sertifikat MCU
                </a>

                <button type="button" class="btn btn-success ms-2 d-flex align-items-center tombol-tambah">
                    Tambah Data Sertifikat MCU
                </button>
            </div>
            <br>
            <br>
            <table id="SertifikatMCU" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan Diatas Kapal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah & Edit/Update -->
<div class="modal fade" id="ModalSertifikatMCU" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Data Perpanjangan Sertifikat REOR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form tambah & edit -->
                <div class="alert alert-danger d-none"></div>
                <div class="alert alert-success d-none"></div>
                <!-- Sesuaikan dengan kolom-kolom yang ingin ditambahkan -->

                <div class="form-group">
                    <label for="jabatan_diatas_kapal">Jabatan Diatas Kapal</label>
                    <input type="text" class="form-control" id="jabatan_diatas_kapal" name="jabatan_diatas_kapal" required>
                </div>

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" autocomplete="name"
                        required>
                </div>

                <div class="form-group">
                    <label for="foto">Upload Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="foto_ktp">Upload Foto KTP </label>
                    <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="foto_bst">Upload Foto BST</label>
                    <input type="file" class="form-control" id="foto_bst" name="foto_bst" accept="image/*" required>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary tombol-simpan">Simpan</button>
                <button data-dismiss="modal" type="submit" class="btn btn-secondary">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tampil Data -->
<div class="modal fade" id="Detail" tabindex="-1" role="dialog" aria-labelledby="DetailLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DetailLabel">Data Sertifikat MCU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form detail -->
                <!-- Form -->
                <div class="alert alert-danger d-none"></div>
                <div class="alert alert-success d-none"></div>
                <!-- Sesuaikan dengan kolom-kolom yang ingin ditambahkan -->

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap : </label>
                    <span class="detail-value" id="nama_lengkap_detail"></span>
                </div>

                <div class="form-group">
                    <label for="jabatan_diatas_kapal">Jabatan Diatas Kapal : </label>
                    <span class="detail-value" id="jabatan_diatas_kapal_detail"></span>
                </div>

                <div class="form-group">
                    <label for="foto">Foto : </label>
                    <br>
                    <img class="detail-value" id="foto_detail" src="{{ asset('') }}" alt="Foto"
                        style="max-width: 300px;"> <!-- Hapus penggunaan result.foto -->
                </div>

                <div class="form-group">
                    <label for="foto_ktp">Foto KTP : </label>
                    <br>
                    <img class="detail-value" id="foto_ktp_detail" src="{{ asset('') }}" alt="Foto"
                        style="max-width: 300px;"> <!-- Hapus penggunaan result.foto -->
                </div>

                <div class="form-group">
                    <label for="foto_bst">Foto BST : </label>
                    <br>
                    <img class="detail-value" id="foto_bst_detail" src="{{ asset('') }}" alt="Foto"
                        style="max-width: 300px;"> <!-- Hapus penggunaan result.foto -->
                </div>
                <!-- ... -->
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="submit" class="btn btn-secondary">Batal</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    // Skrip JavaScript
    // ...
    $(function () {
        $('#SertifikatMCU').DataTable({
            "ajax": "{{ url('SertifikatMCUAjax') }}",
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'jabatan_diatas_kapal',
                    name: 'jabatan_diatas_kapal'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ],
            "processing": true,
            "serverSide": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });

    /* Global Setup */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    /* Proses Detail */
    $('body').on('click', '.tombol-detail', function (e) {
        var id = $(this).data('id');

        $.ajax({
            url: 'SertifikatMCUAjax/' + id,
            type: 'GET',
            success: function (response) {
                var result = response.result;
                $('.detail-value#nama_lengkap_detail').text(result.nama_lengkap);
                $('.detail-value#jabatan_diatas_kapal_detail').text(result.jabatan_diatas_kapal);

                if (result.foto && result.foto !== null) {
                    // Pastikan ada foto sebelum mencoba menetapkan src
                    $('.detail-value#foto_detail').attr('src',
                        '{{ asset("storage/img/") }}/' + result.foto);
                } else {
                    // Misalnya, jika tidak ada foto, tampilkan placeholder atau pesan alternatif
                    // $('.detail-value#foto_detail').attr('src', '{{ asset("placeholder.jpg") }}');
                    // Atau sembunyikan elemen gambar sepenuhnya
                    $('.detail-value#foto_detail').hide();
                }

                if (result.foto_ktp && result.foto_ktp !== null) {
                    // Pastikan ada foto sebelum mencoba menetapkan src
                    $('.detail-value#foto_ktp_detail').attr('src',
                        '{{ asset("storage/img/") }}/' + result.foto_ktp);
                } else {
                    // Misalnya, jika tidak ada foto, tampilkan placeholder atau pesan alternatif
                    // $('.detail-value#foto_detail').attr('src', '{{ asset("placeholder.jpg") }}');
                    // Atau sembunyikan elemen gambar sepenuhnya
                    $('.detail-value#foto_ktp_detail').hide();
                }

                if (result.foto_bst && result.foto_bst !== null) {
                    // Pastikan ada foto sebelum mencoba menetapkan src
                    $('.detail-value#foto_bst_detail').attr('src',
                        '{{ asset("storage/img/") }}/' + result.foto_bst);
                } else {
                    // Misalnya, jika tidak ada foto, tampilkan placeholder atau pesan alternatif
                    // $('.detail-value#foto_detail').attr('src', '{{ asset("placeholder.jpg") }}');
                    // Atau sembunyikan elemen gambar sepenuhnya
                    $('.detail-value#foto_bst_detail').hide();
                }

                console.log(result);
                $('#Detail').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    });

    /* Proses Tambah */
    $('body').on('click', '.tombol-tambah', function (e) {
        e.preventDefault();
        $('#ModalSertifikatMCU').modal('show');
        $('.tombol-simpan').on('click', function () {
            simpan();
        });
    });

    /* Proses Edit */
    $('body').on('click', '.tombol-edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: 'SertifikatMCUAjax/' + id + '/edit',
            type: 'GET',
            success: function (response) {
                $('#ModalSertifikatMCU').modal('show');
                $('#nama_lengkap').val(response.result.nama_lengkap);
                $('#jabatan_diatas_kapal').val(response.result.jabatan_diatas_kapal);
                $('#foto').val('');
                $('#foto_ktp').val('');
                $('#foto_bst').val('');
                console.log(response.result);
                $('.tombol-simpan').click(function () {
                    simpan(id);
                });
            }
        });
    });

    /* Proses Hapus */
    $('body').on('click', '.tombol-hapus', function (e) {
        if (confirm('Yakin Ingin Menghapus Data Ini?')) {
            var id = $(this).data('id');
            $.ajax({
                url: 'SertifikatMCUAjax/' + id,
                type: 'DELETE',
                success: function (response) {
                    console.log(response);
                    $('#SertifikatMCU').DataTable().ajax.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    function validateForm() {
        // Implementasikan logika validasi sesuai kebutuhan
        // Contoh sederhana, periksa apakah email telah diisi
        var nama = $('#nama_lengkap').val();
        if (!nama) {
            alert('Nama Lengkap harus diisi');
            return false;
        }

        // Contoh validasi lainnya...

        return true; // Kembalikan true jika semua validasi berhasil
    }

    /* Fungsi Simpan & Update */
    function simpan(id = '') {
        // Mendapatkan data dari elemen HTML
        var data = new FormData();
        data.append('nama_lengkap', $('#nama_lengkap').val());
        data.append('jabatan_diatas_kapal', $('#jabatan_diatas_kapal').val());

        var fotoInput = $('#foto')[0];
        if (fotoInput.files.length > 0) {
            data.append('foto', fotoInput.files[0]);
        }

        var ktpInput = $('#foto_ktp')[0];
        if (ktpInput.files.length > 0) {
            data.append('foto_ktp', ktpInput.files[0]);
        }

        var bstInput = $('#foto_bst')[0];
        if (bstInput.files.length > 0) {
            data.append('foto_bst', bstInput.files[0]);
        }

        // Tambahkan atribut _method untuk permintaan PUT (update)
        if (id !== '') {
            data.append('_method', 'PUT');
            // Ganti method menjadi PUT untuk permintaan update
            var methodType = 'POST';
        } else {
            // Ganti method menjadi POST untuk permintaan tambah data baru
            var methodType = 'POST';
        }

        // Lakukan validasi frontend
        var isValid = validateForm(); // Implementasikan fungsi ini untuk memeriksa validasi

        if (!isValid) {
            return; // Hentikan proses jika validasi gagal
        }

        // Kirim permintaan
        $.ajax({
            url: id === '' ? 'SertifikatMCUAjax' : 'SertifikatMCUAjax/' + id,
            type: methodType,
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.errors) {
                    console.log(response);
                    $('.alert-danger').removeClass('d-none');
                    $('.alert-danger').append('<ul>');
                    $.each(response.errors, function (key, value) {
                        $('.alert-danger').find('ul').append('<li>' + value + '</li>');
                    });
                    $('.alert-danger').append('</ul>');
                } else {
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').html(response.success);
                }
                $('#SertifikatMCU').DataTable().ajax.reload();
            },
            error: function (xhr, textStatus, errorThrown) {
                if (xhr.status === 422) {
                    // Tangani kesalahan validasi
                    var errors = xhr.responseJSON.errors;
                    // Tampilkan pesan kesalahan kepada pengguna
                    console.log(errors);
                } else {
                    // Tangani kesalahan lainnya
                    console.log('Terjadi kesalahan: ' + textStatus);
                }
            }
        });
    }



    $('#ModalSertifikatMCU').on('hidden.bs.modal', function () {
        var inputFoto = $('#foto');
        var InputBST = $('#foto_bst');
        var InputKTP = $('#foto_ktp');
        inputFoto.replaceWith(inputFoto.val('').clone(true));
        $('#nama_lengkap').val('');
        $('#jabatan_diatas_kapal').val('');
        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');
        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });

</script>
@endsection
