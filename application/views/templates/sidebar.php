<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-default sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>user">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-comments-dollar"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Discode</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Query dari menu -->
    <?php
        // Mengambil idRole dari session
        $roleId = $this->session->userdata('role_id');

        // Query menampilkan namaMenu yang tampil pada sidebar berdasarkan idRole
        $sqlMenu = "SELECT * FROM menu m JOIN menu_akses a USING(menu_id) WHERE a.role_id = {$roleId} ORDER BY m.menu_nama";

        // Query ke database dan fetch_array
        $menu = $this->db->query($sqlMenu)->result_array();
    ?>

    <!-- Looping Menu -->
    <?php foreach ($menu as $m) : ?>
    <!-- Menampilkan namaMenu pada sideBar -->
    <div class="sidebar-heading">
        <?= $m['menu_nama']; ?>
    </div>

    <!-- Menampilkan Submenu sesuai idMenu yang ada -->
    <?php
        // Get idMenu dari hasil join table diatas
        $menuId = $m['menu_id'];

        // Query untuk mendapatkan submenu yang ada dari setiap idMenu
        $sqlSubMenu = "SELECT * FROM submenu s JOIN menu m USING (menu_id) WHERE s.menu_id = {$menuId} AND s.submenu_status = 1 ORDER BY s.submenu_nama";

        // Query ke database dengan fetch_array
        $subMenu = $this->db->query($sqlSubMenu)->result_array();
    ?>

    <!-- Looping subMenu -->
    <?php foreach ($subMenu as $sm) : ?>
    <?php if ($title == $sm['submenu_nama']) : ?>
    <li class="nav-item active">
        <?php else : ?>
    <li class="nav-item">
        <?php endif; ?>
        <!-- Menampilkan submenu -->
        <a class="nav-link pb-0" href="<?= base_url($sm['submenu_url']); ?>">
            <i class="<?= $sm['submenu_icon']; ?>"></i>
            <span><?= $sm['submenu_nama']; ?></span>
        </a>
    </li>
    <?php endforeach; ?>

    <!-- Divider untuk setiap menu -->
    <hr class="sidebar-divider mt-3">
    <?php endforeach; ?>

    <div class="sidebar-heading">
        Escape
    </div>

    <!-- Logout Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i><span>Logout</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li> -->


    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

    <!-- Divider -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->