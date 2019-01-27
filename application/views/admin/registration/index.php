      <div class="content">
        <div class="row">
         <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> List pegawai </h4>
              </div>
              <div class="card-body">
              <div class="toolbar">
                  <a href="<?php echo base_url()?>index.php/admin/registration/create"><button class="btn btn-success"><i class="fa fa-plus"></i> &nbsp; Tambah Data Baru</button></a>
                </div>
                <div class="">
                  <table id="datatable" class="table table-bordered dt-responsive" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th width="35">No</th>
                        <th>Nama pegawai</th>
                        <th>Tanggal Daftar</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th class="disabled-sorting text-right">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($pegawai as $row): ?>
                      <tr>
                        <td class="text-center"><?php echo $i?></td>
                        <td><?php echo $row->name?></td>
                        <td><?php echo date('d-m-Y', strtotime($row->users_created_time))?></td>
                        <td><?php echo $row->users_username?></td>
                        <td class="text-center">
                          <?php
                            if($row->users_status_active == '0')
                              echo "<span class='badge badge-pill badge-warning'>pending</span>";
                            elseif($row->users_status_active == '1')
                              echo "<span class='badge badge-pill badge-success'>aktif</span>";
                            elseif($row->users_status_active == '2')
                              echo "<span class='badge badge-pill badge-danger'>nonaktif</span>";
                          ?>

                        </td>
                        <td class="text-right">
                          <a href="#" class="btn btn-info btn-link btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php/admin/registration/detail/<?php echo $row->id?>');">
                            <i class="fa fa-search-plus"></i>
                          </a>
                          <a href="#" class="btn btn-warning btn-link btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php/admin/registration/update/<?php echo $row->id?>');">
                            <i class="fa fa-edit"></i>
                          </a>
                          <button type="button" class="btn btn-danger btn-link btn-icon" onclick="hapus('<?php echo $row->users_id?>','<?php echo $row->name?>')"><i class="fa fa-trash-o"></i></button>
                        </td>
                      </tr>
                      <?php $i++; endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

<!-- DataTables -->
<!-- <script src="<?php echo base_url()?>assets/js/plugins/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/responsive.bootstrap4.min.js"></script>

<script>
function hapus(id,name){
  Swal({
    title: 'Anda yakin akan menghapus data '+name+'?',
    text: "Data yang sudah dihapus tidak akan bisa dikembalikan!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      Swal(
        'Deleted!',
          name+' Berhasil di hapus',
        'success',
        $.ajax({
          url:"<?php echo base_url()?>index.php/admin/registration/delete/"+id,
          success:function(){
            location.reload();
          }
        })
      )
    }
  })
}
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').DataTable({
      "pagingType": "first_last_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records",
      }

    });

    var table = $('#datatable').DataTable();

    // Edit record
    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');

      var data = table.row($tr).data();
      alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
    });

    // Delete a record
    table.on('click', '.remove', function(e) {
      $tr = $(this).closest('tr');
      table.row($tr).remove().draw();
      e.preventDefault();
    });

    //Like record
    table.on('click', '.like', function() {
      alert('You clicked on Like button');
    });
  });
</script>
