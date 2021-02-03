<?php
	if(!defined('ABSPATH')) exit;
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
	require_once(dirname(__FILE__) . '/Total-Soft-Poll-Check.php');
	require_once(dirname(__FILE__) . '/Total-Soft-Pricing.php');
	global $wpdb;

	$table_name1 = $wpdb->prefix . "totalsoft_poll_manager";
	$table_name7 = $wpdb->prefix . "totalsoft_poll_inform";

	$Total_Soft_Poll_Questions=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id > %d order by id", 0));

	if( $_SERVER["REQUEST_METHOD"] == "POST" )
	{
		if(check_admin_referer( 'edit-menu_', 'TS_Poll_Nonce' ))
		{
			$Total_Soft_Poll_Info_Quest = sanitize_text_field($_POST['Total_Soft_Poll_Info_Quest']);
		}
		else
		{
			wp_die('Security check fail');
		}
	}
	else
	{
		$Total_Soft_Poll_Info_Quest = $Total_Soft_Poll_Questions[0]->id;
	}

	$Total_Soft_Poll_Info=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name7 WHERE Poll_ID = %d order by id", $Total_Soft_Poll_Info_Quest));
?>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('../CSS/totalsoft.css',__FILE__);?>">
<form method="POST" oninput="">
	<?php wp_nonce_field( 'edit-menu_', 'TS_Poll_Nonce' );?>
	<div class="Total_Soft_Poll_AMD">
		<a href="http://total-soft.pe.hu/poll/" target="_blank" title="Click to Buy">
			<div class="Full_Version"><i class="totalsoft totalsoft-cart-arrow-down"></i> Get The Full Version</div>
		</a>
		<div class="Full_Version_Span">
			This is the free version of the plugin.
		</div>
		<div class="Support_Span">
			<a href="https://wordpress.org/support/plugin/poll-wp/" target="_blank" title="Click Here to Ask">
				<i class="totalsoft totalsoft-comments-o"></i><span style="margin-left:5px;">If you have any questions click here to ask it to our support.</span>
			</a>
		</div>
		<div class="Total_Soft_Poll_AMD1"></div>
	</div>
	<table class="Total_Soft_Poll_Info_Table">
		<tr>
			<td colspan="7">
				<select onchange="this.form.submit()" name="Total_Soft_Poll_Info_Quest" class="Total_Soft_Poll_Info_Quest">
					<?php for( $i = 0; $i < count($Total_Soft_Poll_Questions); $i++ ){ ?>
						<?php if($Total_Soft_Poll_Questions[$i]->id == $Total_Soft_Poll_Info_Quest){ ?>
							<option selected value="<?php echo $Total_Soft_Poll_Questions[$i]->id;?>"><?php echo html_entity_decode($Total_Soft_Poll_Questions[$i]->TotalSoftPoll_Question);?></option>
						<?php } else { ?>
							<option value="<?php echo $Total_Soft_Poll_Questions[$i]->id;?>"><?php echo html_entity_decode($Total_Soft_Poll_Questions[$i]->TotalSoftPoll_Question);?></option>
						<?php }?>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<td>No</td>
			<td>Date</td>
			<td>IP</td>
			<td>Country</td>
			<td>Region</td>
			<td>City</td>
			<td>Flag</td>
		</tr>
		<?php for( $i = 0; $i < count($Total_Soft_Poll_Info); $i++) { ?>
			<tr>
				<td> <?php echo $i+1; ?> </td>
				<td> <?php echo $Total_Soft_Poll_Info[$i]->Data; ?> </td>
			<td> Unknown </td>
				<td> Unknown (UN) </td>
				<td> Unknown </td>
				<td> Unknown </td>
				<td> <img src="<?php echo plugins_url('../Images/Flags/UN.png',__FILE__);?>" style="vertical-align: middle;"> </td>
			</tr>
		<?php } ?>
	</table>
</form>