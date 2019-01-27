<div class="content">
  <div class="row">
   <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">List Pemasukan</h4>
        </div>
        <div class="card-body">
        <div class="toolbar">
            <a href="<?php echo base_url()?>index.php/finance/finance/debit_create"><button class="btn btn-success"><i class="fa fa-plus"></i> &nbsp; Tambah Data Baru</button></a>
          </div>
          <?php echo $this->session->flashdata('notif');?>
          <div class="alert alert-info">
            <b>Kumpulan data pemasukan keuangan sekolah</b>
          </div>
          <div class="">
            <div class="row">
              <div class="col-xs-6 col-md-4">
                <div class="form-group">
                <span>Dari :</span>
                <input type="date" class="form-control" name="start_date" value="<?php echo $first_day_this_month?>" id='start_date'>
                </div>
              </div>
              <div class="col-xs-6 col-md-4">
                <div class="form-group">
                  <span>Sampai :</span>
                <input type="date" class="form-control" name="end_date" value="<?php echo $last_day_this_month?>" id='end_date'>
                </div>
              </div>
              <div class="col-xs-6 col-md-4">
                <div class="form-group">
                  <span>Periode :</span>
                  <div class="alert alert-info" id='periode'>

                  </div>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-primary" id="cari">Cari</button>
            <div id='result'>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!------ Call List ------>
<script type="text/javascript">
var _start_date = '<?php echo $first_day_this_month?>';
var _end_date = '<?php echo $first_day_this_month?>';

var start_date = _start_date.split("-");
var end_date = _end_date.split("-");

start_date = (parseInt(start_date[1],10));
start_date = start_date - 1;

end_date = (parseInt(end_date[1],10));
end_date = end_date - 1;

var months = [ "Januari", "Februari", "Maret", "April", "Mei", "Juni",
"Juli", "Agustus", "September", "Oktober", "November", "Desember" ];
$('#periode').html("<b>Bulan : " +months[start_date]+" sampai Bulan : "+months[end_date]+"</b>");
$('#result').html('<h2>Loading....</h2>');
  $.ajax({
    url:"<?php echo base_url()?>index.php/finance/finance/list_data_debit",
    success:function(data){
      $('#result').html(data);
    }
  });

$('#cari').click(function(){
  $('#result').html('<h2>Loading....</h2>');
  var _start_date = $('#start_date').val();
  var _end_date = $('#end_date').val();

  var start_date = _start_date.split("-");
  var end_date = _end_date.split("-");

  start_date = (parseInt(start_date[1],10));
  start_date = start_date - 1;

  end_date = (parseInt(end_date[1],10));
  end_date = end_date - 1;

  var months = [ "Januari", "Februari", "Maret", "April", "Mei", "Juni",
  "Juli", "Agustus", "September", "Oktober", "November", "Desember" ];
  $('#periode').html("<b>Bulan : " +months[start_date]+" sampai Bulan : "+months[end_date]+"</b>");
  $.ajax({
    type:"POST",
    url:"<?php echo base_url()?>index.php/finance/finance/list_data_debit/search",
    type:"get",
    data:"start_date="+_start_date+"&end_date="+_end_date,
    success:function(data){
      $('#result').html(data);
    }
  });
});
</script>

<!-- <script src="<?php echo base_url()?>assets/js/plugins/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/buttons.colVis.min.js"></script>
<script>
function hapus(id,detail){
Swal({
title: 'Anda yakin akan menghapus data '+detail+'?',
text: "Data yang sudah dihapus tidak akan bisa dikembalikan!",
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
    url:"<?php echo base_url()?>index.php/finance/finance/debit_delete/"+id,
    success:function(){
      location.reload();
    }
  })
)
}
})
}
</script>
