<!-- Master Slider -->
<div class="blog-ms-v1 content-sm bg-color-darker margin-bottom-60">
  <div class="master-slider ms-skin-default" id="masterslider">
    <?php foreach ($media as $data) {?>
    <div class="ms-slide blog-slider">
      <img src="<?php echo base_url()?>assets/sumberagro/plugins/master-slider/masterslider/style/blank.gif" data-src="<?php echo base_url()?><?php echo $data->media_gambar?>" alt="<?$data->media_judul?>"/>
      <span class="blog-slider-badge"><?php echo $data->med_kat_name?></span>
      <div class="ms-info"></div>
      <div class="blog-slider-title">
        <span class="blog-slider-posted"><?php
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

        ?></span>
        <h2><a href="<?php echo base_url()."index.php/media/post/".$data->media_id?>"><?php echo $data->media_judul?></a></h2>
      </div>
    </div>
  <?php } ?>
  </div>
</div>
<!-- End Master Slider -->
