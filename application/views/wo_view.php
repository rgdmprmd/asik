<style media="screen">
    #myTabs li.active {
        border-bottom: 2px solid #999;
    }

    .tab-head {
        font-size: 16px;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:hover,
    .nav-tabs>li.active>a:focus {
        background-color: #eee !important;
    }

    .nav-tabs>li>a {
        padding: 3px 10px;
    }

    .item-qty {
        text-align: center;
        max-width: 100px
    }

    .item-price {
        text-align: right;
        max-width: 150px
    }

    .item-total,
    #grandtotal,
    #grandtotal-detail {
        text-align: right;
        max-width: 150px
    }

    .modal-body {
        padding-bottom: 0px;
    }

    .form-group {
        margin-bottom: 10px !important
    }
    }

    @media screen and (max-width: 800px) {
        .btn {
            margin-top: 15px;
        }
    }

    @media screen and (max-width: 360px) {
        .input-daterange {
            padding-top: 5px;
            padding-bottom: 5px;
            width: 12%;
        }
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class=" panel panel-default">
            <div class="panel-body col-lg-12" style="padding-top:0px">
                <ul class="nav nav-tabs" id="myTabs">
                    <li role="presentation" class="active">
                        <a href="#data_wo">
                            <h4 class="tab-head"><strong>DATA WO</strong></h4>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#input_wo">
                            <h4 class="tab-head"><strong>INPUT WO</strong></h4>
                        </a>
                    </li>
                </ul>

                <div class="tab-content" style="padding:10px;background-color:#eee;">
                    <div role="tabpanel" class="tab-pane" id="input_wo">
                        <form class="form-horizontal" id="wo-form">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Set Serial Number</label>
                                        <div class="col-sm-8">
                                            <a href="<?= site_url() ?>sparepart/serial_number" target="_blank" class="btn btn-success" title="If serial number not found, then create the serial number here" style="width:100%;">Add New Serial Number?</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">*Serial Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="serial_number" id="serial_number-list" style="width:100%" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">*Nama Member</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="no_int_dealer" id="dealer-list" style="width:100%;">
                                            <input type="hidden" name="nama_customer" id="customer-name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">*Nama Konsumen</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="konsumen" id="konsumen" class="form-control" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">No Kartu Garansi</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="no_garansi" id="no_garansi" class="form-control" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">*Tgl Pembelian</label>
                                        <div class="col-sm-8" id="datepicker">
                                            <input type="text" class="input-sm form-control" name="date_buying" id="date-buying">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Status Garansi</label>
                                        <div class="col-sm-8">
                                            <select name="garansi" class="form-control">
                                                <option value="Garansi">Garansi</option>
                                                <option value="Tidak Garansi">Tidak Garansi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <textarea type="text" id="address" name="address" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">*No Telp</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="telp" name="telp" class="form-control" placeholder="...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">*Area</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="area_id" id="area-list" style="width:100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">*Nama Barang</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="no_int_product" id="product-list" style="width:100%;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Size</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="size" class="form-control" placeholder="...">
                                        </div>
                                        <label class="col-sm-2 control-label">Colour</label>
                                        <div class="col-sm-3">
                                            <input type="text" align="justify" name="colour" class="form-control" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Type</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="type" class="form-control" placeholder="...">
                                        </div>
                                        <label class="col-sm-2 control-label">*Callback</label>
                                        <div class="col-sm-3">
                                            <select class="form-control" name="is_callback">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">*Kelengkapan</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="kelengkapan" class="form-control" placeholder="...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Jenis Kerusakan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control jenis-kerusakan" name="broken_status">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Kerusakan Detail</label>
                                        <div class="col-sm-8 append-kerusakan-detail">
                                            <!--appended via ajax-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">*Keterangan</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="keterangan" class="form-control" placeholder="...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-offset-4">
                                        <button type="button" id="saveWo" class="btn btn-primary"><i class="fas fa-save"></i><small> SIMPAN</small></button>&nbsp;
                                        <button type="button" id="cancelWo" class="btn btn-danger">CANCEL</button>
                                        &nbsp;&nbsp;* wajib diisi
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane active" id="data_wo" style="background-color:#fff;overflow: auto;">
                        <div class="table-responsive" style="overflow:auto;height:450px">
                            <table class="table table-bordered table-stripped" id="data-wo">
                                <thead>
                                    <tr>
                                        <th colspan="21" style="padding-top: 0px;padding-bottom: 0px;text-align:left;font-weight:normal">
                                            <div class="form" style="width:100%">
                                                <form class="form-inline" id="filter-form">
                                                    <button class="btn btn-default" id="refreshWo" title="Refresh"><i class="fa fa-sync"></i></button>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="search" name="search" placeholder="Search by No WO, Customer, Telp.." style="font-weight:normal;width:250px;margin-top: 10px;">
                                                    </div>

                                                    <button class="btn btn-primary" id="doSearch">GO</button>&nbsp;
                                                    <button class="btn btn-danger" id="clearSearch" title="Clear Filter"><i class="fa fa-times"></i></button>

                                                    <div class="form-group">
                                                        <div class="input-daterange input-group" id="datepicker" style="margin-bottom: -10px;">
                                                            <span class="input-group-addon"><strong>Periode</strong></span>
                                                            <input type="text" class="input-sm form-control" name="tgl1" id="date-from" autocomplete="off">
                                                            <span class="input-group-addon"><strong>To</strong></span>
                                                            <input type="text" class="input-sm form-control" disabled name="tgl2" id="date-to" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-default btn-export" id="export" disabled title="export file to excel"><i class="fas fa-file-export"></i><small> Export</small></button>

                                                </form>
                                                <br>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Action</th>
                                        <th>No WO</th>
                                        <th>Tgl WO</th>
                                        <th>Member</th>
                                        <th>Konsumen</th>
                                        <th>No Telp</th>
                                        <th>Produk</th>
                                        <th>Garansi</th>
                                        <th>Kerusakan</th>
                                        <th>Area</th>
                                        <th>Status</th>
                                        <th>Progress</th>
                                        <th>Part Pending</th>
                                        <th>Progress Desc</th>
                                        <th>Teknisi</th>
                                        <th>Tgl Assign</th>
                                        <th>Tgl Finish</th>
                                        <th>Taken</th>
                                        <th>Tgl Taken</th>
                                        <th>Callback</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="20">
                                            <div class="pull-left">
                                                <ul class="pagination" style="margin:0"></ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dialog -->
<div class="modal fade" id="modalDialog" tabindex="-1" role="dialog" aria-labelledby="modalDialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Item</h4>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped wo-item-table">
                            <tbody></tbody>
                        </table>
                    </div>
                    <h4>Item</h4>
                    <div class="col-lg-4" style="padding-left:0;margin-bottom:10px;">
                        <h5 style="display:inline-block; font-weight:600;">Gudang</h5> <input style="display:inline-block;width:100%;" type="hidden" name="warehouse_id" id="warehouse-list">
                    </div>
                    <div class="col-lg-4" style="padding-left:0;margin-bottom:10px;">
                        <h5 style="display:inline-block; font-weight:600;">Biaya Jasa</h5>
                        <select class="form-control biaya_jasa" style="display:inline-block;width:100%;">
                            <option value="" selected style="color:#999">Biaya Jasa</option>
                        </select>
                    </div>
                    <div class="col-lg-4" style="padding-left:0;margin-bottom:10px;">
                        <h5 style="display:inline-block; font-weight:600;">Sparepart</h5> <input style="display:inline-block;width:100%;" type="hidden" id="sparepart-list" disabled>
                    </div>
                    <div class="responsive-table">
                        <table class="table table-bordered table-stripped wo-item-table-item">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Sparepart</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th style="width:160px">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" align="right"><strong>Total</strong></td>
                                    <td colspan="1">
                                        <input type="number" name="grandtotal" class="form-control" id="grandtotal" readonly="">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <input type="hidden" name="no_int_wo" class="input-no_int_wo">
                    <input type="hidden" name="area_id" class="input-area_id">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <button type="button" class="btn btn-primary btn-save"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Dialog Detail-->
<div class="modal fade" id="modalDialogDetail" tabindex="-1" role="dialog" aria-labelledby="modalDialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title-detail">Detail WO</h4>
            </div>
            <div class="modal-body">
                <form id="detailForm">
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped wo-detail-table">
                            <tbody></tbody>
                        </table>
                    </div>
                    <h4>Item</h4>
                    <div class="col-lg-12" style="padding-left:0;margin-bottom:10px;">
                        <span style="display:inline-block;">Gudang:</span> <span class="detail-warehouse_id"></span>
                    </div>
                    <div class="responsive-table">
                        <table class="table table-bordered table-stripped wo-detail-table-item">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Sparepart</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th style="width:160px">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" align="right"><strong>Total</strong></td>
                                    <td colspan="1">
                                        <input type="number" name="grandtotal" class="form-control" id="grandtotal-detail" readonly="">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-close-detail" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Dialog -->
<div class="modal fade" id="modalDialogProgress" tabindex="-1" role="dialog" aria-labelledby="modalDialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title-progress">Update Progress</h4>
            </div>
            <div class="modal-body">
                <form id="theForm">
                    <input type="hidden" name="no_int_wo" class="input-no_int_wo">
                    <div class="form-group">
                        <label>Progress</label>
                        <select class="form-control input-progress" name="progress" style="display:inline-block;width:100%;">
                            <option value="INITIAL" selected style="color:#888">INITIAL</option>
                            <option value="PENDING PART" style="color:purple">PENDING PART</option>
                            <option value="ON PROGRESS" style="color:orange">ON PROGRESS</option>
                            <option value="FINISH" style="color:blue">FINISH</option>
                            <option value="CANCEL" style="color:red">CANCEL</option>
                        </select>
                    </div>
                    <div class="form-group part-pending" style="display:none">
                        <label>Part Pending</label>
                        <input type="text" name="part_pending" title="Part Pending" class="form-control input-part_pending" placeholder="Part Pending">
                    </div>
                    <div class="form-group tgl-finish" style="display:none">
                        <label>Tgl Finish</label>
                        <input type="text" name="date_done" title="Tgl Finish" class="form-control input-date_done" placeholder="Tgl Finish">
                    </div>
                    <div class="form-group">
                        <input type="text" name="progress_desc" title="Progress desc" class="form-control input-progress_desc" placeholder="Progress Description 1">
                    </div>
                    <div class="form-group">
                        <input type="text" name="progress_desc2" title="Progress desc" class="form-control input-progress_desc2" placeholder="Progress Description 2">
                    </div>
                    <div class="form-group">
                        <input type="text" name="progress_desc3" title="Progress desc" class="form-control input-progress_desc3" placeholder="Progress Description 3">
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-7">
                            <label>*Teknisi</label>
                            <select class="form-control input-teknisi_id" name="teknisi_id" id="teknisi_id">
                                <!--load via ajax-->
                            </select>
                        </div>
                        <div class="col-lg-5">
                            <label>*Tgl Assign</label>
                            <input type="text" name="date_job_assigned" id="date_job_assigned" title="Tgl Assign teknisi" class="form-control input-date_job_assigned" placeholder="Tgl Assign">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Taken By Customer</label>
                            <select class="form-control input-taken_by_customer" name="taken_by_customer">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label>Tgl Taken</label>
                            <input type="text" class="form-control input-date_taken" name="date_taken">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-cancel-progress" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <button type="button" class="btn btn-primary btn-update-progress"><i class="fa fa-edit"></i> Update</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    // session Area of Each user
    var AREA_ID = '<?php echo $area_id; ?>';
    var nilai_sn_x = '';
    var no_int_member = 0;
    var id_product_name = '';
    //var nilai_sn='2009';

    $("#date-from").datepicker({
        format: "dd-mm-yyyy",
        todayBtn: 1,
        autoclose: true,
        todayHighlight: true,
    }).on('changeDate', function(selected) {
        var minDate = new Date(selected.date.valueOf());
        var lastDay = new Date(selected.date.getFullYear(), selected.date.getMonth() + 1, 0);
        $('#date-to').val('');
        $('#export').attr('disabled', true);
        $('#date-to').datepicker('setStartDate', minDate);
        $('#date-to').datepicker('setEndDate', lastDay);
        $('#date-to').attr('disabled', false);
    });

    $("#date-to").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        todayHighlight: true,
    });

    //$('#date-buying').val($tglbeli);
    function loadtgl() {
        if (nilai_sn_x == '') {
            //  $('#date-buying').val(null);
        } else {
            $.ajax({
                type: 'post',
                url: site_url + 'sparepart/wo/getTglBeli',
                data: {
                    term: nilai_sn_x,
                },
                success: function(item) {
                    $tglbeli = item.dt_sp;
                    //        $('#date-buying').val($tglbeli);
                }
            });
        }

        //  $('#date-buying').val(null);

    }

    function showNotify(title, type, message) {
        new PNotify({
            title: title,
            text: message,
            delay: 3000,
            type: type
        });
    }

    function resetForm() {
        $('.part-pending').hide();
        $('.tgl-finish').hide();
        $('.input-date_done').val(null);
        $('.input-part_pending').val(null);
        $("#wo-form")[0].reset();
        $("#dealer-list").select2('data', {
            id: null,
            text: 'Pilih Member'
        });
        $("#area-list").select2('data', {
            id: null,
            text: 'Pilih Area'
        });
        $("#product-list").select2('data', {
            id: null,
            text: 'Pilih Product'
        });
        $("#serial_number-list").select2('data', {
            id: null,
            text: 'Pilih Serial Number'
        });

        loadJenisKerusakanDetail();
    }

    function resetFormItem() {
        $("#sparepart-list").select2("val", "");
        $("#warehouse-list").select2("val", "");
        $('.biaya_jasa').prop('selectedIndex', 0);
    }

    function loadWo(url, params) {
        if (!url) {
            url = site_url + 'sparepart/wo/loadWo';
        }
        if (!params) {
            params = {}
        }
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: url,
            data: params,
            beforeSend: function() {
                $('table#data-wo tbody').html('<tr><td colspan="21">Loading...</td></tr>');
            },
            success: function(response) {

                var tr = '';
                var data = response.data.data;
                var status = {
                    '0': 'Draft',
                    '1': 'Posted',
                    '8': 'Void',
                    '9': 'Done'
                };
                var color = {
                    'INITIAL': '#333',
                    'PENDING PART': 'purple',
                    'ON PROGRESS': 'orange',
                    'CANCEL': '#ac2925',
                    'FINISH': '#3a7bd5'
                };

                data.forEach(function(item, index) {
                    var action_edit = '';
                    // Edit and print WO Header saat cd status 0
                    // if (item.cd_status == 0) {
                    //   action_edit += '<li><a href="wo/print_wo_header/' + item.no_int_wo + '" class="print-wo" data-item_wo=\'' + htmlEntities(JSON.stringify(item)) + '\'><i class="fas fa-print"></i> &nbsp;Print WO Header</a></li>';
                    // }
                    // tambah item spareparet hanya jika ON PROGRESS
                    if (item.progress === 'ON PROGRESS') {
                        action_edit += '<li><a href="javascript:;" class="tambah-detail" data-item_wo=\'' + htmlEntities(JSON.stringify(item)) + '\'><i class="fas fa-plus"></i> &nbsp;Tambah Item</a></li>';
                    }
                    // klo sudah Finish, baru bisa nge-print Detai separe part nya
                    // if (item.progress === 'FINISH') {
                    //   action_edit += '<li><a href="wo/print_wo_detail/' + item.no_int_wo + '" class="print-wo" data-item_wo=\'' + htmlEntities(JSON.stringify(item)) + '\'><i class="fas fa-print"></i> &nbsp;Print WO Detail</a></li>';
                    // }
                    var action = '<div class="dropdown">' +
                        '<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">...' +
                        '<span class="caret"></span></button>' +
                        '<ul class="dropdown-menu">' +
                        action_edit +
                        '<li><a href="wo/print_wo_header/' + item.no_int_wo + '" class="print-wo" data-item_wo=\'' + htmlEntities(JSON.stringify(item)) + '\'><i class="fas fa-print"></i> &nbsp;Print WO Header</a></li>' +
                        '<li><a href="wo/print_wo_detail/' + item.no_int_wo + '" class="print-wo" data-item_wo=\'' + htmlEntities(JSON.stringify(item)) + '\'><i class="fas fa-print"></i> &nbsp;Print WO Detail</a></li>' +
                        '<li><a href="javascript:;" class="view-detail" data-item_wo=\'' + htmlEntities(JSON.stringify(item)) + '\'><i class="fas fa-eye"></i> &nbsp;Lihat Detail</a></li>' +
                        '<li><a href="javascript:;" class="update-progress" data-item_wo=\'' + htmlEntities(JSON.stringify(item)) + '\'><i class="fas fa-wrench"></i> &nbsp;Update Progress</a></li>' +
                        '</ul>' +
                        '</div>';

                    tr += '<tr>';
                    tr += '<td>' + (index + 1) + '</td>';
                    tr += '<td>' + action + '</td>';
                    tr += '<td>' + item.no_doc + '</td>';
                    tr += '<td>' + (item.dt_doc).substring(0, 10) + '</td>';
                    tr += '<td>' + item.nama_pemilik + '</td>'; // member
                    tr += '<td>' + item.konsumen + '</td>';
                    tr += '<td>' + item.telp + '</td>';
                    tr += '<td>' + (item.product_name || 'ALL') + '</td>';
                    tr += '<td>' + item.status_garansi + '</td>';
                    tr += '<td>' + (item.kerusakan_detail_text || '') + '</td>';
                    tr += '<td>' + item.area_name + '</td>';
                    tr += '<td>' + status[item.cd_status] + '</td>';
                    tr += '<td style="color:' + color[item.progress] + ';font-weight:bold">' + item.progress + '</td>';
                    tr += '<td>' + (item.part_pending || '') + '</td>';
                    tr += '<td>' + (item.progress_desc || '') + '</td>';
                    tr += '<td>' + (item.teknisi || '') + '</td>';
                    var date_assign = ''; // asign ke teknisi
                    if (item.date_job_assigned) {
                        date_assign = Sisgesit.utils.dates(item.date_job_assigned).toReportFormat();
                    }
                    tr += '<td>' + date_assign + '</td>';
                    var date_done = '';
                    if (item.date_done) {
                        date_done = Sisgesit.utils.dates(item.date_done).toReportFormat();
                    }
                    tr += '<td>' + date_done + '</td>';
                    tr += '<td>' + (item.taken_by_customer == 1 ? 'Yes' : 'No') + '</td>';
                    var dt_taken = '';
                    if (item.date_taken) {
                        dt_taken = Sisgesit.utils.dates(item.date_taken).toReportFormat();
                    }
                    tr += '<td>' + dt_taken + '</td>';
                    tr += '<td>' + (item.is_callback == 1 ? 'Yes' : 'No') + '</td>';
                    tr += '</tr>';

                });

                $('table#data-wo tbody').html(tr);
                $('.pagination').html(response.paging);
            }
        });
    }

    function calculateGrandTotal() {
        var grandtotal = 0;
        $(".item-total").each(function() {
            grandtotal += parseInt($(this).val());
        });

        $('#grandtotal').val(grandtotal);
    }

    function loadBiayaJasa() {
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: site_url + 'sparepart/wo/loadBiayaJasa',
            beforeSend: function() {
                console.log('loading biaya jasa');
            },
            success: function(response) {
                var option = '';
                var data = response.data;
                option += '<option value="">--Pilih Biaya Jasa--</option>';
                data.forEach(function(item, index) {
                    option += '<option value="' + item.jasa_id + '|' + item.biaya + '">' + item.jasa_name + ' | ' + item.biaya + '</option>';
                });

                $('.biaya_jasa').html(option);
            }
        });
    }

    function loadItemDetail(no_int_wo) {
        $.ajax({
            url: site_url + 'sparepart/wo/getDetailItem',
            type: 'get',
            dataType: 'json',
            data: {
                no_int_wo: no_int_wo
            },
            beforeSend: function() {
                console.log('Loading detail...');
                $('.wo-detail-table-item tbody').html('<tr><td colspan="5">Loading..</td></tr>');
            },
            success: function(res) {
                var item = res.data;
                var rows = '';
                var grandtotal = 0;
                item.forEach(function(item, indexItem) {
                    var qty = parseInt(item.qty);
                    var price = parseFloat(item.price);
                    var amt_total = parseFloat(item.amt_total);
                    var no_int_product = item.no_int_product;
                    var product_name = item.product_name || item.jasa_name;
                    var kode_product = item.product_id

                    grandtotal += parseFloat(amt_total);

                    rows += '<tr>';
                    rows += '<td><input type="hidden" name="item[' + indexItem + '][no_int_product]" value="' + no_int_product + '">';
                    rows += kode_product;
                    rows += '</td><td>';
                    rows += '<input type="hidden" name="item[' + indexItem + '][product_name]" value="' + product_name + '">';
                    rows += product_name;
                    rows += '</td>';
                    rows += '<td><input readonly data-index="' + (indexItem) + '" type="text" class="form-control item-qty item-qty-ke-' + (indexItem) + '" name="item[' + indexItem + '][qty]" value="' + qty + '" onkeypress="return number_only(event)"></td>';
                    rows += '<td><input readonly data-index="' + (indexItem) + '" type="text" class="form-control item-price item-price-ke-' + (indexItem) + '" name="item[' + indexItem + '][price]" value="' + price + '" onkeypress="return number_only(event)"></td>';
                    rows += '<td><input readonly data-index="' + (indexItem) + '" readonly type="number" class="form-control item-total item-total-ke-' + (indexItem) + '" name="item[' + indexItem + '][amt_total]" value="' + amt_total + '"></td>';
                    rows += '</tr>';
                });

                $('#grandtotal-detail').val(grandtotal);
                $('.wo-detail-table-item tbody').html(rows);

            }
        });
    }

    function loadJenisKerusakan() {
        $.ajax({
            url: site_url + 'sparepart/wo/getJenisKerusakan',
            dataType: 'json',
            type: 'get',
            beforeSend: function() {
                $('.append-kerusakan-detail').html('Loading..');
            },
            success: function(res) {
                var option = '';
                res.data.forEach(function(item, index) {
                    option += '<option value="' + item.no_int_sgh + '">' + item.sgh_name + '</option>';
                });
                $('.jenis-kerusakan').html(option);
                // load detail
                loadJenisKerusakanDetail();
            }
        });
    }

    function loadJenisKerusakanDetail() {
        var _this = $('.jenis-kerusakan').val();
        $.ajax({
            url: site_url + 'sparepart/wo/getJenisKerusakanDetail',
            type: 'get',
            dataType: 'json',
            data: {
                kerusakan_id: _this
            },
            beforeSend: function() {
                $('.append-kerusakan-detail').html('Loading..');
            },
            success: function(result) {
                var jhtml = '';
                if (result.data.length > 0) {
                    result.data.forEach(function(item) {
                        var _sitem = item.no_int_sgd + '||' + item.sgd_name;
                        jhtml += '<div style="padding:2px;border:1px solid #ccc;display:inline-block;margin:2px"><input type="checkbox" name="kerusakan_detail[]" value="' + _sitem + '">' + item.sgd_name + '</div> &nbsp;';
                    });
                }
                $('.append-kerusakan-detail').html(jhtml);
            }
        });
    }

    function loadServiceAction() {
        $.ajax({
            url: site_url + 'sparepart/wo/getServiceAction',
            dataType: 'json',
            type: 'get',
            beforeSend: function() {
                $('.service-action').html('Loading..');
            },
            success: function(res) {
                var option = '<select class="form-control" name="service_action">';
                res.data.forEach(function(item, index) {
                    var _value = item.no_int_spa + '||' + item.spa_name;
                    option += '<option title="' + item.keterangan + '" value="' + _value + '">' + item.spa_name + '</option>';
                });
                option += '</select>';
                $('.service-action').html(option);
            }
        });
    }

    function loadTeknisi(selected) {
        $.ajax({
            url: site_url + 'sparepart/wo/getTeknisi',
            dataType: 'json',
            type: 'get',
            beforeSend: function() {
                console.log('Loading Teknisi');
            },
            success: function(res) {
                var option = '';
                option += '<option value="">--</option>';
                res.data.forEach(function(item, index) {
                    var sel = selected == item.teknisi_id ? 'selected' : '';
                    option += '<option value="' + item.teknisi_id + '" ' + sel + '>' + item.nama + '</option>';
                });
                $('.input-teknisi_id').html(option);
            }
        });
    }

    $(function() {

        $('.btn-export').click(function(e) {
            let dx = $('#date-from').val();
            let dt = $('#date-to').val();
            if (dx == '' || dt == '') {
                alert('periode tidak boleh kosong');
                return;
            }
            $('#filter-form').attr('method', 'post');
            $('#filter-form').attr('action', site_url + 'sparepart/wo/export');
            $('#filter-form').submit();
        });

        $(document).on('change', '#date-to', function() {
            $('.btn-export').removeAttr('disabled');

        });

        $('#date-buying, .input-date_taken, .input-date_done, .input-date_job_assigned').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: true,
            forceParse: false
        });

        //on click tabs
        $('#myTabs a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // ini load keruksakan
        loadJenisKerusakan();
        //init load WO
        loadWo();

        $(document).on('click', "ul.pagination>li>a", function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            loadWo(href);

            return false;
        });

        /**
         * Tambah Item sparepart/Detail
         */
        $(document).on('click', '.tambah-detail', function() {
            var data = $(this).data('item_wo');
            console.log(data);

            $('#grandtotal').val(null); // reset price
            $('.wo-item-table-item tbody').html(''); // reset form item
            $('.input-no_int_wo').val(data.no_int_wo);
            $('.input-area_id').val(data.area_id);

            var rows = '';
            rows += '<tr style="background:#eee">';
            rows += '<td><b>Area</b></td><td colspan="3">' + data.area_name + '</td>';
            rows += '</tr>';
            rows += '<tr style="background:#eee">';
            rows += '<td><b>Nama Member</b></td><td colspan="3">' + data.nama_pemilik + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>No WO</b></td><td>' + data.no_doc + '</td>';
            rows += '<td><b>Tgl Kwitansi</b></td><td>' + data.dt_kwitansi_pembelian + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Nama Konsumen</b></td><td>' + data.konsumen + '</td>';
            rows += '<td><b>Telp</b></td><td>' + data.telp + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Serial Number</b></td><td>' + data.serial_number + '</td>';
            rows += '<td><b>No Kartu Garansi</b></td><td>' + data.no_kartu_garansi + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Produk</b></td><td>' + data.product_name + '</td>';
            rows += '<td><b>Status Garansi</b></td><td><b>' + data.status_garansi + '</b></td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Kerusakan</b></td><td colspan="3">' + data.jenis_kerusakan + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Kerusakan Detail</b></td><td colspan="3">' + (data.kerusakan_detail_text || '') + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Alamat</b></td><td colspan="3">' + data.address + '</td>';
            rows += '</tr>';
            rows += '<td><b>Keterangan</b></td><td colspan="3"><input name="keterangan" readonly value="' + data.keterangan + '" type="text" class="form-control" ></td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Service Action</b></td><td colspan="3" class="service-action"></td>';
            rows += '</tr>';

            $('.wo-item-table tbody').html(rows);
            loadBiayaJasa();
            loadServiceAction(); // willbe embeded to Service Action
            $('#modalDialog').modal('show');

        });

        // Detail WO
        $(document).on('click', '.view-detail', function() {
            var data = $(this).data('item_wo');
            var rows = '';
            rows += '<tr style="background:#eee">';
            rows += '<td><b>Area</b></td><td colspan="3">' + data.area_name + '</td>';
            rows += '</tr>';
            rows += '<tr style="background:#eee">';
            rows += '<td><b>Nama Member</b></td><td colspan="3">' + data.nama_pemilik + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>No WO</b></td><td>' + data.no_doc + '</td>';
            rows += '<td><b>Tgl Kwitansi</b></td><td>' + data.dt_kwitansi_pembelian + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Nama Konsumen</b></td><td>' + data.konsumen + '</td>';
            rows += '<td><b>Telp</b></td><td>' + data.telp + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Serial Number</b></td><td>' + data.serial_number + '</td>';
            rows += '<td><b>No Kartu Garansi</b></td><td>' + data.no_kartu_garansi + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Produk</b></td><td>' + data.product_name + '</td>';
            rows += '<td><b>Status Garansi</b></td><td><b>' + data.status_garansi + '</b></td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Kerusakan</b></td><td colspan="3">' + data.jenis_kerusakan + '</td>';
            rows += '</tr>';
            if (data.kerusakan_detail_id) {
                rows += '<tr>';
                rows += '<td><b>Kerusakan Detail</b></td><td colspan="3">' + data.kerusakan_detail_text + '</td>';
                rows += '</tr>';
            }
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Alamat</b></td><td colspan="3">' + data.address + '</td>';
            rows += '</tr>';
            rows += '<tr>';
            rows += '<td><b>Keterangan</b></td><td colspan="3">' + data.keterangan + '</td>';
            rows += '</tr>';
            if (data.service_action_id) {
                rows += '<tr>';
                rows += '<td><b>Service Action</b></td><td colspan="3">' + (data.service_action_text || '') + '</td>';
                rows += '</tr>';
            }

            $('.wo-detail-table tbody').html(rows);
            $('.detail-warehouse_id').text(data.warehouse_name || '');
            $('#grandtotal-detail').val(''); // willbe filled in loadItemDetail
            // fetch item
            loadItemDetail(data.no_int_wo);
            $('#modalDialogDetail').modal('show');
        });

        $('#refreshWo').click(function(e) {
            e.preventDefault();
            loadWo();
        });

        $('#doSearch').click(function(e) {
            e.preventDefault();
            var search = $('#search').val();
            var _filter_form = $('#filter-form').serialize();
            loadWo(null, _filter_form);
        });

        $('#clearSearch').click(function(e) {
            e.preventDefault();
            $('#filter-form')[0].reset();
            loadWo();
        });



        function getProductBySerialNumber(serial_number, divisi) {
            if (serial_number) {
                // Product List
                $("#product-list").select2({
                    placeholder: "Pilih Produk...",
                    //  multiple: false,
                    //  minimumInputLength: 3,
                    ajax: {
                        url: site_url + "sparepart/wo/reqProduct",
                        dataType: 'json',
                        quietMillis: 250,
                        data: function(term, page) {
                            return {
                                term: term,
                                page: page,
                                page_limit: 30,
                                id_category: 1,
                                serial_number: serial_number,
                                ls_product_name: id_product_name,
                                divisi: divisi
                            };
                        },
                        results: function(data, page) {
                            var more = (page * 30) < data.total;
                            return {
                                results: data.results,
                                more: more
                            };
                        }
                    },
                    formatResult: function(product) {
                        var markup = '<div class="row" >' +
                            '<div class="col-lg-12">' +
                            '<div class="row">' +
                            '<div class="col-lg-4">' + product.kode + '</div>' +
                            '<div class="col-lg-1"> | </div>' +
                            '<div class="col-lg-7">' + product.text + '</div>' +
                            '</div>';
                        markup += '</div></div>';

                        return markup;
                    },
                    formatSelection: function(product) {
                        return product.text;
                    },
                    dropdownCssClass: "bigdrop",
                    escapeMarkup: function(m) {
                        return m;
                    }
                }).on("change", function(product) {
                    $('#product-code').val(product.added.kode);
                });

            }
        }

        //select for area
        $("#area-list").select2({
            placeholder: "Pilih Area...",
            //minimumInputLength: 2,
            ajax: {
                url: site_url + "sparepart/wo/reqArea",
                dataType: 'json',
                quietMillis: 250,
                data: function(term, page) {
                    return {
                        term: term,
                        page: page,
                        page_limit: 30,
                        area_id: AREA_ID,
                        nilai_serial: nilai_sn_x,
                        ls_product_name: id_product_name
                    };
                },
                results: function(data, page) {
                    var more = (page * 30) < data.total;
                    return {
                        results: data.results,
                        more: more
                    };
                }
            },
            formatResult: function(area) {
                var markup = '<div class="row" >' +
                    '<div class="col-lg-12">' +
                    '<div class="row">' +
                    '<div class="col-lg-7">' + area.text + '</div>' +
                    '<div class="col-lg-1"> | </div>' +
                    '<div class="col-lg-4">' + area.city_name + '</div>' +
                    '</div>';
                markup += '</div></div>';

                return markup;

            },
            formatSelection: function(area) {
                return area.text;
            },
            dropdownCssClass: "bigdrop",
            escapeMarkup: function(m) {
                return m;
            }

        });

        // on jenis kerusakan dipilih
        $('.jenis-kerusakan').on("change", function() {
            loadJenisKerusakanDetail();
        });


        function getDealerBySerialNumber(serial_number, divisi) {

            if (serial_number) {
                $("#dealer-list").select2({
                    placeholder: "Pilih Member...",
                    multiple: false,
                    // minimumInputLength: 1,
                    ajax: {
                        url: site_url + "sparepart/wo/reqPiutangmbr",
                        dataType: 'json',
                        quietMillis: 250,
                        data: function(term, page) {
                            return {
                                term: term,
                                page: page,
                                page_limit: 30,
                                no_member: no_int_member,
                                serial_number: serial_number,
                                divisi: divisi
                            };
                        },
                        results: function(data, page) {
                            var more = (page * 30) < data.total;
                            return {
                                results: data.results,
                                more: more
                            };
                        }
                    },
                    formatResult: function(dealer) {
                        var markup = '<div class="row" >' +
                            '<div class="col-lg-12">' +
                            '<div class="row">' +
                            '<div class="col-lg-4">' + dealer.kode + '</div>' +
                            '<div class="col-lg-1"> | </div>' +
                            '<div class="col-lg-7">' + dealer.text + '</div>' +
                            '</div>';
                        markup += '</div></div>';

                        return markup;
                    },
                    formatSelection: function(dealer) {
                        return dealer.text;
                    },
                    dropdownCssClass: "bigdrop",
                    escapeMarkup: function(m) {
                        return m;
                    }
                }).on("change", function(dealer) {
                    $('#address').val(dealer.added.address);
                    $('#telp').val(dealer.added.telp);
                    $('#customer-name').val(dealer.added.text);
                    $('#konsumen').val(dealer.added.text);
                });
            }
        }
        // Index for SparePart Item on Add Action
        var indexItem = 0;


        //omn remove item
        $(document).on('click', '.remove-item', function() {
            $(this).closest('tr').remove();
            calculateGrandTotal();
        });

        //just in case biaya jasa is not loaded immediatly
        $('.biaya_jasa').click(function() {
            if ($(this).length < 2) {
                loadBiayaJasa(); //reload
            }
        });

        // On change biaya jasa, append to item list
        $(document).on('change', '.biaya_jasa', function() {
            var _this = $(this);
            if (_this.val()) {
                var _value = _this.val().split('|');
                var _text = $("option:selected", _this).text().split('|');
                var price = _value[1];
                var jasa_name = _text[0].trim();
                var rows = '';
                rows += '<tr>';
                rows += '<td><button class="btn btn-danger remove-item" title="Hapus item"><i class="fa fa-trash"></i></button></td>';
                rows += '<td></td>';
                rows += '<td><input type="hidden" name="item[' + indexItem + '][no_int_product]" value="0">';
                rows += '<input type="hidden" name="item[' + indexItem + '][product_name]" value="">';
                rows += '<input type="hidden" name="item[' + indexItem + '][jasa_id]" value="' + _value[0] + '">';
                rows += jasa_name;
                rows += '</td>';
                rows += '<td><input data-index="' + (indexItem) + '" type="number" class="form-control item-qty item-qty-ke-' + (indexItem) + '" name="item[' + indexItem + '][qty]" value="1" onkeypress="return number_only(event)" readonly></td>';
                rows += '<td><input data-index="' + (indexItem) + '" type="number" class="form-control item-price item-price-ke-' + (indexItem) + '" name="item[' + indexItem + '][price]" value="' + price + '" onkeypress="return number_only(event)" readonly></td>';
                rows += '<td><input data-index="' + (indexItem) + '" readonly type="number" class="form-control item-total item-total-ke-' + (indexItem) + '" name="item[' + indexItem + '][amt_total]" value="' + price + '"></td>';
                rows += '</tr>';

                indexItem++;

                $('.wo-item-table-item tbody').append(rows);

                calculateGrandTotal();
            }
        });

        //select for Warehouse
        $("#warehouse-list").select2({
            placeholder: "Pilih Gudang...",
            minimumInputLength: 2,
            ajax: {
                url: site_url + "requester/reqGudang",
                dataType: 'json',
                quietMillis: 250,
                data: function(term, page) {
                    var area_id = $('.input-area_id').val();
                    return {
                        term: term,
                        page: page,
                        page_limit: 30,
                        area_id: area_id
                        //   area_id: area_id || AREA_ID
                    };
                },
                results: function(data, page) {
                    var more = (page * 30) < data.total;
                    return {
                        results: data.results,
                        more: more
                    };
                }
            },
            formatResult: function(wh) {

                var markup = '<div class="row" >' +
                    '<div class="col-lg-12">' +
                    '<div class="row">' +
                    '<div class="col-lg-12">' + wh.namewh + '</div>' +
                    '</div>';
                markup += '</div></div>';

                return markup;
            },
            formatSelection: function(wh) {
                return wh.namewh;
            },
            dropdownCssClass: "bigdrop",
            escapeMarkup: function(m) {
                return m;
            }

        }).on('change', function(wh) {
            let wh_type = wh.added.tipe;
            let urlnya = site_url + "requester/reqProductAndPriceCopy?category=sparepart&type=all";

            if (wh_type == 2) {
                urlnya = site_url + "requester/reqProductAndPriceCopy?category=sparepart&type=gogo";
            } else {
                urlnya;
            }

            $("#sparepart-list").removeAttr('disabled');
            //sparepart list
            $("#sparepart-list").select2({
                placeholder: "Pilih sparepart...",
                multiple: false,
                minimumInputLength: 3,
                ajax: {
                    url: urlnya,
                    dataType: 'json',
                    quietMillis: 250,
                    data: function(term, page) {
                        var area_id = $('.input-area_id').val();
                        return {
                            term: term,
                            page: page,
                            page_limit: 30,
                            area_id: area_id
                        };
                    },
                    results: function(data, page) {
                        var more = (page * 30) < data.total;
                        return {
                            results: data.results,
                            more: more
                        };
                    }
                },
                formatResult: function(product) {
                    var markup = '<div class="row" >' +
                        '<div class="col-lg-12">' +
                        '<div class="row">' +
                        '<div class="col-lg-4">' + product.kode + '</div>' +
                        '<div class="col-lg-1"> | </div>' +
                        '<div class="col-lg-7">' + product.text + '</div>' +
                        '</div>';
                    markup += '</div></div>';

                    return markup;
                },
                formatSelection: function(product) {
                    return product.text;
                },
                dropdownCssClass: "bigdrop",
                escapeMarkup: function(m) {
                    return m;
                }
            }).on("change", function(product) {
                console.log(product);
                var no_int_product = product.added.id;
                var product_name = product.added.text;
                var price = parseInt(product.added.priceamt);
                var amt_total = price * 1; // default
                var kode_product = product.added.kode; // add by endin.saripudin
                var rows = '';
                rows += '<tr>';
                rows += '<td><button class="btn btn-danger remove-item" title="Hapus item"><i class="fa fa-trash"></i></button></td>';
                rows += '<td><input type="hidden" name="item[' + indexItem + '][no_int_product]" value="' + no_int_product + '">';
                rows += kode_product;
                rows += '<td><input type="hidden" name="item[' + indexItem + '][kode_product]" value="' + kode_product + '">';
                rows += '<input type="hidden" name="item[' + indexItem + '][product_name]" value="' + product_name + '">';
                rows += product_name;
                rows += '</td>';
                rows += '<td><input data-index="' + (indexItem) + '" type="text" class="form-control item-qty item-qty-ke-' + (indexItem) + '" name="item[' + indexItem + '][qty]" value="1" onkeypress="return number_only(event)"></td>';
                rows += '<td><input data-index="' + (indexItem) + '" type="text" class="form-control item-price item-price-ke-' + (indexItem) + '" name="item[' + indexItem + '][price]" value="' + price + '" onkeypress="return number_only(event)"></td>';
                rows += '<td><input data-index="' + (indexItem) + '" readonly type="number" class="form-control item-total item-total-ke-' + (indexItem) + '" name="item[' + indexItem + '][amt_total]" value="' + amt_total + '"></td>';
                rows += '</tr>';

                indexItem++;

                $('.wo-item-table-item tbody').append(rows);
                calculateGrandTotal();
                $("#sparepart-list").select2("val", "");
            });
        })

        $('.btn-cancel').click(function() {
            window.location.reload();
            $('.wo-item-table-item tbody').empty();
            resetFormItem();
            $('#modalDialog').modal('hide');
        });

        $(document).on('keyup', '.item-qty', function() {
            var _this = $(this);
            var index = _this.data('index');
            var qty_val = parseInt(_this.val());
            var price_val = parseInt($('.item-price-ke-' + index).val());
            var total_val = qty_val * price_val;
            $('.item-total-ke-' + index).val(total_val);

            calculateGrandTotal();
        });

        $(document).on('keyup', '.item-price', function() {
            var _this = $(this);
            var index = _this.data('index');
            var qty_val = parseInt($('.item-qty-ke-' + index).val());
            var price_val = parseInt(_this.val());
            var total_val = qty_val * price_val;
            $('.item-total-ke-' + index).val(total_val);

            calculateGrandTotal();
        });

        //save WO and Items
        $('.btn-save').click(function() {
            var _this = $(this);
            var _form = $('#addForm').serializeArray();
            $.ajax({
                url: site_url + 'sparepart/wo/saveItem',
                type: 'post',
                dataType: 'json',
                data: _form,
                beforeSend: function() {
                    _this.prop('disabled', true);
                },
                success: function(res) {
                    if (res.status) {
                        showNotify('Success!', 'success', res.message);
                        resetFormItem();
                        $('#modalDialog').modal('hide');
                        loadWo();
                    } else {
                        showNotify('Warning!', 'error', res.error);
                    }
                    _this.prop('disabled', false);
                },
                error: function(x, h, r) {
                    _this.prop('disabled', false);
                    showNotify('Warning!', 'error', r);
                }
            });
        });

        // Save WO
        $('#saveWo').click(function(e) {
            e.preventDefault();
            var _this = $(this);
            var data = $('#wo-form').serialize();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: site_url + 'sparepart/wo/saveWo',
                data: data,
                beforeSend: function() {
                    _this.prop('disabled', true);
                },
                success: function(res) {
                    _this.prop('disabled', false);
                    if (res.status) {
                        showNotify('Success!', 'success', res.message);
                        resetForm();
                        loadWo();
                    } else {
                        showNotify('Warning!', 'error', res.error);
                    }
                },
                error: function(x, h, r) {
                    _this.prop('disabled', false);
                    showNotify('Warning!', 'error', r);
                }
            })
        });

        $('#cancelWo').click(function() {
            resetForm();
        });

        $("#serial_number-list").select2({
            placeholder: "Pilih ...",
            //minimumInputLength: 2,
            ajax: {
                url: site_url + "sparepart/wo/getSerialNumber",
                dataType: 'json',
                quietMillis: 250,
                data: function(term, page) {
                    return {
                        term: term,
                        page: page,
                        page_limit: 30,
                        area_id: AREA_ID
                    };
                },
                results: function(data, page) {
                    var more = (page * 30) < data.total;
                    return {
                        results: data.results,
                        more: more
                    };
                }
            },
            formatResult: function(serial_number) {
                var markup = '<div class="row" >' +
                    '<div class="col-lg-12">' +
                    '<div class="row">' +
                    '<div class="col-lg-7">' + serial_number.id + '</div>' +
                    '<div class="col-lg-1"> | </div>' +
                    '<div class="col-lg-4">' + serial_number.product_name + '</div>' +
                    '</div>';
                markup += '</div></div>';

                return markup;

            },
            formatSelection: function(serial_number) {
                return serial_number.id;
            },
            dropdownCssClass: "bigdrop",
            escapeMarkup: function(m) {
                return m;
            }
        }).on("change", function(serial_number) {
            nilai_sn_x = serial_number.added.id;
            divisi = serial_number.added.divisi;
            getDealerBySerialNumber(nilai_sn_x, divisi);
            getProductBySerialNumber(nilai_sn_x, divisi);
            no_int_member = serial_number.added.no_member;
            id_product_name = serial_number.added.product_name;
            var ls_tgl = serial_number.added.tgl_sp;
            var ls_tgl_new = ls_tgl.substr(8, 2) + "-" + ls_tgl.substr(5, 2) + "-" + ls_tgl.substr(0, 4);
            $('#date-buying').val(ls_tgl_new);
            $('#no_garansi').val(serial_number.added.id);

        });

        // On input progress selected
        $(document).on('change', '.input-progress', function() {
            var _this = $(this);
            if (_this.val() === 'FINISH') {
                $('.tgl-finish').show();
                $('.part-pending').hide();
                $('.input-part_pending').val(null);
            } else if (_this.val() === 'PENDING PART') {
                $('.part-pending').show();
                $('.tgl-finish').hide();
                $('.input-date_done').val(null);
            } else {
                $('.part-pending').hide();
                $('.tgl-finish').hide();
                $('.input-date_done').val(null);
                $('.input-part_pending').val(null);
            }
        });

        // On teknisi selected
        $(document).on('change', '.input-teknisi_id', function() {
            var _this = $(this);
            if (_this.val()) {
                // check if Progress = ON PROGRESS
                if ($('.input-progress').val() === 'INITIAL') {
                    showNotify('Warning!', 'warning', 'Untuk memilih Teknisi, Progress minimal ON PROGRESS');
                    _this.val(null);
                    return;
                }
            }
        });

        // On taken by customer selected
        $(document).on('change', '.input-taken_by_customer', function() {
            var _this = $(this);
            if (_this.val() == 1) {
                var progress = $('.input-progress').val();
                // check if status FINISH or CANCEL
                if (progress == 'FINISH' || progress == 'CANCEL') {
                    return true;
                } else {
                    showNotify('Warning!', 'warning', 'Silahkan set Progress ke FINISH atau CANCEL dahulu');
                    _this.val(0);
                    return false;
                }
            }
        });

        // Save update progress
        $(document).on('click', '.update-progress', function() {
            var item = $(this).data('item_wo');

            // loading teknisi
            loadTeknisi(item.teknisi_id);
            $('.modal-title').html('Update Progress');

            $('.input-no_int_wo').val(item.no_int_wo);
            $('.input-progress').val(item.progress);
            if (item.progress === 'FINISH') {
                var date_done = null;
                if (item.date_done) {
                    date_done = Sisgesit.utils.dates(item.date_done).toReportFormat();
                }
                $('.input-date_done').val(date_done);
                $('.tgl-finish').show();
            }
            if (item.progress === 'PENDING PART') {
                $('.part-pending').show();
                $('.input-part_pending').val(item.part_pending);
            }
            $('.input-progress_desc').val(item.progress_desc);
            $('.input-teknisi_id').val(item.teknisi_id);
            if (item.date_job_assigned) {
                $('.input-date_job_assigned').val(Sisgesit.utils.dates(item.date_job_assigned).toReportFormat());
            } else {
                $('.input-date_job_assigned').val(null);
            }
            $('.input-progress_desc2').val(item.progress_desc2);
            $('.input-progress_desc3').val(item.progress_desc3);
            $('.input-taken_by_customer').val(item.taken_by_customer || '0'); // set default to No
            if (item.date_taken) {
                $('.input-date_taken').val(Sisgesit.utils.dates(item.date_taken).toReportFormat());
            } else {
                $('.input-date_taken').val(null);
            }
            $('.modal-title-progress').html('Update Progress - ' + item.no_doc);
            $("#modalDialogProgress").modal('show');
        });

        $('.btn-cancel-progress').click(function() {
            resetForm();
        });

        $('.btn-update-progress').click(function() {
            var _this = $(this);
            var data = $('#theForm').serialize();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: site_url + 'sparepart/wo/updateProgress',
                data: data,
                beforeSend: function() {
                    _this.prop('disabled', true);
                },
                success: function(res) {
                    if (res.status) {
                        showNotify('Success!', 'success', res.message);
                        resetForm();
                        $("#modalDialogProgress").modal('hide');
                        //reload data
                        loadWo();
                    } else {
                        showNotify('Warning!', 'error', res.error);
                    }

                    _this.prop('disabled', false);
                },
                error: function(x, h, r) {
                    showNotify('Error!', 'error', r);
                    _this.prop('disabled', false);
                }
            });
            $("#modalDialogProgress").modal('hide');
        });
    });
</script>