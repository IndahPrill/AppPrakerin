<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koordinator extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Koordinator_model');
        $this->load->model('Dosen_model');
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
        $this->load->view('koordinator/index', $data);
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
            $this->load->view('koordinator/edit', $data);
            $this->load->view('templates/footer');
        } else {

            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $data = array(
                'name' => $name,
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
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Profil Berhasil DiUbah</div>');
            redirect('koordinator');
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
            $this->load->view('koordinator/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_passsword1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password lama tidak sesuai !</div>');
                redirect('koordinator/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                    <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password baru tidak boleh sama dengan Password lama</div>');
                    redirect('koordinator/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $hasil = $this->db->update('user');

                    if ($hasil) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                        <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password Berhasil DiUbah</div>');
                        redirect('koordinator/changepassword');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                        <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password Berhasil DiUbah</div>');
                        redirect('koordinator/changepassword');
                    }
                }
            }
        }
    }

    public function lokasiPKL()
    {
        $data['title'] = 'Lokasi PKL';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->GetUser($email);
        $data['lksPkl'] = $this->Koordinator_model->getdataLksPkl();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('koordinator/lokasiPKL', $data);
        $this->load->view('templates/footer');
    }

    // Start Proses Data Lokasi
    public function addLksPkl()
    {
        $npm            = $this->input->post('npm_mhs');
        $nm_perusahaan  = $this->input->post('nama_perusahaan');
        $almt_lks       = $this->input->post('alamat_lks');
        $dsn_eks        = $this->input->post('dsn_eksternal');
        $no_tlp_dsn_eks = $this->input->post('no_tlp_dsn_eksternal');

        $data = array(
            'npm_mhs'               => $npm,
            'nama_perusahaan'       => $nm_perusahaan,
            'alamat_lks'            => $almt_lks,
            'dsn_eksternal'         => $dsn_eks,
            'no_tlp_dsn_eksternal'  => $no_tlp_dsn_eks
        );

        $hasil = $this->Koordinator_model->addLksPkl($data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Tambahkan</div>');
            redirect('koordinator/lokasiPKL');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Tambahkan</div>');
            redirect('koordinator/lokasiPKL');
        }
    }

    public function editLksPkl()
    {
        $id_lks         = $this->input->post('id_lks');
        $npm            = $this->input->post('npm_mhs');
        $nm_perusahaan  = $this->input->post('nama_perusahaan');
        $almt_lks       = $this->input->post('alamat_lks');
        $dsn_eks        = $this->input->post('dsn_eksternal');
        $no_tlp_dsn_eks = $this->input->post('no_tlp_dsn_eksternal');

        $data = array(
            'npm_mhs'               => $npm,
            'nama_perusahaan'       => $nm_perusahaan,
            'alamat_lks'            => $almt_lks,
            'dsn_eksternal'         => $dsn_eks,
            'no_tlp_dsn_eksternal'  => $no_tlp_dsn_eks
        );

        $hasil = $this->Koordinator_model->editLksPkl($id_lks, $data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Ubah</div>');
            redirect('koordinator/lokasiPKL');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Ubah</div>');
            redirect('koordinator/lokasiPKL');
        }
    }

    public function deleteLksPkl($id_lks)
    {
        $hasil = $this->Koordinator_model->deleteLksPkl($id_lks);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Hapus</div>');
            redirect('koordinator/lokasiPKL');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Hapus</div>');
            redirect('koordinator/lokasiPKL');
        }
    }
    // End Proses Data Lokasi

    public function dftrDsnPembimbing()
    {
        $data['title'] = 'Dosen Pembimbing';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->GetUser($email);
        $data['dsnPembimbing'] = $this->Koordinator_model->getdataDsnPembimbing();
        $data['data_dsn'] = $this->Koordinator_model->getDataDsn();
        $data['data_mhs'] = $this->Koordinator_model->getDataMhs();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('koordinator/dftrDsnPembimbing', $data);
        $this->load->view('templates/footer');
    }

    // Start Proses Data Dosen Pembimbing
    public function addDsnPembimbing()
    {
        $nik_dsn    = $this->input->post('nik_dsn');
        $npm_mhs    = $this->input->post('npm_mhs');

        $data = array(
            'nik_dsn'   => $nik_dsn,
            'npm_mhs'   => $npm_mhs
        );

        $hasil = $this->Koordinator_model->addDsnPembimbing($data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Tambahkan</div>');
            redirect('koordinator/dftrDsnPembimbing');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Tambahkan</div>');
            redirect('koordinator/dftrDsnPembimbing');
        }
    }

    public function editDsnPembimbing()
    {
        $id_bim     = $this->input->post('id_bim');
        $nik_dsn    = $this->input->post('nik_dsn');
        $npm_mhs    = $this->input->post('npm_mhs');

        $data = array(
            'nik_dsn'   => $nik_dsn,
            'npm_mhs'   => $npm_mhs
        );

        $hasil = $this->Koordinator_model->editDsnPembimbing($id_bim, $data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Ubah</div>');
            redirect('koordinator/dftrDsnPembimbing');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Ubah</div>');
            redirect('koordinator/dftrDsnPembimbing');
        }
    }

    public function deleteDsnPembimbing($id_bim)
    {
        $hasil = $this->Koordinator_model->deleteDsnPembimbing($id_bim);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Hapus</div>');
            redirect('koordinator/dftrDsnPembimbing');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Hapus</div>');
            redirect('koordinator/dftrDsnPembimbing');
        }
    }
    // End Proses Data Dosen Pembimbing
}
