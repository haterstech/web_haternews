<?php
	if(!defined('ABSPATH')) exit;
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
	require_once(dirname(__FILE__) . '/Total-Soft-Poll-Preview.php');
	require_once(dirname(__FILE__) . '/Total-Soft-Poll-Check.php');
	require_once(dirname(__FILE__) . '/Total-Soft-Pricing.php');
	wp_enqueue_media();
	wp_enqueue_script( 'custom-header' );
	add_filter( 'upload_size_limit', 'PBP_increase_upload' );
	function PBP_increase_upload(  )
	{
		return 20480000; // 20MB
	}

	global $wpdb;
	$table_name1 = $wpdb->prefix . "totalsoft_poll_manager";
	$table_name2 = $wpdb->prefix . "totalsoft_poll_answers";
	$table_name3 = $wpdb->prefix . "totalsoft_poll_id";
	$table_name4 = $wpdb->prefix . "totalsoft_poll_dbt";
	$table_name6 = $wpdb->prefix . "totalsoft_poll_results";
	$table_name15 = $wpdb->prefix . "totalsoft_poll_quest_im";
	$table_name18 = $wpdb->prefix . "totalsoft_poll_setting";
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(check_admin_referer( 'edit-menu_', 'TS_Poll_Nonce' ))
		{
			$TotalSoftPoll_Question = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoftPoll_Question'])));
			$TotalSoftPoll_Theme = sanitize_text_field($_POST['TotalSoftPoll_Theme']);
			$TotalSoftPollHidNum = sanitize_text_field($_POST['TotalSoftPollHidNum']);
			$TotalSoftPoll_Q_Im = sanitize_text_field($_POST['TotalSoftPollQ_Image_2']);
			$TotalSoftPoll_Q_Vd = sanitize_text_field($_POST['TotalSoftPollQ_Video_2']);

			$TotalSoft_Poll_Gen_Set = sanitize_text_field($_POST['TotalSoft_Poll_Gen_Set']);

			$TotalSoftPoll_Ans = array();
			$TotalSoftPoll_Ans_Im = array();
			$TotalSoftPoll_Ans_Vd = array();
			$TotalSoftPoll_Ans_Cl = array();

			for($i=1; $i<=$TotalSoftPollHidNum; $i++)
			{
				$TotalSoftPoll_Ans[$i] = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoftPoll_Ans_' . $i])));
				$TotalSoftPoll_Ans_Im[$i] = sanitize_text_field($_POST['TotalSoftPoll_Ans_Im_' . $i]);
				$TotalSoftPoll_Ans_Vd[$i] = sanitize_text_field($_POST['TotalSoftPoll_Ans_Vd_' . $i]);
				$TotalSoftPoll_Ans_Cl[$i] = sanitize_text_field($_POST['TotalSoftPoll_Ans_Col_' . $i]);
			}
			if(isset($_POST['Total_Soft_Poll_Save']))
			{
				$wpdb->query($wpdb->prepare("INSERT INTO $table_name1 (id, TotalSoftPoll_Question, TotalSoftPoll_Theme, TotalSoftPoll_Ans_C) VALUES (%d, %s, %s, %s)", '', $TotalSoftPoll_Question, $TotalSoftPoll_Theme, $TotalSoftPollHidNum));

				$Total_Soft_Poll_New_ID=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id > %d order by id desc limit 1", 0));
				
				$wpdb->query($wpdb->prepare("INSERT INTO $table_name3 (id, Poll_ID) VALUES (%d, %d)", '', $Total_Soft_Poll_New_ID[0]->id));
				$wpdb->query($wpdb->prepare("INSERT INTO $table_name15 (id, Question_ID, TotalSoftPoll_Q_Im, TotalSoftPoll_Q_Vd, TotalSoftPoll_Q_01, TotalSoftPoll_Q_02, TotalSoftPoll_Q_03, TotalSoftPoll_Q_04, TotalSoftPoll_Q_05) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Total_Soft_Poll_New_ID[0]->id, $TotalSoftPoll_Q_Im, $TotalSoftPoll_Q_Vd, $TotalSoft_Poll_Gen_Set, '', '', '', ''));

				for($i=1; $i<=$TotalSoftPollHidNum; $i++)
				{
					$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, Question_ID, TotalSoftPoll_Ans, TotalSoftPoll_Ans_Im, TotalSoftPoll_Ans_Vd, TotalSoftPoll_Ans_Cl, TotalSoftPoll_Ans_01, TotalSoftPoll_Ans_02, TotalSoftPoll_Ans_03, TotalSoftPoll_Ans_04, TotalSoftPoll_Ans_05) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Total_Soft_Poll_New_ID[0]->id, $TotalSoftPoll_Ans[$i], $TotalSoftPoll_Ans_Im[$i], $TotalSoftPoll_Ans_Vd[$i], $TotalSoftPoll_Ans_Cl[$i], '', '', '', '', ''));

					$Total_Soft_Poll_Ans_ID=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name2 WHERE Question_ID = %s order by id desc limit 1", $Total_Soft_Poll_New_ID[0]->id));

					$wpdb->query($wpdb->prepare("INSERT INTO $table_name6 (id, Poll_ID, Poll_A_ID, Poll_A_Votes) VALUES (%d, %s, %s, %s)", '', $Total_Soft_Poll_New_ID[0]->id, $Total_Soft_Poll_Ans_ID, 0));
				}
			}
			else if(isset($_POST['Total_Soft_Poll_Update']))
			{
				$Total_SoftPoll_Update = sanitize_text_field($_POST['Total_SoftPoll_Update']);
				$wpdb->query($wpdb->prepare("UPDATE $table_name1 set TotalSoftPoll_Question = %s, TotalSoftPoll_Theme = %s, TotalSoftPoll_Ans_C = %s WHERE id = %d", $TotalSoftPoll_Question, $TotalSoftPoll_Theme, $TotalSoftPollHidNum, $Total_SoftPoll_Update));
				$wpdb->query($wpdb->prepare("UPDATE $table_name15 set TotalSoftPoll_Q_Im = %s, TotalSoftPoll_Q_Vd = %s, TotalSoftPoll_Q_01 = %s, TotalSoftPoll_Q_02 = %s, TotalSoftPoll_Q_03 = %s, TotalSoftPoll_Q_04 = %s, TotalSoftPoll_Q_05 = %s WHERE Question_ID = %s", $TotalSoftPoll_Q_Im, $TotalSoftPoll_Q_Vd, $TotalSoft_Poll_Gen_Set, '', '', '', '', $Total_SoftPoll_Update));
				$array = array();

				$Total_Soft_Poll_Answers=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE Question_ID = %s", $Total_SoftPoll_Update));
				$Total_Soft_Poll_Votes=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name6 WHERE Poll_ID = %s", $Total_SoftPoll_Update));

				for($i = 0; $i < count($Total_Soft_Poll_Answers); $i++){
					foreach ($Total_Soft_Poll_Answers[$i] as $key => $k) {
						if($key == "TotalSoftPoll_Ans"){
							$array[$k] = $Total_Soft_Poll_Votes[$i]->Poll_A_Votes;
						}
					}
				}

				$wpdb->query($wpdb->prepare("DELETE FROM $table_name2 WHERE Question_ID = %s", $Total_SoftPoll_Update));
				$wpdb->query($wpdb->prepare("DELETE FROM $table_name6 WHERE Poll_ID = %s", $Total_SoftPoll_Update));

				for($i=1; $i<=$TotalSoftPollHidNum; $i++)
				{
					$vote = 0;
					$wpdb->query($wpdb->prepare("INSERT INTO $table_name2 (id, Question_ID, TotalSoftPoll_Ans, TotalSoftPoll_Ans_Im, TotalSoftPoll_Ans_Vd, TotalSoftPoll_Ans_Cl, TotalSoftPoll_Ans_01, TotalSoftPoll_Ans_02, TotalSoftPoll_Ans_03, TotalSoftPoll_Ans_04, TotalSoftPoll_Ans_05) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', $Total_SoftPoll_Update, $TotalSoftPoll_Ans[$i], $TotalSoftPoll_Ans_Im[$i], $TotalSoftPoll_Ans_Vd[$i], $TotalSoftPoll_Ans_Cl[$i], '', '', '', '', ''));

					$Total_Soft_Poll_Ans_ID=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name2 WHERE Question_ID = %s order by id desc limit 1", $Total_SoftPoll_Update));
					$Total_Soft_Poll_Answer=$wpdb->get_var($wpdb->prepare("SELECT TotalSoftPoll_Ans FROM $table_name2 WHERE Question_ID = %s order by id desc limit 1", $Total_SoftPoll_Update));

					foreach ($array as $key => $k) {
						if($Total_Soft_Poll_Answer == $key){
							$vote = $k;
						}
					}

					$wpdb->query($wpdb->prepare("INSERT INTO $table_name6 (id, Poll_ID, Poll_A_ID, Poll_A_Votes) VALUES (%d, %s, %s, %s)", '', $Total_SoftPoll_Update, $Total_Soft_Poll_Ans_ID, $vote));
				}
			}
		}
		else
		{
			wp_die('Security check fail');
		}
	}

	$TotalSoftPollCount = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id>%d order by id",0));
	$TotalSoftPollThemes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id>%d order by id",0));
	$TotalSoftPollShortID = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name3 WHERE id>%d order by id desc limit 1",0));
	$TotalSoftPollSetCount = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name18 WHERE id>%d order by id",0));
