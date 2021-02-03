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
	$table_name2 = $wpdb->prefix . "totalsoft_poll_answers";
	$table_name6 = $wpdb->prefix . "totalsoft_poll_results";

	$Total_Soft_Poll_Questions = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id > %d order by id", 0));

	if( $_SERVER["REQUEST_METHOD"] == "POST" )
	{
		if(check_admin_referer( 'edit-menu_', 'TS_Poll_Nonce' ))
		{
			$Total_Soft_Poll_Results_Quest = sanitize_text_field($_POST['Total_Soft_Poll_Results_Quest']);

			if(isset($_POST['Total_Soft_Poll_Res_Upd']))
			{
				$Total_SoftPoll_Vote_Arr = array();

				$Total_Soft_Poll_Results=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE Poll_ID = %s order by id", $Total_Soft_Poll_Results_Quest));
				for( $i = 1; $i <= count($Total_Soft_Poll_Results); $i++)
				{
					array_push($Total_SoftPoll_Vote_Arr, sanitize_text_field($_POST['Total_Soft_Poll_Results_' . $i]));
				}

				for( $i = 0; $i < count($Total_Soft_Poll_Results); $i++)
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name6 set Poll_A_Votes = %s WHERE Poll_ID = %s AND Poll_A_ID = %s", $Total_SoftPoll_Vote_Arr[$i], $Total_Soft_Poll_Results_Quest, $Total_Soft_Poll_Results[$i]->Poll_A_ID));
				}
			}
		}
		else
		{
			wp_die('Security check fail');
		}
	}
	else
	{
		$Total_Soft_Poll_Results_Quest = $Total_Soft_Poll_Questions[0]->id;
	}

	$Total_Soft_Poll_Questin = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id = %s", $Total_Soft_Poll_Results_Quest));
	$Total_Soft_Poll_Answers = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE Question_ID = %s order by id", $Total_Soft_Poll_Results_Quest));
	$Total_Soft_Poll_Results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE Poll_ID = %s order by id", $Total_Soft_Poll_Results_Quest));
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
			<a href="https://wordpress.org/support/plugin/poll-wp/" target="_blank" title="Click Here to Ask Your Question.">
				<i class="totalsoft totalsoft-comments-o"></i><span style="margin-left:5px;">If you have any questions click here to ask it to our support.</span>
			</a>
		</div>
		<div class="Total_Soft_Poll_AMD1"></div>
		<div class="Total_Soft_Poll_AMD2">
			<i class="Total_Soft_Poll_Help totalsoft totalsoft-question-circle-o" title="Click to Update the results."></i>
			<button type="submit" class="Total_Soft_Poll_AMD2_But" name="Total_Soft_Poll_Res_Upd">
				Update
			</button>
		</div>
	</div>
	<table class="Total_Soft_Poll_Results_Table">
		<tr>
			<td colspan="4">
				<select onchange="this.form.submit()" name="Total_Soft_Poll_Results_Quest" class="Total_Soft_Poll_Results_Quest">
					<?php for( $i = 0; $i < count($Total_Soft_Poll_Questions); $i++ ){ ?>
						<?php if($Total_Soft_Poll_Questions[$i]->id == $Total_Soft_Poll_Results_Quest){ ?>
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
			<td>Answer</td>
			<td>Media</td>
			<td>Votes</td>
		</tr>
		<?php for( $i = 0; $i < count($Total_Soft_Poll_Results); $i++) { ?>
			<tr>
				<td> <?php echo $i+1; ?> </td>
				<td> <?php echo $Total_Soft_Poll_Answers[$i]->TotalSoftPoll_Ans; ?> </td>
				<td> <img class="TotalSoftPollAnsImage" src="<?php echo $Total_Soft_Poll_Answers[$i]->TotalSoftPoll_Ans_Im; ?>"> </td>
				<td> <input type="text" name="Total_Soft_Poll_Results_<?php echo $i+1; ?>" value="<?php echo $Total_Soft_Poll_Results[$i]->Poll_A_Votes; ?>"> </td>
			</tr> 
		<?php } ?>
	</table>
</form>