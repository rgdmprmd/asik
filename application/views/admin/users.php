<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Users control</h6>
                </div>

                <div class="card-body">
                    <!-- <a href="" class="btn btn-primary mb-3 role-add" data-toggle="modal" data-target="#roleModal"><i class="fas fa-fw fa-plus"></i> Role</a> -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="dropdown mb-3">
                                <a class="dropdown-toggle btn btn-primary ml-1" href="#" role="button" id="users-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All status
                                </a>
                                <div class="dropdown-menu dropdown-menu-down shadow animated--fade-in" aria-labelledby="users-dropdown">
                                    <div class="dropdown-header">Status users :</div>
                                    <a class="dropdown-item users-status" href="#" data-status="2">All status</a>
                                    <a class="dropdown-item users-status" href="#" data-status="1">Active</a>
                                    <a class="dropdown-item users-status" href="#" data-status="0">Denied</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control search-users" placeholder="Cari email users">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-hover" id="table-users">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Control</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Generate by Ajax -->
                                </tbody>
                            </table>
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
<!-- /.container-fluid -->

<div class="modal fade" id="userControl" tabindex="-1" role="dialog" aria-labelledby="userControlLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Judul modal -->
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="userControlLabel">User control</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- End Judul modal -->

            <form action="" class="form-users" method="POST">
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_role">Role user</label>
                        <select class="form-control" name="user_role" id="user_role">
                            <?php foreach($role as $r) : ?>
                            <option value="<?= $r['role_id']; ?>"><?= $r['role_nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_status">Status user</label>
                        <select class="form-control" name="user_status" id="user_status">
                            <option value="1">Active</option>
                            <option value="0">Nonactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submit-user">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(function() {
    const base_url = '<?= base_url() ?>';
    let statsUsers = 2;
    let sercUsers = '';

    function getUsers(url, status, search) {
        if (!url) {
            url = base_url + 'admin/ajaxGetUsers';
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
                $('#table-users tbody').html(hasil.hasil);
                $(".tarosini").html(hasil.error);

            }
        });
    }

    getUsers('', statsUsers, sercUsers);

    $(document).on('click', "ul.pagination>li>a", function() {
        let href = $(this).attr('href');
        getUsers(href, statsUsers, sercUsers);

        return false;
    });

    $(document).on('click', '.users-status', function(e) {
        let text = $(this).text();
        statsUsers = $(this).data('status');

        $('#users-dropdown').html(text);

        getUsers('', statsUsers, sercUsers);

        e.preventDefault();
    });

    $(document).on('keyup', '.search-users', function(e) {
        sercUsers = $(this).val();
        getUsers('', statsUsers, sercUsers);

        e.preventDefault();
    });

    $(document).on('click', '.user-edit', function() {
        const id = $(this).data('id');

        $.ajax({
            url: base_url + 'admin/ajaxGetUserById',
            method: 'POST',
            dataType: 'JSON',
            data: {
                idJson: id
            },
            success: function(hasil) {
                console.log(hasil);
                $('#user_id').val(hasil.user_id);
                $('#user_role').val(hasil.role_id);
                $('#user_status').val(hasil.user_status);
            }
        })
    });

    $(document).on('click', '#submit-user', function(e) {
        let user_id = $('#user_id').val();
        let user_role = $('#user_role').val();
        let user_status = $('#user_status').val();

        $.ajax({
            url: base_url + 'admin/ajaxUpdateUsers',
            method: 'POST',
            dataType: 'JSON',
            data: {
                user_id: user_id,
                user_role: user_role,
                user_status: user_status
            },
            success: function(hasil) {
                $('#userControl').modal('hide');

                // console.log(hasil);
                if (hasil == true) {
                    Swal.fire({
                        icon: 'success',
                        width: 600,
                        padding: '2em',
                        title: 'Users updated!',
                        html: "Congratulations, you've update some users."
                    }).then((result) => {
                        location.reload();
                    })
                }
            }
        });

        e.preventDefault();
    });
})
</script>