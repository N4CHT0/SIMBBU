@extends('layouts.main')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Nilai Ujian Lokal</h3>
        </div>

        <div class="card-body">
            <div class="btn-group mb-3 justify-content-between">
                <a href="#" class="btn btn-danger d-flex align-items-center">
                    Export Data Nilai Ujian Lokal
                </a>

                <button type="button" class="btn btn-success ms-2 d-flex align-items-center tombol-tambah">
                    Tambah Nilai Ujian Lokal
                </button>
            </div>
            <br>
            <br>
            <table id="NilaiUjianLokal" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nilai Teknik Radio</th>
                        <th>Nilai Service Document</th>
                        <th>Nilai Pengaturan Radio</th>
                        <th>Nilai Bahasa Inggris</th>
                        <th>Nilai Perjanjian Internasional</th>
                        <th>Nilai GMDSS</th>
                        <th>Nilai NAVEKA</th>
                        <th>Nilai Telephony</th>
                        <th>Nilai IBT</th>
                        <th>Nilai Morse</th>
                        <th>Nilai Pancasila</th>
                        <th>Nilai Teknik Listrik</th>
                        <th>Nilai Praktek Service Document</th>
                        <th>Nilai Praktek Telephony</th>
                        <th>Nilai Praktek Morse</th>
                        <th>Nilai Praktek GMDSS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah & Edit/Update -->
