<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        is_logged_in();
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->Menu_model->GetUser($email);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $nameRole = $this->input->post('role');
            $this->Menu_model->insertData($nameRole);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span>
            </button>Role Berhasil Di Tambahkan!!!</div>');
            // $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            redirect('admin/role');
        }
    }

    public function roleEdit()
    {
        $id       = $this->input->post('id');
        $nameRole = $this->input->post('role');

        $data = array(
            'role' => $nameRole,
        );

        $this->Menu_model->editData($id, $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
        <span class="icon-sc-cl" aria-hidden="true">x</span></button>Role Berhasil Di Ubah!!!</div>');

        redirect('admin/role');
    }

    public function roleaccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id_data)
    {
        $this->Menu_model->hapusrole($id_data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
        <span class="icon-sc-cl" aria-hidden="true">x</span>
        </button>Role Berhasil Di Hapus!!!</div>');
        redirect('admin/role');
    }


    public function changeAccess()
    {
        $menu_Id = $this->input->post('menuId');
        $role_Id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_Id,
            'menu_id' => $menu_Id
        ];


        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
    }
}
