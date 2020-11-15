<?php defined('BASEPATH') or exit('No direct script access allowed');

class kitchen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('Kitchen_model', 'kitchen');
        $this->load->library('pagination');
    }

    public function menu()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['jenis'] = $this->kitchen->jenisMenuActive();
        $data['title'] = 'Menu';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kitchen/menu', $data);
        $this->load->view('templates/footer');
    }

    public function ajaxGetAllMenu()
    {
        $status = $this->input->post('status', true);
        $search = $this->input->post('search', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 8;

        $data = $this->kitchen->getAllMenu($status, $search, $limit, $offset);
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
                $tr .= '</tr>';

                ++$i;
                ++$j;
            }

            $paging .= $this->_paging($total, $limit, 'ajaxGetAllMenu');
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
        $this->load->view('kitchen/pesanan', $data);
        $this->load->view('templates/footer');
    }

    public function ajaxGetPesanan()
    {
        $search = $this->input->post('search', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 5;

        $data = $this->kitchen->getAllPesanan($search, $limit, $offset);
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
                $tr .= '<td class="text-center">' . Date('H:i:s', strtotime($m['tgl'])) . '</td>';
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
                $tr .= '<a href="" class="btn btn-primary btn-sm px-3 pesanan-detail" data-id="' . $m['pesanan_id'] . '" data-toggle="modal" data-target="#pesananDetail"><i class="fas fa-fw fa-cog"></i> Detail</a>';
                $tr .= '</td>';
                $tr .= '</tr>';

                ++$i;
                ++$j;
            }

            $paging .= $this->_paging($total, $limit, 'getPesanan');
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

    public function ajaxGetPesananById()
    {
        $id = $this->input->post('idJson', true);
        $header = $this->kitchen->getHeaderPesananById($id);
        $detail = $this->kitchen->getDetailPesananById($id);

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

        $result = $this->kitchen->updateStatusDetailPesanan($data, $id);
        $detail = $this->kitchen->getPesananReady($headid);

        if ($detail > 0) {

            echo json_encode($result);
        } else {
            $updateHeader = [
                'pesanan_status' => 1,
                'dateModified' => Date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];

            $header = $this->kitchen->updateStatusPesananHeader($updateHeader, $headid);
            echo json_encode($header);
        }
    }

    private function _paging($total, $limit, $modul)
    {
        $config = [
            'base_url'  => base_url() . 'kitchen/' . $modul,
            'total_rows' => $total,
            'per_page'  => $limit,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }
}