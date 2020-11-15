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
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Menu</h6>
                </div>
                <div class="card-body card-bods">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="dropdown mb-3">
                                <a class="dropdown-toggle btn btn-primary ml-1" href="#" role="button" id="menu-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All Category
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
        let statsMenu = 0;
        let sercMenu = '';

        function getMenu(url, status, search) {
            if (!url) {
                url = base_url + 'waiters/getMenu'
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
            getMenu(href, statsMenu, sercMenu);

            return false;
        });

        getMenu('', statsMenu, sercMenu);

        $(document).on('click', '.menu-status', function(e) {
            let text = $(this).text();
            statsMenu = $(this).data('status');

            $('#menu-dropdown').html(text);

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