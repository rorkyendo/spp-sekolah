<table id="datatable" class="table table-bordered dt-responsive" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th width="35">No</th>
      <th>Kode</th>
      <th>Keterangan</th>
      <th>Tanggal</th>
      <th>Nominal</th>
      <th class="disabled-sorting text-right">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1;$total=0; foreach ($kredit as $row): ?>
    <tr>
      <td class="text-center"><?php echo $i?></td>
      <td><?php echo $row->approval_code?></td>
      <td><?php echo $row->description?></td>
      <td><?php echo date('Y-m-d',strtotime($row->created_time))?></td>
      <td><?php $total+=$row->cash_in; echo $row->cash_in?></td>
      <td class="text-center">
        <?php $approval_code = $row->approval_code;
        $approval_code = $approval_code[0].$approval_code[1];
        if($approval_code!="SF"){
          ?>
        <a href="#" class="btn btn-warning btn-link btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php/finance/finance/kredit_update/<?php echo $row->id_finance?>');">
          <i class="fa fa-edit"></i>
        </a>
        <button type="button" class="btn btn-danger btn-link btn-icon" onclick="hapus('<?php echo $row->id_finance?>','<?php echo $row->description?>')"><i class="fa fa-trash-o"></i></button>
      <?php }else {
        echo "<font color='red'>lakukan update di menu spp.</font>";
      } ?>
      </td>
    </tr>
    <?php $i++; endforeach; ?>
    </tbody>
  </table>

  <script type="text/javascript">
    $(document).ready(function() {
    $('#datatable').append('<caption style="caption-side: bottom; font-weight:bold">Total Pengeluaran : <?php echo "Rp ".number_format($total,0,'.','.');?></caption>');
    $('#datatable').DataTable({
    "pagingType": "first_last_numbers",
    "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
    ],
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'excelHtml5',
        exportOptions: {
          columns: [ 1, 2, 3, 4 ]
        },
        title: 'Data Laporan Pengeluaran Periode '+months[start_date]+' sampai '+months[end_date],
        customize: function ( xlsx ){
                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                // jQuery selector to add a border
                $('row c[r^="2"]', sheet).each( function () {
                // Get the value
                    $(this).attr( 's', '25' );
              });//
            }
      },
      {
          extend: 'print',
          title: 'Data Pengeluaran sekolah',
          messageTop: function () {
                  return 'Data Laporan Pengeluaran Periode '+months[start_date]+' sampai '+months[end_date];
          },
          messageBottom: 'Total Pengeluaran : <?php echo "Rp ".number_format($total,0,'.','.');?>',
          exportOptions: {
            columns: [ 0, 1, 2, 3, 4]
          },
      }
      // {
      //   extend: 'colvisGroup',
      //   text: 'Office info',
      //   show: [ 1, 2, 3, 4, 5, 6 ],
      //   hide: [ 7 ]
      // },
      // {
      //   extend: 'colvisGroup',
      //   text: 'Show all',
      //   show: [ 1, 2, 3, 4, 5, 6, 7 ]
      // },
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
