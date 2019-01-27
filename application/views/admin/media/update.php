      <?php foreach ($data_media as $row) { ?>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <div class="toolbar">
                  <a href="<?php echo base_url()?>index.php/admin/media"><button class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> &nbsp; Kembali ke Data Media</button></a>
                </div>
                <h5 class="card-title">Edit Media</h5>
              </div>
              <div class="card-body">
                <form class="form-horizontal" action="<?php echo base_url()?>index.php/admin/media/update/<?php echo $row->media_id?>/do_update" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Pilih Kategori</label>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <select class="form-control" id="kategori" name="media_med_kat_id" required>
                          <option></option>
                          <?php foreach ($kategori as $key): ?>
                            <option value="<?php echo $key->med_kat_id?>" <?php if($row->media_med_kat_id == $key->med_kat_id) echo "selected"?> >
                              <?php echo $key->med_kat_name?>
                            </option>  
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="">
                        <button type="button" class="btn btn-round" style="margin-top: -1px" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-plus"></i> &nbsp; Tambah Kategori 
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" class="form-control" name="media_judul" value="<?php echo $row->media_judul?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <div class="fileinput fileinput-exists text-center" data-provides="fileinput">
                          <div class="fileinput-new thumbnail">
                            <img src="<?php echo base_url()?>assets/img/image_placeholder.jpg" alt="...">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail">
                            <img src="<?php echo base_url()?><?php echo $row->media_gambar?>">
                          </div>
                          <div>
                            <span class="btn btn-rose btn-round btn-file">
                              <span class="fileinput-new">Pilih Gambar</span>
                              <span class="fileinput-exists">Ganti</span>
                              <input type="file" name="media_gambar" />
                            </span>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Hapus</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label">Isi Konten</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <textarea id="editor1" rows="10" cols="80" name="media_isi"><?php echo $row->media_isi?></textarea>
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

      <?php } ?>

      <!-- Classic Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form class="form-horizontal" action="<?php echo base_url()?>index.php/admin/media/kategori/create" method="post">
              <div class="modal-header justify-content-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="nc-icon nc-simple-remove"></i>
                </button>
                <h6 class="title title-up">Tambah Kategori</h6>
              </div>
              <div class="modal-body">
                <div class="row">
                  <label class="col-md-3 col-form-label">Kategori</label>
                  <div class="col-md-9">
                    <div class="form-group">
                      <input type="text" class="form-control" name="kategori" placeholder="" required="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="left-side">
                  <input type="submit" class="btn btn-default btn-link" value="submit">
                </div>
                <div class="divider"></div>
                <div class="right-side">
                  <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--  End Modal -->

<!-- Fileupload -->
<script src="<?php echo base_url()?>assets/js/plugins/jasny-bootstrap.min.js"></script>
<!-- CK Editor -->
<script src="<?php echo base_url()?>assets/js/plugins/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
  })
</script>