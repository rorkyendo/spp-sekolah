<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> <?php echo $title ?> </h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <a href="<?php echo base_url()?>index.php/finance/finance/school_fees"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> &nbsp; Kembali </button></a>
          </div>
          <form class="register-form" action="<?php echo base_url()?>index.php/finance/finance/school_fees_create/do_create" method="post" id="sppForm">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="">Jurusan</label>
                  <div class="row">
                  <div class="col-md-8">
                  <select class="form-control select2-single" name="major" id='major'>
                    <option>-Pilih-</option>
                  </select>
                  </div>
                </div>
                </div>
                <div class="form-group">
                  <label for="">Kelas</label>
                  <div class="row">
                  <div class="col-md-8">
                  <select class="form-control select2-single" name="class" id='class'>
                    <option value="">-Pilih-</option>
                    <?php for($i=1;$i<=12;$i++){ ?>
                      <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php } ?>
                  </select>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Siswa</label> <font color="red">*</font>
                  <div class="row">
                  <div class="col-md-8">
                  <select class="form-control select2-single" name="id_siswa" title="Pilih Siswa" id='data_siswa' required>
                    <option>-Pilih Siswa-</option>
                  </select>
                  </div>
                  <div class="col-md-4">
                    <a href="<?php echo base_url()?>index.php/finance/registration/create" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> &nbsp; Tambah Data Siswa</a>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Tanggal Pembayaran</label> <font color="red">* (mm/dd/yyyy)</font>
                  <input type="date" class="form-control" name="payment_date" value="<?php echo $today?>" required>
                </div>
                <div class="form-group">
                  <label>Nominal</label> <font color="red">*</font>
                  <input type="text" class="form-control" placeholder="Masukkan Jumlah uang yang dibayarkan" name="nominal" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="update ml-auto mr-auto">
                <button type="submit" class="btn btn-success btn-round"> &nbsp; Simpan &nbsp; </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script>
function setFormValidation(id) {
$(id).validate({
  rules:{
          id_siswa:{
              required: true,
          },
          payment_date:{
              required: true,
          },
          nominal:{
              required: true,
              number:true,
          },
      },
      messages: {
          id_siswa: {
              required : "Pilih Siswa"
          },
          payment_date:{
              required: "Masukkan tanggal pembayaran"
          },
          nominal: {
              required : "Masukkan nominal pembayaran",
              number : "Nominal Hanya angka"
          },
      },
  highlight: function(element) {
    $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
    $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
  },
  success: function(element) {
    $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
    $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
  },
  errorPlacement: function(error, element) {
    $(element).closest('.form-group').append(error);
  },
});
}
$(document).ready(function() {
setFormValidation('#sppForm');
$.ajax({
  url:'<?php echo base_url()?>index.php/finance/registration/get_data_siswa/major',
  ContentType:'application/json',
  type:'get',
  success:function(data){
    var major = jQuery.parseJSON(data);
    $.each(major, function(k, v) {
    $('<option>').val(v.major_id).text(v.major_name).appendTo('#major');
    });
  }
})
});

$('#class').change(function(){
var _major = $('#major').val();
var _class = $('#class').val();
  $.ajax({
    url:'<?php echo base_url()?>index.php/finance/registration/get_data_siswa/search',
    ContentType:'application/json',
    data:'major='+_major+'&class='+_class,
    type:'get',
    success:function(data){
      var obj = jQuery.parseJSON(data);
      var formoption = "";
      $.each(obj, function(k, v) {
      formoption += "<option value='"+v.id+"'>"+v.name+"</option>";
      });
      $('#data_siswa').html(formoption);
    }
  });
});

</script>
<script type="text/javascript">
$("#major, #class, #data_siswa").select2( {
  theme: "bootstrap",
  containerCssClass: ':all:'
} );
</script>
