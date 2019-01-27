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
  <!-- Tab v4 -->
  <div class="tab-v4 margin-bottom-40">
    <!-- End Latest News -->
    <!-- Tab Content -->
    <div class="tab-content">
      <div class="tab-pane fade in active" id="tab-v4-a1">
        <div class="row">
          <div class="col-sm-7">
            <!-- Blog Grid -->
            <?php foreach ($media_content as $data) {?>
            <div class="blog-grid sm-margin-bottom-40">
            <img class="img-responsive" src="<?php echo base_url()?><?php echo $data->media_gambar?>" alt="<?php echo $data->media_judul?>">
            <h3><a href="<?php echo base_url()."index.php/media/post/".$data->media_id?>"><?php echo $data->media_judul?></a></h3>
            <ul class="blog-grid-info">
              <li><?php echo $data->users_username?></li>
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
              <li><?php echo $monthName." ".$dates." ".$days.", ".$years?></li>
            </ul>
            <?php
            // strip tags to avoid breaking any html
            $string = strip_tags($data->media_isi);
            if (strlen($string) > 250) {

                // truncate string
                $stringCut = substr($string, 0, 250);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= '...';
              }
             ?>
             <p><?php echo $string?></p>
            <a class="r-more" href="<?php echo base_url()."index.php/media/post/".$data->media_id?>">Read More</a>
            </div>
            <?php } ?>
            <?php echo $links ?>
            <!-- End Blog Grid -->
          </div>
        </div><!--/end row-->
      </div>
    </div>
    <!-- End Tab Content -->
  </div>
  <!-- End Tab v4 -->
</div>
<!-- End Main Content -->
