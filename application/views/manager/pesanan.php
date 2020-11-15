<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anonymous+Pro&display=swap">
<style>
    .hide {
        display: none;
    }

    .logo {
        font-family: 'Helvetica Neue', Helvetica, sans-serif;
        font-weight: 600;
        font-size: 36px;
        text-align: center;
        padding-top: 15px;
    }

    .period {
        font-family: 'Helvetica Neue', Helvetica, sans-serif;
        font-size: 16px;
        text-align: center;
        padding-bottom: 15px;
    }

    .date {
        margin: 0vh;
    }

    .ordered {
        margin: 5px 0vh;
    }

    .scri {
        width: 400px;
        margin: 0 auto;
    }

    .receiptContainer {
        background-image: url('<?= base_url(); ?>assets/img/illustrat/wrinkled-paper-texture.jpg');
        background-position: center;
        width: 400px;
        filter: brightness(105%);
        padding: 20px;
    }

    .begin {
        padding-left: 0vh;
    }

    p,
    .ordered,
    .date {
        font-family: 'Anonymous Pro', 'Courier New', Courier, monospace;
    }

    .ordered {
        border: none;
        font-size: 16px;
    }

    .total-counts {
        border-top: 1px dashed;
    }

    .total-counts-end {
        border-bottom: 1px dashed;
    }

    .ordered thead {
        border-top: 1px dashed;
        border-bottom: 1px dashed;
    }

    .ordered td {
        padding: 2px 10px;
        vertical-align: top;
    }

    .name-item {
        width: 225px;
        overflow: auto;
    }

    .length {
        text-align: right;
        padding-left: 10px;
        padding-right: 0px;
    }

    .website {
        margin-bottom: 0px;
    }

    .thanks {
        text-align: center;
        padding: 15px 0px;
    }

    .thanks img {
        width: 70%;
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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="heading-pesanan">
                    <h6 class="m-0 font-weight-bold text-primary">List Pesanan</h6>
                </div>
                <div class="card-body card-bods" id="list-pesanan">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="dropdown mb-3">
                                <a href="#" role="button" class="btn btn-primary pesanan-add" data-toggle="modal" data-target="#newPesananModal"><i class="fas fa-fw fa-plus"></i> Pesanan</a>
                                <a class="dropdown-toggle btn btn-primary ml-1" href="#" role="button" id="pesanan-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All Status
                                </a>
                                <div class="dropdown-menu dropdown-pesanan-left shadow animated--fade-in" aria-labelledby="pesanan-dropdown">
                                    <div class="dropdown-header">Status pesanan :</div>
                                    <a class="dropdown-item pesanan-status" href="#" data-status="99">All status</a>
                                    <a class="dropdown-item pesanan-status" href="#" data-status="0">Pending</a>
                                    <a class="dropdown-item pesanan-status" href="#" data-status="1">Ready</a>
                                    <a class="dropdown-item pesanan-status" href="#" data-status="2">Served</a>
                                    <a class="dropdown-item pesanan-status" href="#" data-status="3">Paid</a>
                                    <a class="dropdown-item pesanan-status" href="#" data-status="4">Finish</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control search-pesanan" placeholder="Cari pesanan">
                        </div>
                    </div>

                    <div class="row pesanan-table">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover" id="table-pesanan">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Pesanan</th>
                                            <th>Total</th>
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

<div class="modal fade" id="newPesananModal" tabindex="-1" role="dialog" aria-labelledby="newPesananModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="newPesananModalLabel">Pesanan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url(); ?>manager/ajaxNewPesanan" class="form-users" id="form-pesananbaru" method="POST">
                <input type="hidden" name="pesanan_id" id="pesanan_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="jumlah_tamu">Jumlah tamu</label>
                            <input type="number" class="form-control" id="jumlah_tamu" name="jumlah_tamu" placeholder="Jumlah tamu">
                        </div>
                        <div class="form-group col-lg-8">
                            <label for="meja_id">Meja</label>
                            <select class="form-control" disabled name="meja_id" id="meja_id" style="width:100%;" data-placeholder="Pilih meja" data-theme="bootstrap4" data-dropdown-parent="#newPesananModal">
                            </select>
                            <span class="error_meja"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="pesanan_email">Email</label>
                            <input type="text" class="form-control" name="pesanan_email" id="pesanan_email" autocomplete="off" placeholder="Email">
                        </div>
                        <div class="form-group col-lg-8">
                            <label for="makanan_id">Menu</label>
                            <select class="form-control" name="makanan_id" id="makanan_id" style="width:100%;" data-placeholder="Pilih menu" data-theme="bootstrap4" data-dropdown-parent="#newPesananModal"></select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-hover" id="table-makanan">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Menu</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Append when in comes to do -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-center"><strong>Total</strong></td>
                                        <td>
                                            <input type="number" name="grandtotal" class="form-control" id="grandtotal" readonly value="0">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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

<div class="modal fade" id="pesananDetail" tabindex="-1" role="dialog" aria-labelledby="pesananDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="pesananDetailLabel">Pesanan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" class="form-users" id="form-pesanan-detail" method="POST">
                <input type="hidden" name="pesanan_id_detail" id="pesanan_id_detail">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="jumlah_tamu_detail">Jumlah tamu *</label>
                            <input type="number" class="form-control" id="jumlah_tamu_detail" name="jumlah_tamu_detail" placeholder="Jumlah tamu" readonly>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="nomer_meja_detail">Nomer meja *</label>
                            <input type="text" class="form-control" id="nomer_meja_detail" name="nomer_meja_detail" placeholder="Nomer meja" readonly>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="status_pesanan_detail">Status pesanan *</label>
                            <select class="form-control" name="status_pesanan_detail" id="status_pesanan_detail">
                                <option value="0">Pending</option>
                                <option value="1">Ready</option>
                                <option value="2">Served</option>
                                <option value="3">Paid</option>
                                <option value="4">Finish</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-hover" id="table-makanan-detail">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Menu</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Append when in comes to do -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-center"><strong>Total</strong></td>
                                        <td>
                                            <input type="number" name="grandtotal_detail" class="form-control text-right" id="grandtotal_detail" readonly value="0">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="newBillModal" tabindex="-1" role="dialog" aria-labelledby="newBillModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="newBillModalLabel">Cetak Bill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" class="form-users" id="form-payment" method="POST">
                <input type="hidden" name="pesanan_id_bill" id="pesanan_id_bill">
                <input type="hidden" id="pesanan_payment" name="pesanan_payment">
                <input type="hidden" id="payment_tax" name="payment_tax">
                <input type="hidden" id="grandtotal_payment" name="grandtotal_payment">
                <div class="modal-body">
                    <div class="scri">
                        <div class="receiptContainer" id="receiptif">
                            <h2 class="logo">BILL FOLD</h2>
                            <p class="period"></p>
                            <p class="date date-order"></p>
                            <p class="date date-date"></p>
                            <table class="ordered">
                                <thead>
                                    <td class="begin">QTY</td>
                                    <td>ITEM</td>
                                    <td class="length">AMT</td>
                                </thead>
                                <tbody>
                                    <!-- Generated by Ajax -->
                                </tbody>
                                <tfoot>
                                    <tr class="total-counts">
                                        <td class="begin" colspan="2">TOTAL PESANAN:</td>
                                        <td class="length pesanan-tot"></td>
                                    </tr>
                                    <tr class="total-counts-tax">
                                        <td class="begin" colspan="2">TOTAL TAX:</td>
                                        <td class="length tax-tot"></td>
                                    </tr>
                                    <tr class="total-counts-end">
                                        <td class="begin" colspan="2">TOTAL:</td>
                                        <td class="length gran-tot"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <p class="date">OPERATIONAL HOUR : 11:00 - 23:00</p>
                            <p class="date">OPERATIONAL DAYS : MON - SUN</p>
                            <p class="date">MORE ABOUT US : <i class="fab fa-fw fa-instagram"></i>@RGDMPRMD</p>
                            <div class="thanks">
                                <p>THANK YOU FOR VISITING!</p>
                                <img src="<?= base_url('assets/img/illustrat/barcode.png'); ?>">
                                <p class="website">
                                    www.discode.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary download-img">Download</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/dom-to-image.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/FileSaver.min.js'); ?>"></script>
<script>
    $(function() {
        const base_url = '<?= base_url() ?>';
        let statsPesanan = 99;
        let sercPesanan = '';

        let jumlah_tamu = 0;
        let indexItem = 0;

        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        function getPesanan(url, status, search) {
            if (!url) {
                url = base_url + 'manager/getPesanan'
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
                    $('#table-pesanan tbody').html(hasil.hasil);
                    $(".tarosaja").html(hasil.error);
                }
            });
        }

        function getDetail(id) {
            $.ajax({
                url: base_url + 'manager/ajaxGetPesananById',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id
                },
                success: function(hasil) {
                    let header = hasil.header;
                    let detail = hasil.detail;

                    $('#pesananDetailLabel').html('Pesanan meja ' + header.meja_nomer);

                    $('#pesanan_id_detail').val(header.pesanan_id);
                    $('#jumlah_tamu_detail').val(header.jumlah_tamu);
                    $('#nomer_meja_detail').val(header.meja_nomer);
                    $('#status_pesanan_detail').val(header.pesanan_status);

                    let rows = '';

                    detail.forEach(function(item, indexItem) {

                        rows += '<tr>';
                        if (item.detpesanan_status == 0) {
                            rows += '<td><button class="btn btn-danger btn-sm stats-pending" title="Pending" data-hedid="' + item.pesanan_id + '" data-id="' + item.detpesanan_id + '"><i class="fas fa-fw fa-stopwatch"></i></button></td>';
                        } else {
                            rows += '<td><button class="btn btn-success btn-sm stats-ready" title="Ready"><i class="fas fa-fw fa-check"></i></button></td>';
                        }
                        rows += '<td><input type="hidden" name="item[' + indexItem + '][makanan_id]" value="' + item.makanan_id + '">';
                        rows += '<input type="hidden" name="item[' + indexItem + '][makanan_nama]" value="' + item.makanan_nama + '">';
                        rows += '<input type="hidden" class="item-price-ke-' + indexItem + '" name="item[' + indexItem + '][makanan_harga]" value="' + item.makanan_harga + '">';
                        rows += item.makanan_nama;
                        rows += '</td>';
                        rows += '<td><input data-index="' + (indexItem) + '" readonly type="number" class="form-control text-right item-qty item-qty-ke-' + (indexItem) + '" name="item[' + indexItem + '][qty]" value="' + item.qty_pesanan + '"></td>';
                        rows += '<td><input data-index="' + (indexItem) + '" readonly type="number" class="form-control text-right item-total item-total-ke-' + (indexItem) + '" name="item[' + indexItem + '][makanan_total]" value="' + item.qty_pesanan * item.makanan_harga + '"></td>';
                        rows += '</tr>';

                    });

                    $("#table-makanan-detail tbody").html(rows);
                    calculateGrandTotal();
                }
            });
        }

        getPesanan('', statsPesanan, sercPesanan);

        function calculateGrandTotal() {
            let grandtotal = 0;
            $(".item-total").each(function() {
                grandtotal += parseInt($(this).val());
            });

            $('#grandtotal').val(grandtotal);
            $('#grandtotal_detail').val(grandtotal);
        }

        function calculateTax() {
            let tax = 0;
            let grandtotal = 0;

            $(".total-item").each(function() {
                tax += parseInt($(this).val()) * 0.10;
                grandtotal += parseInt($(this).val());
            });

            $('#pesanan_payment').val(grandtotal);
            $('#payment_tax').val(tax);
            $('#grandtotal_payment').val((grandtotal + tax));

            $('.pesanan-tot').text(addCommas(grandtotal));
            $('.tax-tot').text(addCommas(tax));
            $('.gran-tot').text(addCommas((grandtotal + tax)));
        }

        $(document).on('click', '.pesanan-add', function() {
            $('#newPesananModalLabel').text('Pesanan Baru');
            $('#jumlah_tamu').attr('disabled', false);
            $('#form-pesananbaru').attr('action', base_url + 'manager/ajaxNewPesanan');

            $('#grandtotal').val(0);
            $("#table-makanan tbody").html('');
            $('.error_meja').html('');
            $('#jumlah_tamu').val('');

            let option = new Option('', '', true, true);
            $('#meja_id').append(option).trigger('change');

            $('#meja_id').attr('disabled', true);
        });

        $(document).on('change', '#jumlah_tamu', function() {
            jumlah_tamu = $(this).val();

            if (jumlah_tamu != 0) {
                $('#meja_id').attr('disabled', false)
            } else {
                $('#meja_id').attr('disabled', true)
            }
        });

        $('#meja_id').select2({
            ajax: {
                url: base_url + 'manager/ajaxGetMeja',
                dataType: 'JSON',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term,
                        page: params.page,
                        jumlah_tamu: jumlah_tamu,
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

        $('#makanan_id').select2({
            ajax: {
                url: base_url + 'manager/ajaxGetMenu',
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
                }
            },
            templateResult: function(result) {
                return result.text;
            },
            templateSelection: function(result) {
                return result.text;
            }
        }).on('select2:select', function(result) {
            let hasil = result.params.data;
            let rows = '';
            rows += '<tr>';
            rows += '<td><button class="btn btn-danger btn-sm remove-item" title="Hapus item"><i class="fa fa-fw fa-trash"></i></button></td>';
            rows += '<td><input type="hidden" name="item[' + indexItem + '][makanan_id]" value="' + hasil.id + '">';
            rows += '<input type="hidden" name="item[' + indexItem + '][makanan_nama]" value="' + hasil.text + '">';
            rows += '<input type="hidden" class="item-price-ke-' + indexItem + '" name="item[' + indexItem + '][makanan_harga]" value="' + hasil.harga + '">';
            rows += hasil.text;
            rows += '</td>';
            rows += '<td><input data-index="' + (indexItem) + '" type="number" class="form-control item-qty item-qty-ke-' + (indexItem) + '" name="item[' + indexItem + '][qty]" value="1"></td>';
            rows += '<td><input data-index="' + (indexItem) + '" readonly type="number" class="form-control item-total item-total-ke-' + (indexItem) + '" name="item[' + indexItem + '][makanan_total]" value="' + hasil.harga + '"></td>';
            rows += '</tr>';

            indexItem++;

            $("#table-makanan tbody").append(rows);
            calculateGrandTotal();

            let option = new Option('', '', true, true);
            $('#makanan_id').append(option).trigger('change');
        });

        $(document).on('keyup', '.item-qty', function() {
            let _this = $(this);
            let index = _this.data('index');
            let qty_val = parseInt(_this.val());
            if (qty_val < 0) {
                qty_val *= -1;
            } else {
                qty_val;
            }
            _this.val(qty_val);
            let price_val = parseInt($('.item-price-ke-' + index).val());
            let total_val = qty_val * price_val;
            $('.item-total-ke-' + index).val(total_val);

            calculateGrandTotal();
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('tr').remove();
            calculateGrandTotal();
        });

        $(document).on('submit', '#form-pesananbaru', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let url = $(this).attr('action');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false,
                success: function(hasil) {
                    if (hasil.result == false) {
                        $('.error_meja').html(hasil.error.meja_id);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            width: 600,
                            padding: '2em',
                            title: hasil.error + ' pesanan berhasil!',
                            html: "Selamat, pesanan untuk tamu kamu berhasil di " + hasil.error + "."
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

        $(document).on('submit', '#form-payment', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let url = $(this).attr('action');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false,
                success: function(hasil) {
                    if (hasil.result == false) {
                        $('.error_email').html(hasil.error.payment_email);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            width: 600,
                            padding: '2em',
                            title: 'Cetak bill berhasil!',
                            html: "Selamat, bill untuk tamu kamu berhasil di cetak."
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

        $(document).on('click', '.pesanan-edit', function(e) {
            const id = $(this).data('id');
            $('#jumlah_tamu').attr('disabled', true);
            $('#form-pesananbaru').attr('action', base_url + 'manager/updateMenuDetail');

            $.ajax({
                url: base_url + 'manager/ajaxGetPesananById',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id
                },
                success: function(hasil) {
                    let header = hasil.header;
                    let detail = hasil.detail;

                    $('#newPesananModalLabel').text('Update Pesanan Meja ' + header.meja_nomer);

                    $('#pesanan_id').val(header.pesanan_id);
                    $('#jumlah_tamu').val(header.jumlah_tamu);

                    let option = new Option(header.meja_nomer, header.meja_id, true, true);
                    $('#meja_id').append(option).trigger('change');
                }
            });
        });

        $(document).on('click', '.pesanan-detail', function(e) {
            const id = $(this).data('id');

            getDetail(id);
        });

        $(document).on('click', '.pesanan-payment', function(e) {
            const id = $(this).data('id');
            $('#form-payment').attr('action', base_url + 'manager/setBill');

            $.ajax({
                url: base_url + 'manager/ajaxGetPesananById',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id
                },
                success: function(hasil) {
                    let d = new Date();
                    let monyer = d.getFullYear() + ('0' + (d.getMonth() + 1)).slice(-2);
                    let tgls = ('0' + (d.getDate())).slice(-2);
                    let montName = d.toLocaleString('default', {
                        month: 'long'
                    });
                    let dayName = d.toLocaleString('default', {
                        weekday: 'long'
                    });
                    let year = d.toLocaleString('default', {
                        year: 'numeric'
                    });
                    let hr = d.getHours();
                    let mt = d.getMinutes();
                    let sc = d.getSeconds();

                    let header = hasil.header;
                    let detail = hasil.detail;

                    $('.period').text('MEJA-' + header.meja_nomer);
                    // $('.date-order').text('ORDER #' + monyer + ('000' + header.pesanan_id).slice(-4) + ' FOR ' + header.pesanan_email);
                    $('.date-order').text('ORDER #' + ('000' + header.pesanan_id).slice(-4) + ' FOR ' + header.pesanan_email.toUpperCase());
                    $('.date-date').text(dayName.toUpperCase() + ', ' + montName.toUpperCase() + ' ' + tgls + ', ' + year + ' ' + hr + ':' + mt + ':' + sc);

                    $('#newBillModalLabel').text('Cetak Bill Pesanan #' + header.meja_nomer);
                    // $('#pesanan_id_bill').val(header.pesanan_id);
                    // $('#payment_email').val(header.pesanan_email);

                    let rows = '';

                    detail.forEach(function(item, indexItem) {

                        rows += '<tr>';
                        rows += '<td class="begin">' + ('0' + addCommas(item.qty_pesanan)).slice(-2) + '<input data-index="' + (indexItem) + '" type="hidden" class="form-control qty-item item-qty-ke-' + (indexItem) + '" name="item[' + indexItem + '][qty]" value="' + item.qty_pesanan + '"></td>';
                        rows += '<td class="name-item"><input type="hidden" name="item[' + indexItem + '][makanan_id]" value="' + item.makanan_id + '">';
                        rows += '<input type="hidden" name="item[' + indexItem + '][makanan_nama]" value="' + item.makanan_nama + '">';
                        rows += '<input type="hidden" class="item-price-ke-' + indexItem + '" name="item[' + indexItem + '][makanan_harga]" value="' + item.makanan_harga + '">';
                        rows += item.makanan_nama.toUpperCase();
                        rows += '</td>';
                        rows += '<td class="length">' + addCommas(item.qty_pesanan * item.makanan_harga) + '<input data-index="' + (indexItem) + '" type="hidden" class="form-control total-item item-total-ke-' + (indexItem) + '" name="item[' + indexItem + '][makanan_total]" value="' + item.qty_pesanan * item.makanan_harga + '"></td>';
                        rows += '</tr>';

                    });

                    $(".ordered tbody").html(rows);
                    calculateTax();
                }
            });
        });

        $(document).on('click', '.download-img', function(e) {
            domtoimage.toBlob(document.getElementById('receiptif')).then(function(blob) {
                window.saveAs(blob, 'my-bill.png');
            })
        });

        $(document).on('click', '.stats-pending', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const hedid = $(this).data('hedid');

            $.ajax({
                url: base_url + 'manager/ajaxDetailPesananReady',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id,
                    headid: hedid
                },
                success: function(hasil) {
                    if (hasil == true) {
                        getDetail(hedid);
                        $('#pesananDetail').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.stats-ready', function(e) {
            e.preventDefault();
        });

        $(document).on('change', '#status_pesanan_detail', function(e) {
            let id = $('#pesanan_id_detail').val();
            let status = $(this).val();

            $.ajax({
                url: base_url + 'manager/ajaxUpdateStatusHeaderPesanan',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id,
                    status: status
                },
                success: function(hasil) {
                    if (hasil == true) {
                        Swal.fire({
                            icon: 'success',
                            width: 600,
                            padding: '2em',
                            title: 'Update pesanan berhasil!',
                            html: "Selamat, status pesanan untuk tamu kamu berhasil di update."
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            });
        });

        $(document).on('click', '.pesanan-status', function(e) {
            let text = $(this).text();
            statsPesanan = $(this).data('status');

            $('#pesanan-dropdown').html(text);

            getPesanan('', statsPesanan, sercPesanan);

            e.preventDefault();
        });

        $(document).on('keyup', '.search-pesanan', function(e) {
            sercPesanan = $(this).val();
            getPesanan('', statsPesanan, sercPesanan);

            e.preventDefault();
        });

        $(document).on('change', '#payment_method', function(e) {
            let val = $(this).val();

            $('#payment_telp').val('');
            $('#payment_card').val('');

            if (val == 'Debit BCA' || val == 'Credit BCA') {
                $('.payment_card').toggleClass('hide', false);
                $('.payment_telp').toggleClass('hide', true);
            } else {
                $('.payment_card').toggleClass('hide', true);
                $('.payment_telp').toggleClass('hide', false);
            }
        });
    });
</script>