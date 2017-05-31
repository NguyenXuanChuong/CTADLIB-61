<?php
/*
Template Name: Single Event
*/
?>
<?php the_post(); ?>

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


<style type="text/css">
<!--
.style3 {color: #000000}
.style4 {
	color: #000066;
	font-size: 11px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style8 {font-size: 12px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style51 {
color: #1F3B72; 
font-size: 12px; 
font-family: Geneva, Arial, Helvetica, sans-serif; 
font-weight: bold; 
}
.style53 {
color: #1F3B72; 
font-size: 12px; 
font-family: Geneva, Arial, Helvetica, sans-serif; 
}
.style48 {color: #FFFFFF}
.style54 {color: #B11552}
.style55 {
	color: #000066;
	font-size: 9px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-style: italic;
}
.style56 {
	color: #990000;
}
.style58 {
	color: #990000;
	font-weight: bold;
}
.style61 {
	color: #990000;
	font-size: 15px;
}
.style62 {
	font-size: 14px;
	color: #000000;
}
-->
</style>

<table width="800" height="1027" border="0" align="center" cellpadding="0" cellspacing="0" background="../images/CE/CE_Auditory.jpg">
  <tr>
    <td height="161" colspan="3" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="100" height="748" align="center" valign="top">&nbsp;</td>
    <td width="594" height="748" align="left" valign="top"><p align="center" class="style54"><span style="color: #990000"><font style="word-spacing:20px">IS PROUD TO PRESENT</font></span><br />
        <span class="style58"><?php the_title(); ?></span><br />
    </p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="4%" valign="top" class="style53">PRESENTER:</td>
            <td colspan="2" class="style51"><?=$presenter?></td>
        </tr>
          <tr>
            <td valign="top" class="style53">DATE &amp; TIMES:</td>
            <td colspan="2" class="style51"><?=$date?></td>
        </tr>
          <tr>
            <td valign="top" class="style53">LOCATION:</td>
            <td colspan="2" class="style51"><?=$location?></td>
        </tr>
          <tr>
            <td valign="top" class="style53">CEU'S for SLP&rsquo;s:</td>
            <td width="18%" class="style53"><span class="style51"><?=$ceus?></span></td>
          <tr>
            <td valign="top" class="style53">CONTACT HOURS:</td>
            <td class="style51"><?=$hours?></td>
          </tr>
          <tr>
            <td height="25" valign="top" class="style53">TUITION:</td>
            <td><span class="style53"><span class="style51">$<?=$tution?></span></span></td>
          </tr>
      </table>
      <p align="justify" class="style4"><span class="style53">SEMINAR
            DESCRIPTION:</span><br />
            <?=$seminar_description?></p>
      <blockquote>
        <p class="style4">Participants will be able to:<br />
          &bull; Identify the five systems that account for how we process auditory information<br />
          &bull; Identify each of the seven categories of APD and one specific skill needed in each category<br />
          &bull; Describe some of the confounding variables found in typical tests used to assess APD in children by 
          speech-language pathologists, OTs, psychologists and educational specialists<br />
          &bull; State for whom specific accommodations like FM systems are appropriate<br />
          &bull; Describe at least one activity that can be used in each of the seven different categories of APD</p>
      </blockquote>
      <p class="style55"><?=$presenter_bio?></p>
      <p align="center" class="style8"><span class="style3"><strong>TO REGISTER call <span class="style56">718-382-2025</span><br />
or email <span class="style56">pep@comprehensivenet.com</span></strong></span></p>      
        <p align="center" class="style62"> Registration mailed, faxed, or called in to us WITH PAYMENT for any course up to<br />
  two weeks prior to course date qualifies for a 10% discount on course tuition.</p>
    <p align="center" class="style61">LOOK FOR OUR BROCHURE WITH MORE DETAILS ABOUT THIS &amp;<br />
    OTHER EXCITING ENRICHMENT PROGRAMS FOR 2009/2010!</p></td>
    <td width="100" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="100" colspan="3" align="center" valign="top"><p align="center" class="style8"><span class="style3"><span class="style48"><strong>NO PENALTIES FOR CANCELLATION.</strong><br />
Cancellation for any reason submitted in writing at any time<br />
for any course will receive a full refund.<br />
<strong>UNEQUIVOCAL GUARANTEE.</strong></span></span></p>
    </td>
  </tr>
</table>

