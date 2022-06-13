
<main class="col-md-3">
<?php if($userloggedin == 'support-service' && $username == 'support-service') { ?>

      <p class='friendCount font-weight-bold'>Members: 
         <svg class="side_bar_svg" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
      </p>
      <div class="mb-3 side_bar_slide" style="overflow:auto;max-height:588px;">
        <div class="content-container" style="max-height:543px">
           <div class="content-items">
               <span class='users_online'></span> <!--image-->
            </div>
            <div class="content-items">
               <span class='friends_onlineAllUsers'></span> <!--name-->
            </div>
        </div>
      </div>

<?php  } else

  if ($username == $userloggedin) { ?>

      <p class='friendCount font-weight-bold'>Friends: 
          <svg class="side_bar_svg" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
      </p>
      <div class="mb-3 side_bar_slide" style="overflow:auto;max-height:588px;">
       <div class="content-container">
         <div class="content-items">
             <span class='friends_online'></span>
          </div>
          <div class="content-items">
              <span class='friends_onlineR'></span>
          </div>
          <div></div>
       </div>
      </div>


<?php } else {

      $logged_in_user_obj = new User($conn, $userloggedin);
      echo '<p class="friendCount"><span class="font-weight-bold">Mutual Friends: </span>
           <svg class="side_bar_svg" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
           <p>';
      $mf = $logged_in_user_obj->getMutualFriends($username);

      echo '<p class="side_bar_slide pl-3">';
          if($mf != 'None'){
              for($i=0; $i < count($mf); $i++){
                 echo $mf[$i].'<br>';
                }
              
          }else{
            echo $mf;
          }
      echo "</p>";
       // count is not included
}  ?>



<!-- when on mobile make an option to slide down -->
<script type="text/javascript">
    $(function(){
       if(window.matchMedia("(max-width:600px)").matches){

          $('.side_bar_slide').hide();
          $('.friendCount').on('click', function(){
             $('.side_bar_slide').slideToggle();
          });
       }else{
        $('.side_bar_svg').hide();
       }
    });
</script>
</main>
