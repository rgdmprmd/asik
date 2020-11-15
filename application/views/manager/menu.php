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
        background-color: rgba(255, 255, 255, 0.3);
    }

    .card-menu {
        -webkit-box-shadow: none;
        box-shadow: none;
        transition: .3s;
    }

    .card-menu:hover {
        -webkit-box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
    }

    .card-bods {
        min-height: 400px;
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
                        <h6 class="m-0 font-weight-bold text-primary">List Jenis Menu</h6>
                    </div>
                    <div class="card-body card-bods collapse" id="collapse-jenis" aria-labelledby="heading-jenis" data-parent="#accordion-jenis">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="dropdown mb-3">
                                    <a href="#" role="button" class="btn btn-primary jenismenu-add" data-toggle="modal" data-target="#newJenisMenu"><i class="fas fa-fw fa-plus"></i> Jenis Menu</a>
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
                                <input type="text" class="form-control search-jenismenu" placeholder="Cari jenis menu">
                            </div>
                        </div>

                        <div class="row jenismeja-table">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-jenismenu">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Jenis Menu</th>
                                                <th>Status</th>
                                                <th>Control</th>
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
            <div class="accordion" id="accordion-menu">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="heading-menu" data-toggle="collapse" data-target="#collapse-menu" aria-expanded="true" aria-controls="collapse-menu">
                        <h6 class="m-0 font-weight-bold text-primary">List Menu</h6>
                    </div>
                    <div class="card-body card-bods collapse" id="collapse-menu" aria-labelledby="heading-menu" data-parent="#accordion-menu">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="dropdown mb-3">
                                    <a href="#" role="button" class="btn btn-primary menu-add" data-toggle="modal" data-target="#newMenuMakanan"><i class="fas fa-fw fa-plus"></i> Menu</a>
                                    <a class="dropdown-toggle btn btn-primary ml-1" href="#" role="button" id="menu-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sort by All Category
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-down shadow animated--fade-in" aria-labelledby="menu-dropdown">
                                        <div class="dropdown-header">Category menu :</div>
                                        <a class="dropdown-item menu-status" href="#" data-status="0">All category</a>
                                        <?php foreach ($jenis as $j) : ?>
                                            <a class="dropdown-item menu-status" href="#" data-status="<?= $j['makananjenis_id']; ?>"><?= $j['makananjenis_nama']; ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                    <a href="#" role="button" title="Show as list" class="btn btn-primary ml-1 show-list hide"><i class="fas fa-fw fa-list"></i></a>
                                    <a href="#" role="button" title="Show as gallery" class="btn btn-primary ml-1 show-table"><i class="fas fa-fw fa-table"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control search-menu" placeholder="Cari menu">
                            </div>
                        </div>

                        <div class="row menu-card hide">
                            <!-- Append ajax -->
                        </div>

                        <div class="row menu-table">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-menu">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Menu</th>
                                                <th>Jenis</th>
                                                <th>HPP</th>
                                                <th>Harga</th>
                                                <th>Status</th>
                                                <th>Control</th>
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

<div class="modal fade" id="newJenisMenu" tabindex="-1" role="dialog" aria-labelledby="newJenisMenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Judul modal -->
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="newJenisMenuLabel">Jenis Menu baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- End Judul modal -->

            <form action="<?= base_url(); ?>manager/ajaxnewJenisMenu" class="form-users" id="form-makananjenis" method="POST">
                <input type="hidden" name="makananjenis_id" id="makananjenis_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="makananjenis_nama">Jenis Menu</label>
                        <input type="text" name="makananjenis_nama" id="makananjenis_nama" class="form-control" autocomplete="off" placeholder="Jenis meja">
                        <span class="error_nama"></span>
                    </div>
                    <div class="form-group">
                        <label for="makananjenis_status">Status Jenis Menu</label>
                        <select class="form-control" name="makananjenis_status" id="makananjenis_status">
                            <option value="0">Denied</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-makananjenis">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="newMenuMakanan" tabindex="-1" role="dialog" aria-labelledby="newMenuMakananLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="newMenuMakananLabel">Menu baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" id="form-menu" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="makanan_id" id="makanan_id">
                <input type="hidden" name="old_img" id="old_img">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jenismakanan_id">Jenis makanan *</label>
                        <select class="form-control" name="jenismakanan_id" id="jenismakanan_id" style="width:100%;" data-placeholder="Pilih jenis menu" data-theme="bootstrap4" data-dropdown-parent="#newMenuMakanan"></select>
                        <span class="error_jenis"></span>
                    </div>
                    <div class="form-group">
                        <label for="makanan_nama">Nama Menu *</label>
                        <input type="text" class="form-control" name="makanan_nama" id="makanan_nama" autocomplete="off">
                        <span class="error_nama"></span>
                    </div>
                    <div class="form-group">
                        <label for="makanan_hpp">HPP Menu *</label>
                        <input type="number" class="form-control" name="makanan_hpp" id="makanan_hpp" autocomplete="off">
                        <span class="error_hpp"></span>
                    </div>
                    <div class="form-group">
                        <label for="makanan_harga">Harga Menu *</label>
                        <input type="number" class="form-control" name="makanan_harga" id="makanan_harga" autocomplete="off">
                        <span class="error_harga"></span>
                    </div>
                    <div class="form-group">
                        <label for="makanan_desc">Deskripsi Menu</label>
                        <textarea class="form-control" name="makanan_desc" id="makanan_desc" cols="30" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="makanan_img">Image Menu</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="makanan_img" id="makanan_img">
                            <label class="custom-file-label makanan_img_label" for="makanan_img"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="makanan_status">Status Menu</label>
                        <select class="form-control" name="makanan_status" id="makanan_status">
                            <option value="0">Denied</option>
                            <option value="1">Active</option>
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

<script>
    $(function() {
        const base_url = '<?= base_url() ?>';
        let statsJenis = 2;
        let sercJenis = '';

        let statsMenu = 0;
        let sercMenu = '';

        function getJenis(url, status, search) {
            if (!url) {
                url = base_url + 'manager/getJenisMenu'
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
                    $('#table-jenismenu tbody').html(hasil.hasil);
                    $(".tarosaja").html(hasil.error);
                }
            });
        }

        function getMenu(url, status, search) {
            if (!url) {
                url = base_url + 'manager/getMenuMakanan'
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
                    $('#table-menu tbody').html(hasil.hasil);
                    $(".tarosini").html(hasil.error);
                    $(".menu-card").html(hasil.card);
                }
            });
        }

        $(document).on('click', "ul.pagination>li>a", function() {
            let href = $(this).attr('href');
            getJenis(href, statsJenis, sercJenis);

            return false;
        });

        getJenis('', statsJenis, sercJenis);
        getMenu('', statsMenu, sercMenu);

        $(document).on('submit', '#form-makananjenis', function(e) {
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
                        $('.error_nama').html(hasil.error.makananjenis_nama);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            width: 600,
                            padding: '2em',
                            title: hasil.error + ' jenis menu berhasil!',
                            html: "Selamat, jenis menu untuk tamu kamu berhasil di " + hasil.error + "."
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

        $(document).on('click', '.jenismenu-add', function(e) {
            $('#newJenisMenuLabel').html('Jenis Menu baru');
            $('#form-makananjenis').attr('action', base_url + 'manager/ajaxNewJenisMenu');

            $('#makananjenis_id').val('');
            $('#makananjenis_nama').val('');
            $('#makananjenis_status').val(0);
        });

        $(document).on('click', '.jenismenu-edit', function(e) {
            $('#form-makananjenis').attr('action', base_url + 'manager/ajaxUpdateJenisMenu');
            const id = $(this).data('id');

            $.ajax({
                url: base_url + 'manager/ajaxGetJenisMenuById',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id
                },
                success: function(hasil) {
                    $('#newJenisMenuLabel').html('Jenis Menu ' + hasil.makananjenis_nama);

                    $('#makananjenis_id').val(hasil.makananjenis_id);
                    $('#makananjenis_nama').val(hasil.makananjenis_nama);
                    $('#makananjenis_status').val(hasil.makananjenis_status);
                }
            })
        });

        $(document).on('click', '.jenis-status', function(e) {
            let text = $(this).text();
            statsJenis = $(this).data('status');

            $('#jenis-dropdown').html("Sort by " + text);

            getJenis('', statsJenis, sercJenis);

            e.preventDefault();
        });

        $(document).on('keyup', '.search-jenismenu', function(e) {
            sercJenis = $(this).val();
            getJenis('', statsJenis, sercJenis);

            e.preventDefault();
        });

        $('#jenismakanan_id').select2({
            ajax: {
                url: base_url + 'manager/ajaxGetJenisMenuActive',
                dataType: 'JSON',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term,
                        page: params.page,
                        limit: 20
                    }
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    }
                },
                cache: true
            },
            templateResult: function(result) {
                return result.text;
            },
            templateSelection: function(result) {
                return result.text;
            }
        });

        $(document).on('submit', '#form-menu', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let url = $(this).attr('action');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                mimeType: "multipart/form-data",
                data: formData,
                processData: false,
                contentType: false,
                success: function(hasil) {
                    if (hasil.result == false) {
                        $('.error_jenis').html(hasil.error.jenismakanan_id);
                        $('.error_nama').html(hasil.error.makanan_nama);
                        $('.error_hpp').html(hasil.error.makanan_hpp);
                        $('.error_harga').html(hasil.error.makanan_harga);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            width: 600,
                            padding: '2em',
                            title: hasil.error + ' menu berhasil!',
                            html: "Selamat, menu untuk tamu kamu berhasil di " + hasil.error + "."
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

        $(document).on('click', '.menu-add', function(e) {
            $('#newMenuMakananLabel').html('Menu baru');
            $('#form-menu').attr('action', base_url + 'manager/ajaxNewMenuMakanan');

            // $('#jenismakanan_id').val('');
            let option = new Option('', '', true, true);
            $('#jenismakanan_id').append(option).trigger('change');

            $('#makanan_id').val('');
            $('#makanan_nama').val('');
            $('#makanan_hpp').val('');
            $('#makanan_harga').val('');
            $('#makanan_desc').val('');
            $('#makanan_img').val('');
            $('#old_img').val('');
            $('#makanan_status').val(0);
            $('.makanan_img_label').text('Choose file in JPEG, JPG, or PNG format');

            $('.error_jenis').html('');
            $('.error_nama').html('');
            $('.error_hpp').html('');
            $('.error_harga').html('');
        });

        $(document).on('click', '.menu-edit', function(e) {
            $('#form-menu').attr('action', base_url + 'manager/ajaxUpdateMenuMakanan');
            const id = $(this).data('id');

            $.ajax({
                url: base_url + 'manager/ajaxGetMenuById',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id
                },
                success: function(hasil) {
                    console.log(hasil);
                    $('#newMenuMakananLabel').html('Menu ' + hasil.makanan_nama);

                    let option = new Option(hasil.makananjenis_nama, hasil.makananjenis_id, true, true);
                    $('#jenismakanan_id').append(option).trigger('change');

                    $('#makanan_id').val(hasil.makanan_id);
                    // $('#jenismakanan_id').val(hasil.makananjenis_id);
                    // $('#jenismakanan_id').trigger('change');
                    $('#makanan_nama').val(hasil.makanan_nama);
                    $('#makanan_hpp').val(hasil.makanan_hpp);
                    $('#makanan_harga').val(hasil.makanan_harga);
                    $('#makanan_desc').val(hasil.makanan_desc);
                    $('#makanan_status').val(hasil.makanan_status);
                    $('#old_img').val(hasil.makanan_img);
                    $('.makanan_img_label').text(hasil.makanan_img);
                }
            });
        });

        $(document).on('click', '.menu-status', function(e) {
            let text = $(this).text();
            statsMenu = $(this).data('status');

            $('#menu-dropdown').html("Sort by " + text);

            getMenu('', statsMenu, sercMenu);

            e.preventDefault();
        });

        $(document).on('keyup', '.search-menu', function(e) {
            sercMenu = $(this).val();
            getMenu('', statsMenu, sercMenu);

            e.preventDefault();
        });

        $('.show-list').on('click', function(e) {
            e.preventDefault();

            $('.show-list').toggleClass('hide', true);
            $('.show-table').toggleClass('hide', false);

            $('.menu-card').toggleClass('hide', true);
            $('.menu-table').toggleClass('hide', false);
        });

        $('.show-table').on('click', function(e) {
            e.preventDefault();

            $('.show-list').toggleClass('hide', false);
            $('.show-table').toggleClass('hide', true);

            $('.menu-card').toggleClass('hide', false);
            $('.menu-table').toggleClass('hide', true);
        });
    });
</script>