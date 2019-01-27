<!-- Right Sidebar -->
<div class="col-md-3">
  <!-- Blog Thumb v2 -->
  <div class="margin-bottom-50">
    <h2 class="title-v4">INFO TERKINI</h2>
<?php foreach ($media as $data) {?>
    <div class="blog-thumb blog-thumb-circle margin-bottom-15">
      <div class="blog-thumb-hover">
        <img class="rounded-x" src="<?php echo base_url()?><?php echo $data->media_gambar?>" alt="<?php echo $data->media_judul?>">
        <a class="hover-grad" href="<?php echo base_url()."index.php/media/post/".$data->media_id?>"><i class="fa fa-link"></i></a>
      </div>
      <div class="blog-thumb-desc">
        <h3><a href="<?php echo base_url()?>index.php/media/post/<?php echo $data->media_id?>"><?php echo $data->media_judul?></a></h3>
        <ul class="blog-thumb-info">
          <li>
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

            echo $days.",".$dates." ".$monthName." ".$years;

            ?>
          </li>
        </ul>
      </div>
    </div>
<?php } ?>
  </div>
  <!-- End Blog Thumb v2 -->
</div>
<!-- End Right Sidebar -->
