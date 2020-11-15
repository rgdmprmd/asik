<?php defined('BASEPATH') or exit('No direct script access allowed');

class Manager extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('Manager_model', 'manager');
        $this->load->library('pagination');
        $this->load->library('pdf_report');
    }

    public function meja()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['jenis'] = $this->manager->getJenisMeja();
        $data['title'] = 'Meja';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manager/meja', $data);
        $this->load->view('templates/footer');
    }

    public function ajaxNewMeja()
    {
        $this->form_validation->set_rules('meja_nomer', 'nomer meja', 'required|trim');
        $this->form_validation->set_rules('jumlah_kursi', 'jumlah kursi', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'meja_nomer' => form_error('meja_nomer', '<small class="text-danger pl-3">', '</small>'),
                'jumlah_kursi' => form_error('jumlah_kursi', '<small class="text-danger pl-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $nomerMeja = $this->input->post('meja_nomer', true);
            $jenisMeja = $this->input->post('meja_jenis', true);
            $statusMeja = $this->input->post('meja_status', true);
            $jumlahKursi = $this->input->post('jumlah_kursi', true);

            if ($jumlahKursi < 0) {
                $jumlahKursi *= -1;
            } else {
                $jumlahKursi;
            }

            $data = [
                'jenismeja_id' => $jenisMeja,
                'meja_nomer' => $nomerMeja,
                'isTaken' => $statusMeja,
                'kursi_tersedia' => $jumlahKursi,
                'dateCreated' => Date('Y-m-d H:i:s'),
                'dateModified' => null,
                'email_input' => $this->session->userdata('email'),
                'email_update' => null
            ];

            $insertMeja = $this->manager->insert($data, 'meja');

            $result = [
                'result' => $insertMeja,
                'error' => 'Tambah'
            ];

            echo json_encode($result);
        }
    }

    public function ajaxNewJenisMeja()
    {
        $this->form_validation->set_rules('jenismeja_nama', 'jenis meja', 'required|trim');
        $this->form_validation->set_rules('jenismeja_kursi', 'jumlah kursi', 'required|trim');
        $this->form_validation->set_rules('jenismeja_desc', 'deskripsi meja', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'jenismeja_nama' => form_error('jenismeja_nama', '<small class="text-danger pl-3">', '</small>'),
                'jenismeja_kursi' => form_error('jenismeja_kursi', '<small class="text-danger pl-3">', '</small>'),
                'jenismeja_desc' => form_error('jenismeja_desc', '<small class="text-danger pl-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $jenisNama = $this->input->post('jenismeja_nama', true);
            $jenisKursi = $this->input->post('jenismeja_kursi', true);
            $jenisDesc = $this->input->post('jenismeja_desc', true);
            $jenisStatus = $this->input->post('jenismeja_status', true);

            if ($jenisKursi < 0) {
                $jenisKursi *= -1;
            } else {
                $jenisKursi;
            }

            $data = [
                'jenismeja_nama' => $jenisNama,
                'jenismeja_kursi' => $jenisKursi,
                'jenismeja_desc' => $jenisDesc,
                'email_input' => $this->session->userdata('email'),
                'email_update' => null,
                'dateCreated' => Date('Y-m-d H:i:s'),
                'dateModified' => null,
                'jenismeja_status' => $jenisStatus
            ];

            $insertJenis = $this->manager->insert($data, 'meja_jenis');

            $result = [
                'result' => $insertJenis,
                'error' => 'Tambah'
            ];

            echo json_encode($result);
        }
    }

    public function ajaxUpdateMeja()
    {
        $this->form_validation->set_rules('meja_nomer', 'nomer meja', 'required|trim');
        $this->form_validation->set_rules('jumlah_kursi', 'jumlah kursi', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'meja_nomer' => form_error('meja_nomer', '<small class="text-danger pl-3">', '</small>'),
                'jumlah_kursi' => form_error('jumlah_kursi', '<small class="text-danger pl-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $idMeja = $this->input->post('meja_id', true);
            $nomerMeja = $this->input->post('meja_nomer', true);
            $jenisMeja = $this->input->post('meja_jenis', true);
            $statusMeja = $this->input->post('meja_status', true);
            $jumlahKursi = $this->input->post('jumlah_kursi', true);

            if ($jumlahKursi < 0) {
                $jumlahKursi *= -1;
            } else {
                $jumlahKursi;
            }

            $data = [
                'jenismeja_id' => $jenisMeja,
                'meja_nomer' => $nomerMeja,
                'isTaken' => $statusMeja,
                'kursi_tersedia' => $jumlahKursi,
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email'),
            ];

            $updateMeja = $this->manager->updateMeja($data, $idMeja);

            $result = [
                'result' => $updateMeja,
                'error' => 'Update'
            ];

            echo json_encode($result);
        }
    }

    public function ajaxUpdateJenisMeja()
    {
        $this->form_validation->set_rules('jenismeja_nama', 'jenis meja', 'required|trim');
        $this->form_validation->set_rules('jenismeja_kursi', 'jumlah kursi', 'required|trim');
        $this->form_validation->set_rules('jenismeja_desc', 'deskripsi meja', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'jenismeja_nama' => form_error('jenismeja_nama', '<small class="text-danger pl-3">', '</small>'),
                'jenismeja_kursi' => form_error('jenismeja_kursi', '<small class="text-danger pl-3">', '</small>'),
                'jenismeja_desc' => form_error('jenismeja_desc', '<small class="text-danger pl-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $jenisId = $this->input->post('jenismeja_id', true);
            $jenisNama = $this->input->post('jenismeja_nama', true);
            $jenisKursi = $this->input->post('jenismeja_kursi', true);
            $jenisDesc = $this->input->post('jenismeja_desc', true);
            $jenisStatus = $this->input->post('jenismeja_status', true);

            if ($jenisKursi < 0) {
                $jenisKursi *= -1;
            } else {
                $jenisKursi;
            }

            $data = [
                'jenismeja_nama' => $jenisNama,
                'jenismeja_kursi' => $jenisKursi,
                'jenismeja_desc' => $jenisDesc,
                'email_update' => $this->session->userdata('email'),
                'dateModified' => Date('Y-m-d H:i:s'),
                'jenismeja_status' => $jenisStatus
            ];

            $updateMeja = $this->manager->updateJenisMeja($data, $jenisId);

            $result = [
                'result' => $updateMeja,
                'error' => 'Update'
            ];

            echo json_encode($result);
        }
    }

    public function getData()
    {
        $status = $this->input->post('status', true);
        $search = $this->input->post('search', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 12;

        $data = $this->manager->getAllMeja($status, $search, $limit, $offset);
        $tr = '';
        $cr = '';
        $paging = '';

        if ($data['total'] > 0) {

            $total = $data['total'];
            $i = $offset + 1;
            $j = 1;

            foreach ($data['data'] as $m) {
                $cr .= '<div class="col-lg-3 mb-3">';
                $cr .= '<div class="card card-meja">';
                $cr .= '<a href="#" class="streched-links meja-edit" data-id="' . $m['meja_id'] . '" data-toggle="modal" data-target="#newMeja">';
                $cr .= '<img src="' . base_url() . 'assets/img/illustrat/undraw_eating_together_tjhx.svg" class="card-img-top p-3 gambar-meja" width="20px">';
                $cr .= '</a>';
                $cr .= '<div class="card-body">';
                if ($m['isTaken'] == 1) {
                    $cr .= '<h5>Meja ' . $m['meja_nomer'] . ' <span class="badge badge-danger p-2">Taken</span></h5>';
                } else {
                    $cr .= '<h5>Meja ' . $m['meja_nomer'] . ' <span class="badge badge-success p-2">Available</span></h5>';
                }
                $cr .= '<small >' . $m['jenismeja_nama'] . ' - ' . $m['kursi_tersedia'] . ' kursi</small><br>';
                $cr .= '<span class="card-text">' . $m['jenismeja_desc'] . '</span>';
                $cr .= '</div>';
                $cr .= '</div>';
                $cr .= '</div>';

                $tr .= '<tr>';
                $tr .= '<td class="text-center">' . $i . '</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="btn btn-success btn-sm px-3 meja-edit" data-id="' . $m['meja_id'] . '" data-toggle="modal" data-target="#newMeja"><i class="fas fa-fw fa-edit"></i> Update</a>';
                $tr .= '</td>';
                $tr .= '<td class="text-center">' . $m['meja_nomer'] . '</td>';
                $tr .= '<td class="text-center">' . $m['jenismeja_nama'] . '</td>';
                if ($m['isTaken'] == 1) {
                    $tr .= '<td class="text-center text-danger"><b>Taken</b></td>';
                } else {
                    $tr .= '<td class="text-center text-success"><b>Available</b></td>';
                }
                $tr .= '<td class="text-center">' . $m['kursi_tersedia'] . '</td>';
                $tr .= '</tr>';


                ++$i;
                ++$j;
            }

            $paging .= $this->_paging($total, $limit, 'getData');
            $paging .= '<span class="page-info">Displaying ' . ($i - 1) . ' of ' . $total . ' data</span>';
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="6">No data</td>';
            $tr .= '</tr>';
        }

        $result = [
            'result' => true,
            'error' => $paging,
            'hasil' => $tr,
            'card' => $cr
        ];

        echo json_encode($result);
    }

    public function getJenis()
    {
        $status = $this->input->post('status', true);
        $search = $this->input->post('search', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 5;

        $data = $this->manager->getAllJenisMeja($status, $search, $limit, $offset);
        $tr = '';
        $paging = '';

        if ($data['total'] > 0) {

            $total = $data['total'];
            $i = $offset + 1;
            $j = 1;

            foreach ($data['data'] as $m) {
                $tr .= '<tr>';
                $tr .= '<td class="text-center">' . $i . '</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="btn btn-success btn-sm px-3 jenismeja-edit" data-id="' . $m['jenismeja_id'] . '" data-toggle="modal" data-target="#newJenisMeja"><i class="fas fa-fw fa-edit"></i> Update</a>';
                $tr .= '</td>';
                $tr .= '<td class="text-center">' . $m['jenismeja_nama'] . '</td>';
                $tr .= '<td class="text-center">' . $m['jenismeja_kursi'] . ' Kursi</td>';
                if ($m['jenismeja_status'] == 1) {
                    $tr .= '<td class="text-center text-success"><b>Active</b></td>';
                } else {
                    $tr .= '<td class="text-center text-danger"><b>Denied</b></td>';
                }
                $tr .= '<td class="text-center">' . substr($m['jenismeja_desc'], 0, 30) . '...</td>';
                $tr .= '</tr>';

                ++$i;
                ++$j;
            }

            $paging .= $this->_paging($total, $limit, 'getJenis');
            $paging .= '<span class="page-info">Displaying ' . ($i - 1) . ' of ' . $total . ' data</span>';
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="6">No data</td>';
            $tr .= '</tr>';
        }

        $result = [
            'result' => true,
            'error' => $paging,
            'hasil' => $tr
        ];

        echo json_encode($result);
    }

    public function ajaxGetMejaById()
    {
        $id = $this->input->post('idJson', true);
        $meja = $this->manager->getMejaById($id);
        echo json_encode($meja);
    }

    public function ajaxGetJenisMejaById()
    {
        $id = $this->input->post('idJson', true);
        $meja = $this->manager->getJenisMejaById($id);
        echo json_encode($meja);
    }

    public function menu()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['jenis'] = $this->manager->jenisMenuActive();
        $data['title'] = 'Menu';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manager/menu', $data);
        $this->load->view('templates/footer');
    }

    public function ajaxNewJenisMenu()
    {
        $this->form_validation->set_rules('makananjenis_nama', 'jenis menu', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'makananjenis_nama' => form_error('makananjenis_nama', '<small class="text-danger pl-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $jenisNama = $this->input->post('makananjenis_nama', true);
            $jenisStatus = $this->input->post('makananjenis_status', true);

            $data = [
                'makananjenis_nama' => $jenisNama,
                'makananjenis_status' => $jenisStatus,
                'dateCreated' => Date('Y-m-d H:i:s'),
                'dateModified' => null,
                'email_input' => $this->session->userdata('email'),
                'email_update' => null
            ];

            $insertJenis = $this->manager->insert($data, 'menu_jenis');

            $result = [
                'result' => $insertJenis,
                'error' => 'Tambah'
            ];

            echo json_encode($result);
        }
    }

    public function getJenisMenu()
    {
        $status = $this->input->post('status', true);
        $search = $this->input->post('search', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 5;

        $data = $this->manager->getAllJenisMenu($status, $search, $limit, $offset);
        $tr = '';
        $paging = '';

        if ($data['total'] > 0) {

            $total = $data['total'];
            $i = $offset + 1;
            $j = 1;

            foreach ($data['data'] as $m) {
                $tr .= '<tr>';
                $tr .= '<td class="text-center">' . $i . '</td>';
                $tr .= '<td class="text-center">' . $m['makananjenis_nama'] . '</td>';
                if ($m['makananjenis_status'] == 1) {
                    $tr .= '<td class="text-center text-success"><b>Active</b></td>';
                } else {
                    $tr .= '<td class="text-center text-danger"><b>Denied</b></td>';
                }
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="btn btn-success btn-sm px-3 jenismenu-edit" data-id="' . $m['makananjenis_id'] . '" data-toggle="modal" data-target="#newJenisMenu"><i class="fas fa-fw fa-edit"></i> Update</a>';
                $tr .= '</td>';
                $tr .= '</tr>';

                ++$i;
                ++$j;
            }

            $paging .= $this->_paging($total, $limit, 'getJenisMenu');
            $paging .= '<span class="page-info">Displaying ' . ($i - 1) . ' of ' . $total . ' data</span>';
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="6">No data</td>';
            $tr .= '</tr>';
        }

        $result = [
            'result' => true,
            'error' => $paging,
            'hasil' => $tr
        ];

        echo json_encode($result);
    }

    public function ajaxGetJenisMenuById()
    {
        $id = $this->input->post('idJson', true);
        $jenisMenu = $this->manager->getJenisMenuById($id);
        echo json_encode($jenisMenu);
    }

    public function ajaxUpdateJenisMenu()
    {
        $this->form_validation->set_rules('makananjenis_nama', 'jenis menu', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'makananjenis_nama' => form_error('makananjenis_nama', '<small class="text-danger pl-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $jenisId = $this->input->post('makananjenis_id', true);
            $jenisNama = $this->input->post('makananjenis_nama', true);
            $jenisStatus = $this->input->post('makananjenis_status', true);

            $data = [
                'makananjenis_nama' => $jenisNama,
                'makananjenis_status' => $jenisStatus,
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email'),
            ];

            $updateJenisMenu = $this->manager->updateJenisMenu($data, $jenisId);

            $result = [
                'result' => $updateJenisMenu,
                'error' => 'Update'
            ];

            echo json_encode($result);
        }
    }

    public function ajaxGetJenisMenuActive()
    {
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = $this->input->get('limit') ? $this->input->get('limit') : 3;
        $search = $this->input->get('search', true);

        $offset = ($page - 1) * $limit;

        $jenisMenu = $this->manager->getJenisMenuActive($offset, $limit, $search);

        echo json_encode($jenisMenu);
    }

    public function ajaxNewMenuMakanan()
    {
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/img/food_porn/';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('jenismakanan_id', 'jenis menu', 'required|trim');
        $this->form_validation->set_rules('makanan_nama', 'nama menu', 'required|trim');
        $this->form_validation->set_rules('makanan_hpp', 'hpp menu', 'required|trim');
        $this->form_validation->set_rules('makanan_harga', 'harga menu', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'jenismakanan_id' => form_error('jenismakanan_id', '<small class="text-danger pl-3">', '</small>'),
                'makanan_nama' => form_error('makanan_nama', '<small class="text-danger pl-3">', '</small>'),
                'makanan_hpp' => form_error('makanan_hpp', '<small class="text-danger pl-3">', '</small>'),
                'makanan_harga' => form_error('makanan_harga', '<small class="text-danger pl-3">', '</small>'),
                'img' => '<small class="text-danger pl-3 mt-2">' . $this->upload->display_errors() . '</small>'
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $jenisId = $this->input->post('jenismakanan_id', true);
            $makananNama = $this->input->post('makanan_nama', true);
            $makananHpp = $this->input->post('makanan_hpp', true);
            $makananHarga = $this->input->post('makanan_harga', true);
            $makananDesc = $this->input->post('makanan_desc', true);
            $makananStatus = $this->input->post('makanan_status', true);
            $data = [];
            $uploadImage = $_FILES['makanan_img']['name'];

            if ($uploadImage) {

                if ($this->upload->do_upload('makanan_img')) {

                    $newImage = $this->upload->data('file_name');

                    $data = [
                        'makananjenis_id' => $jenisId,
                        'makanan_nama' => $makananNama,
                        'makanan_desc' => $makananDesc,
                        'makanan_img' => $newImage,
                        'makanan_harga' => $makananHarga,
                        'makanan_hpp' => $makananHpp,
                        'makanan_status' => $makananStatus,
                        'dateCreated' => Date('Y-m-d H:i:s'),
                        'dateModified' => null,
                        'email_input' => $this->session->userdata('email'),
                        'email_update' => null
                    ];
                } else {
                    $formEror = [
                        'jenismakanan_id' => form_error('jenismakanan_id', '<small class="text-danger pl-3">', '</small>'),
                        'makanan_nama' => form_error('makanan_nama', '<small class="text-danger pl-3">', '</small>'),
                        'makanan_hpp' => form_error('makanan_hpp', '<small class="text-danger pl-3">', '</small>'),
                        'makanan_harga' => form_error('makanan_harga', '<small class="text-danger pl-3">', '</small>'),
                        'img' => '<small class="text-danger pl-3 mt-2">' . $this->upload->display_errors() . '</small>'
                    ];

                    $result = [
                        'result' => false,
                        'error' => $formEror
                    ];

                    echo json_encode($result);
                }
            } else {
                $data = [
                    'makananjenis_id' => $jenisId,
                    'makanan_nama' => $makananNama,
                    'makanan_desc' => $makananDesc,
                    'makanan_img' => 'default.gif',
                    'makanan_harga' => $makananHarga,
                    'makanan_hpp' => $makananHpp,
                    'makanan_status' => $makananStatus,
                    'dateCreated' => Date('Y-m-d H:i:s'),
                    'dateModified' => null,
                    'email_input' => $this->session->userdata('email'),
                    'email_update' => null
                ];
            }

            $insertMenuMakanan = $this->manager->insert($data, 'menu_makanan');

            $result = [
                'result' => $insertMenuMakanan,
                'error' => 'Tambah'
            ];

            echo json_encode($result);
        }
    }

    public function getMenuMakanan()
    {
        $status = $this->input->post('status', true);
        $search = $this->input->post('search', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 5;

        $data = $this->manager->getAllMenuMakanan($status, $search, $limit, $offset);
        $tr = '';
        $cr = '';
        $paging = '';

        if ($data['total'] > 0) {

            $total = $data['total'];
            $i = $offset + 1;
            $j = 1;

            foreach ($data['data'] as $m) {
                $cr .= '<div class="col-lg-3 mb-3">';
                $cr .= '<div class="card card-menu">';
                $cr .= '<a href="#" class="streched-links menu-edit" data-id="' . $m['makanan_id'] . '" data-toggle="modal" data-target="#newMenuMakanan">';
                $cr .= '<img src="' . base_url() . 'assets/img/food_porn/' . $m['makanan_img'] . '" class="card-img-top p-3 gambar-meja" width="20px">';
                $cr .= '</a>';
                $cr .= '<div class="card-body">';
                $cr .= '<h5>' . $m['makanan_nama'] . ' <span class="badge badge-success p-2"></span></h5>';
                $cr .= '<small >' . $m['makananjenis_nama'] . ' - Rp. ' . number_format($m['makanan_harga'], 0, '.', ',') . '</small><br>';
                if (strlen($m['makanan_desc']) > 51) {
                    $cr .= '<span class="card-text">' . substr($m['makanan_desc'], 0, 51) . '...</span>';
                } else {
                    $cr .= '<span class="card-text">' . $m['makanan_desc'] . '</span>';
                }
                $cr .= '</div>';
                $cr .= '</div>';
                $cr .= '</div>';

                $tr .= '<tr>';
                $tr .= '<td class="text-center">' . $i . '</td>';
                $tr .= '<td class="text-center">' . $m['makanan_nama'] . '</td>';
                $tr .= '<td class="text-center">' . $m['makananjenis_nama'] . '</td>';
                $tr .= '<td class="text-center">Rp. ' . number_format($m['makanan_hpp'], 0, '.', ',') . '</td>';
                $tr .= '<td class="text-center">Rp. ' . number_format($m['makanan_harga'], 0, '.', ',') . '</td>';
                if ($m['makanan_status'] == 1) {
                    $tr .= '<td class="text-center text-success"><b>Active</b></td>';
                } else {
                    $tr .= '<td class="text-center text-danger"><b>Denied</b></td>';
                }
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="btn btn-success btn-sm px-3 menu-edit" data-id="' . $m['makanan_id'] . '" data-toggle="modal" data-target="#newMenuMakanan"><i class="fas fa-fw fa-edit"></i> Update</a>';
                $tr .= '</td>';
                $tr .= '</tr>';

                ++$i;
                ++$j;
            }

            $paging .= $this->_paging($total, $limit, 'getMenuMakanan');
            $paging .= '<span class="page-info">Displaying ' . ($i - 1) . ' of ' . $total . ' data</span>';
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="6">No data</td>';
            $tr .= '</tr>';
        }

        $result = [
            'result' => true,
            'error' => $paging,
            'hasil' => $tr,
            'card' => $cr
        ];

        echo json_encode($result);
    }

    private function _paging($total, $limit, $modul)
    {
        $config = [
            'base_url'  => base_url() . 'manager/' . $modul,
            'total_rows' => $total,
            'per_page'  => $limit,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }

    public function ajaxGetMenuById()
    {
        $id = $this->input->post('idJson', true);
        $menu = $this->manager->getMenuById($id);
        echo json_encode($menu);
    }

    public function ajaxUpdateMenuMakanan()
    {
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/img/food_porn/';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('jenismakanan_id', 'jenis menu', 'required|trim');
        $this->form_validation->set_rules('makanan_nama', 'nama menu', 'required|trim');
        $this->form_validation->set_rules('makanan_hpp', 'hpp menu', 'required|trim');
        $this->form_validation->set_rules('makanan_harga', 'harga menu', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'jenismakanan_id' => form_error('jenismakanan_id', '<small class="text-danger pl-3">', '</small>'),
                'makanan_nama' => form_error('makanan_nama', '<small class="text-danger pl-3">', '</small>'),
                'makanan_hpp' => form_error('makanan_hpp', '<small class="text-danger pl-3">', '</small>'),
                'makanan_harga' => form_error('makanan_harga', '<small class="text-danger pl-3">', '</small>'),
                'img' => '<small class="text-danger pl-3 mt-2">' . $this->upload->display_errors() . '</small>'
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $jenisId = $this->input->post('jenismakanan_id', true);
            $makananId = $this->input->post('makanan_id', true);
            $makananNama = $this->input->post('makanan_nama', true);
            $makananHpp = $this->input->post('makanan_hpp', true);
            $makananHarga = $this->input->post('makanan_harga', true);
            $makananDesc = $this->input->post('makanan_desc', true);
            $makananStatus = $this->input->post('makanan_status', true);
            $oldImg = $this->input->post('old_img', true);
            $data = [];
            $uploadImage = $_FILES['makanan_img']['name'];

            if ($uploadImage) {

                if ($this->upload->do_upload('makanan_img')) {

                    $newImage = $this->upload->data('file_name');

                    if ($oldImg != 'default.gif') {
                        unlink(FCPATH . 'assets/img/food_porn/' . $oldImg);
                    }

                    $data = [
                        'makananjenis_id' => $jenisId,
                        'makanan_nama' => $makananNama,
                        'makanan_desc' => $makananDesc,
                        'makanan_img' => $newImage,
                        'makanan_harga' => $makananHarga,
                        'makanan_hpp' => $makananHpp,
                        'makanan_status' => $makananStatus,
                        'dateModified' => Date('Y-m-d H:i:s'),
                        'email_update' => $this->session->userdata('email'),
                    ];
                } else {
                    $formEror = [
                        'jenismakanan_id' => form_error('jenismakanan_id', '<small class="text-danger pl-3">', '</small>'),
                        'makanan_nama' => form_error('makanan_nama', '<small class="text-danger pl-3">', '</small>'),
                        'makanan_hpp' => form_error('makanan_hpp', '<small class="text-danger pl-3">', '</small>'),
                        'makanan_harga' => form_error('makanan_harga', '<small class="text-danger pl-3">', '</small>'),
                        'img' => '<small class="text-danger pl-3 mt-2">' . $this->upload->display_errors() . '</small>'
                    ];

                    $result = [
                        'result' => false,
                        'error' => $formEror
                    ];

                    echo json_encode($result);
                }
            } else {
                $data = [
                    'makananjenis_id' => $jenisId,
                    'makanan_nama' => $makananNama,
                    'makanan_desc' => $makananDesc,
                    'makanan_img' => $oldImg,
                    'makanan_harga' => $makananHarga,
                    'makanan_hpp' => $makananHpp,
                    'makanan_status' => $makananStatus,
                    'dateModified' => Date('Y-m-d H:i:s'),
                    'email_update' => $this->session->userdata('email'),
                ];
            }

            $updateMenuMakanan = $this->manager->updateMenuMakanan($data, $makananId);

            $result = [
                'result' => $updateMenuMakanan,
                'error' => 'Update'
            ];

            echo json_encode($result);
        }
    }

    public function pesanan()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['title'] = 'Pesanan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manager/pesanan', $data);
        $this->load->view('templates/footer');
    }

    public function ajaxGetMenu()
    {
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = $this->input->get('limit') ? $this->input->get('limit') : 3;
        $search = $this->input->get('search', true);

        $offset = ($page - 1) * $limit;

        $menu = $this->manager->getMenuActive($offset, $limit, $search);

        echo json_encode($menu);
    }

    public function ajaxGetMeja()
    {
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = $this->input->get('limit') ? $this->input->get('limit') : 3;
        $search = $this->input->get('search', true);
        $jumlah_tamu = $this->input->get('jumlah_tamu', true);

        $offset = ($page - 1) * $limit;

        $meja = $this->manager->getMejaActive($offset, $limit, $search, $jumlah_tamu);

        echo json_encode($meja);
    }

    public function ajaxNewPesanan()
    {
        $this->form_validation->set_rules('meja_id', 'Nomer meja', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'meja_id' => form_error('meja_id', '<small class="text-danger pl-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $jumlah_tamu = $this->input->post('jumlah_tamu', true);
            $mejaId = $this->input->post('meja_id', true);
            $pesanan_email = $this->input->post('pesanan_email', true);
            $grandtotal = $this->input->post('grandtotal', true);
            $data = $this->input->post('item', true);

            $meja = $this->manager->getMejaById($mejaId);
            $kursiTersedia = $meja['kursi_tersedia'] - $jumlah_tamu;

            $detail = [];

            $updateMeja = [
                'isTaken' => 1,
                'kursi_tersedia' => $kursiTersedia,
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];

            $this->manager->updateMeja($updateMeja, $mejaId);

            $header = [
                'meja_id' => $mejaId,
                'pesanan_email' => $pesanan_email,
                'jumlah_tamu' => $jumlah_tamu,
                'pesanan_total' => $grandtotal,
                'pesanan_status' =>  0,
                'dateCreated' => Date('Y-m-d H:i:s'),
                'dateModified' => null,
                'email_input' => $this->session->userdata('email'),
                'email_update' => null
            ];

            $pesananHeader = $this->manager->insertPesananHeader($header);

            foreach ($data as $d) {
                $detail[] = [
                    'pesanan_id' => $pesananHeader,
                    'makanan_id' => $d['makanan_id'],
                    'qty_pesanan' => $d['qty'],
                    'total_pesanan' => $d['makanan_total'],
                    'detpesanan_status' => 0,
                    'dateCreated' => Date('Y-m-d H:i:s'),
                    'dateModified' => null,
                    'email_input' => $this->session->userdata('email'),
                    'email_update' => null
                ];
            }

            $pesananDetail = $this->manager->insertPesananDetail($detail);

            $result = [
                'result' => $pesananDetail,
                'error' => 'Tambah'
            ];

            echo json_encode($result);
        }
    }

    public function getPesanan()
    {
        $status = $this->input->post('status', true);
        $search = $this->input->post('search', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 5;

        $data = $this->manager->getAllPesanan($status, $search, $limit, $offset);
        $tr = '';
        $paging = '';

        if ($data['total'] > 0) {

            $total = $data['total'];
            $i = $offset + 1;
            $j = 1;

            foreach ($data['data'] as $m) {
                $tr .= '<tr>';
                $tr .= '<td class="text-center">' . $i . '</td>';
                $tr .= '<td class="text-center">' . $m['meja_nomer'] . '</td>';
                $tr .= '<td class="text-center">Rp. ' . number_format($m['pesanan_total'], 0, '.', ',') . '</td>';
                if ($m['pesanan_status'] == 0) {
                    $tr .= '<td class="text-center text-danger"><b>Pending</b></td>';
                } else if ($m['pesanan_status'] == 1) {
                    $tr .= '<td class="text-center text-warning"><b>Ready</b></td>';
                } else if ($m['pesanan_status'] == 2) {
                    $tr .= '<td class="text-center text-info"><b>Served</b></td>';
                } else if ($m['pesanan_status'] == 3) {
                    $tr .= '<td class="text-center text-success"><b>Paid</b></td>';
                } else if ($m['pesanan_status'] == 4) {
                    $tr .= '<td class="text-center text-primary"><b>Finish</b></td>';
                }
                $tr .= '<td class="text-center">';
                if ($m['pesanan_status'] == 4) {
                    $tr .= '<a href="" class="btn btn-success btn-sm px-3 pesanan-edit mr-1 disabled" aria-disabled="true"><i class="fas fa-fw fa-edit"></i> Reorder</a>';
                    $tr .= '<a href="" class="btn btn-info btn-sm px-3 pesanan-payment mr-1 disabled" aria-disabled="true"><i class="fas fa-fw fa-receipt"></i> Bill</a>';
                    $tr .= '<a href="" class="btn btn-primary btn-sm px-3 pesanan-detail" data-id="' . $m['pesanan_id'] . '" data-toggle="modal" data-target="#pesananDetail"><i class="fas fa-fw fa-cog"></i> Detail</a>';
                } else {
                    $tr .= '<a href="" class="btn btn-success btn-sm px-3 pesanan-edit mr-1" data-id="' . $m['pesanan_id'] . '" data-toggle="modal" data-target="#newPesananModal"><i class="fas fa-fw fa-edit"></i> Reorder</a>';
                    $tr .= '<a href="" class="btn btn-info btn-sm px-3 pesanan-payment mr-1" data-id="' . $m['pesanan_id'] . '" data-toggle="modal" data-target="#newBillModal"><i class="fas fa-fw fa-receipt"></i> Bill</a>';
                    $tr .= '<a href="" class="btn btn-primary btn-sm px-3 pesanan-detail" data-id="' . $m['pesanan_id'] . '" data-toggle="modal" data-target="#pesananDetail"><i class="fas fa-fw fa-cog"></i> Detail</a>';
                }
                $tr .= '</td>';
                $tr .= '</tr>';

                ++$i;
                ++$j;
            }

            $paging .= $this->_paging($total, $limit, 'getPesanan');
            $paging .= '<span class="page-info">Displaying ' . ($i - 1) . ' of ' . $total . ' data</span>';
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="5">No data</td>';
            $tr .= '</tr>';
        }

        $result = [
            'result' => true,
            'error' => $paging,
            'hasil' => $tr
        ];

        echo json_encode($result);
    }

    public function ajaxGetPesananById()
    {
        $id = $this->input->post('idJson', true);
        $header = $this->manager->getHeaderPesananById($id);
        $detail = $this->manager->getDetailPesananById($id);

        $result = [
            'header' => $header,
            'detail' => $detail
        ];

        echo json_encode($result);
    }

    public function ajaxDetailPesananReady()
    {
        $id = $this->input->post('idJson', true);
        $headid = $this->input->post('headid', true);

        $data = [
            'detpesanan_status' => 1,
            'dateModified' => Date('Y-m-d H:i:s'),
            'email_update' => $this->session->userdata('email')
        ];

        $result = $this->manager->updateStatusDetailPesanan($data, $id);
        $detail = $this->manager->getPesananReady($headid);

        if ($detail > 0) {

            echo json_encode($result);
        } else {
            $updateHeader = [
                'pesanan_status' => 1,
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];

            $header = $this->manager->updateStatusPesananHeader($updateHeader, $headid);
            echo json_encode($header);
        }
    }

    public function ajaxUpdateStatusHeaderPesanan()
    {
        $id = $this->input->post('idJson', true);
        $status = $this->input->post('status', true);

        if ($status == 4) {
            $pesanan = $this->manager->getHeaderPesananById($id);

            $mejaUpdate = [
                'isTaken' => 0,
                'kursi_tersedia' => $pesanan['kursi_tersedia'] + $pesanan['jumlah_tamu'],
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];

            $this->manager->updateMeja($mejaUpdate, $pesanan['meja_id']);

            $data = [
                'pesanan_status' => $status,
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];

            $result = $this->manager->updateStatusPesananHeader($data, $id);
        } else {
            $data = [
                'pesanan_status' => $status,
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];

            $result = $this->manager->updateStatusPesananHeader($data, $id);
        }

        echo json_encode($result);
    }

    public function updateMenuDetail()
    {
        $grandtotal = $this->input->post('grandtotal', true);
        $pesananId = $this->input->post('pesanan_id', true);
        $data = $this->input->post('item', true);

        $header = [
            'pesanan_total' => $grandtotal,
            'pesanan_status' =>  0,
            'dateModified' => Date('Y-m-d H:i:s'),
            'email_update' => $this->session->userdata('email'),
        ];

        $this->manager->updatePesananHeader($header, $pesananId);

        foreach ($data as $d) {
            $detail[] = [
                'pesanan_id' => $pesananId,
                'makanan_id' => $d['makanan_id'],
                'qty_pesanan' => $d['qty'],
                'total_pesanan' => $d['makanan_total'],
                'detpesanan_status' => 0,
                'dateCreated' => Date('Y-m-d H:i:s'),
                'dateModified' => null,
                'email_input' => $this->session->userdata('email'),
                'email_update' => null
            ];
        }

        $pesananDetail = $this->manager->insertPesananDetail($detail);

        $result = [
            'result' => $pesananDetail,
            'error' => 'Reorder'
        ];

        echo json_encode($result);
    }

    public function payment()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['title'] = 'Payment';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manager/payment', $data);
        $this->load->view('templates/footer');
    }

    public function setBill()
    {
        $this->form_validation->set_rules('payment_email', 'Nomer meja', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $formEror = [
                'payment_email' => form_error('payment_email', '<small class="text-danger pl-3">', '</small>'),
            ];

            $result = [
                'result' => false,
                'error' => $formEror
            ];

            echo json_encode($result);
        } else {
            $pesananid = $this->input->post('pesanan_id_bill', true);
            $method = $this->input->post('payment_method', true);
            $telp = $this->input->post('payment_telp', true);
            $card = $this->input->post('payment_card', true);
            $mail = $this->input->post('payment_email', true);
            $pesanan = $this->input->post('pesanan_payment', true);
            $tax = $this->input->post('payment_tax', true);
            $grandtot = $this->input->post('grandtotal_payment', true);
            $item = $this->input->post('item', true);

            $data = [
                'pesanan_id' => $pesananid,
                'payment_email' => $mail,
                'payment_pesanan' => $pesanan,
                'payment_tax' => $tax,
                'payment_total' => $grandtot,
                'item' => $item
            ];

            $this->_cetakBill($data);

            $setBil = [
                'pesanan_id' => $pesananid,
                'payment_method' => $method,
                'payment_card' => $card,
                'payment_telp' => $telp,
                'payment_email' => $mail,
                'payment_tax' => $tax,
                'payment_total' => $grandtot,
                'email_input' => $this->session->userdata('email'),
                'email_update' => null,
                'dateCreated' => Date('Y-m-d H:i:s'),
                'dateModified' => null,
                'payment_status' => 0
            ];

            // $this->manager->setBill($setBil);

            $result = [
                'result' => true,
                'error' => 'Tambah'
            ];

            echo json_encode($result);
        }
    }

    private function _cetakBill($data)
    {
        $height = 100;
        $width = 160;
        // create new PDF document
        $pdf = new TCPDF('P', 'MM', array($width, $height), true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Rangga D. Permadi');
        $pdf->SetTitle('Bill');
        $pdf->SetSubject('Bill Discode Cafe');
        $pdf->SetKeywords('Bill');

        // set header and footer fonts
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $img_file = base_url('assets/img/illustrat/wrinkled-paper-texture.jpg');
        $pdf->setImageScale(1);
        $pdf->AddPage();
        $wd = $pdf->getPageWidth();
        $hg = $pdf->getPageHeight();
        $pdf->SetAutoPageBreak(false, 0);
        $pdf->Image($img_file, 0, 0, $wd, $hg, '', '', '', false, 300, '', false, false, 0);

        // add a page
        // $pdf->AddPage();
        $pdf->Cell(150, 10, " ", 0, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('courier', 'B', 24);
        $pdf->Cell(145, 2, "DISCODE CAFE", 0, 1, 'C');
        $pdf->Ln();
        $pdf->SetFont('courier', '', 12);
        $pdf->Cell(70, 5, "ORDER #" . Date('Ym') . str_pad($data['pesanan_id'], 4, '0', STR_PAD_LEFT) . " FOR " . strtoupper($data['payment_email']), 0);
        $pdf->Ln();
        $pdf->Cell(70, 5, Date('l, F j, Y, g:i a'), 0);
        $pdf->Ln();
        $pdf->Cell(170, 5, "------------------------------------------------------", 0);
        $pdf->Ln();
        $pdf->Cell(100, 5, "ITEM", 0);
        $pdf->Cell(20, 5, "QTY", 0, 0, 'C');
        $pdf->Cell(20, 5, "AMT", 0, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(170, 5, "------------------------------------------------------", 0);
        $pdf->Ln();
        foreach ($data['item'] as $itm) {
            $pdf->Cell(100, 5, strtoupper($itm['makanan_nama']), 0);
            $pdf->Cell(20, 5, $itm['qty'], 0, 0, 'C');
            $pdf->Cell(20, 5, number_format($itm['makanan_total'], 0, '.', ','), 0, 0, 'R');
            $pdf->Ln();
        }
        $pdf->Cell(170, 5, "------------------------------------------------------", 0);
        $pdf->Ln();
        $pdf->Cell(100, 5, "TOTAL PESANAN");
        $pdf->Cell(40, 5, number_format($data['payment_pesanan'], 0, '.', ','), 0, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(100, 5, "TAX");
        $pdf->Cell(40, 5, number_format($data['payment_tax'], 0, '.', ','), 0, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(100, 5, "TOTAL");
        $pdf->Cell(40, 5, number_format($data['payment_total'], 0, '.', ','), 0, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(170, 5, "------------------------------------------------------", 0);

        // move pointer to last page
        $pdf->lastPage();

        // ---------------------------------------------------------

        //Close and output PDF document
        ob_clean();
        $pdf->Output('Bill-' . Date('d-m-Y H:i:s') . '.pdf', 'I');
    }
}
