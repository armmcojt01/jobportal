<?php 
	  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     } 
?>
	<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header">List of Vacancies  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  <i class="fa fa-plus-circle fw-fa"></i> Add Job Vacancy</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  	
			     <div class="table-responsive">					
				<table id="dash-table" class="table table-striped table-bordered table-hover"  style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>

				  		<!-- <th>No.</th> -->
				  		<th>Job Title</th> 
				  		<th>No of Vacancy</th> 
				  		<th>Salary Grade</th> 
				  		<th>Deadline of Submission</th> 
				  		<th>Qualification/Work experience</th> 
				  		<th>Department</th> 
				  		<th>Sex</th> 
				  		<th>Status</th> 
				  		 <th width="10%" align="center">Action</th>
				  	</tr>	
				  </thead> 
				  <tbody>
				  <?php 
						$mydb->setQuery("SELECT * FROM `tbljob`"); // Select all columns from tbljob
						$cur = $mydb->loadResultList(); 
						foreach ($cur as $result) {
								echo '<tr>';
								echo '<td>' . $result->OCCUPATIONTITLE.'</td>';
								echo '<td>' . $result->REQ_NO_EMPLOYEES.'</td>';
								echo '<td>' . $result->SALARIES.'</td>';
								echo '<td>' . $result->DURATION_EMPLOYMENT.'</td>';
								echo '<td>' . $result->QUALIFICATION_WORKEXPERIENCE.'</td>';
								echo '<td>' . $result->SECTOR_VACANCY.'</td>';
								echo '<td>' . $result->PREFEREDSEX.'</td>';
								echo '<td>' . $result->JOBSTATUS.'</td>';
								echo '<td align="center"><a title="Edit" href="index.php?view=edit&id='.$result->JOBID.'" class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></a>
									  <a title="Delete" href="controller.php?action=delete&id='.$result->JOBID.'" class="btn btn-danger btn-xs  ">  <span class="fa fa-trash-o fw-fa "></a></td>';
								echo '</tr>';
							}
					?>
							

				  </tbody>
					
				</table>
						<div class="btn-group">
				 <!--  <a href="index.php?view=add" class="btn btn-default">New</a> -->
					<?php
					if($_SESSION['ADMIN_ROLE']=='Administrator'){
					// echo '<button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button'
					; }?>
				</div>
			
			
				</form>
	
 <div class="table-responsive">	 