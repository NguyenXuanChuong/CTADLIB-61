<?php
/*
Plugin Name: Facebook Dashboard Widget
Plugin URI: http://mou.me.uk/projects/wordpress/plugins/facebook-dashboard-widget/
Description: Display your friends latest status updates, posted items and/or notifications on your WordPress dashboard or blog sidebar (check your widgets page).  Make sure you enter your feed details on <a href="options-general.php?page=facebook-dashboard-widget/fdw.php">the options page</a>.
Tags: Facebook, sidebar, widget, dashboard 
Version: 0.10.1
Author: Chris Chrisostomou
Author URI: http://mou.me.uk/
*/

// Thanks to Ron ( http://wpmututorials.com ) for his help with WPMU compatibility.


// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

// Changelog:
// 0.10.1	- Replaced functions deprecated in WP 3.0 - min. requirement now WP 2.8+. Posted items fix. Widget control issue fixed. Various other minor fixes.
// 0.10		- Fixed tags, WPMU support, DB options tidy up, plugin page settings link, now supports WP 2.7 and above
// 0.9.9.3	- when_posted() fix, added changelog, updated help
// 0.9.9.2	- Sidebar theme compatibility fix
// 0.9.9.1	- Formatting fix
// 0.9.9	- Fixed issue with posted items comments not showing, updated readme, new screenshot
// 0.9.8	- Sidebar widgets added
// 0.9.5	- Height settings available for pre & post WP 2.7
// 0.9.1	- WordPress 2.7 compatibility
// 0.9		- Added posted items, fixed some issues with readme file
// 0.8.1	- Added support for Dashboard Widget Manager
// 0.8		- Beta release  (20/4/08)



// Add the default options on plugin activation (if they don't already exist)
register_activation_hook(__FILE__, 'fdw_init');
function fdw_init() {
	static $init = false;
	$options = get_option('fdw_options');
	
	if(!$init) {
		if(!$options) {
			$options = array();
		}	
		$defaultOptions = array(
			"showupdates"				=> "no",
			"updatesfeed"				=> "",
			"updatesmax"				=> "5",
			"updatesnewheight"			=> "full",
			"shownotifications"			=> "no",
			"notificationsfeed"			=> "",
			"notificationsmax"			=> "5",
			"notificationsnewheight"	=> "full",
			"showposted"				=> "no",
			"postedfeed"				=> "",
			"postedmax"					=> "5",
			"postednewheight"			=> "full",
			"widget_updatesoptions"			=> array("title"=>"Facebook Friends Updates", "num"=>"5"),
			"widget_notificationsoptions"	=> array("title"=>"Facebook Notifications", "num"=>"5"),
			"widget_posteditemsoptions"		=> array("title"=>"Facebook Posted Items", "num"=>"5")
		);
		$oldWp25Options = array("fdw_postedwidth", "fdw_postedheight", "fdw_notificationswidth", "fdw_notificationsheight", "fdw_updateswidth", "fdw_updatesheight");
		
		$updated = false;
		$migration = false;
		
		foreach($defaultOptions as $option => $value) {
			if(!isset($options[$option])) {
				// Migrate old options
				$oldOption = 'fdw_'.$option;
				if (get_option($oldOption)!==false) {
					$options[$option] = get_option($oldOption);
					delete_option($oldOption);
					$migration = true;
				} else {
					$options[$option] = $defaultOptions[$option];
				}
				$updated = true;
			}
		}
		
		if($updated) {
			update_option('fdw_options', $options);
		}
		if ($migration) {
			foreach ($oldWp25Options as $oldWp25Option) {
				delete_option($oldWp25Option);
			}
		}
		$init = true;
	}
	return $options;
}

$fdw = new fdw;

class fdw {
	
	function fdw() {
		$options = fdw_init();
		if(is_array($options)) {
			foreach($options as $option => $value) {
				$this->$option = $value;
			}
		}
	}
	
