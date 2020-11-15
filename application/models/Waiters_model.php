<?php defined('BASEPATH') or exit('No direct script access allowed');

class Waiters_model extends CI_Model
{
    public function getAllMeja($status, $search, $limit, $offset)
    {
        $where_status = "";
        if ($status != 2) {
            $where_status = " AND m.isTaken = {$status}";
        }

        $where_search = "";
        if ($search) {
            $where_search = " AND j.jenismeja_nama LIKE '%{$search}%'";
        }

        $sql = "SELECT * FROM meja m JOIN meja_jenis j USING(jenismeja_id) WHERE 0=0 {$where_status} {$where_search} LIMIT {$offset}, {$limit}";
        $sql_count = "SELECT * FROM meja m JOIN meja_jenis j USING(jenismeja_id) WHERE 0=0 {$where_status} {$where_search}";

        $data['data'] = $this->db->query($sql)->result_array();
        $data['total'] = $this->db->query($sql_count)->num_rows();

        return $data;
    }

    public function jenisMenuActive()
    {
        return $this->db->get_where('menu_jenis', ['makananjenis_status' => 1])->result_array();
    }

    public function getAllMenuMakanan($status, $search, $limit, $offset)
    {
        $where_status = "";
        if ($status != 0) {
            $where_status = " AND m.makananjenis_id = {$status}";
        }

        $where_search = "";
        if ($search) {
            $where_search = " AND m.makanan_nama LIKE '%{$search}%'";
        }

        $sql = "SELECT * FROM menu_makanan m JOIN menu_jenis j USING (makananjenis_id) WHERE 0=0 {$where_status} {$where_search} ORDER BY m.makanan_id DESC LIMIT {$offset}, {$limit}";
        $sql_count = "SELECT * FROM menu_makanan m JOIN menu_jenis j USING (makananjenis_id) WHERE 0=0 {$where_status} {$where_search} ORDER BY m.makanan_id DESC";

        $data['data'] = $this->db->query($sql)->result_array();
        $data['total'] = $this->db->query($sql_count)->num_rows();

        return $data;
    }

    public function getAllPesanan($status, $search, $limit, $offset)
    {
        $where_status = "";
        if ($status != 99) {
            $where_status = " AND pesanan_status = {$status}";
        }

        $where_search = "";
        if ($search) {
            $where_search = " AND m.meja_nomer LIKE '%{$search}%'";
        }

        $sql = "SELECT * FROM pesanan_header h JOIN meja m USING (meja_id) WHERE 0=0 {$where_status} {$where_search} ORDER BY h.pesanan_id DESC LIMIT {$offset}, {$limit}";
        $sql_count = "SELECT * FROM pesanan_header h JOIN meja m USING (meja_id) WHERE 0=0 {$where_status} {$where_search}";

        $data['data'] = $this->db->query($sql)->result_array();
        $data['total'] = $this->db->query($sql_count)->num_rows();

        return $data;
    }

    public function getMejaActive($offset = 0, $limit = 0, $search = null, $jumlah_tamu = 0)
    {
        $where_search = "";
        if ($search != null) {
            $where_search = " AND m.meja_nomer LIKE '%{$search}%'";
        }

        $sql = "SELECT * FROM meja m JOIN meja_jenis j USING (jenismeja_id) WHERE m.kursi_tersedia >= {$jumlah_tamu} AND m.isTaken = 0 {$where_search}";

        $total = $this->db->query($sql)->num_rows();

        if ($limit > 0) {
            $sql .= " ORDER BY m.meja_nomer ASC LIMIT {$offset}, {$limit} ";
        }

        $data = $this->db->query($sql)->result_array();

        $rowResult = array();
        $result = array();

        if ($data) {
            foreach ($data as $d) {
                $result['id']       = $d['meja_id'];
                $result['text']     = $d['meja_nomer'] . ' | ' . $d['jenismeja_nama'];
                $result['jenis']     = $d['jenismeja_nama'];
                $result['status']   = true;

                array_push($rowResult, $result);
            }
        } else {
            $result['id'] = null;
            $result['text'] = 'Oops, meja tidak ditemukan.';
            $result['jenis']     = 0;
            $result['status'] = '404';

            array_push($rowResult, $result);
        }

        return array('results' => $rowResult, 'total' => $total);
    }

    public function getMenuActive($offset = 0, $limit = 0, $search = null)
    {
        $where_search = "";
        if ($search != null) {
            $where_search = " AND makanan_nama LIKE '%{$search}%'";
        }

        $sql = "SELECT * FROM menu_makanan WHERE makanan_status = 1 {$where_search}";

        $total = $this->db->query($sql)->num_rows();

        if ($limit > 0) {
            $sql .= " ORDER BY makanan_nama ASC LIMIT {$offset}, {$limit} ";
        }

        $data = $this->db->query($sql)->result_array();

        $rowResult = array();
        $result = array();

        if ($data) {
            foreach ($data as $d) {
                $result['id']       = $d['makanan_id'];
                $result['text']     = $d['makanan_nama'];
                $result['harga']    = $d['makanan_harga'];
                $result['status']   = true;

                array_push($rowResult, $result);
            }
        } else {
            $result['id'] = null;
            $result['text'] = 'Oops, jenis makanan tidak ditemukan.';
            $result['harga']     = 0;
            $result['status'] = '404';

            array_push($rowResult, $result);
        }

        return array('results' => $rowResult, 'total' => $total);
    }

    public function getMejaById($id)
    {
        return $this->db->get_where('meja', ['meja_id' => $id])->row_array();
    }

    public function updateMeja($data, $id)
    {
        $this->db->where('meja_id', $id);
        $this->db->update('meja', $data);

        return true;
    }

    public function insertPesananHeader($data)
    {
        $this->db->insert('pesanan_header', $data);
        return $this->db->insert_id();
    }

    public function insertPesananDetail($data)
    {
        $this->db->insert_batch('pesanan_detail', $data);
        return true;
    }

    public function getHeaderPesananById($id)
    {
        $sql = "SELECT * FROM pesanan_header h JOIN meja m USING (meja_id) WHERE h.pesanan_id = {$id}";
        return $this->db->query($sql)->row_array();
    }

    public function getDetailPesananById($id)
    {
        $sql = "SELECT * FROM pesanan_detail d JOIN menu_makanan m USING (makanan_id) WHERE d.pesanan_id = {$id} ORDER BY d.detpesanan_id";
        return $this->db->query($sql)->result_array();
    }

    public function updatePesananHeader($data, $id)
    {
        $this->db->where('pesanan_id', $id);
        $this->db->update('pesanan_header', $data);

        return true;
    }

    public function updateStatusPesananHeader($data, $id)
    {
        $this->db->where('pesanan_id', $id);
        $this->db->update('pesanan_header', $data);

        return true;
    }
}
