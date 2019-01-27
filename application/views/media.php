<?php foreach ($detail_media as $data){
	$media_id = $data->media_id;
	?>
<div class="col-md-9">
				<!-- Blog Grid -->
				<div class="blog-grid margin-bottom-30">
					<h2 class="blog-grid-title-lg"><?php echo $data->media_judul?></h2>
					<div class="overflow-h margin-bottom-10">
						<ul class="blog-grid-info pull-left">
							<li><?php echo $data->name?></li>
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
							<li><?php echo $monthName." ".$dates.", ".$years?></li>
						</ul>
						<div class="pull-right">
							<!-- Go to www.addthis.com/dashboard to customize your tools -->
							<div class="addthis_sharing_toolbox"></div>
						</div>
					</div>
					<center><img class="img-responsive" src="<?php echo base_url()?><?php echo $data->media_gambar?>" alt="<?php echo $data->media_judul?>"></center>
				</div>
				<!-- End Blog Grid -->
				<?php echo $data->media_isi?>

				<ul class="source-list">
					<li><strong>Author:</strong> <a href="#"><?php echo $data->name?></a></li>
				</ul>

				<!-- Blog Grid Tagds -->
				<ul class="blog-grid-tags">
				   <li class="head">Tags</li>
				   <li><a href="#"><?php echo $data->med_kat_name?></a></li>
				</ul>
				<!-- End Blog Grid Tagds -->
<?php } ?>
				<!-- Blog Comments v2 -->
				<div class="margin-bottom-50">
					<!-- <h2 class="title-v4">Comments (3)</h2> -->

					<!-- Blog Comments v2 -->
					<div class="row blog-comments-v2">
						<?php foreach ($comment as $key): ?>
						<div class="comments-itself">
							<h4>
								<?php echo $key->name?>
								<span><?php echo $key->comment_created_time?></span>
							</h4>
							<p><?php echo $key->comment ?></p>
						</div>
					<?php endforeach; ?>
					</div>
					<!-- End Blog Comments v2 -->

					<!-- Blog Comments v2 -->
					<!-- <div class="row blog-comments-v2 blog-comments-v2-reply">
						<div class="commenter">
							<img class="rounded-x" src="assets/img/team/img2.jpg" alt="">
						</div>
						<div class="comments-itself">
							<h4>
								Susie Lau
								<span>6 hours ago / <a href="#">Reply</a></span>
							</h4>
							<p>Gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod..</p>
						</div>
					</div> -->
					<!-- End Blog Comments v2 -->

					<!-- Blog Comments v2 -->
					<!-- <div class="row blog-comments-v2">
						<div class="commenter">
							<img class="rounded-x" src="assets/img/team/img3.jpg" alt="">
						</div>
						<div class="comments-itself">
							<h4>
								Marcus Farrell
								<span>6 hours ago / <a href="#">Reply</a></span>
							</h4>
							<p>Gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod..</p>
						</div>
					</div> -->
					<!-- End Blog Comments v2 -->
				</div>
				<!-- End Blog Comments v2 -->

				<!-- Form -->
				<?php if($this->session->userdata('login')==1){ ?>
					<?php echo $this->session->flashdata('notif') ?>
				<h2 class="title-v4">Post a Comment</h2>
				<form action="<?php echo base_url()?>index.php/media/comment/<?php echo $media_id?>" method="post" id="sky-form3" class="sky-form comment-style-v2" novalidate="novalidate">
					<fieldset>
						<div class="row sky-space-30">
							<div class="col-md-6">
								<div>
									<input type="text" name="name" id="name" placeholder="Name" value="<?php echo $this->session->userdata('user_name')?>" class="form-control bg-color-light" readonly>
								</div>
							</div>
						</div>

						<div class="sky-space-30">
							<div>
								<textarea rows="8" name="comment" maxlength="250" id="message" placeholder="Write comment here ..." class="form-control bg-color-light"></textarea>
							</div>
						</div>

						<p><button type="submit" class="btn-u btn-u-default">Submit</button></p>
					</fieldset>
				<?php } ?>
					<!-- <div class="message">
						<i class="rounded-x fa fa-check"></i>
						<p>Your comment was successfully posted!</p>
					</div> -->
				</form>
				<!-- End Form -->
			</div>
