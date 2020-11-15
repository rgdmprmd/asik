<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Controller auth, mengelola authentikasi user (registrasi, login, etc)
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
    }

    /* ------------------------------LOGIN--------------------------------------- */
    public function index()
    {
        // Cek apakah si user lagi login atau nga
        if ($this->session->userdata('email')) {
            // Jika lagi login, kembalikan ke user page
            redirect('user');
        }

        $data['title'] = 'Login';

        // Set rules untuk form login, cek email valid dan required
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        // Cek apakah validasi from berhasil
        if ($this->form_validation->run() == FALSE) {
            // Jika gagal, back to form login
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // Jika berhasil, jalankan method _login()
            $this->_login();
        }
    }

    private function _login()
    {
        // Tangkap input email dan password dari form login
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Cari user berdasarkan email yang di input, via model
        $user = $this->auth->getUserByEmail($email);

        // Cek, apakah user nya ada
        if ($user) {
            // Jika ada, cek apakah aktif?
            if ($user['user_status'] == 1) {
                // Jika aktif, cek kesesuaian password
                if (password_verify($password, $user['user_password'])) {
                    // jika sesuai, tangkap data user yang mau dimasukan kedalam session
                    $data = [
                        'email' => $user['user_email'],
                        'role_id' => $user['role_id']
                    ];

                    // Set session user
                    $this->session->set_userdata($data);

                    // Cek role user
                    if ($user['role_id'] == 1) {
                        // Jika id role = 1, arahkan ke admin page
                        redirect('admin');
                    } else {
                        // Jika id role != 1, arahkan ke user page
                        redirect('user');
                    }
                } else {
                    // Jika tidak sesuai, tampilkan pesan kesalahan
                    $this->session->set_flashdata('wpass', 'password');
                    redirect('auth');
                }
            } else {
                // Jika tidak aktif, tampilkan pesan kesalahan
                $this->session->set_flashdata('aemail', $email);
                redirect('auth');
            }
        } else {
            // Jika tidak ada, tampilkan pesan kesalahan
            $this->session->set_flashdata('wemail', $email);
            redirect('auth');
        }
    }

    /* ------------------------------REGIST--------------------------------------- */
    public function registration()
    {
        // Cek apakah si user lagi login atau nga
        if ($this->session->userdata('email')) {
            // Jika lagi login, kembalikan ke user page
            redirect('user');
        }

        $data['title'] = 'Registration Users';

        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/registration');
        $this->load->view('templates/auth_footer');
    }

    public function ajaxRegist()
    {
        // Cek apakah si user lagi login atau nga
        if ($this->session->userdata('email')) {
            // Jika lagi login, kembalikan ke user page
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.user_email]', ['is_unique' => 'Email has already registered!']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'Password is not match!', 'min_length' => 'Password is too short!']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'nama' => form_error('name', '<small class="text-danger pl-3">', '</small>'),
                'email' => form_error('email', '<small class="text-danger pl-3">', '</small>'),
                'password' => form_error('password1', '<small class="text-danger pl-3">', '</small>')
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            // Jika berhasil, tangkap data yang di input
            $emailRegister = htmlspecialchars($this->input->post('email', true));
            $nameRegister = htmlspecialchars($this->input->post('name', true));
            $passwordRegister = $this->input->post('password1');

            // Siapkan data yang akan di register
            $data = [
                'user_nama' => $nameRegister,
                'user_email' => $emailRegister,
                'user_image' => 'default.jpg',
                'user_password' => password_hash($passwordRegister, PASSWORD_DEFAULT),
                'role_id' => 2,
                'team_id' => 0,
                'owner_status' => 1,
                'user_status' => 0,
                'dateCreated' => Date('Y-m-d H:i:s'),
                'dateModified' => NULL
            ];

            // Buat token untuk verifikasi email
            $token = base64_encode(random_bytes(32));

            // Siapkan data yang akan di insert ke user_token
            $user_token = [
                'user_email' => $emailRegister,
                'token' => $token,
                'dateCreated' => Date('Y-m-d H:i:s')
            ];

            // Insert data user baru dan insert token untuk verifikasi email, via model
            $this->auth->setUser($data);
            $this->auth->setToken($user_token);

            // Setelah di insert, maka jalankan method _sendEmail untuk mengirimkan email verifkasi
            $this->_sendEmail($token, 'verify', $emailRegister);

            $result = [
                'result' => true,
                'error' => ''
            ];
            
            echo json_encode($result);
        }
    }

    /* ------------------------------EMAIL--------------------------------------- */
    private function _sendEmail($token, $type, $email)
    {
        // Config standar untuk sendEmail menggunakan GMAIL
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'badcodebutgoodjoke@gmail.com',
            'smtp_pass' => 'Rangga@123',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        // Load library email beserta configurasinya
        $this->load->library('email', $config);
        $this->email->initialize($config);

        // Email nya nanti mau dikirim oleh siapa
        $this->email->from('badcodebutgoodjoke@gmail.com', 'Bad Code Society');

        // Email nya nanti mau dikirim ke siapa
        $this->email->to($email);

        // Jika tipenya verify tentukan subject dan messagenya
        if ($type == 'verify') {
            // Subject emailnya apa
            $this->email->subject('Account Verification');

            // Isi emailnya apa
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $email . '&token=' . urlencode($token) . '">Activate</a>.');
        } else if ($type == 'forgot') {
            // Jika tipenya forgot, Subject emailnya apa
            $this->email->subject('Reset Password');

            // Isi emailnya apa
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $email . '&token=' . urlencode($token) . '">Reset password</a>.');
        }

        // Cek apakah emailnya berhasil dikirm
        if ($this->email->send()) {
            // Jika berhasil return true
            return true;
        } else {
            // Jika gagal tampilkan errornya
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        // Tangkap email dan token dari URLs yang dikirimkan dari _sendEmail
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        // cari email dari table user berdasarkan email yang dikirmkan melalui URLs, via model
        $user = $this->auth->getUserByEmail($email);

        // Cek apakah usernya ada
        if ($user) {
            // Jika ada, cari token berdasarkan token yang dikirimkan melalui URLs, via model
            $user_token = $this->auth->getTokenByToken($token);

            // Cek, apakah token ketemu
            if ($user_token) {
                // Jika ketemu, cek apakah tokennya expired selama 24 jam
                if (time() - strtotime($user_token['dateCreated']) < (60 * 60 * 24)) {
                    // Jika blm expired, update user menjadi active dan hapus tokennya, via model
                    $this->auth->emailIsVerify($email);

                    // Tampilkan pesan berhasil dan redirect ke halaman login
                    $this->session->set_flashdata('stoken', $email);
                    redirect('auth');
                } else {
                    // Jika expired, maka hapus data user dan tokennya berdasarkan email yang dikirimkan, via model
                    $this->auth->verifyTokenIsExpired($email);

                    // Tampilkan pesan token expired, dan redirect ke halaman login
                    $this->session->set_flashdata('etoken', 'token');
                    redirect('auth');
                }
            } else {
                // Jika tokennya ga ketemu, tampilkan pesan error dan redirect ke halaman login
                $this->session->set_flashdata('wtoken', 'Activation');
                redirect('auth');
            }
        } else {
            // Jika usernya ga ada, tampilkan pesan email salah
            $this->session->set_flashdata('wemail', $email);
            redirect('auth');
        }
    }

    /* ------------------------------FORGOT--------------------------------------- */
    public function forgotPassword()
    {
        // Cek apakah si user lagi login atau nga
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = 'Forgot Password';
        
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/forgot-password');
        $this->load->view('templates/auth_footer');
    }

    public function ajaxForgot()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'email' => form_error('email', '<small class="text-danger pl-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $email = $this->input->post('email');
            $user = $this->auth->getActiveUserByEmail($email);

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'user_email' => $email,
                    'token' => $token,
                    'dateCreated' => Date('Y-m-d H:i:s')
                ];

                $this->auth->setToken($user_token);
                $this->_sendEmail($token, 'forgot', $email);

                $result = [
                    'result' => true,
                    'error' => 'Please check your email to reset your password.'
                ];
                
                echo json_encode($result);
            } else {
                $result = [
                    'result' => 'error-email',
                    'error' => $email
                ];
                
                echo json_encode($result);
            }
        }
    }

    public function resetPassword()
    {
        // Tangkap email dan token yang dikirimkan oleh URLs
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        // Cari user berdasarkan email yang dikirimkan
        $user = $this->auth->getUserByEmail($email);

        // Cek apakah usernya ada
        if ($user) {
            // Jika ada, maka cari tokennya
            $user_token = $this->auth->getTokenByToken($token);

            // Cek apakah tokennya ada
            if ($user_token) {
                // Jika ada, cek apakah tokennya expired atau blm 24 Jam
                if (time() - strtotime($user_token['dateCreated']) < (60 * 60 * 24)) {
                    // Jika blm expired, buat session reset_email yang menyimpan email dan jalankan method changePassword
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                } else {
                    // Jika expired, hapus data user dari table token, via model
                    $this->auth->forgotTokenIsExpired($email);

                    // Tampilkan pesan token expired
                    $this->session->set_flashdata('extoken', 'Reset Password');
                    redirect('auth');
                }
            } else {
                // Jika ga ada, tampilkan pesan token invalid
                $this->session->set_flashdata('wtoken', 'Reset Password');
                redirect('auth');
            }
        } else {
            // Jika ga ada, tampilkan pesan user tidak ditemukan
            $this->session->set_flashdata('wemail', $email);
            redirect('auth');
        }
    }

    public function changePassword()
    {
        // cek apakah session reset_email sudah dibuat
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        // set rules untuk change password
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[3]|matches[password1]');

        // cek validasi rules nya
        if ($this->form_validation->run() == FALSE) {
            // Jika gagal, back to form change password
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            // Jika berhasil, tangkap dan hash password yang di input
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

            // ambil email dari session reset_email
            $email = $this->session->userdata('reset_email');

            // ganti password user berdasarkan password yang dikirimkan dan hapus tokennya, via model
            $this->auth->changePassword($email, $password);
            $this->auth->forgotTokenIsExpired($email);

            // hapus sessionnya apabila password berhasil di ganti
            $this->session->unset_userdata('reset_email');

            // Tampilkan pesan ganti password berhasil
            $this->session->set_flashdata('sreset', 'Reset Password');
            redirect('auth');
        }
    }

    /* ------------------------------SESSION--------------------------------------- */
    public function blocked()
    {
        // Mengambil data user berdasarkan email yang dikirimkan oleh session
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();

        // Mencari menu yang ada, via model
        $data['menu'] = $this->auth->getMenu();
        $data['title'] = 'Access Forbidden';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('auth/blocked', $data);
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        // unset session yang ada
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        // Tampilkan pesan logout berhasil
        $this->session->set_flashdata('logout', 'Logout');
        redirect('auth');
    }
}