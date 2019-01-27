<table id="datatable" class="table table-bordered dt-responsive" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th width="35">No</th>
      <th>NISN</th>
      <th>Nama Siswa</th>
      <th>Kelas</th>
      <th>Jurusan</th>
      <th>Tanggal Pembayaran</th>
      <th>Nominal</th>
      <th class="disabled-sorting text-right">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1;$total=0; foreach ($spp as $row): ?>
    <tr>
      <td class="text-center"><?php echo $i?></td>
      <td><?php echo $row->nisn?></td>
      <td><?php echo $row->name?></td>
      <td><?php echo $row->class?></td>
      <td><?php echo $row->major_name?></td>
      <td><?php echo $row->payment_date?></td>
      <td><?php $total+=$row->nominal; echo $row->nominal?></td>
      <td class="text-center">
        <a href="#" class="btn btn-warning btn-link btn-icon" onclick="showAjaxModal('<?php echo base_url();?>index.php/finance/finance/spp_update/<?php echo $row->id_sf?>');">
          <i class="fa fa-edit"></i>
        </a>
        <button type="button" class="btn btn-danger btn-link btn-icon" onclick="hapus('<?php echo $row->id_sf?>','<?php echo $row->description?>')"><i class="fa fa-trash-o"></i></button>
      </td>
    </tr>
    <?php $i++; endforeach; ?>
    </tbody>
  </table>

  <script type="text/javascript">
    $(document).ready(function() {
    $('#datatable').append('<caption style="caption-side: bottom; font-weight:bold">Total Pendapatan SPP : <?php echo "Rp ".number_format($total,0,'.','.');?></caption>');
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
          columns: [ 1, 2, 3, 4, 5, 6 ]
        },
        title: 'Data Laporan Pembayaran SPP Periode '+months[start_date]+' sampai '+months[end_date],
        customize: function ( xlsx ){
                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                // jQuery selector to add a border
                $('row c[r*="2"]', sheet).attr( 's', '25' );
            }
      },
      {
          extend: 'print',
          title: 'Data SPP sekolah',
          messageTop: function () {
                  return 'Data Laporan Pembayaran SPP Periode '+months[start_date]+' sampai '+months[end_date];
          },
          messageBottom: 'Total Pendapatan SPP : <?php echo "Rp ".number_format($total,0,'.','.');?>',
          exportOptions: {
            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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
