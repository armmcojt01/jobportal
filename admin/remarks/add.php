<?php 
 if(!isset($_SESSION['ADMIN_USERID'])){
    redirect(web_root."admin/index.php");
   }

  $autonum = New Autonumber();
  $res = $autonum->set_autonumber('id');

 ?> 

 <section id="feature" class="transparent-bg">
        <div class="container">
           <div class="center wow fadeInDown">
                 <h2 class="page-header">Add Remarks / Status</h2>
            </div>
               
            <div class="row">
                <div class="features">
 
                  <form class="form-horizontal span6  wow fadeInDown" action="controller.php?action=add" method="POST">

                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "ID">ID</label>

                        <div class="col-md-8"> 
                              <input class="form-control input-sm" id="ID" name="ID" placeholder=
                              "ID" type="text" value="">
                     </div>
                      </div>
                    </div>           
                     <div class="form-group">
                      <div class="col-md-8">
                        <label class="col-md-4 control-label" for=
                        "REMARK">Remark / Status</label>

                        <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "REMARK">REMARK / STATUS</label>

                      <div class="col-md-8">
                        <select class="form-control input-sm" id="REMARK" name="REMARK">
                          <option value="None">Select</option>
                          <?php 
                            $sql ="Select * From tblremarks";
                            $mydb->setQuery($sql);
                            $res  = $mydb->loadResultList();
                            foreach ($res as $row) {
                              # code...
                              echo '<option value='.$row->REMARK.'>'.$row->REMARK.'</option>';
                            }

                          ?>
                        </select>
                      </div>
                  </div>
                      <div class="col-md-8">
                         <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Save</button>
                       </div>
                    </div>

                  </form>
    </section><!--/#feature-->
 

 