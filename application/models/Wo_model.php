<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Pemotongan Stok dilakukan lewat CB, di ERP
 * di sini hanya nge-set/membuat CB nya...
 * dan membuat WO

 * @author budy k
 * @author agus
 */

// SELECT xx.*, CASE WHEN xx.tlp1 = '' AND xx.tlp2 = '' THEN xx.tlp3
// WHEN xx.tlp1 = '' AND xx.tlp3 = '' THEN xx.tlp2
// ELSE xx.tlp1 END AS telp
// FROM (
// SELECT 1 AS divisi,no_int_customer AS id, nama_customer AS customer, phone1 AS tlp1, phone2 AS tlp2, hp AS tlp3
// FROM tb_customer_gogo 
// WHERE fl_active = 1 AND (phone1 LIKE '%082136908805%' OR phone2 LIKE  '%082136908805%' OR hp LIKE '%082136908805%')
// UNION
// SELECT 2 AS divisi, no_int_dealer AS id, dealer_name AS customer, telp_1 AS tlp1, telp_2 AS tlp2, '' AS tlp3 FROM dmudb.`tb_dealer` 
// WHERE fl_active = 1 AND (telp_1 LIKE '%082136908805%' OR telp_2 LIKE  '%082136908805%' )
// UNION 
// SELECT 3 AS divisi, no_int_creditor AS id,  creditor_name AS customer , telp_1 AS tlp1, telp_2 AS tlp2, '' AS tlp3  FROM dmudb.`tb_creditor` 
// WHERE fl_active = 1 AND (telp_1 LIKE '%082136908805%' OR telp_2 LIKE  '%082136908805%' )
// UNION 
// SELECT 4 AS divisi, no_int_customer AS id, customer_name AS customer, telp_1 AS tlp1, telp_2 AS tlp2, '' AS tlp3  FROM dmudb.`tb_customer`
// WHERE fl_active = 1 AND (telp_1 LIKE '%082136908805%' OR telp_2 LIKE  '%082136908805%' )
// ) xx
// GROUP BY xx.divisi;

class Wo_model extends CI_Model
{
    private $dmudb;
    private $gogodb;

    private $username;
    private $group_id;
    private $area_id;
    private $warehouse_owned;

    public function __construct()
    {
        $this->dmudb = $this->load->database('dmudb', true);
        $this->gogodb = $this->load->database('gogodb', true);
        $this->username = $this->session->userdata('username');
        $this->group_id = $this->session->userdata('jabatan_id');
        $this->area_id = $this->session->userdata('area_open');
        $this->warehouse_owned = $this->session->userdata('warehouse_owned');
    }

    private function _genereteWoNumber()
    {
        $prefix = "WR";
        $currentmy = date("my"); // current month and year
        $code_prefix = $prefix . $currentmy;
        $max_code_digit = 4;

        //get the last ID
        $row = $this->dmudb->select('no_int_wo')->limit(1)
            ->order_by('no_int_wo', 'DESC')
            ->from('sparepart_wo_header')->get()->row();


        if (!$row) {
            $rrow = 0;
        } else {
            $rrow = $row->no_int_wo;
        }
        //next = current ID + 1
        $next_id = (int)$rrow + 1;

        //count next_id str
        $len_next_id = strlen((string)$next_id);

        //zero digit produced
        $zero_digit = $max_code_digit - $len_next_id;

        $zero_fill = '';

        /**
         * kalo jml udh >= 0, berarti msh ada 0 yg bisa ditambahin ke prefix
         */
        if ($zero_digit >= 0) {
            for ($i = 1; $i <= $zero_digit; $i++) {
                $zero_fill .= "0";
            }
        }

        return $code_prefix . $zero_fill . (string)$next_id;
    }

    public function saveWo($data)
    {
        $no_doc = $this->_genereteWoNumber();

        $date_buying = date('Y-m-d H:i:s', strtotime($data['date_buying']));

        $kerusakan_detail_id = null;
        $kerusakan_detail_text = null;
        if (isset($data['kerusakan_detail']) && $data['kerusakan_detail']) {
            $krs_d_temp = []; // id
            $krs_t_temp = []; // text
            foreach ($data['kerusakan_detail'] as $k) {
                $v = explode('||', $k);
                if (isset($v[0])) {
                    array_push($krs_d_temp, $v[0]);
                }
                if (isset($v[1])) {
                    array_push($krs_t_temp, $v[1]);
                }
            }

            $kerusakan_detail_id = implode(',', $krs_d_temp);
            $kerusakan_detail_text = implode(',', $krs_t_temp);
        }

        $arr = array(
            'no_doc' => $no_doc,
            'dt_doc' => date("Y-m-d H:i:s"),
            'no_int_dealer' => $data['no_int_dealer'],
            'nama_pemilik' => $data['nama_customer'],
            'konsumen' => $data['konsumen'],
            'no_kartu_garansi' => $data['no_garansi'],
            'dt_kwitansi_pembelian' => $date_buying,
            'status_garansi' => $data['garansi'],
            'address' => $data['address'],
            'telp' => $data['telp'],
            'no_int_product' => $data['no_int_product'],
            'size' => $data['size'],
            'type' => $data['type'],
            'colour' => $data['colour'],
            'serial_number' => $data['serial_number'],
            'kelengkapan' => $data['kelengkapan'],
            'jenis_kerusakan' => $data['broken_status'],
            'keterangan' => $data['keterangan'],
            'id_input' => $this->username,
            'dt_input' => date("Y-m-d h:i:s"),
            'area_id' => $data['area_id'],
            'kerusakan_detail_id' => $kerusakan_detail_id,
            'kerusakan_detail_text' => $kerusakan_detail_text,
            'is_callback' => $data['is_callback']
        );

        return $this->dmudb->insert('sparepart_wo_header', $arr);
    }

