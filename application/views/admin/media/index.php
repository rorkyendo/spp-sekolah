<div class="content">
  <div class="row">
   <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Media</h4>
        </div>
        <div class="card-body">

          <div class="toolbar">
            <a href="<?php echo base_url()?>index.php/admin/media/create"><button class="btn btn-success"><i class="fa fa-plus"></i> &nbsp; Tambah Data Baru</button></a>
          </div>
          <div class="table-responsive-sm">
            <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="35">No</th>
                  <th>Judul</th>
                  <th>Kategori</th>      
                  <th>Tanggal</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($media as $row): ?>
                <tr>
                  <td class="text-center"><?php echo $i?></td>
                  <td><?php echo $row->media_judul?></td>
                  <td><?php echo $row->med_kat_name?></td>
                  <td><?php echo date('d-m-Y', strtotime($row->media_created_time))?></td>
                  <td class="text-right">
                    <a href="#" class="btn btn-info btn-link btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php/admin/media/detail/<?php echo $row->media_id?>');">
                      <i class="fa fa-search-plus"></i>
                    </a>
                    <a href="<?php echo base_url()?>index.php/admin/media/update/<?php echo $row->media_id?>" class="btn btn-warning btn-link btn-icon">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a onclick="return confirm('Apakah Anda yakin menghapus data?')" href="<?php echo base_url()?>index.php/admin/media/delete/<?php echo $row->media_id?>" class="btn btn-danger btn-link btn-icon">
                      <i class="fa fa-times"></i>
                    </a>
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