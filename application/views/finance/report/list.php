<table id="datatable" class="table table-bordered dt-responsive" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th width="35">No</th>
      <th>Kode</th>
      <th>Keterangan</th>
      <th>Tanggal</th>
      <th>Pemasukan</th>
      <th>Pengeluaran</th>
      <th class="disabled-sorting text-right">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1;$total_in=0;$total_out=0; foreach ($report as $row): ?>
    <tr>
      <td class="text-center"><?php echo $i?></td>
      <td><?php echo $row->approval_code?></td>
      <td><?php echo $row->description?></td>
      <td><?php echo date('Y-m-d',strtotime($row->created_time))?></td>
      <td><?php $total_in+=$row->cash_in; echo $row->cash_in?></td>
      <td><?php $total_out+=$row->cash_out; echo $row->cash_out?></td>
      <td class="text-center">
        <?php if($row->status==1){
          echo "<font color='green'>Pemasukan</font>";
        }else {
          echo "<font color='red'>Pengeluaran</font>";
        } ?>
      </td>
    </tr>
    <?php $i++; endforeach; ?>
    </tbody>
  </table>

  <script type="text/javascript">
    $(document).ready(function() {
    $('#datatable').append('<caption style="caption-side: bottom; font-weight:bold">Total Laporan Keuangan : <?php echo "Rp ".number_format($total_in - $total_out,0,'.','.');?></caption>');
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
        title: 'Data Laporan Keuangan Periode '+months[start_date]+' sampai '+months[end_date],
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
          title: 'Data Laporan Keuangan sekolah',
          messageTop: function () {
                  return 'Data Laporan Keuangan Periode '+months[start_date]+' sampai '+months[end_date];
          },
          messageBottom: 'Total Laporan Keuangan : <?php echo "Rp ".number_format($total_in - $total_out,0,'.','.');?>',
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
