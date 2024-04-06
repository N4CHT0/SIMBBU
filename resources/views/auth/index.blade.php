@extends('layouts.main')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Pengguna SIM-BBU</h3>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div class="btn-group mb-3 justify-content-between" role="group">
                <a href="#" class="btn btn-danger d-flex align-items-center">
                    Export Data Pengguna
                </a>

                <button type="button" class="btn btn-success ms-2 d-flex align-items-center tombol-tambah">
                    Tambah Pengguna
                </button>
            </div>
            <br>
            <br>
            <table id="UsersTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Data Masuk</th>
                        <th>Terakhir Data Di Ubah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Modal Tambah/Edit Data -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Data Pengguna SIM-BBU</h5>
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
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <!-- Pilihan role sesuai dengan kebutuhan -->
                        <option value="peserta">Peserta</option>
                        <option value="peserta_ujian">Peserta Ujian</option>
                        <option value="admin">Admin</option>
                        <option value="pegawai">Pegawai</option>
                        <option value="keuangan">Keuangan</option>
                        <option value="pengajar">Pengajar</option>
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
                <h5 class="modal-title" id="DetailLabel">Data Pengguna SIM-BBU</h5>
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
                    <label for="username">Username : </label>
                    <span class="detail-value" id="username_detail"></span>
                </div>

                <div class="form-group">
                    <label for="role">Role : </label>
                    <span class="detail-value" id="role_detail"></span>
                </div>

                <div class="form-group">
                    <label for="created_at">Data Masuk : </label>
                    <span class="detail-value" id="created_at_detail"></span>
                </div>
                <div class="form-group">
                    <label for="updated_at">Terakhir Data Ubah : </label>
                    <span class="detail-value" id="updated_at_detail"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email : </label>
                    <span class="detail-value" id="email_detail"></span>
                </div>

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
    $(function () {
        $('#UsersTable').DataTable({
            "ajax": "{{ url('UsersAjax') }}",
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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
        console.log("Clicked ID:", id);
        $.ajax({
            url: 'UsersAjax/' + id,
            type: 'GET',
            success: function (response) {
                console.log("Response:", response);
                if (response.hasOwnProperty('error')) {
                    console.error("Data not found");
                } else {
                    var result = response.result;
                    $('#Detail').modal('show');
                    $('.detail-value#username_detail').text(result.username);
                    $('.detail-value#email_detail').text(result.email);
                    $('.detail-value#role_detail').text(result.role);
                    $('.detail-value#role_detail').text(result.role);
                    $('.detail-value#created_at_detail').text(result.created_at);
                    $('.detail-value#updated_at_detail').text(result.updated_at);
                }
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
            url: 'UsersAjax/' + id + '/edit',
            type: 'GET',
            success: function (response) {
                $('#Modal').modal('show');
                $('#username').val(response.result.username);
                $('#password').val(response.result.password);
                $('#created_at').val(response.result.created_at);
                $('#updated_at').val(response.result.updated_at);
                $('#email').val(response.result.email);
                $('#role').val(response.result.role);
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
                url: 'UsersAjax/' + id,
                type: 'DELETE',
                success: function (response) {
                    // Lakukan sesuatu setelah penghapusan berhasil, jika perlu
                    console.log(response);
                    $('#UsersTable').DataTable().ajax.reload();
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
            var var_url = 'UsersAjax';
            var var_type = 'POST';
        } else {
            var var_url = 'UsersAjax/' + id;
            var var_type = 'PUT';
        }
        $.ajax({
            url: var_url,
            type: var_type,
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
                created_at: $('#created_at').val(),
                updated_at: $('#updated_at').val(),
                role: $('#role').val(),
                email: $('#email').val(),
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
                $('#UsersTable').DataTable().ajax.reload();
            },
        });
    }

    $('#Modal').on('hidden.bs.modal', function () {
        $('#username').val('');
        $('#password').val('');
        $('#role').val('');
        $('#email').val('');
        $('#no_telp').val('');

        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');

        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });

</script>
@endsection