	function get_statuses($mode="dashboard", $count=false) {
		global $fdw;
		$count = ($count===false) ? $this->updatesmax : $count;
		$rss = @ fetch_feed($this->updatesfeed);
		
		if ($rss) {
			$items = $rss->get_items( 0, $rss->get_item_quantity($count) );
			echo '<ul';
			if (is_numeric($this->updatesnewheight) && $mode=="dashboard") echo ' style="height:' . $this->updatesnewheight . 'px; overflow:auto;"';
			echo ' class="fdw_widget">';
			
			foreach ( $items as $item ) {
				echo '<li><span><a href="' . $item->get_permalink() . '" class="rsswidget">' . $item->get_title() . '</a></span><br /><span style="color:#999999;">' . $this -> when_posted($item->get_date()) . '</span></li>';
			}
			echo '</ul>';
		} else {
			if ( $this->updatesfeed == "" ) {
				echo  '<p>You need to enter your Facebook feed URL in order to grab your status updates!</p>';
			} else {
				echo '<p>We\'re unable to grab your Facebook feed at this time.  Are you sure you\'ve entered it correctly?</p>';
			}
			echo  '<p>Check <a href="options-general.php?page=facebook-dashboard-widget/fdw.php">the options page</a> for more information.</p>';
		}
	}
	
	function get_notifications($mode="dashboard", $count=false) {
		global $fdw;
		$count = ($count===false) ? $this->notificationsmax : $count;
		$rss = @ fetch_feed($this->notificationsfeed);
		
		if ($rss) {
			$items = $rss->get_items( 0, $rss->get_item_quantity($count) );
			echo '<ul';
			if (is_numeric($this->notificationsnewheight) && $mode=="dashboard") echo ' style="height:' . $this->notificationsnewheight . 'px; overflow:auto;"';
			echo ' class="fdw_widget">';
			
			foreach ( $items as $item ) {
				echo '<li><span><a href="' . $item->get_permalink() . '" class="rsswidget">' . $item->get_title() . '</a></span><br /><span style="color:#999999;">' . $this -> when_posted($item->get_date()) . '</span></li>';
			}
			echo '</ul>';
		} else {
			if ( $this->postedfeed == "" ) {
				echo  '<p>You need to enter your Facebook feed URL in order to grab your latest posted items!</p>';
			} else {
				echo '<p>We\'re unable to grab your Facebook feed at this time.  Are you sure you\'ve entered it correctly?</p>';
			}
			echo  '<p>Check <a href="options-general.php?page=facebook-dashboard-widget/fdw.php">the options page</a> for more information.</p>';
		}
	}
	
	function get_posteditems($mode="dashboard", $count=false) {
		global $fdw;
		$count = ($count===false) ? $this->postedmax : $count;
		$rss = @ fetch_feed($this->postedfeed);
		
		if ($rss) {
			$items = $rss->get_items( 0, $rss->get_item_quantity($count) );
			echo '<ul';
			if (is_numeric($this->postednewheight) && $mode=="dashboard") echo ' style="height:' . $this->postednewheight . 'px; overflow:auto;"';
			echo ' class="fdw_widget">';
			
			foreach ( $items as $item ) {
				$description = preg_match('/<div class="summary">(.*)<\/div><\/div><div class="owner_comment">/', html_entity_decode($item->get_description()), $desc);
				$extracomment = preg_match('/<span class="story_comment">(.*)<\/span><span class="end_quote">/', html_entity_decode($item->get_description()), $comment);
				echo '<li>';
					echo '<span><a href="' . $item->get_permalink() . '" class="rsswidget">' . $item->get_title() . '</a></span><br />';
					if ( $description == true ) {
						echo $desc[1] . "<br />";
					}
					echo '<span style="color:#999999;">';
						if ( $extracomment == true ) {
							echo '<em>"' . strip_tags($comment[1], '<a>') . '"</em>';
						}
						$author = $item->get_authors();
						echo ' - posted ' . $this -> when_posted($item->get_date()) . ' by ' . $author[0]->email;
					echo '</span>';
				echo '</li>';
			}
			echo '</ul>';
			
			
		} else {
			if ( $this->notificationsfeed == "" ) {
				echo  '<p>You need to enter your Facebook feed URL in order to grab your status updates!</p>';
			} else {
				echo '<p>We\'re unable to grab your Facebook feed at this time.  Are you sure you\'ve entered it correctly?</p>';
			}
			echo  '<p>Check <a href="options-general.php?page=facebook-dashboard-widget/fdw.php">the options page</a> for more information.</p>';
		}
	}
	
