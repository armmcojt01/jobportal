<?php 
$searchfor = (isset($_GET['searchfor']) && $_GET['searchfor'] != '') ? $_GET['searchfor'] : '';
?>
<style type="text/css">
/* --------------------------------------------------
:: General
-------------------------------------------------- */
body {
    font-family: 'Open Sans', sans-serif;
    color: #353535;
}
.content {
    padding: 30px;
    min-height: 500px;
}
.content h1 {
    text-align: center;
}
.content .content-footer p {
    color: #6d6d6d;
    font-size: 12px;
    text-align: center;
}
.content .content-footer p a {
    color: inherit;
    font-weight: bold;
}
.badge {
        font-size: 12px; /* Adjust font size as needed */
        padding: 5px 8px; /* Adjust padding as needed */
}

</style>
 
<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo web_root; ?>plugins/jobportal/images/recruitment.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start" data-scrollax-parent="true">
            <div class="col-md-8 ftco-animate text-center text-md-left mb-5" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-3"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Hiring</span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Hiring</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <?php
            $search = isset($_POST['SEARCH']) ? $_POST['SEARCH'] : '';
            $category = isset($_POST['CATEGORY']) ? $_POST['CATEGORY'] : '';

            // Construct SQL query based on search criteria
			$sql = "SELECT * FROM `tbljob` j
				WHERE CATEGORY LIKE '%{$category}%' 
				AND (`OCCUPATIONTITLE` LIKE '%{$search}%' 
					OR `JOBDESCRIPTION` LIKE '%{$search}%' 
					OR `QUALIFICATION_WORKEXPERIENCE` LIKE '%{$search}%')
				ORDER BY j.`DATEPOSTED` DESC";
	
            $mydb->setQuery($sql);
            $cur = $mydb->executeQuery();

            // Check if there are any results
            $maxrow = $mydb->num_rows($cur);

            if ($maxrow > 0) {
                $res = $mydb->loadResultList();
                foreach ($res as $result) { // Iterate through each job result
            ?>
                    <div class="col-md-12 ftco-animate">
                        <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
                            <div class="mb-4 mb-md-0 mr-5">
                                <div class="job-post-item-header d-flex align-items-center">
                                    <h2 class="mr-3 text-black h3"><?php echo $result->OCCUPATIONTITLE; ?></h2>
                                    <div class="badge-wrap">
                                        <span class="bg-primary text-white badge py-2 px-3"><?php echo $result->CATEGORY; ?></span>
                                    </div>
                                </div>
                                <div class="job-post-item-body d-block d-md-flex">
                                    <div class="mr-3"><span class="icon-layers"></span> <a href="#"><?php echo $result->JOBDESCRIPTION; ?></a></div>
                                    <div><span class="icon-my_location"></span> <span><?php echo $result->SECTOR_VACANCY; ?></span></div>
                                </div>
                            </div>
							<div class="ml-auto d-flex align-items-center">
								<?php if ($result->JOBSTATUS == 'active') : ?>
									<a href="<?php echo web_root; ?>index.php?q=apply&job=<?php echo $result->JOBID; ?>&view=personalinfo" class="btn btn-primary py-2 mr-1">Apply Job</a>
								<?php else : ?>
									<button class="btn btn-primary py-2 mr-1" disabled>Apply Job</button>
								<?php endif; ?>
								
								<?php if (property_exists($result, 'JOBSTATUS')) : ?>
									<!-- Display status based on STATUS column -->
									<?php if ($result->JOBSTATUS == 'active') : ?>
										<span class="badge badge-success ml-2">Active</span>
									<?php else : ?>
										<span class="badge badge-danger ml-2">Inactive</span>
									<?php endif; ?>
								<?php endif; ?>
							</div>
                        </div>
                    </div>
            <?php
                } // End foreach
            } else {
                echo '<div class="col-md-12">No result found!</div>';
            }
            ?>
        </div>
    </div>
</section> 
