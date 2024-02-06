@extends('layouts.main')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Pegawai</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="btn-group mb-3 justify-content-between" role="group">
                <a href="#" class="btn btn-danger d-flex align-items-center">
                    Export Data Pegawai
                </a>

                <button type="button" class="btn btn-success ms-2 d-flex align-items-center tombol-tambah">
                    Tambah Pegawai
                </button>
            </div>
            <br>
            <br>
            <table id="Pegawai" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Divisi</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->



<!-- Modal Tambah/Edit Data -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form tambah user -->
                <div class="alert alert-danger d-none"></div>
                <div class="alert alert-success d-none"></div>
                <!-- Sesuaikan dengan kolom-kolom yang ingin ditambahkan -->
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" required>
                </div>

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" required>
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
                    <input type="number" class="form-control" id="no_telp" name="no_telp" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="divisi">Divisi</label>
                    <select class="form-control" id="divisi" name="divisi" required>
                        <!-- Pilihan role sesuai dengan kebutuhan -->
                        <option value="Keuangan">Keuangan</option>
                        <option value="Desain">Desain</option>
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
                <h5 class="modal-title" id="DetailLabel">Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <div class="alert alert-danger d-none"></div>
                <div class="alert alert-success d-none"></div>
                <!-- Sesuaikan dengan kolom-kolom yang ingin ditambahkan -->
                <div class="form-group">
                    <label for="nip">NIP : </label>
                    <span id="nip_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap : </label>
                    <span id="nama_lengkap_detail"></span>
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan : </label>
                    <span id="jabatan_detail"></span>
                </div>

                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir : </label>
                    <span id="tempat_lahir_detail"></span>
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir : </label>
                    <span id="tanggal_lahir_detail"></span>
                </div>

                <div class="form-group">
                    <label for="no_telp">No Telp : </label>
                    <span id="no_telp_detail"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email : </label>
                    <span id="email_detail"></span>
                </div>

                <div class="form-group">
                    <label for="divisi">Divisi : </label>
                    <span id="divisi_detail"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" type="submit" class="btn btn-secondary">Batal</button>
            </div>
        </div>
    </div>
</div>


@endsection
<!-- ... Bagian-bagian sebelumnya ... -->

@section('script')
<script>
    $(function () {
        $('#Pegawai').DataTable({
            "ajax": "{{ url('PegawaiAjax') }}",
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'divisi',
                    name: 'divisi'
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
            url: 'PegawaiAjax/' + id,
            type: 'GET',
            success: function (response) {
                $('#Detail').modal('show');
                $('#nama_lengkap_detail').text(response.result.nama_lengkap);
                $('#nip_detail').text(response.result.nip);
                $('#tempat_lahir_detail').text(response.result.tempat_lahir);
                $('#tanggal_lahir_detail').text(response.result.tanggal_lahir);
                $('#email_detail').text(response.result.email);
                $('#jabatan_detail').text(response.result.jabatan);
                $('#divisi_detail').text(response.result.divisi);
                $('#no_telp_detail').text(response.result.no_telp);
                console.log(response.result);
            }
        });
    });


    /* Proses Tambah */
    $('body').on('click', '.tombol-tambah', function (e) {
        e.preventDefault();
        $('#Modal').modal('show');

        $('.tombol-simpan').click(function () {
            simpan();
        });
    });

    /* Proses Edit */
    $('body').on('click', '.tombol-edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: 'PegawaiAjax/' + id + '/edit',
            type: 'GET',
            success: function (response) {
                $('#Modal').modal('show');
                $('#nama_lengkap').val(response.result.nama_lengkap);
                $('#nip').val(response.result.nip);
                $('#tempat_lahir').val(response.result.tempat_lahir);
                $('#tanggal_lahir').val(response.result.tanggal_lahir);
                $('#email').val(response.result.email);
                $('#jabatan').val(response.result.jabatan);
                $('#divisi').val(response.result.divisi);
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
                url: 'PegawaiAjax/' + id,
                type: 'DELETE',
                success: function (response) {
                    // Lakukan sesuatu setelah penghapusan berhasil, jika perlu
                    console.log(response);
                    $('#Pegawai').DataTable().ajax.reload();
                },
                error: function (xhr, status, error) {
                    // Tangani kesalahan, jika perlu
                    console.error(xhr.responseText);
                }
            });
        }
    });


    /* Fungsi Simpan & Update */
    function simpan(id = '') {
        if (id === '') {
            var var_url = 'PegawaiAjax';
            var var_type = 'POST';
        } else {
            var var_url = 'PegawaiAjax/' + id;
            var var_type = 'PUT';
        }
        $.ajax({
            url: var_url,
            type: var_type,
            data: {
                nama_lengkap: $('#nama_lengkap').val(),
                nip: $('#nip').val(),
                jabatan: $('#jabatan').val(),
                tempat_lahir: $('#tempat_lahir').val(),
                tanggal_lahir: $('#tanggal_lahir').val(),
                no_telp: $('#no_telp').val(),
                email: $('#email').val(),
                divisi: $('#divisi').val(),
            },
            success: function (response) {
                if (response.errors) {
                    console.log(response);
                    $('.alert-danger').removeClass('d-none');
                    $('.alert-danger').append("<ul>")
                    $.each(response.errors, function (key, value) {
                        $('.alert-danger').find('ul').append("<li>" + value + "</li>")
                    });
                    $('.alert-danger').append("</ul>")
                } else {
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').html(response.success);
                }
                $('#Pegawai').DataTable().ajax.reload();
            },
        });
    }

    $('#Modal').on('hidden.bs.modal', function () {
        $('#nama_lengkap').val('');
        $('#nip').val('');
        $('#jabatan').val('');
        $('#divisi').val('');
        $('#email').val('');
        $('#tempat_lahir').val('');
        $('#tanggal_lahir').val('');
        $('#no_telp').val('');

        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');

        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });

</script>
@endsection
