<?php
	global $wpdb;

	$table_name15 = $wpdb->prefix . "totalsoft_poll_quest_im";
	$table_name18 = $wpdb->prefix . "totalsoft_poll_setting";

	$sql18 = 'CREATE TABLE IF NOT EXISTS ' .$table_name18 . '( id INTEGER(10) UNSIGNED AUTO_INCREMENT, TotalSoft_Poll_SetTitle VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_01 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_02 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_03 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_04 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_05 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_06 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_07 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_08 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_09 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_10 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_11 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_12 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_13 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_14 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_15 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_16 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_17 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_18 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_19 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_20 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_21 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_22 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_23 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_24 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_25 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_26 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_27 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_28 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_29 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_30 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_31 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_32 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_33 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_34 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_35 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_36 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_37 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_38 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_39 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_40 VARCHAR(255) NOT NULL, TotalSoft_Poll_Set_41 VARCHAR(255) NOT NULL, PRIMARY KEY (id))';

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql18);

	$sqla18 = 'ALTER TABLE ' . $table_name18 . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';

	$wpdb->query($sqla18);

	$TotalSoftSetCount=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name18 WHERE id>%d",0));
	if(count($TotalSoftSetCount)==0)
	{
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name18 (id, TotalSoft_Poll_SetTitle, TotalSoft_Poll_Set_01, TotalSoft_Poll_Set_02, TotalSoft_Poll_Set_03, TotalSoft_Poll_Set_04, TotalSoft_Poll_Set_05, TotalSoft_Poll_Set_06, TotalSoft_Poll_Set_07, TotalSoft_Poll_Set_08, TotalSoft_Poll_Set_09, TotalSoft_Poll_Set_10, TotalSoft_Poll_Set_11, TotalSoft_Poll_Set_12, TotalSoft_Poll_Set_13, TotalSoft_Poll_Set_14, TotalSoft_Poll_Set_15, TotalSoft_Poll_Set_16, TotalSoft_Poll_Set_17, TotalSoft_Poll_Set_18, TotalSoft_Poll_Set_19, TotalSoft_Poll_Set_20, TotalSoft_Poll_Set_21, TotalSoft_Poll_Set_22, TotalSoft_Poll_Set_23, TotalSoft_Poll_Set_24, TotalSoft_Poll_Set_25, TotalSoft_Poll_Set_26, TotalSoft_Poll_Set_27, TotalSoft_Poll_Set_28, TotalSoft_Poll_Set_29, TotalSoft_Poll_Set_30, TotalSoft_Poll_Set_31, TotalSoft_Poll_Set_32, TotalSoft_Poll_Set_33, TotalSoft_Poll_Set_34, TotalSoft_Poll_Set_35, TotalSoft_Poll_Set_36, TotalSoft_Poll_Set_37, TotalSoft_Poll_Set_38, TotalSoft_Poll_Set_39, TotalSoft_Poll_Set_40, TotalSoft_Poll_Set_41) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", '', 'Total Soft Poll Setting 1', 'true', '', '', 'Coming Soon', 'Thank You !', 'rgba(209,209,209,0.79)', '#000000', '32', 'Gabriola', 'true', 'phpcookie', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''));
	}
	$TotalSoftSetCount1=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name18 WHERE id>%d order by id",0));
	$TotalSoftPollQuest3=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name15 WHERE id>%d order by id",0));

	for($i = 0; $i < count($TotalSoftPollQuest3); $i++)
	{
		if($TotalSoftPollQuest3[$i]->TotalSoftPoll_Q_01 == '')
		{
			$wpdb->query($wpdb->prepare("UPDATE $table_name15 set TotalSoftPoll_Q_01=%s WHERE id=%d", $TotalSoftSetCount1[0]->id, $TotalSoftPollQuest3[$i]->id));
		}
	}
?>