<?php
	include('../main/base.php');
    include('../main/navbar.php');
    $error_array = array();
?>

<body>
    <div class="p-3">
    <h3>Add Album</h3>
        <div class="col-lg-6">
            <form id='formAdalbum' action="addalbumPost_action.php" method="post" enctype="multipart/form-data" name="upload">
                <div class="form-group">
                    <label>Album Name or Title</label>
                    <input class="form-control" placeholder="Enter Title" name="aname">
                </div><br>
                <div class="form-group">
                     <label>Description</label>
                     <textarea class="form-control" rows="3" placeholder="Max 1000 Character" name="adesc" maxlength="1000"></textarea>
                </div><br>
                <div class="form-group mb-1">
                    <label>Album Cover Image</label><br>
                    <input type="file" name="upload"  id="upload" accept = ".jpg, .jpeg, .png" />
                </div><br>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>

</body>
</html>