?>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('../CSS/totalsoft.css',__FILE__);?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<form method="POST" enctype="multipart/form-data">
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
		<div class="Total_Soft_Poll_AMD2">
			<i class="Total_Soft_Poll_Help totalsoft totalsoft-question-circle-o" title="Click for creating new Poll."></i>
			<span class="Total_Soft_Poll_AMD2_But" onclick="Total_Soft_Poll_AMD2_But1(<?php echo $TotalSoftPollShortID[0]->Poll_ID+1;?>)">
				Create Poll
			</span>
		</div>
		<div class="Total_Soft_Poll_AMD3">
			<i class="Total_Soft_Poll_Help totalsoft totalsoft-question-circle-o" title="Click for refreshing the page."></i>
			<span class="Total_Soft_Poll_AMD2_But" onclick="TotalSoftPoll_Reload()">
				Cancel
			</span>
			<i class="Total_Soft_Poll_Save Total_Soft_Poll_Help totalsoft totalsoft-question-circle-o" title="Click for saving the Poll."></i>
			<button type="submit" class="Total_Soft_Poll_Save Total_Soft_Poll_AMD2_But" name="Total_Soft_Poll_Save">
				Save
			</button>
			<i class="Total_Soft_Poll_Update Total_Soft_Poll_Help totalsoft totalsoft-question-circle-o" title="Click for updating the Poll."></i>
			<button type="submit" class="Total_Soft_Poll_Update Total_Soft_Poll_AMD2_But" name="Total_Soft_Poll_Update">
				Update
			</button>
			<input type="text" style="display:none" name="Total_SoftPoll_Update" id="Total_SoftPoll_Update">
		</div>
	</div>
	<table class="Total_Soft_Poll_AMMTable">
		<tr class="Total_Soft_Poll_AMMTableFR">
			<td>No</td>
			<td>Question</td>
			<td>Answers Count</td>
			<td>Theme</td>
			<td>Live Preview</td>
			<td>Copy</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>
	</table>
	<table class="Total_Soft_Poll_AMOTable">
		<?php for($i=0;$i<count($TotalSoftPollCount);$i++){
			$TotalSoftPollThemName = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id=%d", $TotalSoftPollCount[$i]->TotalSoftPoll_Theme));
			?>
			<tr id="Total_Soft_Poll_AMOTable_tr_<?php echo $TotalSoftPollCount[$i]->id;?>">
				<td><?php echo $i+1;?></td>
				<td><?php echo $TotalSoftPollCount[$i]->TotalSoftPoll_Question;?></td>
				<td><?php echo $TotalSoftPollCount[$i]->TotalSoftPoll_Ans_C;?></td>
				<td><?php echo $TotalSoftPollThemName[0]->TotalSoft_Poll_TTitle;?></td>
				<td>
					<a href="<?php echo home_url(); ?>?ts_poll_preview_poll=<?php echo $TotalSoftPollCount[$i]->id;?>" class="Total_Soft_Poll_AMD2_But_LP" target="_blank">
						<i class="totalsoft totalsoft-eye"></i>
					</a>
				</td>
				<td><i class="totalsoft totalsoft-file-text" onclick="TotalSoftPoll_Clone(<?php echo $TotalSoftPollCount[$i]->id;?>)"></i></td>
				<td><i class="totalsoft totalsoft-pencil" onclick="TotalSoftPoll_Edit(<?php echo $TotalSoftPollCount[$i]->id;?>)"></i></td>
				<td>
					<i class="totalsoft totalsoft-trash" onclick="TotalSoftPoll_Del(<?php echo $TotalSoftPollCount[$i]->id;?>)"></i>
					<span class="Total_Soft_Poll_Del_Span">
						<i class="Total_Soft_Poll_Del_Span_Yes totalsoft totalsoft-check" onclick="TotalSoftPoll_Del_Yes(<?php echo $TotalSoftPollCount[$i]->id;?>)"></i>
						<i class="Total_Soft_Poll_Del_Span_No totalsoft totalsoft-times" onclick="TotalSoftPoll_Del_No(<?php echo $TotalSoftPollCount[$i]->id;?>)"></i>
					</span>
				</td>
			</tr>
		<?php }?>
	</table>
	<div class="Total_Soft_Poll_Loading">
		<img src="<?php echo plugins_url('../Images/loading.gif',__FILE__);?>">
	</div>
	<table class="Total_Soft_Poll_AMShortTable">
		<tr style="text-align:center">
			<td>Shortcode</td>
			<td>Templete Include</td>
		</tr>
		<tr>
			<td>Copy &amp; paste the shortcode directly into any WordPress post or page.</td>
			<td>Copy &amp; paste this code into a template file to include the poll within your theme.</td>
		</tr>
		<tr style="text-align:center">
			<td>
				<span id="Total_Soft_Poll_ID"></span>
				<i class="Total_Soft_Poll_Help3 totalsoft totalsoft-files-o" title="Click to Copy." onclick="Copy_Shortcode_Poll('Total_Soft_Poll_ID')"></i>
			</td>
			<td>
				<span id="Total_Soft_Poll_TID"></span>
				<i class="Total_Soft_Poll_Help3 totalsoft totalsoft-files-o" title="Click to Copy." onclick="Copy_Shortcode_Poll('Total_Soft_Poll_TID')"></i>
			</td>
		</tr>
	</table>
	<div class="TS_Poll_Add_Answer_Fixed_div"></div>
	<div class="TS_Poll_Add_Answer_Absolute_div">
		<div class="TS_Poll_Add_Answer_Relative_div">
			<table class="TS_Poll_Add_Answer_Table">
				<tr>
					<td colspan="2">Add Answer</td>
				</tr>
				<tr>
					<td>Answer</td>
					<td>
						<input type="text" class="Total_Soft_Poll_Select" id="TotalSoftPoll_Answer">
					</td>
				</tr>
				<tr>
					<td>
						<div id="wp-content-media-buttons" class="wp-media-buttons">
							<a href="#" class="button insert-media add_media" style="border:1px solid #009491; color:#009491; background-color:#f4f4f4" data-editor="TotalSoftPoll_Video_1" title="Add Video" id="TotalSoftPoll_Video" onclick="TotalSoftPoll_Video_Clicked('TotalSoftPoll')">
								<span class="wp-media-buttons-icon"></span>Add Video
							</a>
						</div>
						<input type="text" style="display:none;" id="TotalSoftPoll_Video_1">
					</td>
					<td style="position: relative;">
						<input type="text" class="Total_Soft_Poll_Select" id="TotalSoftPoll_Video_2" readonly>
						<i class="TSPDUFS totalsoft totalsoft-times" aria-hidden="true" onclick="TSPDUFS_Cl('TotalSoftPoll_Video_2')"></i>
					</td>
				</tr>
				<tr>
					<td>
						<div id="wp-content-media-buttons" class="wp-media-buttons">
							<a href="#" class="button insert-media add_media" style="border:1px solid #009491; color:#009491; background-color:#f4f4f4" data-editor="TotalSoftPoll_Image_1" title="Add Image" id="TotalSoftPoll_Image" onclick="TotalSoftPoll_Image_Clicked('TotalSoftPoll')">
								<span class="wp-media-buttons-icon"></span>Add Image
							</a>
						</div>
						<input type="text" style="display:none;" id="TotalSoftPoll_Image_1">
					</td>
					<td style="position: relative;">
						<input type="text" class="Total_Soft_Poll_Select" id="TotalSoftPoll_Image_2" readonly>
						<i class="TSPDUFS totalsoft totalsoft-times" aria-hidden="true" onclick="TSPDUFS_Cl('TotalSoftPoll_Image_2')"></i>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<span class="Total_Soft_Poll_AMD2_But" onclick="TS_Poll_Add_Answer_Button_Close()">Close</span>
						<span class="Total_Soft_Poll_AMD2_But" id="Total_Soft_Poll_UpdAns" onclick="Total_Soft_Poll_Update_Ans()">Update Answer</span>
						<span class="Total_Soft_Poll_AMD2_But" id="Total_Soft_Poll_SavAns" onclick="Total_Soft_Poll_Save_Ans()">Save Answer</span>
						<span class="Total_Soft_Poll_AMD2_But" onclick="Total_Soft_Poll_Res_Ans()">Reset</span>
						<input type="text" style="display:none;" id="TotalSoftPollHidUpdate" value="0">
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="TS_Poll_AM_Table_Div">
		<table class="Total_Soft_Poll_Add_Answer">
			<tr>
				<td colspan="2">Add Question</td>
			</tr>
		</table>
		<table class="Total_Soft_Poll_Add_MTable">
			<tr>
				<td>Question</td>
				<td>
					<input type="text" class="Total_Soft_Poll_Select" name="TotalSoftPoll_Question" id="TotalSoftPoll_Question" required placeholder=" * Required">
				</td>
			</tr>
			<tr>
				<td>Settings</td>
				<td>
					<select class="Total_Soft_Poll_Select" id="TotalSoft_Poll_Gen_Set" name="TotalSoft_Poll_Gen_Set">
						<?php for($i=0;$i<count($TotalSoftPollSetCount);$i++){?>
							<option value="<?php echo $TotalSoftPollSetCount[$i]->id;?>"><?php echo $TotalSoftPollSetCount[$i]->TotalSoft_Poll_SetTitle;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Theme</td>
				<td>
					<select class="Total_Soft_Poll_Select" id="TotalSoftPoll_Theme" name="TotalSoftPoll_Theme" onchange="TotalSoftPoll_Type_Ch()">
						<?php for($i=0;$i<count($TotalSoftPollThemes);$i++){?>
							<option id="TotalSoftPoll_Theme_<?php echo $TotalSoftPollThemes[$i]->id;?>" value="<?php echo $TotalSoftPollThemes[$i]->id;?>" rel="<?php echo $TotalSoftPollThemes[$i]->TotalSoft_Poll_TType;?>"><?php echo $TotalSoftPollThemes[$i]->TotalSoft_Poll_TTitle;?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<div id="wp-content-media-buttons" class="wp-media-buttons">
						<a href="#" class="button insert-media add_media" style="border:1px solid #009491; color:#009491; background-color:#f4f4f4" data-editor="TotalSoftPollQ_Video_1" title="Add Video" id="TotalSoftPollQ_Video" onclick="TotalSoftPoll_Video_Clicked('TotalSoftPollQ')">
							<span class="wp-media-buttons-icon"></span>Add Video
						</a>
					</div>
					<input type="text" style="display:none;" id="TotalSoftPollQ_Video_1">
				</td>
				<td>
					<input type="text" class="Total_Soft_Poll_Select" id="TotalSoftPollQ_Video_2" name="TotalSoftPollQ_Video_2" readonly>
					<i class="TSPDUFS totalsoft totalsoft-times" aria-hidden="true" onclick="TSPDUFS_Cl('TotalSoftPollQ_Video_2')"></i>
				</td>
			</tr>
			<tr>
				<td>
					<div id="wp-content-media-buttons" class="wp-media-buttons">
						<a href="#" class="button insert-media add_media" style="border:1px solid #009491; color:#009491; background-color:#f4f4f4" data-editor="TotalSoftPollQ_Image_1" title="Add Image" id="TotalSoftPollQ_Image" onclick="TotalSoftPoll_Image_Clicked('TotalSoftPollQ')">
							<span class="wp-media-buttons-icon"></span>Add Image
						</a>
					</div>
					<input type="text" style="display:none;" id="TotalSoftPollQ_Image_1">
				</td>
				<td>
					<input type="text" class="Total_Soft_Poll_Select" id="TotalSoftPollQ_Image_2" name="TotalSoftPollQ_Image_2" readonly>
					<i class="TSPDUFS totalsoft totalsoft-times" aria-hidden="true" onclick="TSPDUFS_Cl('TotalSoftPollQ_Image_2')"></i>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="TS_Poll_AM_ANV">
						<span class="TS_Poll_AM_ANV_Span1" onclick="TS_Poll_Add_Answer_Button()">
							<span class="TS_Poll_AM_ANV_Span2">
								<i class="TS_Poll_AM_ANV_Icon totalsoft totalsoft-plus-circle" style="margin-right: 5px;"></i>
								Add Answer
							</span>
						</span>
					</div>
					<input type="text" style="display:none;" id="TotalSoftPollHidNum" name="TotalSoftPollHidNum" value="0">
				</td>
			</tr>
		</table>
	</div>
	<table class="Total_Soft_Poll_AnswersTable">
		<tr>
			<td>No</td>
			<td>Color</td>
			<td>Answer</td>
			<td>Media</td>
			<td>Copy</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>
	</table>
	<ul id="TotalSoftPoll_AnswerUl" onmouseover="TotalSoftPoll_AnswerUlSort()"></ul>
</form>