@extends('layouts.main')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Diklat GMDSS</h3>
        </div>

        <div class="card-body">
            <div class="btn-group mb-3 justify-content-between">
                <a href="#" class="btn btn-danger d-flex align-items-center">
                    Export Data Diklat GMDSS
                </a>

                <button type="button" class="btn btn-success ms-2 d-flex align-items-center tombol-tambah">
                    Tambah Diklat GMDSS
                </button>
            </div>
            <br>
            <br>
            <table id="DiklatGMDSS" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Seafare Code</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Pekerjaan</th>
                        <th>Kewarganegaraan</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
                        <th>Kabupaten/Kota</th>
                        <th>Kecamatan</th>
                        <th>Kode Pos</th>
                        <th>Kelurahan/Desa</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Nama Ibu Kandung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah & Edit/Update -->
<div class="modal fade" id="ModalGMDSS" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Data Diklat GMDSS</h5>
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
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" required>
                </div>

                <div class="form-group">
                    <label for="seafare_code">Seafare Code</label>
                    <input type="text" class="form-control" id="seafare_code" name="seafare_code" required>
                </div>

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" autocomplete="name"
                        required>
                </div>

                <div class="form-group">
                    <label for="kewarganegaraan">Kewarganegaraan</label>
                    <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" required>
                </div>

                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>

                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input type="number" class="form-control" id="no_telp" name="no_telp" autocomplete="tel" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="street-address"
                        required>
                </div>

                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                </div>

                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                </div>

                <div class="form-group">
                    <label for="kabupaten_kota">Kabupaten/Kota</label>
                    <input type="text" class="form-control" id="kabupaten_kota" name="kabupaten_kota" required>
                </div>

                <div class="form-group">
                    <label for="kelurahan_desa">Kelurahan/Desa</label>
                    <input type="text" class="form-control" id="kelurahan_desa" name="kelurahan_desa" required>
                </div>

                <div class="form-group">
                    <label for="kode_pos">Kode Pos</label>
                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                </div>

                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                </div>

                <div class="form-group">
                    <label for="nama_ibu_kandung">Nama Ibu Kandung</label>
                    <input type="text" class="form-control" id="nama_ibu_kandung" name="nama_ibu_kandung" required>
                </div>

                <div class="form-group">
                    <label for="foto">Upload Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="email" required>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <!-- Pilihan role sesuai dengan kebutuhan -->
                        <option value="Laki - Laki">Laki - Laki</option>
                        <option value="Perempuan">Perempuan</option>
                        <!-- Tambahkan pilihan lain jika diperlukan -->
                    </select>
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
                <h5 class="modal-title" id="DetailLabel">Data GMDSS</h5>
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
                    <label for="nik">NIK : </label>
                    <span class="detail-value" id="nik_detail"></span>
                </div>

                <div class="form-group">
                    <label for="seafare_code">Seafare Code : </label>
                    <span class="detail-value" id="seafare_code_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap : </label>
                    <span class="detail-value" id="nama_lengkap_detail"></span>
                </div>

                <div class="form-group">
                    <label for="kewarganegaraan">Kewarganegaraan : </label>
                    <span class="detail-value" id="kewarganegaraan_detail"></span>
                </div>

                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan : </label>
                    <span class="detail-value" id="pekerjaan_detail"></span>
                </div>

                <div class="form-group">
                    <label for="provinsi">Provinsi : </label>
                    <span class="detail-value" id="provinsi_detail"></span>
                </div>

                <div class="form-group">
                    <label for="kabupaten_kota">Kabupaten/Kota : </label>
                    <span class="detail-value" id="kabupaten_kota_detail"></span>
                </div>

                <div class="form-group">
                    <label for="kecamatan">Kecamatan : </label>
                    <span class="detail-value" id="kecamatan_detail"></span>
                </div>

                <div class="form-group">
                    <label for="kelurahan_desa">Kelurahan/Desa : </label>
                    <span class="detail-value" id="kelurahan_desa_detail"></span>
                </div>

                <div class="form-group">
                    <label for="kode_pos">Kode Pos : </label>
                    <span class="detail-value" id="kode_pos_detail"></span>
                </div>

                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir : </label>
                    <span class="detail-value" id="tempat_lahir_detail"></span>
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir : </label>
                    <span class="detail-value" id="tanggal_lahir_detail"></span>
                </div>

                <div class="form-group">
                    <label for="no_telp">No Telp : </label>
                    <span class="detail-value" id="no_telp_detail"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email : </label>
                    <span class="detail-value" id="email_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nama_ibu_kandung">Nama Ibu Kandung : </label>
                    <span class="detail-value" id="nama_ibu_kandung_detail"></span>
                </div>

                <div class="form-group">
                    <label for="foto">Foto : </label>
                    <br>
                    <img class="detail-value" id="foto_detail" src="{{ asset('') }}" alt="Foto"
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
        $('#DiklatGMDSS').DataTable({
            "ajax": "{{ url('DiklatGMDSSAjax') }}",
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'seafare_code',
                    name: 'seafare_code'
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'pekerjaan',
                    name: 'pekerjaan'
                },
                {
                    data: 'kewarganegaraan',
                    name: 'kewarganegaraan'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'provinsi',
                    name: 'provinsi'
                },
                {
                    data: 'kabupaten_kota',
                    name: 'kabupaten_kota'
                },
                {
                    data: 'kecamatan',
                    name: 'kecamatan'
                },
                {
                    data: 'kode_pos',
                    name: 'kode_pos'
                },
                {
                    data: 'kelurahan_desa',
                    name: 'kelurahan_desa'
                },
                {
                    data: 'tanggal_lahir',
                    name: 'tanggal_lahir'
                },
                {
                    data: 'tempat_lahir',
                    name: 'tempat_lahir'
                },
                {
                    data: 'no_telp',
                    name: 'no_telp'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'foto',
                    name: 'foto'
                },
                {
                    data: 'nama_ibu_kandung',
                    name: 'nama_ibu_kandung'
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
            url: 'DiklatGMDSSAjax/' + id,
            type: 'GET',
            success: function (response) {
                var result = response.result;
                $('.detail-value#nama_lengkap_detail').text(result.nama_lengkap);
                $('.detail-value#seafare_code_detail').text(result.seafare_code);
                $('.detail-value#nik_detail').text(result.nik);
                $('.detail-value#tempat_lahir_detail').text(result.tempat_lahir);
                $('.detail-value#tanggal_lahir_detail').text(result.tanggal_lahir);
                $('.detail-value#email_detail').text(result.email);
                $('.detail-value#kewarganegaraan_detail').text(result.kewarganegaraan);
                $('.detail-value#pekerjaan_detail').text(result.pekerjaan);
                $('.detail-value#provinsi_detail').text(result.provinsi);
                $('.detail-value#kabupaten_kota_detail').text(result.kabupaten_kota);
                $('.detail-value#kelurahan_desa_detail').text(result.kelurahan_desa);
                $('.detail-value#kecamatan_detail').text(result.kecamatan);
                $('.detail-value#kode_pos_detail').text(result.kode_pos);
                $('.detail-value#nama_ibu_kandung_detail').text(result.nama_ibu_kandung);
                $('.detail-value#jenis_kelamin_detail').text(result.jenis_kelamin);
                $('.detail-value#no_telp_detail').text(result.no_telp);

                if (result.foto && result.foto !== null) {
                    // Pastikan ada foto sebelum mencoba menetapkan src
                    $('.detail-value#foto_detail').attr('src',
                        '{{ asset("storage/img/") }}/' + result.foto);
                } else {
                    // Misalnya, jika tidak ada foto, tampilkan placeholder atau pesan alternatif
                    $('.detail-value#foto_detail').attr('src',
                        '{{ asset("placeholder.jpg") }}');
                    // Atau sembunyikan elemen gambar sepenuhnya
                    // $('.detail-value#foto_detail').hide();
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
        $('#ModalGMDSS').modal('show');
        $('.tombol-simpan').on('click', function () {
            simpan();
        });
    });

    /* Proses Edit */
    $('body').on('click', '.tombol-edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: 'DiklatGMDSSAjax/' + id + '/edit',
            type: 'GET',
            success: function (response) {
                $('#ModalGMDSS').modal('show');
                $('#nama_lengkap').val(response.result.nama_lengkap);
                $('#nik').val(response.result.nik);
                $('#alamat').val(response.result.alamat);
                $('#seafare_code').val(response.result.seafare_code);
                $('#provinsi').val(response.result.provinsi);
                $('#kabupaten_kota').val(response.result.kabupaten_kota);
                $('#kecamatan').val(response.result.kecamatan);
                $('#kelurahan_desa').val(response.result.kelurahan_desa);
                $('#kode_pos').val(response.result.kode_pos);
                $('#tempat_lahir').val(response.result.tempat_lahir);
                $('#tanggal_lahir').val(response.result.tanggal_lahir);
                $('#email').val(response.result.email);
                $('#pekerjaan').val(response.result.pekerjaan);
                $('#foto').val('');
                $('#kewarganegaraan').val(response.result.kewarganegaraan);
                $('#nama_ibu_kandung').val(response.result.nama_ibu_kandung);
                $('#jenis_kelamin').val(response.result.jenis_kelamin);
                $('#no_telp').val(response.result.no_telp);
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
                url: 'DiklatGMDSSAjax/' + id,
                type: 'DELETE',
                success: function (response) {
                    console.log(response);
                    $('#DiklatGMDSS').DataTable().ajax.reload();
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
        data.append('nama_lengkap', $('#nama_lengkap').val());
        data.append('seafare_code', $('#seafare_code').val());
        data.append('nik', $('#nik').val());
        data.append('kewarganegaraan', $('#kewarganegaraan').val());
        data.append('pekerjaan', $('#pekerjaan').val());
        data.append('alamat', $('#alamat').val());
        data.append('provinsi', $('#provinsi').val());
        data.append('kecamatan', $('#kecamatan').val());
        data.append('kabupaten_kota', $('#kabupaten_kota').val());
        data.append('kelurahan_desa', $('#kelurahan_desa').val());
        data.append('no_telp', $('#no_telp').val());
        data.append('email', $('#email').val());
        data.append('jenis_kelamin', $('#jenis_kelamin').val());
        data.append('tempat_lahir', $('#tempat_lahir').val());
        data.append('tanggal_lahir', $('#tanggal_lahir').val());
        data.append('nama_ibu_kandung', $('#nama_ibu_kandung').val());
        data.append('kode_pos', $('#kode_pos').val());

        var fotoInput = $('#foto')[0];
        if (fotoInput.files.length > 0) {
            data.append('foto', fotoInput.files[0]);
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
            url: id === '' ? 'DiklatGMDSSAjax' : 'DiklatGMDSSAjax/' + id,
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
                $('#DiklatGMDSS').DataTable().ajax.reload();
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



    $('#ModalGMDSS').on('hidden.bs.modal', function () {
        var inputFoto = $('#foto');
        inputFoto.replaceWith(inputFoto.val('').clone(true));
        $('#nama_lengkap').val('');
        $('#nik').val('');
        $('#seafare_code').val('');
        $('#kewarganegaraan').val('');
        $('#pekerjaan').val('');
        $('#jenis_kelamin').val('');
        $('#alamat').val('');
        $('#provinsi').val('');
        $('#kecamatan').val('');
        $('#kabupaten_kota').val('');
        $('#kelurahan_desa').val('');
        $('#kode_pos').val('');
        $('#nama_ibu_kandung').val('');
        $('#email').val('');
        $('#tempat_lahir').val('');
        $('#tanggal_lahir').val('');
        $('#email').val('');
        $('#no_telp').val('');
        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');
        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });

</script>
@endsection