	function when_posted($pubdate) {
		$a = "";
		$pubdate = strtotime($pubdate);
		$now = time();
		$difference = $now - $pubdate;
		
		$days = floor($difference / 84600);
		$difference -= 84600 * floor($difference / 84600);
		
		$hours = floor($difference / 3600);
		$difference -= 3600 * floor($difference / 3600);
		
		$minutes = floor($difference / 60);
		$seconds = $difference - (60 * floor($difference / 60));
		
		if ( $days > 0 ) {
			$a .= $days . " day";
			if ( $days > 1 ) {
				$a .= "s";
			}
			$a .= " ago";
			return $a;
		}
		if ( $hours > 0 ) {
			$a .= $hours . " hour";
			if ( $hours > 1 ) {
				$a .= "s";
			}			
			if ($hours > 2) {
				$a .= " ago";
				return $a;
			} else {
				$a .= ", ";
			}
		}
		if ( $minutes > 0 ) {
			$a .= $minutes . " minute";
			if ( $minutes > 1 ) {
				$a .= "s";
			}
			if ( $minutes > 2 ) {
				$a .= " ago";
				return $a;
			} else {
				$a .= ", ";
			}
		}
		$a .= $seconds . " seconds ago";	
		return $a;
	}
	
	function optionPageSelect($options, $settingName) {
		if($options && $settingName) { ?>
			<select name="fdw_options[<?php echo $settingName; ?>]"><?php
			foreach($options as $title => $value) { ?> 
				<option value="<?php echo $value; ?>"<?php if ( $this->$settingName == $value ) { echo ' selected="selected"'; } ?>><?php echo $title; ?></option><?php
			} ?>
			</select>
			<?php
		}
	}	
}

add_action('wp_dashboard_setup', 'fdw_register_dashboard_widgets');
add_filter('wp_dashboard_widgets', 'fdw_add_dashboard_widgets');

function fdw_register_dashboard_widgets() {
	global $fdw;
	$widgets = array(
		'updates'		=> array('title' => __('Facebook Friends Status Updates', 'fdw_updates'), 'link' => 'http://www.facebook.com/friends/'),
		'notifications'	=> array('title' => __('Facebook Notifications', 'fdw_notifications'), 'link' => 'http://www.facebook.com/friends/'), 
		'posted'		=> array('title' => __('Facebook Friends Posted Items', 'fdw_posted'), 'link' => 'http://www.facebook.com/posted.php')
	);
	
	foreach($widgets as $type => $value) {
		$show = 'show' . $type;
		if($fdw->$show == 'yes') {
			$widget = 'dashboard_fdw_' . $type;
			$feed = $type . 'feed';
			$height = $type . 'newheight';
			wp_register_sidebar_widget($widget, $value['title'], $widget,
				array(
				'all_link'	=> $value['link'],
				'feed_link'	=> $fdw->$feed,
				'height'	=> $fdw->$height,
				)
			);
		}
	}
}

function fdw_add_dashboard_widgets($widgets) {
	global $wp_registered_widgets;
	$new_widgets = array();
	foreach(array('updates', 'notifications', 'posted') as $dw) {
		$w = 'dashboard_fdw_' . $dw;
		if (isset($wp_registered_widgets[$w])) {
			$new_widgets[] = $w;
		}
	}
	if(count($new_widgets) > 0) {
		$widgets = array_merge($widgets, $new_widgets);
	}
	return $widgets;
}

