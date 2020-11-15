<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card card-primary o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <b class="h3 text-gray-900 mb-4"><strong>Welcome back!</strong></b>
                                    <p class="text-muted">We're so excited to see you again!</p>
                                </div>

                                <!-- Sweet alert catch up -->
                                <div class="hidden">
                                    <div class="wrong-email" data-wemail="<?= $this->session->flashdata('wemail'); ?>"></div>
                                    <div class="active-email" data-aemail="<?= $this->session->flashdata('aemail'); ?>"></div>
                                    <div class="wrong-password" data-wpass="<?= $this->session->flashdata('wpass'); ?>"></div>
                                    <div class="registration-success" data-regsucs="<?= $this->session->flashdata('regsucs'); ?>"></div>
                                    <div class="wrong-token" data-wtoken="<?= $this->session->flashdata('wtoken'); ?>"></div>
                                    <div class="expired-token" data-etoken="<?= $this->session->flashdata('etoken'); ?>"></div>
                                    <div class="success-token" data-stoken="<?= $this->session->flashdata('stoken'); ?>"></div>
                                    <div class="ex-token" data-extoken="<?= $this->session->flashdata('extoken'); ?>"></div>
                                    <div class="success-reset" data-sreset="<?= $this->session->flashdata('sreset'); ?>"></div>
                                    <div class="logout" data-logout="<?= $this->session->flashdata('logout'); ?>"></div>
                                </div>

                                <form class="user mt-5" method="POST" action="<?= base_url(); ?>auth">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email address" autocomplete="off" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <a class="small" href="<?= base_url(); ?>auth/forgotpassword">Forgot your password?</a>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <div class="text-left mt-1">
                                    <span class=" small text-muted">Need an account? </span><a class="small" href="<?= base_url(); ?>auth/registration">Register!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>