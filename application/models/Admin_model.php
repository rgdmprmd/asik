<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getMenu($status)
    {
        if($status > 1) {

            $sql = "SELECT * FROM menu ORDER BY menu_id ASC";
        } else {
            $sql = "SELECT * FROM menu WHERE menu_status = {$status} ORDER BY menu_id ASC";
        }

        return $this->db->query($sql)->result_array();
    }
    
    public function getAllMenu($search, $status, $limit, $offset)
    {
        $where_search = '';
        if($search) {
            $where_search = " AND menu_nama LIKE '%{$search}%'";
        }

        $where_status = '';
        if($status < 2) {
            $where_status = " AND menu_status = {$status}";
        }
        
        $sql = "SELECT * FROM menu WHERE 0=0 {$where_status} {$where_search} ORDER BY menu_id ASC LIMIT {$offset}, {$limit}";
        $sql_count = "SELECT * FROM menu WHERE 0=0 {$where_status} {$where_search} ORDER BY menu_id ASC";
    
        $data['data'] = $this->db->query($sql)->result_array();
        $data['total'] = $this->db->query($sql_count)->num_rows();

        return $data;
    }
    
    public function getAllSubmenu($search, $status, $limit, $offset)
    {
        $where_search = '';
        if($search) {
            $where_search = " AND submenu_url LIKE '%{$search}%'";
        }

        $where_status = '';
        if($status < 2) {
            $where_status = " AND submenu_status = {$status}";
        }

        $sql = "SELECT * FROM submenu s JOIN menu m USING (menu_id) WHERE 0=0 {$where_status} {$where_search} ORDER BY s.submenu_id ASC LIMIT {$offset}, {$limit}";
        $sql_count = "SELECT * FROM submenu s JOIN menu m USING (menu_id) WHERE 0=0 {$where_status} {$where_search} ORDER BY s.submenu_id ASC";
        
        $data['data'] = $this->db->query($sql)->result_array();
        $data['total'] = $this->db->query($sql_count)->num_rows();

        return $data;
    }

    public function getMenuById($id)
    {
        return $this->db->get_where('menu', ['menu_id' => $id])->row_array();
    }

    public function getSubmenuById($id)
    {
        return $this->db->get_where('submenu', ['submenu_id' => $id])->row_array();
    }

    public function menuAdd($data)
    {
        $this->db->insert('menu', $data);
    }

    public function menuUpdate($data, $id)
    {
        $this->db->where('menu_id', $id);
        $this->db->update('menu', $data);
    }

    public function submenuAdd($data)
    {
        $this->db->insert('submenu', $data);
    }

    public function submenuUpdate($data, $id)
    {
        $this->db->where('submenu_id', $id);
        $this->db->update('submenu', $data);
    }

    public function getAllRole()
    {
        return $this->db->get('role')->result_array();
    }

    public function getRoleById($id)
    {
        return $this->db->get_where('role', ['role_id' => $id])->row_array();
    }

    public function roleAdd($data)
    {
        $this->db->insert('role', $data);
    }

    public function roleUpdate($data, $id)
    {
        $this->db->where('role_id', $id);
        $this->db->update('role', $data);
    }

    public function getAccess($data)
    {
        return $this->db->get_where('menu_akses', $data)->num_rows();
    }

    public function setAccess($data)
    {
        $this->db->insert('menu_akses', $data);
    }
    
    public function dropAccess($data)
    {
        $this->db->delete('menu_akses', $data);
    }

    public function getAllUsers($search, $status, $limit, $offset)
    {
        $where_search = '';
        if($search) {
            $where_search = " AND user_email LIKE '%{$search}%'";
        }

        $where_status = '';
        if($status < 2) {
            $where_status = " AND user_status = {$status}";
        }

        $sql = "SELECT * FROM users u JOIN role r USING (role_id) WHERE 0=0 {$where_status} {$where_search} ORDER BY u.user_id ASC LIMIT {$offset}, {$limit}";
        $sql_count = "SELECT * FROM users u JOIN role r USING (role_id) WHERE 0=0 {$where_status} {$where_search} ORDER BY u.user_id ASC";

        $data['data'] = $this->db->query($sql)->result_array();
        $data['total'] = $this->db->query($sql_count)->num_rows();

        return $data;
    }

    public function getUserById($id)
    {
        return $this->db->get_where('users', ['user_id' => $id])->row_array();
    }

    public function updateUsers($data, $id)
    {
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);

        return true;
    }
}