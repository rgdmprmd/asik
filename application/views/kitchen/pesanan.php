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
                            <button type="button" class="btn btn-outline-primary timer"></button>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control search-pesanan mb-3" placeholder="Cari pesanan">
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
                                            <th>Jam</th>
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
                            <select class="form-control" name="status_pesanan_detail" id="status_pesanan_detail" disabled>
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

<script>
    $(function() {
        const base_url = '<?= base_url() ?>';
        let statsPesanan = 99;
        let sercPesanan = '';

        let jumlah_tamu = 0;
        let indexItem = 0;

        function getPesanan(url, search) {
            if (!url) {
                url = base_url + 'kitchen/ajaxGetPesanan'
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: {
                    search: search
                },
                success: function(hasil) {
                    $('#table-pesanan tbody').html(hasil.hasil);
                    $(".tarosaja").html(hasil.error);
                }
            });
        }

        function getdate() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            if (h < 10) {
                h = "0" + h;
            }
            if (m < 10) {
                m = "0" + m;
            }
            if (s < 10) {
                s = "0" + s;
            }

            $(".timer").text(h + " : " + m + " : " + s);
            setTimeout(function() {
                getdate()
            }, 500);
        }

        function getDetail(id) {
            $.ajax({
                url: base_url + 'kitchen/ajaxGetPesananById',
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

        function interveal() {

            getPesanan('', sercPesanan);
            setInterval(function() {
                getPesanan('', sercPesanan);
            }, 10000);
        }

        interveal();

        getdate();
        // getPesanan('', sercPesanan);

        function calculateGrandTotal() {
            let grandtotal = 0;
            $(".item-total").each(function() {
                grandtotal += parseInt($(this).val());
            });

            $('#grandtotal').val(grandtotal);
            $('#grandtotal_detail').val(grandtotal);
        }

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

        $(document).on('click', '.pesanan-detail', function(e) {
            const id = $(this).data('id');

            getDetail(id);
        });

        $(document).on('click', '.stats-pending', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const hedid = $(this).data('hedid');

            $.ajax({
                url: base_url + 'kitchen/ajaxDetailPesananReady',
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

            getPesanan('', sercPesanan);

            e.preventDefault();
        });

        $(document).on('keyup', '.search-pesanan', function(e) {
            sercPesanan = $(this).val();
            getPesanan('', sercPesanan);

            e.preventDefault();
        });
    });
</script>