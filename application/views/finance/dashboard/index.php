<div class="content">
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6">
      <div class="card card-stats">
        <div class="card-body">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-single-02 text-warning"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Siswa</p>
                <p class="card-title"><?php echo number_format($siswa,0,'.','.')?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
          <a class="text-muted" href="<?php echo base_url()?>index.php/finance/registration/">
            <i class="fa fa-arrow-right"></i> Lihat Selengkapnya
          </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
