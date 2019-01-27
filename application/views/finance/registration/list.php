<table id="datatable" class="table table-bordered dt-responsive" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th width="35">No</th>
      <th>NISN</th>
      <th>Nama Siswa</th>
      <th>Kelas</th>
      <th>Jurusan</th>
      <th>Status</th>
      <th class="disabled-sorting text-right">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach ($siswa as $row): ?>
    <tr>
      <td class="text-center"><?php echo $i?></td>
      <td><?php echo $row->nisn?></td>
      <td><?php echo $row->name?></td>
      <td><?php echo $row->class?></td>
      <td><?php echo $row->major_name?></td>
      <td class="text-center">
        <?php
          if($row->users_status_active == '1')
            echo "<span class='badge badge-pill badge-success'>aktif</span>";
          elseif($row->users_status_active == '2')
            echo "<span class='badge badge-pill badge-danger'>nonaktif</span>";
        ?>
      </td>
      <td class="text-right">
        <a href="#" class="btn btn-info btn-link btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php/finance/registration/detail/<?php echo $row->id?>');">
          <i class="fa fa-search-plus"></i>
        </a>
        <a href="#" class="btn btn-warning btn-link btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php/finance/registration/update/<?php echo $row->id?>');">
          <i class="fa fa-edit"></i>
        </a>
        <button type="button" class="btn btn-danger btn-link btn-icon" onclick="hapus('<?php echo $row->users_id?>','<?php echo $row->name?>')"><i class="fa fa-trash-o"></i></button>
      </td>
    </tr>
    <?php $i++; endforeach; ?>
    </tbody>
  </table>

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