// Display Updates Dashboard Widget
function dashboard_fdw_updates() {
	global $fdw;
	$fdw -> get_statuses();
}

// Display Notifications Dashboard Widget
function dashboard_fdw_notifications() {
	global $fdw;
	$fdw -> get_notifications();
}

// Display Posted Items Dashboard Widget
function dashboard_fdw_posted() {
	global $fdw;
	$fdw -> get_posteditems();
}

// Options Page
function fdw_options() {
	global $fdw;
	$yesno = array('No' => 'no', 'Yes' => 'yes');
	$howmany = array();
	for ($a=5; $a<=30; $a++) {
		$howmany[$a] = $a;
	}
	$heights = array("Full" => "full", "200 pixels" => "200", "300 pixels" => "300", "400 pixels" => "400", "500 pixels" => "500", "750 pixels" => "750");
	?>
    <div class="wrap">
		<form method="post" action="options.php" style="margin-bottom: 60px;">
			<?php settings_fields('fdw_options'); ?>
			<h2><?php echo __('Facebook Dashboard Widget Options', 'fdw') ?></h2>
			
			<h3>Friends Status Updates</h3>
			<table class="form-table" style="margin: 5px 0 20px;">
				<tr>
					<th>Display Status Updates Widget?</th>
					<td><?php $fdw->optionPageSelect($yesno, 'showupdates'); ?>
						 <em>Make sure you enter your feed URL before activating - for more information on how, <a href="#updates">see below</a></em>
					</td>
				</tr>
				<tr>
					<th>Status Updates Feed URL:</th>
					<td><input type="text" name="fdw_options[updatesfeed]" value="<?php echo $fdw->updatesfeed; ?>" size="105" /> <a href="#updates">?</a></td>
				</tr>
				<tr>
					<th>Number of updates to show:</th>
					<td><?php $fdw->optionPageSelect($howmany, 'updatesmax'); ?></td>
				</tr>
				<tr>
					<th>Widget Height:</th>
					<td><?php $fdw->optionPageSelect($heights, 'updatesnewheight'); ?></td>
				</tr>
			</table>
			
			<h3>Notifications</h3>
			<table class="form-table" style="margin: 5px 0;">
				<tr>
					<th>Display Notifications Widget?</th>
					<td><?php $fdw->optionPageSelect($yesno, 'shownotifications'); ?>
						 <em>Make sure you enter your feed URL before activating - for more information on how, <a href="#notifications">see below</a></em>
					</td>
				</tr>
				<tr>
					<th>Status Notifications Feed URL:</th>
					<td><input type="text" name="fdw_options[notificationsfeed]" value="<?php echo $fdw->notificationsfeed; ?>" size="105" /> <a href="#notifications">?</a></td>
				</tr>
				<tr>
					<th>Number of updates to show:</th>
					<td><?php $fdw->optionPageSelect($howmany, 'notificationsmax'); ?></td>
				</tr>
				<tr>
					<th>Widget Height:</th>
					<td><?php $fdw->optionPageSelect($heights, 'notificationsnewheight'); ?></td>
				</tr>
			</table>
			
			<h3>Posted Items</h3>
			<table class="form-table" style="margin: 5px 0;">
				<tr>
					<th>Display Posted Items Widget?</th>
					<td><?php $fdw->optionPageSelect($yesno, 'showposted'); ?>
						 <em>Make sure you enter your feed URL before activating - for more information on how, <a href="#posted">see below</a></em>
					</td>
				</tr>
				<tr>
					<th>Posted Items Feed URL:</th>
					<td><input type="text" name="fdw_options[postedfeed]" value="<?php echo $fdw->postedfeed; ?>" size="105" /> <a href="#posted">?</a></td>
				</tr>
				<tr>
					<th>Number of updates to show:</th>
					<td><?php $fdw->optionPageSelect($howmany, 'postedmax'); ?></td>
				</tr>
				<tr>
					<th>Widget Height:</th>
					<td><?php $fdw->optionPageSelect($heights, 'postednewheight'); ?></td>
				</tr>
			</table>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="fdw_options" />
            <p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options »') ?>" /></p>
	    </form>
	
		<h2><a name="updates"></a>How to find your Status Updates feed</h2>
		<p style="color:#aaa;"><em>Facebook seem to have done their best to hide the link to this feed, but it still works if you know what it is - you just have to jump through hoops to work it out!</em></p>
		<p><span style="font-size: 24px; font-weight: bold;">1.</span> <a href="#posted">Follow the instructions to obtain your friends "Posted Items" feed URL</a>.  You should have something like:<br /><em>http://www.facebook.com/feeds/share_friends_posts.php?id=1111111111&amp;key=1111111111&amp;format=rss20</em></p>
		<p><span style="font-size: 24px; font-weight: bold;">2.</span> Change share_friends_posts to friends_status, and you have your feed.  It should now look something like:<br /><em>http://www.facebook.com/feeds/friends_status.php?id=1111111111&amp;key=1111111111&amp;format=rss20</em></p>
		<div style="clear:left;"></div>
		
		<h2 style="margin-top: 30px;"><a name="notifications"></a>How to find your Notifications feed</h2>
		<p><span style="font-size: 24px; font-weight: bold;">1.</span> Log in to Facebook and visit <a href="http://www.facebook.com/notifications.php">http://www.facebook.com/notifications.php</a></p>
		<p><span style="font-size: 24px; font-weight: bold;">2.</span> Look in the right hand sidebar for a link named "Your Notifications".  Right click on the link, and select "Copy Link Location" (if you're using Firefox) or "Copy Shortcut" (if you're using Internet Explorer).  The link can now be pasted into the box on the form at the top of this page.</p>
		<img src="<?php echo bloginfo('wpurl'); ?>/wp-content/plugins/facebook-dashboard-widget/images/notifications-1.gif" />
		<div style="clear:left;"></div>
		
		<h2 style="margin-top: 30px;"><a name="posted"></a>How to find your friends Posted Items feed</h2>
		<p><span style="font-size: 24px; font-weight: bold;">1.</span> Go to <a href="http://www.facebook.com/posted.php" target="_blank">http://www.facebook.com/posted.php</a> (you may need to log in if you haven't already)</p>
		<p><span style="font-size: 24px; font-weight: bold;">2.</span> Look on the right hand sidebar for a link marked "My Friends' Links".</p>
		<p><span style="font-size: 24px; font-weight: bold;">3.</span> Right click on the link, and select "Copy Link Location" (if you're using Firefox) or "Copy Shortcut" (if you're using Internet Explorer).  The link can now be pasted into the box on the form at the top of this page.</p>
		<img src="<?php echo bloginfo('wpurl'); ?>/wp-content/plugins/facebook-dashboard-widget/images/posted-1.gif" />
		<div style="clear:left;"></div>
		
		<h2 style="margin-top: 60px;"><a name="donate"></a>Donate</h2>
		<p>This plugin is provided free under a GPL license, which means you can use, share, alter, change and generally mess around with to your hearts content -   and completely for free!  But if you like this plugin and would like to throw £1 or £2 my way, it'd put a little more joy into spending entire weekends in front of my laptop  :)</p>
		<p>But whether you choose to donate or not, I hope you enjoy the plugin!</p>
		<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="cezuk@aol.com">
		<input type="hidden" name="item_name" value="FDW Donation">
		<input type="hidden" name="currency_code" value="GBP">
		<input type="hidden" name="amount" value="1.00">
		<input type="image" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" style="margin-bottom:-5px;"> £1.00
		</form>
		<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="cezuk@aol.com">
		<input type="hidden" name="item_name" value="FDW Donation">
		<input type="hidden" name="currency_code" value="GBP">
		<input type="image" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" style="margin:0 0 -8px;">
		£<input type="text" name="amount" value="" size="20">
		</form>
		<br />
	</div>
    <?php
}

