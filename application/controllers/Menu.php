<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user']  = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu']  = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $hasil = $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);

            if ($hasil) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Menambahkan Menu</div>');
                redirect('menu');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Menambahkan Menu</div>');
                redirect('menu');
            }
        }
    }

    public function menuEdit()
    {
        $id       = $this->input->post('id');
        $nameMenu = $this->input->post('menu');

        $data = array(
            'menu' => $nameMenu,
        );

        $hasil = $this->Menu_model->editMenu($id, $data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Menu Berhasil Di Ubah!!!</div>');

            redirect('menu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Menu Gagal Di Ubah!!!</div>');

            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title']   = 'Sub Menu Management';
        $data['user']    = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['subMenu'] = $this->Menu_model->getSubMenu();
        $data['menu']    = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Menu', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title'     => $this->input->post('title'),
                'menu_id'   => $this->input->post('menu_id'),
                'url'       => $this->input->post('url'),
                'icon'      => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $hasil = $this->db->insert('user_sub_menu', $data);

            if ($hasil) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Menambahkan Sub Menu</div>');
                redirect('menu/submenu');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danget" role="alert">Gagal Menambahkan Sub Menu</div>');
                redirect('menu/submenu');
            }
        }
    }

    public function submenuEdit()
    {
        $data = [
            'title'     => $this->input->post('title'),
            'menu_id'   => $this->input->post('menu_id'),
            'url'       => $this->input->post('url'),
            'icon'      => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];

        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $hasil = $this->db->update('user_sub_menu', $data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Menu Berhasil Di Ubah!!!</div>');

            redirect('menu/submenu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Menu Gagal Di Ubah!!!</div>');

            redirect('menu/submenu');
        }
    }

    public function hapus($id_data)
    {
        $hasil =  $this->Menu_model->hapusmenuu($id_data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span>
            </button>Menu Berhasil Di Hapus!!!</div>');
            redirect('menu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span>
            </button>Menu Gagal Di Hapus!!!</div>');
            redirect('menu');
        }
    }


    public function hapusSub($id_data)
    {
        $hasil = $this->Menu_model->hapusSubMenu($id_data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span>
            </button>Menu Berhasil Di Hapus!!!</div>');

            redirect('menu/submenu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span>
            </button>Menu Gagal Di Hapus!!!</div>');

            redirect('menu/submenu');
        }
    }

    public function editSub($id_data)
    {

        $hasil = $this->Menu_model->editSubmenu($id_data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span>
            </button>Menu Berhasil Di Hapus!!!</div>');

            redirect('menu/submenu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span>
            </button>Menu Gagal Di Hapus!!!</div>');

            redirect('menu/submenu');
        }
    }
}
