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
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List meja</h6>
                </div>
                <div class="card-body" id="meja">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="dropdown mb-3">
                                <!-- <a href="#" role="button" class="btn btn-primary meja-add" data-toggle="modal" data-target="#newMeja"><i class="fas fa-fw fa-plus"></i> Meja</a> -->
                                <a class="dropdown-toggle btn btn-primary ml-1" href="#" role="button" id="menu-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All status
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
                                            <!-- <th>Control</th> -->
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

<script>
    $(function() {
        const base_url = '<?= base_url() ?>';
        let statsMeja = 2;
        let sercMeja = '';

        function getMeja(url, status, search) {
            if (!url) {
                url = base_url + 'waiters/getMeja'
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

        getMeja('', statsMeja, sercMeja);

        $(document).on('click', "ul.pagination>li>a", function() {
            let href = $(this).attr('href');
            getMeja(href, statsMeja, sercMeja);
            // getJenis(href, statsJenis, sercJenis);

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

        $(document).on('click', '.menu-status', function(e) {
            let text = $(this).text();
            statsMeja = $(this).data('status');

            $('#menu-dropdown').html(text);

            getMeja('', statsMeja, sercMeja);

            e.preventDefault();
        });

        $(document).on('keyup', '.search-meja', function(e) {
            sercMeja = $(this).val();
            getMeja('', statsMeja, sercMeja);

            e.preventDefault();
        });
    });
</script>