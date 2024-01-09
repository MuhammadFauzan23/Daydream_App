<body>
       <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
      <a class="navbar-brand me-lg-5" href="index.html"> <img class="navbar-brand-dark" src="./assets/img/brand/money.png" alt="Volt logo" /> <img class="navbar-brand-light" src="./assets/img/brand/dark.svg" alt="Volt logo" /></a>
      <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

<!-- Role Terbatas -->
    <?php  
      include 'auth/koneksi.php';          
    // Jika pengguna tidak memiliki role sebagai Pemilik, maka sidebar tidak akan ditampilkan
    $allowed_roles = ['Pemilik', 'Developer'];
      if (!in_array($_SESSION['role'], $allowed_roles)) {
            $pemilik_allow = 'style="display: none;"';
    } else {
            $pemilik_allow = '';
    }
    ?>

<?php  
      include 'auth/koneksi.php';          
    // Jika pengguna tidak memiliki role sebagai Karyawan, maka sidebar tidak akan ditampilkan
    $allowed_roles = ['Karyawan', 'Developer'];
      if (!in_array($_SESSION['role'], $allowed_roles)) {
            $karyawan_allow = 'style="display: none;"';
    } else {
            $karyawan_allow = '';
    }
    ?>

<?php  
      include 'auth/koneksi.php';          
    // Jika pengguna tidak memiliki role sebagai Developer, maka sidebar tidak akan ditampilkan
    $allowed_roles = ['Developer'];
      if (!in_array($_SESSION['role'], $allowed_roles)) {
            $developer_allow = 'style="display: none;"';
    } else {
            $developer_allow = '';
    }
    ?>


        <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
      <div class="sidebar-inner px-4 pt-3">
        <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">

          <div class="collapse-close d-md-none">
            <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
              <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                  fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </a>
          </div>
        </div>

        <ul class="nav flex-column pt-3 pt-md-0">
          <li class="nav-item muted">
            <a href="#" class="nav-link d-flex align-items-center disabled">
              <span class="sidebar-icon">
                <img src="./assets/img/brand/money.png" height="20" width="20" alt="Volt Logo" />
              </span>
              <span class="mt-1 ms-1 sidebar-text">Day-Dream!</span>
            </a>
          </li>


          <li class="nav-item" <?php echo $pemilik_allow ?>>
            <a href="akun" class="nav-link">
              <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"></path></svg>
              </span>
              <span class="sidebar-text">Jenis Akun</span>
            </a>
          </li>

          <li class="nav-item" >
            <a href="transaksi" class="nav-link">
              <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
              </span>
              <span class="sidebar-text">Input Transaksi</span>
            </a>
          </li>



          <!-- trying submenus -->
                <li class="nav-item" <?php echo $karyawan_allow ?>>
                    <span
                    class="nav-link collapsed  d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-app">
                    <span> 
                      <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path><path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                      </span> 
                      <span class="sidebar-text">Laporan</span>
                    </span>
                    <span class="link-arrow">
                      <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </span>
                  </span>

                  <div class="multi-level collapse"
                    role="list" id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                      <li class="nav-item">
                        <a href="jurnalumum" class="nav-link">
                          <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z" clip-rule="evenodd"></path></svg>
                          </span>
                          <span class="sidebar-text">Jurnal Umum</span>
                        </a>
                      </li>
                    </ul>
                  </div>

                  <div class="multi-level collapse "
                    role="list" id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                      <li class="nav-item">
                        <a href="bukubesar" class="nav-link">
                          <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path><path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path></svg>
                          </span>
                          <span class="sidebar-text">Buku Besar</span>
                        </a>
                      </li>
                    </ul>
                  </div>

                  <div class="multi-level collapse"
                    role="list" id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                      <li class="nav-item">
                        <a href="neraca" class="nav-link">
                          <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                          </span>
                          <span class="sidebar-text">Neraca Saldo</span>
                        </a>
                      </li>
                    </ul>
                  </div>


                  <!-- trying submenus -->
                <li class="nav-item" <?php echo $pemilik_allow ?>>
                    <span
                    class="nav-link collapsed  d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" data-bs-target="#submenu-app">
                    <span> 
                      <span class="sidebar-icon">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path><path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                      </span> 
                      <span class="sidebar-text">Laporan</span>
                    </span>
                    <span class="link-arrow">
                      <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </span>
                  </span>

                  <div class="multi-level collapse"
                    role="list" id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                      <li class="nav-item">
                        <a href="jurnalumum" class="nav-link">
                          <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z" clip-rule="evenodd"></path></svg>
                          </span>
                          <span class="sidebar-text">Jurnal Umum</span>
                        </a>
                      </li>
                    </ul>
                  </div>

                  <div class="multi-level collapse "
                    role="list" id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                      <li class="nav-item">
                        <a href="bukubesarpemilik" class="nav-link">
                          <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path><path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path></svg>
                          </span>
                          <span class="sidebar-text">Buku Besar</span>
                        </a>
                      </li>
                    </ul>
                  </div>

                
                  <div class="multi-level collapse"
                    role="list" id="submenu-app" aria-expanded="false">
                    <ul class="flex-column nav">
                      <li class="nav-item">
                        <a href="neracapemilik" class="nav-link">
                          <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                          </span>
                          <span class="sidebar-text">Neraca Saldo</span>
                        </a>
                      </li>
                    </ul>
                  </div>

          <li class="nav-item" <?php echo $developer_allow ?>>
            <a href="report" class="nav-link">
              <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    d="M6 2C4.89543 2 4 2.89543 4 4V16C4 17.1046 4.89543 18 6 18H14C15.1046 18 16 17.1046 16 16V7.41421C16 6.88378 15.7893 6.37507 15.4142 6L12 2.58579C11.6249 2.21071 11.1162 2 10.5858 2H6ZM8 12C8 11.4477 7.55228 11 7 11C6.44772 11 6 11.4477 6 12V15C6 15.5523 6.44772 16 7 16C7.55228 16 8 15.5523 8 15V12ZM10 9C10.5523 9 11 9.44772 11 10V15C11 15.5523 10.5523 16 10 16C9.44772 16 9 15.5523 9 15V10C9 9.44772 9.44772 9 10 9ZM14 8C14 7.44772 13.5523 7 13 7C12.4477 7 12 7.44772 12 8V15C12 15.5523 12.4477 16 13 16C13.5523 16 14 15.5523 14 15V8Z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </span>
              <span class="sidebar-text">Report Bulanan</span>
            </a>
          </li>

          <li class="nav-item" <?php echo $pemilik_allow ?>>
            <a href="manageuser" class="nav-link">
              <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </span>
              <span class="sidebar-text">Manage Karyawan</span>
            </a>
          </li>



          <li class="nav-item">
            <a href="settings" class="nav-link">
              <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </span>
              <span class="sidebar-text">Profil User</span>
            </a>
          </li>



          <li class="nav-item">
            <a href="./auth/logout" class="nav-link">
              <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    fill-rule="evenodd"
                    d="M5 22a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v3h-2V4H6v16h12v-2h2v3a1 1 0 0 1-1 1H5zm13-6v-3h-7v-2h7V8l5 4-5 4z"
                  ></path>
              </svg>
              </span>
              <span class="sidebar-text">Logout</span>
            </a>
          </li>

          

          <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
        </ul>
      </div>
    </nav> 