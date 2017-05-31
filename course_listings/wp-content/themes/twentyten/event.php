<?php
/*
Template Name: Events
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../ComprehensiveStyles.css" rel="stylesheet" type="text/css">
<title>Comprehensive Network OT AOTA Approved Speech SLP ASHA Approved CE Continuing Education NYC CEU Sensory Integration Feeding Swallow Autism Workshop New York City Comprehensive Enrichment Pediatric Martha Burns</title>
<meta name="keywords" content="OT Continuing Education, SLP Continuing Education, PT, CEU’s, Comprehensive Network, Comprehensive Enrichment, Continuing Ed, Speech Language Pathologist SLP, Occupational Therapist Therapy OT, Physical Therapist PT, CE, CEU, NYC, Seminars, Workshops, Brooklyn, Manhattan, Bronx, Queens, New York City, agency, pediatrics" />
</head>
<style>

.events_container {
	margin-top:15px;
}

.events {
	padding:0;
	border-spacing:0;
	border-collapse:collapse;
}

.events tr {
	border-bottom:1px solid #1C60B3;
}

.events td {
	padding-left:15px;
}

.events h4 {
	font-size:15px;
}

.events .border {
	background:#D5E8FD;
	color:#1C60B3;
}

.event_info h2.event_title {
	font-size:12px;
}

.event_info {
	font-size:12px;
	color:#1C60B3;
}

</style>
<body>
<?php include("headerBlue.php"); ?>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="225" valign="top">
		<?php include("proMenu.php"); ?>
    	<a href="http://www.comprehensivenet.com/25.php"><img src="../images/anniversary_link.jpg" alt="25th Anniversary" width="220" height="182" vspace="5" border="0"></a>
    </td>
    
	<td width="625" valign="top">
    	<br />
    	 <span class="pageTitlesPros">Continuing Education Services</span><br />
         <span class="pageTitlesPros">Comprehensive Enrichment&trade;</span>
         
         <div class="events_container">
          	<table class="events" style="table-layout:fixed; width:600">
            	<tr height="30" class="border">
       	            <td width="35%"><h4>Course Name</td>
                	<td width="16%"><h4>Date &amp; Time</h4></td>
                    <td width="16%"><h4>Location</h4></td>
                    <td width="16%"><h4>Presenter</h4></td>
                </tr>
                
                <?php $loop = new WP_Query( array( 'post_type' => 'event', 'posts_per_page' => 10 ) ); ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <?php
						$custom = get_post_custom($post->ID);
						$presenter = $custom["presenter"][0];
						$date = $custom["date"][0];
						$location = $custom["location"][0];
						$ceus = $custom["ceus"][0];
						$hours = $custom["hours"][0];
						$tution = $custom["tution"][0];
						$seminar_description = $custom["seminar_description"][0];
						$presenter_bio = $custom["presenter_bio"][0];
                ?>
                <tr class="event_info">
                     <td><?php the_title( '<h2 class="event_title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h2>' ); ?></td>
                     <td><p><?=$date?></p></td>
                     <td><p><?=$location?></p></td>
                     <td><p><?=$presenter?></p></td>
				</tr>
                <?php endwhile; ?>
            	
            </table>
          </div><!--end entry-content-->
            		  

    </td>
   
  </tr>
</table>
	<?php include("footer.php"); ?>   
      </body>
</html>