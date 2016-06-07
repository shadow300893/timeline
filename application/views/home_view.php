<!DOCTYPE html>
<html>
<!--
#Author Name : Sahil Gheek
-->
<head>
   <title>Home</title>
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
   
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <style type="text/css">
     .colbox {
          margin-left: 0px;
          margin-right: 0px;
     }
	 .logo {
          color: darkgrey;
          
     }
	 body {
		  background: url('<?= base_url() ?>../assets/img/web_bg.jpg');

	 }
	 .tcol {
		  color : white;
		  padding-left : 20px;
		  padding-right : 20px;
		  display: inline-block;
	 }
	 .time {
		padding-left : 50px;
		padding-right : 20px;
		padding-top : 20px;
		
	 }
     </style>
 </head>
 <body>
 <div class="container">
     <div class="row">
          <div class="col-lg-6 col-sm-6">
               <h1 class="logo">Timeline.In</h1>
          </div>
          <div class="col-lg-6 col-sm-6">
               <ul class="nav nav-pills pull-right" style="margin-top:20px">
                    <li class="active"><a href="<?= base_url(); ?>edit">Edit</a></li>
                    <li><a href="home/do_logout">Logout</a></li>
               </ul>
               
          </div>
     </div>
</div>
<hr/>

   <h1 class="tcol">Welcome <?= $this->session->userdata['username'] ?>!</h2>
   <button type="button" id="add" class="btn btn-primary" data-toggle="modal" data-target="#add_table"><i class="fa fa-plus"></i> Add Content</button><br />
   <?php echo $this->session->flashdata('msg1'); ?>
   <?php echo $this->session->flashdata('msg'); 
	foreach ($arr as $file){
	
		$fname = $file['name'];
		$furl = "http://timeline.in.s3.amazonaws.com/".$fname;
		
		//output a link to the file
		echo "<div class='time' ><img src='".base_url()."../assets/img/icon.png' width='50' height='100'><h1 class='tcol'>".$file['tagline']."</h1><br /><div style='padding-left:70px;display:inline-block'><a href='".$furl."'>".$fname."</a></div></t><div class='tcol'>".$file['timestamp']."</div></div><br />";
	}
	?>
   <!-- Modal -->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="add_table" class="modal fade">
                  <div class="stl"><div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Upload Content</h4>
                          </div>
                          <div class="modal-body">
                              <div class="form">
                                    <form class="cmxform form-horizontal tasi-form" id="add_content" enctype="multipart/form-data" method="post" action="">
                                        <div class="form-group ">
                                            <label for="tag" class="control-label col-lg-2">Tagline *</label>
                                            <div class="col-lg-10">
                                                <input class=" form-control" id="tag" name="tag" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label col-lg-2" for="theFile">Image *</label>
                                            <div class="col-lg-10">
                                              <input type="file" class="form-control" id="theFile" name="theFile" accept="audio/*|video/*|image/*" >
                                            </div>
                                        </div>
                                       
										<div class="modal-footer">
											<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
											<button class="btn btn-primary" type="submit" id="upld" name="upld">Upload</button>
										</div>
									</form>
							  </div>
						  </div>
                      </div>
                  </div>
              </div><
   <!-- modal -->
   
 </body>
 <script>
 $(document).on("click", "#add", function () {
     $('#add_table').modal('show');
});
</script>
</html>