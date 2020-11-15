<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="failadd" data-failadd="<?= $this->session->flashdata('failadd'); ?>"></div>
    <div class="succadd" data-succadd="<?= $this->session->flashdata('succadd'); ?>"></div>
    <div class="failupdate" data-failupdate="<?= $this->session->flashdata('failupdate'); ?>"></div>
    <div class="succupdate" data-succupdate="<?= $this->session->flashdata('succupdate'); ?>"></div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="heading-payment">
                    <h6 class="m-0 font-weight-bold text-primary">List payment</h6>
                </div>
                <div class="card-body card-bods" id="list-payment">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="dropdown mb-3">
                                <!-- <a href="#" role="button" class="btn btn-primary payment-add" data-toggle="modal" data-target="#newpaymentModal"><i class="fas fa-fw fa-plus"></i> payment</a> -->
                                <a class="dropdown-toggle btn btn-primary ml-1" href="#" role="button" id="payment-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All Status
                                </a>
                                <div class="dropdown-menu dropdown-payment-left shadow animated--fade-in" aria-labelledby="payment-dropdown">
                                    <div class="dropdown-header">Status payment :</div>
                                    <a class="dropdown-item payment-status" href="#" data-status="99">All status</a>
                                    <a class="dropdown-item payment-status" href="#" data-status="0">Pending</a>
                                    <a class="dropdown-item payment-status" href="#" data-status="1">Ready</a>
                                    <a class="dropdown-item payment-status" href="#" data-status="2">Served</a>
                                    <a class="dropdown-item payment-status" href="#" data-status="3">Paid</a>
                                    <a class="dropdown-item payment-status" href="#" data-status="4">Finish</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control search-payment" placeholder="Cari payment">
                        </div>
                    </div>

                    <div class="row payment-table">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover" id="table-payment">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Pesanan</th>
                                            <th>Time</th>
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

<script>
    $(function() {
        const base_url = '<?= base_url() ?>';
    });
</script>