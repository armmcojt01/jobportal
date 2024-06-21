<?php
	 if(!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

?> 
	<div class="row">
    <div class="col-lg-12">
            <h1 class="page-header">List of Employee's  <a href="index.php?view=add" class="btn btn-primary btn-xs  ">  
			<i class="fa fa-plus-circle fw-fa"></i> Add New Employee</a>  
			</h1>
    </div>
   	</div>
				<form class="wow fadeInDownaction" action="controller.php?action=delete" Method="POST">   		
							<table id="dash-table" class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">

							  <thead>
							  	<tr>
							  		<th width="5%">EmployeeNo</th>
							  		 <th>Name</th>
							  		<th>Address</th>
							  		 <th>Sex</th>
							  		 <th>Age</th>
							  		 <th>ContactNo</th>
							  		 <th>Position</th>
							  		 <th>Work Status</th>
							  	 	<th width="14%" >Action</th> 
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php   
									$mydb->setQuery("SELECT e.*, c.CATEGORY 
									FROM tblemployees e
									LEFT JOIN tblcategory c ON e.CATEGORY = c.CATEGORYID");
									$cur = $mydb->loadResultList();

									  if ($cur) {
										foreach ($cur as $result) { 
										  echo '<tr>';
										  echo '<td>' . $result->EMPLOYEEID.'</td>';
										  echo '<td>'. $result->LNAME.', '. $result->FNAME.' '.$result->MNAME.'</td>';
										  echo '<td>'. $result->ADDRESS.'</td>';
										  echo '<td>'. $result->SEX.'</td>';
										  echo '<td>'. $result->AGE.'</td>';
										  echo '<td>'. $result->TELNO.'</td>';
										  echo '<td>'. $result->POSITION.'</td>';
										  echo '<td>'. $result->CATEGORY.'</td>'; 
										  echo '<td align="center">    
												 <a title="Edit" href="index.php?view=edit&id='.$result->EMPLOYEEID.'" class="btn btn-info btn-xs">
												 <span class="fa fa-edit fw-fa"></span></a> 
												 <a title="Delete" href="controller.php?action=delete&id='.$result->EMPLOYEEID.'" class="btn btn-danger btn-xs">
												 <span class="fa fa-trash-o fw-fa"></span></a> 
												</td>';
										  echo '</tr>';
										}
									  } else {
										echo '<tr><td colspan="9">No data found.</td></tr>';
									  }
									?>
							  </tbody>
								
							</table>
 
							 
							</form>
       
                 
 