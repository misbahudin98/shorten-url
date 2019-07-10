    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed ">

      <a class="logo-wrapper waves-effect">
        <img src="https://static1.squarespace.com/static/58d006b0e4fcb591d4c1a2ce/t/5af5f3440e2e725de5b5e516/1560439745959/" >
      </a>

      <div class="list-group list-group-flush">
        <a href="
            <?php if($this->session->userdata('is') == "admin"){ echo base_url('beranda_admin');}else{ echo base_url('beranda_user');} ?> " 
            class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=="dashboard_admin" || $this->uri->segment(2)=="dashboard_user" || $this->uri->segment(1)=="beranda_admin" || $this->uri->segment(1)=="beranda_user"){echo "active";}?> waves-effect">
          <i class="fas fa-chart-pie mr-3" ></i>Dashboard
        </a>
        <a href="<?php echo base_url('profil'); ?>" 
            class="list-group-item  list-group-item-action <?php if($this->uri->segment(2)=="profile" || $this->uri->segment(1) == "profil"){echo "active";}?> waves-effect">
          <i class="far fa-id-badge mr-3"></i>Profile</a>
        
        <?php 
          if($this->session->userdata('is') =="admin"){         ?>
            <a href="<?php echo base_url('tampilkan_user'); ?>" 
              class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=="show_user"|| $this->uri->segment(1) == "tampilkan_user"){echo "active";}?> waves-effect">
          <i class="fas fa-users mr-3"></i>User</a>
        <?php } ?>
        <a href="<?php echo base_url('url'); ?>" 
          class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=="show_url" || $this->uri->segment(1) == "url"){echo "active";}?> waves-effect">
          <i class="fas fa-laptop-code mr-3"></i>Url</a>

      </div>

    </div>
    <!-- Sidebar -->
</div>

</header>
<body>