<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Mahasiswa_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->GetUser($email);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->GetUser($email);

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('dosen/edit', $data);
            $this->load->view('templates/footer');
        } else {

            $name = $this->input->post('name');
            $prodi = $this->input->post('prodi');
            $npm = $this->input->post('npm');
            $prodi = $this->input->post('nik');
            $email = $this->input->post('email');

            $data = array(
                'name' => $name,
                'prodi' => $prodi,
                'npm' => $npm
            );

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);


                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $this->db->set($data);
            $this->db->where('email', $email);
            $hasil = $this->db->update('user');

            if ($hasil) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Profil Berhasil Di Ubah</div>');
                redirect('dosen');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Profil Gagal Di Ubah</div>');
                redirect('dosen');
            }
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->GetUser($email);

        $this->form_validation->set_rules('current_password', 'Curent Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('dosen/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_passsword1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password lama tidak sesuai !</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                    <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password baru tidak boleh sama dengan Password lama</div>');
                    redirect('user/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $hasil = $this->db->update('user');

                    if ($hasil) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                        <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password Berhasil Di Ubah</div>');
                        redirect('dosen/changepassword');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                        <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password Gagal Di Ubah</div>');
                        redirect('dosen/changepassword');
                    }
                }
            }
        }
    }

    public function laporanm()
    {
        $data['title'] = 'Laporan Mahasiswa';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->GetUser($email);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/laporanm', $data);
        $this->load->view('templates/footer');
    }

    public function viewm()
    {
        $data['title'] = 'Data Mahasiswa';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->GetUser($email);

        $data['m_mahasiswa'] = $this->db->get('user_menu')->result_array();
        $data['data_mhs'] = $this->Mahasiswa_model->getDataMhs();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dosen/viewm', $data);
        $this->load->view('templates/footer');
    }

    // Start Proses Data Mahasiswa
    public function addMhs()
    {
        $npm    = $this->input->post('npm_mhs');
        $nama   = $this->input->post('nama_mhs');
        $prodi  = $this->input->post('prodi_mhs');
        $kelas  = $this->input->post('kelas_mhs');
        $status = $this->input->post('status_mhs');

        $data = array(
            'npm_mhs'    => $npm,
            'nama_mhs'   => $nama,
            'prodi_mhs'  => $prodi,
            'kelas_mhs'  => $kelas,
            'status_mhs' => $status
        );

        $hasil = $this->Mahasiswa_model->addMhs($data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Tambahkan</div>');
            redirect('dosen/viewm');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Tambahkan</div>');
            redirect('dosen/viewm');
        }
    }

    public function editMhs()
    {
        $id_mhs = $this->input->post('id_mhs');
        $npm    = $this->input->post('npm_mhs');
        $nama   = $this->input->post('nama_mhs');
        $prodi  = $this->input->post('prodi_mhs');
        $kelas  = $this->input->post('kelas_mhs');
        $status = $this->input->post('status_mhs');

        $data = array(
            'npm_mhs'    => $npm,
            'nama_mhs'   => $nama,
            'prodi_mhs'  => $prodi,
            'kelas_mhs'  => $kelas,
            'status_mhs' => $status
        );

        $hasil = $this->Mahasiswa_model->editMhs($id_mhs, $data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Ubah</div>');
            redirect('dosen/viewm');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Ubah</div>');
            redirect('dosen/viewm');
        }
    }

    public function deleteMhs($id_mhs)
    {
        $hasil = $this->Mahasiswa_model->deleteMhs($id_mhs);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Hapus</div>');
            redirect('dosen/viewm');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Hapus</div>');
            redirect('dosen/viewm');
        }
    }
    // End Proses Data Mahasiswa
}
