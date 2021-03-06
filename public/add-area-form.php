<?php 
	include('includes/functions.php'); 
?>
	<?php 
		$sql_query = "SELECT id, name 
			FROM city where name!='Choose Your City'
			ORDER BY id ASC";
			
			// Execute query
			$db->sql($sql_query);
			// store result 
			$res_city=$db->getResult();	
		
		
		// get currency symbol from setting table		
		if(isset($_POST['btnAdd'])){
			$area_name = $_POST['area_name'];
			$city_ID = $_POST['city_ID'];
			$sql_query = "SELECT * 
			FROM area WHERE city_id=".$city_ID;	
			// Execute query
			$db->sql($sql_query);
			// store result 
			$res_area=$db->getResult();
				$TOTAL=$db->numRows($res_area);
			// create array variable to handle error
			$error = array();
			
			if(empty($area_name)){
				$error['area_name'] = " <span class='label label-danger'>Required!</span>";
			}
				
			if(empty($city_ID)){
				$error['city_ID'] = " <span class='label label-danger'>Required!</span>";
			}
				if($TOTAL==0)
				{
					$sql_query = "INSERT INTO area (name, city_id)
						VALUES('Choose Your Area', $city_ID)";
					// Execute query
					$db->sql($sql_query);
					// store result 
					$res=$db->getResult();
				
				if(!empty($area_name) && !empty($city_ID) ){
			$area_name = $_POST['area_name'];
			$city_ID = $_POST['city_ID'];	
				// create random image file name
				// insert new data to menu table
				$sql_query = "INSERT INTO area (name, city_id)
						VALUES('$area_name', '$city_ID')";
					// Execute query
					$db->sql($sql_query);
					// store result 
					$result = $db->getResult();
					if(!empty($result)){
						$result=0;
					}else{
						$result=1;
					}
				
				
				if($result==1){
					$error['add_area'] = "<section class='content-header'>
												<span class='label label-success'>Area Added Successfully</span>
												<h4><small><a  href='areas.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Areas</a></small></h4>
												
												</section>";
				}else {
					$error['add_area'] = " <span class='label label-danger'>Failed</span>";
				}
			}
				}
			else
			{
			if(!empty($area_name) && !empty($city_ID) ){
			$area_name = $_POST['area_name'];
			$city_ID = $_POST['city_ID'];	
				// create random image file name
				// insert new data to menu table
				$sql_query = "INSERT INTO area (name, city_id)
						VALUES('$area_name', '$city_ID')";
					// Execute query
					$db->sql($sql_query);
					// store result 
					$result = $db->getResult();
					if(!empty($result)){
						$result=0;
					}else{
						$result=1;
					}
				
				if($result==1){
					$error['add_area'] = "<section class='content-header'>
												<span class='label label-success'>Area Added Successfully</span>
												<h4><small><a  href='areas.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Areas</a></small></h4>
												
												</section>";
				}else {
					$error['add_area'] = " <span class='label label-danger'>Failed</span>";
				}
			}
			}
			}
	?>
	<section class="content-header">
          <h1>Add Area</h1>
		  
			<?php echo isset($error['add_area']) ? $error['add_area'] : '';?>
			<ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
          </ol>
		<hr />
        </section>
	<section class="content">

<div class="row">
		  <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Area</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form  method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
						<label for="exampleInputEmail1">City :</label><?php echo isset($error['city_ID']) ? $error['city_ID'] : '';?>
						<select name="city_ID" class="form-control" required>
						<option default>Select Your City</option>
						<?php foreach($res_city as $row){ ?>
							<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
							<?php } ?>
						</select>
						<br/>
					</div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Area Name</label><?php echo isset($error['area_name']) ? $error['area_name'] : '';?>
                      <input type="text" class="form-control"  name="area_name" required/>
                    </div>
					
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <input type="submit" class="btn-primary btn" value="Add" name="btnAdd" />&nbsp;
					<input type="reset" class="btn-danger btn" value="Clear"/>
                  </div>
                </form>
              </div><!-- /.box -->
			 </div>
		  </div>
	</section>

	<div class="separator"> </div>
	
<?php $db->disconnect(); ?>