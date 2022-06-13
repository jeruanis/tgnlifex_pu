
     <style type="text/css">
     	button{
     		border: none;
     		background: none;
     	}
     </style>

	 <script>
	 		var url = window.location.pathname;
      var filename = url.substring(url.lastIndexOf('/')+1);
      var userloggedin = '<?php echo $userloggedin; ?>';
      $(document).ready(function() {
        $('.dropdown_data_window').scroll(function() {
          var inner_height = $('.dropdown_data_window').innerHeight();
          var scroll_top = $('.dropdown_data_window').scrollTop();
          var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
          var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();
          var urla;
          if (filename == 'index' ) {
             urla =  "includes/handlers/";
          }else{
             urla =  "../../includes/handlers/";
          }
          if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {
              var pageName;
              var type = $('#dropdown_data_type').val();
              if(type == 'notification'){
              	 if (filename == 'index' ) {
                   pageName = "ajax_load_notifications_non_myapps.php";
              }else{
                   pageName = "ajax_load_notifications.php";
                }
              }else if(type == 'message'){
                  if (filename == 'index' ) {
                 pageName = "ajax_load_messages_non_myapps.php";
              }else{
                 pageName = "ajax_load_messages.php";
                }
                 }
              var ajaxReq = $.ajax({
                  url: urla + pageName,
                  type: "POST",
                  data: "page=" + page + "&userloggedin=" + userloggedin,
                  cache:false,
                  success: function(response) {
                      $('.dropdown_data_window').find('.nextPageDropdownData').remove();
                      $('.dropdown_data_window').find('.noMoreDropdownData').remove();
                      $('.dropdown_data_window').append(response);
                  }
              });
          }
          return false;
        });
      });
    </script>

	<?php if ($curPageName == "messages_group.php" || $curPageName == "messages.php" ){}else{ ?>
			<footer class="border-top col-12 py-3" style="background:#ccc">
			<section class="footer-grid">
				<div class="item-footer" style="padding-left:15px">
					<span class="text-muted"> &copy 2021 TgnLife </span><br>
					<span class="text-muted pr-2"> Email: </span> <a href="https://www.tgnlife.com/contact" style="color:#007bff">Contact us</a><br>
					<span class="text-muted pr-2"> Chat: </span> <a href="https://www.tgnlife.com/tgnlifex/myapps/messaging/messages?u=support-service" style="color:#007bff">support service</a>
				</div>

			 <script>
			 	$(function(){
				 	if(window.matchMedia("(min-width:600px)").matches){
					 	var div_c = document.getElementById('c');
					 	div_c.classList.add('text-center');
					 	div_c.classList.remove('col-sm-12');
					 	var div_l = document.getElementById('l');
		                div_l.classList.add('text-right');
		                div_l.classList.remove('col-sm-12');
					 }else{
	                    var div_c = document.getElementById('c');
					 	div_c.classList.remove('text-center');
					 	div_c.classList.add('col-sm-12');
					 	var div_l = document.getElementById('l');
		                div_l.classList.remove('text-right');
		                div_l.classList.add('col-sm-12');
					 }
				});

			</script>

				<div id="c" class="item-footer" style="padding-left:15px">
					<span class="text-muted">Makati City, Philippines 1230</span>
					 <div class="pt-2 pb-2">
					 	<button class="button" data-sharer="facebook" data-title="TgnLife" data-url="https://www.tgnlife.com">
					 		<svg xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink" height="24px" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 512 512" width="24px" xml:space="preserve"><path d="M449.446,0c34.525,0 62.554,28.03 62.554,62.554l0,386.892c0,34.524 -28.03,62.554 -62.554,62.554l-106.468,0l0,-192.915l66.6,0l12.672,-82.621l-79.272,0l0,-53.617c0,-22.603 11.073,-44.636 46.58,-44.636l36.042,0l0,-70.34c0,0 -32.71,-5.582 -63.982,-5.582c-65.288,0 -107.96,39.569 -107.96,111.204l0,62.971l-72.573,0l0,82.621l72.573,0l0,192.915l-191.104,0c-34.524,0 -62.554,-28.03 -62.554,-62.554l0,-386.892c0,-34.524 28.029,-62.554 62.554,-62.554l386.892,0Z"/></svg>
					 	</button>

					   <button class="button" data-sharer="pinterest" data-title="TgnLife" data-url="https://www.tgnlife.com">
					 		<svg xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink" height="24px" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 512 512" width="24px" xml:space="preserve"><path d="M255.998,0.001c-141.384,0 -255.998,114.617 -255.998,255.998c0,108.456 67.475,201.171 162.707,238.471c-2.24,-20.255 -4.261,-51.405 0.889,-73.518c4.65,-19.978 30.018,-127.248 30.018,-127.248c0,0 -7.659,-15.334 -7.659,-38.008c0,-35.596 20.632,-62.171 46.323,-62.171c21.839,0 32.391,16.399 32.391,36.061c0,21.966 -13.984,54.803 -21.203,85.235c-6.03,25.482 12.779,46.261 37.909,46.261c45.503,0 80.477,-47.976 80.477,-117.229c0,-61.293 -44.045,-104.149 -106.932,-104.149c-72.841,0 -115.597,54.634 -115.597,111.095c0,22.004 8.475,45.596 19.052,58.421c2.09,2.535 2.398,4.758 1.776,7.343c-1.945,8.087 -6.262,25.474 -7.111,29.032c-1.117,4.686 -3.711,5.681 -8.561,3.424c-31.974,-14.884 -51.963,-61.627 -51.963,-99.174c0,-80.755 58.672,-154.915 169.148,-154.915c88.806,0 157.821,63.279 157.821,147.85c0,88.229 -55.629,159.232 -132.842,159.232c-25.94,0 -50.328,-13.476 -58.674,-29.394c0,0 -12.838,48.878 -15.95,60.856c-5.782,22.237 -21.382,50.109 -31.818,67.11c23.955,7.417 49.409,11.416 75.797,11.416c141.389,0 256.003,-114.612 256.003,-256.001c0,-141.381 -114.614,-255.998 -256.003,-255.998Z" style="fill-rule:nonzero;"/></svg>
					 	</button>

					   <button class="button" data-sharer="linkedin" data-title="TgnLife" data-url="https://www.tgnlife.com">
					 		 <svg xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink" height="24px" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 512 512" width="24px" xml:space="preserve"><path d="M449.446,0c34.525,0 62.554,28.03 62.554,62.554l0,386.892c0,34.524 -28.03,62.554 -62.554,62.554l-386.892,0c-34.524,0 -62.554,-28.03 -62.554,-62.554l0,-386.892c0,-34.524 28.029,-62.554 62.554,-62.554l386.892,0Zm-288.985,423.278l0,-225.717l-75.04,0l0,225.717l75.04,0Zm270.539,0l0,-129.439c0,-69.333 -37.018,-101.586 -86.381,-101.586c-39.804,0 -57.634,21.891 -67.617,37.266l0,-31.958l-75.021,0c0.995,21.181 0,225.717 0,225.717l75.02,0l0,-126.056c0,-6.748 0.486,-13.492 2.474,-18.315c5.414,-13.475 17.767,-27.434 38.494,-27.434c27.135,0 38.007,20.707 38.007,51.037l0,120.768l75.024,0Zm-307.552,-334.556c-25.674,0 -42.448,16.879 -42.448,39.002c0,21.658 16.264,39.002 41.455,39.002l0.484,0c26.165,0 42.452,-17.344 42.452,-39.002c-0.485,-22.092 -16.241,-38.954 -41.943,-39.002Z"/></svg>
					 	</button>

					   <button class="button" data-sharer="twitter" data-title="TgnLife" data-url="https://www.tgnlife.com">
					 		<svg xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink" height="24px" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 512 512" width="24px" xml:space="preserve"><path d="M449.446,0c34.525,0 62.554,28.03 62.554,62.554l0,386.892c0,34.524 -28.03,62.554 -62.554,62.554l-386.892,0c-34.524,0 -62.554,-28.03 -62.554,-62.554l0,-386.892c0,-34.524 28.029,-62.554 62.554,-62.554l386.892,0Zm-253.927,424.544c135.939,0 210.268,-112.643 210.268,-210.268c0,-3.218 0,-6.437 -0.153,-9.502c14.406,-10.421 26.973,-23.448 36.935,-38.314c-13.18,5.824 -27.433,9.809 -42.452,11.648c15.326,-9.196 26.973,-23.602 32.49,-40.92c-14.252,8.429 -30.038,14.56 -46.896,17.931c-13.487,-14.406 -32.644,-23.295 -53.946,-23.295c-40.767,0 -73.87,33.104 -73.87,73.87c0,5.824 0.613,11.494 1.992,16.858c-61.456,-3.065 -115.862,-32.49 -152.337,-77.241c-6.284,10.881 -9.962,23.601 -9.962,37.088c0,25.594 13.027,48.276 32.95,61.456c-12.107,-0.307 -23.448,-3.678 -33.41,-9.196l0,0.92c0,35.862 25.441,65.594 59.311,72.49c-6.13,1.686 -12.72,2.606 -19.464,2.606c-4.751,0 -9.348,-0.46 -13.946,-1.38c9.349,29.426 36.628,50.728 68.965,51.341c-25.287,19.771 -57.164,31.571 -91.8,31.571c-5.977,0 -11.801,-0.306 -17.625,-1.073c32.337,21.15 71.264,33.41 112.95,33.41Z"/></svg>
					 	</button>

			         </div>
				</div>

				<div id="l" class="item-footer text-muted" style="padding-right:15px;padding-left:12px;">
					<i class="fa fa-lg fa-cc-visa"></i>
					<i class="fa fa-lg fa-cc-paypal"></i>
					<i class="fa fa-lg fa-cc-mastercard"></i>
				</div>
			</section>
	</footer>


 <?php	} ?>
