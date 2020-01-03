
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SENBAC - Quản Lý Máy Chủ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$this->config->item('adminLTE');?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=$this->config->item('adminLTE');?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$this->config->item('adminLTE');?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include 'templates/navbar.php';?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Quản lý các máy chủ lành tính</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php 
              if(isset($data['statusCode']))
                print_r($data['message']);
              else { ?>
              <!-- start table servers -->
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Hostname</th>
                  <th>Port</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data as $server):?>
                  <tr>
                  <td><span class="badge badge-secondary"><?=$server['id'];?></span></td>
                  <td><div class="badge badge-success"><?=$server['hostname'];?></div></td>
                  <td><div class="badge badge-success"><?=$server['port'];?></div></td>
                  <td><div id="serverConnection_<?=$server['id'];?>">Loading ...</div></td>
                  <td>
                    <button class="btn btn-info">
                    <i class="nav-icon fa fa-search"></i> Info
                    </button>
                    <button class="btn btn-warning">
                    <i class="nav-icon fa fa-undo"></i> Restart
                    </button>
                    <button class="btn btn-danger">
                    <i class="nav-icon fa fa-power-off"></i> Shutdown
                    </button>
                  </td>
                </tr>
                <?php endforeach;?>
                </tfoot>
              </table>
              <!-- end table servers -->
              <?php }?>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'templates/footer.php';?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=$this->config->item('adminLTE');?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=$this->config->item('adminLTE');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?=$this->config->item('adminLTE');?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=$this->config->item('adminLTE');?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?=$this->config->item('adminLTE');?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=$this->config->item('adminLTE');?>dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<?php 
foreach($data as $server): ?>
<!-- Script check connection to all servers -->
<script>
  $.post( "<?=base_url('serverConnection');?>", { username: "<?=$server['username'];?>", hostname: "<?=$server['hostname'];?>", port: <?=$server['port'];?> })
  .done(function( data ) {
    $( "#serverConnection_<?=$server['id'];?>" ).html( data );
  });
</script>
<?php endforeach;?>
</body>
</html>
