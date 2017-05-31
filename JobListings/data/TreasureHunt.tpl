<?PHP
///////////////////// TEMPLATE TreasureHunt /////////////////////
$template_active = <<<HTML
<div style="width:550px; margin:5px 5px;">
<div><strong><font face="Arial, Helvetica, sans-serif" color="#132646" pointsize="10">{title}</font></strong></div>

<div style="text-align:justify; padding-left:10px; padding-top:5px; margin-top:3px; border-top:1px solid #D3D3D3;">{short-story}</div>

<div style="float: right;"><font pointsize="10" style="padding-bottom:5px; padding-right:30px;">[full-link]See the Answer[/full-link]</font></div>

</div>
HTML;


$template_full = <<<HTML
<div style="width:420px; margin-bottom:5px;">
<div><strong><font face="Arial, Helvetica, sans-serif" color="#132646" pointsize="12">{title}</font></strong></div>

<div style="text-align:justify; padding:3px; margin-top:3px; margin-bottom:5px; border-top:1px solid #D3D3D3;">{short-story}</div>

<div style="text-align:justify; padding:3px; margin-top:3px; margin-bottom:5px;">{full-story}</div>

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

HTML;
$template_comments_prev_next = <<<HTML
<p align="center">[prev-link]<< Older[/prev-link] ({pages}) [next-link]Newest >>[/next-link]</p>
HTML;
?>
