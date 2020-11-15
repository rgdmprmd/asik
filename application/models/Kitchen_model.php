<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kitchen_model extends CI_Model
{
    public function getAllMenu($status, $search, $limit, $offset)
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

    public function getAllPesanan($search, $limit, $offset)
    {
        $where_search = "";
        if ($search) {
            $where_search = " AND m.meja_nomer LIKE '%{$search}%'";
        }

        $sql = "SELECT h.dateCreated AS tgl, h.*, m.* FROM pesanan_header h JOIN meja m USING (meja_id) WHERE h.pesanan_status = 0 {$where_search} ORDER BY h.pesanan_id DESC LIMIT {$offset}, {$limit}";
        $sql_count = "SELECT h.dateCreated AS tgl, h.*, m.* FROM pesanan_header h JOIN meja m USING (meja_id) WHERE h.pesanan_status = 0 {$where_search}";

        $data['data'] = $this->db->query($sql)->result_array();
        $data['total'] = $this->db->query($sql_count)->num_rows();

        return $data;
    }

    public function getHeaderPesananById($id)
    {
        $sql = "SELECT * FROM pesanan_header h JOIN meja m USING (meja_id) WHERE h.pesanan_id = {$id}";
        return $this->db->query($sql)->row_array();
    }

    public function getDetailPesananById($id)
    {
        $sql = "SELECT * FROM pesanan_detail d JOIN menu_makanan m USING (makanan_id) WHERE d.pesanan_id = {$id}";
        return $this->db->query($sql)->result_array();
    }

    public function jenisMenuActive()
    {
        return $this->db->get_where('menu_jenis', ['makananjenis_status' => 1])->result_array();
    }

    public function updateStatusDetailPesanan($data, $id)
    {
        $this->db->where('detpesanan_id', $id);
        $this->db->update('pesanan_detail', $data);

        return true;
    }

    public function getPesananReady($id)
    {
        $sql = "SELECT * FROM pesanan_detail WHERE pesanan_id = {$id} AND detpesanan_status = 0";
        return $this->db->query($sql)->num_rows();
    }

    public function updateStatusPesananHeader($data, $id)
    {
        $this->db->where('pesanan_id', $id);
        $this->db->update('pesanan_header', $data);

        return true;
    }
}
