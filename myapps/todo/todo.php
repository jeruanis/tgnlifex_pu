<?php

  include('../main/base.php');
  include('../main/navbar.php');

  include('todo_mid.php');

  if(isset($_GET['d'])){
    $dm=$_GET['d'];
  }else{
    $dm='';
  }
?>

<script src="../../static/js/todojs.js"></script>
<body>
  <section id="cancel_drag" class="d-none text-center pt-2 pb-2">
    Drag out to cancel
  </section>
  <main class="container">
    <section id="todoListWrapper">
     <div class="d-inline-block" style="margin-left:50%"><a href="#" class="back-to-top"></a></div>
     <header>
   		<center>
        <h2>Schedule Your Week</h2>
   			<h3 class="m-0 mb-2">Tap on the days of your choice</h3>
      </center>
     </header>
      <article id="todoList">
   			<form method="POST" action="" enctype="multipart/form-data" id="todoForm">
   					<ul>
   						<li class="listTitle">Monday</li>
   						<li class="addItem">
   							<input class='post_text' type="text" name="monday" placeholder="things to do on Monday...">
   						</li>
   						<?php echo url($forMon); ?>
   					</ul>
   					<ul>
   						<li class="listTitle">Tuesday</li>
   						<li class="addItem">
   							<input class='post_text' type="text" name="tuesday" placeholder="things to do on Tuesday...">
   						</li>
   						<?php echo url($forTue); ?>
   					</ul>
   					<ul>
   						<li class="listTitle">Wednesday</li>
   						<li class="addItem">
   							<input class='post_text' type="text" name="wednesday" placeholder="things to do on Wednesday...">
   						</li>
   						<?php echo url($forWed); ?>
   					</ul>
   					<ul>
   						<li class="listTitle">Thursday</li>
   						<li class="addItem">
   							<input class='post_text' type="text" name="thursday" placeholder="things to do on Thursday...">
   						</li>
   						<?php echo url($forThu); ?>
   					</ul>
   					<ul>
   						<li class="listTitle">Friday</li>
   						<li class="addItem">
   							<input class='post_text' type="text" name="friday" placeholder="things to do on Friday...">
   						</li>
   						<?php echo url($forFri); ?>
   					</ul>
   					<ul>
   						<li class="listTitle">Saturday</li>
   						<li class="addItem">
   							<input class='post_text' type="text" name="saturday" placeholder="things to do on Saturday...">
   						</li>
   						<?php echo url($forSat); ?>
   					</ul>
   					<ul>
   						<li class="listTitle">Sunday</li>
   						<li class="addItem">
   							<input class='post_text' type="text" name="sunday" placeholder="things to do on Sunday...">
   						</li>
   						<?php echo url($forSun); ?>
   					</ul>
   					<ul>
   						<li class="listTitle">Planning</li>
   						<li class="addItem">
   							<input class='post_text' type="text" name="planning" placeholder="plans...( max 900 character)">
   						</li>
   						<?php echo url($forPlanning); ?>
   					</ul>
   			   </form>
        </article>
   			<!-- <div id="trash" style="position:fixed;top:8%;right:0;"><span style="font-size:24px;font-weight:bold;">&#128465;</span></div> -->
        <div id="trash" style="position:fixed;width:100%;top:8%;right:0;height:100px;"><span style="font-size: 30px;float:right;padding-right:5px;">&#128465;</span></div>
   		</section>
  </main>

  <script>
       var username ='<?php echo $userloggedin; ?>';
       var dm = "<?php echo $dm; ?>";
       if(dm != ''){
         $(".navbar-toggler").click();
         $("#navbarDropdown").click();
         setInterval("op();", 1000);
        }
       function op(){
         $("a#inv").fadeOut(500);
         $("a#inv").fadeIn(500);
         $("a#ci").fadeOut(500);
         $("a#ci").fadeIn(500);
       }

  </script>
  <?php include('../main/footer.php'); ?>
 </body>
</html>
