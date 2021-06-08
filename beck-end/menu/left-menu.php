        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="dashboard.php" class="site_title"><i class="fa fa-paw"></i> <span>LOGO</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo ($_SESSION['username']); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3> </h3>
                <ul class="nav side-menu">
                  <li>
                      <a href="dashboard.php"><i class="fa fa-home"></i>Home</a>
                  </li>
                  <?php
                    if($_SESSION['role_id'] == '1'){
                      echo "<li>";
                        echo "<a href='utenti.php'><i class='fa fa-user'></i>Utenti</a>";
                      echo "</li>";
                      echo "<li>";
                        echo "<a href='chalet.php'><i class='fa fa-users'></i>Chalet</a>";
                      echo "</li>";
                    }
                  ?>
                  <?php
                    if($_SESSION['role_id'] == '2'){
                      echo "<li>";
                        echo "<a href='spiaggia.php'><i class='fa fa-umbrella'></i>Spiaggia</a>";
                      echo "</li>";
                      echo "<li>";
                        echo "<a href='prenotazioni.php'><i class='fa fa-pencil-square-o'></i>Prenotazioni</a>";
                      echo "</li>";
                    }
                  ?>
                  <li>
                      <a href="index.php?logout=true"><i class="fa fa-sign-out"></i>Logout</a>
                  </li>
     
                </ul>
              </div>
         
            </div>
        
          </div>
        </div>