    public function updateProgress($data)
    {
        $teknisi_id = isset($data['teknisi_id']) ? $data['teknisi_id'] : 0;
        $arr = array(
            'progress' => $data['progress'],
            'progress_desc' => $data['progress_desc'],
            'progress_desc2' => $data['progress_desc2'],
            'progress_desc3' => $data['progress_desc3'],
            'taken_by_customer' => $data['taken_by_customer'],
            'id_update' => $this->username,
            'dt_update' => date("Y-m-d h:i:s"),
            'teknisi_id' => $teknisi_id
        );

        // tgl selesai reparasi
        if ($data['progress'] == 'FINISH') {
            if ($data['date_done']) {
                $arr['date_done'] = date('Y-m-d H:i:s', strtotime($data['date_done']));
            } else {
                $arr['date_done'] = date('Y-m-d H:i:s');
            }
            $arr['cd_status'] = 9;
        } else if ($data['progress'] == 'PENDING PART') {
            $arr['cd_status'] = 1;
            $arr['part_pending'] = $data['part_pending'];
        } else if ($data['progress'] == 'CANCEL') {
            $arr['cd_status'] = 8; // void
            $arr['date_done'] = null;
        } else if ($data['progress'] == 'ON PROGRESS') {
            $arr['cd_status'] = 1; // posted
            $arr['date_done'] = null;
        } else if ($data['progress'] == 'INITIAL') {
            $arr['cd_status'] = 0; // minimal set to posted
            $arr['date_done'] = null;
        }

        // tgl diambil customer
        if ($data['taken_by_customer'] == 1) {
            if ($data['date_taken']) {
                $arr['date_taken'] = date('Y-m-d H:i:s', strtotime($data['date_taken']));
            } else {
                $arr['date_taken'] = date('Y-m-d H:i:s');
            }
        } else {
            $arr['date_taken'] = null;
        }

        // ifteknisi assigned
        if ($teknisi_id) {
            // jika sdh pernah di Assign, jgn ubah lagi tgl nya
            if ($data['date_job_assigned']) {
                $arr['date_job_assigned'] = date('Y-m-d H:i:s', strtotime($data['date_job_assigned']));
            } else {
                $arr['date_job_assigned'] = date('Y-m-d H:i:s');
            }
        } else {
            $arr['date_job_assigned'] = null;
        }

        return $this->dmudb->where('no_int_wo', $data['no_int_wo'])
            ->update('sparepart_wo_header', $arr);
    }

    public function print_wo($id)
    {
        $data['header'] = $this->dmudb->select('p.product_name,e.sgh_name as jenis_kerusakan_text , a.area_name, t.nama as teknisi, w.warehouse_name, p.product_id, wo.*')
            ->from('sparepart_wo_header wo')
            ->join('tb_product p', 'p.no_int_product = wo.no_int_product')
            ->join('tb_area a', 'a.area_id = wo.area_id')
            ->join('sparepart_gejala_header e', 'e.no_int_sgh = wo.jenis_kerusakan')
            ->join('tb_warehouse w', 'w.warehouse_id = wo.warehouse_id', 'left')
            ->join('sparepart_teknisi t', 't.teknisi_id = wo.teknisi_id', 'left')
            ->where('wo.no_int_wo', $id)
            ->get()->result_array();

        $data['detail'] =  $this->dmudb->select('A.*, B.product_name, C.jasa_name, B.product_id')
            ->from('sparepart_wo_detail A')
            ->join('tb_product B', 'B.no_int_product = A.no_int_product AND A.no_int_product != 0', 'left')
            ->join('sparepart_biaya_jasa C', 'C.jasa_id = A.jasa_id AND A.jasa_id != 0', 'left')
            ->where('A.no_int_wo', $id)
            ->get()->result_array();

        return  $data;
    }

    public function loadWo($offset, $limit, $search)
    {
        $where = '';

        // if ($this->warehouse_owned != 'ALL' || $this->area_id ) {
        //     $where .=" AND (wo.warehouse_id IN ({$this->warehouse_owned}) OR wo.area_id IN ({$this->area_id})) ";
        // }

        if ($this->warehouse_owned != 'ALL' || $this->area_id) {
            if ($this->area_id != '') {
                $where .= " AND (wo.warehouse_id IN ({$this->warehouse_owned}) OR wo.area_id IN ({$this->area_id})) ";
            } else {
                $where .= " AND (wo.warehouse_id IN ({$this->warehouse_owned}) OR wo.area_id !='') ";
            }
        }


        $sql = "SELECT wo.*, p.product_id, p.product_name, c.area_name, d.warehouse_name,
                e.no_int_sgh, e.sgh_name AS jenis_kerusakan, f.nama as teknisi
                FROM sparepart_wo_header wo
                LEFT JOIN tb_product p ON wo.no_int_product = p.no_int_product
                JOIN tb_area c ON c.area_id = wo.area_id
                LEFT JOIN tb_warehouse d ON d.warehouse_id = wo.warehouse_id
                JOIN sparepart_gejala_header e ON e.no_int_sgh = wo.jenis_kerusakan
                LEFT JOIN sparepart_teknisi f ON f.teknisi_id = wo.teknisi_id
                WHERE 1=1 {$where}";

        // check session Area
        if ($this->area_id) {
            $sql .= " AND wo.area_id = {$this->area_id} ";
        }

        if ($search) {
            $sql .= " AND (
                  wo.no_doc LIKE '%{$search}%'
                  OR wo.nama_pemilik LIKE '%{$search}%'
                  OR wo.telp LIKE '%{$search}%'
                )";
        }
        // var_dump($sql); exit();
        $ret['total'] = $this->dmudb->query($sql)->num_rows();

        $sql .= " ORDER BY wo.no_int_wo desc LIMIT {$offset},{$limit}";

        $ret['data'] = $this->dmudb->query($sql)->result();

