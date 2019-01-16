
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo site_url()?>assets/js/admin/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo site_url()?>assets/js/admin/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo site_url()?>assets/js/admin/icheck.min.js"></script>
    
  <script type="text/javascript" src="<?php echo site_url().ADMIN_ASSETS_JS;?>custome/comman.js"></script>
  <script type="text/javascript" src="<?php echo site_url().ADMIN_ASSETS_JS;?>custome/admin_management.js"></script>

    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
