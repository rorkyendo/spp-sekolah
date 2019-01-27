<!-- Main Content -->
<div class="col-md-12">
  <form class="" action="<?php echo base_url()?>index.php/media/search" method="get">
  <div class="col-md-10">
    <input type="text" name="keyword" placeholder="cari sesuai dengan kategori atau judul" class="form-control">
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-primary">Cari</button>
  </div>
  </form>
</div>
<br>
<br>
<br>
<div class="col-md-9">
  <?php
  foreach ($media_category as $data){
  ?>
  <!-- Tab v4 -->
  <div class="tab-v4 margin-bottom-40">
    <!-- Tab Heading -->
    <div class="tab-heading">
      <h2><?php echo $data->med_kat_name?></h2>
    </div>
    <!-- End Latest News -->
    <!-- Tab Content -->
    <div class="tab-content">
      <div class="tab-pane fade in active" id="tab-v4-a1">
        <div class="row">
          <div class="col-sm-7" id='blog_grid<?php echo $data->med_kat_id?>'>
            <!-- Blog Grid -->

            <!-- End Blog Grid -->
          </div>
          <div class="col-sm-5">
            <!-- Blog Thumb -->
            <?php $media = $this->dbObject->get_media_by_category_id_limit_six($data->med_kat_id);?>
            <?php foreach ($media as $data) {?>
            <div class="blog-thumb margin-bottom-20">
            <div class="blog-thumb-hover">
              <img src="<?php echo base_url()?><?php echo $data->media_gambar?>" alt="<?php echo $data->media_judul?>">
              <a class="hover-grad" href="<?php echo base_url()."index.php/media/post/".$data->media_id?>"><i class="fa fa-link"></i></a>
            </div>
            <div class="blog-thumb-desc">
              <h3><a href="<?php echo base_url()."index.php/media/post/".$data->media_id?>"><?php echo $data->media_judul?></a></h3>
              <ul class="blog-thumb-info">
                <?php
                $days = date('D',strtotime($data->media_created_time));
                $dates = date('d',strtotime($data->media_created_time));
                $monthName = date('M',strtotime($data->media_created_time));
                $years = date('Y',strtotime($data->media_created_time));
                ///---------DAYS NAME--------///
                  switch($days){
                      case 'Sun':
                        $days = "Minggu";
                      break;
                      case 'Mon':
                        $days = "Senin";
                      break;
                      case 'Tue':
                        $days = "Selasa";
                      break;
                      case 'Wed':
                        $days = "Rabu";
                      break;
                      case 'Thu':
                        $days = "Kamis";
                        break;
                      case 'Fri':
                        $days = "Jumat";
                      break;
                      case 'Sat':
                        $days = "Sabtu";
                      break;
                      }
                ///---------END OF DAYS NAME--------///
                ///---------MONTHS NAME--------///
                  switch($monthName){
                      case 'Jan':
                        $monthName = "Januari";
                      break;
                      case 'Feb':
                        $monthName = "Februari";
                      break;
                      case 'Mar':
                        $monthName = "Maret";
                      break;
                      case 'Apr':
                        $monthName = "April";
                      break;
                      case 'Mei':
                        $monthName = "May";
                        break;
                      case 'Jun':
                        $monthName = "Juni";
                      break;
                      case 'Jul':
                        $monthName = "Juli";
                      break;
                      case 'Aug':
                        $monthName = "Agustus";
                      break;
                      case 'Sept':
                        $monthName = "September";
                      break;
                      case 'Okt':
                        $monthName = "Oktober";
                      break;
                      case 'Nov':
                        $monthName = "November";
                      break;
                      case 'Dec':
                        $monthName = "December";
                      break;
                      }
                ///---------END OF MONTHS NAME--------///
                ?>
                <li><?php echo $monthName." ".$dates.","." ".$years?></li>
              </ul>
            </div>
            </div>
            <?php } ?>
            <!-- End Blog Thumb -->
          </div>
        </div><!--/end row-->
      </div>
    </div>
    <!-- End Tab Content -->
  </div>
  <!-- End Tab v4 -->

  <script type="text/javascript">
    $(document).ready(function(){
      $.ajax({
          url:'<?php echo base_url()?>index.php/welcome/blog_grid/<?php echo $data->med_kat_id?>',
          success:function(data)
          {
            $('#blog_grid<?php echo $data->med_kat_id?>').html(data);
          }
      });
    });
  </script>
<?php } ?>
</div>
<!-- End Main Content -->
