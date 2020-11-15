<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="failadd" data-failadd="<?= $this->session->flashdata('failadd'); ?>"></div>
    <div class="succadd" data-succadd="<?= $this->session->flashdata('succadd'); ?>"></div>
    <div class="failupdate" data-failupdate="<?= $this->session->flashdata('failupdate'); ?>"></div>
    <div class="succupdate" data-succupdate="<?= $this->session->flashdata('succupdate'); ?>"></div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Role Controls</h6>
                </div>

                <div class="card-body">
                    <a href="" class="btn btn-primary mb-3 role-add" data-toggle="modal" data-target="#roleModal"><i class="fas fa-fw fa-plus"></i> Role</a>

                    <div class="table-responsive">
                        <table class="table table-hover" id="table-role">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Action</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Generate by Ajax -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judulModalRole" id="roleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url(); ?>admin/editRole" class="form-role" method="POST">
                <input type="hidden" name="role_id" id="role_id">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="role_nama" id="role_nama" placeholder="Role Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitRole">Add Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="accessModal" tabindex="-1" role="dialog" aria-labelledby="accessModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judulModalAccess" id="accessModalLabel">Access Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Role : <span class="role-nama"></span></h5>
                <div class="alert-places text-primary small"></div>

                <table class="table table-hover" id="table-access">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Menu</th>
                            <th>Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Generate by Ajax -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-access" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<script>
$(function() {
    let base_url = '<?= base_url() ?>';

    function get_role() {
        $.ajax({
            url: base_url + 'admin/ajaxGetAllRole',
            method: 'POST',
            dataType: 'JSON',
            success: function(hasil) {
                // console.log(hasil);
                $('#table-role tbody').html(hasil);
            }
        })
    }

    get_role();

    $(document).on('click', '.role-add', function() {
        $('.judulModalRole').html('Add New Role');
        $('.submitRole').html('Add Role');
        $('.form-role').attr('action', base_url + 'admin/addRole');

        $('#role_id').val('');
        $('#role_nama').val('');
    });

    $(document).on('click', '.role-edit', function() {
        $('.judulModalRole').html('Edit Role');
        $('.submitRole').html('Edit Role');
        $('.form-role').attr('action', base_url + 'admin/updateRole');

        const id = $(this).data('id');
        console.log(id);

        $.ajax({
            url: base_url + 'admin/ajaxGetRoleById',
            method: 'POST',
            dataType: 'JSON',
            data: {
                idJson: id
            },
            success: function(hasil) {
                console.log(hasil);
                $('#role_id').val(hasil.role_id);
                $('#role_nama').val(hasil.role_nama);
            }
        });
    });

    $(document).on('click', '.role-access', function() {
        const role_id = $(this).data('id');

        $.ajax({
            url: base_url + 'admin/ajaxGetRoleAccess',
            method: 'POST',
            dataType: 'JSON',
            data: {
                role_id: role_id
            },
            success: function(hasil) {
                console.log(hasil);
                $('.role-nama').html(hasil.role.role_nama);
                $('#table-access tbody').html(hasil.menu);
            }
        })
    });

    $(document).on('click', '.cekboxs', function() {

        // Tangkap idMenu dan idRole yang dikirimkan
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        // Lalu oper lagi ke method changeAccess() dengan type POST
        $.ajax({
            url: base_url + 'admin/changeAccess',
            type: 'POST',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function(hasil) {
                console.log(hasil);

                Swal.fire({
                    icon: 'success',
                    width: 600,
                    padding: '2em',
                    title: 'Access changed!',
                    html: "Congratulations, you changed some menu access."
                });
            }
        });
    });

    $(document).on('click', '.close-access', function() {
        location.reload();
    })
})
</script>