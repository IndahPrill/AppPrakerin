<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        $role_id = $ci->session->userdata('role_id');

        if ($role_id == "1") {
            redirect('Admin');
        } else if ($role_id == "2") {
            redirect('Dosen');
        } else if ($role_id == "3") {
            redirect('Mahasiswa');
        } else if ($role_id == "4") {
            redirect('Koordinator');
        } else {
            redirect('auth');
        }
    } else {
        $role_id = $ci->session->userdata('role_id');
        // $menu = $ci->uri->segment(1);

        // $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        // $menu_id = $queryMenu['id'];


        // $userAccess = $ci->db->get_where('user_access_menu', [
        //     'role_id' => $role_id,
        //     'menu_id' => $menu_id
        // ]);
        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked = 'checked'";
    }
}
