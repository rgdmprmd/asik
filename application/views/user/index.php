<style>
    .hide {
        display: none;
    }
</style>

<div class="container-fluid">

    <!-- Tittle Page -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="failadd" data-failadd="<?= $this->session->flashdata('failadd'); ?>"></div>
    <div class="succadd" data-succadd="<?= $this->session->flashdata('succadd'); ?>"></div>
    <div class="failupdate" data-failupdate="<?= $this->session->flashdata('failupdate'); ?>"></div>
    <div class="succupdate" data-succupdate="<?= $this->session->flashdata('succupdate'); ?>"></div>

    <!-- Content -->
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card shadow">
                <img src="<?= base_url(); ?>assets/img/profile/<?= $user['user_image']; ?>" class="card-img-top p-2">
                <div class="card-body">
                    <h5 class="card-title" style="margin-bottom: 0;"><?= $user['user_nama']; ?></h5>
                    <small class="text-muted" style="margin-top: 0; font-style: italic;"><?= $user['user_email']; ?></small>

                    <p class="card-text mt-3">Member since <?= date('d F Y', strtotime($user['dateCreated'])); ?></p>
                    <a href="#" class="btn btn-sm btn-dark" id="edit-profile"><i class="fas fa-fw fa-user-alt"></i> Edit Profile</a>
                    <a href="#" class="btn btn-sm btn-dark" id="change-password"><i class="fas fa-fw fa-key"></i> Change Password</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow password-card hide">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Change password</h6>
                </div>
                <div class="card-body">
                    <p>Please, keep your password secretly. Do not tell anyone about your password!</p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="old-password">Current password</label>
                            <input type="password" class="form-control" name="old-password" id="old-password">
                            <span class="old-password-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="newpassword-1">New password</label>
                            <input type="password" class="form-control" name="newpassword-1" id="newpassword-1">
                            <span class="newpassword-1-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="newpassword-2">Repeat new password</label>
                            <input type="password" class="form-control" name="newpassword-2" id="newpassword-2">
                            <span class="newpassword-2-error"></span>
                        </div>
                        <div class="form-group text-right ">
                            <button type="button" class="btn btn-sm btn-secondary" id="change-reset"><i class="fas fa-fw fa-times"></i> Cancel</button>
                            <button type="button" class="btn btn-sm btn-primary" id="change-form"><i class="fas fa-fw fa-edit"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow profile-card hide">
                <div class="card-header">
                    Edit Profile
                </div>
                <div class="card-body">
                    
                    <form method="POST" action="" id="form-edit-profile" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $user['user_email']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="<?= $user['user_nama']; ?>">
                            <span class="error_nama"></span>
                        </div>
                        <div class="form-group">
                            <label>Picture</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="<?= base_url(); ?>assets/img/profile/<?= $user['user_image']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file in JPEG, JPG, or PNG format</label>
                                    </div>
                                    <span class="error_file"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-sm btn-secondary" id="profile-reset"><i class="fas fa-fw fa-times"></i> Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary" id="profile-submit"><i class="fas fa-fw fa-edit"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        let base_url = '<?= base_url() ?>';

        $('#change-password').on('click', function(e) {
            $('.password-card').toggleClass('hide', false);
            $('.profile-card').toggleClass('hide', true);

            e.preventDefault();
        });

        $('#edit-profile').on('click', function(e) {
            $('.profile-card').toggleClass('hide', false);
            $('.password-card').toggleClass('hide', true);

            e.preventDefault();
        })

        $('#change-reset').on('click', function() {
            $('#old-password, #newpassword-1, #newpassword-2').val('');
            $('.password-card').toggleClass('hide', true);
        });
        
        $('#profile-reset').on('click', function() {
            $('.profile-card').toggleClass('hide', true);
        });

        $('#change-form').on('click', function(e) {
            let oldPassword = $('#old-password').val();
            let password1 = $('#newpassword-1').val();
            let password2 = $('#newpassword-2').val();

            $.ajax({
                url: base_url + 'user/ajaxChangePassword',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    oldPassword: oldPassword,
                    password1: password1,
                    password2: password2
                },
                success: function(hasil) {
                    console.log(hasil);
                    if (hasil.result == false) {
                        $('.old-password-error').html(hasil.error.oldPassword);
                        $('.newpassword-1-error').html(hasil.error.password1);
                        $('.newpassword-2-error').html(hasil.error.password2);
                        $('#old-password, #newpassword-1, #newpassword-2').val('');
                    } else if (hasil.result == 2) {
                        $('#old-password, #newpassword-1, #newpassword-2').val('');
                        Swal.fire({
                            icon: 'warning',
                            width: 600,
                            padding: '2em',
                            title: hasil.error.notif,
                            html: hasil.error.alert
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            width: 600,
                            padding: '2em',
                            title: 'Change password success!',
                            html: "Please keep your password secretly, do not let anyone knowing your password."
                        }).then((result) => {
                            document.location.href = base_url + 'user';
                        });
                    }
                }
            });

            e.preventDefault();
        });

        $('#form-edit-profile').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: base_url + 'user/editProfile',
                method: 'POST',
                dataType: 'JSON',
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                processData: false,
                success: function(hasil) {
                    console.log(hasil);
                    if(hasil.result == false) {
                        $('.error_nama').html(hasil.notif.name);
                        $('.error_file').html(hasil.notif.img);
                    } else {
                        Swal.fire({
                            icon: hasil.notif,
                            width: 600,
                            padding: '2em',
                            title: 'Update Profile ' + hasil.message,
                            html: "Selamat, profile kamu berhasil di update!."
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }, 
                error: function(hasil) {
                    console.log('error');
                    console.log(hasil);
                }
            });
        });
    });
</script>