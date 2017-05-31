<?PHP
///////////////////// TEMPLATE Default /////////////////////
$template_active = <<<HTML
<div style="width:420px; margin-top:20px; margin-bottom:70px; margin-left:20px;">
<div><strong><font face="Arial, Helvetica, sans-serif" color="#132646" pointsize="12">{title}</font></strong></div>

<div style="text-align:justify; padding-left:10px; padding-top:10px; margin-top:3px; border-top:1px solid #D3D3D3;"><font color="#132646">{short-story}</font></div>

<div style="float: right;"><font style="padding-bottom:20px; padding-right:30px; font-family:Arial, Helvetica, sans-serif; font-size:13px;">[full-link]More Details[/full-link]</font></div>

</div>
HTML;


$template_full = <<<HTML
<div style="width:420px; margin-bottom:15px;">
<a href="http://www.comprehensivenet.com/" target="_blank"><img src="skins/images/jobListingHeader.jpg" border="0" /></a><br /><br />
<div><strong><font face="Arial, Helvetica, sans-serif" color="#132646" pointsize="12">{title}</font></strong></div>

<div style="text-align:justify; padding:3px; margin-top:3px; margin-bottom:5px; border-top:1px solid #D3D3D3;">{short-story}</div>

<div style="text-align:justify; padding:3px; margin-top:3px; margin-bottom:5px;">{full-story}</div>

<span style="padding-left:170px;"><a href="mailto:jobs@comprehensivenet.com?subject=Job%20Listing%20Inquiry"><strong>Apply Now!</strong></a></span><br /><br />

<a href="http://www.comprehensivenet.com/" target="_blank"><img src="skins/images/jobListingFooter.jpg" border="0" /></a>

</div>
HTML;


$template_comment = <<<HTML
<div style="width: 400px; margin-bottom:20px;">

<div style="border-bottom:1px solid black;"> by <strong>{author}</strong> @ {date}</div>

<div style="padding:2px; background-color:#F9F9F9">{comment}</div>

</div>
HTML;


$template_form = <<<HTML
  <table border="0" width="370" cellspacing="0" cellpadding="0">
    <tr>
      <td width="60">Name:</td>
      <td><input type="text" name="name"></td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td><input type="text" name="mail"> (optional)</td>
    </tr>
    <tr>
      <td>Smile:</td>
      <td>{smilies}</td>
    </tr>
    <tr>
      <td colspan="2">
      <textarea cols="40" rows="6" id=commentsbox name="comments"></textarea><br />
      <input type="submit" name="submit" value="Add My Comment">
      <input type=checkbox name=CNremember  id=CNremember value=1><label for=CNremember> Remember Me</label> |
  <a href="javascript:CNforget();">Forget Me</a>
      </td>
    </tr>
  </table>
HTML;


$template_prev_next = <<<HTML
<p align="center">[prev-link]<< Previous[/prev-link] {pages} [next-link]Next >>[/next-link]</p>
HTML;
$template_comments_prev_next = <<<HTML
<p align="center">[prev-link]<< Older[/prev-link] ({pages}) [next-link]Newest >>[/next-link]</p>
HTML;
?>
