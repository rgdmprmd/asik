<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Forgot your password?</h1>
                                </div>

                                <!-- Sweet alert catch up -->
                                <div class="success-forgot" data-sforgot="<?= $this->session->flashdata('sforgot'); ?>"></div>
                                <div class="wrong-forgot" data-wforgot="<?= $this->session->flashdata('wforgot'); ?>"></div>


                                <form class="user" method="POST" action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email address" autocomplete="off">
                                        <span class="email-error"></span>
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="button" name="submit" id="btn-forgot" class="btn btn-primary btn-user btn-block">
                                        Continue
                                    </button>
                                </form>
                                <div class="text-left mt-1">
                                    <span class="small text-muted">Made up your mind? </span><a class="small" href="<?= base_url(); ?>auth">Back to login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    let base_url = '<?= base_url(); ?>';

    $('#btn-forgot').on('click', function(e) {
        let email = $('#email').val();

        $.ajax({
            url: base_url + 'auth/ajaxForgot',
            method: 'POST',
            dataType: 'JSON',
            data: {
                email: email
            },
            success: function(hasil) {
                console.log(hasil);
                if (hasil.result == false) {
                    $('.email-error').html(hasil.error.email);
                } else if (hasil.result == 'error-email') {
                    Swal.fire({
                        icon: 'warning',
                        width: 600,
                        padding: '2em',
                        title: 'Oops, wrong email!',
                        html: "<span class='text-primary'>" + hasil.error + "</span> is not registered or activated."
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        width: 800,
                        padding: '2em',
                        title: 'Forgot password success, but..!',
                        html: "It's not finish yet, you must check your email to reset your password."
                    }).then((result) => {
                        // Jika tombol ya ditekan, maka redirect bedasarkan href tombol yang diklik
                        document.location.href = base_url + 'auth/forgotpassword';
                    });
                }
            }
        });

        e.preventDefault();
    });
});
</script>