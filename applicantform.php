<style type="text/css">
.form-control-2 {
  display: inline-block;
  width: 25%;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
</style>

<?php 
if (!isset($_SESSION['APPLICANTID'])) {
?>

<form action="process.php?action=submitapplication&JOBID=<?php echo $_GET['job']; ?>" class="bg-white p-5 contact-form" enctype="multipart/form-data" method="POST">
  <div class="form-group">
    <input name="JOBID" type="hidden" value="<?php echo $_GET['job']; ?>">
    <input class="form-control" id="FNAME" name="FNAME" placeholder="Firstname" type="text" value="" onkeyup="javascript:capitalize(this.id, this.value);" required>
  </div>
  <div class="form-group">
    <input class="form-control" id="MNAME" name="MNAME" placeholder="Middle Name" onkeyup="javascript:capitalize(this.id, this.value);" required>
  </div>
  <div class="form-group">
    <input class="form-control" id="LNAME" name="LNAME" placeholder="Lastname" onkeyup="javascript:capitalize(this.id, this.value);" required>
  </div>
  <div class="form-group">
    <textarea class="form-control" id="ADDRESS" name="ADDRESS" placeholder="Address" required onkeyup="javascript:capitalize(this.id, this.value);"></textarea>
  </div>
  <div class="form-group">
    Sex:
    <input checked id="optionsRadios1" name="optionsRadios" type="radio" value="Female"> Female
    <input id="optionsRadios2" name="optionsRadios" type="radio" value="Male"> Male
  </div>
  <div class="form-group">
    Date of Birth
    <select class="form-control-2" name="month" required>
      <option value="">Month</option>
      <?php
      $mon = array('Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 12);
      foreach ($mon as $month => $value) {
        echo '<option value=' . $value . '>' . $month . '</option>';
      }
      ?>
    </select>
    <select class="form-control-2" name="day" required>
      <option value="">Day</option>
      <?php
      $d = range(1, 31);
      foreach ($d as $day) {
        echo '<option value=' . $day . '>' . $day . '</option>';
      }
      ?>
    </select>
    <select class="form-control-2" name="year" required>
      <option value="">Year</option>
      <?php
      $years = range(date('Y'), 1900);
      foreach ($years as $yr) {
        echo '<option value=' . $yr . '>' . $yr . '</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <textarea class="form-control" id="BIRTHPLACE" name="BIRTHPLACE" placeholder="Place of Birth" required onkeyup="javascript:capitalize(this.id, this.value);"></textarea>
  </div>
  <div class="form-group">
    <input class="form-control" id="TELNO" name="TELNO" placeholder="Contact No." type="text" required onkeyup="javascript:capitalize(this.id, this.value);">
  </div>
  <div class="form-group">
    <select class="form-control" name="CIVILSTATUS" id="CIVILSTATUS" required>
      <option value="">Select Civil Status</option>
      <option value="Single">Single</option>
      <option value="Married">Married</option>
      <option value="Widow">Widow</option>
    </select>
  </div>
  <div class="form-group">
    <input type="email" class="form-control" id="EMAILADDRESS" name="EMAILADDRESS" placeholder="Email Address" required autocomplete="off">
  </div>
  <div class="form-group">
    <input class="form-control" id="USERNAME" name="USERNAME" placeholder="Username" required onkeyup="javascript:capitalize(this.id, this.value);">
  </div>
  <div class="form-group">
    <input class="form-control" id="PASS" name="PASS" placeholder="Password" type="password" required onkeyup="javascript:capitalize(this.id, this.value);">
  </div>
  <div class="form-group">
    <input class="form-control" id="DEGREE" name="DEGREE" placeholder="Educational Attainment" required onkeyup="javascript:capitalize(this.id, this.value);">
  </div>
  <div class="form-group">
    Attach File here.
    <input id="picture" name="picture" type="file" required>
    <input name="MAX_FILE_SIZE" type="hidden" value="1000000">
  </div>
  <div class="form-group">
    <input type="checkbox" required> By signing up you agree with our <a href="#">terms and conditions</a>
  </div>
  <div class="form-group">
    <input type="submit" value="Submit Application" name="submit" class="btn btn-primary py-3 px-5">
  </div>
</form>

<?php } else { ?>

<div class="col-md-12">
  <div class="row">
    <form class="form-horizontal span6" action="process.php?action=submitapplication&JOBID=<?php echo $result->JOBID; ?>" enctype="multipart/form-data" method="POST">
      <div class="col-md-12">
        <div class="row">
          <div class="panel panel-default">
            <div class="panel-header">
              <div style="border-bottom: 1px solid #ddd; padding: 10px; font-size: 25px; font-weight: bold; color: #000; margin-bottom: 5px;">
                Attach File (PDF form).
                <input name="JOBID" type="hidden" value="<?php echo $_GET['job']; ?>">
              </div>
            </div>
            <div class="panel-body">
              <!-- <label class="col-md-2" for="picture" style="padding: 0; margin: 0;">Attachment all requirements here:</label> -->
              <div class="col-md-10" style="padding: 0; margin: 0;">
                <input id="picture" name="picture" type="file" required>
                <input name="MAX_FILE_SIZE" type="hidden" value="1000000">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <button class="btn btn-primary btn-md pull-right" name="submit" type="submit">Submit <span class="fa fa-arrow-right"></span></button>
          <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-left"></span>&nbsp;<strong>Back</strong></a>
        </div>
      </div>
    </form>
  </div>
</div>

<?php } ?>