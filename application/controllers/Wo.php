<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 *
 */
class Wo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //Check Auth
        if (!$this->session->userdata('is_login')) {
            redirect('login');
        }

        //load the model class
        $this->load->model('wo_model');
    }

    public function index()
    {
        if (!$this->general->privilege_check(INPUT_WO, 'view')) {
            $this->general->no_access();
        }

        $data = array(
            'title' => 'Input Data WO',
            'area_id' => $this->session->userdata('area_id'),
            'css' => array(
                base_url('assets/css/bootstrap-datepicker.min.css'),
                base_url('assets/js/plugins/pnotify/pnotify.custom.min.css'),
                base_url('assets/js/plugins/select2/select2.min.css'),
                base_url('assets/css/jquery-ui.css')
            ),
            'js' => array(
                base_url('assets/js/bootstrap-datepicker.min.js'),
                base_url('assets/js/plugins/pnotify/pnotify.custom.min.js'),
                base_url('assets/js/plugins/select2/select2.min.js'),
                base_url('assets/js/jquery-ui.js')
            )

        );

        $this->_render('wo_view', $data);
    }

    private function _render($view, $data = array())
    {
        $this->load->view('header', $data);
        $this->load->view('sidebar');
        $this->load->view($view, $data);
        $this->load->view('footer');
    }

    public function print_wo_header($id = null)
    {
        if (!$id) {
            show_404();
        }
        $wo = $this->wo_model->print_wo($id);
        $data = array(
            'title' => 'Print WO Header',
            'result' => $wo
        );
        $this->_render('print_wo_header_view', $data);
    }

    public function loadPrinterWoHeader($id)
    {
        $wo = $this->wo_model->print_wo($id);

        $raw_wo = $this->_constructRawWoHeader($wo);
        $data = array(
            'raw_wo' => $raw_wo
        );

        $this->load->view('printer_config', $data);
    }

    private function _converDate($date, $time = false)
    {
        if ($time) {
            return date('d/m/Y H:i', strtotime($date));
        }
        return date('d/m/Y', strtotime($date));
    }

    public function _constructRawWoHeader($data)
    {
        //load library
        $this->load->library('tabletext');
        $this->load->helper('text');

        $header = $data['header'][0];

        $max_char = 79;
        $this->tabletext->init($max_char, 4, "", " ", " ");
        $tgl_cetak = date('d-m-Y');
        $this->tabletext
            ->addColumn(' PT. DIMARCO MITRA UTAMA', 2, 'left')
            ->commit('header')
            ->addColumn('Komp. Roxy Mas Blok D4 No.1', 2, 'left')
            ->commit('header')
            ->addColumn('Jakarta Pusat (021)638 58 233', 2, 'left')
            ->commit('header')
            //adding vertical space
            ->addColumn(str_pad('', 37, ' ', STR_PAD_BOTH), 4, 'left')
            ->commit('header')
            ->addColumn(str_pad('', 37, ' ', STR_PAD_BOTH), 4, 'left')
            ->commit('header')
            ->addColumn(str_pad('', 37, ' ', STR_PAD_BOTH), 4, 'left')
            ->commit('header')
            ->addColumn(str_pad('', 37, ' ', STR_PAD_BOTH), 4, 'left')
            ->commit('header')
            ->addColumn(str_pad('', 37, ' ', STR_PAD_BOTH), 4, 'left')
            ->commit('header')
            ->addColumn(str_pad('', 37, ' ', STR_PAD_BOTH), 4, 'left')
            ->commit('header')
            ->addColumn(str_pad('', 37, ' ', STR_PAD_BOTH), 4, 'left')
            ->commit('header')
            // end long vertical space
            ->addColumn('Nama Member' . str_pad('', 9, ' ', STR_PAD_LEFT) . ': ' . $header['nama_pemilik'], 3, 'left')
            ->commit('header')
            ->addColumn('Nama Konsumen' . str_pad('', 7, ' ', STR_PAD_LEFT) . ': ' . $header['konsumen'], 3, 'left')
            ->commit('header')
            ->addColumn('No Kartu Garansi' . str_pad('', 4, ' ', STR_PAD_LEFT) . ': ' . $header['nama_pemilik'], 2, 'left')
            ->addColumn(str_pad('', 10, ' ', STR_PAD_LEFT) . 'No WO   : ' . $header['no_doc'], 2, 'left')
            ->commit('header')
            ->addColumn('Tgl Pembelian Brg' . str_pad('', 3, ' ', STR_PAD_LEFT) . ': ' . $this->_converDate($header['dt_kwitansi_pembelian']), 2, 'left')
            ->addColumn(str_pad('', 10, ' ', STR_PAD_LEFT) . 'Tgl WO  : ' . $this->_converDate($header['dt_doc'], true), 2, 'left')
            ->commit('header')
            ->addColumn('Status Garansi' . str_pad('', 6, ' ', STR_PAD_LEFT) . ': ' . $header['status_garansi'], 4, 'left')
            ->commit('header')
            ->addColumn('Alamat' . str_pad('', 14, ' ', STR_PAD_LEFT) . ': ' . $header['address'], 3, 'left')
            ->commit('header')
            ->addColumn(str_pad('', 37, ' ', STR_PAD_BOTH), 4, 'left')
            ->commit('header')
            ->addColumn(str_pad('', 37, ' ', STR_PAD_BOTH), 4, 'left')
            ->commit('header')
            ->addColumn('No Telp' . str_pad('', 13, ' ', STR_PAD_LEFT) . ': ' . $header['telp'], 2, 'left')
            ->commit('header')
            ->addColumn('Nama Barang' . str_pad('', 9, ' ', STR_PAD_LEFT) . ': ' . $header['product_name'], 2, 'left')
            ->commit('header')
            ->addColumn('Size' . str_pad('', 16, ' ', STR_PAD_LEFT) . ': ' . $header['size'], 2, 'left')
            ->commit('header')
            ->addColumn('Type' . str_pad('', 16, ' ', STR_PAD_LEFT) . ': ' . $header['type'], 2, 'left')
            ->commit('header')
            ->addColumn('Warna' . str_pad('', 15, ' ', STR_PAD_LEFT) . ': ' . $header['colour'], 2, 'left')
            ->commit('header')
            ->addColumn('Serial Number' . str_pad('', 7, ' ', STR_PAD_LEFT) . ': ' . $header['serial_number'], 3, 'left')
            ->commit('header')
            ->addColumn('Kelengkapan' . str_pad('', 9, ' ', STR_PAD_LEFT) . ': ' . $header['kelengkapan'], 4, 'left')
            ->commit('header')
            ->addColumn('Jenis Kerusakan' . str_pad('', 5, ' ', STR_PAD_LEFT) . ': ' . $header['jenis_kerusakan_text'], 3, 'left')
            ->commit('header')
            ->addColumn('Keterangan' . str_pad('', 10, ' ', STR_PAD_LEFT) . ': ' . $header['keterangan'], 4, 'left')
            ->commit('header');

        $rs =  $this->tabletext->getText();

        return str_replace('0', 'O', trim($rs));
    }

    public function print_wo_detail($id = null)
    {
        if (!$id) {
            show_404();
        }
        $wo = $this->wo_model->print_wo($id);
        $data = array(
            'title' => 'Print WO Detail',
            'result' => $wo
        );
        $this->_render('print_wo_view', $data);
    }

    public function loadPrinterWoDetail($id)
    {
        $detail = $this->wo_model->print_wo($id);
        $raw_wo = $this->_constructRawWoDetail($detail);
        $data = array(
            'raw_wo' => $raw_wo
        );

        $this->load->view('printer_config', $data);
    }

    private function _constructRawWoDetail($data)
    {
        //load library
        $this->load->library('tabletext');
        $this->load->helper('text');

        /**
         * @param table width
         * @param column number
         * @param bodyspace
         * @param line
         * @param border
         */
        $header = $data['header'][0];
        $detail = $data['detail'];
        $header['discount'] = 0;

        $max_char = 79;
        $this->tabletext->init($max_char, 4, "", " ", " ");
        $tgl_cetak = date('d-m-Y');
        $vspace = "";
        //adding long vertical space
        for ($i = 0; $i < 30; $i++) {
            $vspace .= "\n";
        }

        $this->tabletext
            ->setColumnLength(0, 10)
            ->setColumnLength(1, 35)
            ->setColumnLength(2, 6)
            ->setColumnLength(3, 10)
            ->setColumnLength(4, 15);

        // kerusakan detail & service Action
        $this->tabletext
            ->addColumn($header['kerusakan_detail_text'] . ' ' . $header['service_action_text'], 4, 'left')
            ->commit('body');

        // adding line
        $this->tabletext->addColumn(str_pad("", $max_char, "-"), 4, "left")->commit("body");

        $this->tabletext->addColumn("Code", 1, "center")
            ->addColumn("Sparepart", 1, "center")
            ->addColumn("Qty", 1, "center")
            ->addColumn("Price", 1, "center")
            ->addColumn("Total", 1, "center")
            ->commit("body");
        // adding line
        $this->tabletext->addColumn(str_pad("", $max_char, "-"), 4, "left")->commit("body");

        //Detail
        $counter = 1;
        foreach ($detail as $dt) {

            //char O (zero withour dot in the middle)
            //good for printing
            //the default given by the keyboard is 0 (zero with middle dot)
            $code = $dt['product_id'];
            $product = ($dt['no_int_product']) ? $dt['product_name'] : $dt['jasa_name'];
            //content
            $this->tabletext
                ->addColumn($code, 1)
                ->addColumn($product, 1)
                ->addColumn(number_format($dt['qty'], 0, '', '') . '   ', 1, 'right')
                ->addColumn(number_format($dt['price'], 0, '.', ',') . '  ', 1, 'right')
                ->addColumn(number_format($dt['amt_total'], 0, '.', ',') . '    ', 1, 'right')
                ->commit('body');

            $counter++;
        }
        // adding vertical space, maksimum 5 line
        for ($i = 0; $i < (5 - $counter); $i++) {
            $this->tabletext
                ->addColumn(str_pad('', $max_char, ' ', STR_PAD_BOTH), 4, 'left')
                ->commit('body');
        }

        $this->tabletext->setColumnLength(0, 37)
            ->setColumnLength(1, 10)
            ->setUseBodySpace(false);

        //Long Address should be conditioned
        $address = $header['address'];
        $address_len = strlen($address);
        $char_take = 35; //chars

        $footer = $this->tabletext
            ->addColumn("", 2, "left")
            ->addColumn("Subtotal   ", 1, "right")
            ->addColumn(number_format($header['grandtotal'] + $header['discount'], 0, ".", ",") . '    ', 1, "right")
            ->commit("footer");
        if ($address_len <= $char_take) {
            $footer->addColumn(" ", 2, "left")
                ->addColumn("Discount   ", 1, "right")
                ->addColumn(number_format($header['discount'], 0, '.', ',') . '    ', 1, "right")
                ->commit("footer")
                ->addColumn("Grandtotal   ", 3, "right")
                ->addColumn(number_format($header['grandtotal'], 0, '.', ',') . '    ', 1, "right")
                ->commit("footer");
        } else {

            $address_1 = substr($address, 0, $char_take);
            $address_2 = substr($address, $char_take, ((int)$address_len - $char_take));
            $footer->addColumn("Discount   ", 1, "right")
                ->addColumn(number_format($header['discount'], 0, '.', ',') . '    ', 1, "right")
                ->commit("footer")
                ->addColumn($address_2, 2, "left")
                ->addColumn("Grandtotal   ", 1, "right")
                ->addColumn(number_format($header['grandtotal'], 0, '.', ',') . '    ', 1, "right")
                ->commit("footer");
        }
        // adding line
        $this->tabletext->addColumn(str_pad("", $max_char, "-"), 4, "left")->commit("footer");

        // teknisis & tgl selesai
        $this->tabletext
            ->addColumn('Oleh ' . $header['teknisi'] . ' ' . $this->_converDate($header['date_done']), 4, 'left')
            ->commit('footer');

        $rs =  $this->tabletext->getText();

        return $vspace . str_replace('0', 'O', rtrim($rs));
    }

    private function _constructRawWoDetail_bk($data)
    {
        //load library
        $this->load->library('tabletext');
        $this->load->helper('text');

        /**
         * @param table width
         * @param column number
         * @param bodyspace
         * @param line
         * @param border
         */
        $header = $data['header'][0];
        $detail = $data['detail'];
        $header['discount'] = 0;

        $max_char = 79;
        $this->tabletext->init($max_char, 4, "", " ", " ");
        $tgl_cetak = date('d-m-Y');
        $vspace = "";
        //adding long vertical space
        for ($i = 0; $i < 30; $i++) {
            $vspace .= "\n";
        }

        $this->tabletext
            ->setColumnLength(0, 40)
            ->setColumnLength(1, 7)
            ->setColumnLength(2, 12)
            ->setColumnLength(3, 17);

        // kerusakan detail & service Action
        $this->tabletext
            ->addColumn($header['kerusakan_detail_text'] . ' ' . $header['service_action_text'], 4, 'left')
            ->commit('body');

        // adding line
        $this->tabletext->addColumn(str_pad("", $max_char, "-"), 4, "left")->commit("body");

        $this->tabletext->addColumn("Sparepart", 1, "center")
            ->addColumn("Qty", 1, "center")
            ->addColumn("Price", 1, "center")
            ->addColumn("Total", 1, "center")
            ->commit("body");
        // adding line
        $this->tabletext->addColumn(str_pad("", $max_char, "-"), 4, "left")->commit("body");

        //Detail
        $counter = 1;
        foreach ($detail as $dt) {

            //char O (zero withour dot in the middle)
            //good for printing
            //the default given by the keyboard is 0 (zero with middle dot)
            $product = ($dt['no_int_product']) ? $dt['product_name'] : $dt['jasa_name'];
            //content
            $this->tabletext
                ->addColumn($product, 1)
                ->addColumn(number_format($dt['qty'], 0, '', '') . '   ', 1, 'right')
                ->addColumn(number_format($dt['price'], 0, '.', ',') . '  ', 1, 'right')
                ->addColumn(number_format($dt['amt_total'], 0, '.', ',') . '    ', 1, 'right')
                ->commit('body');

            $counter++;
        }
        // adding vertical space, maksimum 5 line
        for ($i = 0; $i < (5 - $counter); $i++) {
            $this->tabletext
                ->addColumn(str_pad('', $max_char, ' ', STR_PAD_BOTH), 4, 'left')
                ->commit('body');
        }

        $this->tabletext->setColumnLength(0, 37)
            ->setColumnLength(1, 10)
            ->setUseBodySpace(false);

        //Long Address should be conditioned
        $address = $header['address'];
        $address_len = strlen($address);
        $char_take = 35; //chars

        $footer = $this->tabletext
            ->addColumn("", 2, "left")
            ->addColumn("Subtotal   ", 1, "right")
            ->addColumn(number_format($header['grandtotal'] + $header['discount'], 0, ".", ",") . '    ', 1, "right")
            ->commit("footer");
        if ($address_len <= $char_take) {
            $footer->addColumn(" ", 2, "left")
                ->addColumn("Discount   ", 1, "right")
                ->addColumn(number_format($header['discount'], 0, '.', ',') . '    ', 1, "right")
                ->commit("footer")
                ->addColumn("Grandtotal   ", 3, "right")
                ->addColumn(number_format($header['grandtotal'], 0, '.', ',') . '    ', 1, "right")
                ->commit("footer");
        } else {

            $address_1 = substr($address, 0, $char_take);
            $address_2 = substr($address, $char_take, ((int)$address_len - $char_take));
            $footer->addColumn("Discount   ", 1, "right")
                ->addColumn(number_format($header['discount'], 0, '.', ',') . '    ', 1, "right")
                ->commit("footer")
                ->addColumn($address_2, 2, "left")
                ->addColumn("Grandtotal   ", 1, "right")
                ->addColumn(number_format($header['grandtotal'], 0, '.', ',') . '    ', 1, "right")
                ->commit("footer");
        }
        // adding line
        $this->tabletext->addColumn(str_pad("", $max_char, "-"), 4, "left")->commit("footer");

        // teknisis & tgl selesai
        $this->tabletext
            ->addColumn('Oleh ' . $header['teknisi'] . ' ' . $this->_converDate($header['date_done']), 4, 'left')
            ->commit('footer');

        $rs =  $this->tabletext->getText();

        return $vspace . str_replace('0', 'O', rtrim($rs));
    }

    public function saveWo()
    {
        if (!$this->general->privilege_check(INPUT_WO, 'add')) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Error occured',
                'error' => 'Not authorized'
            ));
            exit;
        }

        $data = $this->input->post(null, true);

        $this->load->library('form_validation');

        $this->form_validation->set_rules($this->_form_rules());

        if ($this->form_validation->run() == false) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Error occured',
                'error' => validation_errors()
            ));
        } else {
            // save
            $this->wo_model->saveWo($data);

            echo json_encode(array(
                'status' => true,
                'message' => 'Berhasil disimpan'
            ));
        }
    }

    private function _form_rules()
    {
        return array(
            array(
                'field' => 'nama_customer', 'label' => 'Nama Member', 'rules' => 'required'
            ),
            array(
                'field' => 'konsumen', 'label' => 'Nama Konsumen', 'rules' => 'required'
            ),
            array(
                'field' => 'date_buying', 'label' => 'Tgl Pembelian', 'rules' => 'required'
            ),
            array(
                'field' => 'telp', 'label' => 'No Telp', 'rules' => 'required'
            ),
            array(
                'field' => 'no_int_product', 'label' => 'Nama Barang', 'rules' => 'required'
            ),
            array(
                'field' => 'area_id', 'label' => 'Area', 'rules' => 'required|numeric'
            ),
            array(
                'field' => 'serial_number', 'label' => 'Serial Number', 'rules' => 'required'
            ),
            array(
                'field' => 'kelengkapan', 'label' => 'Kelengkapan', 'rules' => 'required'
            ),
            array(
                'field' => 'keterangan', 'label' => 'Keterangan', 'rules' => 'required'
            )
        );
    }

    public function loadBiayaJasa()
    {
        $this->load->model('biaya_jasa_model');
        $data = $this->biaya_jasa_model->fetch();

        echo json_encode(array(
            'status' => true,
            'data' => $data
        ));
    }

    public function loadWo()
    {
        $limit = $this->config->item('limit');
        $offset = $this->uri->segment(4, 0);
        $search = $this->input->get('search', true);

        $data = $this->wo_model->loadWo($offset, $limit, $search);

        echo json_encode(array(
            'status' => true,
            'data' => $data,
            'paging' => $this->_paging($data['total'], $limit)
        ));
    }

    private function _paging($total, $limit)
    {
        $config = array(

            'base_url' => site_url() . 'sparepart/wo/loadWo',
            'total_rows' => $total,
            'per_page' => $limit,
            'uri_segment' => 4

        );
        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }

    private function _checkStock($data)
    {
        $no_int_product = array();
        $temp = array();
        foreach ($data['item'] as $k) {
            // ditch Jasa, only product needed
            if ($k['no_int_product']) {
                array_push($no_int_product, $k['no_int_product']);
                array_push($temp, array(
                    'no_int_product' =>  $k['no_int_product'],
                    'product_name' => $k['product_name'],
                    'qty' => $k['qty']
                ));
            }
        }

        $warehouse_id = $data['warehouse_id'];

        $stock = $this->wo_model->fetchStock($warehouse_id, $no_int_product);

        $error = '';

        foreach ($temp as $tp) {
            foreach ($stock as $s) {
                if ($tp['no_int_product'] == $s['no_int_product']) {
                    $saldo_akhir = (int)$s['saldo_akhir'];
                    if ((int)$tp['qty'] > $saldo_akhir) {
                        $error .= '<p>Stok <b>' . $tp['product_name'] . '</b> tidak mencukupi. Stok tersedia: <b>' . $saldo_akhir . '</b></p>';
                    }
                }
            }
        }

        if ($error) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Error occured',
                'error' => $error
            ));
            exit;
        }

        return true;
    }

    // Save Item SParepart
    public function saveItem()
    {
        $data = $this->input->post(null, true);

        $this->load->library('form_validation');

        $this->form_validation->set_rules(array(
            array(
                'field' => 'warehouse_id',
                'label' => 'Gudang',
                'rules' => 'required'
            ),
            array(
                'field' => 'item[]',
                'label' => 'Item',
                'rules' => 'required'
            )
        ));

        if ($this->form_validation->run() == false) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Error occured',
                'error' => validation_errors()
            ));
            exit;
        }

        // validate stock
        $this->_checkStock($data);

        $save = $this->wo_model->saveitem($data);

        if ($save) {
            echo json_encode(array(
                'status' => true,
                'message' => 'Berhasil disimpan'
            ));
        } else {
            echo json_encode(array(
                'status' => false,
                'message' => 'Error occured',
                'error' => 'Terjadi kesalahan, Silahkan coba lagi.'
            ));
        }
    }

    public function updateProgress()
    {
        $data = $this->input->post(null, true);

        if ($data['progress'] != 'PENDING PART') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(array(
                array(
                    'field' => 'progress',
                    'label' => 'Progress',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'teknisi_id',
                    'label' => 'Teknisi',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'date_job_assigned',
                    'label' => 'Tgl Assign',
                    'rules' => 'required'
                )
            ));

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array(
                    'status' => false,
                    'message' => 'Error occured',
                    'error' => validation_errors()
                ));
                exit;
            }
        }

        $this->wo_model->updateProgress($data);

        echo json_encode(array(
            'status' => true,
            'message' => 'Berhasil diupdate'
        ));
    }

    public function getDetailItem()
    {
        $no_int_wo = $this->input->get('no_int_wo', true);
        $data = $this->wo_model->fetchDetailItem($no_int_wo);
        echo json_encode(array(
            'status' => true,
            'message' => 'Berhasil',
            'data' => $data
        ));
    }

    public function getJenisKerusakan()
    {
        $data = $this->wo_model->fetchJenisKerusakan();
        echo json_encode(array(
            'status' => true,
            'message' => 'Berhasil',
            'data' => $data
        ));
    }

    public function getJenisKerusakanDetail()
    {
        $kerusakan_id = $this->input->get('kerusakan_id', true);
        $data = $this->wo_model->fetchJenisKerusakanDetail($kerusakan_id);
        echo json_encode(array(
            'status' => true,
            'message' => 'Berhasil',
            'data' => $data
        ));
    }

    public function getServiceAction()
    {
        $data = $this->wo_model->fetchServiceAction();
        echo json_encode(array(
            'status' => true,
            'message' => 'Berhasil',
            'data' => $data
        ));
    }

    public function getTeknisi()
    {
        $data = $this->wo_model->fetchTeknisi();
        echo json_encode(array(
            'status' => true,
            'message' => 'Berhasil',
            'data' => $data
        ));
    }

    public function getSerialNumber()
    {
        $search = $this->input->get('term', true);

        $result = $this->wo_model->fetchSerialNumber($search);
        //  $tot=100;
        /*
        echo json_encode(array(
          'results'=>$result,
          'total'=>$tot
        ));
        */
        echo json_encode($result);
    }

    public function getTglBeli()
    {
        $search = $this->input->get('term', true);

        $result = $this->wo_model->fetchTglBeli($search);

        echo json_encode($result);
    }

    public function getSerialNumber2()
    {
        //  $search = $this->input->get('term', true);
        $search = $_GET['term'];

        $result = $this->wo_model->fetchSerialNumber2($search);
        //  $tot=100;
        /*
        echo json_encode(array(
          'results'=>$result,
          'total'=>$tot
        ));
        */
        echo json_encode($result);
    }

    public function reqArea()
    {
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = $this->input->get('page_limit') ? $this->input->get('page_limit') : 20; //limit just 20 records
        $offset = ($page - 1) * $limit;

        $search = $this->input->get('term', true);

        $serial_number = $this->input->get('nilai_serial', true);

        $product_name = $this->input->get('ls_product_name', true);

        $type = $this->input->get('type', true);

        $area = $this->wo_model->loadArea($offset, $limit, $search, $type, $serial_number, $product_name);

        echo json_encode($area);
    }

    public function reqProduct()
    {
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = $this->input->get('page_limit') ? $this->input->get('page_limit') : 20; //limit just 20 records
        $offset = ($page - 1) * $limit;

        $search = $this->input->get('term', true);

        $serial_number = $this->input->get('serial_number', true);

        $id_category = $this->input->get('id_category', true);
        $type = $this->input->get('type', true);
        $divisi = $this->input->get('divisi', true);
        $product_name = $this->input->get('ls_product_name', true);
        if (!$id_category) {
            // try this one
            $id_category = $this->input->get('category_id', true);
        }

        $produk = $this->wo_model->loadProduct($offset, $limit, $search, $id_category, $type, $serial_number, $product_name, $divisi);

        echo json_encode($produk);
    }

    public function reqPiutangmbr()
    {
        $search = $this->input->get('term', true);

        $area_id = $this->input->get('area_id', true);

        $no_member = $this->input->get('no_member', true);

        $serial_number = $this->input->get('serial_number', true);

        $divisi = $this->input->get('divisi', true);

        $mm = $this->wo_model->loadPiutangmbr($search, $area_id, $no_member, $serial_number, $divisi);

        echo json_encode($mm);
    }

    public function test_sn()
    {
        $this->load->view('view_test_sn');
    }

    public function export()
    {
        $data = $this->input->post(null, true);
        $q = $data['search'];
        $tgl1 = $data['tgl1'];
        $tgl2 = $data['tgl2'];
        $result = $this->wo_model->getExport($q, $tgl1, $tgl2);

        //load librarinya
        $this->load->library('excel');

        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);

        //nama Sheet
        $this->excel->getActiveSheet()->setTitle('ListWo');
        //sheet aktif
        $sheet = $this->excel->getActiveSheet();

        if ($result['total'] > 0) {

            $sheet->setCellValue('A1', 'LIST WORK ORDER');
            $sheet->getStyle('A1')->getFont()->setBold(true);



            $cell = [
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
                'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI'
            ];
            $columns = [
                'Area',
                'Gudang',
                'No Doc',
                'TGL', 'Konsumen',
                'Produk',
                'Sparepart ID',
                'Sparepart',
                'qty',
                'Harga Sparepart',
                'Biaya Jasa',
                'No Kartu Garansi',
                'Tgl Pembelian', 'Garansi',
                'Alamat',
                'Telp',
                'Type',
                'Serial Number',
                'Kelengkapan',
                'Keterangan',
                'Jenis Kerusakan',
                'Kerusakan Detail',
                'Service Action',
                'Teknisi',
                'Pengambilan Customer',
                'Tgl Selesai',
                'Tgl Pengambilan',
                'id Input',
                'Tgl Input',
                'id update',
                'Tgl Update',
                'Total',
                'Progress',
                'Pending Part',
                'Progress Desc'
            ];


            $total = 0;

            $row_start = 3;
            foreach ($columns as $key => $val) {
                $idx = $cell[$key] . $row_start;
                $sheet->setCellValue($idx, $val);
                $sheet->getStyle($idx)->getFont()->setBold(true);
                $sheet->getStyle($idx)->getFont()->setSize(11);
            }
            //border header
            $sheet->getStyle('A3:AI3')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $i = 4; //baris 1 sudah dipesan buat header

            /*isi excel maka looping akan ke row (kebawah)*/
            foreach ($result['data'] as $ar) {
                $sheet->setCellValue('A' . $i, $ar->area_name);
                // $sheet->getStyle('A'.$i)->getFont()->setSize(10);

                $sheet->setCellValue('B' . $i, $ar->warehouse_name);
                // $sheet->getStyle('B'.$i)->getFont()->setSize(10);

                $sheet->setCellValue('C' . $i, $ar->no_doc);
                // $sheet->getStyle('C'.$i)->getFont()->setSize(10);

                $sheet->setCellValue('D' . $i, $ar->dt_doc);
                // $sheet->getStyle('D'.$i)->getFont()->setSize(10);
                // $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('#,##0');

                $sheet->setCellValue('E' . $i, $ar->konsumen);
                // $sheet->getStyle('E'.$i)->getFont()->setSize(10);
                // $sheet->getStyle('E'.$i)->getNumberFormat()->setFormatCode('#,##0');

                $sheet->setCellValue('F' . $i, $ar->product_name);
                // $sheet->getStyle('F'.$i)->getFont()->setSize(10);
                // $sheet->getStyle('F'.$i)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->setCellValue('G' . $i, $ar->sparepart_id);
                $sheet->setCellValue('H' . $i, $ar->sparepart);
                $sheet->setCellValue('I' . $i, $ar->qty);
                $sheet->getStyle('I' . $i)->getNumberFormat()->setFormatCode('#,##0');

                $sheet->setCellValue('J' . $i, $ar->price);
                $sheet->getStyle('J' . $i)->getNumberFormat()->setFormatCode('#,##0');

                $sheet->setCellValue('K' . $i, $ar->jasa_text);
                // // $sheet->getStyle('G'.$i)->getFont()->setSize(10);
                // $sheet->getStyle('G'.$i)->getNumberFormat()->setFormatCode('#,##0');

                $sheet->setCellValue('L' . $i, $ar->no_kartu_garansi);
                // // $sheet->getStyle('H'.$i)->getFont()->setSize(10);
                // $sheet->getStyle('H'.$i)->getNumberFormat()->setFormatCode('#,##0');

                $sheet->setCellValue('M' . $i, $ar->dt_kwitansi_pembelian);
                // // $sheet->getStyle('I'.$i)->getFont()->setSize(10);
                // $sheet->getStyle('I'.$i)->getNumberFormat()->setFormatCode('#,##0');

                $sheet->setCellValue('N' . $i, $ar->status_garansi);
                $sheet->setCellValue('O' . $i, $ar->address);
                $sheet->setCellValue('P' . $i, $ar->telp);
                $sheet->setCellValue('Q' . $i, $ar->type);
                $sheet->setCellValue('R' . $i, $ar->serial_number);
                $sheet->setCellValue('S' . $i, $ar->kelengkapan);
                $sheet->setCellValue('T' . $i, $ar->keterangan);
                $sheet->setCellValue('U' . $i, $ar->kerusakan);
                $sheet->setCellValue('V' . $i, $ar->kerusakan_detail_text);
                $sheet->setCellValue('W' . $i, $ar->service_action_text);
                $sheet->setCellValue('X' . $i, $ar->teknisi);
                $sheet->setCellValue('Y' . $i, $ar->taken);
                $sheet->setCellValue('Z' . $i, $ar->date_done);
                $sheet->setCellValue('AA' . $i, $ar->date_taken);
                $sheet->setCellValue('AB' . $i, $ar->id_input);
                $sheet->setCellValue('AC' . $i, $ar->dt_input);
                $sheet->setCellValue('AD' . $i, $ar->id_update);
                $sheet->setCellValue('AE' . $i, $ar->dt_update);
                $sheet->setCellValue('AF' . $i, $ar->grandtotal);
                $sheet->getStyle('AF' . $i)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->setCellValue('AG' . $i, $ar->progress);
                $sheet->setCellValue('AH' . $i, $ar->part_pending);
                $sheet->setCellValue('AI' . $i, $ar->progress_desc);
                // // $sheet->getStyle('J'.$i)->getFont()->setSize(10);
                // $sheet->getStyle('J'.$i)->getNumberFormat()->setFormatCode('#,##0');

                //border style row
                $sheet->getStyle('A' . $row_start . ':' . 'AI' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                // $sheet->getStyle('A'.$row_start.':'.'J'.$i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                // $sheet->getStyle('A'.$row_start.':'.'J'.$i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


                $total += $ar->grandtotal;

                ++$i;
            }

            //border footer
            $sheet->getStyle('A' . $i . ':' . 'AI' . $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $sheet->getStyle('A' . $i . ':' . 'AI' . $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            // $sheet->getStyle('A'.$i.':'.'J'.$i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            // $sheet->getStyle('A'.$i.':'.'J'.$i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->setCellValue('A' . $i, 'TOTAL');
            $sheet->mergeCells('A' . $i . ':' . 'C' . $i);
            $sheet->getStyle('A' . $i)->getFont()->setSize(11);
            $sheet->getStyle('A' . $i)->getFont()->setBold(true);
            $sheet->getStyle('A' . $i . ':' . 'C' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('AF' . $i, $total);
            $sheet->getStyle('AF' . $i)->getFont()->setSize(11);
            $sheet->getStyle('AF' . $i)->getFont()->setBold(true);
            $sheet->getStyle('AF' . $i)->getNumberFormat()->setFormatCode('#,##0');




            $filename = 'listWo.xlsx'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache

            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');

            $objWriter->save('php://output');
        }
    }
}
