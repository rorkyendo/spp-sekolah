      <div class="content">
        <div class="row">
         <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">List Siswa</h4>
              </div>
              <div class="card-body">
              <div class="toolbar">
                  <a href="<?php echo base_url()?>index.php/finance/registration/create"><button class="btn btn-success"><i class="fa fa-plus"></i> &nbsp; Tambah Data Baru</button></a>
                </div>
                <div class="">
                  <div class="form-group">
                    <label for="">Jurusan</label>
                    <select class="form-control select2" name="major" id='major'>
                      <option value="">-Pilih-</option>
                      <?php foreach ($jurusan as $key): ?>
                        <option value="<?php echo $key->major_id?>"><?php echo $key->major_name?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Kelas</label>
                    <select class="form-control select2" name="class" id='class'>
                      <option value="">-Pilih-</option>
                      <?php for($i=1;$i<=12;$i++){ ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                      <?php } ?>
                    </select>
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
  $('#result').html('<h2>Loading....</h2>');
  $.ajax({
    url:"<?php echo base_url()?>index.php/finance/registration/list_data",
    success:function(data){
      $('#result').html(data);
      }
  });
  $('#cari').click(function(){
  $('#result').html('<h2>Loading....</h2>');
  var _keyword = $('#keyword').val();
  var _major = $('#major').val();
  var _class = $('#class').val();
  $.ajax({
    type:"POST",
    url:"<?php echo base_url()?>index.php/finance/registration/list_data/search",
    data:"keyword="+_keyword+"&major="+_major+"&class="+_class,
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

<script>
function hapus(id,name){
  Swal({
    title: 'Anda yakin akan menghapus data '+name+'?',
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
          url:"<?php echo base_url()?>index.php/finance/registration/delete/"+id,
          success:function(){
            location.reload();
          }
        })
      )
    }
  })
}
</script>