<div class="modal fade" id="ModalNilaiUjianLokal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Data Nilai Ujian Lokal</h5>
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
                    <label for="nilai_teknik_radio">Nilai Teknik Radio</label>
                    <input type="number" class="form-control" id="nilai_teknik_radio" name="nilai_teknik_radio" required>
                </div>

                <div class="form-group">
                    <label for="nilai_service_document">Nilai Service Document</label>
                    <input type="number" class="form-control" id="nilai_service_document" name="nilai_service_document" required>
                </div>

                <div class="form-group">
                    <label for="nilai_pengaturan_radio">Nilai Pengaturan Radio</label>
                    <input type="number" class="form-control" id="nilai_pengaturan_radio" name="nilai_pengaturan_radio"
                        required>
                </div>

                <div class="form-group">
                    <label for="nilai_bahasa_inggris">Nilai Bahasa Inggris</label>
                    <input type="number" class="form-control" id="nilai_bahasa_inggris" name="nilai_bahasa_inggris" required>
                </div>

                <div class="form-group">
                    <label for="nilai_perjanjian_internasional">Nilai Perjanjian Internasional</label>
                    <input type="number" class="form-control" id="nilai_perjanjian_internasional" name="nilai_perjanjian_internasional" required>
                </div>

                <div class="form-group">
                    <label for="nilai_gmdss">Nilai GMDSS</label>
                    <input type="number" class="form-control" id="nilai_gmdss" name="nilai_gmdss" required>
                </div>

                <div class="form-group">
                    <label for="nilai_naveka">Nilai NAVEKA</label>
                    <input type="number" class="form-control" id="nilai_naveka" name="nilai_naveka"
                        required>
                </div>

                <div class="form-group">
                    <label for="nilai_telephony">Nilai Telephony</label>
                    <input type="number" class="form-control" id="nilai_telephony" name="nilai_telephony"
                        required>
                </div>

                <div class="form-group">
                    <label for="nilai_ibt">Nilai IBT</label>
                    <input type="number" class="form-control" id="nilai_ibt" name="nilai_ibt" required>
                </div>

                <div class="form-group">
                    <label for="nilai_morse">Nilai Morse</label>
                    <input type="number" class="form-control" id="nilai_morse" name="nilai_morse" required>
                </div>

                <div class="form-group">
                    <label for="nilai_pancasila">Nilai Pancasila</label>
                    <input type="number" class="form-control" id="nilai_pancasila" name="nilai_pancasila" required>
                </div>

                <div class="form-group">
                    <label for="nilai_teknik_listrik">Nilai Teknik Listrik</label>
                    <input type="number" class="form-control" id="nilai_teknik_listrik" name="nilai_teknik_listrik" required>
                </div>

                <div class="form-group">
                    <label for="nilai_praktek_service_document">Nilai Praktek Service Document</label>
                    <input type="number" class="form-control" id="nilai_praktek_service_document" name="nilai_praktek_service_document" required>
                </div>

                <div class="form-group">
                    <label for="nilai_praktek_telephony">Nilai Praktek Telephony</label>
                    <input type="number" class="form-control" id="nilai_praktek_telephony" name="nilai_praktek_telephony" required>
                </div>

                <div class="form-group">
                    <label for="nilai_praktek_gmdss">Nilai Praktek GMDSS</label>
                    <input type="number" class="form-control" id="nilai_praktek_gmdss" name="nilai_praktek_gmdss" required>
                </div>
                <div class="form-group">
                    <label for="nilai_praktek_morse">Nilai Praktek Morse</label>
                    <input type="number" class="form-control" id="nilai_praktek_morse" name="nilai_praktek_morse" required>
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
                <h5 class="modal-title" id="DetailLabel">Data Nilai Ujian Lokal</h5>
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
                    <label for="nilai_teknik_radio">Nilai Teknik Radio : </label>
                    <span class="detail-value" id="nilai_teknik_radio_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_service_document">Nilai Service Document : </label>
                    <span class="detail-value" id="nilai_service_document_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_pengaturan_radio">Nilai Pengaturan Radio : </label>
                    <span class="detail-value" id="nilai_pengaturan_radio_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_bahasa_inggris">Nilai Bahasa Inggris : </label>
                    <span class="detail-value" id="nilai_bahasa_inggris_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_perjanjian_internasional">Nilai Perjanjian Internasional : </label>
                    <span class="detail-value" id="nilai_perjanjian_internasional_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_gmdss">Nilai GMDSS : </label>
                    <span class="detail-value" id="nilai_gmdss_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_naveka">Nilai NAVEKA : </label>
                    <span class="detail-value" id="nilai_naveka_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_telephony">Nilai Telephony : </label>
                    <span class="detail-value" id="nilai_telephony_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_ibt">Nilai IBT : </label>
                    <span class="detail-value" id="nilai_ibt_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_morse">Nilai Morse : </label>
                    <span class="detail-value" id="nilai_morse_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_pancasila">Nilai Pancasila : </label>
                    <span class="detail-value" id="nilai_pancasila_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_teknik_listrik">Nilai Teknik Listrik : </label>
                    <span class="detail-value" id="nilai_teknik_listrik_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_praktek_service_document">Nilai Praktek Service Document : </label>
                    <span class="detail-value" id="nilai_praktek_service_document_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_praktek_telephony">Nilai Praktek Telephony : </label>
                    <span class="detail-value" id="nilai_praktek_telephony_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_praktek_morse">Nilai Praktek Morse : </label>
                    <span class="detail-value" id="nilai_praktek_morse_detail"></span>
                </div>

                <div class="form-group">
                    <label for="nilai_praktek_gmdss">Nilai Praktek GMDSS : </label>
                    <span class="detail-value" id="nilai_praktek_gmdss_detail"></span>
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
        $('#NilaiUjianLokal').DataTable({
            "ajax": "{{ url('NilaiUjianLokalAjax') }}",
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nilai_teknik_radio',
                    name: 'nilai_teknik_radio'
                },
                {
                    data: 'nilai_service_document',
                    name: 'nilai_service_document'
                },
                {
                    data: 'nilai_pengaturan_radio',
                    name: 'nilai_pengaturan_radio'
                },
                {
                    data: 'nilai_bahasa_inggris',
                    name: 'nilai_bahasa_inggris'
                },
                {
                    data: 'nilai_perjanjian_internasional',
                    name: 'nilai_perjanjian_internasional'
                },
                {
                    data: 'nilai_gmdss',
                    name: 'nilai_gmdss'
                },
                {
                    data: 'nilai_naveka',
                    name: 'nilai_naveka'
                },
                {
                    data: 'nilai_telephony',
                    name: 'nilai_telephony'
                },
                {
                    data: 'nilai_ibt',
                    name: 'nilai_ibt'
                },
                {
                    data: 'nilai_morse',
                    name: 'nilai_morse'
                },
                {
                    data: 'nilai_pancasila',
                    name: 'nilai_pancasila'
                },
                {
                    data: 'nilai_teknik_listrik',
                    name: 'nilai_teknik_listrik'
                },
                {
                    data: 'nilai_praktek_service_document',
                    name: 'nilai_praktek_service_document'
                },
                {
                    data: 'nilai_praktek_telephony',
                    name: 'nilai_praktek_telephony'
                },
                {
                    data: 'nilai_praktek_morse',
                    name: 'nilai_praktek_morse'
                },
                {
                    data: 'nilai_praktek_gmdss',
                    name: 'nilai_praktek_gmdss'
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
            url: 'NilaiUjianLokalAjax/' + id,
            type: 'GET',
            success: function (response) {
                var result = response.result;
                $('.detail-value#nilai_service_document_detail').text(result.nilai_service_document);
                $('.detail-value#nilai_gmdss_detail').text(result.nilai_gmdss);
                $('.detail-value#nilai_pengaturan_radio_detail').text(result.nilai_pengaturan_radio);
                $('.detail-value#nilai_teknik_radio_detail').text(result.nilai_teknik_radio);
                $('.detail-value#nilai_praktek_telephony_detail').text(result.nilai_praktek_telephony);
                $('.detail-value#nilai_praktek_morse_detail').text(result.nilai_praktek_morse);
                $('.detail-value#nilai_telephony_detail').text(result.nilai_telephony);
                $('.detail-value#nilai_bahasa_inggris_detail').text(result.nilai_bahasa_inggris);
                $('.detail-value#nilai_naveka_detail').text(result.nilai_naveka);
                $('.detail-value#nilai_ibt_detail').text(result.nilai_ibt);
                $('.detail-value#nilai_morse_detail').text(result.nilai_morse);
                $('.detail-value#nilai_teknik_listrik_detail').text(result.nilai_teknik_listrik);
                $('.detail-value#nilai_pancasila_detail').text(result.nilai_pancasila);
                $('.detail-value#nilai_praktek_service_document_detail').text(result.nilai_praktek_service_document);
                $('.detail-value#nilai_perjanjian_internasional_detail').text(result.nilai_perjanjian_internasional);
                $('.detail-value#nilai_praktek_gmdss_detail').text(result.nilai_praktek_gmdss);

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
        $('#ModalNilaiUjianLokal').modal('show');
        $('.tombol-simpan').on('click', function () {
            simpan();
        });
    });

    /* Proses Edit */
    $('body').on('click', '.tombol-edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: 'NilaiUjianLokalAjax/' + id + '/edit',
            type: 'GET',
            success: function (response) {
                $('#ModalNilaiUjianLokal').modal('show');
                $('#nilai_service_document').val(response.result.nilai_service_document);
                $('#nilai_pengaturan_radio').val(response.result.nilai_pengaturan_radio);
                $('#nilai_gmdss').val(response.result.nilai_gmdss);
                $('#nilai_naveka').val(response.result.nilai_naveka);
                $('#nilai_teknik_radio').val(response.result.nilai_teknik_radio);
                $('#nilai_ibt').val(response.result.nilai_ibt);
                $('#nilai_morse').val(response.result.nilai_morse);
                $('#nilai_pancasila').val(response.result.nilai_pancasila);
                $('#nilai_teknik_listrik').val(response.result.nilai_teknik_listrik);
                $('#nilai_praktek_service_document').val(response.result.nilai_praktek_service_document);
                $('#nilai_praktek_telephony').val(response.result.nilai_praktek_telephony);
                $('#nilai_bahasa_inggris').val(response.result.nilai_bahasa_inggris);
                $('#nilai_praktek_morse').val(response.result.nilai_praktek_morse);
                $('#nilai_telephony').val(response.result.nilai_telephony);
                $('#nilai_perjanjian_internasional').val(response.result.nilai_perjanjian_internasional);
                $('#nilai_praktek_gmdss').val(response.result.nilai_praktek_gmdss);
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
                url: 'NilaiUjianLokalAjax/' + id,
                type: 'DELETE',
                success: function (response) {
                    console.log(response);
                    $('#NilaiUjianLokal').DataTable().ajax.reload();
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
        data.append('nilai_service_document', $('#nilai_service_document').val());
        data.append('nilai_teknik_radio', $('#nilai_teknik_radio').val());
        data.append('nilai_pengaturan_radio', $('#nilai_pengaturan_radio').val());
        data.append('nilai_bahasa_inggris', $('#nilai_bahasa_inggris').val());
        data.append('nilai_naveka', $('#nilai_naveka').val());
        data.append('nilai_telephony', $('#nilai_telephony').val());
        data.append('nilai_gmdss', $('#nilai_gmdss').val());
        data.append('nilai_ibt', $('#nilai_ibt').val());
        data.append('nilai_pancasila', $('#nilai_pancasila').val());
        data.append('nilai_morse', $('#nilai_morse').val());
        data.append('nilai_teknik_listrik', $('#nilai_teknik_listrik').val());
        data.append('nilai_praktek_gmdss', $('#nilai_praktek_gmdss').val());
        data.append('nilai_perjanjian_internasional', $('#nilai_perjanjian_internasional').val());
        data.append('nilai_praktek_telephony', $('#nilai_praktek_telephony').val());
        data.append('nilai_praktek_morse', $('#nilai_praktek_morse').val());
        data.append('nilai_praktek_service_document', $('#nilai_praktek_service_document').val());

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
            url: id === '' ? 'NilaiUjianLokalAjax' : 'NilaiUjianLokalAjax/' + id,
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
                $('#NilaiUjianLokal').DataTable().ajax.reload();
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



    $('#ModalNilaiUjianLokal').on('hidden.bs.modal', function () {
        var inputFoto = $('#foto');
        inputFoto.replaceWith(inputFoto.val('').clone(true));
        $('#nilai_service_document').val('');
        $('#nilai_bahasa_inggris').val('');
        $('#nilai_pengaturan_radio').val('');
        $('#nilai_teknik_radio').val('');
        $('#nilai_telephony').val('');
        $('#nilai_perjanjian_internasional').val('');
        $('#nilai_gmdss').val('');
        $('#nilai_naveka').val('');
        $('#nilai_ibt').val('');
        $('#nilai_pancasila').val('');
        $('#nilai_morse').val('');
        $('#nilai_teknik_listrik').val('');
        $('#nilai_praktek_service_document').val('');
        $('#nilai_praktek_telephony').val('');
        $('#nilai_praktek_morse').val('');
        $('#nilai_praktek_gmdss').val('');
        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');
        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });

</script>
@endsection
