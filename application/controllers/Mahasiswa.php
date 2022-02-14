<?php
defined('BASEPATH') or exit('No direct script access allowed');

// set time zone
date_default_timezone_set('Asia/Jakarta');

class Mahasiswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Dosen_model');
        $this->load->model('Koordinator_model');
        $this->load->model('Mahasiswa_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->GetUser($email);
        $npm_mhs = $this->session->userdata('npm');
        $data['dosen'] = $this->Mahasiswa_model->getDsnBim($npm_mhs);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/index', $data);
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
            $this->load->view('mahasiswa/edit', $data);
            $this->load->view('templates/footer');
        } else {

            $name = $this->input->post('name');
            $prodi = $this->input->post('prodi');
            $nik = $this->input->post('nik');
            $email = $this->input->post('email');

            $data = array(
                'name' => $name,
                'prodi' => $prodi,
                'nik' => $nik
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
            redirect('mahasiswa');
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
            $this->load->view('mahasiswa/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_passsword1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password lama tidak sesuai !</div>');
                redirect('mahasiswa/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                    <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password baru tidak boleh sama dengan Password lama</div>');
                    redirect('mahasiswa/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);


                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                    <span class="icon-sc-cl" aria-hidden="true">x</span></button>Password Berhasil DiUbah</div>');
                    redirect('mahasiswa/changepassword');
                }
            }
        }
    }

    public function uploadlaporan()
    {
        $data['title']  = 'Upload Laporan';
        $email          = $this->session->userdata('email');
        $hakAkses       = $this->session->userdata('role_id');
        $data['user']   = $this->Menu_model->GetUser($email);

        if ($hakAkses == '3') {
            $npm = $this->session->userdata('npm');
        } else {
            $npm = '';
        }
        $data['dt_bim'] = $this->Koordinator_model->getDataBimbingan($npm);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/uploadlaporan', $data);
        $this->load->view('templates/footer');
    }

    public function uploadFileMhs()
    {
        $nama    = $this->session->userdata('name');
        $npm_mhs = $this->input->post('npm_mhs');
        $nik_dsn = $this->input->post('nik_dsn');
        $topik   = $this->input->post('topik');

        $bim_ke  = $this->Mahasiswa_model->getBimbinganKe($npm_mhs, $nik_dsn);

        $config['upload_path']   = './assets/file/laporan/bimbingan/';
        $config['allowed_types'] = 'pdf';
        $config['max_size']      = '16048';
        $config['overwrite']     = true;
        $config['file_name']     = 'laporan_' . $nik_dsn . '_' . $npm_mhs . '_' . date('Ymd') . '_' . date('His'); //nama file

        $this->load->library('upload', $config);

        if (isset($_FILES['laporanPKL'])) {
            if ($this->upload->do_upload('laporanPKL')) {
                $file       = $config['file_name'] . $this->upload->data('file_ext'); // nama file + fungsi upload
                $tgl_upload = date('Y-m-d H:i:s');

                $data = array(
                    'npm_mhs'       => $npm_mhs,
                    'nik_dsn'       => $nik_dsn,
                    'file_mhs'      => $file,
                    'bimbingan_ke'  => $bim_ke,
                    'topik'         => $topik,
                    'proyek_ke'     => '2',
                    'tahun_ajaran'  => '2021/2022',
                    'created_at'    => $tgl_upload,
                    'created_by'    => $nama
                );

                $hasil = $this->Mahasiswa_model->uploadFileMhs($data); // mengirimkan data ke model

                if ($hasil) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                    <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Upload</div>');
                    redirect('mahasiswa/uploadlaporan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                    <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Upload</div>');
                    redirect('mahasiswa/uploadlaporan');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>' . $this->upload->display_errors() . '</div>');
                redirect('mahasiswa/uploadlaporan');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                <span class="icon-sc-cl" aria-hidden="true">x</span></button>GAGAL</div>');
            redirect('mahasiswa/uploadlaporan');
        }
    }

    public function datadosen()
    {
        $data['title'] = 'Data Dosen';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->GetUser($email);

        $data['data_dsn'] = $this->Dosen_model->getDataDsn();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/datadosen', $data);
        $this->load->view('templates/footer');
    }

    // Start Proses Data Dosen
    public function addDsn()
    {
        $nik    = $this->input->post('nik_dsn');
        $nama   = $this->input->post('nama_dsn');
        $prodi  = $this->input->post('prodi_dsn');
        $status = $this->input->post('status_dsn');

        $data = array(
            'nik_dsn'    => $nik,
            'nama_dsn'   => $nama,
            'prodi_dsn'  => $prodi,
            'status_dsn' => $status
        );

        $hasil = $this->Dosen_model->addDsn($data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Tambahkan</div>');
            redirect('mahasiswa/datadosen');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Tambahkan</div>');
            redirect('mahasiswa/datadosen');
        }
    }

    public function editDsn()
    {
        $id_dsn = $this->input->post('id_dsn');
        $nik    = $this->input->post('nik_dsn');
        $nama   = $this->input->post('nama_dsn');
        $prodi  = $this->input->post('prodi_dsn');
        $status = $this->input->post('status_dsn');

        $data = array(
            'nik_dsn'    => $nik,
            'nama_dsn'   => $nama,
            'prodi_dsn'  => $prodi,
            'status_dsn' => $status
        );

        $hasil = $this->Dosen_model->editDsn($id_dsn, $data);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Ubah</div>');
            redirect('mahasiswa/datadosen');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Ubah</div>');
            redirect('mahasiswa/datadosen');
        }
    }

    public function deleteDsn($id_dsn)
    {
        $hasil = $this->Dosen_model->deleteDsn($id_dsn);

        if ($hasil) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Berhasil Di Hapus</div>');
            redirect('mahasiswa/datadosen');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal Di Hapus</div>');
            redirect('mahasiswa/datadosen');
        }
    }
    // End Proses Data Dosen

    public function jurnalLaporan()
    {
        $data['title'] = 'Jurnal Laporan';
        $email = $this->session->userdata('email');
        $data['user'] = $this->Menu_model->GetUser($email);
        $npm_mhs = $this->session->userdata('npm');

        $data['jrnLaporan'] = $this->Koordinator_model->getJurnalLaporan($npm_mhs);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mahasiswa/jurnalLaporan', $data);
        $this->load->view('templates/footer');
    }

    public function downloadLaporan()
    {
        if ($this->uri->segment(3)) {
            $data   = file_get_contents('./assets/file/laporan/bimbingan/' . $this->uri->segment(3));
        }
        $name   = $this->uri->segment(3);
        force_download($name, $data);
    }

    public function downloadLaporanRevisi()
    {
        if ($this->uri->segment(3)) {
            $data   = file_get_contents('./assets/file/laporan/revisi/' . $this->uri->segment(3));
        }
        $name   = $this->uri->segment(3);
        force_download($name, $data);
    }
}