function fdw_menus() {
	if (current_user_can('manage_options')) {
		if (function_exists('add_options_page')) {
			add_options_page(__('Facebook Dashboard Widget', 'fdw'), __('Facebook Dashboard Widget', 'fdw'), 'install_plugins', __FILE__, 'fdw_options');
		}
	}
}
add_action('admin_menu', 'fdw_menus');

// Sidebar widget controls
function fdw_sidebar() {
	if ( !function_exists('wp_register_sidebar_widget') )
			return;
	
	function fdw_updates_sidebar_widget($args) {
		global $fdw;
		extract($args);
		echo $before_widget;
		echo $before_title;
		echo $fdw->widget_updatesoptions['title'];
		echo $after_title;
		$fdw->get_statuses("sidebar", $fdw->widget_updatesoptions['num']);
		echo $after_widget;
	}
	wp_register_sidebar_widget('fdw_updates_sidebar_widget', 'Facebook Status Updates', 'fdw_updates_sidebar_widget');
	
	function fdw_notifications_sidebar_widget($args) {
		global $fdw;
		extract($args);
		echo $before_widget;
		echo $before_title;
		echo $fdw->widget_notificationsoptions['title'];
		echo $after_title;
		$fdw->get_notifications("sidebar", $fdw->widget_notificationsoptions['num']);
		echo $after_widget;
	}
	wp_register_sidebar_widget('fdw_notifications_sidebar_widget', 'Facebook Notifications', 'fdw_notifications_sidebar_widget');
	
	function fdw_posteditems_sidebar_widget($args) {
		global $fdw;
		extract($args);
		$options = get_option('fdw_widget_posteditemsoptions');
		echo $before_widget;
		echo $before_title;
		echo $options['title'];
		echo $fdw->widget_posteditemsoptions['title'];
		echo $after_title;
		$fdw->get_posteditems("sidebar", $fdw->widget_posteditemsoptions['num']);
		echo $after_widget;
	}
	wp_register_sidebar_widget('fdw_posteditems_sidebar_widget', 'Facebook Posted Items', 'fdw_posteditems_sidebar_widget');
	
	function fdw_updates_widget_control() {
		$options = fdw_init();
		if (isset($_POST['fdw_widget_updatesoptions_action']) && $_POST['fdw_widget_updatesoptions_action'] == 'fdw_widget_updatesoptions_update_widget_options') {
			$options['widget_updatesoptions']['title']	= sprintf('%s', $_POST['fdw_widget_updatesoptions_widget_title']);
			$options['widget_updatesoptions']['num'] = sprintf('%d', $_POST['fdw_widget_updatesoptions_widget_num']);
			update_option('fdw_options', $options);
		}
		
		$title	= $options['widget_updatesoptions']['title'];
		$num	= $options['widget_updatesoptions']['num'];
		print('
			<p style="text-align:right;"><label for="fdw_widget_updatesoptions_widget_title">Title<input id="fdw_widget_updatesoptions_widget_title" name="fdw_widget_updatesoptions_widget_title" type="text" value="' . $title . '" /></label></p>
			<p style="text-align:right;"><label for="fdw_widget_updatesoptions_widget_width">Number to show<input id="fdw_widget_updatesoptions_widget_width" name="fdw_widget_updatesoptions_widget_num" type="text" value="' . $num . '" /></label></p>
			<input type="hidden" id="fdw_widget_updatesoptions_action" name="fdw_widget_updatesoptions_action" value="fdw_widget_updatesoptions_update_widget_options" />
		');
	}
	wp_register_widget_control('dashboard_fdw_updates', 'Facebook Status Updates', 'fdw_updates_widget_control', 200, 100);
	
	function fdw_notifications_widget_control() {
		$options = fdw_init();
		if (isset($_POST['fdw_widget_notificationsoptions_action']) && $_POST['fdw_widget_notificationsoptions_action'] == 'fdw_widget_notificationsoptions_update_widget_options') {
			$options['widget_notificationsoptions']['title']	= sprintf('%s', $_POST['fdw_widget_notificationsoptions_widget_title']);
			$options['widget_notificationsoptions']['num']		= sprintf('%d', $_POST['fdw_widget_notificationsoptions_widget_num']);
			update_option('fdw_options', $options);
		}
		
		$title	= $options['widget_notificationsoptions']['title'];
		$num	= $options['widget_notificationsoptions']['num'];
		print('
			<p style="text-align:right;"><label for="fdw_widget_notificationsoptions_widget_title">Title<input id="fdw_widget_notificationsoptions_widget_title" name="fdw_widget_notificationsoptions_widget_title" type="text" value="' . $title . '" /></label></p>
			<p style="text-align:right;"><label for="fdw_widget_notificationsoptions_widget_width">Number to show<input id="fdw_widget_notificationsoptions_widget_width" name="fdw_widget_notificationsoptions_widget_num" type="text" value="' . $num . '" /></label></p>
			<input type="hidden" id="fdw_widget_notificationsoptions_action" name="fdw_widget_notificationsoptions_action" value="fdw_widget_notificationsoptions_update_widget_options" />
		');
	}
	wp_register_widget_control('dashboard_fdw_notifications', 'Facebook Notifications', 'fdw_notifications_widget_control', 200, 100);
	
	function fdw_posteditems_widget_control() {
		$options = fdw_init();
		if (isset($_POST['fdw_widget_posteditemsoptions_action']) && $_POST['fdw_widget_posteditemsoptions_action'] == 'fdw_widget_posteditemsoptions_update_widget_options') {
			$options['widget_posteditemsoptions']['title']	= sprintf('%s', $_POST['fdw_widget_posteditemsoptions_widget_title']);
			$options['widget_posteditemsoptions']['num']		= sprintf('%d', $_POST['fdw_widget_posteditemsoptions_widget_num']);
			update_option('fdw_options', $options);
		}
		
		$title	= $options['widget_posteditemsoptions']['title'];
		$num	= $options['widget_posteditemsoptions']['num'];
		print('
			<p style="text-align:right;"><label for="fdw_widget_posteditemsoptions_widget_title">Title<input id="fdw_widget_posteditemsoptions_widget_title" name="fdw_widget_posteditemsoptions_widget_title" type="text" value="' . $title . '" /></label></p>
			<p style="text-align:right;"><label for="fdw_widget_posteditemsoptions_widget_width">Number to show<input id="fdw_widget_posteditemsoptions_widget_width" name="fdw_widget_posteditemsoptions_widget_num" type="text" value="' . $num . '" /></label></p>
			<input type="hidden" id="fdw_widget_posteditemsoptions_action" name="fdw_widget_posteditemsoptions_action" value="fdw_widget_posteditemsoptions_update_widget_options" />
		');
	}
	wp_register_widget_control('dashboard_fdw_posted', 'Facebook Posted Items', 'fdw_posteditems_widget_control', 200, 100);
}

add_action('widgets_init', 'fdw_sidebar');

function fdw_whitelist($options) {
	$added = array( 'fdw_options' => array( 'fdw_options' ) );
	$options = add_option_whitelist( $added, $options );
	return $options;
}
add_filter('whitelist_options', 'fdw_whitelist');

// Plugin page settings link
function fdw_settings_link($links) {  
   $settings_link = '<a href="options-general.php?page=facebook-dashboard-widget/fdw.php">Settings</a>';  
   array_unshift($links, $settings_link);  
   return $links;  
}
add_filter("plugin_action_links_".plugin_basename(__FILE__), 'fdw_settings_link' );  

?>