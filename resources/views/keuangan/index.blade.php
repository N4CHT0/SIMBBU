@extends('layouts.main')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Keuangan Peserta</h3>
        </div>

        <div class="card-body">
            <div class="btn-group mb-3 justify-content-between">
                <a href="#" class="btn btn-danger d-flex align-items-center">
                    Export Data Keuangan Peserta
                </a>

                <button type="button" class="btn btn-success ms-2 d-flex align-items-center tombol-tambah">
                    Tambah Data Keuangan Peserta
                </button>
            </div>
            <br>
            <br>
            <div class="table-responsive"></div>
            <table id="Keuangan" class="table table-bordered table-hover dt-responsive display nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Diklat</th>
                        <th>Status Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah & Edit/Update -->
<div class="modal fade" id="ModalKeuangan" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Data Keuangan Peserta</h5>
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
                    <label for="status_pembayaran">Status Pembayaran</label>
                    <input type="text" class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                </div>

                <div class="form-group">
                    <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="jenis_diklat">Jenis Diklat</label>
                    <select class="form-control" id="jenis_diklat" name="jenis_diklat" required>
                        <!-- Pilihan role sesuai dengan kebutuhan -->
                        <option value="sou-r">SOU-R</option>
                        <option value="sou-m">SOU-M</option>
                        <option value="gmdss">GMDSS</option>
                        <option value="sso">SSO</option>
                        <option value="mfa">MFA</option>
                        <option value="mc">MC</option>
                        <option value="sat">SAT</option>
                        <option value="satsdsd">SATSDSD</option>
                        <option value="sre-1">SRE-I</option>
                        <option value="sre-2">SRE-II</option>
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
                <h5 class="modal-title" id="DetailLabel">Data Perpanjangan Sertifikat SOU</h5>
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
                    <label for="jenis_diklat">Jenis Diklat : </label>
                    <span class="detail-value" id="jenis_diklat_detail"></span>
                </div>

                <div class="form-group">
                    <label for="status_pembayaran">Status Pembayaran : </label>
                    <span class="detail-value" id="status_pembayaran_detail"></span>
                </div>

                <div class="form-group">
                    <label for="bukti_pembayaran">Bukti Pembayaran : </label>
                    <br>
                    <img class="detail-value" id="bukti_pembayaran_detail" src="{{ asset('') }}" alt="Foto"
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
        $('#Keuangan').DataTable({
            "ajax": "{{ url('KeuanganAjax') }}",
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'jenis_diklat',
                    name: 'jenis_diklat'
                },
                {
                    data: 'status_pembayaran',
                    name: 'status_pembayaran'
                },
                {
                    data: 'bukti_pembayaran',
                    name: 'bukti_pembayaran'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
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
            url: 'KeuanganAjax/' + id,
            type: 'GET',
            success: function (response) {
                var result = response.result;
                $('.detail-value#jenis_diklat_detail').text(result.jenis_diklat);
                $('.detail-value#status_pembayaran_detail').text(result.status_pembayaran);

                if (result.bukti_pembayaran && result.bukti_pembayaran !== null) {
                    // Pastikan ada foto sebelum mencoba menetapkan src
                    $('.detail-value#bukti_pembayaran_detail').attr('src',
                        '{{ asset("storage/img/") }}/' + result.bukti_pembayaran);
                } else {
                    // Misalnya, jika tidak ada foto, tampilkan placeholder atau pesan alternatif
                    // $('.detail-value#foto_detail').attr('src', '{{ asset("placeholder.jpg") }}');
                    // Atau sembunyikan elemen gambar sepenuhnya
                    $('.detail-value#bukti_pembayaran_detail').hide();
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
        $('#ModalKeuangan').modal('show');
        $('.tombol-simpan').on('click', function () {
            simpan();
        });
    });

    /* Proses Edit */
    $('body').on('click', '.tombol-edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: 'KeuanganAjax/' + id + '/edit',
            type: 'GET',
            success: function (response) {
                $('#ModalKeuangan').modal('show');
                $('#jenis_diklat').val(response.result.jenis_diklat);
                $('#status_pembayaran').val(response.result.status_pembayaran);
                $('#bukti_pembayaran').val('');
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
                url: 'KeuanganAjax/' + id,
                type: 'DELETE',
                success: function (response) {
                    console.log(response);
                    $('#Keuangan').DataTable().ajax.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    /* Fungsi Simpan & Update */
    function simpan(id = '') {
        // Mendapatkan data dari elemen HTML
        var data = new FormData();
        data.append('jenis_diklat', $('#jenis_diklat').val());
        data.append('status_pembayaran', $('#status_pembayaran').val());

        var buktiPembayaranInput = $('#bukti_pembayaran')[0];
        if (buktiPembayaranInput.files.length > 0) {
            data.append('bukti_pembayaran', buktiPembayaranInput.files[0]);
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

        // Kirim permintaan
        $.ajax({
            url: id === '' ? 'KeuanganAjax' : 'KeuanganAjax/' + id,
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
                $('#Keuangan').DataTable().ajax.reload();
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



    $('#ModalKeuangan').on('hidden.bs.modal', function () {
        var inputFoto = $('#bukti_pembayaran');
        inputFoto.replaceWith(inputFoto.val('').clone(true));
        $('#jenis_diklat').val('');
        $('#status_pembayaran').val('');
        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');
        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });

</script>
@endsection