        return $ret;
    }

    public function fetchStock($warehouse_id, $no_int_product)
    {
        return $this->dmudb->select('no_int_product,saldo_akhir, warehouse_id')
            ->from('tb_product_store')
            ->where('warehouse_id', $warehouse_id)
            ->where_in('no_int_product', $no_int_product)
            ->get()->result_array();
    }

    /**
     * save SParepart Item/WO Detail
     * Update cd_status = 1 (posted) here
     * This will create CB (Cash Bill) also to later be processed
     * on ERP
     */
    public function saveitem($data)
    {
        $item = array();
        $grandtotal = 0;

        $id = $data['no_int_wo'];
        $header_wo = $this->dmudb->select('*')
            ->from('sparepart_wo_header')
            ->where('no_int_wo', $id)
            ->get()->row_array();


        $current_cdstatus = $header_wo['cd_status'];
        /**
         * If current cd_status is 0 or 1, set it to 1
         * as adding sparepart item should set cd_status to 1
         * otherwise, so to current status...because other Action
         * may change the status
         */
        $cd_status = 1;
        if ($current_cdstatus != 0 || $current_cdstatus != 1) {
            $cd_status = $current_cdstatus;
        }

        $this->dmudb->trans_start();

        foreach ($data['item'] as $k) {
            $amt_total = $k['qty'] * $k['price']; // or $k['amt_total']
            array_push($item, array(
                'no_int_product' => $k['no_int_product'],
                'qty' => $k['qty'],
                'price' => $k['price'],
                'amt_total' => $amt_total,
                'original_price' => 0, //$k['original_price'],
                'no_int_wo' => $data['no_int_wo'],
                'jasa_id' => isset($k['jasa_id']) ? $k['jasa_id'] : 0
            ));

            $grandtotal += $amt_total;
        }

        // Service Action
        $service_action_id = null;
        $service_action_text = null;
        if (isset($data['service_action']) && $data['service_action']) {
            $v = explode('||', $data['service_action']);
            if (isset($v[0])) {
                $service_action_id = $v[0];
            }
            if (isset($v[1])) {
                $service_action_text = $v[1];
            }
        }

        //update header
        $woheader_arr = array(
            'grandtotal' => $grandtotal, // or $data['grandtotal']
            'id_update' => $this->username,
            'dt_update' => date("Y-m-d H:i:s"),
            'cd_status' => $cd_status,
            'warehouse_id' => $data['warehouse_id'],
            'service_action_id' => $service_action_id,
            'service_action_text' => $service_action_text
        );

        // update WO
        $this->dmudb->where('no_int_wo', $data['no_int_wo'])->update('sparepart_wo_header', $woheader_arr);

        // //insert item
        $this->dmudb->insert_batch('sparepart_wo_detail', $item);

        //update stock and Ledger will be done in the next step in ERP CB
        //Create CB

        // // ternyata cash bill ga pernah di pake dong per tanggal 27-05-2019
        // $sql_area = " SELECT fl_gogomall FROM tb_area WHERE area_id = {$data['area_id']} " ;
        // $area = $this->dmudb->query($sql_area)->row_array();

        // if ($area['fl_gogomall'] == 1) {//save CB GOGO
        //     $this->saveToCbGogo($header_wo, $data);

        // } else { // SAVE CB DMU
        //     $this->saveToCb($header_wo, $data);
        // }

        $this->dmudb->trans_complete();

        if ($this->dmudb->trans_status() === false) {
            return false;
        }

        return true;
    }

    // /**
    // * Generate No CB per Area
    // * @param in $area_id
    // * @return string
    // */
    // private function _genereteCBNumber($area_id)
    // {

    //     //get last number
    //     $last_num = $this->dmudb->select('last_number')
    //                 ->from('tb_document_details')
    //                 ->where('doc_id', 5)
    //                 ->where('area_id', $area_id)
    //                 ->get()->row_array();

    //     $code_prefix = "CBM-";
    //     $max_code_digit = 5;
    //     $next_id = $last_num['last_number'] + 1;

    //     $len_next_id = strlen((string)$next_id);

    //     //zero digit produced
    //     $zero_digit = $max_code_digit - $len_next_id;

    //     $zero_fill = '';

    //     /**
    //      * kalo jml udh >= 0, berarti msh ada 0 yg bisa ditambahin ke prefix
    //      */
    //     if ($zero_digit >= 0) {
    //         for ($i = 1; $i <= $zero_digit; $i++) {
    //             $zero_fill .= "0";
    //         }

    //     }

    //    return $code_prefix . $zero_fill . (string)$next_id;

    // }

    // *
    // * Generate No CB per Area GOGO
    // * @param in $area_id
    // * @return string

    // private function _genereteCBNumberGogo($area_id)
    // {
    //     //get last number
    //     $last_num = $this->gogodb->select('last_number')
    //                 ->from('tb_document_details_gogo')
    //                 ->where('doc_id', 42)
    //                 ->where('area_id', $area_id)
    //                 ->get()->row_array();

    //     $code_prefix = "CBM-";
    //     $max_code_digit = 5;
    //     $next_id = $last_num['last_number'] + 1;

    //     $len_next_id = strlen((string)$next_id);

    //     //zero digit produced
    //     $zero_digit = $max_code_digit - $len_next_id;

    //     $zero_fill = '';

    //     /**
    //      * kalo jml udh >= 0, berarti msh ada 0 yg bisa ditambahin ke prefix
    //      */
    //     if ($zero_digit >= 0) {
    //         for ($i = 1; $i <= $zero_digit; $i++) {
    //             $zero_fill .= "0";
    //         }

    //     }

    //    return $code_prefix . $zero_fill . (string)$next_id;

    // }

    // /**
    // * Update document
    // * @param int $area_id
    // */
    // private function updateTb_document_details($area_id)
    // {
    //     //get last number
    //     $last_num = $this->dmudb->select('last_number')
    //                 ->from('tb_document_details')
    //                 ->where('doc_id',5)
    //                 ->where('area_id',$area_id)
    //                 ->get()->row_array();

    //     $arr = array(
    //         'last_number' => $last_num['last_number'] + 1,
    //         'last_upd' => date("Y-m-d h:i:s"),
    //         'upd_by' => $this->username
    //     );

    //     $this->dmudb->where('doc_id', 5)
    //           ->where('area_id', $area_id)
    //           ->update('tb_document_details', $arr);


    // }

    // *
    // * Update document GOGO
    // * @param int $area_id

    // private function updateTb_document_details_gogo($area_id)
    // {
    //     //get last number
    //     $last_num = $this->gogodb->select('last_number')
    //                 ->from('tb_document_details_gogo')
    //                 ->where('doc_id',42)
    //                 ->where('area_id',$area_id)
    //                 ->get()->row_array();

    //     $arr = array(
    //         'last_number' => $last_num['last_number'] + 1,
    //         'last_upd' => date("Y-m-d h:i:s"),
    //         'upd_by' => $this->username
    //     );

    //     $this->gogodb->where('doc_id', 42)
    //           ->where('area_id', $area_id)
    //           ->update('tb_document_details_gogo', $arr);


    // }

    // /**
    // * CB mah si Admin sales yang nerusin
    // */
    // private function saveToCb($header_wo, $data)
    // {

    //    $area_id = $header_wo['area_id'];
    //    $no_cb = $this->_genereteCBNumber($area_id);

    //    $cb_header = array(
    //         'no_cb'      => $no_cb,
    //         'dt_cb'      => $header_wo['dt_doc'],
    //         'no_int_wo'  => $header_wo['no_int_wo'],
    //         'no_int_dealer' => $header_wo['no_int_dealer'],
    //         'send_address1' => $header_wo['address'],
    //         'id_input' => $header_wo['id_input'],
    //         'dt_input' => $header_wo['dt_input'],
    //         'area_id'  => $header_wo['area_id'],
    //         'warehouse_id' => $data['warehouse_id'],
    //         'cd_status' => 0, //
    //         'amt_total' => $data['grandtotal'],
    //         'per_disc' => 0,
    //         'term_id'  => 1,
    //         'fl_sj'    => 1,
    //         'description'  => $header_wo['keterangan']
    //     );

    //     $this->dmudb->trans_start();
    //     // sert CB header
    //     $this->dmudb->insert('cb_header', $cb_header);

    //     $last_insert_id = $this->dmudb->insert_id();

    //     if (!empty($data['item'])) {

    //         $cb_detail = array();

    //         foreach ($data['item'] as $d) {
    //             $cb_d = array(
    //                   'no_int_cb'     => $last_insert_id,
    //                   'no_int_product'=> $d['no_int_product'],
    //                   'qty'           => $d['qty'],
    //                   'price'         => $d['price'],
    //                   'unit_id'       => 'PCS'
    //             );
    //             array_push($cb_detail, $cb_d);
    //         }
    //         // insert CB detail
    //         $this->dmudb->insert_batch('cb_detail', $cb_detail);
    //     }

    //     // update documents
    //     $this->updateTb_document_details($area_id);

    //     $this->dmudb->trans_complete();

    //     if ($this->dmudb->trans_status() == false) {
    //         return false;
    //     }

    //     return true;

    // }

    //     /**
    //     * CB mah si Admin sales yang nerusin GOGO
    //     */
    //     private function saveToCbGogo($header_wo, $data)
    //     {
    //        $area_id = $header_wo['area_id'];
    //        $no_cb = $this->_genereteCBNumberGogo($area_id);

    //        $cb_header = array(
    //             'no_cb'      => $no_cb,
    //             'dt_cb'      => $header_wo['dt_doc'],
    //             'no_int_wo'  => $header_wo['no_int_wo'],
    //             'no_int_dealer' => $header_wo['no_int_dealer'],
    //             'send_address1' => $header_wo['address'],
    //             'id_input' => $header_wo['id_input'],
    //             'dt_input' => $header_wo['dt_input'],
    //             'area_id'  => $header_wo['area_id'],
    //             'warehouse_id' => $data['warehouse_id'],
    //             'cd_status' => 0, //
    //             'amt_total' => $data['grandtotal'],
    //             'per_disc' => 0,
    //             'term_id'  => 1,
    //             'fl_sj'    => 1,
    //             'description'  => $header_wo['keterangan']
    //         );

    //         $this->dmudb->trans_start();
    //         // sert CB header
    //         $this->dmudb->insert('cb_header', $cb_header);

    //         $last_insert_id = $this->dmudb->insert_id();

    //         if (!empty($data['item'])) {

    //             $cb_detail = array();

    //             foreach ($data['item'] as $d) {
    //                 $cb_d = array(
    //                       'no_int_cb'     => $last_insert_id,
    //                       'no_int_product'=> $d['no_int_product'],
    //                       'qty'           => $d['qty'],
    //                       'price'         => $d['price'],
    //                       'unit_id'       => 'PCS'
    //                 );
    //                 array_push($cb_detail, $cb_d);
    //             }
    //             // insert CB detail
    //         $this->dmudb->insert_batch('cb_detail', $cb_detail);
    //     }

    //     // update documents
    //     $this->updateTb_document_details($area_id);

    //     $this->dmudb->trans_complete();

    //     if ($this->dmudb->trans_status() == false) {
    //         return false;
    //     }

    //     return true;

    // }

    public function fetchDetailItem($no_int_wo)
    {
        return $this->dmudb->select('A.*, B.product_name, C.jasa_name, B.product_id')
            ->from('sparepart_wo_detail A')
            ->join('tb_product B', 'B.no_int_product = A.no_int_product AND A.no_int_product != 0', 'left')
            ->join('sparepart_biaya_jasa C', 'C.jasa_id = A.jasa_id AND A.jasa_id != 0', 'left')
            ->where('A.no_int_wo', $no_int_wo)
            ->get()->result();
    }

    public function fetchJenisKerusakan()
    {
        $sql = "SELECT * FROM sparepart_gejala_header";

        return $this->dmudb->query($sql)->result();
    }

    public function fetchJenisKerusakanDetail($kerusakan_id)
    {
        $sql = "SELECT * FROM sparepart_gejala_detail
                WHERE no_int_sgh = {$kerusakan_id} ";

        return $this->dmudb->query($sql)->result();
    }

    public function fetchServiceAction()
    {
        $sql = "SELECT * FROM sparepart_aksi";

        return $this->dmudb->query($sql)->result();
    }

    public function fetchTeknisi()
    {
        $sql = "SELECT * FROM sparepart_teknisi";

        return $this->dmudb->query($sql)->result();
    }

    public function fetchTglBeli($search)
    {
        $sql = "SELECT dt_sp
              FROM sp_header h
              JOIN sp_detail d ON h.no_int_sp=d.no_int_sp
              WHERE 1=1 and d.SN='$search'
              UNION ALL
              SELECT dt_sp
              FROM sp_dtd_header h
              JOIN sp_dtd_detail d ON h.no_int_sp=d.no_int_sp
              WHERE 1=1 and d.SN='$search'
              UNION ALL
              SELECT dt_sp
              FROM sp_counter_header h
              JOIN sp_counter_detail d ON h.no_int_sp=d.no_int_sp
              WHERE 1=1 and d.SN='$search'
              ";

        $ret = $this->dmudb->query($sql)->result();

        return $ret;
    }

    /**
     * function fetchSerialNumber
     * this function will make a partial serial number as much as the quantity
     * make serial number refer to comma into the field SN in the table sp_detail
     * update by endin 2018-11-12 to 2018-11-15
     */
    public function fetchSerialNumber($search)
    {
        $search_key = "'%" . $search . "%'";
        $sql = "SELECT zz.* FROM (
                select 1 AS division, d.sn , a.area_name , p.product_name ,a.area_id, d.qty, h.no_int_dealer, h.dt_sp
               from dmudb.tb_area a, dmudb.tb_product p, dmudb.sp_header h, dmudb.sp_detail d
               where a.area_id=h.area_id
	                  and p.no_int_product=d.no_int_product
	                  and h.no_int_sp=d.no_int_sp
                    and d.sn like {$search_key}
                    and LENGTH(d.SN)>1
                UNION ALL
                select 2 AS division,  d.sn , a.area_name , p.product_name ,a.area_id, d.qty, h.no_int_creditor, h.dt_sp
               from dmudb.tb_area a, dmudb.tb_product p, dmudb.sp_dtd_header h, dmudb.sp_dtd_detail d
               where a.area_id=h.area_id
                      and p.no_int_product=d.no_int_product
                      and h.no_int_sp=d.no_int_sp
                    and d.sn like {$search_key}
                    and LENGTH(d.SN)>1
                UNION ALL
                select 3 AS division,  d.sn , a.area_name , p.product_name ,a.area_id, d.qty, h.no_int_customer, h.dt_sp
               from dmudb.tb_area a, dmudb.tb_product p, dmudb.sp_counter_header h, dmudb.sp_counter_detail d
               where a.area_id=h.area_id
                      and p.no_int_product=d.no_int_product
                      and h.no_int_sp=d.no_int_sp
                    and d.sn like {$search_key}
                    and LENGTH(d.SN)>1
                UNION ALL
                select 4 AS division,  d.sn , a.area_name , p.product_name ,a.area_id, d.qty, h.no_int_customer, h.dt_sp
               from dmudb.tb_area a, dmudb.tb_product p, gogodb.sp_header_gogo h, gogodb.sp_detail_gogo d
               where a.area_id=h.area_id
                      and p.no_int_product=d.no_int_product
                      and h.no_int_sp=d.no_int_sp
                    and d.sn like {$search_key}
                    and LENGTH(d.SN)>1 ) zz
                    LIMIT 15    ";
        //print_r($sql); exit();
        $rowsult = array();
        $result = array();

        $data = $this->dmudb->query($sql)->result();
        $total = $this->dmudb->query($sql)->num_rows();

        if ($data) {

            /* Header serial number */
            $result['id'] = '<b>Serial Number</b>';
            $result['product_name'] = '<b>Product Name</b>';
            $result['text'] = '<b>Area</b>';
            $result['no_member'] = '<b>ID Member</b>';
            $result['tgl_sp'] = '<b>Tanggal</b>';
            $result['divisi'] = '<b>division</b>';

            array_push($rowsult, $result);
            $str_cari = ",";

            /* Looping for sum data result query */
            foreach ($data as $k) {

                $qty = $k->qty;

                /* Check quantity if > 1 then done partial SN */

                if ($qty > 1) {
                    $posisi  = 0;
                    $sn_all  = $k->sn;          // first SN
                    $len_all = strlen($sn_all); // calculate lenght first SN
                    for ($i = 1; $i <= $qty; $i++) {  // looping for sum quantity

                        if ($i < $qty) {
                            /* if SN-i will be create  */
                            $cari   = strpos($sn_all, $str_cari, $posisi);  // search position comma in the variable sn_all
                            $len    = $cari - $posisi;                    // calculate the SN length that will be created
                            $sn_x   = substr($sn_all, $posisi, $len);       // take SN that will be created
                            $posisi = $cari + 1;
                        } else {
                            /* if SN-qty will be create  */
                            $len  = $len_all - ($posisi);
                            $sn_x = substr($sn_all, $posisi, $len);
                        }

                        /* this is to ensure that the SN that will be displayed matches the search word */
                        $len_search = strlen($search);
                        if ($len_search > 0) {
                            $sn_true = strpos($sn_x, $search, 0);
                        } else {
                            $sn_true = TRUE;
                        }
                        if ($sn_true !== FALSE) {
                            $result['id'] = $sn_x; //default, plugins Select2 butuh format id n text
                            $result['product_name'] = $k->product_name;
                            $result['text'] = $k->area_name;
                            $result['no_member'] = $k->no_int_dealer;
                            $result['tgl_sp'] = $k->dt_sp;
                            $result['divisi'] = $k->division;
                            array_push($rowsult, $result);
                        }
                    }
                } else {
                    $result['id'] = $k->sn; //default, plugins Select2 butuh format id n text
                    $result['product_name'] = $k->product_name;
                    $result['text'] = $k->area_name;
                    $result['no_member'] = $k->no_int_dealer;
                    $result['tgl_sp'] = $k->dt_sp;
                    $result['divisi'] = $k->division;
                    array_push($rowsult, $result);
                }
            }
        } else {
            $result['id'] = $search;
            $result['product_name'] = 'null';
            $result['text'] = $search;
            $result['no_member'] = '---';
            $result['tgl_sp'] = '---';
            $result['divisi'] = '---';
            array_push($rowsult, $result);
        }

        return array('results' => $rowsult, 'total' => $total);
    }

    public function fetchSerialNumber_bk($search)
    {
        $search_key = "'%" . $search . "%'";
        $sql = "select d.sn , area_name , p.product_name ,a.area_id,d.qty
               from tb_area a, tb_product p, sp_header h, sp_detail d
               where a.area_id=h.area_id
	                  and p.no_int_product=d.no_int_product
	                  and h.no_int_sp=d.no_int_sp
                    and d.sn like {$search_key}
                    and LENGTH(d.SN)>1 limit 30";

        $rowsult = array();
        $result = array();

        $data = $this->dmudb->query($sql)->result();
        $total = $this->dmudb->query($sql)->num_rows();

        if ($data) {

            //ALL product
            $result['id'] = '<b>Serial Number</b>';
            $result['city_name'] = '<b>Product Name</b>';
            $result['text'] = '<b>Area</b>';
            array_push($rowsult, $result);
            $str_cari = ",";

            foreach ($data as $k) {
                $qty = $k->qty;
                if ($qty > 1) {
                    $posisi  = 0;
                    $sn_all  = $k->sn;
                    $len_all = strlen($sn_all);
                    for ($i = 1; $i <= $qty; $i++) {
                        if ($i < $qty) {
                            $cari   = strpos($sn_all, $str_cari, $posisi);
                            if ($i == 1) {
                                $len  = $cari - $posisi;
                            } else {
                                $len  = $cari - $posisi;
                            }
                            $sn_x   = substr($sn_all, $posisi, $len);
                            $posisi = $cari + 1;
                        } else {
                            $len  = $len_all - ($posisi);
                            $sn_x = substr($sn_all, $posisi, $len);
                        }
                        $len_search = strlen($search);
                        if ($len_search > 0) {
                            $sn_true = strpos($sn_x, $search, 0);
                        } else {
                            $sn_true = TRUE;
                        }
                        if ($sn_true !== FALSE) {
                            $result['id'] = $sn_x; //default, plugins Select2 butuh format id n text
                            $result['city_name'] = $k->product_name;
                            $result['text'] = $k->area_name;
                            array_push($rowsult, $result);
                        }
                    }
                } else {
                    $result['id'] = $k->sn; //default, plugins Select2 butuh format id n text
                    $result['city_name'] = $k->product_name;
                    $result['text'] = $k->area_name;

                    array_push($rowsult, $result);
                }
            }
        } else {
            $result['id'] = null;
            $result['city_name'] = '--';
            $result['text'] = 'No Results Found..';
            array_push($rowsult, $result);
        }

        return array('results' => $rowsult, 'total' => $total);
    }

    public function fetchSerialNumber2($search)
    {
        $search_key = "'%" . $search . "%'";
        $sql = "select d.sn , area_name , p.product_name ,a.area_id,d.qty
               from tb_area a, tb_product p, sp_header h, sp_detail d
               where a.area_id=h.area_id
	                  and p.no_int_product=d.no_int_product
	                  and h.no_int_sp=d.no_int_sp
                    and d.sn like {$search_key}
                    and LENGTH(d.SN)>1 limit 30";

        $rowsult = array();
        $result = array();

        $data = $this->dmudb->query($sql)->result();
        $total = $this->dmudb->query($sql)->num_rows();

        if ($data) {

            //ALL product
            $result['id'] = '<b>Serial Number</b>';
            $result['label'] = '<b>Product Name</b>';
            $result['value'] = '<b>Area</b>';
            array_push($rowsult, $result);
            $str_cari = ",";

            foreach ($data as $k) {
                $qty = $k->qty;
                if ($qty > 1) {
                    $posisi  = 0;
                    $sn_all  = $k->sn;
                    $len_all = strlen($sn_all);
                    for ($i = 1; $i <= $qty; $i++) {
                        if ($i < $qty) {
                            $cari   = strpos($sn_all, $str_cari, $posisi);
                            if ($i == 1) {
                                $len  = $cari - $posisi;
                            } else {
                                $len  = $cari - $posisi;
                            }
                            $sn_x   = substr($sn_all, $posisi, $len);
                            $posisi = $cari + 1;
                        } else {
                            $len  = $len_all - ($posisi);
                            $sn_x = substr($sn_all, $posisi, $len);
                        }
                        $len_search = strlen($search);
                        if ($len_search > 0) {
                            $sn_true = strpos($sn_x, $search, 0);
                        } else {
                            $sn_true = TRUE;
                        }
                        if ($sn_true !== FALSE) {
                            $result['id'] = $sn_x; //default, plugins Select2 butuh format id n text
                            $result['label'] = $k->product_name;
                            $result['value'] = $k->area_name;
                            array_push($rowsult, $result);
                        }
                    }
                } else {
                    $result['id'] = $k->sn; //default, plugins Select2 butuh format id n text
                    $result['label'] = $k->product_name;
                    $result['value'] = $k->area_name;

                    array_push($rowsult, $result);
                }
            }
        } else {
            $result['id'] = null;
            $result['label'] = '--';
            $result['value'] = 'No Results Found..';
            array_push($rowsult, $result);
        }

        return array('results' => $rowsult);
    }

    public function loadArea($offset = 0, $limit = 0, $search = null, $type = null, $serial_number = null, $product_name = null)
    {
        $db = $this->load->database('dmudb', true);

        // sessions users
        $user = $this->session->userdata('username');
        // Access control Group
        $grpUser = $this->session->userdata('jabatan_id');
        // user can have multiple areas opened for them
        $area_open = $this->session->userdata('area_open');
        // User can have a single area where they belong/registered
        $area_id = $this->session->userdata('area_id');

        $where_search = '';
        if ($search) {
            $where_search = " AND (area_name LIKE '%{$search}%' ) ";
        }

        // $where_search_serial_number = '';
        // if ($product_name!='null') {
        //   if ($serial_number) {
        //       $where_search_serial_number = " AND (area_id IN (
        //                                           SELECT a.area_id
        //                                           FROM tb_area a, tb_product p, sp_header h, sp_detail d
        //                                           WHERE a.area_id=h.area_id
        //                                             AND p.no_int_product=d.no_int_product
        //                                             AND h.no_int_sp=d.no_int_sp
        //                                             AND LENGTH(d.SN)>1
        //                                             AND d.sn like '%$serial_number%'

        //                                             UNION ALL

        //                                             SELECT a.area_id
        //                                           FROM tb_area a, tb_product p, sp_dtd_header h, sp_dtd_detail d
        //                                           WHERE a.area_id=h.area_id
        //                                             AND p.no_int_product=d.no_int_product
        //                                             AND h.no_int_sp=d.no_int_sp
        //                                             AND LENGTH(d.SN)>1
        //                                             AND d.sn like '%$serial_number%'

        //                                             UNION ALL

        //                                             SELECT a.area_id
        //                                           FROM tb_area a, tb_product p, sp_counter_header h, sp_counter_detail d
        //                                           WHERE a.area_id=h.area_id
        //                                             AND p.no_int_product=d.no_int_product
        //                                             AND h.no_int_sp=d.no_int_sp
        //                                             AND LENGTH(d.SN)>1
        //                                             AND d.sn like '%$serial_number%'
        //                                         ))  ";
        //   }
        // }

        $where_area_open = '';
        $area_open = trim($area_open, ','); // remove leading comma
        $area_open = trim($area_open);
        $area_open = strtoupper($area_open); // make sure its uppercase

        if ($area_open && $area_open !== 'ALL') {
            $where_area_open = " AND area_id IN ($area_open)";
        }

        $where_area_id = '';
        if ($area_id && $area_id !== 'ALL') {
            $where_area_id = " AND area_id  = {$area_id} ";
        }

        $where_type = '';
        if ($type) {
            // ALL DMU
            if ($type == 'dmu') {
                $where_type = " AND fl_gogo <> 1 and fl_active=1 and (fl_dmu=1 OR fl_counter=1)";
            }
            // GOGO and certain user group
            elseif ($type == 'gogo' && ($grpUser == 43 or $grpUser == 42)) {
                $where_type = " AND area_id = 19 AND fl_active = 1 ";
            }
            // GOGO
            elseif ($type == 'gogo') {
                $where_type = " AND fl_gogo = 1 and fl_active=1 "; //area gogo
            }
            // Counter
            elseif ($type == 'counter') {
                $where_type = " AND fl_counter = 1 ";
            }
            // DMU or DTD
            elseif ($type == 'dmudtd') {
                $where_type = " AND (fl_dtd = 1 OR fl_dmu =1) ";
            }
            //DTD
            elseif ($type == 'dtd') {
                $where_type = " AND (fl_dtd = 1 OR dtdfullactive = 1 OR fl_dtd_fulltime =1) ";
            }
            // Modern Market
            elseif ($type == 'modern') {
                $where_type = " AND fl_modern = 1 ";
            }
            // E-Comm
            elseif ($type == 'ecomm') {
                $where_type = " AND area_id=123 ";
            }
            // Newest GOGO
            elseif ($type == 'gogo_skrng') {
                $where_type = " AND area_id IN (19) ";
            }
            // roxy and lio
            elseif ($type == 'roxy_lio') {
                $where_type = " AND area_id IN (19,163,189) ";
            }
            // gogoShop
            elseif ($type == 'gogoshop') {
                $where_type = " AND fl_gogo = 1 and fl_counter = 1  ";
            }
            // Founder
            elseif ($type == 'founder') {
                $where_type = " AND (area_name LIKE '%founder%') ";
            }
        }

        //area_id 999 = area Testing
        $sql = "SELECT area_id, area_name, city_name, fl_luar_jawa
              FROM tb_area
              WHERE fl_active = 1
                {$where_type} {$where_area_open} {$where_area_id}
                {$where_search}
              ORDER BY area_name ASC ";
        //  ECHO $sql;exit;

        //total data without paging
        $total = $db->query($sql)->num_rows();

        //if limit is set
        if ($limit > 0) {
            $sql .= " LIMIT {$offset},{$limit} ";
        }

        $data = $db->query($sql);

        $rowsult = array();
        $result = array();

        $data = $data->result();

        if ($data) {

            //ALL product
            $result['id'] = null;
            $result['city_name'] = '<b>All Area</b>';
            $result['text'] = '<b>All Area</b>';
            array_push($rowsult, $result);

            foreach ($data as $k) {
                $result['id'] = $k->area_id; //default, plugins Select2 butuh format id n text
                $result['city_name'] = $k->city_name;
                $result['text'] = $k->area_name;

                array_push($rowsult, $result);
            }
        } else {
            $result['id'] = $search;
            $result['city_name'] = '--';
            $result['text'] = $search;
            array_push($rowsult, $result);
        }

        return array('results' => $rowsult, 'total' => $total);
    }

    //load list barang
    public function loadProduct($offset = 0, $limit = 0, $search = null, $id_category = null, $type = null, $serial_number = null, $product_name = null, $divisi = null)
    {
        $db = $this->load->database('dmudb', true);
        $where_search = '';
        if ($search) {
            $where_search = " AND (
              tp.product_name LIKE '%{$search}%' OR tp.product_id LIKE '%{$search}%'
            ) ";
        }

        $where_category = '';
        if ($id_category) {
            $where_category = " AND tcp.category_id = {$id_category} ";
        }

        $where_type = '';
        if ($type) {
            if ($type == 'product') {
                $where_type = " AND tp.category_id = 1 ";
            } elseif ($type == 'sparepart') {
                $where_type = " AND tp.category_id = 2 ";
            }
        }
        //  $serial_number='1811';

        $key_sn = "'%" . $serial_number . "%'";
        $where_search_serial_number = '';
        //'%$serial_number%'
        if ($product_name != 'null') {
            if ($serial_number) {
                if ($divisi == 1) {
                    $where_search_serial_number = " AND (no_int_product IN ( SELECT p.no_int_product
                                                        FROM dmudb.tb_area a, dmudb.tb_product p, dmudb.sp_header h, dmudb.sp_detail d
                                                        WHERE a.area_id=h.area_id
                                                        AND p.no_int_product=d.no_int_product
                                                        AND h.no_int_sp=d.no_int_sp
                                                        AND LENGTH(d.SN)>1
                                                        AND d.sn like {$key_sn} )) ";
                } else if ($divisi == 2) {
                    $where_search_serial_number =  " AND (no_int_product IN ( SELECT p.no_int_product
                                                        FROM dmudb.tb_area a, dmudb.tb_product p, dmudb.sp_dtd_header h, dmudb.sp_dtd_detail d
                                                        WHERE a.area_id=h.area_id
                                                        AND p.no_int_product=d.no_int_product
                                                        AND h.no_int_sp=d.no_int_sp
                                                        AND LENGTH(d.SN)>1
                                                        AND d.sn like {$key_sn} )) ";
                } else if ($divisi == 3) {
                    $where_search_serial_number =  " AND (no_int_product IN ( SELECT p.no_int_product
                                                        FROM dmudb.tb_area a, dmudb.tb_product p, dmudb.sp_counter_header h, dmudb.sp_counter_detail d
                                                        WHERE a.area_id=h.area_id
                                                        AND p.no_int_product=d.no_int_product
                                                        AND h.no_int_sp=d.no_int_sp
                                                        AND LENGTH(d.SN)>1
                                                        AND d.sn like {$key_sn} )) ";
                } else {
                    $where_search_serial_number =  " AND (no_int_product IN ( SELECT p.no_int_product
                                                        FROM dmudb.tb_area a, dmudb.tb_product p, gogodb.sp_header_gogo h, gogodb.sp_detail_gogo d
                                                        WHERE a.area_id=h.area_id
                                                        AND p.no_int_product=d.no_int_product
                                                        AND h.no_int_sp=d.no_int_sp
                                                        AND LENGTH(d.SN)>1
                                                        AND d.sn like {$key_sn} )) ";
                }
            }
        }


        $sql = " SELECT tp.no_int_product, tp.product_id, tp.product_name,
                    tcp.category_id, tcp.category_name
                    FROM dmudb.tb_product tp
                    LEFT JOIN dmudb.tb_category_product tcp
                    ON tp.category_id = tcp.category_id
                    WHERE tp.fl_active = 1 AND tcp.fl_active = 1
                        {$where_category}
                        {$where_search} {$where_type}
                        {$where_search_serial_number}
                    ORDER BY tp.product_name,tcp.category_name ASC ";
        //print_r($sql); exit();
        //total data without paging
        $total = $this->db->query($sql)->num_rows();

        //if limit is set
        if ($limit > 0) {
            $sql .= " LIMIT {$offset},{$limit} ";
        }

        $data = $db->query($sql);

        $rowsult = array();
        $result = array();

        $data = $data->result();

        if ($data) {

            //ALL product
            $result['id'] = 0;
            $result['kode'] = '<b>All</b>';
            $result['text'] = '<b>ALL</b>';
            array_push($rowsult, $result);

            foreach ($data as $k) {
                $result['id'] = $k->no_int_product; //default, plugins Select2 butuh format id n text
                $result['kode'] = $k->product_id;
                $result['text'] = $k->product_name;

                array_push($rowsult, $result);
            }
        }
        // else {
        //     $result['id'] = $search;
        //     $result['kode'] = $search;
        //     $result['text'] = $search;
        //     array_push($rowsult, $result);
        // }

        return array('results' => $rowsult, 'total' => $total);
    }

    public function loadPiutangmbr($search = null, $area_id = null, $no_member = null, $serial_number = null, $divisi = null)
    {
        $db = $this->load->database('dmudb', true);

        if ($divisi == 1) {
            $sql = "SELECT d.dealer_name AS cust, d.dealer_id AS cust_id, d.no_int_dealer AS id,
              concat(d.address_1 , ' ', d.address_2) AS alamat ,
              concat(d.telp_1 , ' | ' , d.telp_2) AS telp
               FROM dmudb.tb_dealer d
               INNER JOIN dmudb.sp_header sp ON sp.no_int_dealer = d.no_int_dealer
               INNER JOIN dmudb.sp_detail spd ON sp.no_int_sp = spd.no_int_sp
               WHERE 1=1 AND spd.SN LIKE '%{$serial_number}%' AND d.area_id <> 999 ";
        } else if ($divisi == 2) {
            $sql = "SELECT d.creditor_name AS cust, d.creditor_id AS cust_id, d.no_int_creditor AS id,
               CONCAT(d.address_1 , ' ', d.address_2) AS alamat ,
                CONCAT(d.telp_1 , ' | ' , d.telp_2) AS telp
                FROM dmudb.tb_creditor d
                INNER JOIN dmudb.sp_dtd_header sp ON sp.no_int_creditor = d.no_int_creditor
                INNER JOIN dmudb.sp_dtd_detail spd ON sp.no_int_sp = spd.no_int_sp
                WHERE 1=1    AND spd.SN LIKE '%{$serial_number}%' AND d.area_id <> 999 ";
        } else if ($divisi == 3) {
            $sql = " SELECT d.customer_name AS cust, d.customer_id AS cust_id, d.no_int_customer AS id,
                CONCAT(d.address_1 , ' ', d.address_2) AS alamat ,
                CONCAT(d.telp_1 , ' | ' , d.telp_2) AS telp
                FROM dmudb.tb_customer d
                INNER JOIN dmudb.sp_counter_header sp ON sp.no_int_customer = d.no_int_customer
                INNER JOIN dmudb.sp_counter_detail spd ON sp.no_int_sp = spd.no_int_sp
                WHERE 1=1    AND spd.SN LIKE '%{$serial_number}%' AND d.area_id <> 999 ";
        } else if ($divisi == 4) {
            $sql = " SELECT d.nama_customer AS cust, '' AS cust_id, d.no_int_customer AS id,
                CONCAT(d.alamat1 , ' ', d.alamat2) AS alamat ,
                CONCAT(d.phone1 , ' | ' , d.phone2 , ' | ' , d.hp) AS telp
                FROM gogodb.tb_customer_gogo d
                INNER JOIN gogodb.sp_header_gogo sp ON sp.no_int_customer = d.no_int_customer
                INNER JOIN gogodb.sp_detail_gogo spd ON sp.no_int_sp = spd.no_int_sp
                WHERE 1=1    AND spd.SN LIKE '%{$serial_number}%' AND d.area_id <> 999 ";
        } else {
            $sql = " SELECT d.customer_name AS cust, d.customer_id AS cust_id, d.no_int_customer AS id,
                CONCAT(d.address_1 , ' ', d.address_2) AS alamat ,
                CONCAT(d.telp_1 , ' | ' , d.telp_2) AS telp
                FROM dmudb.tb_customer d
                INNER JOIN dmudb.sp_counter_header sp ON sp.no_int_customer = d.no_int_customer
                INNER JOIN dmudb.sp_counter_detail spd ON sp.no_int_sp = spd.no_int_sp
                WHERE 1=1    AND spd.SN LIKE '%{$serial_number}%' AND d.area_id <> 999 ";
        }

        $data = $this->db->query($sql)->result();

        $rowsult = array();
        $result = array();
        if ($data) {
            $result['id'] = null;
            $result['kode'] = null;
            $result['text'] = 'None';
            $result['address'] = null;
            $result['telp'] = null;
            array_push($rowsult, $result);

            foreach ($data as $k) {
                $result['id'] = $k->id;
                $result['kode'] = $k->cust_id;
                $result['text'] = $k->cust;
                $result['address'] = $k->alamat;
                $result['telp'] = $k->telp;

                array_push($rowsult, $result);
            }
        } else {
            $result['id'] = $search;
            $result['kode'] = $search;
            $result['text'] = $search;
            array_push($rowsult, $result);
        }

        return array('results' => $rowsult);
    }

    public function getExport($q = null, $tgl1, $tgl2)
    {


        $sql = "SELECT wo.*, p.product_id, p.product_name, c.area_name, d.warehouse_name,
                e.no_int_sgh, e.sgh_name AS kerusakan, f.nama as teknisi, IF(wo.taken_by_customer = 0,'No', 'Yes') AS taken,ps.`product_name` AS sparepart,
                ps.product_id AS sparepart_id, wod.price, IF(wod.jasa_id IN (1,2),bj.jasa_name, 'bukan biaya jasa') AS jasa_text, wod.qty
                FROM sparepart_wo_header wo
                LEFT JOIN sparepart_wo_detail wod ON wo.no_int_wo = wod.no_int_wo
                LEFT JOIN sparepart_biaya_jasa bj ON wod.jasa_id = bj.jasa_id
                JOIN tb_product p ON wo.no_int_product = p.no_int_product
                LEFT JOIN tb_product ps ON wod.`no_int_product` = ps.no_int_product
                JOIN tb_area c ON c.area_id = wo.area_id
                LEFT JOIN tb_warehouse d ON d.warehouse_id = wo.warehouse_id
                JOIN sparepart_gejala_header e ON e.no_int_sgh = wo.jenis_kerusakan
                LEFT JOIN sparepart_teknisi f ON f.teknisi_id = wo.teknisi_id
                WHERE 1=1 AND (DATE(wo.dt_doc) BETWEEN '" . date("Y-m-d", strtotime($tgl1)) . "' AND '" . date("Y-m-d", strtotime($tgl2)) . "' OR DATE(wo.date_done) BETWEEN '" . date("Y-m-d", strtotime($tgl1)) . "' AND '" . date("Y-m-d", strtotime($tgl2)) . "') ";

        // check session Area
        if ($this->area_id) {
            $sql .= " AND wo.area_id = {$this->area_id} ";
        }

        if ($q) {
            $sql .= " AND (
                  wo.no_doc LIKE '%{$q}%'
                  OR wo.nama_pemilik LIKE '%{$q}%'
                  OR wo.telp LIKE '%{$q}%'
                )";
        }
        // print_r($sql); exit();
        $ret['total'] = $this->dmudb->query($sql)->num_rows();

        $sql .= " ORDER BY wo.no_int_wo desc";

        $ret['data'] = $this->dmudb->query($sql)->result();

        return $ret;
    }
}
