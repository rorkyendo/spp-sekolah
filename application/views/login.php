<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
  <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
    <br>
    <h3 class="text-center">Login</h5>
    <hr>

    <div id="cd-login"> <!-- log in form -->
      <form class="cd-form" action="<?php echo base_url()?>index.php/auth/login" method="post">
        <p class="fieldset">
          <label class="image-replace cd-username" for="signin-email">Username</label>
          <input class="full-width has-padding has-border" id="signin-username" type="text" name="username" placeholder="Username">
          <span class="cd-error-message">Error message here!</span>
        </p>

        <p class="fieldset">
          <label class="image-replace cd-password" for="signin-password">Password</label>
          <input class="full-width has-padding has-border" id="signin-password" type="password" name="password"  placeholder="Password">
          <a href="javascript:void(0);" class="hide-password">Hide</a>
          <span class="cd-error-message">Error message here!</span>
        </p>

        <p class="fieldset">
          <button class="full-width btn btn-primary" type="submit">Login</button>
        </p>
      </form>

      <!-- <a href="javascript:void(0);" class="cd-close-form">Close</a> -->
    </div> <!-- cd-login -->

    <a href="javascript:void(0);" class="cd-close-form">Close</a>
  </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->
