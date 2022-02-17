<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" style="background-image: linear-gradient(180deg,#050b1c 10%,#041954 100%)" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laptop-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-Prakerin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!----querymenu--->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT 
                        a.`id`, a.`menu`
                    FROM 
                        `user_menu` a
                        LEFT JOIN `user_access_menu` b ON a.`id` = b.`menu_id`
                    WHERE b.`role_id` = $role_id
                    GROUP BY b.`role_id`
                    ORDER BY b.`menu_id` ASC
                    ";

    $menu = $this->db->query($queryMenu)->result_array();

    ?>

    <!-- Looping menu -->
    <?php foreach ($menu as $m) {
    ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <!---submenu-->
        <?php
        $menuId = ($m['id'] == 1) ? "1,2,3,4" : $m['id']; // Menggunakan if one line

        if ($m['id'] == 1) {
            $titleMenu = "AND a.`title` NOT IN ('My Profile','Edit Profile','Change Password')";
        } else {
            $titleMenu = "";
        }

        $querySubMenu = "SELECT 
                            a.title
                            , a.url
                            , a.icon
                        FROM `user_sub_menu` a
                            LEFT JOIN `user_menu` b ON a.`menu_id` = b.`id`
                        WHERE 
                            a.`menu_id` IN ($menuId)
                            AND a.`is_active` = 1
                            $titleMenu
                    ";

        $subMenu = $this->db->query($querySubMenu)->result_array();
        // print_r($subMenu);
        // var_dump($subMenu);
        // die;

        foreach ($subMenu as $sm) { ?>
            <!-- Nav Item - Dashboard -->
            <?php if ($title == $sm['title']) { ?>
                <li class="nav-item active">
                <?php } else { ?>
                <li class="nav-item">
                <?php } ?>
                <a class="nav-link pb-0" style="width: 15rem" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title'];  ?></span></a>
                </li>

            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block mt-3">

        <?php } ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->