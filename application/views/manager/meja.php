<style>
    .hide {
        display: none;
    }

    .streched-links {
        width: 100%;
        height: 100%;
        text-decoration: none;
        background-color: transparent;
        transition: .5s;
    }

    .streched-links:hover {
        text-decoration: none;
        background-color: rgba(100, 0, 100, 0.3);
    }

    .card-meja {
        -webkit-box-shadow: none;
        box-shadow: none;
        transition: .3s;
    }

    .card-meja:hover {
        -webkit-box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
    }
</style>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="failadd" data-failadd="<?= $this->session->flashdata('failadd'); ?>"></div>
    <div class="succadd" data-succadd="<?= $this->session->flashdata('succadd'); ?>"></div>
    <div class="failupdate" data-failupdate="<?= $this->session->flashdata('failupdate'); ?>"></div>
    <div class="succupdate" data-succupdate="<?= $this->session->flashdata('succupdate'); ?>"></div>

    <div class="row">
        <div class="col-lg-12">
            <div class="accordion" id="accordion-jenis">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="heading-jenis" data-toggle="collapse" data-target="#collapse-jenis" aria-expanded="true" aria-controls="collapse-jenis">
                        <h6 class="m-0 font-weight-bold text-primary">List jenis meja</h6>
                    </div>
                    <div class="card-body collapse" id="collapse-jenis" aria-labelledby="heading-jenis" data-parent="#accordion-jenis">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="dropdown mb-3">
                                    <a href="#" role="button" class="btn btn-primary jenismeja-add" data-toggle="modal" data-target="#newJenisMeja"><i class="fas fa-fw fa-plus"></i> Jenis Meja</a>
                                    <a class="dropdown-toggle btn btn-primary ml-1" href="#" role="button" id="jenis-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sort by All status
                                    </a>
                                    <div class="dropdown-menu dropdown-jenis-left shadow animated--fade-in" aria-labelledby="jenis-dropdown">
                                        <div class="dropdown-header">Status meja :</div>
                                        <a class="dropdown-item jenis-status" href="#" data-status="2">All status</a>
                                        <a class="dropdown-item jenis-status" href="#" data-status="1">Active</a>
                                        <a class="dropdown-item jenis-status" href="#" data-status="0">Denied</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control search-jenismeja" placeholder="Cari jenis meja">
                            </div>
                        </div>

                        <div class="row jenismeja-table">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-jenismeja">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Control</th>
                                                <th>Jenis</th>
                                                <th>Jumlah kursi</th>
                                                <th>Status</th>
                                                <th>Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Generate by Ajax -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-center mt-3">
                                <span class="tarosaja"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="accordion" id="accordion-meja">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="heading-meja" data-toggle="collapse" data-target="#collapse-meja" aria-expanded="true" aria-controls="collapse-meja">
                        <h6 class="m-0 font-weight-bold text-primary">List meja</h6>
                    </div>
                    <div class="card-body collapse" id="collapse-meja" aria-labelledby="heading-meja" data-parent="#accordion-meja">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="dropdown mb-3">
                                    <a href="#" role="button" class="btn btn-primary meja-add" data-toggle="modal" data-target="#newMeja"><i class="fas fa-fw fa-plus"></i> Meja</a>
                                    <a class="dropdown-toggle btn btn-primary ml-1" href="#" role="button" id="menu-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sort by All status
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in" aria-labelledby="menu-dropdown">
                                        <div class="dropdown-header">Status meja :</div>
                                        <a class="dropdown-item menu-status" href="#" data-status="2">All status</a>
                                        <a class="dropdown-item menu-status" href="#" data-status="1">Taken</a>
                                        <a class="dropdown-item menu-status" href="#" data-status="0">Available</a>
                                    </div>
                                    <a href="#" role="button" title="Show as table" class="btn btn-primary ml-1 show-list"><i class="fas fa-fw fa-list"></i></a>
                                    <a href="#" role="button" title="Show as gallery" class="btn btn-primary ml-1 show-table hide"><i class="fas fa-fw fa-table"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control search-meja" placeholder="Cari jenis meja">
                            </div>
                        </div>

                        <div class="row meja-card">
                            <!-- Append ajax -->
                        </div>

                        <div class="row meja-table hide">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-meja">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Control</th>
                                                <th>Nomer</th>
                                                <th>Jenis</th>
                                                <th>Status</th>
                                                <th>Kursi Tersedia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Generate by Ajax -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-center mt-3">
                                <span class="tarosini"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newMeja" tabindex="-1" role="dialog" aria-labelledby="newMejaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Judul modal -->
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="newMejaLabel">Meja baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- End Judul modal -->

            <form action="<?= base_url(); ?>manager/ajaxNewMeja" class="form-users" id="form-meja" method="POST">
                <input type="hidden" name="meja_id" id="meja_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="meja_nomer">Nomer Meja</label>
                        <input type="text" name="meja_nomer" id="meja_nomer" class="form-control" autocomplete="off" placeholder="Nomer meja">
                        <span class="error_nomer"></span>
                    </div>
                    <div class="form-group">
                        <label for="meja_jenis">Jenis Meja</label>
                        <select class="form-control" name="meja_jenis" id="meja_jenis">
                            <option value="" disabled selected>Jenis meja</option>
                            <?php foreach ($jenis as $j) : ?>
                                <option value="<?= $j['jenismeja_id']; ?>"><?= $j['jenismeja_nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_kursi">Jumlah Kursi</label>
                        <input type="number" name="jumlah_kursi" id="jumlah_kursi" class="form-control" autocomplete="off" placeholder="Jumlah kursi">
                        <span class="error_jumlah"></span>
                    </div>
                    <div class="form-group">
                        <label for="meja_status">Status Meja</label>
                        <select class="form-control" name="meja_status" id="meja_status">
                            <option value="0">Available</option>
                            <option value="1">Taken</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-meja">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="newJenisMeja" tabindex="-1" role="dialog" aria-labelledby="newJenisMejaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Judul modal -->
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="newJenisMejaLabel">Jenis Meja baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- End Judul modal -->

            <form action="<?= base_url(); ?>manager/ajaxNewJenisMeja" class="form-users" id="form-jenismeja" method="POST">
                <input type="hidden" name="jenismeja_id" id="jenismeja_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jenismeja_nama">Jenis meja</label>
                        <input type="text" name="jenismeja_nama" id="jenismeja_nama" class="form-control" autocomplete="off" placeholder="Jenis meja">
                        <span class="error_nama"></span>
                    </div>
                    <div class="form-group">
                        <label for="jenismeja_kursi">Jumlah kursi</label>
                        <input type="number" name="jenismeja_kursi" id="jenismeja_kursi" class="form-control" autocomplete="off" placeholder="Jumlah kursi">
                        <span class="error_jumlah"></span>
                    </div>
                    <div class="form-group">
                        <label for="jenismeja_desc">Deskripsi meja</label>
                        <textarea class="form-control" name="jenismeja_desc" id="jenismeja_desc" cols="30" rows="5" placeholder="Deskripsi meja"></textarea>
                        <span class="error_desc"></span>
                    </div>
                    <div class="form-group">
                        <label for="jenismeja_status">Status jenis meja</label>
                        <select class="form-control" name="jenismeja_status" id="jenismeja_status">
                            <option value="1">Active</option>
                            <option value="0">Denied</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-jenismeja">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        const base_url = '<?= base_url() ?>';
        let statsMeja = 2;
        let statsJenis = 2;
        let sercMeja = '';
        let sercJenis = '';

        function getMeja(url, status, search) {
            if (!url) {
                url = base_url + 'manager/getData'
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: {
                    status: status,
                    search: search
                },
                success: function(hasil) {
                    $('#table-meja tbody').html(hasil.hasil);
                    $(".tarosini").html(hasil.error);
                    $(".meja-card").html(hasil.card);
                }
            });
        }

        function getJenis(url, status, search) {
            if (!url) {
                url = base_url + 'manager/getJenis'
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: {
                    status: status,
                    search: search
                },
                success: function(hasil) {
                    $('#table-jenismeja tbody').html(hasil.hasil);
                    $(".tarosaja").html(hasil.error);
                }
            });
        }

        getMeja('', statsMeja, sercMeja);
        getJenis('', statsJenis, sercJenis);

        $(document).on('click', "ul.pagination>li>a", function() {
            let href = $(this).attr('href');
            getMeja(href, statsMeja, sercMeja);
            getJenis(href, statsJenis, sercJenis);

            return false;
        });

        $('.show-list').on('click', function(e) {
            e.preventDefault();

            $('.show-list').toggleClass('hide', true);
            $('.show-table').toggleClass('hide', false);

            $('.meja-card').toggleClass('hide', true);
            $('.meja-table').toggleClass('hide', false);
        });

        $('.show-table').on('click', function(e) {
            e.preventDefault();

            $('.show-list').toggleClass('hide', false);
            $('.show-table').toggleClass('hide', true);

            $('.meja-card').toggleClass('hide', false);
            $('.meja-table').toggleClass('hide', true);
        });

        $('#form-meja').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let url = $(this).attr('action');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                data: formData,
                success: function(hasil) {
                    if (hasil.result == false) {
                        $('.error_nomer').html(hasil.error.meja_nomer);
                        $('.error_jumlah').html(hasil.error.jumlah_kursi);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            width: 600,
                            padding: '2em',
                            title: hasil.error + ' meja berhasil!',
                            html: "Selamat, meja untuk tamu kamu berhasil di " + hasil.error + "."
                        }).then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function(hasil) {
                    console.log('error cok');
                    console.log(hasil);
                }
            });
        });

        $('#form-jenismeja').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let url = $(this).attr('action');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                data: formData,
                success: function(hasil) {
                    if (hasil.result == false) {
                        $('.error_nama').html(hasil.error.jenismeja_nama);
                        $('.error_jumlah').html(hasil.error.jenismeja_kursi);
                        $('.error_desc').html(hasil.error.jenismeja_desc);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            width: 600,
                            padding: '2em',
                            title: hasil.error + ' jenis meja berhasil!',
                            html: "Selamat, jenis meja untuk tamu kamu berhasil di " + hasil.error + "."
                        }).then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function(hasil) {
                    console.log('error cok');
                    console.log(hasil);
                }
            })
        });

        $(document).on('click', '.meja-add', function(e) {
            $('#newMejaLabel').html('Meja baru');
            $('#form-meja').attr('action', base_url + 'manager/ajaxNewMeja');

            $('#meja_id').val('');
            $('#meja_nomer').val('');
            $('#meja_jenis').val('');
            $('#jumlah_kursi').val('');
            $('#meja_status').val(0);
        });

        $(document).on('change', '#meja_jenis', function() {
            let id = $(this).val();

            $.ajax({
                url: base_url + 'manager/ajaxGetJenisMejaById',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id
                },
                success: function(hasil) {
                    $('#jumlah_kursi').val(hasil.jenismeja_kursi);
                }
            })
        });

        $(document).on('click', '.jenismeja-add', function(e) {
            $('#newJenisMejaLabel').html('Jenis Meja baru');
            $('#form-jenismeja').attr('action', base_url + 'manager/ajaxNewJenisMeja');

            $('#jenismeja_id').val('');
            $('#jenismeja_nama').val('');
            $('#jenismeja_kursi').val('');
            $('#jenismeja_desc').val('');
            $('#jenismeja_status').val(0);
        });

        $(document).on('click', '.meja-edit', function(e) {
            $('#form-meja').attr('action', base_url + 'manager/ajaxUpdateMeja');
            const id = $(this).data('id');

            $.ajax({
                url: base_url + 'manager/ajaxGetMejaById',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id
                },
                success: function(hasil) {
                    $('#newMejaLabel').html('Meja ' + hasil.meja_nomer);

                    $('#meja_id').val(hasil.meja_id);
                    $('#meja_nomer').val(hasil.meja_nomer);
                    $('#meja_jenis').val(hasil.jenismeja_id);
                    $('#jumlah_kursi').val(hasil.kursi_tersedia);
                    $('#meja_status').val(hasil.isTaken);
                }
            })
        });

        $(document).on('click', '.jenismeja-edit', function(e) {
            $('#form-jenismeja').attr('action', base_url + 'manager/ajaxUpdateJenisMeja');
            const id = $(this).data('id');

            $.ajax({
                url: base_url + 'manager/ajaxGetJenisMejaById',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id
                },
                success: function(hasil) {
                    $('#newJenisMejaLabel').html('Jenis Meja ' + hasil.jenismeja_nama);

                    $('#jenismeja_id').val(hasil.jenismeja_id);
                    $('#jenismeja_nama').val(hasil.jenismeja_nama);
                    $('#jenismeja_kursi').val(hasil.jenismeja_kursi);
                    $('#jenismeja_desc').val(hasil.jenismeja_desc);
                    $('#jenismeja_status').val(hasil.jenismeja_status);
                }
            })
        });

        $(document).on('click', '.menu-status', function(e) {
            let text = $(this).text();
            statsMeja = $(this).data('status');

            $('#menu-dropdown').html("Sort by " + text);

            getMeja('', statsMeja, sercMeja);

            e.preventDefault();
        });

        $(document).on('click', '.jenis-status', function(e) {
            let text = $(this).text();
            statsJenis = $(this).data('status');

            $('#jenis-dropdown').html("Sort by " + text);

            getJenis('', statsJenis, sercJenis);

            e.preventDefault();
        });

        $(document).on('keyup', '.search-meja', function(e) {
            sercMeja = $(this).val();
            getMeja('', statsMeja, sercMeja);

            e.preventDefault();
        });

        $(document).on('keyup', '.search-jenismeja', function(e) {
            sercJenis = $(this).val();

            getJenis('', statsJenis, sercJenis);

            e.preventDefault();
        });
    });
</script>