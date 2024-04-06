@extends('layouts.main')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Inventory Sertifikat</h3>
        </div>

        <div class="card-body">
            <div class="btn-group mb-3 justify-content-between">
                <a href="#" class="btn btn-danger d-flex align-items-center">
                    Export Data Inventory Sertifikat
                </a>

                <button type="button" class="btn btn-success ms-2 d-flex align-items-center tombol-tambah">
                    Tambah Data Inventory Sertifikat
                </button>
            </div>
            <br>
            <br>
            <table id="InventorySertifikat" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Sertifikat</th>
                        <th>Jenis Sertifikat</th>
                        <th>Nama Pemilik</th>
                        <th>Status Sertifikat</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah & Edit/Update -->
<div class="modal fade" id="ModalInventorySertifikat" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Data Inventory Sertifikat</h5>
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
                    <label for="no_sertifikat">Nomor Sertifikat</label>
                    <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat" required>
                </div>

                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik</label>
                    <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required>
                </div>

                <div class="form-group">
                    <label for="jenis_sertifikat">Jenis Sertifikat</label>
                    <input type="text" class="form-control" id="jenis_sertifikat" name="jenis_sertifikat" autocomplete="name"
                        required>
                </div>

                <div class="form-group">
                    <label for="status_sertifikat">Status Sertifikat</label>
                    <input type="text" class="form-control" id="status_sertifikat" name="status_sertifikat" required>
                </div>

                <div class="form-group">
                    <label for="foto_sertifikat">Upload Foto Setifikat</label>
                    <input type="file" class="form-control" id="foto_sertifikat" name="foto_sertifikat" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="bukti_pengiriman">Upload Bukti Pengiriman</label>
                    <input type="file" class="form-control" id="bukti_pengiriman" name="bukti_pengiriman" accept="image/*"
                        required>
                </div>

                <div class="form-group">
                    <label for="bukti_pengambilan">Upload Bukti Pengambilan</label>
                    <input type="file" class="form-control" id="bukti_pengambilan" name="bukti_pengambilan"
                        accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="email" required>
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
                <h5 class="modal-title" id="DetailLabel">Data Inventory Sertifikat</h5>
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
                    <label for="no_sertifikat">Nomor Sertifikat : </label>
                    <span class="detail-value" id="no_sertifikat_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik : </label>
                    <span class="detail-value" id="nama_pemilik_detail"></span>
                </div>

                <div class="form-group">
                    <label for="status_sertifikat">Status Sertifikat : </label>
                    <span class="detail-value" id="status_sertifikat_detail"></span>
                </div>

                <div class="form-group">
                    <label for="jenis_sertifikat">Jenis Sertifikat : </label>
                    <span class="detail-value" id="jenis_sertifikat_detail"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email : </label>
                    <span class="detail-value" id="email_detail"></span>
                </div>


                <div class="form-group">
                    <label for="foto_sertifikat">Foto Sertifikat : </label>
                    <br>
                    <img class="detail-value" id="foto_sertifikat_detail" src="{{ asset('') }}" alt="Foto"
                        style="max-width: 300px;">
                </div>

                <div class="form-group">
                    <label for="bukti_pengambilan">Bukti Pengambilan : </label>
                    <br>
                    <img class="detail-value" id="bukti_pengambilan_detail" src="{{ asset('') }}"
                        alt="Foto" style="max-width: 300px;">
                </div>

                <div class="form-group">
                    <label for="bukti_pengiriman">Bukti Pengiriman : </label>
                    <br>
                    <img class="detail-value" id="bukti_pengiriman_detail" src="{{ asset('') }}"
                        alt="Foto" style="max-width: 300px;">
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
    $(document).ready(function () {
        // Skrip JavaScript Anda di sini
        $(function () {
            $('#InventorySertifikat').DataTable({
                "ajax": "{{ url('InventorySertifikatAjax') }}",
                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'no_sertifikat',
                        name: 'no_sertifikat'
                    },
                    {
                        data: 'jenis_sertifikat',
                        name: 'jenis_sertifikat'
                    },
                    {
                        data: 'nama_pemilik',
                        name: 'nama_pemilik'
                    },
                    {
                        data: 'status_sertifikat',
                        name: 'status_sertifikat'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
                url: 'InventorySertifikatAjax/' + id,
                type: 'GET',
                success: function (response) {
                    var result = response.result;
                    $('.detail-value#nama_pemilik_detail').text(result.nama_pemilik);
                    $('.detail-value#no_sertifikat_detail').text(result.no_sertifikat);
                    $('.detail-value#jenis_sertifikat_detail').text(result.jenis_sertifikat);
                    $('.detail-value#status_sertifikat_detail').text(result.status_sertifikat);
                    $('.detail-value#email_detail').text(result.email);

                    if (result.foto_sertifikat && result.foto_sertifikat !== null) {
                        // Pastikan ada foto sebelum mencoba menetapkan src
                        $('.detail-value#foto_sertifikat_detail').attr('src',
                            '{{ asset("storage/img/") }}/' +
                            result.foto_sertifikat);
                    } else {
                        // Misalnya, jika tidak ada foto, tampilkan placeholder atau pesan alternatif
                        // $('.detail-value#foto_detail').attr('src', '{{ asset("placeholder.jpg") }}');
                        // Atau sembunyikan elemen gambar sepenuhnya
                        $('.detail-value#foto_sertifikat_detail').hide();
                    }

                    if (result.bukti_pengambilan && result.bukti_pengambilan !== null) {
                        // Pastikan ada foto sebelum mencoba menetapkan src
                        $('.detail-value#bukti_pengambilan_detail').attr('src',
                            '{{ asset("storage/img/") }}/' +
                            result.bukti_pengambilan);
                    } else {
                        // Misalnya, jika tidak ada foto, tampilkan placeholder atau pesan alternatif
                        // $('.detail-value#foto_detail').attr('src', '{{ asset("placeholder.jpg") }}');
                        // Atau sembunyikan elemen gambar sepenuhnya
                        $('.detail-value#bukti_pengambilan_detail').hide();
                    }

                    if (result.bukti_pengiriman && result.bukti_pengiriman !== null) {
                        // Pastikan ada foto sebelum mencoba menetapkan src
                        $('.detail-value#bukti_pengiriman_detail').attr('src',
                            '{{ asset("storage/img/") }}/' +
                            result.bukti_pengiriman);
                    } else {
                        // Misalnya, jika tidak ada foto, tampilkan placeholder atau pesan alternatif
                        // $('.detail-value#foto_detail').attr('src', '{{ asset("placeholder.jpg") }}');
                        // Atau sembunyikan elemen gambar sepenuhnya
                        $('.detail-value#bukti_pengiriman_detail').hide();
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
            $('#ModalInventorySertifikat').modal('show');
            $('.tombol-simpan').on('click', function () {
                simpan();
            });
        });

        /* Proses Edit */
        $('body').on('click', '.tombol-edit', function (e) {
            var id = $(this).data('id');
            $.ajax({
                url: 'InventorySertifikatAjax/' + id + '/edit',
                type: 'GET',
                success: function (response) {
                    $('#ModalInventorySertifikat').modal('show');
                    $('#nama_pemilik').val(response.result.nama_pemilik);
                    $('#status_sertifikat').val(response.result.status_sertifikat);
                    $('#no_sertifikat').val(response.result.no_sertifikat);
                    $('#jenis_sertifikat').val(response.result.jenis_sertifikat);
                    $('#email').val(response.result.email);
                    $('#foto_sertifikat').val('');
                    $('#bukti_pengiriman').val('');
                    $('#bukti_pengambilan').val('');
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
                    url: 'InventorySertifikatAjax/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        console.log(response);
                        $('#InventorySertifikat').DataTable().ajax.reload();
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
            var email = $('#email').val();
            if (!email) {
                alert('Email harus diisi');
                return false;
            }

            // Contoh validasi lainnya...

            return true; // Kembalikan true jika semua validasi berhasil
        }

        /* Fungsi Simpan & Update */
        function simpan(id = '') {
            // Mendapatkan data dari elemen HTML
            var data = new FormData();
            data.append('nama_pemilik', $('#nama_pemilik').val());
            data.append('status_sertifikat', $('#status_sertifikat').val());
            data.append('no_sertifikat', $('#no_sertifikat').val());
            data.append('jenis_sertifikat', $('#jenis_sertifikat').val());
            data.append('email', $('#email').val());

            var foto_sertifikatInput = $('#foto_sertifikat')[0];
            if (foto_sertifikatInput && foto_sertifikatInput.files.length > 0) {
                data.append('foto_sertifikat', foto_sertifikatInput.files[0]);
            }

            var bukti_pengirimanInput = $('#bukti_pengiriman')[0];

            if (bukti_pengirimanInput && bukti_pengirimanInput.files.length > 0) {
                data.append('bukti_pengiriman', bukti_pengirimanInput.files[0]);
            }

            var bukti_pengambilanInput = $('#bukti_pengambilan')[0];

            if (bukti_pengambilanInput && bukti_pengambilanInput.files.length > 0) {
                data.append('bukti_pengambilan', bukti_pengambilanInput.files[0]);
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
                url: id === '' ? 'InventorySertifikatAjax' : 'InventorySertifikatAjax/' + id,
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
                    $('#InventorySertifikat').DataTable().ajax.reload();
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



        $('#ModalInventorySertifikat').on('hidden.bs.modal', function () {
            var inputFotoSertifikat = $('#foto_sertifikat');
            inputFotoSertifikat.replaceWith(inputFotoSertifikat.val('').clone(true));
            $('#nama_pemilik').val('');
            $('#status_sertifikat').val('');
            $('#no_sertifikat').val('');
            $('#jenis_sertifikat').val('');
            $('#email').val('');
            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');
            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });
    });
    // Skrip JavaScript
    // ...

</script>
@endsection
