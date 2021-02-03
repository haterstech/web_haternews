<?php
	global $wpdb;

	$table_name1 = $wpdb->prefix . "totalsoft_poll_manager";
	$TotalSoftPollCount = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id>%d order by id",0));
?>
<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('#TS_Poll_Media_Insert').on('click', function () {
			var id = jQuery('#TS_Poll_Media_Select option:selected').val();
			window.send_to_editor('[Total_Soft_Poll id="' + id + '"]');
			tb_remove();
			return false;
		});
	});
</script>
<form method="POST">
	<div id="TSPoll" style="display: none;">
		<?php
			$new_poll_link = admin_url('admin.php?page=Total_Soft_Poll');
			$new_poll_link_n = wp_nonce_url( '', 'edit-menu_', 'TS_Poll_Nonce' );

			if ($TotalSoftPollCount && !empty($TotalSoftPollCount)) { ?>
				<h3>Select The Poll</h3>
				<select id="TS_Poll_Media_Select">
					<?php
						foreach ($TotalSoftPollCount as $TotalSoftPollCount1)
						{
							?> <option value="<?php echo $TotalSoftPollCount1->id; ?>"> <?php echo $TotalSoftPollCount1->TotalSoftPoll_Question; ?> </option> <?php
						}
					?>
				</select>
				<button class='button primary' id='TS_Poll_Media_Insert'>Insert Poll</button>
			<?php } else {
				printf('<p>%s<a class="button" href="%s">%s</a></p>', 'You have not created any galleries yet' . '<br>', $new_poll_link . $new_poll_link_n, 'Create New Poll');
			}
		?>
	</div>
</form>