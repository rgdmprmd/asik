<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('Admin_model', 'admin');
        $this->load->library('pagination');
    }

    /* -------------------------- DASHBOARD ----------------------------- */

    public function index()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['title'] = 'Dashboard';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }

    /* -------------------------- MENU MANAGEMENT ----------------------------- */
    
    public function menu()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['menus'] = $this->admin->getMenu(1);
        $data['title'] = 'Menu Management';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/menu', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ajaxGetAllMenu()
    {
        $search = $this->input->post('search', true);
        $status = $this->input->post('status', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 8;
        
        $menu = $this->admin->getAllMenu($search, $status, $limit, $offset);
        $tr = '';
        $paging = '';
        
        if($menu['total'] > 0) {
            $total = $menu['total'];
            $i = $offset + 1;
            
            foreach($menu['data'] as $m) {
                $tr .= '<tr>';
                $tr .= '<td class="text-center">'.$i++.'</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="badge badge-success p-2 menu-edit" data-id="'.$m['menu_id'].'" data-toggle="modal" data-target="#newMenuModal"><i class="fas fa-edit"></i> Edit</a>';
                $tr .= '</td>';
                $tr .= '<td class="text-center">'.$m['menu_nama'].'</td>';
                if($m['menu_status'] == 1) {
                    $tr .= '<td class="text-center"><strong class="text-success">Active</strong></td>';
                } else {
                    $tr .= '<td class="text-center"><strong class="text-danger">Denied</strong></td>';
                }
                $tr .= '</tr>';        
            }
            
            $paging .= $this->_paging($total, $limit, 'ajaxGetAllMenu');
            $paging .= '<span class="page-info">Displaying ' . ($i - 1) . ' of ' . $total . ' data</span>';
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="4">No data</td>';
            $tr .= '</tr>';
        }
        
        $result = [
            'result' => true,
            'error' => $paging,
            'hasil' => $tr
        ];
        echo json_encode($result);
    }

    public function ajaxGetAllSubmenu()
    {
        $search = $this->input->post('search', true);
        $status = $this->input->post('status', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 8;
        
        $submenu = $this->admin->getAllSubmenu($search, $status, $limit, $offset);
        $tr = '';
        $paging = '';
        
        if($submenu['total'] > 0) {
            $total = $submenu['total'];
            $i = $offset + 1;
            
            foreach($submenu['data'] as $m) {
                $tr .= '<tr>';
                $tr .= '<td class="text-center">'.$i++.'</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="badge badge-success p-2 submenu-edit" data-id="'.$m['submenu_id'].'" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-edit"></i> Edit</a>';
                $tr .= '</td>';
                $tr .= '<td class="text-center">'.$m['submenu_nama'].'</td>';
                $tr .= '<td class="text-center">'.$m['menu_nama'].'</td>';
                $tr .= '<td class="text-center">'.$m['submenu_url'].'</td>';
                $tr .= '<td class="text-center">'.$m['submenu_icon'].'</td>';
                if($m['submenu_status'] == 1) {
                    $tr .= '<td class="text-center"><strong class="text-success">Active</strong></td>';
                } else {
                    $tr .= '<td class="text-center"><strong class="text-danger">Denied</strong></td>';
                }
                $tr .= '</tr>';        
            }

            $paging .= $this->_paging($total, $limit, 'ajaxGetAllSubmenu');
            $paging .= '<span class="page-info">Displaying ' . ($i - 1) . ' of ' . $total . ' data</span>';
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="7">No data</td>';
            $tr .= '</tr>';
        }

        $result = [
            'result' => true,
            'error' => $paging,
            'hasil' => $tr
        ];

        echo json_encode($result);
    }

    public function ajaxGetMenuById()
    {
        $id = $this->input->post('idJson', true);
        $menu = $this->admin->getMenuById($id);

        echo json_encode($menu);
    }

    public function ajaxGetSubmenuById()
    {
        $id = $this->input->post('idJson', true);
        $menu = $this->admin->getSubmenuById($id);

        echo json_encode($menu);
    }

    public function addMenu()
    {
        $menu_nama = $this->input->post('menu', true);

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
        
        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('failadd', 'menu');
            redirect('admin/menu');
        } else {
            $data = [
                'menu_nama' => $menu_nama,
                'dateCreated' => date('Y-m-d H:i:s'),
                'dateModified' => NULL,
                'email_input' => $this->session->userdata('email'),
                'email_update' => NULL,
                'menu_status' => 1
            ];
            
            $this->admin->menuAdd($data);
            $this->session->set_flashdata('succadd', 'menu');
            redirect('admin/menu');
        }
    }

    public function updateMenu()
    {
        $menu_id = $this->input->post('menu_id', true);
        $menu_nama = $this->input->post('menu', true);

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
        
        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('failupdate', 'menu');
            redirect('admin/menu');
        } else {
            $data = [
                'menu_nama' => $menu_nama,
                'dateModified' => date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];
            
            $this->admin->menuUpdate($data, $menu_id);
            $this->session->set_flashdata('succupdate', 'menu');
            redirect('admin/menu');
        }
    }
    
    public function addSubmenu()
    {
        $submenu_nama = $this->input->post('submenu_nama', true);
        $submenu_url = $this->input->post('submenu_url', true);
        $submenu_icon = $this->input->post('submenu_icon', true);
        $submenu_status = $this->input->post('submenu_status', true);
        $id_menu = $this->input->post('id_menu', true);

        $this->form_validation->set_rules('submenu_nama', 'Submenu', 'required|trim');
        $this->form_validation->set_rules('submenu_url', 'Submenu URL', 'required|trim');
        $this->form_validation->set_rules('submenu_icon', 'Submenu Icon', 'required|trim');
        $this->form_validation->set_rules('id_menu', 'Menu ID', 'required|trim');
        
        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('failadd', 'submenu');
            redirect('admin/menu');
        } else {
            $data = [
                'menu_id' => $id_menu,
                'submenu_nama' => $submenu_nama,
                'submenu_url' => $submenu_url,
                'submenu_icon' => $submenu_icon,
                'submenu_status' => $submenu_status,
                'dateCreated' => date('Y-m-d H:i:s'),
                'dateModified' => date('Y-m-d H:i:s'),
                'email_input' => $this->session->userdata('email'),
                'email_update' => $this->session->userdata('email')
            ];
            
            $this->admin->submenuAdd($data);
            $this->session->set_flashdata('succadd', 'submenu');
            redirect('admin/menu');
        }
    }

    public function updateSubmenu()
    {
        $submenu_id = $this->input->post('submenu_id', true);
        $submenu_nama = $this->input->post('submenu_nama', true);
        $submenu_url = $this->input->post('submenu_url', true);
        $submenu_icon = $this->input->post('submenu_icon', true);
        $submenu_status = $this->input->post('submenu_status', true);
        $id_menu = $this->input->post('id_menu', true);

        $this->form_validation->set_rules('submenu_nama', 'Submenu', 'required|trim');
        $this->form_validation->set_rules('submenu_url', 'Submenu URL', 'required|trim');
        $this->form_validation->set_rules('submenu_icon', 'Submenu Icon', 'required|trim');
        $this->form_validation->set_rules('id_menu', 'Menu ID', 'required|trim');
        
        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('failupdate', 'submenu');
            redirect('admin/menu');
        } else {
            $data = [
                'menu_id' => $id_menu,
                'submenu_nama' => $submenu_nama,
                'submenu_url' => $submenu_url,
                'submenu_icon' => $submenu_icon,
                'submenu_status' => $submenu_status,
                'dateCreated' => date('Y-m-d H:i:s'),
                'dateModified' => date('Y-m-d H:i:s'),
                'email_input' => $this->session->userdata('email'),
                'email_update' => $this->session->userdata('email')
            ];
            
            $this->admin->submenuUpdate($data, $submenu_id);
            $this->session->set_flashdata('succupdate', 'submenu');
            redirect('admin/menu');
        }
    }

    /* -------------------------- ROLE ----------------------------- */

    public function role()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();

        $data['title'] = 'Role';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function ajaxGetAllRole()
    {
        $role = $this->admin->getAllRole();
        $tr = '';
        
        if($role) {
            $i = 1;
            
            foreach($role as $r) {
                $tr .= '<tr>';
                $tr .= '<td class="text-center">'.$i++.'</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="badge badge-success p-2 role-edit" data-id="'.$r['role_id'].'" data-toggle="modal" data-target="#roleModal"><i class="fas fa-fw fa-edit"></i> Edit</a>';
                $tr .= '<a href="" class="badge badge-primary p-2 role-access ml-1" data-id="'.$r['role_id'].'" data-toggle="modal" data-target="#accessModal"><i class="fas fa-fw fa-lock"></i> Access</a>';
                $tr .= '</td>';
                $tr .= '<td class="text-center">'.$r['role_nama'].'</td>';
                $tr .= '</tr>';        
            }
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="3">No data</td>';
            $tr .= '</tr>';
        }

        echo json_encode($tr);
    }

    public function ajaxGetRoleById()
    {
        $id = $this->input->post('idJson');
        $data = $this->admin->getRoleById($id);

        echo json_encode($data);
    }

    public function addRole()
    {
        $role_nama = $this->input->post('role_nama', true);

        $this->form_validation->set_rules('role_nama', 'Role Name', 'required|trim');
        
        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('failadd', 'role');
            redirect('admin/role');
        } else {
            $data = [
                'role_nama' => $role_nama,
                'dateCreated' => date('Y-m-d H:i:s'),
                'dateModified' => NULL,
                'email_input' => $this->session->userdata('email'),
                'email_update' => NULL
            ];
            
            $this->admin->roleAdd($data);
            $this->session->set_flashdata('succadd', 'role');
            redirect('admin/role');
        }
    }

    public function updateRole()
    {
        $role_id = $this->input->post('role_id', true);
        $role_nama = $this->input->post('role_nama', true);

        $this->form_validation->set_rules('role_nama', 'Role Name', 'required|trim');
        
        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('failupdate', 'role');
            redirect('admin/role');
        } else {
            $data = [
                'role_nama' => $role_nama,
                'dateModified' => date('Y-m-d H:i:s'),
                'email_update' => $this->session->userdata('email')
            ];
            
            $this->admin->roleUpdate($data, $role_id);
            $this->session->set_flashdata('succupdate', 'role');
            redirect('admin/role');
        }
    }

    public function ajaxGetRoleAccess()
    {
        $role_id = $this->input->post('role_id', true);
        $role = $this->admin->getRoleById($role_id);
        $menu = $this->admin->getMenu(2);
        $tr = '';
        
        if($menu) {
            $i = 1;
            
            foreach($menu as $m) {
                $tr .= '<tr>';
                $tr .= '<td class="text-center">'.$i++.'</td>';
                $tr .= '<td class="text-center">'.$m['menu_nama'].'</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<div class="form-check">';
                $tr .= '<input class="form-check-input cekboxs" type="checkbox" '.check_access($role_id, $m['menu_id']).' data-role="'.$role_id.'" data-menu="'.$m['menu_id'].'">';
                $tr .= '</div>';
                $tr .= '</td>';
                $tr .= '</tr>';
            }
        } else {
            $tr .= '<tr>';
            $tr .= '<td colspan="4">No data</td>';
            $tr .= '</tr>';
        }

        echo json_encode(array('role' => $role, 'menu' => $tr));
    }

    public function changeAccess()
    {
        $role_id = $this->input->post('roleId');
        $menu_id = $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $getAccess = $this->admin->getAccess($data);

        if($getAccess < 1) {
            $insert = [
                'role_id' => $role_id,
                'menu_id' => $menu_id,
                'dateCreated' => Date('Y-m-d H:i:s'),
                'dateModified' => NULL,
                'email_input' => $this->session->userdata('email'),
                'email_update' => NULL
            ];
            
            $this->admin->setAccess($insert);
        } else {
            $this->admin->dropAccess($data);
        }

        echo json_encode('Access changed!');
    }

    /* -------------------------- ROLE ----------------------------- */

    public function users()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('users', ['user_email' => $email])->row_array();
        $data['role'] = $this->admin->getAllRole();
        $data['title'] = 'Users';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ajaxGetUsers()
    {
        $search = $this->input->post('search', true);
        $status = $this->input->post('status', true);
        $offset = $this->uri->segment(3, 0);
        $limit  = 8;

        $users = $this->admin->getAllUsers($search, $status, $limit, $offset);
        $tr = '';
        $paging = '';
        
        if($users['total'] > 0) {
            $total = $users['total'];
            $i = $offset + 1;
            
            foreach($users['data'] as $user) {

                $tr .= '<tr>';
                $tr .= '<td class="text-center">'.$i++.'</td>';
                $tr .= '<td class="text-center">';
                $tr .= '<a href="" class="btn btn-primary btn-sm px-3 user-edit" data-id="'.$user['user_id'].'" data-toggle="modal" data-target="#userControl"><i class="fas fa-fw fa-cog"></i> Controls</a>';
                $tr .= '</td>';
                $tr .= '<td class="text-left"><span class="badge badge-success p-2">'.$user['role_nama'].'</span> '.$user['user_nama'].'</td>';
                $tr .= '<td class="text-left">'.$user['user_email'].'</td>';
                if($user['user_status'] == 1) {
                    $tr .= '<td class="text-center text-primary"><b>Active</b></td>';
                } else {
                    $tr .= '<td class="text-center text-danger"><b>Denied</b></td>';
                }
                $tr .= '</tr>';        
            }

            $paging .= $this->_paging($total, $limit, 'ajaxGetUsers');
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

    public function ajaxGetUserById()
    {
        $id = $this->input->post('idJson', true);

        $user = $this->admin->getUserById($id);

        echo json_encode($user);
    }

    public function ajaxUpdateUsers()
    {
        $id = $this->input->post('user_id', true);
        $role = $this->input->post('user_role', true);
        $status = $this->input->post('user_status', true);

        $data = [
            'role_id' => $role,
            'user_status' => $status,
            'dateModified' => Date('Y-m-d H:i:s')
        ];

        $result = $this->admin->updateUsers($data, $id);

        echo json_encode($result);
    }

    private function _paging($total, $limit, $modul)
    {
        $config = [
            'base_url'  => base_url() . 'admin/' . $modul,
            'total_rows' => $total,
            'per_page'  => $limit,
            'uri_segment' => 3
        ];

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }
}