<?php defined('BASEPATH') or exit('No direct script access allowed');

class Waiters extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('Waiters_model', 'waiters');
        $this->load->library('pagination');
    }

    public function meja()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['title'] = 'Meja';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('waiters/meja', $data);
        $this->load->view('templates/footer');
    }

    public function getMeja()
    {
        $status = $this->input->post('status', true);
        $search = $this->input->post('search', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 12;

        $data = $this->waiters->getAllMeja($status, $search, $limit, $offset);
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

    public function menu()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['jenis'] = $this->waiters->jenisMenuActive();
        $data['title'] = 'Menu';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('waiters/menu', $data);
        $this->load->view('templates/footer');
    }

    public function getMenu()
    {
        $status = $this->input->post('status', true);
        $search = $this->input->post('search', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 5;

        $data = $this->waiters->getAllMenuMakanan($status, $search, $limit, $offset);
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
                $cr .= '<img src="' . base_url() . 'assets/img/food_porn/' . $m['makanan_img'] . '" class="card-img-top p-3 gambar-meja" width="20px">';
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
                $tr .= '</tr>';

                ++$i;
                ++$j;
            }

            $paging .= $this->_paging($total, $limit, 'getMenu');
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

    public function pesanan()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['title'] = 'Pesanan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('waiters/pesanan', $data);
        $this->load->view('templates/footer');
    }

    public function getPesanan()
    {
        $status = $this->input->post('status', true);
        $search = $this->input->post('search', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 5;

        $data = $this->waiters->getAllPesanan($status, $search, $limit, $offset);
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
                    $tr .= '<a href="" class="btn btn-primary btn-sm px-3 pesanan-detail" data-id="' . $m['pesanan_id'] . '" data-toggle="modal" data-target="#pesananDetail"><i class="fas fa-fw fa-cog"></i> Detail</a>';
                } else {
                    $tr .= '<a href="" class="btn btn-success btn-sm px-3 pesanan-edit mr-1" data-id="' . $m['pesanan_id'] . '" data-toggle="modal" data-target="#newPesananModal"><i class="fas fa-fw fa-edit"></i> Reorder</a>';
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

    public function ajaxGetMeja()
    {
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = $this->input->get('limit') ? $this->input->get('limit') : 3;
        $search = $this->input->get('search', true);
        $jumlah_tamu = $this->input->get('jumlah_tamu', true);

        $offset = ($page - 1) * $limit;

        $meja = $this->waiters->getMejaActive($offset, $limit, $search, $jumlah_tamu);

        echo json_encode($meja);
    }

    public function ajaxGetMenu()
    {
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = $this->input->get('limit') ? $this->input->get('limit') : 3;
        $search = $this->input->get('search', true);

        $offset = ($page - 1) * $limit;

        $menu = $this->waiters->getMenuActive($offset, $limit, $search);

        echo json_encode($menu);
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
            $grandtotal = $this->input->post('grandtotal', true);
            $data = $this->input->post('item', true);

            $meja = $this->waiters->getMejaById($mejaId);
            $kursiTersedia = $meja['kursi_tersedia'] - $jumlah_tamu;

            $detail = [];

            $updateMeja = [
                'isTaken' => 1,
                'kursi_tersedia' => $kursiTersedia,
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];

            $this->waiters->updateMeja($updateMeja, $mejaId);

            $header = [
                'meja_id' => $mejaId,
                'jumlah_tamu' => $jumlah_tamu,
                'pesanan_total' => $grandtotal,
                'pesanan_status' =>  0,
                'dateCreated' => Date('Y-m-d H:i:s'),
                'dateModified' => null,
                'email_input' => $this->session->userdata('email'),
                'email_update' => null
            ];

            $pesananHeader = $this->waiters->insertPesananHeader($header);

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

            $pesananDetail = $this->waiters->insertPesananDetail($detail);

            $result = [
                'result' => $pesananDetail,
                'error' => 'Tambah'
            ];

            echo json_encode($result);
        }
    }

    public function ajaxGetPesananById()
    {
        $id = $this->input->post('idJson', true);
        $header = $this->waiters->getHeaderPesananById($id);
        $detail = $this->waiters->getDetailPesananById($id);

        $result = [
            'header' => $header,
            'detail' => $detail
        ];

        echo json_encode($result);
    }

    public function updateMenuDetail()
    {
        $pesananId = $this->input->post('pesanan_id', true);
        $data = $this->input->post('item', true);

        $header = [
            'pesanan_status' =>  0,
            'dateModified' => Date('Y-m-d H:i:s'),
            'email_update' => $this->session->userdata('email'),
        ];

        $this->waiters->updatePesananHeader($header, $pesananId);

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

        $pesananDetail = $this->waiters->insertPesananDetail($detail);

        $result = [
            'result' => $pesananDetail,
            'error' => 'Reorder'
        ];

        echo json_encode($result);
    }

    public function ajaxUpdateStatusHeaderPesanan()
    {
        $id = $this->input->post('idJson', true);
        $status = $this->input->post('status', true);

        if ($status == 4) {
            $pesanan = $this->waiters->getHeaderPesananById($id);

            $mejaUpdate = [
                'isTaken' => 0,
                'kursi_tersedia' => $pesanan['kursi_tersedia'] + $pesanan['jumlah_tamu'],
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];

            $this->waiters->updateMeja($mejaUpdate, $pesanan['meja_id']);

            $data = [
                'pesanan_status' => $status,
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];

            $result = $this->waiters->updateStatusPesananHeader($data, $id);
        } else {
            $data = [
                'pesanan_status' => $status,
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];

            $result = $this->waiters->updateStatusPesananHeader($data, $id);
        }

        echo json_encode($result);
    }

    private function _paging($total, $limit, $modul)
    {
        $config = [
            'base_url'  => base_url() . 'waiters/' . $modul,
            'total_rows' => $total,
            'per_page'  => $limit,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }
}