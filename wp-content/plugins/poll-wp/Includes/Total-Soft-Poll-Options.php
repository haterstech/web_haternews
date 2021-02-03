<?php
	if(!defined('ABSPATH')) exit;
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
	require_once(dirname(__FILE__) . '/Total-Soft-Poll-Preview.php');
	require_once(dirname(__FILE__) . '/Total-Soft-Poll-Check.php');
	require_once(dirname(__FILE__) . '/Total-Soft-Pricing.php');
	global $wpdb;
	$table_name1  = $wpdb->prefix . "totalsoft_poll_manager";
	$table_name4  = $wpdb->prefix . "totalsoft_poll_dbt";
	$table_name5  = $wpdb->prefix . "totalsoft_poll_stpoll";
	$table_name8  = $wpdb->prefix . "totalsoft_poll_stpoll_1";
	$table_name9  = $wpdb->prefix . "totalsoft_poll_impoll";
	$table_name10 = $wpdb->prefix . "totalsoft_poll_impoll_1";
	$table_name11 = $wpdb->prefix . "totalsoft_poll_stwibu";
	$table_name12 = $wpdb->prefix . "totalsoft_poll_stwibu_1";
	$table_name13 = $wpdb->prefix . "totalsoft_poll_imwibu";
	$table_name14 = $wpdb->prefix . "totalsoft_poll_imwibu_1";
	$table_name16 = $wpdb->prefix . "totalsoft_poll_iminqu";
	$table_name17 = $wpdb->prefix . "totalsoft_poll_iminqu_1";

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(check_admin_referer( 'edit-menu_', 'TS_Poll_Nonce' ))
		{
			$TotalSoft_Poll_TTitle = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_TTitle'])));
			$TotalSoft_Poll_TType = sanitize_text_field($_POST['TotalSoft_Poll_TType']);

			// Standart Poll
			$TotalSoft_Poll_1_MW = sanitize_text_field($_POST['TotalSoft_Poll_1_MW']); $TotalSoft_Poll_1_Pos = sanitize_text_field($_POST['TotalSoft_Poll_1_Pos']); $TotalSoft_Poll_1_BW = sanitize_text_field($_POST['TotalSoft_Poll_1_BW']); $TotalSoft_Poll_1_BR = sanitize_text_field($_POST['TotalSoft_Poll_1_BR']); $TotalSoft_Poll_1_BoxSh = sanitize_text_field($_POST['TotalSoft_Poll_1_BoxSh']); $TotalSoft_Poll_1_Q_FS = sanitize_text_field($_POST['TotalSoft_Poll_1_Q_FS']); $TotalSoft_Poll_1_Q_FF = sanitize_text_field($_POST['TotalSoft_Poll_1_Q_FF']); $TotalSoft_Poll_1_Q_TA = sanitize_text_field($_POST['TotalSoft_Poll_1_Q_TA']); $TotalSoft_Poll_1_LAQ_W = sanitize_text_field($_POST['TotalSoft_Poll_1_LAQ_W']); $TotalSoft_Poll_1_LAQ_H = sanitize_text_field($_POST['TotalSoft_Poll_1_LAQ_H']); $TotalSoft_Poll_1_LAQ_S = sanitize_text_field($_POST['TotalSoft_Poll_1_LAQ_S']); $TotalSoft_Poll_1_A_FS = sanitize_text_field($_POST['TotalSoft_Poll_1_A_FS']); $TotalSoft_Poll_1_CH_S = sanitize_text_field($_POST['TotalSoft_Poll_1_CH_S']); $TotalSoft_Poll_1_LAA_W = sanitize_text_field($_POST['TotalSoft_Poll_1_LAA_W']); $TotalSoft_Poll_1_LAA_H = sanitize_text_field($_POST['TotalSoft_Poll_1_LAA_H']); $TotalSoft_Poll_1_LAA_S = sanitize_text_field($_POST['TotalSoft_Poll_1_LAA_S']); $TotalSoft_Poll_1_VB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_1_VB_Pos']); $TotalSoft_Poll_1_VB_BW = sanitize_text_field($_POST['TotalSoft_Poll_1_VB_BW']); $TotalSoft_Poll_1_VB_BR = sanitize_text_field($_POST['TotalSoft_Poll_1_VB_BR']); $TotalSoft_Poll_1_VB_FS = sanitize_text_field($_POST['TotalSoft_Poll_1_VB_FS']); $TotalSoft_Poll_1_VB_FF = sanitize_text_field($_POST['TotalSoft_Poll_1_VB_FF']); $TotalSoft_Poll_1_VB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_1_VB_Text']))); $TotalSoft_Poll_1_VB_IA = sanitize_text_field($_POST['TotalSoft_Poll_1_VB_IA']); $TotalSoft_Poll_1_VB_IS = sanitize_text_field($_POST['TotalSoft_Poll_1_VB_IS']); $TotalSoft_Poll_1_RB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_1_RB_Pos']); $TotalSoft_Poll_1_RB_BW = sanitize_text_field($_POST['TotalSoft_Poll_1_RB_BW']); $TotalSoft_Poll_1_RB_BR = sanitize_text_field($_POST['TotalSoft_Poll_1_RB_BR']); $TotalSoft_Poll_1_RB_FS = sanitize_text_field($_POST['TotalSoft_Poll_1_RB_FS']); $TotalSoft_Poll_1_RB_FF = sanitize_text_field($_POST['TotalSoft_Poll_1_RB_FF']); $TotalSoft_Poll_1_RB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_1_RB_Text']))); $TotalSoft_Poll_1_RB_IA = sanitize_text_field($_POST['TotalSoft_Poll_1_RB_IA']); 
			$TotalSoft_Poll_1_RB_IS = sanitize_text_field($_POST['TotalSoft_Poll_1_RB_IS']); $TotalSoft_Poll_1_P_BW = sanitize_text_field($_POST['TotalSoft_Poll_1_P_BW']); $TotalSoft_Poll_1_P_LAQ_W = sanitize_text_field($_POST['TotalSoft_Poll_1_P_LAQ_W']); $TotalSoft_Poll_1_P_LAQ_H = sanitize_text_field($_POST['TotalSoft_Poll_1_P_LAQ_H']); $TotalSoft_Poll_1_P_LAQ_S = sanitize_text_field($_POST['TotalSoft_Poll_1_P_LAQ_S']); $TotalSoft_Poll_1_P_LAA_W = sanitize_text_field($_POST['TotalSoft_Poll_1_P_LAA_W']); $TotalSoft_Poll_1_P_LAA_H = sanitize_text_field($_POST['TotalSoft_Poll_1_P_LAA_H']); $TotalSoft_Poll_1_P_LAA_S = sanitize_text_field($_POST['TotalSoft_Poll_1_P_LAA_S']); $TotalSoft_Poll_1_P_BB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_1_P_BB_Pos']); $TotalSoft_Poll_1_P_BB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_1_P_BB_Text']))); $TotalSoft_Poll_1_P_BB_IA = sanitize_text_field($_POST['TotalSoft_Poll_1_P_BB_IA']);

			//Image/Video Poll
			$TotalSoft_Poll_2_MW = sanitize_text_field($_POST['TotalSoft_Poll_2_MW']); $TotalSoft_Poll_2_Pos = sanitize_text_field($_POST['TotalSoft_Poll_2_Pos']); $TotalSoft_Poll_2_BW = sanitize_text_field($_POST['TotalSoft_Poll_2_BW']); $TotalSoft_Poll_2_BR = sanitize_text_field($_POST['TotalSoft_Poll_2_BR']); $TotalSoft_Poll_2_BoxSh = sanitize_text_field($_POST['TotalSoft_Poll_2_BoxSh']); $TotalSoft_Poll_2_Q_FS = sanitize_text_field($_POST['TotalSoft_Poll_2_Q_FS']); $TotalSoft_Poll_2_Q_FF = sanitize_text_field($_POST['TotalSoft_Poll_2_Q_FF']); $TotalSoft_Poll_2_Q_TA = sanitize_text_field($_POST['TotalSoft_Poll_2_Q_TA']); $TotalSoft_Poll_2_LAQ_W = sanitize_text_field($_POST['TotalSoft_Poll_2_LAQ_W']); $TotalSoft_Poll_2_LAQ_H = sanitize_text_field($_POST['TotalSoft_Poll_2_LAQ_H']); $TotalSoft_Poll_2_LAQ_S = sanitize_text_field($_POST['TotalSoft_Poll_2_LAQ_S']); $TotalSoft_Poll_2_A_CC = sanitize_text_field($_POST['TotalSoft_Poll_2_A_CC']); $TotalSoft_Poll_2_A_FS = sanitize_text_field($_POST['TotalSoft_Poll_2_A_FS']); $TotalSoft_Poll_2_A_Pos = sanitize_text_field($_POST['TotalSoft_Poll_2_A_Pos']); $TotalSoft_Poll_2_CH_S = sanitize_text_field($_POST['TotalSoft_Poll_2_CH_S']); $TotalSoft_Poll_2_LAA_W = sanitize_text_field($_POST['TotalSoft_Poll_2_LAA_W']); $TotalSoft_Poll_2_LAA_H = sanitize_text_field($_POST['TotalSoft_Poll_2_LAA_H']); $TotalSoft_Poll_2_LAA_S = sanitize_text_field($_POST['TotalSoft_Poll_2_LAA_S']); $TotalSoft_Poll_2_VB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_2_VB_Pos']); $TotalSoft_Poll_2_VB_BW = sanitize_text_field($_POST['TotalSoft_Poll_2_VB_BW']); $TotalSoft_Poll_2_Play_IS = sanitize_text_field($_POST['TotalSoft_Poll_2_Play_IS']);
			$TotalSoft_Poll_2_VB_BR = sanitize_text_field($_POST['TotalSoft_Poll_2_VB_BR']); $TotalSoft_Poll_2_VB_FS = sanitize_text_field($_POST['TotalSoft_Poll_2_VB_FS']); $TotalSoft_Poll_2_VB_FF = sanitize_text_field($_POST['TotalSoft_Poll_2_VB_FF']); $TotalSoft_Poll_2_VB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_2_VB_Text']))); $TotalSoft_Poll_2_VB_IA = sanitize_text_field($_POST['TotalSoft_Poll_2_VB_IA']); $TotalSoft_Poll_2_VB_IS = sanitize_text_field($_POST['TotalSoft_Poll_2_VB_IS']); $TotalSoft_Poll_2_RB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_2_RB_Pos']); $TotalSoft_Poll_2_RB_BW = sanitize_text_field($_POST['TotalSoft_Poll_2_RB_BW']); $TotalSoft_Poll_2_RB_BR = sanitize_text_field($_POST['TotalSoft_Poll_2_RB_BR']); $TotalSoft_Poll_2_RB_FS = sanitize_text_field($_POST['TotalSoft_Poll_2_RB_FS']); $TotalSoft_Poll_2_RB_FF = sanitize_text_field($_POST['TotalSoft_Poll_2_RB_FF']); $TotalSoft_Poll_2_RB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_2_RB_Text']))); $TotalSoft_Poll_2_RB_IA = sanitize_text_field($_POST['TotalSoft_Poll_2_RB_IA']); $TotalSoft_Poll_2_RB_IS = sanitize_text_field($_POST['TotalSoft_Poll_2_RB_IS']); $TotalSoft_Poll_2_P_BB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_2_P_BB_Pos']); $TotalSoft_Poll_2_P_BB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_2_P_BB_Text']))); $TotalSoft_Poll_2_P_BB_IA = sanitize_text_field($_POST['TotalSoft_Poll_2_P_BB_IA']);
			$TotalSoft_Poll_2_A_IHT = sanitize_text_field($_POST['TotalSoft_Poll_2_A_IHT']);
			if($TotalSoft_Poll_2_A_IHT == 'fixed')
			{
				$TotalSoft_Poll_2_A_IH = sanitize_text_field($_POST['TotalSoft_Poll_2_A_IH']);
			}
			else
			{
				$TotalSoft_Poll_2_A_IH = sanitize_text_field($_POST['TotalSoft_Poll_2_A_IHR']);
			}

			//Standart Without Button
			$TotalSoft_Poll_3_MW = sanitize_text_field($_POST['TotalSoft_Poll_3_MW']); $TotalSoft_Poll_3_Pos = sanitize_text_field($_POST['TotalSoft_Poll_3_Pos']); $TotalSoft_Poll_3_BW = sanitize_text_field($_POST['TotalSoft_Poll_3_BW']); $TotalSoft_Poll_3_BR = sanitize_text_field($_POST['TotalSoft_Poll_3_BR']); $TotalSoft_Poll_3_BoxSh = sanitize_text_field($_POST['TotalSoft_Poll_3_BoxSh']); $TotalSoft_Poll_3_Q_FS = sanitize_text_field($_POST['TotalSoft_Poll_3_Q_FS']); $TotalSoft_Poll_3_Q_FF = sanitize_text_field($_POST['TotalSoft_Poll_3_Q_FF']); $TotalSoft_Poll_3_Q_TA = sanitize_text_field($_POST['TotalSoft_Poll_3_Q_TA']); $TotalSoft_Poll_3_LAQ_W = sanitize_text_field($_POST['TotalSoft_Poll_3_LAQ_W']); $TotalSoft_Poll_3_LAQ_H = sanitize_text_field($_POST['TotalSoft_Poll_3_LAQ_H']); $TotalSoft_Poll_3_LAQ_S = sanitize_text_field($_POST['TotalSoft_Poll_3_LAQ_S']); $TotalSoft_Poll_3_A_FS = sanitize_text_field($_POST['TotalSoft_Poll_3_A_FS']); $TotalSoft_Poll_3_A_BW = sanitize_text_field($_POST['TotalSoft_Poll_3_A_BW']); $TotalSoft_Poll_3_A_BR = sanitize_text_field($_POST['TotalSoft_Poll_3_A_BR']); $TotalSoft_Poll_3_CH_S = sanitize_text_field($_POST['TotalSoft_Poll_3_CH_S']); $TotalSoft_Poll_3_LAA_W = sanitize_text_field($_POST['TotalSoft_Poll_3_LAA_W']); $TotalSoft_Poll_3_LAA_H = sanitize_text_field($_POST['TotalSoft_Poll_3_LAA_H']); $TotalSoft_Poll_3_LAA_S = sanitize_text_field($_POST['TotalSoft_Poll_3_LAA_S']);
			$TotalSoft_Poll_3_TV_Pos = sanitize_text_field($_POST['TotalSoft_Poll_3_TV_Pos']); $TotalSoft_Poll_3_TV_FS = sanitize_text_field($_POST['TotalSoft_Poll_3_TV_FS']); $TotalSoft_Poll_3_TV_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_3_TV_Text']))); $TotalSoft_Poll_3_RB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_3_RB_Pos']); $TotalSoft_Poll_3_RB_BW = sanitize_text_field($_POST['TotalSoft_Poll_3_RB_BW']); $TotalSoft_Poll_3_RB_BR = sanitize_text_field($_POST['TotalSoft_Poll_3_RB_BR']); $TotalSoft_Poll_3_RB_FS = sanitize_text_field($_POST['TotalSoft_Poll_3_RB_FS']); $TotalSoft_Poll_3_RB_FF = sanitize_text_field($_POST['TotalSoft_Poll_3_RB_FF']); $TotalSoft_Poll_3_RB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_3_RB_Text']))); $TotalSoft_Poll_3_RB_IA = sanitize_text_field($_POST['TotalSoft_Poll_3_RB_IA']); $TotalSoft_Poll_3_RB_IS = sanitize_text_field($_POST['TotalSoft_Poll_3_RB_IS']); $TotalSoft_Poll_3_BB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_3_BB_Pos']); $TotalSoft_Poll_3_BB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_3_BB_Text']))); $TotalSoft_Poll_3_BB_IA = sanitize_text_field($_POST['TotalSoft_Poll_3_BB_IA']); $TotalSoft_Poll_3_VT_IA = sanitize_text_field($_POST['TotalSoft_Poll_3_VT_IA']);

			//Image/Video Without Button
			$TotalSoft_Poll_4_MW = sanitize_text_field($_POST['TotalSoft_Poll_4_MW']); $TotalSoft_Poll_4_Pos = sanitize_text_field($_POST['TotalSoft_Poll_4_Pos']); $TotalSoft_Poll_4_BW = sanitize_text_field($_POST['TotalSoft_Poll_4_BW']); $TotalSoft_Poll_4_BR = sanitize_text_field($_POST['TotalSoft_Poll_4_BR']); $TotalSoft_Poll_4_Q_FS = sanitize_text_field($_POST['TotalSoft_Poll_4_Q_FS']); $TotalSoft_Poll_4_Q_FF = sanitize_text_field($_POST['TotalSoft_Poll_4_Q_FF']); $TotalSoft_Poll_4_Q_TA = sanitize_text_field($_POST['TotalSoft_Poll_4_Q_TA']); $TotalSoft_Poll_4_LAQ_W = sanitize_text_field($_POST['TotalSoft_Poll_4_LAQ_W']); $TotalSoft_Poll_4_LAQ_H = sanitize_text_field($_POST['TotalSoft_Poll_4_LAQ_H']); $TotalSoft_Poll_4_LAQ_S = sanitize_text_field($_POST['TotalSoft_Poll_4_LAQ_S']); $TotalSoft_Poll_4_A_FS = sanitize_text_field($_POST['TotalSoft_Poll_4_A_FS']); $TotalSoft_Poll_4_A_BW = sanitize_text_field($_POST['TotalSoft_Poll_4_A_BW']); $TotalSoft_Poll_4_A_BR = sanitize_text_field($_POST['TotalSoft_Poll_4_A_BR']); $TotalSoft_Poll_4_A_FF = sanitize_text_field($_POST['TotalSoft_Poll_4_A_FF']); $TotalSoft_Poll_4_I_H = sanitize_text_field($_POST['TotalSoft_Poll_4_I_H']); $TotalSoft_Poll_4_I_Ra = sanitize_text_field($_POST['TotalSoft_Poll_4_I_Ra']); $TotalSoft_Poll_4_I_IS = sanitize_text_field($_POST['TotalSoft_Poll_4_I_IS']); $TotalSoft_Poll_4_Pop_BW = sanitize_text_field($_POST['TotalSoft_Poll_4_Pop_BW']); $TotalSoft_Poll_4_LAA_W = sanitize_text_field($_POST['TotalSoft_Poll_4_LAA_W']); $TotalSoft_Poll_4_LAA_H = sanitize_text_field($_POST['TotalSoft_Poll_4_LAA_H']); $TotalSoft_Poll_4_LAA_S = sanitize_text_field($_POST['TotalSoft_Poll_4_LAA_S']); $TotalSoft_Poll_4_TV_Pos = sanitize_text_field($_POST['TotalSoft_Poll_4_TV_Pos']);
			$TotalSoft_Poll_4_TV_FS = sanitize_text_field($_POST['TotalSoft_Poll_4_TV_FS']); $TotalSoft_Poll_4_TV_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_4_TV_Text']))); $TotalSoft_Poll_4_VT_IA = sanitize_text_field($_POST['TotalSoft_Poll_4_VT_IA']); $TotalSoft_Poll_4_RB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_4_RB_Pos']); $TotalSoft_Poll_4_RB_BW = sanitize_text_field($_POST['TotalSoft_Poll_4_RB_BW']); $TotalSoft_Poll_4_RB_BR = sanitize_text_field($_POST['TotalSoft_Poll_4_RB_BR']); $TotalSoft_Poll_4_RB_FS = sanitize_text_field($_POST['TotalSoft_Poll_4_RB_FS']); $TotalSoft_Poll_4_RB_FF = sanitize_text_field($_POST['TotalSoft_Poll_4_RB_FF']); $TotalSoft_Poll_4_RB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_4_RB_Text']))); $TotalSoft_Poll_4_RB_IA = sanitize_text_field($_POST['TotalSoft_Poll_4_RB_IA']); $TotalSoft_Poll_4_RB_IS = sanitize_text_field($_POST['TotalSoft_Poll_4_RB_IS']); $TotalSoft_Poll_4_BB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_4_BB_Pos']); $TotalSoft_Poll_4_BB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_4_BB_Text']))); $TotalSoft_Poll_4_BB_IA = sanitize_text_field($_POST['TotalSoft_Poll_4_BB_IA']);

			//Image/Video in Question
			$TotalSoft_Poll_5_MW = sanitize_text_field($_POST['TotalSoft_Poll_5_MW']); $TotalSoft_Poll_5_Pos = sanitize_text_field($_POST['TotalSoft_Poll_5_Pos']); $TotalSoft_Poll_5_BW = sanitize_text_field($_POST['TotalSoft_Poll_5_BW']); $TotalSoft_Poll_5_BR = sanitize_text_field($_POST['TotalSoft_Poll_5_BR']); $TotalSoft_Poll_5_BoxSh = sanitize_text_field($_POST['TotalSoft_Poll_5_BoxSh']); $TotalSoft_Poll_5_Q_FS = sanitize_text_field($_POST['TotalSoft_Poll_5_Q_FS']); $TotalSoft_Poll_5_Q_FF = sanitize_text_field($_POST['TotalSoft_Poll_5_Q_FF']); $TotalSoft_Poll_5_Q_TA = sanitize_text_field($_POST['TotalSoft_Poll_5_Q_TA']); $TotalSoft_Poll_5_I_H = sanitize_text_field($_POST['TotalSoft_Poll_5_I_H']); $TotalSoft_Poll_5_I_Ra = sanitize_text_field($_POST['TotalSoft_Poll_5_I_Ra']); $TotalSoft_Poll_5_V_W = sanitize_text_field($_POST['TotalSoft_Poll_5_V_W']); $TotalSoft_Poll_5_LAQ_W = sanitize_text_field($_POST['TotalSoft_Poll_5_LAQ_W']); $TotalSoft_Poll_5_LAQ_H = sanitize_text_field($_POST['TotalSoft_Poll_5_LAQ_H']); $TotalSoft_Poll_5_LAQ_S = sanitize_text_field($_POST['TotalSoft_Poll_5_LAQ_S']); $TotalSoft_Poll_5_A_FS = sanitize_text_field($_POST['TotalSoft_Poll_5_A_FS']); $TotalSoft_Poll_5_A_BW = sanitize_text_field($_POST['TotalSoft_Poll_5_A_BW']); $TotalSoft_Poll_5_A_BR = sanitize_text_field($_POST['TotalSoft_Poll_5_A_BR']); $TotalSoft_Poll_5_CH_S = sanitize_text_field($_POST['TotalSoft_Poll_5_CH_S']); $TotalSoft_Poll_5_LAA_W = sanitize_text_field($_POST['TotalSoft_Poll_5_LAA_W']); $TotalSoft_Poll_5_LAA_H = sanitize_text_field($_POST['TotalSoft_Poll_5_LAA_H']); $TotalSoft_Poll_5_LAA_S = sanitize_text_field($_POST['TotalSoft_Poll_5_LAA_S']); $TotalSoft_Poll_5_TV_Pos = sanitize_text_field($_POST['TotalSoft_Poll_5_TV_Pos']); $TotalSoft_Poll_5_TV_FS = sanitize_text_field($_POST['TotalSoft_Poll_5_TV_FS']); $TotalSoft_Poll_5_VT_IA = sanitize_text_field($_POST['TotalSoft_Poll_5_VT_IA']); $TotalSoft_Poll_5_VB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_5_VB_Pos']); $TotalSoft_Poll_5_VB_BW = sanitize_text_field($_POST['TotalSoft_Poll_5_VB_BW']); $TotalSoft_Poll_5_VB_BR = sanitize_text_field($_POST['TotalSoft_Poll_5_VB_BR']); $TotalSoft_Poll_5_VB_FS = sanitize_text_field($_POST['TotalSoft_Poll_5_VB_FS']); $TotalSoft_Poll_5_VB_FF = sanitize_text_field($_POST['TotalSoft_Poll_5_VB_FF']);
			$TotalSoft_Poll_5_VB_IA = sanitize_text_field($_POST['TotalSoft_Poll_5_VB_IA']); $TotalSoft_Poll_5_VB_IS = sanitize_text_field($_POST['TotalSoft_Poll_5_VB_IS']); $TotalSoft_Poll_5_RB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_5_RB_Pos']); $TotalSoft_Poll_5_RB_BW = sanitize_text_field($_POST['TotalSoft_Poll_5_RB_BW']); $TotalSoft_Poll_5_RB_BR = sanitize_text_field($_POST['TotalSoft_Poll_5_RB_BR']); $TotalSoft_Poll_5_RB_FS = sanitize_text_field($_POST['TotalSoft_Poll_5_RB_FS']); $TotalSoft_Poll_5_RB_FF = sanitize_text_field($_POST['TotalSoft_Poll_5_RB_FF']); $TotalSoft_Poll_5_RB_IA = sanitize_text_field($_POST['TotalSoft_Poll_5_RB_IA']); $TotalSoft_Poll_5_RB_IS = sanitize_text_field($_POST['TotalSoft_Poll_5_RB_IS']); $TotalSoft_Poll_5_BB_Pos = sanitize_text_field($_POST['TotalSoft_Poll_5_BB_Pos']); $TotalSoft_Poll_5_BB_IA = sanitize_text_field($_POST['TotalSoft_Poll_5_BB_IA']); $TotalSoft_Poll_5_TV_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_5_TV_Text']))); $TotalSoft_Poll_5_BB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_5_BB_Text']))); $TotalSoft_Poll_5_RB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_5_RB_Text']))); $TotalSoft_Poll_5_VB_Text = str_replace("\&","&", sanitize_text_field(esc_html($_POST['TotalSoft_Poll_5_VB_Text'])));

			if(isset($_POST['Total_Soft_Poll_TUpdate']))
			{
				$Total_SoftPoll_TUpdateID = sanitize_text_field($_POST['Total_SoftPoll_TUpdateID']);

				$wpdb->query($wpdb->prepare("UPDATE $table_name4 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s WHERE id = %d", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $Total_SoftPoll_TUpdateID));

				if($TotalSoft_Poll_TType == 'Standart Poll')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name5 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s, TotalSoft_Poll_1_MW = %s, TotalSoft_Poll_1_Pos = %s, TotalSoft_Poll_1_BW = %s, TotalSoft_Poll_1_BR = %s, TotalSoft_Poll_1_BoxSh = %s, TotalSoft_Poll_1_Q_FS = %s, TotalSoft_Poll_1_Q_FF = %s, TotalSoft_Poll_1_Q_TA = %s, TotalSoft_Poll_1_LAQ_W = %s, TotalSoft_Poll_1_LAQ_H = %s, TotalSoft_Poll_1_LAQ_S = %s, TotalSoft_Poll_1_A_FS = %s, TotalSoft_Poll_1_CH_S = %s, TotalSoft_Poll_1_LAA_W = %s, TotalSoft_Poll_1_LAA_H = %s, TotalSoft_Poll_1_LAA_S = %s, TotalSoft_Poll_1_VB_Pos = %s, TotalSoft_Poll_1_VB_BW = %s, TotalSoft_Poll_1_VB_BR = %s, TotalSoft_Poll_1_VB_FS = %s, TotalSoft_Poll_1_VB_FF = %s, TotalSoft_Poll_1_VB_Text = %s, TotalSoft_Poll_1_VB_IA = %s, TotalSoft_Poll_1_VB_IS = %s, TotalSoft_Poll_1_RB_Pos = %s, TotalSoft_Poll_1_RB_BW = %s, TotalSoft_Poll_1_RB_BR = %s, TotalSoft_Poll_1_RB_FS = %s, TotalSoft_Poll_1_RB_FF = %s, TotalSoft_Poll_1_RB_Text = %s, TotalSoft_Poll_1_RB_IA = %s WHERE TotalSoft_Poll_TID = %s", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $TotalSoft_Poll_1_MW, $TotalSoft_Poll_1_Pos, $TotalSoft_Poll_1_BW, $TotalSoft_Poll_1_BR, $TotalSoft_Poll_1_BoxSh, $TotalSoft_Poll_1_Q_FS, $TotalSoft_Poll_1_Q_FF, $TotalSoft_Poll_1_Q_TA, $TotalSoft_Poll_1_LAQ_W, $TotalSoft_Poll_1_LAQ_H, $TotalSoft_Poll_1_LAQ_S, $TotalSoft_Poll_1_A_FS, $TotalSoft_Poll_1_CH_S, $TotalSoft_Poll_1_LAA_W, $TotalSoft_Poll_1_LAA_H, $TotalSoft_Poll_1_LAA_S, $TotalSoft_Poll_1_VB_Pos, $TotalSoft_Poll_1_VB_BW, $TotalSoft_Poll_1_VB_BR, $TotalSoft_Poll_1_VB_FS, $TotalSoft_Poll_1_VB_FF, $TotalSoft_Poll_1_VB_Text, $TotalSoft_Poll_1_VB_IA, $TotalSoft_Poll_1_VB_IS, $TotalSoft_Poll_1_RB_Pos, $TotalSoft_Poll_1_RB_BW, $TotalSoft_Poll_1_RB_BR, $TotalSoft_Poll_1_RB_FS, $TotalSoft_Poll_1_RB_FF, $TotalSoft_Poll_1_RB_Text, $TotalSoft_Poll_1_RB_IA, $Total_SoftPoll_TUpdateID));
					$wpdb->query($wpdb->prepare("UPDATE $table_name8 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s, TotalSoft_Poll_1_RB_IS = %s, TotalSoft_Poll_1_P_BW = %s, TotalSoft_Poll_1_P_LAQ_W = %s, TotalSoft_Poll_1_P_LAQ_H = %s, TotalSoft_Poll_1_P_LAQ_S = %s, TotalSoft_Poll_1_P_LAA_W = %s, TotalSoft_Poll_1_P_LAA_H = %s, TotalSoft_Poll_1_P_LAA_S = %s, TotalSoft_Poll_1_P_BB_Pos = %s, TotalSoft_Poll_1_P_BB_Text = %s, TotalSoft_Poll_1_P_BB_IA = %s WHERE TotalSoft_Poll_TID = %s", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $TotalSoft_Poll_1_RB_IS, $TotalSoft_Poll_1_P_BW, $TotalSoft_Poll_1_P_LAQ_W, $TotalSoft_Poll_1_P_LAQ_H, $TotalSoft_Poll_1_P_LAQ_S, $TotalSoft_Poll_1_P_LAA_W, $TotalSoft_Poll_1_P_LAA_H, $TotalSoft_Poll_1_P_LAA_S, $TotalSoft_Poll_1_P_BB_Pos, $TotalSoft_Poll_1_P_BB_Text, $TotalSoft_Poll_1_P_BB_IA, $Total_SoftPoll_TUpdateID));
				}
				else if($TotalSoft_Poll_TType == 'Image Poll' || $TotalSoft_Poll_TType == 'Video Poll')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name9 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s, TotalSoft_Poll_2_MW = %s, TotalSoft_Poll_2_Pos = %s, TotalSoft_Poll_2_BW = %s, TotalSoft_Poll_2_BR = %s, TotalSoft_Poll_2_BoxSh = %s, TotalSoft_Poll_2_Q_FS = %s, TotalSoft_Poll_2_Q_FF = %s, TotalSoft_Poll_2_Q_TA = %s, TotalSoft_Poll_2_LAQ_W = %s, TotalSoft_Poll_2_LAQ_H = %s, TotalSoft_Poll_2_LAQ_S = %s, TotalSoft_Poll_2_A_CC = %s, TotalSoft_Poll_2_A_IH = %s, TotalSoft_Poll_2_A_FS = %s, TotalSoft_Poll_2_A_Pos = %s, TotalSoft_Poll_2_CH_S = %s, TotalSoft_Poll_2_LAA_W = %s, TotalSoft_Poll_2_LAA_H = %s, TotalSoft_Poll_2_LAA_S = %s, TotalSoft_Poll_2_VB_Pos = %s, TotalSoft_Poll_2_VB_BW = %s, TotalSoft_Poll_2_Play_IS = %s WHERE TotalSoft_Poll_TID = %s", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $TotalSoft_Poll_2_MW, $TotalSoft_Poll_2_Pos, $TotalSoft_Poll_2_BW, $TotalSoft_Poll_2_BR, $TotalSoft_Poll_2_BoxSh, $TotalSoft_Poll_2_Q_FS, $TotalSoft_Poll_2_Q_FF, $TotalSoft_Poll_2_Q_TA, $TotalSoft_Poll_2_LAQ_W, $TotalSoft_Poll_2_LAQ_H, $TotalSoft_Poll_2_LAQ_S, $TotalSoft_Poll_2_A_CC, $TotalSoft_Poll_2_A_IH, $TotalSoft_Poll_2_A_FS, $TotalSoft_Poll_2_A_Pos, $TotalSoft_Poll_2_CH_S, $TotalSoft_Poll_2_LAA_W, $TotalSoft_Poll_2_LAA_H, $TotalSoft_Poll_2_LAA_S, $TotalSoft_Poll_2_VB_Pos, $TotalSoft_Poll_2_VB_BW, $TotalSoft_Poll_2_Play_IS, $Total_SoftPoll_TUpdateID));
					$wpdb->query($wpdb->prepare("UPDATE $table_name10 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s, TotalSoft_Poll_2_VB_BR = %s, TotalSoft_Poll_2_VB_FS = %s, TotalSoft_Poll_2_VB_FF = %s, TotalSoft_Poll_2_VB_Text = %s, TotalSoft_Poll_2_VB_IA = %s, TotalSoft_Poll_2_VB_IS = %s, TotalSoft_Poll_2_RB_Pos = %s, TotalSoft_Poll_2_RB_BW = %s, TotalSoft_Poll_2_RB_BR = %s, TotalSoft_Poll_2_RB_FS = %s, TotalSoft_Poll_2_RB_FF = %s, TotalSoft_Poll_2_RB_Text = %s, TotalSoft_Poll_2_RB_IA = %s, TotalSoft_Poll_2_RB_IS = %s, TotalSoft_Poll_2_P_BB_Pos = %s, TotalSoft_Poll_2_P_BB_Text = %s, TotalSoft_Poll_2_P_BB_IA = %s WHERE TotalSoft_Poll_TID = %s", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $TotalSoft_Poll_2_VB_BR, $TotalSoft_Poll_2_VB_FS, $TotalSoft_Poll_2_VB_FF, $TotalSoft_Poll_2_VB_Text, $TotalSoft_Poll_2_VB_IA, $TotalSoft_Poll_2_VB_IS, $TotalSoft_Poll_2_RB_Pos, $TotalSoft_Poll_2_RB_BW, $TotalSoft_Poll_2_RB_BR, $TotalSoft_Poll_2_RB_FS, $TotalSoft_Poll_2_RB_FF, $TotalSoft_Poll_2_RB_Text, $TotalSoft_Poll_2_RB_IA, $TotalSoft_Poll_2_RB_IS, $TotalSoft_Poll_2_P_BB_Pos, $TotalSoft_Poll_2_P_BB_Text, $TotalSoft_Poll_2_P_BB_IA, $Total_SoftPoll_TUpdateID));
				}
				else if($TotalSoft_Poll_TType == 'Standart Without Button')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name11 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s, TotalSoft_Poll_3_MW = %s, TotalSoft_Poll_3_Pos = %s, TotalSoft_Poll_3_BW = %s, TotalSoft_Poll_3_BR = %s, TotalSoft_Poll_3_BoxSh = %s, TotalSoft_Poll_3_Q_FS = %s, TotalSoft_Poll_3_Q_FF = %s, TotalSoft_Poll_3_Q_TA = %s, TotalSoft_Poll_3_LAQ_W = %s, TotalSoft_Poll_3_LAQ_H = %s, TotalSoft_Poll_3_LAQ_S = %s, TotalSoft_Poll_3_A_FS = %s, TotalSoft_Poll_3_A_BW = %s, TotalSoft_Poll_3_A_BR = %s, TotalSoft_Poll_3_CH_S = %s, TotalSoft_Poll_3_LAA_W = %s, TotalSoft_Poll_3_LAA_H = %s, TotalSoft_Poll_3_LAA_S = %s WHERE TotalSoft_Poll_TID = %s", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $TotalSoft_Poll_3_MW, $TotalSoft_Poll_3_Pos, $TotalSoft_Poll_3_BW, $TotalSoft_Poll_3_BR, $TotalSoft_Poll_3_BoxSh, $TotalSoft_Poll_3_Q_FS, $TotalSoft_Poll_3_Q_FF, $TotalSoft_Poll_3_Q_TA, $TotalSoft_Poll_3_LAQ_W, $TotalSoft_Poll_3_LAQ_H, $TotalSoft_Poll_3_LAQ_S, $TotalSoft_Poll_3_A_FS, $TotalSoft_Poll_3_A_BW, $TotalSoft_Poll_3_A_BR, $TotalSoft_Poll_3_CH_S, $TotalSoft_Poll_3_LAA_W, $TotalSoft_Poll_3_LAA_H, $TotalSoft_Poll_3_LAA_S, $Total_SoftPoll_TUpdateID));
					$wpdb->query($wpdb->prepare("UPDATE $table_name12 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s, TotalSoft_Poll_3_TV_Pos = %s, TotalSoft_Poll_3_TV_FS = %s, TotalSoft_Poll_3_TV_Text = %s, TotalSoft_Poll_3_RB_Pos = %s, TotalSoft_Poll_3_RB_BW = %s, TotalSoft_Poll_3_RB_BR = %s, TotalSoft_Poll_3_RB_FS = %s, TotalSoft_Poll_3_RB_FF = %s, TotalSoft_Poll_3_RB_Text = %s, TotalSoft_Poll_3_RB_IA = %s, TotalSoft_Poll_3_RB_IS = %s, TotalSoft_Poll_3_BB_Pos = %s, TotalSoft_Poll_3_BB_Text = %s, TotalSoft_Poll_3_BB_IA = %s, TotalSoft_Poll_3_VT_IA = %s WHERE TotalSoft_Poll_TID = %s", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $TotalSoft_Poll_3_TV_Pos, $TotalSoft_Poll_3_TV_FS, $TotalSoft_Poll_3_TV_Text, $TotalSoft_Poll_3_RB_Pos, $TotalSoft_Poll_3_RB_BW, $TotalSoft_Poll_3_RB_BR, $TotalSoft_Poll_3_RB_FS, $TotalSoft_Poll_3_RB_FF, $TotalSoft_Poll_3_RB_Text, $TotalSoft_Poll_3_RB_IA, $TotalSoft_Poll_3_RB_IS, $TotalSoft_Poll_3_BB_Pos, $TotalSoft_Poll_3_BB_Text, $TotalSoft_Poll_3_BB_IA, $TotalSoft_Poll_3_VT_IA, $Total_SoftPoll_TUpdateID));
				}
				else if($TotalSoft_Poll_TType == 'Image Without Button' || $TotalSoft_Poll_TType == 'Video Without Button')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name13 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s, TotalSoft_Poll_4_MW = %s, TotalSoft_Poll_4_Pos = %s, TotalSoft_Poll_4_BW = %s, TotalSoft_Poll_4_BR = %s, TotalSoft_Poll_4_Q_FS = %s, TotalSoft_Poll_4_Q_FF = %s, TotalSoft_Poll_4_Q_TA = %s, TotalSoft_Poll_4_LAQ_W = %s, TotalSoft_Poll_4_LAQ_H = %s, TotalSoft_Poll_4_LAQ_S = %s, TotalSoft_Poll_4_A_FS = %s, TotalSoft_Poll_4_A_BW = %s, TotalSoft_Poll_4_A_BR = %s, TotalSoft_Poll_4_A_FF = %s, TotalSoft_Poll_4_I_H = %s, TotalSoft_Poll_4_I_Ra = %s, TotalSoft_Poll_4_I_IS = %s, TotalSoft_Poll_4_Pop_BW = %s, TotalSoft_Poll_4_LAA_W = %s, TotalSoft_Poll_4_LAA_H = %s, TotalSoft_Poll_4_LAA_S = %s, TotalSoft_Poll_4_TV_Pos = %s WHERE TotalSoft_Poll_TID = %s", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $TotalSoft_Poll_4_MW, $TotalSoft_Poll_4_Pos, $TotalSoft_Poll_4_BW, $TotalSoft_Poll_4_BR, $TotalSoft_Poll_4_Q_FS, $TotalSoft_Poll_4_Q_FF, $TotalSoft_Poll_4_Q_TA, $TotalSoft_Poll_4_LAQ_W, $TotalSoft_Poll_4_LAQ_H, $TotalSoft_Poll_4_LAQ_S, $TotalSoft_Poll_4_A_FS, $TotalSoft_Poll_4_A_BW, $TotalSoft_Poll_4_A_BR, $TotalSoft_Poll_4_A_FF, $TotalSoft_Poll_4_I_H, $TotalSoft_Poll_4_I_Ra, $TotalSoft_Poll_4_I_IS, $TotalSoft_Poll_4_Pop_BW, $TotalSoft_Poll_4_LAA_W, $TotalSoft_Poll_4_LAA_H, $TotalSoft_Poll_4_LAA_S, $TotalSoft_Poll_4_TV_Pos, $Total_SoftPoll_TUpdateID));
					$wpdb->query($wpdb->prepare("UPDATE $table_name14 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s, TotalSoft_Poll_4_TV_FS = %s, TotalSoft_Poll_4_TV_Text = %s, TotalSoft_Poll_4_VT_IA = %s, TotalSoft_Poll_4_RB_Pos = %s, TotalSoft_Poll_4_RB_BW = %s, TotalSoft_Poll_4_RB_BR = %s, TotalSoft_Poll_4_RB_FS = %s, TotalSoft_Poll_4_RB_FF = %s, TotalSoft_Poll_4_RB_Text = %s, TotalSoft_Poll_4_RB_IA = %s, TotalSoft_Poll_4_RB_IS = %s, TotalSoft_Poll_4_BB_Pos = %s, TotalSoft_Poll_4_BB_Text = %s, TotalSoft_Poll_4_BB_IA = %s WHERE TotalSoft_Poll_TID = %s", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $TotalSoft_Poll_4_TV_FS, $TotalSoft_Poll_4_TV_Text, $TotalSoft_Poll_4_VT_IA, $TotalSoft_Poll_4_RB_Pos, $TotalSoft_Poll_4_RB_BW, $TotalSoft_Poll_4_RB_BR, $TotalSoft_Poll_4_RB_FS, $TotalSoft_Poll_4_RB_FF, $TotalSoft_Poll_4_RB_Text, $TotalSoft_Poll_4_RB_IA, $TotalSoft_Poll_4_RB_IS, $TotalSoft_Poll_4_BB_Pos, $TotalSoft_Poll_4_BB_Text, $TotalSoft_Poll_4_BB_IA, $Total_SoftPoll_TUpdateID));
				}
				else if($TotalSoft_Poll_TType == 'Image in Question' || $TotalSoft_Poll_TType == 'Video in Question')
				{
					$wpdb->query($wpdb->prepare("UPDATE $table_name16 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s, TotalSoft_Poll_5_MW = %s, TotalSoft_Poll_5_Pos = %s, TotalSoft_Poll_5_BW = %s, TotalSoft_Poll_5_BR = %s, TotalSoft_Poll_5_BoxSh = %s, TotalSoft_Poll_5_Q_FS = %s, TotalSoft_Poll_5_Q_FF = %s, TotalSoft_Poll_5_Q_TA = %s, TotalSoft_Poll_5_I_H = %s, TotalSoft_Poll_5_I_Ra = %s, TotalSoft_Poll_5_V_W = %s, TotalSoft_Poll_5_LAQ_W = %s, TotalSoft_Poll_5_LAQ_H = %s, TotalSoft_Poll_5_LAQ_S = %s, TotalSoft_Poll_5_A_FS = %s, TotalSoft_Poll_5_A_BW = %s, TotalSoft_Poll_5_A_BR = %s, TotalSoft_Poll_5_CH_S = %s, TotalSoft_Poll_5_LAA_W = %s, TotalSoft_Poll_5_LAA_H = %s, TotalSoft_Poll_5_LAA_S = %s, TotalSoft_Poll_5_TV_Pos = %s, TotalSoft_Poll_5_TV_FS = %s, TotalSoft_Poll_5_VT_IA = %s, TotalSoft_Poll_5_VB_Pos = %s, TotalSoft_Poll_5_VB_BW = %s, TotalSoft_Poll_5_VB_BR = %s, TotalSoft_Poll_5_VB_FS = %s, TotalSoft_Poll_5_VB_FF = %s WHERE TotalSoft_Poll_TID = %s", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $TotalSoft_Poll_5_MW, $TotalSoft_Poll_5_Pos, $TotalSoft_Poll_5_BW, $TotalSoft_Poll_5_BR, $TotalSoft_Poll_5_BoxSh, $TotalSoft_Poll_5_Q_FS, $TotalSoft_Poll_5_Q_FF, $TotalSoft_Poll_5_Q_TA, $TotalSoft_Poll_5_I_H, $TotalSoft_Poll_5_I_Ra, $TotalSoft_Poll_5_V_W, $TotalSoft_Poll_5_LAQ_W, $TotalSoft_Poll_5_LAQ_H, $TotalSoft_Poll_5_LAQ_S, $TotalSoft_Poll_5_A_FS, $TotalSoft_Poll_5_A_BW, $TotalSoft_Poll_5_A_BR, $TotalSoft_Poll_5_CH_S, $TotalSoft_Poll_5_LAA_W, $TotalSoft_Poll_5_LAA_H, $TotalSoft_Poll_5_LAA_S, $TotalSoft_Poll_5_TV_Pos, $TotalSoft_Poll_5_TV_FS, $TotalSoft_Poll_5_VT_IA, $TotalSoft_Poll_5_VB_Pos, $TotalSoft_Poll_5_VB_BW, $TotalSoft_Poll_5_VB_BR, $TotalSoft_Poll_5_VB_FS, $TotalSoft_Poll_5_VB_FF, $Total_SoftPoll_TUpdateID));
					$wpdb->query($wpdb->prepare("UPDATE $table_name17 set TotalSoft_Poll_TTitle = %s, TotalSoft_Poll_TType = %s, TotalSoft_Poll_5_VB_IA = %s, TotalSoft_Poll_5_VB_IS = %s, TotalSoft_Poll_5_RB_Pos = %s, TotalSoft_Poll_5_RB_BW = %s, TotalSoft_Poll_5_RB_BR = %s, TotalSoft_Poll_5_RB_FS = %s, TotalSoft_Poll_5_RB_FF = %s, TotalSoft_Poll_5_RB_IA = %s, TotalSoft_Poll_5_RB_IS = %s, TotalSoft_Poll_5_BB_Pos = %s, TotalSoft_Poll_5_BB_IA = %s, TotalSoft_Poll_5_TV_Text = %s, TotalSoft_Poll_5_BB_Text = %s, TotalSoft_Poll_5_RB_Text = %s, TotalSoft_Poll_5_VB_Text = %s WHERE TotalSoft_Poll_TID = %s", $TotalSoft_Poll_TTitle, $TotalSoft_Poll_TType, $TotalSoft_Poll_5_VB_IA, $TotalSoft_Poll_5_VB_IS, $TotalSoft_Poll_5_RB_Pos, $TotalSoft_Poll_5_RB_BW, $TotalSoft_Poll_5_RB_BR, $TotalSoft_Poll_5_RB_FS, $TotalSoft_Poll_5_RB_FF, $TotalSoft_Poll_5_RB_IA, $TotalSoft_Poll_5_RB_IS, $TotalSoft_Poll_5_BB_Pos, $TotalSoft_Poll_5_BB_IA, $TotalSoft_Poll_5_TV_Text, $TotalSoft_Poll_5_BB_Text, $TotalSoft_Poll_5_RB_Text, $TotalSoft_Poll_5_VB_Text, $Total_SoftPoll_TUpdateID));
				}
			}
		}
		else
		{
			wp_die('Security check fail'); 
		}
	}

	$TotalSoftPollThemes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id>%d order by id", 0));

	$TotalSoftFontCount = array("Abadi MT Condensed Light", "ABeeZee", "Abel", "Abhaya Libre", "Abril Fatface", "Aclonica", "Acme", "Actor", "Adamina", "Advent Pro", "Aguafina Script", "Aharoni", "Akronim", "Aladin", "Aldhabi", "Aldrich", "Alef", "Alegreya", "Alegreya Sans", "Alegreya Sans SC", "Alegreya SC", "Alex Brush", "Alfa Slab One", "Alice", "Alike", "Alike Angular", "Allan", "Allerta", "Allerta Stencil", "Allura", "Almendra", "Almendra Display", "Almendra SC", "Amarante", "Amaranth", "Amatic SC", "Amethysta", "Amiko", "Amiri", "Amita", "Anaheim", "Andada", "Andalus", "Andika", "Angkor", "Angsana New", "AngsanaUPC", "Annie Use Your Telescope", "Anonymous Pro", "Antic", "Antic Didone", "Antic Slab", "Anton", "Aparajita", "Arabic Typesetting", "Arapey", "Arbutus", "Arbutus Slab", "Architects Daughter", "Archivo", "Archivo Black", "Archivo Narrow", "Aref Ruqaa", "Arial", "Arial Black", "Arimo", "Arima Madurai", "Arizonia", "Armata", "Arsenal", "Artifika", "Arvo", "Arya", "Asap", "Asap Condensed", "Asar", "Asset", "Assistant", "Astloch", "Asul", "Athiti", "Atma", "Atomic Age", "Aubrey", "Audiowide", "Autour One", "Average", "Average Sans", "Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre", "Averia Serif Libre", "Bad Script", "Bahiana", "Baloo", "Balthazar", "Bangers", "Barlow", "Barlow Condensed", "Barlow Semi Condensed", "Barrio", "Basic", "Batang", "BatangChe", "Battambang", "Baumans", "Bayon", "Belgrano", "Bellefair", "Belleza", "BenchNine", "Bentham", "Berkshire Swash", "Bevan", "Bigelow Rules", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "BioRhyme", "BioRhyme Expanded", "Biryani", "Bitter", "Black And White Picture", "Black Han Sans", "Black Ops One", "Bokor", "Bonbon", "Boogaloo", "Bowlby One", "Bowlby One SC", "Brawler", "Bree Serif", "Browallia New", "BrowalliaUPC", "Bubbler One", "Bubblegum Sans", "Buda", "Buenard", "Bungee", "Bungee Hairline", "Bungee Inline", "Bungee Outline", "Bungee Shade", "Butcherman", "Butterfly Kids", "Cabin", "Cabin Condensed", "Cabin Sketch", "Caesar Dressing", "Cagliostro", "Cairo", "Calibri", "Calibri Light", "Calisto MT", "Calligraffitti", "Cambay", "Cambo", "Cambria", "Candal", "Candara", "Cantarell", "Cantata One", "Cantora One", "Capriola", "Cardo", "Carme", "Carrois Gothic", "Carrois Gothic SC", "Carter One", "Catamaran", "Caudex", "Caveat", "Caveat Brush", "Cedarville Cursive", "Century Gothic", "Ceviche One", "Changa", "Changa One", "Chango", "Chathura", "Chau Philomene One", "Chela One", "Chelsea Market", "Chenla", "Cherry Cream Soda", "Cherry Swash", "Chewy", "Chicle", "Chivo", "Chonburi", "Cinzel", "Cinzel Decorative", "Clicker Script", "Coda", "Coda Caption", "Codystar", "Coiny", "Combo", "Comic Sans MS", "Coming Soon", "Comfortaa", "Concert One", "Condiment", "Consolas", "Constantia", "Content", "Contrail One", "Convergence", "Cookie", "Copperplate Gothic", "Copperplate Gothic Light", "Copse", "Corbel", "Corben", "Cordia New", "CordiaUPC", "Cormorant", "Cormorant Garamond", "Cormorant Infant", "Cormorant SC", "Cormorant Unicase", "Cormorant Upright", "Courgette", "Courier New", "Cousine", "Coustard", "Covered By Your Grace", "Crafty Girls", "Creepster", "Crete Round", "Crimson Text", "Croissant One", "Crushed", "Cuprum", "Cute Font", "Cutive", "Cutive Mono", "Damion", "Dancing Script", "Dangrek", "DaunPenh", "David", "David Libre", "Dawning of a New Day", "Days One", "Delius", "Delius Swash Caps", "Delius Unicase", "Della Respira", "Denk One", "Devonshire", "DFKai-SB", "Dhurjati", "Didact Gothic", "DilleniaUPC", "Diplomata", "Diplomata SC", "Do Hyeon", "DokChampa", "Dokdo", "Domine", "Donegal One", "Doppio One", "Dorsa", "Dosis", "Dotum", "DotumChe", "Dr Sugiyama", "Duru Sans", "Dynalight", "Eagle Lake", "East Sea Dokdo", "Eater", "EB Garamond", "Ebrima", "Economica", "Eczar", "El Messiri", "Electrolize", "Elsie", "Elsie Swash Caps", "Emblema One", "Emilys Candy", "Encode Sans", "Encode Sans Condensed", "Encode Sans Expanded", "Encode Sans Semi Condensed", "Encode Sans Semi Expanded", "Engagement", "Englebert", "Enriqueta", "Erica One", "Esteban", "Estrangelo Edessa", "EucrosiaUPC", "Euphemia", "Euphoria Script", "Ewert", "Exo", "Expletus Sans", "FangSong", "Fanwood Text", "Farsan", "Fascinate", "Fascinate Inline", "Faster One", "Fasthand", "Fauna One", "Faustina", "Federant", "Federo", "Felipa", "Fenix", "Finger Paint", "Fira Mono", "Fira Sans", "Fira Sans Condensed", "Fira Sans Extra Condensed", "Fjalla One", "Fjord One", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky", "Forum", "Francois One", "Frank Ruhl Libre", "Franklin Gothic Medium", "FrankRuehl", "Freckle Face", "Fredericka the Great", "Fredoka One", "Freehand", "FreesiaUPC", "Fresca", "Frijole", "Fruktur", "Fugaz One", "Gabriela", "Gabriola", "Gadugi", "Gaegu", "Gafata", "Galada", "Galdeano", "Galindo", "Gamja Flower", "Gautami", "Gentium Basic", "Gentium Book Basic", "Geo", "Georgia", "Geostar", "Geostar Fill", "Germania One", "GFS Didot", "GFS Neohellenic", "Gidugu", "Gilda Display", "Gisha", "Give You Glory", "Glass Antiqua", "Glegoo", "Gloria Hallelujah", "Goblin One", "Gochi Hand", "Gorditas", "Gothic A1", "Graduate", "Grand Hotel", "Gravitas One", "Great Vibes", "Griffy", "Gruppo", "Gudea", "Gugi", "Gulim", "GulimChe", "Gungsuh", "GungsuhChe", "Gurajada", "Habibi", "Halant", "Hammersmith One", "Hanalei", "Hanalei Fill", "Handlee", "Hanuman", "Happy Monkey", "Harmattan", "Headland One", "Heebo", "Henny Penny", "Herr Von Muellerhoff", "Hi Melody", "Hind", "Holtwood One SC", "Homemade Apple", "Homenaje", "IBM Plex Mono", "IBM Plex Sans", "IBM Plex Sans Condensed", "IBM Plex Serif", "Iceberg", "Iceland", "IM Fell Double Pica", "IM Fell Double Pica SC", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer", "IM Fell Great Primer SC", "Impact", "Imprima", "Inconsolata", "Inder", "Indie Flower", "Inika", "Irish Grover", "IrisUPC", "Istok Web", "Iskoola Pota", "Italiana", "Italianno", "Itim", "Jacques Francois", "Jacques Francois Shadow", "Jaldi", "JasmineUPC", "Jim Nightshade", "Jockey One", "Jolly Lodger", "Jomhuria", "Josefin Sans", "Josefin Slab", "Joti One", "Jua", "Judson", "Julee", "Julius Sans One", "Junge", "Jura", "Just Another Hand", "Just Me Again Down Here", "Kadwa", "KaiTi", "Kalam", "Kalinga", "Kameron", "Kanit", "Kantumruy", "Karla", "Karma", "Kartika", "Katibeh", "Kaushan Script", "Kavivanar", "Kavoon", "Kdam Thmor", "Keania One", "Kelly Slab", "Kenia", "Khand", "Khmer", "Khmer UI", "Khula", "Kirang Haerang", "Kite One", "Knewave", "KodchiangUPC", "Kokila", "Kotta One", "Koulen", "Kranky", "Kreon", "Kristi", "Krona One", "Kurale", "La Belle Aurore", "Laila", "Lakki Reddy", "Lalezar", "Lancelot", "Lao UI", "Lateef", "Latha", "Lato", "League Script", "Leckerli One", "Ledger", "Leelawadee", "Lekton", "Lemon", "Lemonada", "Levenim MT", "Libre Baskerville", "Libre Franklin", "Life Savers", "Lilita One", "Lily Script One", "LilyUPC", "Limelight", "Linden Hill", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow", "Londrina Sketch", "Londrina Solid", "Lora", "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel", "Lucida Console", "Lucida Handwriting Italic", "Lucida Sans Unicode", "Luckiest Guy", "Lusitana", "Lustria", "Macondo", "Macondo Swash Caps", "Mada", "Magra", "Maiden Orange", "Maitree", "Mako", "Malgun Gothic", "Mallanna", "Mandali", "Mangal", "Manny ITC", "Manuale", "Marcellus", "Marcellus SC", "Marck Script", "Margarine", "Marko One", "Marlett", "Marmelad", "Martel", "Martel Sans", "Marvel", "Mate", "Mate SC", "Maven Pro", "McLaren", "Meddon", "MedievalSharp", "Medula One", "Meera Inimai", "Megrim", "Meie Script", "Meiryo", "Meiryo UI", "Merienda", "Merienda One", "Merriweather", "Merriweather Sans", "Metal", "Metal Mania", "Metamorphous", "Metrophobic", "Michroma", "Microsoft Himalaya", "Microsoft JhengHei", "Microsoft JhengHei UI", "Microsoft New Tai Lue", "Microsoft PhagsPa", "Microsoft Sans Serif", "Microsoft Tai Le", "Microsoft Uighur", "Microsoft YaHei", "Microsoft YaHei UI", "Microsoft Yi Baiti", "Milonga", "Miltonian", "Miltonian Tattoo", "Mina", "MingLiU_HKSCS", "MingLiU_HKSCS-ExtB", "Miniver", "Miriam", "Miriam Libre", "Mirza", "Miss Fajardose", "Mitr", "Modak", "Modern Antiqua", "Mogra", "Molengo", "Molle", "Monda", "Mongolian Baiti", "Monofett", "Monoton", "Monsieur La Doulaise", "Montaga", "Montez", "Montserrat", "Montserrat Alternates", "Montserrat Subrayada", "MoolBoran", "Moul", "Moulpali", "Mountains of Christmas", "Mouse Memoirs", "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards", "MS UI Gothic", "Mukta", "Muli", "MV Boli", "Myanmar Text", "Mystery Quest", "Nanum Brush Script", "Nanum Gothic", "Nanum Gothic Coding", "Nanum Myeongjo", "Nanum Pen Script", "Narkisim", "Neucha", "Neuton", "New Rocker", "News Cycle", "News Gothic MT", "Niconne", "Nirmala UI", "Nixie One", "Nobile", "Nokora", "Norican", "Nosifer", "Nothing You Could Do", "Noticia Text", "Noto Sans", "Noto Serif", "Nova Cut", "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round", "Nova Script", "Nova Slim", "Nova Square", "NSimSun", "NTR", "Numans", "Nunito", "Nunito Sans", "Nyala", "Odor Mean Chey", "Offside", "Old Standard TT", "Oldenburg", "Oleo Script", "Oleo Script Swash Caps", "Open Sans", "Open Sans Condensed", "Oranienbaum", "Orbitron", "Oregano", "Orienta", "Original Surfer", "Oswald", "Over the Rainbow", "Overlock", "Overlock SC", "Overpass", "Overpass Mono", "Ovo", "Oxygen", "Oxygen Mono", "Pacifico", "Padauk", "Palanquin", "Palanquin Dark", "Palatino Linotype", "Pangolin", "Paprika", "Parisienne", "Passero One", "Passion One", "Pathway Gothic One", "Patrick Hand", "Patrick Hand SC", "Pattaya", "Patua One", "Pavanam", "Paytone One", "Peddana", "Peralta", "Permanent Marker", "Petit Formal Script", "Petrona", "Philosopher", "Piedra", "Pinyon Script", "Pirata One", "Plantagenet Cherokee", "Plaster", "Play", "Playball", "Playfair Display", "Playfair Display SC", "Podkova", "Poiret One", "Poller One", "Poly", "Pompiere", "Pontano Sans", "Poor Story", "Poppins", "Port Lligat Sans", "Port Lligat Slab", "Pragati Narrow", "Prata", "Preahvihear", "Pridi", "Princess Sofia", "Prociono", "Prompt", "Prosto One", "Proza Libre", "PT Mono", "PT Sans", "PT Sans Caption", "PT Sans Narrow", "PT Serif", "PT Serif Caption", "Puritan", "Purple Purse", "Quando", "Quantico", "Quattrocento", "Quattrocento Sans", "Questrial", "Quicksand", "Quintessential", "Qwigley", "Raavi", "Racing Sans One", "Radley", "Rajdhani", "Rakkas", "Raleway", "Raleway Dots", "Ramabhadra", "Ramaraja", "Rambla", "Rammetto One", "Ranchers", "Rancho", "Ranga", "Rasa", "Rationale", "Ravi Prakash", "Redressed", "Reem Kufi", "Reenie Beanie", "Revalia", "Rhodium Libre", "Ribeye", "Ribeye Marrow", "Righteous", "Risque", "Roboto", "Roboto Condensed", "Roboto Mono", "Roboto Slab", "Rochester", "Rock Salt", "Rod", "Rokkitt", "Romanesco", "Ropa Sans", "Rosario", "Rosarivo", "Rouge Script", "Rozha One", "Rubik", "Rubik Mono One", "Ruda", "Rufina", "Ruge Boogie", "Ruluko", "Rum Raisin", "Ruslan Display", "Russo One", "Ruthie", "Rye", "Sacramento", "Sahitya", "Sail", "Saira", "Saira Condensed", "Saira Extra Condensed", "Saira Semi Condensed", "Sakkal Majalla", "Salsa", "Sanchez", "Sancreek", "Sansita", "Sarala", "Sarina", "Sarpanch", "Satisfy", "Scada", "Scheherazade", "Schoolbell", "Scope One", "Seaweed Script", "Secular One", "Sedgwick Ave", "Sedgwick Ave Display", "Segoe Print", "Segoe Script", "Segoe UI Symbol", "Sevillana", "Seymour One", "Shadows Into Light", "Shadows Into Light Two", "Shanti", "Share", "Share Tech", "Share Tech Mono", "Shojumaru", "Shonar Bangla", "Short Stack", "Shrikhand", "Shruti", "Siemreap", "Sigmar One", "Signika", "Signika Negative", "SimHei", "SimKai", "Simonetta", "Simplified Arabic", "SimSun", "SimSun-ExtB", "Sintony", "Sirin Stencil", "Six Caps", "Skranji", "Slackey", "Smokum", "Smythe", "Sniglet", "Snippet", "Snowburst One", "Sofadi One", "Sofia", "Song Myung", "Sonsie One", "Sorts Mill Goudy", "Source Code Pro", "Source Sans Pro", "Source Serif Pro", "Space Mono", "Special Elite", "Spectral", "Spectral SC", "Spicy Rice", "Spinnaker", "Spirax", "Squada One", "Sree Krushnadevaraya", "Sriracha", "Stalemate", "Stalinist One", "Stardos Stencil", "Stint Ultra Condensed", "Stint Ultra Expanded", "Stoke", "Strait", "Stylish", "Sue Ellen Francisco", "Suez One", "Sumana", "Sunflower", "Sunshiney", "Supermercado One", "Sura", "Suranna", "Suravaram", "Suwannaphum", "Swanky and Moo Moo", "Sylfaen", "Syncopate", "Tahoma", "Tajawal", "Tangerine", "Taprom", "Tauri", "Taviraj", "Teko", "Telex", "Tenali Ramakrishna", "Tenor Sans", "Text Me One", "The Girl Next Door", "Tienne", "Tillana", "Times New Roman", "Timmana", "Tinos", "Titan One", "Titillium Web", "Trade Winds", "Traditional Arabic", "Trebuchet MS", "Trirong", "Trocchi", "Trochut", "Trykker", "Tulpen One", "Tunga", "Ubuntu", "Ubuntu Condensed", "Ubuntu Mono", "Ultra", "Uncial Antiqua", "Underdog", "Unica One", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "Unna", "Utsaah", "Vampiro One", "Vani", "Varela", "Varela Round", "Vast Shadow", "Vesper Libre", "Vibur", "Vidaloka", "Viga", "Vijaya", "Voces", "Volkhov", "Vollkorn", "Vollkorn SC", "Voltaire", "VT323", "Waiting for the Sunrise", "Wallpoet", "Walter Turncoat", "Warnes", "Wellfleet", "Wendy One", "Wire One", "Work Sans", "Yanone Kaffeesatz", "Yantramanav", "Yatra One", "Yellowtail", "Yeon Sung", "Yeseva One", "Yesteryear", "Yrsa", "Zeyada", "Zilla Slab", "Zilla Slab Highlight");
	$TotalSoftFontGCount = array("Abadi MT Condensed Light", "ABeeZee, sans-serif", "Abel, sans-serif", "Abhaya Libre, serif", "Abril Fatface, cursive", "Aclonica, sans-serif", "Acme, sans-serif", "Actor, sans-serif", "Adamina, serif", "Advent Pro, sans-serif", "Aguafina Script, cursive", "Aharoni", "Akronim, cursive", "Aladin, cursive", "Aldhabi", "Aldrich, sans-serif", "Alef, sans-serif", "Alegreya, serif", "Alegreya Sans, sans-serif", "Alegreya Sans SC, sans-serif", "Alegreya SC, serif", "Alex Brush, cursive", "Alfa Slab One, cursive", "Alice, serif", "Alike, serif", "Alike Angular, serif", "Allan, cursive", "Allerta, sans-serif", "Allerta Stencil, sans-serif", "Allura, cursive", "Almendra, serif", "Almendra Display, cursive", "Almendra SC, serif", "Amarante, cursive", "Amaranth, sans-serif", "Amatic SC, cursive", "Amethysta, serif", "Amiko, sans-serif", "Amiri, serif", "Amita, cursive", "Anaheim, sans-serif", "Andada, serif", "Andalus", "Andika, sans-serif", "Angkor, cursive", "Angsana New", "AngsanaUPC", "Annie Use Your Telescope, cursive", "Anonymous Pro, monospace", "Antic, sans-serif", "Antic Didone, serif", "Antic Slab, serif", "Anton, sans-serif", "Aparajita", "Arabic Typesetting", "Arapey, serif", "Arbutus, cursive", "Arbutus Slab, serif", "Architects Daughter, cursive", "Archivo, sans-serif", "Archivo Black, sans-serif", "Archivo Narrow, sans-serif", "Aref Ruqaa, serif", "Arial", "Arial Black", "Arimo, sans-serif", "Arima Madurai, cursive", "Arizonia, cursive", "Armata, sans-serif", "Arsenal, sans-serif", "Artifika, serif", "Arvo, serif", "Arya, sans-serif", "Asap, sans-serif", "Asap Condensed, sans-serif", "Asar, serif", "Asset, cursive", "Assistant, sans-serif", "Astloch, cursive", "Asul, sans-serif", "Athiti, sans-serif", "Atma, cursive", "Atomic Age, cursive", "Aubrey, cursive", "Audiowide, cursive", "Autour One, cursive", "Average, serif", "Average Sans, sans-serif", "Averia Gruesa Libre, cursive", "Averia Libre, cursive", "Averia Sans Libre, cursive", "Averia Serif Libre, cursive", "Bad Script, cursive", "Bahiana, cursive", "Baloo, cursive", "Balthazar, serif", "Bangers, cursive", "Barlow, sans-serif", "Barlow Condensed, sans-serif", "Barlow Semi Condensed, sans-serif", "Barrio, cursive", "Basic, sans-serif", "Batang", "BatangChe", "Battambang, cursive", "Baumans, cursive", "Bayon, cursive", "Belgrano, serif", "Bellefair, serif", "Belleza, sans-serif", "BenchNine, sans-serif", "Bentham, serif", "Berkshire Swash, cursive", "Bevan, cursive", "Bigelow Rules, cursive", "Bigshot One, cursive", "Bilbo, cursive", "Bilbo Swash Caps, cursive", "BioRhyme, serif", "BioRhyme Expanded, serif", "Biryani, sans-serif", "Bitter, serif", "Black And White Picture, sans-serif", "Black Han Sans, sans-serif", "Black Ops One, cursive", "Bokor, cursive", "Bonbon, cursive", "Boogaloo, cursive", "Bowlby One, cursive", "Bowlby One SC, cursive", "Brawler, serif", "Bree Serif, serif", "Browallia New", "BrowalliaUPC", "Bubbler One, sans-serif", "Bubblegum Sans, cursive", "Buda, cursive", "Buenard, serif", "Bungee, cursive", "Bungee Hairline, cursive", "Bungee Inline, cursive", "Bungee Outline, cursive", "Bungee Shade, cursive", "Butcherman, cursive", "Butterfly Kids, cursive", "Cabin, sans-serif", "Cabin Condensed, sans-serif", "Cabin Sketch, cursive", "Caesar Dressing, cursive", "Cagliostro, sans-serif", "Cairo, sans-serif", "Calibri", "Calibri Light", "Calisto MT", "Calligraffitti, cursive", "Cambay, sans-serif", "Cambo, serif", "Cambria", "Candal, sans-serif", "Candara", "Cantarell, sans-serif", "Cantata One, serif", "Cantora One, sans-serif", "Capriola, sans-serif", "Cardo, serif", "Carme, sans-serif", "Carrois Gothic, sans-serif", "Carrois Gothic SC, sans-serif", "Carter One, cursive", "Catamaran, sans-serif", "Caudex, serif", "Caveat, cursive", "Caveat Brush, cursive", "Cedarville Cursive, cursive", "Century Gothic", "Ceviche One, cursive", "Changa, sans-serif", "Changa One, cursive", "Chango, cursive", "Chathura, sans-serif", "Chau Philomene One, sans-serif", "Chela One, cursive", "Chelsea Market, cursive", "Chenla, cursive", "Cherry Cream Soda, cursive", "Cherry Swash, cursive", "Chewy, cursive", "Chicle, cursive", "Chivo, sans-serif", "Chonburi, cursive", "Cinzel, serif", "Cinzel Decorative, cursive", "Clicker Script, cursive", "Coda, cursive", "Coda Caption, sans-serif", "Codystar, cursive", "Coiny, cursive", "Combo, cursive", "Comic Sans MS", "Coming Soon, cursive", "Comfortaa, cursive", "Concert One, cursive", "Condiment, cursive", "Consolas", "Constantia", "Content, cursive", "Contrail One, cursive", "Convergence, sans-serif", "Cookie, cursive", "Copperplate Gothic", "Copperplate Gothic Light", "Copse, serif", "Corbel", "Corben, cursive", "Cordia New", "CordiaUPC", "Cormorant, serif", "Cormorant Garamond, serif", "Cormorant Infant, serif", "Cormorant SC, serif", "Cormorant Unicase, serif", "Cormorant Upright, serif", "Courgette, cursive", "Courier New", "Cousine, monospace", "Coustard, serif", "Covered By Your Grace, cursive", "Crafty Girls, cursive", "Creepster, cursive", "Crete Round, serif", "Crimson Text, serif", "Croissant One, cursive", "Crushed, cursive", "Cuprum, sans-serif", "Cute Font, cursive", "Cutive, serif", "Cutive Mono, monospace", "Damion, cursive", "Dancing Script, cursive", "Dangrek, cursive", "DaunPenh", "David", "David Libre, serif", "Dawning of a New Day, cursive", "Days One, sans-serif", "Delius, cursive", "Delius Swash Caps, cursive", "Delius Unicase, cursive", "Della Respira, serif", "Denk One, sans-serif", "Devonshire, cursive", "DFKai-SB", "Dhurjati, sans-serif", "Didact Gothic, sans-serif", "DilleniaUPC", "Diplomata, cursive", "Diplomata SC, cursive", "Do Hyeon, sans-serif", "DokChampa", "Dokdo, cursive", "Domine, serif", "Donegal One, serif", "Doppio One, sans-serif", "Dorsa, sans-serif", "Dosis, sans-serif", "Dotum", "DotumChe", "Dr Sugiyama, cursive", "Duru Sans, sans-serif", "Dynalight, cursive", "Eagle Lake, cursive", "East Sea Dokdo, cursive", "Eater, cursive", "EB Garamond, serif", "Ebrima", "Economica, sans-serif", "Eczar, serif", "El Messiri, sans-serif", "Electrolize, sans-serif", "Elsie, cursive", "Elsie Swash Caps, cursive", "Emblema One, cursive", "Emilys Candy, cursive", "Encode Sans, sans-serif", "Encode Sans Condensed, sans-serif", "Encode Sans Expanded, sans-serif", "Encode Sans Semi Condensed, sans-serif", "Encode Sans Semi Expanded, sans-serif", "Engagement, cursive", "Englebert, sans-serif", "Enriqueta, serif", "Erica One, cursive", "Esteban, serif", "Estrangelo Edessa", "EucrosiaUPC", "Euphemia", "Euphoria Script, cursive", "Ewert, cursive", "Exo, sans-serif", "Expletus Sans, cursive", "FangSong", "Fanwood Text, serif", "Farsan, cursive", "Fascinate, cursive", "Fascinate Inline, cursive", "Faster One, cursive", "Fasthand, serif", "Fauna One, serif", "Faustina, serif", "Federant, cursive", "Federo, sans-serif", "Felipa, cursive", "Fenix, serif", "Finger Paint, cursive", "Fira Mono, monospace", "Fira Sans, sans-serif", "Fira Sans Condensed, sans-serif", "Fira Sans Extra Condensed, sans-serif", "Fjalla One, sans-serif", "Fjord One, serif", "Flamenco, cursive", "Flavors, cursive", "Fondamento, cursive", "Fontdiner Swanky, cursive", "Forum, cursive", "Francois One, sans-serif", "Frank Ruhl Libre, serif", "Franklin Gothic Medium", "FrankRuehl", "Freckle Face, cursive", "Fredericka the Great, cursive", "Fredoka One, cursive", "Freehand, cursive", "FreesiaUPC", "Fresca, sans-serif", "Frijole, cursive", "Fruktur, cursive", "Fugaz One, cursive", "Gabriela, serif", "Gabriola", "Gadugi", "Gaegu, cursive", "Gafata, sans-serif", "Galada, cursive", "Galdeano, sans-serif", "Galindo, cursive", "Gamja Flower, cursive", "Gautami", "Gentium Basic, serif", "Gentium Book Basic, serif", "Geo, sans-serif", "Georgia", "Geostar, cursive", "Geostar Fill, cursive", "Germania One, cursive", "GFS Didot, serif", "GFS Neohellenic, sans-serif", "Gidugu, sans-serif", "Gilda Display, serif", "Gisha", "Give You Glory, cursive", "Glass Antiqua, cursive", "Glegoo, serif", "Gloria Hallelujah, cursive", "Goblin One, cursive", "Gochi Hand, cursive", "Gorditas, cursive", "Gothic A1, sans-serif", "Graduate, cursive", "Grand Hotel, cursive", "Gravitas One, cursive", "Great Vibes, cursive", "Griffy, cursive", "Gruppo, cursive", "Gudea, sans-serif", "Gugi, cursive", "Gulim", "GulimChe", "Gungsuh", "GungsuhChe", "Gurajada, serif", "Habibi, serif", "Halant, serif", "Hammersmith One, sans-serif", "Hanalei, cursive", "Hanalei Fill, cursive", "Handlee, cursive", "Hanuman, serif", "Happy Monkey, cursive", "Harmattan, sans-serif", "Headland One, serif", "Heebo, sans-serif", "Henny Penny, cursive", "Herr Von Muellerhoff, cursive", "Hi Melody, cursive", "Hind, sans-serif", "Holtwood One SC, serif", "Homemade Apple, cursive", "Homenaje, sans-serif", "IBM Plex Mono, monospace", "IBM Plex Sans, sans-serif", "IBM Plex Sans Condensed, sans-serif", "IBM Plex Serif, serif", "Iceberg, cursive", "Iceland, cursive", "IM Fell Double Pica, serif", "IM Fell Double Pica SC, serif", "IM Fell DW Pica, serif", "IM Fell DW Pica SC, serif", "IM Fell English, serif", "IM Fell English SC, serif", "IM Fell French Canon, serif", "IM Fell French Canon SC, serif", "IM Fell Great Primer, serif", "IM Fell Great Primer SC, serif", "Impact", "Imprima, sans-serif", "Inconsolata, monospace", "Inder, sans-serif", "Indie Flower, cursive", "Inika, serif", "Irish Grover, cursive", "IrisUPC", "Istok Web, sans-serif", "Iskoola Pota", "Italiana, serif", "Italianno, cursive", "Itim, cursive", "Jacques Francois, serif", "Jacques Francois Shadow, cursive", "Jaldi, sans-serif", "JasmineUPC", "Jim Nightshade, cursive", "Jockey One, sans-serif", "Jolly Lodger, cursive", "Jomhuria, cursive", "Josefin Sans, sans-serif", "Josefin Slab, serif", "Joti One, cursive", "Jua, sans-serif", "Judson, serif", "Julee, cursive", "Julius Sans One, sans-serif", "Junge, serif", "Jura, sans-serif", "Just Another Hand, cursive", "Just Me Again Down Here, cursive", "Kadwa, serif", "KaiTi", "Kalam, cursive", "Kalinga", "Kameron, serif", "Kanit, sans-serif", "Kantumruy, sans-serif", "Karla, sans-serif", "Karma, serif", "Kartika", "Katibeh, cursive", "Kaushan Script, cursive", "Kavivanar, cursive", "Kavoon, cursive", "Kdam Thmor, cursive", "Keania One, cursive", "Kelly Slab, cursive", "Kenia, cursive", "Khand, sans-serif", "Khmer, cursive", "Khmer UI", "Khula, sans-serif", "Kirang Haerang, cursive", "Kite One, sans-serif", "Knewave, cursive", "KodchiangUPC", "Kokila", "Kotta One, serif", "Koulen, cursive", "Kranky, cursive", "Kreon, serif", "Kristi, cursive", "Krona One, sans-serif", "Kurale, serif", "La Belle Aurore, cursive", "Laila, serif", "Lakki Reddy, cursive", "Lalezar, cursive", "Lancelot, cursive", "Lao UI", "Lateef, cursive", "Latha", "Lato, sans-serif", "League Script, cursive", "Leckerli One, cursive", "Ledger, serif", "Leelawadee", "Lekton, sans-serif", "Lemon, cursive", "Lemonada, cursive", "Levenim MT", "Libre Baskerville, serif", "Libre Franklin, sans-serif", "Life Savers, cursive", "Lilita One, cursive", "Lily Script One, cursive", "LilyUPC", "Limelight, cursive", "Linden Hill, serif", "Lobster, cursive", "Lobster Two, cursive", "Londrina Outline, cursive", "Londrina Shadow, cursive", "Londrina Sketch, cursive", "Londrina Solid, cursive", "Lora, serif", "Love Ya Like A Sister, cursive", "Loved by the King, cursive", "Lovers Quarrel, cursive", "Lucida Console", "Lucida Handwriting Italic", "Lucida Sans Unicode", "Luckiest Guy, cursive", "Lusitana, serif", "Lustria, serif", "Macondo, cursive", "Macondo Swash Caps, cursive", "Mada, sans-serif", "Magra, sans-serif", "Maiden Orange, cursive", "Maitree, serif", "Mako, sans-serif", "Malgun Gothic", "Mallanna, sans-serif", "Mandali, sans-serif", "Mangal", "Manny ITC", "Manuale, serif", "Marcellus, serif", "Marcellus SC, serif", "Marck Script, cursive", "Margarine, cursive", "Marko One, serif", "Marlett", "Marmelad, sans-serif", "Martel, serif", "Martel Sans, sans-serif", "Marvel, sans-serif", "Mate, serif", "Mate SC, serif", "Maven Pro, sans-serif", "McLaren, cursive", "Meddon, cursive", "MedievalSharp, cursive", "Medula One, cursive", "Meera Inimai, sans-serif", "Megrim, cursive", "Meie Script, cursive", "Meiryo", "Meiryo UI", "Merienda, cursive", "Merienda One, cursive", "Merriweather, serif", "Merriweather Sans, sans-serif", "Metal, cursive", "Metal Mania, cursive", "Metamorphous, cursive", "Metrophobic, sans-serif", "Michroma, sans-serif", "Microsoft Himalaya", "Microsoft JhengHei", "Microsoft JhengHei UI", "Microsoft New Tai Lue", "Microsoft PhagsPa", "Microsoft Sans Serif", "Microsoft Tai Le", "Microsoft Uighur", "Microsoft YaHei", "Microsoft YaHei UI", "Microsoft Yi Baiti", "Milonga, cursive", "Miltonian, cursive", "Miltonian Tattoo, cursive", "Mina, sans-serif", "MingLiU_HKSCS", "MingLiU_HKSCS-ExtB", "Miniver, cursive", "Miriam", "Miriam Libre, sans-serif", "Mirza, cursive", "Miss Fajardose, cursive", "Mitr, sans-serif", "Modak, cursive", "Modern Antiqua, cursive", "Mogra, cursive", "Molengo, sans-serif", "Molle, cursive", "Monda, sans-serif", "Mongolian Baiti", "Monofett, cursive", "Monoton, cursive", "Monsieur La Doulaise, cursive", "Montaga, serif", "Montez, cursive", "Montserrat, sans-serif", "Montserrat Alternates, sans-serif", "Montserrat Subrayada, sans-serif", "MoolBoran", "Moul, cursive", "Moulpali, cursive", "Mountains of Christmas, cursive", "Mouse Memoirs, sans-serif", "Mr Bedfort, cursive", "Mr Dafoe, cursive", "Mr De Haviland, cursive", "Mrs Saint Delafield, cursive", "Mrs Sheppards, cursive", "MS UI Gothic", "Mukta, sans-serif", "Muli, sans-serif", "MV Boli", "Myanmar Text", "Mystery Quest, cursive", "Nanum Brush Script, cursive", "Nanum Gothic, sans-serif", "Nanum Gothic Coding, monospace", "Nanum Myeongjo, serif", "Nanum Pen Script, cursive", "Narkisim", "Neucha, cursive", "Neuton, serif", "New Rocker, cursive", "News Cycle, sans-serif", "News Gothic MT", "Niconne, cursive", "Nirmala UI", "Nixie One, cursive", "Nobile, sans-serif", "Nokora, serif", "Norican, cursive", "Nosifer, cursive", "Nothing You Could Do, cursive", "Noticia Text, serif", "Noto Sans, sans-serif", "Noto Serif, serif", "Nova Cut, cursive", "Nova Flat, cursive", "Nova Mono, monospace", "Nova Oval, cursive", "Nova Round, cursive", "Nova Script, cursive", "Nova Slim, cursive", "Nova Square, cursive", "NSimSun", "NTR, sans-serif", "Numans, sans-serif", "Nunito, sans-serif", "Nunito Sans, sans-serif", "Nyala", "Odor Mean Chey, cursive", "Offside, cursive", "Old Standard TT, serif", "Oldenburg, cursive", "Oleo Script, cursive", "Oleo Script Swash Caps, cursive", "Open Sans, sans-serif", "Open Sans Condensed, sans-serif", "Oranienbaum, serif", "Orbitron, sans-serif", "Oregano, cursive", "Orienta, sans-serif", "Original Surfer, cursive", "Oswald, sans-serif", "Over the Rainbow, cursive", "Overlock, cursive", "Overlock SC, cursive", "Overpass, sans-serif", "Overpass Mono, monospace", "Ovo, serif", "Oxygen, sans-serif", "Oxygen Mono, monospace", "Pacifico, cursive", "Padauk, sans-serif", "Palanquin, sans-serif", "Palanquin Dark, sans-serif", "Palatino Linotype", "Pangolin, cursive", "Paprika, cursive", "Parisienne, cursive", "Passero One, cursive", "Passion One, cursive", "Pathway Gothic One, sans-serif", "Patrick Hand, cursive", "Patrick Hand SC, cursive", "Pattaya, sans-serif", "Patua One, cursive", "Pavanam, sans-serif", "Paytone One, sans-serif", "Peddana, serif", "Peralta, cursive", "Permanent Marker, cursive", "Petit Formal Script, cursive", "Petrona, serif", "Philosopher, sans-serif", "Piedra, cursive", "Pinyon Script, cursive", "Pirata One, cursive", "Plantagenet Cherokee", "Plaster, cursive", "Play, sans-serif", "Playball, cursive", "Playfair Display, serif", "Playfair Display SC, serif", "Podkova, serif", "Poiret One, cursive", "Poller One, cursive", "Poly, serif", "Pompiere, cursive", "Pontano Sans, sans-serif", "Poor Story, cursive", "Poppins, sans-serif", "Port Lligat Sans, sans-serif", "Port Lligat Slab, serif", "Pragati Narrow, sans-serif", "Prata, serif", "Preahvihear, cursive", "Pridi, serif", "Princess Sofia, cursive", "Prociono, serif", "Prompt, sans-serif", "Prosto One, cursive", "Proza Libre, sans-serif", "PT Mono, monospace", "PT Sans, sans-serif", "PT Sans Caption, sans-serif", "PT Sans Narrow, sans-serif", "PT Serif, serif", "PT Serif Caption, serif", "Puritan, sans-serif", "Purple Purse, cursive", "Quando, serif", "Quantico, sans-serif", "Quattrocento, serif", "Quattrocento Sans, sans-serif", "Questrial, sans-serif", "Quicksand, sans-serif", "Quintessential, cursive", "Qwigley, cursive", "Raavi", "Racing Sans One, cursive", "Radley, serif", "Rajdhani, sans-serif", "Rakkas, cursive", "Raleway, sans-serif", "Raleway Dots, cursive", "Ramabhadra, sans-serif", "Ramaraja, serif", "Rambla, sans-serif", "Rammetto One, cursive", "Ranchers, cursive", "Rancho, cursive", "Ranga, cursive", "Rasa, serif", "Rationale, sans-serif", "Ravi Prakash, cursive", "Redressed, cursive", "Reem Kufi, sans-serif", "Reenie Beanie, cursive", "Revalia, cursive", "Rhodium Libre, serif", "Ribeye, cursive", "Ribeye Marrow, cursive", "Righteous, cursive", "Risque, cursive", "Roboto, sans-serif", "Roboto Condensed, sans-serif", "Roboto Mono, monospace", "Roboto Slab, serif", "Rochester, cursive", "Rock Salt, cursive", "Rod", "Rokkitt, serif", "Romanesco, cursive", "Ropa Sans, sans-serif", "Rosario, sans-serif", "Rosarivo, serif", "Rouge Script, cursive", "Rozha One, serif", "Rubik, sans-serif", "Rubik Mono One, sans-serif", "Ruda, sans-serif", "Rufina, serif", "Ruge Boogie, cursive", "Ruluko, sans-serif", "Rum Raisin, sans-serif", "Ruslan Display, cursive", "Russo One, sans-serif", "Ruthie, cursive", "Rye, cursive", "Sacramento, cursive", "Sahitya, serif", "Sail, cursive", "Saira, sans-serif", "Saira Condensed, sans-serif", "Saira Extra Condensed, sans-serif", "Saira Semi Condensed, sans-serif", "Sakkal Majalla", "Salsa, cursive", "Sanchez, serif", "Sancreek, cursive", "Sansita, sans-serif", "Sarala, sans-serif", "Sarina, cursive", "Sarpanch, sans-serif", "Satisfy, cursive", "Scada, sans-serif", "Scheherazade, serif", "Schoolbell, cursive", "Scope One, serif", "Seaweed Script, cursive", "Secular One, sans-serif", "Sedgwick Ave, cursive", "Sedgwick Ave Display, cursive", "Segoe Print", "Segoe Script", "Segoe UI Symbol", "Sevillana, cursive", "Seymour One, sans-serif", "Shadows Into Light, cursive", "Shadows Into Light Two, cursive", "Shanti, sans-serif", "Share, cursive", "Share Tech, sans-serif", "Share Tech Mono, monospace", "Shojumaru, cursive", "Shonar Bangla", "Short Stack, cursive", "Shrikhand, cursive", "Shruti", "Siemreap, cursive", "Sigmar One, cursive", "Signika, sans-serif", "Signika Negative, sans-serif", "SimHei", "SimKai", "Simonetta, cursive", "Simplified Arabic", "SimSun", "SimSun-ExtB", "Sintony, sans-serif", "Sirin Stencil, cursive", "Six Caps, sans-serif", "Skranji, cursive", "Slackey, cursive", "Smokum, cursive", "Smythe, cursive", "Sniglet, cursive", "Snippet, sans-serif", "Snowburst One, cursive", "Sofadi One, cursive", "Sofia, cursive", "Song Myung, serif", "Sonsie One, cursive", "Sorts Mill Goudy, serif", "Source Code Pro, monospace", "Source Sans Pro, sans-serif", "Source Serif Pro, serif", "Space Mono, monospace", "Special Elite, cursive", "Spectral, serif", "Spectral SC, serif", "Spicy Rice, cursive", "Spinnaker, sans-serif", "Spirax, cursive", "Squada One, cursive", "Sree Krushnadevaraya, serif", "Sriracha, cursive", "Stalemate, cursive", "Stalinist One, cursive", "Stardos Stencil, cursive", "Stint Ultra Condensed, cursive", "Stint Ultra Expanded, cursive", "Stoke, serif", "Strait, sans-serif", "Stylish, sans-serif", "Sue Ellen Francisco, cursive", "Suez One, serif", "Sumana, serif", "Sunflower, sans-serif", "Sunshiney, cursive", "Supermercado One, cursive", "Sura, serif", "Suranna, serif", "Suravaram, serif", "Suwannaphum, cursive", "Swanky and Moo Moo, cursive", "Sylfaen", "Syncopate, sans-serif", "Tahoma", "Tajawal, sans-serif", "Tangerine, cursive", "Taprom, cursive", "Tauri, sans-serif", "Taviraj, serif", "Teko, sans-serif", "Telex, sans-serif", "Tenali Ramakrishna, sans-serif", "Tenor Sans, sans-serif", "Text Me One, sans-serif", "The Girl Next Door, cursive", "Tienne, serif", "Tillana, cursive", "Times New Roman", "Timmana, sans-serif", "Tinos, serif", "Titan One, cursive", "Titillium Web, sans-serif", "Trade Winds, cursive", "Traditional Arabic", "Trebuchet MS", "Trirong, serif", "Trocchi, serif", "Trochut, cursive", "Trykker, serif", "Tulpen One, cursive", "Tunga", "Ubuntu, sans-serif", "Ubuntu Condensed, sans-serif", "Ubuntu Mono, monospace", "Ultra, serif", "Uncial Antiqua, cursive", "Underdog, cursive", "Unica One, cursive", "UnifrakturCook, cursive", "UnifrakturMaguntia, cursive", "Unkempt, cursive", "Unlock, cursive", "Unna, serif", "Utsaah", "Vampiro One, cursive", "Vani", "Varela, sans-serif", "Varela Round, sans-serif", "Vast Shadow, cursive", "Vesper Libre, serif", "Vibur, cursive", "Vidaloka, serif", "Viga, sans-serif", "Vijaya", "Voces, cursive", "Volkhov, serif", "Vollkorn, serif", "Vollkorn SC, serif", "Voltaire, sans-serif", "VT323, monospace", "Waiting for the Sunrise, cursive", "Wallpoet, cursive", "Walter Turncoat, cursive", "Warnes, cursive", "Wellfleet, cursive", "Wendy One, sans-serif", "Wire One, sans-serif", "Work Sans, sans-serif", "Yanone Kaffeesatz, sans-serif", "Yantramanav, sans-serif", "Yatra One, cursive", "Yellowtail, cursive", "Yeon Sung, cursive", "Yeseva One, cursive", "Yesteryear, cursive", "Yrsa, serif", "Zeyada, cursive", "Zilla Slab, serif", "Zilla Slab Highlight, cursive");
?>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('../CSS/totalsoft.css',__FILE__);?>">
<link href="https://fonts.googleapis.com/css?family=ABeeZee|Abel|Abhaya+Libre|Abril+Fatface|Aclonica|Acme|Actor|Adamina|Advent+Pro|Aguafina+Script|Akronim|Aladin|Aldrich|Alef|Alegreya|Alegreya+SC|Alegreya+Sans|Alegreya+Sans+SC|Alex+Brush|Alfa+Slab+One|Alice|Alike|Alike+Angular|Allan|Allerta|Allerta+Stencil|Allura|Almendra|Almendra+Display|Almendra+SC|Amarante|Amaranth|Amatic+SC|Amethysta|Amiko|Amiri|Amita|Anaheim|Andada|Andika|Angkor|Annie+Use+Your+Telescope|Anonymous+Pro|Antic|Antic+Didone|Antic+Slab|Anton|Arapey|Arbutus|Arbutus+Slab|Architects+Daughter|Archivo|Archivo+Black|Archivo+Narrow|Aref+Ruqaa|Arima+Madurai|Arimo|Arizonia|Armata|Arsenal|Artifika|Arvo|Arya|Asap|Asap+Condensed|Asar|Asset|Assistant|Astloch|Asul|Athiti|Atma|Atomic+Age|Aubrey|Audiowide|Autour+One|Average|Average+Sans|Averia+Gruesa+Libre|Averia+Libre|Averia+Sans+Libre|Averia+Serif+Libre|Bad+Script|Bahiana|Baloo|Baloo+Bhai|Baloo+Bhaijaan|Baloo+Bhaina|Baloo+Chettan|Baloo+Da|Baloo+Paaji|Baloo+Tamma|Baloo+Tammudu|Baloo+Thambi|Balthazar|Bangers|Barlow|Barlow+Condensed|Barlow+Semi+Condensed|Barrio|Basic|Battambang|Baumans|Bayon|Belgrano|Bellefair|Belleza|BenchNine|Bentham|Berkshire+Swash|Bevan|Bigelow+Rules|Bigshot+One|Bilbo|Bilbo+Swash+Caps|BioRhyme|BioRhyme+Expanded|Biryani|Bitter|Black+And+White+Picture|Black+Han+Sans|Black+Ops+One|Bokor|Bonbon|Boogaloo|Bowlby+One|Bowlby+One+SC|Brawler|Bree+Serif|Bubblegum+Sans|Bubbler+One|Buda:300|Buenard|Bungee|Bungee+Hairline|Bungee+Inline|Bungee+Outline|Bungee+Shade|Butcherman|Butterfly+Kids|Cabin|Cabin+Condensed|Cabin+Sketch|Caesar+Dressing|Cagliostro|Cairo|Calligraffitti|Cambay|Cambo|Candal|Cantarell|Cantata+One|Cantora+One|Capriola|Cardo|Carme|Carrois+Gothic|Carrois+Gothic+SC|Carter+One|Catamaran|Caudex|Caveat|Caveat+Brush|Cedarville+Cursive|Ceviche+One|Changa|Changa+One|Chango|Chathura|Chau+Philomene+One|Chela+One|Chelsea+Market|Chenla|Cherry+Cream+Soda|Cherry+Swash|Chewy|Chicle|Chivo|Chonburi|Cinzel|Cinzel+Decorative|Clicker+Script|Coda|Coda+Caption:800|Codystar|Coiny|Combo|Comfortaa|Coming+Soon|Concert+One|Condiment|Content|Contrail+One|Convergence|Cookie|Copse|Corben|Cormorant|Cormorant+Garamond|Cormorant+Infant|Cormorant+SC|Cormorant+Unicase|Cormorant+Upright|Courgette|Cousine|Coustard|Covered+By+Your+Grace|Crafty+Girls|Creepster|Crete+Round|Crimson+Text|Croissant+One|Crushed|Cuprum|Cute+Font|Cutive|Cutive+Mono|Damion|Dancing+Script|Dangrek|David+Libre|Dawning+of+a+New+Day|Days+One|Dekko|Delius|Delius+Swash+Caps|Delius+Unicase|Della+Respira|Denk+One|Devonshire|Dhurjati|Didact+Gothic|Diplomata|Diplomata+SC|Do+Hyeon|Dokdo|Domine|Donegal+One|Doppio+One|Dorsa|Dosis|Dr+Sugiyama|Duru+Sans|Dynalight|EB+Garamond|Eagle+Lake|East+Sea+Dokdo|Eater|Economica|Eczar|El+Messiri|Electrolize|Elsie|Elsie+Swash+Caps|Emblema+One|Emilys+Candy|Encode+Sans|Encode+Sans+Condensed|Encode+Sans+Expanded|Encode+Sans+Semi+Condensed|Encode+Sans+Semi+Expanded|Engagement|Englebert|Enriqueta|Erica+One|Esteban|Euphoria+Script|Ewert|Exo|Exo+2|Expletus+Sans|Fanwood+Text|Farsan|Fascinate|Fascinate+Inline|Faster+One|Fasthand|Fauna+One|Faustina|Federant|Federo|Felipa|Fenix|Finger+Paint|Fira+Mono|Fira+Sans|Fira+Sans+Condensed|Fira+Sans+Extra+Condensed|Fjalla+One|Fjord+One|Flamenco|Flavors|Fondamento|Fontdiner+Swanky|Forum|Francois+One|Frank+Ruhl+Libre|Freckle+Face|Fredericka+the+Great|Fredoka+One|Freehand|Fresca|Frijole|Fruktur|Fugaz+One|GFS+Didot|GFS+Neohellenic|Gabriela|Gaegu|Gafata|Galada|Galdeano|Galindo|Gamja+Flower|Gentium+Basic|Gentium+Book+Basic|Geo|Geostar|Geostar+Fill|Germania+One|Gidugu|Gilda+Display|Give+You+Glory|Glass+Antiqua|Glegoo|Gloria+Hallelujah|Goblin+One|Gochi+Hand|Gorditas|Gothic+A1|Goudy+Bookletter+1911|Graduate|Grand+Hotel|Gravitas+One|Great+Vibes|Griffy|Gruppo|Gudea|Gugi|Gurajada|Habibi|Halant|Hammersmith+One|Hanalei|Hanalei+Fill|Handlee|Hanuman|Happy+Monkey|Harmattan|Headland+One|Heebo|Henny+Penny|Herr+Von+Muellerhoff|Hi+Melody|Hind|Hind+Guntur|Hind+Madurai|Hind+Siliguri|Hind+Vadodara|Holtwood+One+SC|Homemade+Apple|Homenaje|IBM+Plex+Mono|IBM+Plex+Sans|IBM+Plex+Sans+Condensed|IBM+Plex+Serif|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Iceberg|Iceland|Imprima|Inconsolata|Inder|Indie+Flower|Inika|Inknut+Antiqua|Irish+Grover|Istok+Web|Italiana|Italianno|Itim|Jacques+Francois|Jacques+Francois+Shadow|Jaldi|Jim+Nightshade|Jockey+One|Jolly+Lodger|Jomhuria|Josefin+Sans|Josefin+Slab|Joti+One|Jua|Judson|Julee|Julius+Sans+One|Junge|Jura|Just+Another+Hand|Just+Me+Again+Down+Here|Kadwa|Kalam|Kameron|Kanit|Kantumruy|Karla|Karma|Katibeh|Kaushan+Script|Kavivanar|Kavoon|Kdam+Thmor|Keania+One|Kelly+Slab|Kenia|Khand|Khmer|Khula|Kirang+Haerang|Kite+One|Knewave|Kotta+One|Koulen|Kranky|Kreon|Kristi|Krona+One|Kurale|La+Belle+Aurore|Laila|Lakki+Reddy|Lalezar|Lancelot|Lateef|Lato|League+Script|Leckerli+One|Ledger|Lekton|Lemon|Lemonada|Libre+Barcode+128|Libre+Barcode+128+Text|Libre+Barcode+39|Libre+Barcode+39+Extended|Libre+Barcode+39+Extended+Text|Libre+Barcode+39+Text|Libre+Baskerville|Libre+Franklin|Life+Savers|Lilita+One|Lily+Script+One|Limelight|Linden+Hill|Lobster|Lobster+Two|Londrina+Outline|Londrina+Shadow|Londrina+Sketch|Londrina+Solid|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Lovers+Quarrel|Luckiest+Guy|Lusitana|Lustria|Macondo|Macondo+Swash+Caps|Mada|Magra|Maiden+Orange|Maitree|Mako|Mallanna|Mandali|Manuale|Marcellus|Marcellus+SC|Marck+Script|Margarine|Marko+One|Marmelad|Martel|Martel+Sans|Marvel|Mate|Mate+SC|Maven+Pro|McLaren|Meddon|MedievalSharp|Medula+One|Meera+Inimai|Megrim|Meie+Script|Merienda|Merienda+One|Merriweather|Merriweather+Sans|Metal|Metal+Mania|Metamorphous|Metrophobic|Michroma|Milonga|Miltonian|Miltonian+Tattoo|Mina|Miniver|Miriam+Libre|Mirza|Miss+Fajardose|Mitr|Modak|Modern+Antiqua|Mogra|Molengo|Molle:400i|Monda|Monofett|Monoton|Monsieur+La+Doulaise|Montaga|Montez|Montserrat|Montserrat+Alternates|Montserrat+Subrayada|Moul|Moulpali|Mountains+of+Christmas|Mouse+Memoirs|Mr+Bedfort|Mr+Dafoe|Mr+De+Haviland|Mrs+Saint+Delafield|Mrs+Sheppards|Mukta|Mukta+Mahee|Mukta+Malar|Mukta+Vaani|Muli|Mystery+Quest|NTR|Nanum+Brush+Script|Nanum+Gothic|Nanum+Gothic+Coding|Nanum+Myeongjo|Nanum+Pen+Script|Neucha|Neuton|New+Rocker|News+Cycle|Niconne|Nixie+One|Nobile|Nokora|Norican|Nosifer|Nothing+You+Could+Do|Noticia+Text|Noto+Sans|Noto+Serif|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Numans|Nunito|Nunito+Sans|Odor+Mean+Chey|Offside|Old+Standard+TT|Oldenburg|Oleo+Script|Oleo+Script+Swash+Caps|Open+Sans|Open+Sans+Condensed:300|Oranienbaum|Orbitron|Oregano|Orienta|Original+Surfer|Oswald|Over+the+Rainbow|Overlock|Overlock+SC|Overpass|Overpass+Mono|Ovo|Oxygen|Oxygen+Mono|PT+Mono|PT+Sans|PT+Sans+Caption|PT+Sans+Narrow|PT+Serif|PT+Serif+Caption|Pacifico|Padauk|Palanquin|Palanquin+Dark|Pangolin|Paprika|Parisienne|Passero+One|Passion+One|Pathway+Gothic+One|Patrick+Hand|Patrick+Hand+SC|Pattaya|Patua+One|Pavanam|Paytone+One|Peddana|Peralta|Permanent+Marker|Petit+Formal+Script|Petrona|Philosopher|Piedra|Pinyon+Script|Pirata+One|Plaster|Play|Playball|Playfair+Display|Playfair+Display+SC|Podkova|Poiret+One|Poller+One|Poly|Pompiere|Pontano+Sans|Poor+Story|Poppins|Port+Lligat+Sans|Port+Lligat+Slab|Pragati+Narrow|Prata|Preahvihear|Press+Start+2P|Pridi|Princess+Sofia|Prociono|Prompt|Prosto+One|Proza+Libre|Puritan|Purple+Purse|Quando|Quantico|Quattrocento|Quattrocento+Sans|Questrial|Quicksand|Quintessential|Qwigley|Racing+Sans+One|Radley|Rajdhani|Rakkas|Raleway|Raleway+Dots|Ramabhadra|Ramaraja|Rambla|Rammetto+One|Ranchers|Rancho|Ranga|Rasa|Rationale|Ravi+Prakash|Redressed|Reem+Kufi|Reenie+Beanie|Revalia|Rhodium+Libre|Ribeye|Ribeye+Marrow|Righteous|Risque|Roboto|Roboto+Condensed|Roboto+Mono|Roboto+Slab|Rochester|Rock+Salt|Rokkitt|Romanesco|Ropa+Sans|Rosario|Rosarivo|Rouge+Script|Rozha+One|Rubik|Rubik+Mono+One|Ruda|Rufina|Ruge+Boogie|Ruluko|Rum+Raisin|Ruslan+Display|Russo+One|Ruthie|Rye|Sacramento|Sahitya|Sail|Saira|Saira+Condensed|Saira+Extra+Condensed|Saira+Semi+Condensed|Salsa|Sanchez|Sancreek|Sansita|Sarala|Sarina|Sarpanch|Satisfy|Scada|Scheherazade|Schoolbell|Scope+One|Seaweed+Script|Secular+One|Sedgwick+Ave|Sedgwick+Ave+Display|Sevillana|Seymour+One|Shadows+Into+Light|Shadows+Into+Light+Two|Shanti|Share|Share+Tech|Share+Tech+Mono|Shojumaru|Short+Stack|Shrikhand|Siemreap|Sigmar+One|Signika|Signika+Negative|Simonetta|Sintony|Sirin+Stencil|Six+Caps|Skranji|Slabo+13px|Slabo+27px|Slackey|Smokum|Smythe|Sniglet|Snippet|Snowburst+One|Sofadi+One|Sofia|Song+Myung|Sonsie+One|Sorts+Mill+Goudy|Source+Code+Pro|Source+Sans+Pro|Source+Serif+Pro|Space+Mono|Special+Elite|Spectral|Spectral+SC|Spicy+Rice|Spinnaker|Spirax|Squada+One|Sree+Krushnadevaraya|Sriracha|Stalemate|Stalinist+One|Stardos+Stencil|Stint+Ultra+Condensed|Stint+Ultra+Expanded|Stoke|Strait|Stylish|Sue+Ellen+Francisco|Suez+One|Sumana|Sunflower:300|Sunshiney|Supermercado+One|Sura|Suranna|Suravaram|Suwannaphum|Swanky+and+Moo+Moo|Syncopate|Tajawal|Tangerine|Taprom|Tauri|Taviraj|Teko|Telex|Tenali+Ramakrishna|Tenor+Sans|Text+Me+One|The+Girl+Next+Door|Tienne|Tillana|Timmana|Tinos|Titan+One|Titillium+Web|Trade+Winds|Trirong|Trocchi|Trochut|Trykker|Tulpen+One|Ubuntu|Ubuntu+Condensed|Ubuntu+Mono|Ultra|Uncial+Antiqua|Underdog|Unica+One|UnifrakturCook:700|UnifrakturMaguntia|Unkempt|Unlock|Unna|VT323|Vampiro+One|Varela|Varela+Round|Vast+Shadow|Vesper+Libre|Vibur|Vidaloka|Viga|Voces|Volkhov|Vollkorn|Vollkorn+SC|Voltaire|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Warnes|Wellfleet|Wendy+One|Wire+One|Work+Sans|Yanone+Kaffeesatz|Yantramanav|Yatra+One|Yellowtail|Yeon+Sung|Yeseva+One|Yesteryear|Yrsa|Zeyada|Zilla+Slab|Zilla+Slab+Highlight" rel="stylesheet">
<form method="POST" oninput="TotalSoft_Poll_Out()">
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
			<i class="Total_Soft_Poll_Help totalsoft totalsoft-question-circle-o" title="Click for Creating New Theme."></i>
			<span class="Total_Soft_Poll_AMD2_But" onclick="TotalSoft_Poll_Theme_But1()">
				New Theme (Pro)
			</span>
		</div>
		<div class="Total_Soft_Poll_AMD3">
			<i class="Total_Soft_Poll_Help totalsoft totalsoft-question-circle-o" title="Click for Canceling."></i>
			<span class="Total_Soft_Poll_AMD2_But" onclick="TotalSoftPoll_Reload()">
				Cancel
			</span>
			<i class="Total_Soft_Poll_Update Total_Soft_Poll_Help totalsoft totalsoft-question-circle-o" title="Click to Update Theme Options."></i>
			<button type="submit" class="Total_Soft_Poll_Update Total_Soft_Poll_AMD2_But" name="Total_Soft_Poll_TUpdate">
				Update
			</button>
			<i class="Total_Soft_Poll_Help totalsoft totalsoft-question-circle-o" title="Click for Live Preview."></i>
			<span class="Total_Soft_Poll_AMD2_But" onclick="TS_Poll_Theme_Preview_T()">
				Live Preview
			</span>
			<input type="text" style="display:none" name="Total_SoftPoll_TUpdateID" id="Total_SoftPoll_TUpdateID">
			<input type="text" style="display:none" id="Total_Soft_Poll_Theme_Prev" value="<?php echo home_url(); ?>?ts_poll_preview_theme=true">
		</div>
	</div>
	<table class="Total_Soft_Poll_TMMTable">
		<tr class="Total_Soft_Poll_TMMTableFR">
			<td>No</td>
			<td>Title</td>
			<td>Type</td>
			<td>Live Preview</td>
			<td>Copy</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>
	</table>
	<table class="Total_Soft_Poll_TMOTable">
		<?php for($i=0;$i<count($TotalSoftPollThemes);$i++){ ?>
			<?php
				$TotalSoftPoll = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id>%d", 0));
				$TS_Poll_Types = array();
				if(count($TotalSoftPoll) != 0)
				{
					for($j = 0; $j < count($TotalSoftPoll); $j++)
					{
						$TotalSoftPollOptions1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id = %d", $TotalSoftPoll[$j]->TotalSoftPoll_Theme));
						if(!in_array($TotalSoftPollOptions1[0]->TotalSoft_Poll_TType, $TS_Poll_Types))
						{
							array_push($TS_Poll_Types,$TotalSoftPollOptions1[0]->TotalSoft_Poll_TType);
						}
					}
				}
			?>
			<tr id="Total_Soft_Poll_TMOTable_tr_<?php echo $TotalSoftPollThemes[$i]->id;?>">
				<td><?php echo $i+1;?></td>
				<td><?php echo $TotalSoftPollThemes[$i]->TotalSoft_Poll_TTitle;?></td>
				<td><?php echo $TotalSoftPollThemes[$i]->TotalSoft_Poll_TType;?></td>
				<td>
					<?php
						if( in_array($TotalSoftPollThemes[$i]->TotalSoft_Poll_TType, $TS_Poll_Types) )
						{
							?>
								<a href="<?php echo home_url(); ?>?ts_poll_preview_theme=<?php echo $TotalSoftPollThemes[$i]->id;?>" class="Total_Soft_Poll_AMD2_But_LP" target="_blank">
									<i class="totalsoft totalsoft-eye"></i>
								</a>
							<?php
						}
						else
						{
							?>
								<i class="TS_Poll_TP_No totalsoft totalsoft-eye-slash" onclick="TS_Poll_Theme_Preview('<?php echo $TotalSoftPollThemes[$i]->TotalSoft_Poll_TType;?>')"></i>
							<?php
						}
					?>
				</td>
				<td><i class="totalsoft totalsoft-file-text" onclick="TotalSoftPoll_Theme_Clone(<?php echo $TotalSoftPollThemes[$i]->id;?>)"></i></td>
				<td><i class="totalsoft totalsoft-pencil" onclick="TotalSoftPoll_Theme_Edit(<?php echo $TotalSoftPollThemes[$i]->id;?>)"></i></td>
				<td>
					<i class="totalsoft totalsoft-trash" onclick="TotalSoftPoll_Theme_Del(<?php echo $TotalSoftPollThemes[$i]->id;?>)"></i>
					<span class="Total_Soft_Poll_Del_Span">
						<i class="Total_Soft_Poll_Del_Span_Yes totalsoft totalsoft-check" onclick="TotalSoft_Poll_Theme_But1()"></i>
						<i class="Total_Soft_Poll_Del_Span_No totalsoft totalsoft-times" onclick="TotalSoftPoll_Theme_Del_No(<?php echo $TotalSoftPollThemes[$i]->id;?>)"></i>
					</span>
				</td>
			</tr>
		<?php }?>
	</table>
	<div class="Total_Soft_Poll_Loading">
		<img src="<?php echo plugins_url('../Images/loading.gif',__FILE__);?>">
	</div>
	<div class="TS_Poll_Option_Div_Set TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSet_Table" style="margin-top: 15px;">
		<div class="TS_Poll_Option_Divv1">
			<div class="TS_Poll_Option_Div1">
				<div class="TS_Poll_Option_Name">Theme Title <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can give name to poll theme which will be saved with effects created by you."></i></div>
				<div class="TS_Poll_Option_Field">
					<input type="text" class="Total_Soft_Poll_Select" name="TotalSoft_Poll_TTitle" id="TotalSoft_Poll_TTitle" required placeholder=" *  Required">
				</div>
			</div>
		</div>
		<div class="TS_Poll_Option_Divv2">
			<div class="TS_Poll_Option_Div1">
				<div class="TS_Poll_Option_Name">Type <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose that type which you want to see."></i></div>
				<div class="TS_Poll_Option_Field">
					<select class="Total_Soft_Poll_Select" id="TotalSoft_Poll_TType" name="TotalSoft_Poll_TType">
						<option value="Standart Poll">           Standart Poll           </option>
						<option value="Image Poll">              Image Poll              </option>
						<option value="Video Poll">              Video Poll              </option>
						<option value="Standart Without Button"> Standart Without Button </option>
						<option value="Image Without Button">    Image Without Button    </option>
						<option value="Video Without Button">    Video Without Button    </option>
						<option value="Image in Question">       Image in Question       </option>
						<option value="Video in Question">       Video in Question       </option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="Total_Soft_Poll_AMSetDiv" id="Total_Soft_Poll_TMSetTable_1">
		<div class="Total_Soft_Poll_AMSetDiv_Buttons">
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_1_GO" onclick="TS_Poll_TM_But('1', 'GO')">General Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_1_QO" onclick="TS_Poll_TM_But('1', 'QO')">Question Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_1_AO" onclick="TS_Poll_TM_But('1', 'AO')">Answer Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_1_BO" onclick="TS_Poll_TM_But('1', 'BO')">Button Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_1_PO" onclick="TS_Poll_TM_But('1', 'PO')">Popup Option</div>
		</div>
		<div class="Total_Soft_Poll_AMSetDiv_Content">
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_1_GO">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">General Options</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Max-Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Define the poll max width."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_1_MW" id="TotalSoft_Poll_1_MW" min="40" max="100" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_MW_Output" for="TotalSoft_Poll_1_MW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the poll: center, right, left."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_Pos" id="TotalSoft_Poll_1_Pos">
							<option value="left">   Left   </option>
							<option value="right">  Right  </option>
							<option value="center"> Center </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Add a border and adjust its width."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_BW" id="TotalSoft_Poll_1_BW" min="0" max="10" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_BW_Output" for="TotalSoft_Poll_1_BW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Pick up a color for the element border."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_1_BC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the radius for the border."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_BR" id="TotalSoft_Poll_1_BR" min="0" max="50" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_BR_Output" for="TotalSoft_Poll_1_BR"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Shadow Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the shadow type."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_1_BoxSh_Type">
							<option value="none">  None      </option>
							<option value="true">  Shadow 1  </option>
							<option value="false"> Shadow 2  </option>
							<option value="sh03">  Shadow 3  </option>
							<option value="sh04">  Shadow 4  </option>
							<option value="sh05">  Shadow 5  </option>
							<option value="sh06">  Shadow 6  </option>
							<option value="sh07">  Shadow 7  </option>
							<option value="sh08">  Shadow 8  </option>
							<option value="sh09">  Shadow 9  </option>
							<option value="sh10">  Shadow 10 </option>
							<option value="sh11">  Shadow 11 </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Shadow Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set the shadow color."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_1_BoxShC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_1_QO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Question Option</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select a background color where can be seen the question."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_Q_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Adjust the color of the question text in poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_Q_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the text size on question."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_Q_FS" id="TotalSoft_Poll_1_Q_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_Q_FS_Output" for="TotalSoft_Poll_1_Q_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferable font family for question. Poll plugin has a fonts base."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_Q_FF" id="TotalSoft_Poll_1_Q_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the text position for question."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_Q_TA" id="TotalSoft_Poll_1_Q_TA">
								<option value="left">   Left   </option>
								<option value="right">  Right  </option>
								<option value="center"> Center </option>
							</select>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Line After Question</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside the poll between question and answer you may have lines or remove them."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_1_LAQ_W" id="TotalSoft_Poll_1_LAQ_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_LAQ_W_Output" for="TotalSoft_Poll_1_LAQ_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_LAQ_H" id="TotalSoft_Poll_1_LAQ_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_LAQ_H_Output" for="TotalSoft_Poll_1_LAQ_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation between the question and answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_LAQ_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_LAQ_S" id="TotalSoft_Poll_1_LAQ_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_1_AO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Answer Option</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Has Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Adjust the color of the answers text."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_1_A_CTF" name="">
								<label for="TotalSoft_Poll_1_A_CTF" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This option is for the answers. You can select font size. The size of the answer in responsive poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_A_FS" id="TotalSoft_Poll_1_A_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_A_FS_Output" for="TotalSoft_Poll_1_A_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Here you can select your favourite main background color for theme."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_A_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Use this option to change the color for background."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_A_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the font color of element answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_A_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the font for the poll answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_BoxSh" id="TotalSoft_Poll_1_BoxSh">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Line After Answers</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside the poll between answers and buttons you may have lines or remove them."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_1_LAA_W" id="TotalSoft_Poll_1_LAA_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_LAA_W_Output" for="TotalSoft_Poll_1_LAA_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_LAA_H" id="TotalSoft_Poll_1_LAA_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_LAA_H_Output" for="TotalSoft_Poll_1_LAA_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation between the answers and buttons."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_LAA_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_LAA_S" id="TotalSoft_Poll_1_LAA_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Checkbox Option</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Check Many <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select an unlimited number of answers or no in one poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_1_CH_CM" name="">
								<label for="TotalSoft_Poll_1_CH_CM" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="The plugin allows to get most suitable check box that are most appropriate for your site. Select 4 different types for size."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_CH_S" id="TotalSoft_Poll_1_CH_S">
								<option value="small">    Small    </option>
								<option value="medium 1"> Medium 1 </option>
								<option value="medium 2"> Medium 2 </option>
								<option value="big">      Big      </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Type Before Checking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This field be used for selecting the values from a list of checkboxes before checking."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_1_CH_TBC" style="font-family: 'FontAwesome', Arial;">
								<option value="f10c"> <?php echo '&#xf10c' . '&nbsp; ' . 'Circle O';?>       </option>
								<option value="f111"> <?php echo '&#xf111' . '&nbsp; ' . 'Circle';?>         </option>
								<option value="f096"> <?php echo '&#xf096' . '&nbsp; ' . 'Square O';?>       </option>
								<option value="f0c8"> <?php echo '&#xf0c8' . '&nbsp; ' . 'Square';?>         </option>
								<option value="f147"> <?php echo '&#xf147' . '&nbsp; ' . 'Minus Square O';?> </option>
								<option value="f146"> <?php echo '&#xf146' . '&nbsp; ' . 'Minus Square';?>   </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color Before Checking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select color for checkbox before checking."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_CH_CBC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Type After Clicking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This field be used for selecting the values from a list of checkboxes after checking."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_1_CH_TAC" style="font-family: 'FontAwesome', Arial;">
								<option value="f00c"> <?php echo '&#xf00c' . '&nbsp; ' . 'Check';?>          </option>
								<option value="f058"> <?php echo '&#xf058' . '&nbsp; ' . 'Check Circle';?>   </option>
								<option value="f05d"> <?php echo '&#xf05d' . '&nbsp; ' . 'Check Circle O';?> </option>
								<option value="f14a"> <?php echo '&#xf14a' . '&nbsp; ' . 'Check Square';?>   </option>
								<option value="f046"> <?php echo '&#xf046' . '&nbsp; ' . 'Check Square O';?> </option>
								<option value="f111"> <?php echo '&#xf111' . '&nbsp; ' . 'Circle';?>         </option>
								<option value="f192"> <?php echo '&#xf192' . '&nbsp; ' . 'Dot Circle O';?>   </option>
								<option value="f196"> <?php echo '&#xf196' . '&nbsp; ' . 'Plus Square O';?>  </option>
								<option value="f0fe"> <?php echo '&#xf0fe' . '&nbsp; ' . 'Plus Square';?>    </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color After Clicking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select color for checkbox after checking."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_CH_CAC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Answer Hover Option</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Use this option to change the hover color for background."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_A_HBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the font hover color of element answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_A_HC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_1_BO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Vote Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_VB_MBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_VB_Pos" id="TotalSoft_Poll_1_VB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the vote button's border width."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_VB_BW" id="TotalSoft_Poll_1_VB_BW" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_VB_BW_Output" for="TotalSoft_Poll_1_VB_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_VB_BC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Install the border radius for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_VB_BR" id="TotalSoft_Poll_1_VB_BR" min="0" max="30" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_VB_BR_Output" for="TotalSoft_Poll_1_VB_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_VB_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_VB_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_VB_FS" id="TotalSoft_Poll_1_VB_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_VB_FS_Output" for="TotalSoft_Poll_1_VB_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select that font family which will make your poll more beautiful."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_VB_FF" id="TotalSoft_Poll_1_VB_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_1_VB_Text" name="TotalSoft_Poll_1_VB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_1_VB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                         </option>
								<option value="f123"> <?php echo '&#xf123' . '&nbsp; ' . 'Star Half O';?>          </option>
								<option value="f0a1"> <?php echo '&#xf0a1' . '&nbsp; ' . 'Bullhorn';?>             </option>
								<option value="f0e5"> <?php echo '&#xf0e5' . '&nbsp; ' . 'Comment O';?>            </option>
								<option value="f06e"> <?php echo '&#xf06e' . '&nbsp; ' . 'Eye';?>                  </option>
								<option value="f0fb"> <?php echo '&#xf0fb' . '&nbsp; ' . 'Fighter Jet';?>          </option>
								<option value="f25a"> <?php echo '&#xf25a' . '&nbsp; ' . 'Hand Pointer O';?>       </option>
								<option value="f1d9"> <?php echo '&#xf1d9' . '&nbsp; ' . 'Paper Plane O';?>        </option>
								<option value="f124"> <?php echo '&#xf124' . '&nbsp; &nbsp;' . 'Location Arrow';?> </option>
								<option value="f1d8"> <?php echo '&#xf1d8' . '&nbsp; ' . 'Paper Plane';?>          </option>
								<option value="f005"> <?php echo '&#xf005' . '&nbsp; ' . 'Star';?>                 </option>
								<option value="f006"> <?php echo '&#xf006' . '&nbsp; ' . 'Star O';?>               </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment in the vote button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_VB_IA" id="TotalSoft_Poll_1_VB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the icon size regardless of the container. The plugin allows to get most suitable icon that are most appropriate for your site."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_VB_IS" id="TotalSoft_Poll_1_VB_IS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_VB_IS_Output" for="TotalSoft_Poll_1_VB_IS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select hover background color for vote button in the poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_VB_HBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover color for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_VB_HC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Back Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_BB_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the back button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_P_BB_Pos" id="TotalSoft_Poll_1_P_BB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_BB_BC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_BB_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_BB_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_1_P_BB_Text" name="TotalSoft_Poll_1_P_BB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_1_P_BB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                         </option>
								<option value="f00d"> <?php echo '&#xf00d' . '&nbsp; &nbsp;' . 'Times';?>          </option>
								<option value="f015"> <?php echo '&#xf015' . '&nbsp; &nbsp;' . 'Home';?>           </option>
								<option value="f112"> <?php echo '&#xf112' . '&nbsp; &nbsp;' . 'Reply';?>          </option>
								<option value="f021"> <?php echo '&#xf021' . '&nbsp; &nbsp;' . 'Refresh';?>        </option>
								<option value="f100"> <?php echo '&#xf100' . '&nbsp; &nbsp; ' . 'Angle Double';?>  </option>
								<option value="f104"> <?php echo '&#xf104' . '&nbsp; &nbsp; &nbsp;' . 'Angle';?>   </option>
								<option value="f0a8"> <?php echo '&#xf0a8' . '&nbsp; &nbsp;' . 'Arrow Circle';?>   </option>
								<option value="f190"> <?php echo '&#xf190' . '&nbsp; &nbsp;' . 'Arrow Circle O';?> </option>
								<option value="f0d9"> <?php echo '&#xf0d9' . '&nbsp; &nbsp; &nbsp;' . 'Caret';?>   </option>
								<option value="f191"> <?php echo '&#xf191' . '&nbsp; &nbsp;' . 'Caret Square O';?> </option>
								<option value="f137"> <?php echo '&#xf137' . '&nbsp; &nbsp;' . 'Chevron Circle';?> </option>
								<option value="f053"> <?php echo '&#xf053' . '&nbsp; &nbsp;' . 'Chevron';?>        </option>
								<option value="f0a5"> <?php echo '&#xf0a5' . '&nbsp; ' . 'Hand O';?>               </option>
								<option value="f177"> <?php echo '&#xf177' . '&nbsp; ' . 'Long Arrow';?>           </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment in the back button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_P_BB_IA" id="TotalSoft_Poll_1_P_BB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover background color for back button in the poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_BB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover color for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_BB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Results Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Show <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select whether to see the result button or no."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_1_RB_Show" name="">
								<label for="TotalSoft_Poll_1_RB_Show" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_RB_Pos" id="TotalSoft_Poll_1_RB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the result button's border width."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_RB_BW" id="TotalSoft_Poll_1_RB_BW" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_RB_BW_Output" for="TotalSoft_Poll_1_RB_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_RB_BC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Install the border radius for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_RB_BR" id="TotalSoft_Poll_1_RB_BR" min="0" max="30" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_RB_BR_Output" for="TotalSoft_Poll_1_RB_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_RB_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_RB_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_RB_FS" id="TotalSoft_Poll_1_RB_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_RB_FS_Output" for="TotalSoft_Poll_1_RB_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select that font family which will make your poll more beautiful."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_RB_FF" id="TotalSoft_Poll_1_RB_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_1_RB_Text" name="TotalSoft_Poll_1_RB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_1_RB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                            </option>
								<option value="f1fe"> <?php echo '&#xf1fe' . '&nbsp; ' . 'Area Chart';?>              </option>
								<option value="f0c9"> <?php echo '&#xf0c9' . '&nbsp; &nbsp;' . 'Bars';?>              </option>
								<option value="f1e5"> <?php echo '&#xf1e5' . '&nbsp; &nbsp;' . 'Binoculars';?>        </option>
								<option value="f080"> <?php echo '&#xf080' . '&nbsp; ' . 'Bar Chart';?>               </option>
								<option value="f084"> <?php echo '&#xf084' . '&nbsp; ' . 'Key';?>                     </option>
								<option value="f05a"> <?php echo '&#xf05a' . '&nbsp; &nbsp;' . 'Info Circle';?>       </option>
								<option value="f201"> <?php echo '&#xf201' . '&nbsp; ' . 'Line Chart';?>              </option>
								<option value="f129"> <?php echo '&#xf129' . '&nbsp; &nbsp; &nbsp;' . 'Info';?>       </option>
								<option value="f200"> <?php echo '&#xf200' . '&nbsp; ' . 'Pie Chart';?>               </option>
								<option value="f059"> <?php echo '&#xf059' . '&nbsp; &nbsp;' . 'Question Circle';?>   </option>
								<option value="f128"> <?php echo '&#xf128' . '&nbsp; &nbsp; ' . 'Question';?>         </option>
								<option value="f29c"> <?php echo '&#xf29c' . '&nbsp; &nbsp;' . 'Question Circle O';?> </option>
								<option value="f012"> <?php echo '&#xf012' . '&nbsp; &nbsp;' . 'Signal';?>            </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment in the result button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_RB_IA" id="TotalSoft_Poll_1_RB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the icon size regardless of the container. The plugin allows to get most suitable icon that are most appropriate for your site."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_RB_IS" id="TotalSoft_Poll_1_RB_IS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_RB_IS_Output" for="TotalSoft_Poll_1_RB_IS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover background color for result button in the poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_RB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover color for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_RB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_1_PO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">General Option</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the border width for popup."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_P_BW" id="TotalSoft_Poll_1_P_BW" min="0" max="10" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_P_BW_Output" for="TotalSoft_Poll_1_P_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the border color for popup."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_BC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Show in Popup <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose to show the voting in popup or no."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_1_P_ShPop" name="">
								<label for="TotalSoft_Poll_1_P_ShPop" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Show Effect <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the desired popup effect from the list. You can select effects from our 9 different beautifully designed sets. "></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_1_P_ShEff">
								<option value="FTTB"> From Top to Bottom  </option>
								<option value="FLTR"> From Left to Right  </option>
								<option value="FRTL"> From Right to Left  </option>
								<option value="FCTA"> From Center to Full </option>
								<option value="FTL">  Rotate Y            </option>
								<option value="FTR">  Rotate X            </option>
								<option value="FBL">  Rotate              </option>
								<option value="FBR">  Skew X              </option>
								<option value="FBTT"> Skew Y              </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Question Option</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select a background color where can be seen the question in popup."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_Q_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the color of the question text in poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_Q_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Line After Question</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside poll between question and answer you may have lines or remove them."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_1_P_LAQ_W" id="TotalSoft_Poll_1_P_LAQ_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_P_LAQ_W_Output" for="TotalSoft_Poll_1_P_LAQ_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_P_LAQ_H" id="TotalSoft_Poll_1_P_LAQ_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_P_LAQ_H_Output" for="TotalSoft_Poll_1_P_LAQ_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation between the question and answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_LAQ_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_P_LAQ_S" id="TotalSoft_Poll_1_P_LAQ_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Answer Option</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Here you can select your favourite main background color for the answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_A_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Use this option to change the background color for answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_A_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the font color of element answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_A_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Vote Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select preferable type for showing your voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_1_P_A_VT">
								<option value="percent"> Percent     </option>
								<option value="count">   Votes Count </option>
								<option value="both">    Both        </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Vote Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the voting text."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_A_VC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Vote Effect <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select preferable type for showing your voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_1_P_A_VEff">
								<option value="0">  None      </option>
								<option value="1">  Effect 1  </option>
								<option value="2">  Effect 2  </option>
								<option value="3">  Effect 3  </option>
								<option value="4">  Effect 4  </option>
								<option value="5">  Effect 5  </option>
								<option value="6">  Effect 6  </option>
								<option value="7">  Effect 7  </option>
								<option value="8">  Effect 8  </option>
								<option value="9">  Effect 9  </option>
								<option value="10"> Effect 10 </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Line After Answer</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside the poll between answers and buttons you may have lines or remove them."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_1_P_LAA_W" id="TotalSoft_Poll_1_P_LAA_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_P_LAA_W_Output" for="TotalSoft_Poll_1_P_LAA_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_1_P_LAA_H" id="TotalSoft_Poll_1_P_LAA_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_1_P_LAA_H_Output" for="TotalSoft_Poll_1_P_LAA_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation between the answers and buttons."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_1_P_LAA_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_1_P_LAA_S" id="TotalSoft_Poll_1_P_LAA_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="Total_Soft_Poll_AMSetDiv" id="Total_Soft_Poll_TMSetTable_2">
		<div class="Total_Soft_Poll_AMSetDiv_Buttons">
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_2_GO" onclick="TS_Poll_TM_But('2', 'GO')">General Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_2_QO" onclick="TS_Poll_TM_But('2', 'QO')">Question Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_2_AO" onclick="TS_Poll_TM_But('2', 'AO')">Answer Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_2_VO" onclick="TS_Poll_TM_But('2', 'VO')">Vote Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_2_BO" onclick="TS_Poll_TM_But('2', 'BO')">Results & Back Buttons</div>
		</div>
		<div class="Total_Soft_Poll_AMSetDiv_Content">
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_2_GO">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">General Options</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Max-Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Define the poll max width by percents."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_2_MW" id="TotalSoft_Poll_2_MW" min="40" max="100" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_MW_Output" for="TotalSoft_Poll_2_MW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the poll: center, right or left."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_Pos" id="TotalSoft_Poll_2_Pos">
							<option value="left">   Left   </option>
							<option value="right">  Right  </option>
							<option value="center"> Center </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Add a border and adjust its width."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_BW" id="TotalSoft_Poll_2_BW" min="0" max="10" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_BW_Output" for="TotalSoft_Poll_2_BW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Pick up a color for the element border."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_2_BC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the radius for the border."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_BR" id="TotalSoft_Poll_2_BR" min="0" max="50" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_BR_Output" for="TotalSoft_Poll_2_BR"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Shadow Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the shadow type."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_2_BoxSh_Type">
							<option value="none">  None      </option>
							<option value="true">  Shadow 1  </option>
							<option value="false"> Shadow 2  </option>
							<option value="sh03">  Shadow 3  </option>
							<option value="sh04">  Shadow 4  </option>
							<option value="sh05">  Shadow 5  </option>
							<option value="sh06">  Shadow 6  </option>
							<option value="sh07">  Shadow 7  </option>
							<option value="sh08">  Shadow 8  </option>
							<option value="sh09">  Shadow 9  </option>
							<option value="sh10">  Shadow 10 </option>
							<option value="sh11">  Shadow 11 </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Shadow Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set the shadow color."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_2_BoxShC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_2_QO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Question Option</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select a background color where can be seen the question."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_Q_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Adjust the color of the question text in poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_Q_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the text size on question."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_Q_FS" id="TotalSoft_Poll_2_Q_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_Q_FS_Output" for="TotalSoft_Poll_2_Q_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferable font family for question. Poll plugin has a fonts base."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_Q_FF" id="TotalSoft_Poll_2_Q_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the text position for question."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_Q_TA" id="TotalSoft_Poll_2_Q_TA">
								<option value="left">   Left   </option>
								<option value="right">  Right  </option>
								<option value="center"> Center </option>
							</select>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Line After Question</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside poll between question and photos you may have lines or remove them."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_2_LAQ_W" id="TotalSoft_Poll_2_LAQ_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_LAQ_W_Output" for="TotalSoft_Poll_2_LAQ_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_LAQ_H" id="TotalSoft_Poll_2_LAQ_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_LAQ_H_Output" for="TotalSoft_Poll_2_LAQ_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation between the question and photos."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_LAQ_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_LAQ_S" id="TotalSoft_Poll_2_LAQ_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_2_AO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Answer Option</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Column Count <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the count of column in one row. There is no limitation for images."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range" name="TotalSoft_Poll_2_A_CC" id="TotalSoft_Poll_2_A_CC" min="1" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_A_CC_Output" for="TotalSoft_Poll_2_A_CC"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height Type <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the height to be fixed or by ratio."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_A_IHT" id="TotalSoft_Poll_2_A_IHT">
								<option value="fixed"> Fixed </option>
								<option value="ratio"> Ratio </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Image Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="It allows you to specify the prefered height of the image and it is all responsive."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_A_IH" id="TotalSoft_Poll_2_A_IH" min="50" max="800" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_A_IH_Output" for="TotalSoft_Poll_2_A_IH"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Image Ratio <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set the ratio of the image and it is all responsive."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_2_A_IHR">
								<option value="1"> 1x1  </option>
								<option value="2"> 16x9 </option>
								<option value="3"> 9x16 </option>
								<option value="4"> 3x4  </option>
								<option value="5"> 4x3  </option>
								<option value="6"> 3x2  </option>
								<option value="7"> 2x3  </option>
								<option value="8"> 8x5  </option>
								<option value="9"> 5x8  </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Colors from Main Menu <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify main menu color."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_2_A_CA">
								<option value="Nothing">    For Nothing    </option>
								<option value="Color">      For Color      </option>
								<option value="Background"> For Background </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This option is for the answers. You can select font size."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_A_FS" id="TotalSoft_Poll_2_A_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_A_FS_Output" for="TotalSoft_Poll_2_A_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Here you can select your favourite main background color for theme."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_A_MBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Use this option to change the color for background."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_A_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the font color of element answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_A_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 4 positions for the answer and checkbox."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_A_Pos" id="TotalSoft_Poll_2_A_Pos">
								<option value="Position 1"> Before Image               </option>
								<option value="Position 2"> Before Image Only Checkbox </option>
								<option value="Position 3"> After Image                </option>
								<option value="Position 4"> After Image Only Checkbox  </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the font for the poll answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_BoxSh" id="TotalSoft_Poll_2_BoxSh">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Line After Answers</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside the poll between answer and vote button you may have lines or remove them."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_2_LAA_W" id="TotalSoft_Poll_2_LAA_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_LAA_W_Output" for="TotalSoft_Poll_2_LAA_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_LAA_H" id="TotalSoft_Poll_2_LAA_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_LAA_H_Output" for="TotalSoft_Poll_2_LAA_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation between the answers and vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_LAA_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_LAA_S" id="TotalSoft_Poll_2_LAA_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Checkbox Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Check Many <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose visitor will be able to choose one or more answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_2_CH_CM" name="">
								<label for="TotalSoft_Poll_2_CH_CM" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select 4 different types for size."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_CH_S" id="TotalSoft_Poll_2_CH_S">
								<option value="small">    Small    </option>
								<option value="medium 1"> Medium 1 </option>
								<option value="medium 2"> Medium 2 </option>
								<option value="big">      Big      </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Type Before Checking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This field be used for selecting the values from a list of checkboxes."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_2_CH_TBC" style="font-family: 'FontAwesome', Arial;">
								<option value="f10c"> <?php echo '&#xf10c' . '&nbsp; ' . 'Circle O';?>       </option>
								<option value="f111"> <?php echo '&#xf111' . '&nbsp; ' . 'Circle';?>         </option>
								<option value="f096"> <?php echo '&#xf096' . '&nbsp; ' . 'Square O';?>       </option>
								<option value="f0c8"> <?php echo '&#xf0c8' . '&nbsp; ' . 'Square';?>         </option>
								<option value="f147"> <?php echo '&#xf147' . '&nbsp; ' . 'Minus Square O';?> </option>
								<option value="f146"> <?php echo '&#xf146' . '&nbsp; ' . 'Minus Square';?>   </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color Before Checking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select color for selected checkbox."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_CH_CBC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Type After Clicking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This field be used for selecting the values from a list of checkboxes."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_2_CH_TAC" style="font-family: 'FontAwesome', Arial;">
								<option value="f00c"> <?php echo '&#xf00c' . '&nbsp; ' . 'Check';?>          </option>
								<option value="f058"> <?php echo '&#xf058' . '&nbsp; ' . 'Check Circle';?>   </option>
								<option value="f05d"> <?php echo '&#xf05d' . '&nbsp; ' . 'Check Circle O';?> </option>
								<option value="f14a"> <?php echo '&#xf14a' . '&nbsp; ' . 'Check Square';?>   </option>
								<option value="f046"> <?php echo '&#xf046' . '&nbsp; ' . 'Check Square O';?> </option>
								<option value="f111"> <?php echo '&#xf111' . '&nbsp; ' . 'Circle';?>         </option>
								<option value="f192"> <?php echo '&#xf192' . '&nbsp; ' . 'Dot Circle O';?>   </option>
								<option value="f196"> <?php echo '&#xf196' . '&nbsp; ' . 'Plus Square O';?>  </option>
								<option value="f0fe"> <?php echo '&#xf0fe' . '&nbsp; ' . 'Plus Square';?>    </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color After Clicking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select color for selected checkbox."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_CH_CAC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Answer Hover Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Use this option to change the hover color for background."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_A_HBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the font hover color of element answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_A_HC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Shadow <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose to show the shadow or no."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_2_A_HSh_Show" name="">
								<label for="TotalSoft_Poll_2_A_HSh_Show" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Shadow Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select color which allows to show the shadow of the image."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_A_HShC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1 Total_Soft_Poll_Video_Set">Play Icon Options</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_Video_Set">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the icon color to open video."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_Play_IC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_Video_Set">
						<div class="TS_Poll_Option_Name">Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the size for the play icon."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_Play_IS" id="TotalSoft_Poll_2_Play_IS" min="8" max="150" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_Play_IS_Output" for="TotalSoft_Poll_2_Play_IS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_Video_Set">
						<div class="TS_Poll_Option_Name">Overlay Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the color for overlay."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_Play_IOvC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_Video_Set">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select play icons from a variety of beautifully designed sets for the opening video."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_2_Play_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                        </option>
								<option value="f04b"> <?php echo '&#xf04b' . '&nbsp; &nbsp;' . 'Play';?>          </option>
								<option value="f16a"> <?php echo '&#xf16a' . '&nbsp; ' . 'YouTube Play';?>        </option>
								<option value="f144"> <?php echo '&#xf144' . '&nbsp; &nbsp;' . 'Play Circle';?>   </option>
								<option value="f01d"> <?php echo '&#xf01d' . '&nbsp; &nbsp;' . 'Play Circle O';?> </option>
								<option value="f03d"> <?php echo '&#xf03d' . '&nbsp; ' . 'Video Camera';?>        </option>
								<option value="f26c"> <?php echo '&#xf26c' . '&nbsp; ' . 'Television';?>          </option>
								<option value="f008"> <?php echo '&#xf008' . '&nbsp; &nbsp;' . 'Film';?>          </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_2_VO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Vote Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_VB_MBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the vote button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_VB_Pos" id="TotalSoft_Poll_2_VB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the vote button's border width."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_VB_BW" id="TotalSoft_Poll_2_VB_BW" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_VB_BW_Output" for="TotalSoft_Poll_2_VB_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_VB_BC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Install the border radius for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_VB_BR" id="TotalSoft_Poll_2_VB_BR" min="0" max="30" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_VB_BR_Output" for="TotalSoft_Poll_2_VB_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_VB_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_VB_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_VB_FS" id="TotalSoft_Poll_2_VB_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_VB_FS_Output" for="TotalSoft_Poll_2_VB_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select that font family which will make your poll more beautiful."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_VB_FF" id="TotalSoft_Poll_2_VB_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_2_VB_Text" name="TotalSoft_Poll_2_VB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_2_VB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                         </option>
								<option value="f123"> <?php echo '&#xf123' . '&nbsp; ' . 'Star Half O';?>          </option>
								<option value="f0a1"> <?php echo '&#xf0a1' . '&nbsp; ' . 'Bullhorn';?>             </option>
								<option value="f0e5"> <?php echo '&#xf0e5' . '&nbsp; ' . 'Comment O';?>            </option>
								<option value="f06e"> <?php echo '&#xf06e' . '&nbsp; ' . 'Eye';?>                  </option>
								<option value="f0fb"> <?php echo '&#xf0fb' . '&nbsp; ' . 'Fighter Jet';?>          </option>
								<option value="f25a"> <?php echo '&#xf25a' . '&nbsp; ' . 'Hand Pointer O';?>       </option>
								<option value="f1d9"> <?php echo '&#xf1d9' . '&nbsp; ' . 'Paper Plane O';?>        </option>
								<option value="f124"> <?php echo '&#xf124' . '&nbsp; &nbsp;' . 'Location Arrow';?> </option>
								<option value="f1d8"> <?php echo '&#xf1d8' . '&nbsp; ' . 'Paper Plane';?>          </option>
								<option value="f005"> <?php echo '&#xf005' . '&nbsp; ' . 'Star';?>                 </option>
								<option value="f006"> <?php echo '&#xf006' . '&nbsp; ' . 'Star O';?>               </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for vote button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_VB_IA" id="TotalSoft_Poll_2_VB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the icon size regardless of the container. The plugin allows to get most suitable icon that are most appropriate for your site."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_VB_IS" id="TotalSoft_Poll_2_VB_IS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_VB_IS_Output" for="TotalSoft_Poll_2_VB_IS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover background color for vote button in the poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_VB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover color for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_VB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Vote Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Overlay Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select overlay background color for the image after voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_P_A_OC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select overlay color for the answers after voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_P_A_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Vote Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select preferable type for showing your voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_2_P_A_VT">
								<option value="percent">    Percent             </option>
								<option value="percentlab"> Label + Percent     </option>
								<option value="count">      Votes Count         </option>
								<option value="countlab">   Label + Votes Count </option>
								<option value="both">       Both                </option>
								<option value="bothlab">    Label + Both        </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Vote Effect <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select preferable effect for showing your voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Pll_2_P_A_VEff" id="TotalSoft_Poll_2_P_A_VEff">
								<option value="0"> None     </option>
								<option value="1"> Effect 1 </option>
								<option value="2"> Effect 2 </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_2_BO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Results Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Show <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select whether to see the result button or no."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_2_RB_Show" name="">
								<label for="TotalSoft_Poll_2_RB_Show" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the result button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_RB_Pos" id="TotalSoft_Poll_2_RB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the result button's border width."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_RB_BW" id="TotalSoft_Poll_2_RB_BW" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_RB_BW_Output" for="TotalSoft_Poll_2_RB_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_RB_BC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Install the border radius for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_RB_BR" id="TotalSoft_Poll_2_RB_BR" min="0" max="30" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_RB_BR_Output" for="TotalSoft_Poll_2_RB_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_RB_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_RB_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_RB_FS" id="TotalSoft_Poll_2_RB_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_RB_FS_Output" for="TotalSoft_Poll_2_RB_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select that font family which will make your poll more beautiful."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_RB_FF" id="TotalSoft_Poll_2_RB_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_2_RB_Text" name="TotalSoft_Poll_2_RB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_2_RB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                            </option>
								<option value="f1fe"> <?php echo '&#xf1fe' . '&nbsp; ' . 'Area Chart';?>              </option>
								<option value="f0c9"> <?php echo '&#xf0c9' . '&nbsp; &nbsp;' . 'Bars';?>              </option>
								<option value="f1e5"> <?php echo '&#xf1e5' . '&nbsp; &nbsp;' . 'Binoculars';?>        </option>
								<option value="f080"> <?php echo '&#xf080' . '&nbsp; ' . 'Bar Chart';?>               </option>
								<option value="f084"> <?php echo '&#xf084' . '&nbsp; ' . 'Key';?>                     </option>
								<option value="f05a"> <?php echo '&#xf05a' . '&nbsp; &nbsp;' . 'Info Circle';?>       </option>
								<option value="f201"> <?php echo '&#xf201' . '&nbsp; ' . 'Line Chart';?>              </option>
								<option value="f129"> <?php echo '&#xf129' . '&nbsp; &nbsp; &nbsp;' . 'Info';?>       </option>
								<option value="f200"> <?php echo '&#xf200' . '&nbsp; ' . 'Pie Chart';?>               </option>
								<option value="f059"> <?php echo '&#xf059' . '&nbsp; &nbsp;' . 'Question Circle';?>   </option>
								<option value="f128"> <?php echo '&#xf128' . '&nbsp; &nbsp; ' . 'Question';?>         </option>
								<option value="f29c"> <?php echo '&#xf29c' . '&nbsp; &nbsp;' . 'Question Circle O';?> </option>
								<option value="f012"> <?php echo '&#xf012' . '&nbsp; &nbsp;' . 'Signal';?>            </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for result button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_RB_IA" id="TotalSoft_Poll_2_RB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the icon size regardless of the container. The plugin allows to get most suitable icon that are most appropriate for your site."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_2_RB_IS" id="TotalSoft_Poll_2_RB_IS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_2_RB_IS_Output" for="TotalSoft_Poll_2_RB_IS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover background color for result button in the poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_RB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover color for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_RB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Back Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_P_BB_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the back button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_P_BB_Pos" id="TotalSoft_Poll_2_P_BB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_P_BB_BC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_P_BB_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_P_BB_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_2_P_BB_Text" name="TotalSoft_Poll_2_P_BB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_2_P_BB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                         </option>
								<option value="f00d"> <?php echo '&#xf00d' . '&nbsp; &nbsp;' . 'Times';?>          </option>
								<option value="f015"> <?php echo '&#xf015' . '&nbsp; &nbsp;' . 'Home';?>           </option>
								<option value="f112"> <?php echo '&#xf112' . '&nbsp; &nbsp;' . 'Reply';?>          </option>
								<option value="f021"> <?php echo '&#xf021' . '&nbsp; &nbsp;' . 'Refresh';?>        </option>
								<option value="f100"> <?php echo '&#xf100' . '&nbsp; &nbsp; ' . 'Angle Double';?>  </option>
								<option value="f104"> <?php echo '&#xf104' . '&nbsp; &nbsp; &nbsp;' . 'Angle';?>   </option>
								<option value="f0a8"> <?php echo '&#xf0a8' . '&nbsp; &nbsp;' . 'Arrow Circle';?>   </option>
								<option value="f190"> <?php echo '&#xf190' . '&nbsp; &nbsp;' . 'Arrow Circle O';?> </option>
								<option value="f0d9"> <?php echo '&#xf0d9' . '&nbsp; &nbsp; &nbsp;' . 'Caret';?>   </option>
								<option value="f191"> <?php echo '&#xf191' . '&nbsp; &nbsp;' . 'Caret Square O';?> </option>
								<option value="f137"> <?php echo '&#xf137' . '&nbsp; &nbsp;' . 'Chevron Circle';?> </option>
								<option value="f053"> <?php echo '&#xf053' . '&nbsp; &nbsp;' . 'Chevron';?>        </option>
								<option value="f0a5"> <?php echo '&#xf0a5' . '&nbsp; ' . 'Hand O';?>               </option>
								<option value="f177"> <?php echo '&#xf177' . '&nbsp; ' . 'Long Arrow';?>           </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for back button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_2_P_BB_IA" id="TotalSoft_Poll_2_P_BB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover background color for back button in the Image poll type."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_P_BB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover color for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_2_P_BB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="Total_Soft_Poll_AMSetDiv" id="Total_Soft_Poll_TMSetTable_3">
		<div class="Total_Soft_Poll_AMSetDiv_Buttons">
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_3_GO" onclick="TS_Poll_TM_But('3', 'GO')">General Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_3_QO" onclick="TS_Poll_TM_But('3', 'QO')">Question Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_3_AO" onclick="TS_Poll_TM_But('3', 'AO')">Answer Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_3_TV" onclick="TS_Poll_TM_But('3', 'TV')">Total Votes</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_3_VO" onclick="TS_Poll_TM_But('3', 'VO')">Vote Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_3_BO" onclick="TS_Poll_TM_But('3', 'BO')">Button Option</div>
		</div>
		<div class="Total_Soft_Poll_AMSetDiv_Content">
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_3_GO">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">General Options</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Max-Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Define the max container width by percents."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_3_MW" id="TotalSoft_Poll_3_MW" min="40" max="100" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_MW_Output" for="TotalSoft_Poll_3_MW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose where to place your theme relative to in page: center, right or left."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_Pos" id="TotalSoft_Poll_3_Pos">
							<option value="left">   Left   </option>
							<option value="right">  Right  </option>
							<option value="center"> Center </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Add a border and adjust its width."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_BW" id="TotalSoft_Poll_3_BW" min="0" max="10" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_BW_Output" for="TotalSoft_Poll_3_BW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the border color for the main container."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_3_BC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the border radius for the main container."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_BR" id="TotalSoft_Poll_3_BR" min="0" max="50" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_BR_Output" for="TotalSoft_Poll_3_BR"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Shadow Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the shadow type."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_3_BoxSh_Type">
							<option value="none">  None      </option>
							<option value="true">  Shadow 1  </option>
							<option value="false"> Shadow 2  </option>
							<option value="sh03">  Shadow 3  </option>
							<option value="sh04">  Shadow 4  </option>
							<option value="sh05">  Shadow 5  </option>
							<option value="sh06">  Shadow 6  </option>
							<option value="sh07">  Shadow 7  </option>
							<option value="sh08">  Shadow 8  </option>
							<option value="sh09">  Shadow 9  </option>
							<option value="sh10">  Shadow 10 </option>
							<option value="sh11">  Shadow 11 </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Shadow Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set the shadow color."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_3_BoxShC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_3_QO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Question Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select a background color where can be seen the question."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_Q_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Adjust the color of the question text in polling."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_Q_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the text size for question."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_Q_FS" id="TotalSoft_Poll_3_Q_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_Q_FS_Output" for="TotalSoft_Poll_3_Q_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferable font family for question. Plugin has a fonts base."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_Q_FF" id="TotalSoft_Poll_3_Q_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the text position for question."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_Q_TA" id="TotalSoft_Poll_3_Q_TA">
								<option value="left">   Left   </option>
								<option value="right">  Right  </option>
								<option value="center"> Center </option>
							</select>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Line After Question</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside poll between question and answers you may have line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_3_LAQ_W" id="TotalSoft_Poll_3_LAQ_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_LAQ_W_Output" for="TotalSoft_Poll_3_LAQ_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_LAQ_H" id="TotalSoft_Poll_3_LAQ_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_LAQ_H_Output" for="TotalSoft_Poll_3_LAQ_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation between the question and answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_LAQ_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_LAQ_S" id="TotalSoft_Poll_3_LAQ_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_3_AO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Answer Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Colors from Main Menu <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This function allows to choose from admin page of the selected color to use for answer color, background color or nothing."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_3_A_CA">
								<option value="Nothing">    For Nothing    </option>
								<option value="Color">      For Color      </option>
								<option value="Background"> For Background </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This option is for the answers. You can select font size."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_A_FS" id="TotalSoft_Poll_3_A_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_A_FS_Output" for="TotalSoft_Poll_3_A_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your favourite main background color for theme."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_A_MBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select Your favourite background color for answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_A_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select Your favourite text color for answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_A_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set the border width for the answer container which is currently displayed."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_A_BW" id="TotalSoft_Poll_3_A_BW" min="0" max="8" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_A_BW_Output" for="TotalSoft_Poll_3_A_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set the border color for the answer container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_A_BC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Define the border radius of the overall answers container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_A_BR" id="TotalSoft_Poll_3_A_BR" min="0" max="10" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_A_BR_Output" for="TotalSoft_Poll_3_A_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the font for the poll answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_BoxSh" id="TotalSoft_Poll_3_BoxSh">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Answer Hover Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Use this option to change the hover background color."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_A_HBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the font hover color of element answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_A_HC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Checkbox Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Show Checkbox <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose to show the checkboxes or no."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_3_CH_Sh" name="">
								<label for="TotalSoft_Poll_3_CH_Sh" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select 4 different types for size."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_CH_S" id="TotalSoft_Poll_3_CH_S">
								<option value="small">    Small    </option>
								<option value="medium 1"> Medium 1 </option>
								<option value="medium 2"> Medium 2 </option>
								<option value="big">      Big      </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Type Before Checking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This field be used for selecting the values from a list of checkboxes"></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_3_CH_TBC" style="font-family: 'FontAwesome', Arial;">
								<option value="f10c"> <?php echo '&#xf10c' . '&nbsp; ' . 'Circle O';?>       </option>
								<option value="f111"> <?php echo '&#xf111' . '&nbsp; ' . 'Circle';?>         </option>
								<option value="f096"> <?php echo '&#xf096' . '&nbsp; ' . 'Square O';?>       </option>
								<option value="f0c8"> <?php echo '&#xf0c8' . '&nbsp; ' . 'Square';?>         </option>
								<option value="f147"> <?php echo '&#xf147' . '&nbsp; ' . 'Minus Square O';?> </option>
								<option value="f146"> <?php echo '&#xf146' . '&nbsp; ' . 'Minus Square';?>   </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color Before Checking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select color for selected checkbox."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_CH_CBC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Type After Clicking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This field be used for selecting the values from a list of checkboxes"></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_3_CH_TAC" style="font-family: 'FontAwesome', Arial;">
								<option value="f00c"> <?php echo '&#xf00c' . '&nbsp; ' . 'Check';?>          </option>
								<option value="f058"> <?php echo '&#xf058' . '&nbsp; ' . 'Check Circle';?>   </option>
								<option value="f05d"> <?php echo '&#xf05d' . '&nbsp; ' . 'Check Circle O';?> </option>
								<option value="f14a"> <?php echo '&#xf14a' . '&nbsp; ' . 'Check Square';?>   </option>
								<option value="f046"> <?php echo '&#xf046' . '&nbsp; ' . 'Check Square O';?> </option>
								<option value="f111"> <?php echo '&#xf111' . '&nbsp; ' . 'Circle';?>         </option>
								<option value="f192"> <?php echo '&#xf192' . '&nbsp; ' . 'Dot Circle O';?>   </option>
								<option value="f196"> <?php echo '&#xf196' . '&nbsp; ' . 'Plus Square O';?>  </option>
								<option value="f0fe"> <?php echo '&#xf0fe' . '&nbsp; ' . 'Plus Square';?>    </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color After Clicking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select color for selected checkbox."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_CH_CAC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Line After Answers</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside the poll after answers you may have lines or remove them."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_3_LAA_W" id="TotalSoft_Poll_3_LAA_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_LAA_W_Output" for="TotalSoft_Poll_3_LAA_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_LAA_H" id="TotalSoft_Poll_3_LAA_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_LAA_H_Output" for="TotalSoft_Poll_3_LAA_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation after the answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_LAA_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_LAA_S" id="TotalSoft_Poll_3_LAA_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_3_TV">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Total Votes</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Show <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This function is for showing how many people voted in the poll."></i></div>
					<div class="TS_Poll_Option_Field">
						<div class="switch">
							<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_3_TV_Show" name="">
							<label for="TotalSoft_Poll_3_TV_Show" data-on="Yes" data-off="No"></label>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the total votes text: right, left or center."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_TV_Pos" id="TotalSoft_Poll_3_TV_Pos">
							<option value="left">   Left   </option>
							<option value="right">  Right  </option>
							<option value="center"> Center </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_3_TV_C" class="Total_Soft_Poll_T_Color_1" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the total votes."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_TV_FS" id="TotalSoft_Poll_3_TV_FS" min="8" max="48" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_TV_FS_Output" for="TotalSoft_Poll_3_TV_FS"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in total votes."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_3_TV_Text" name="TotalSoft_Poll_3_TV_Text" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the total votes."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_3_VT_IT" style="font-family: 'FontAwesome', Arial;">
							<option value="">     None                                                            </option>
							<option value="f1fe"> <?php echo '&#xf1fe' . '&nbsp; ' . 'Area Chart';?>              </option>
							<option value="f0c9"> <?php echo '&#xf0c9' . '&nbsp; &nbsp;' . 'Bars';?>              </option>
							<option value="f1e5"> <?php echo '&#xf1e5' . '&nbsp; &nbsp;' . 'Binoculars';?>        </option>
							<option value="f080"> <?php echo '&#xf080' . '&nbsp; ' . 'Bar Chart';?>               </option>
							<option value="f084"> <?php echo '&#xf084' . '&nbsp; ' . 'Key';?>                     </option>
							<option value="f05a"> <?php echo '&#xf05a' . '&nbsp; &nbsp;' . 'Info Circle';?>       </option>
							<option value="f201"> <?php echo '&#xf201' . '&nbsp; ' . 'Line Chart';?>              </option>
							<option value="f129"> <?php echo '&#xf129' . '&nbsp; &nbsp; &nbsp;' . 'Info';?>       </option>
							<option value="f200"> <?php echo '&#xf200' . '&nbsp; ' . 'Pie Chart';?>               </option>
							<option value="f059"> <?php echo '&#xf059' . '&nbsp; &nbsp;' . 'Question Circle';?>   </option>
							<option value="f128"> <?php echo '&#xf128' . '&nbsp; &nbsp; ' . 'Question';?>         </option>
							<option value="f29c"> <?php echo '&#xf29c' . '&nbsp; &nbsp;' . 'Question Circle O';?> </option>
							<option value="f012"> <?php echo '&#xf012' . '&nbsp; &nbsp;' . 'Signal';?>            </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for the total votes (left or right)."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_VT_IA" id="TotalSoft_Poll_3_VT_IA">
							<option value="after">  After Text  </option>
							<option value="before"> Before Text </option>
						</select>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_3_VO">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Vote Option</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Colors from Main Menu <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This function allows to choose from admin page of the selected color to use for answer color, background color or nothing."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_3_V_CA">
							<option value="Nothing">    For Nothing    </option>
							<option value="Color">      For Color      </option>
							<option value="Background"> For Background </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for the answers after voting."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_3_V_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select background color for the answers after voting."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_3_V_BgC" class="Total_Soft_Poll_T_Color_1" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select text color for the answers after voting."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_3_V_C" class="Total_Soft_Poll_T_Color_1" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Vote Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select preferable type for showing your voting."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_3_V_T">
							<option value="percent">    Percent             </option>
							<option value="percentlab"> Label + Percent     </option>
							<option value="count">      Votes Count         </option>
							<option value="countlab">   Label + Votes Count </option>
							<option value="both">       Both                </option>
							<option value="bothlab">    Label + Both        </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Vote Effect <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select preferable effect for showing your voting."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_3_V_Eff">
							<option value="0"> None     </option>
							<option value="1"> Effect 1 </option>
							<option value="2"> Effect 2 </option>
							<option value="3"> Effect 3 </option>
							<option value="4"> Effect 4 </option>
							<option value="5"> Effect 5 </option>
							<option value="6"> Effect 6 </option>
							<option value="7"> Effect 7 </option>
							<option value="8"> Effect 8 </option>
							<option value="9"> Effect 9 </option>
						</select>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_3_BO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Results Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Show <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select whether to see the result button or no."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_3_RB_Show" name="">
								<label for="TotalSoft_Poll_3_RB_Show" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the result button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_RB_Pos" id="TotalSoft_Poll_3_RB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the result button's border width."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_RB_BW" id="TotalSoft_Poll_3_RB_BW" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_RB_BW_Output" for="TotalSoft_Poll_3_RB_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_RB_BC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Install the border radius for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_RB_BR" id="TotalSoft_Poll_3_RB_BR" min="0" max="30" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_RB_BR_Output" for="TotalSoft_Poll_3_RB_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_RB_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_RB_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_RB_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_RB_FS" id="TotalSoft_Poll_3_RB_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_RB_FS_Output" for="TotalSoft_Poll_3_RB_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select that font family which will make your poll more beautiful."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_RB_FF" id="TotalSoft_Poll_3_RB_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_3_RB_Text" name="TotalSoft_Poll_3_RB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_3_RB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                            </option>
								<option value="f1fe"> <?php echo '&#xf1fe' . '&nbsp; ' . 'Area Chart';?>              </option>
								<option value="f0c9"> <?php echo '&#xf0c9' . '&nbsp; &nbsp;' . 'Bars';?>              </option>
								<option value="f1e5"> <?php echo '&#xf1e5' . '&nbsp; &nbsp;' . 'Binoculars';?>        </option>
								<option value="f080"> <?php echo '&#xf080' . '&nbsp; ' . 'Bar Chart';?>               </option>
								<option value="f084"> <?php echo '&#xf084' . '&nbsp; ' . 'Key';?>                     </option>
								<option value="f05a"> <?php echo '&#xf05a' . '&nbsp; &nbsp;' . 'Info Circle';?>       </option>
								<option value="f201"> <?php echo '&#xf201' . '&nbsp; ' . 'Line Chart';?>              </option>
								<option value="f129"> <?php echo '&#xf129' . '&nbsp; &nbsp; &nbsp;' . 'Info';?>       </option>
								<option value="f200"> <?php echo '&#xf200' . '&nbsp; ' . 'Pie Chart';?>               </option>
								<option value="f059"> <?php echo '&#xf059' . '&nbsp; &nbsp;' . 'Question Circle';?>   </option>
								<option value="f128"> <?php echo '&#xf128' . '&nbsp; &nbsp; ' . 'Question';?>         </option>
								<option value="f29c"> <?php echo '&#xf29c' . '&nbsp; &nbsp;' . 'Question Circle O';?> </option>
								<option value="f012"> <?php echo '&#xf012' . '&nbsp; &nbsp;' . 'Signal';?>            </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for result button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_RB_IA" id="TotalSoft_Poll_3_RB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the icon size regardless of the container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_3_RB_IS" id="TotalSoft_Poll_3_RB_IS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_3_RB_IS_Output" for="TotalSoft_Poll_3_RB_IS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select hover background color for result's button in the opinions."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_RB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover color for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_RB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Back Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_BB_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the back button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_BB_Pos" id="TotalSoft_Poll_3_BB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_BB_BC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_BB_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_BB_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_3_BB_Text" name="TotalSoft_Poll_3_BB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_3_BB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                         </option>
								<option value="f00d"> <?php echo '&#xf00d' . '&nbsp; &nbsp;' . 'Times';?>          </option>
								<option value="f015"> <?php echo '&#xf015' . '&nbsp; &nbsp;' . 'Home';?>           </option>
								<option value="f112"> <?php echo '&#xf112' . '&nbsp; &nbsp;' . 'Reply';?>          </option>
								<option value="f021"> <?php echo '&#xf021' . '&nbsp; &nbsp;' . 'Refresh';?>        </option>
								<option value="f100"> <?php echo '&#xf100' . '&nbsp; &nbsp; ' . 'Angle Double';?>  </option>
								<option value="f104"> <?php echo '&#xf104' . '&nbsp; &nbsp; &nbsp;' . 'Angle';?>   </option>
								<option value="f0a8"> <?php echo '&#xf0a8' . '&nbsp; &nbsp;' . 'Arrow Circle';?>   </option>
								<option value="f190"> <?php echo '&#xf190' . '&nbsp; &nbsp;' . 'Arrow Circle O';?> </option>
								<option value="f0d9"> <?php echo '&#xf0d9' . '&nbsp; &nbsp; &nbsp;' . 'Caret';?>   </option>
								<option value="f191"> <?php echo '&#xf191' . '&nbsp; &nbsp;' . 'Caret Square O';?> </option>
								<option value="f137"> <?php echo '&#xf137' . '&nbsp; &nbsp;' . 'Chevron Circle';?> </option>
								<option value="f053"> <?php echo '&#xf053' . '&nbsp; &nbsp;' . 'Chevron';?>        </option>
								<option value="f0a5"> <?php echo '&#xf0a5' . '&nbsp; ' . 'Hand O';?>               </option>
								<option value="f177"> <?php echo '&#xf177' . '&nbsp; ' . 'Long Arrow';?>           </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for back button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_3_BB_IA" id="TotalSoft_Poll_3_BB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select hover background color for back button in the polling."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_BB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select hover color for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_3_BB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="Total_Soft_Poll_AMSetDiv" id="Total_Soft_Poll_TMSetTable_4">
		<div class="Total_Soft_Poll_AMSetDiv_Buttons">
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_4_GO" onclick="TS_Poll_TM_But('4', 'GO')">General Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_4_QO" onclick="TS_Poll_TM_But('4', 'QO')">Question Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_4_AO" onclick="TS_Poll_TM_But('4', 'AO')">Answer Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_4_IO" onclick="TS_Poll_TM_But('4', 'IO')">Image Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_4_PO" onclick="TS_Poll_TM_But('4', 'PO')">Popup Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_4_TV" onclick="TS_Poll_TM_But('4', 'TV')">Total Votes</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_4_VO" onclick="TS_Poll_TM_But('4', 'VO')">Vote Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_4_BO" onclick="TS_Poll_TM_But('4', 'BO')">Button Option</div>
		</div>
		<div class="Total_Soft_Poll_AMSetDiv_Content">
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_4_GO">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">General Options</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Max-Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Define the max width for main container."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_4_MW" id="TotalSoft_Poll_4_MW" min="40" max="100" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_MW_Output" for="TotalSoft_Poll_4_MW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the poll builder: center, right or left."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_Pos" id="TotalSoft_Poll_4_Pos">
							<option value="left">   Left   </option>
							<option value="right">  Right  </option>
							<option value="center"> Center </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Add a border and adjust its width."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_BW" id="TotalSoft_Poll_4_BW" min="0" max="10" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_BW_Output" for="TotalSoft_Poll_4_BW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Pick up a color for the element border."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_4_BC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the radius for the border."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_BR" id="TotalSoft_Poll_4_BR" min="0" max="50" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_BR_Output" for="TotalSoft_Poll_4_BR"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Shadow Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the shadow type."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_4_BoxSh_Type">
							<option value="none">  None      </option>
							<option value="true">  Shadow 1  </option>
							<option value="false"> Shadow 2  </option>
							<option value="sh03">  Shadow 3  </option>
							<option value="sh04">  Shadow 4  </option>
							<option value="sh05">  Shadow 5  </option>
							<option value="sh06">  Shadow 6  </option>
							<option value="sh07">  Shadow 7  </option>
							<option value="sh08">  Shadow 8  </option>
							<option value="sh09">  Shadow 9  </option>
							<option value="sh10">  Shadow 10 </option>
							<option value="sh11">  Shadow 11 </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Shadow Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set the shadow color."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_4_BoxShC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_4_QO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Question Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select a background color where can be seen the question."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_Q_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Adjust the color of the question text in poll builder."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_Q_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the text size for question."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_Q_FS" id="TotalSoft_Poll_4_Q_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_Q_FS_Output" for="TotalSoft_Poll_4_Q_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferable font family for question. Plugin has a fonts base."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_Q_FF" id="TotalSoft_Poll_4_Q_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the text position for social question."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_Q_TA" id="TotalSoft_Poll_4_Q_TA">
								<option value="left">   Left   </option>
								<option value="right">  Right  </option>
								<option value="center"> Center </option>
							</select>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Line After Question</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside poll between question and answers you may have lines or remove them."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_4_LAQ_W" id="TotalSoft_Poll_4_LAQ_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_LAQ_W_Output" for="TotalSoft_Poll_4_LAQ_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_LAQ_H" id="TotalSoft_Poll_4_LAQ_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_LAQ_H_Output" for="TotalSoft_Poll_4_LAQ_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation between the question and answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_LAQ_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_LAQ_S" id="TotalSoft_Poll_4_LAQ_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_4_AO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Answer Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Colors from Main Menu <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This function allows to choose from admin page of the selected color to use for answer color, background color or nothing."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_4_A_CA">
								<option value="Nothing">    For Nothing    </option>
								<option value="Color">      For Color      </option>
								<option value="Background"> For Background </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This option is for the answers. You can select font size."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_A_FS" id="TotalSoft_Poll_4_A_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_A_FS_Output" for="TotalSoft_Poll_4_A_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the main background color of the element where answers is placed."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_A_MBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Use this option to change the background color."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_A_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the font color of element answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_A_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set the width of the borders around the opinion container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_A_BW" id="TotalSoft_Poll_4_A_BW" min="0" max="8" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_A_BW_Output" for="TotalSoft_Poll_4_A_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set the color of the borders around the opinion container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_A_BC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set radius of the borders around answers container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_A_BR" id="TotalSoft_Poll_4_A_BR" min="0" max="10" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_A_BR_Output" for="TotalSoft_Poll_4_A_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferable font family for answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_A_FF" id="TotalSoft_Poll_4_A_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Answer Hover Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Use this option to determine the hover background color for answers field."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_A_HBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the font hover color of answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_A_HC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Line After Answers</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside the poll after answers you may have lines or no."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_4_LAA_W" id="TotalSoft_Poll_4_LAA_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_LAA_W_Output" for="TotalSoft_Poll_4_LAA_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_LAA_H" id="TotalSoft_Poll_4_LAA_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_LAA_H_Output" for="TotalSoft_Poll_4_LAA_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation after answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_LAA_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_LAA_S" id="TotalSoft_Poll_4_LAA_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_4_IO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Image Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="It allows you to specify the prefered height of the image and it is all responsive."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_I_H" id="TotalSoft_Poll_4_I_H" min="20" max="200" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_I_H_Output" for="TotalSoft_Poll_4_I_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Ratio <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="It allows you to specify the prefered ratio of the image."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_I_Ra" id="TotalSoft_Poll_4_I_Ra">
								<option value="1"> 1x1  </option>
								<option value="2"> 16x9 </option>
								<option value="3"> 9x16 </option>
								<option value="4"> 3x4  </option>
								<option value="5"> 4x3  </option>
								<option value="6"> 3x2  </option>
								<option value="7"> 2x3  </option>
								<option value="8"> 8x5  </option>
								<option value="9"> 5x8  </option>
							</select>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Image Hover Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Overlay Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Specify preferred hover background color for the image."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_I_OC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select the icon type of different and beautifully designed sets."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_4_I_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">                  None                                                        </option>
								<option class="TSP1" value="f030"> <?php echo '&#xf030' . '&nbsp; &nbsp;' . 'Camera';?>        </option>
								<option class="TSP1" value="f083"> <?php echo '&#xf083' . '&nbsp; &nbsp;' . 'Camera Retro';?>  </option>
								<option class="TSP1" value="f06e"> <?php echo '&#xf06e' . '&nbsp; &nbsp;' . 'Eye';?>           </option>
								<option class="TSP1" value="f08a"> <?php echo '&#xf08a' . '&nbsp; &nbsp;' . 'Heart O';?>       </option>
								<option class="TSP1" value="f03e"> <?php echo '&#xf03e' . '&nbsp; &nbsp;' . 'Picture O';?>     </option>
								<option class="TSP1" value="f002"> <?php echo '&#xf002' . '&nbsp; &nbsp;' . 'Search';?>        </option>
								<option class="TSP2" value="f04b"> <?php echo '&#xf04b' . '&nbsp; &nbsp;' . 'Play';?>          </option>
								<option class="TSP2" value="f16a"> <?php echo '&#xf16a' . '&nbsp; ' . 'YouTube Play';?>        </option>
								<option class="TSP2" value="f144"> <?php echo '&#xf144' . '&nbsp; &nbsp;' . 'Play Circle';?>   </option>
								<option class="TSP2" value="f01d"> <?php echo '&#xf01d' . '&nbsp; &nbsp;' . 'Play Circle O';?> </option>
								<option class="TSP2" value="f03d"> <?php echo '&#xf03d' . '&nbsp; ' . 'Video Camera';?>        </option>
								<option class="TSP2" value="f26c"> <?php echo '&#xf26c' . '&nbsp; ' . 'Television';?>          </option>
								<option class="TSP2" value="f008"> <?php echo '&#xf008' . '&nbsp; &nbsp;' . 'Film';?>          </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the icon color for image container hovering."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_I_IC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the icon size regardless of the container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_I_IS" id="TotalSoft_Poll_4_I_IS" min="8" max="72" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_I_IS_Output" for="TotalSoft_Poll_4_I_IS"></output>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_4_PO">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Popup Options</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Show Popup <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose whether to have possibility to open with popup or no."></i></div>
					<div class="TS_Poll_Option_Field">
						<div class="switch">
							<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_4_Pop_Show" name="">
							<label for="TotalSoft_Poll_4_Pop_Show" data-on="Yes" data-off="No"></label>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Back Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the 5 types for close: None, Times, Home, Reply or Refresh."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_4_Pop_IT" style="font-family: 'FontAwesome', Arial;">
							<option value="">     None                                                  </option>
							<option value="f00d"> <?php echo '&#xf00d' . '&nbsp; &nbsp;' . 'Times';?>   </option>
							<option value="f015"> <?php echo '&#xf015' . '&nbsp; &nbsp;' . 'Home';?>    </option>
							<option value="f112"> <?php echo '&#xf112' . '&nbsp; &nbsp;' . 'Reply';?>   </option>
							<option value="f021"> <?php echo '&#xf021' . '&nbsp; &nbsp;' . 'Refresh';?> </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Icon Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select a color for the icon in popup."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_4_Pop_IC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select a width for the border in popup."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_Pop_BW" id="TotalSoft_Poll_4_Pop_BW" min="0" max="10" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_Pop_BW_Output" for="TotalSoft_Poll_4_Pop_BW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select a color for the border in popup."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_4_Pop_BC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_4_TV">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Total Votes</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Show <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This function is to show the plugin how many people voted or no."></i></div>
					<div class="TS_Poll_Option_Field">
						<div class="switch">
							<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_4_TV_Show" name="">
							<label for="TotalSoft_Poll_4_TV_Show" data-on="Yes" data-off="No"></label>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the total votes text: right, left or center."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_TV_Pos" id="TotalSoft_Poll_4_TV_Pos">
							<option value="left">   Left   </option>
							<option value="right">  Right  </option>
							<option value="center"> Center </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_4_TV_C" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the total votes."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_TV_FS" id="TotalSoft_Poll_4_TV_FS" min="8" max="48" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_TV_FS_Output" for="TotalSoft_Poll_4_TV_FS"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in total votes."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_4_TV_Text" name="TotalSoft_Poll_4_TV_Text" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the total votes."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_4_VT_IT" style="font-family: 'FontAwesome', Arial;">
							<option value="">     None                                                            </option>
							<option value="f1fe"> <?php echo '&#xf1fe' . '&nbsp; ' . 'Area Chart';?>              </option>
							<option value="f0c9"> <?php echo '&#xf0c9' . '&nbsp; &nbsp;' . 'Bars';?>              </option>
							<option value="f1e5"> <?php echo '&#xf1e5' . '&nbsp; &nbsp;' . 'Binoculars';?>        </option>
							<option value="f080"> <?php echo '&#xf080' . '&nbsp; ' . 'Bar Chart';?>               </option>
							<option value="f084"> <?php echo '&#xf084' . '&nbsp; ' . 'Key';?>                     </option>
							<option value="f05a"> <?php echo '&#xf05a' . '&nbsp; &nbsp;' . 'Info Circle';?>       </option>
							<option value="f201"> <?php echo '&#xf201' . '&nbsp; ' . 'Line Chart';?>              </option>
							<option value="f129"> <?php echo '&#xf129' . '&nbsp; &nbsp; &nbsp;' . 'Info';?>       </option>
							<option value="f200"> <?php echo '&#xf200' . '&nbsp; ' . 'Pie Chart';?>               </option>
							<option value="f059"> <?php echo '&#xf059' . '&nbsp; &nbsp;' . 'Question Circle';?>   </option>
							<option value="f128"> <?php echo '&#xf128' . '&nbsp; &nbsp; ' . 'Question';?>         </option>
							<option value="f29c"> <?php echo '&#xf29c' . '&nbsp; &nbsp;' . 'Question Circle O';?> </option>
							<option value="f012"> <?php echo '&#xf012' . '&nbsp; &nbsp;' . 'Signal';?>            </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for votes (left or right)."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_VT_IA" id="TotalSoft_Poll_4_VT_IA">
							<option value="after">  After Text  </option>
							<option value="before"> Before Text </option>
						</select>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_4_VO">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Vote Option</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Colors from Main Menu <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This function allows to choose from admin page of the selected color to use for answer color, background color or nothing."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_4_V_CA">
							<option value="Nothing">    For Nothing    </option>
							<option value="Color">      For Color      </option>
							<option value="Background"> For Background </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for the answers after voting."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_4_V_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select background color for the answers after voting."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_4_V_BgC" class="Total_Soft_Poll_T_Color_1" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select text color for the answers after voting."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_4_V_C" class="Total_Soft_Poll_T_Color_1" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Vote Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select preferable type for showing your voting."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_4_V_T">
							<option value="percent">    Percent             </option>
							<option value="percentlab"> Label + Percent     </option>
							<option value="count">      Votes Count         </option>
							<option value="countlab">   Label + Votes Count </option>
							<option value="both">       Both                </option>
							<option value="bothlab">    Label + Both        </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Vote Effect <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select preferable effect for showing your voting."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_4_V_Eff">
							<option value="0"> None     </option>
							<option value="1"> Effect 1 </option>
							<option value="2"> Effect 2 </option>
							<option value="3"> Effect 3 </option>
							<option value="4"> Effect 4 </option>
							<option value="5"> Effect 5 </option>
							<option value="6"> Effect 6 </option>
							<option value="7"> Effect 7 </option>
							<option value="8"> Effect 8 </option>
							<option value="9"> Effect 9 </option>
						</select>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_4_BO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Results Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Show <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select whether to see the result button or no."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_4_RB_Show" name="">
								<label for="TotalSoft_Poll_4_RB_Show" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the result's button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_RB_Pos" id="TotalSoft_Poll_4_RB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the result's button border width."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_RB_BW" id="TotalSoft_Poll_4_RB_BW" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_RB_BW_Output" for="TotalSoft_Poll_4_RB_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_RB_BC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Install the border radius for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_RB_BR" id="TotalSoft_Poll_4_RB_BR" min="0" max="30" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_RB_BR_Output" for="TotalSoft_Poll_4_RB_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_RB_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_RB_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_RB_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_RB_FS" id="TotalSoft_Poll_4_RB_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_RB_FS_Output" for="TotalSoft_Poll_4_RB_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select that font family which will make your poll more beautiful."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_RB_FF" id="TotalSoft_Poll_4_RB_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_4_RB_Text" name="TotalSoft_Poll_4_RB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_4_RB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                            </option>
								<option value="f1fe"> <?php echo '&#xf1fe' . '&nbsp; ' . 'Area Chart';?>              </option>
								<option value="f0c9"> <?php echo '&#xf0c9' . '&nbsp; &nbsp;' . 'Bars';?>              </option>
								<option value="f1e5"> <?php echo '&#xf1e5' . '&nbsp; &nbsp;' . 'Binoculars';?>        </option>
								<option value="f080"> <?php echo '&#xf080' . '&nbsp; ' . 'Bar Chart';?>               </option>
								<option value="f084"> <?php echo '&#xf084' . '&nbsp; ' . 'Key';?>                     </option>
								<option value="f05a"> <?php echo '&#xf05a' . '&nbsp; &nbsp;' . 'Info Circle';?>       </option>
								<option value="f201"> <?php echo '&#xf201' . '&nbsp; ' . 'Line Chart';?>              </option>
								<option value="f129"> <?php echo '&#xf129' . '&nbsp; &nbsp; &nbsp;' . 'Info';?>       </option>
								<option value="f200"> <?php echo '&#xf200' . '&nbsp; ' . 'Pie Chart';?>               </option>
								<option value="f059"> <?php echo '&#xf059' . '&nbsp; &nbsp;' . 'Question Circle';?>   </option>
								<option value="f128"> <?php echo '&#xf128' . '&nbsp; &nbsp; ' . 'Question';?>         </option>
								<option value="f29c"> <?php echo '&#xf29c' . '&nbsp; &nbsp;' . 'Question Circle O';?> </option>
								<option value="f012"> <?php echo '&#xf012' . '&nbsp; &nbsp;' . 'Signal';?>            </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for result button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_RB_IA" id="TotalSoft_Poll_4_RB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the icon size regardless of the container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_4_RB_IS" id="TotalSoft_Poll_4_RB_IS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_4_RB_IS_Output" for="TotalSoft_Poll_4_RB_IS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select hover background color for result's button in the opinions."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_RB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover color for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_RB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Back Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_BB_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the back button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_BB_Pos" id="TotalSoft_Poll_4_BB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_BB_BC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_BB_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_BB_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_4_BB_Text" name="TotalSoft_Poll_4_BB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_4_BB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                         </option>
								<option value="f00d"> <?php echo '&#xf00d' . '&nbsp; &nbsp;' . 'Times';?>          </option>
								<option value="f015"> <?php echo '&#xf015' . '&nbsp; &nbsp;' . 'Home';?>           </option>
								<option value="f112"> <?php echo '&#xf112' . '&nbsp; &nbsp;' . 'Reply';?>          </option>
								<option value="f021"> <?php echo '&#xf021' . '&nbsp; &nbsp;' . 'Refresh';?>        </option>
								<option value="f100"> <?php echo '&#xf100' . '&nbsp; &nbsp; ' . 'Angle Double';?>  </option>
								<option value="f104"> <?php echo '&#xf104' . '&nbsp; &nbsp; &nbsp;' . 'Angle';?>   </option>
								<option value="f0a8"> <?php echo '&#xf0a8' . '&nbsp; &nbsp;' . 'Arrow Circle';?>   </option>
								<option value="f190"> <?php echo '&#xf190' . '&nbsp; &nbsp;' . 'Arrow Circle O';?> </option>
								<option value="f0d9"> <?php echo '&#xf0d9' . '&nbsp; &nbsp; &nbsp;' . 'Caret';?>   </option>
								<option value="f191"> <?php echo '&#xf191' . '&nbsp; &nbsp;' . 'Caret Square O';?> </option>
								<option value="f137"> <?php echo '&#xf137' . '&nbsp; &nbsp;' . 'Chevron Circle';?> </option>
								<option value="f053"> <?php echo '&#xf053' . '&nbsp; &nbsp;' . 'Chevron';?>        </option>
								<option value="f0a5"> <?php echo '&#xf0a5' . '&nbsp; ' . 'Hand O';?>               </option>
								<option value="f177"> <?php echo '&#xf177' . '&nbsp; ' . 'Long Arrow';?>           </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for back button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_4_BB_IA" id="TotalSoft_Poll_4_BB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select hover background color for back button in the polling."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_BB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select hover color for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_4_BB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="Total_Soft_Poll_AMSetDiv" id="Total_Soft_Poll_TMSetTable_5">
		<div class="Total_Soft_Poll_AMSetDiv_Buttons">
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_5_GO" onclick="TS_Poll_TM_But('5', 'GO')">General Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_5_QO" onclick="TS_Poll_TM_But('5', 'QO')">Question Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_5_AO" onclick="TS_Poll_TM_But('5', 'AO')">Answer Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_5_TV" onclick="TS_Poll_TM_But('5', 'TV')">Total Votes</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_5_VO" onclick="TS_Poll_TM_But('5', 'VO')">Vote Option</div>
			<div class="Total_Soft_Poll_AMSetDiv_Button" id="TS_Poll_TM_TBut_5_BO" onclick="TS_Poll_TM_But('5', 'BO')">Results & Back Buttons</div>
		</div>
		<div class="Total_Soft_Poll_AMSetDiv_Content">
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_5_GO">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">General Options</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Max-Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Define the max width for main container."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_5_MW" id="TotalSoft_Poll_5_MW" min="40" max="100" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_MW_Output" for="TotalSoft_Poll_5_MW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the poll builder: center, right or left."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_Pos" id="TotalSoft_Poll_5_Pos">
							<option value="left">   Left   </option>
							<option value="right">  Right  </option>
							<option value="center"> Center </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Add a border and adjust its width."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_BW" id="TotalSoft_Poll_5_BW" min="0" max="10" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_BW_Output" for="TotalSoft_Poll_5_BW"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set a color for the element border. "></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_5_BC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the radius for the border."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_BR" id="TotalSoft_Poll_5_BR" min="0" max="50" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_BR_Output" for="TotalSoft_Poll_5_BR"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Shadow Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the shadow type."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_BoxSh_Type">
							<option value="none">  None      </option>
							<option value="true">  Shadow 1  </option>
							<option value="false"> Shadow 2  </option>
							<option value="sh03">  Shadow 3  </option>
							<option value="sh04">  Shadow 4  </option>
							<option value="sh05">  Shadow 5  </option>
							<option value="sh06">  Shadow 6  </option>
							<option value="sh07">  Shadow 7  </option>
							<option value="sh08">  Shadow 8  </option>
							<option value="sh09">  Shadow 9  </option>
							<option value="sh10">  Shadow 10 </option>
							<option value="sh11">  Shadow 11 </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Shadow Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set the shadow color."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_5_BoxShC" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_5_QO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Question Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select a background color where can be seen the question."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_Q_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Adjust the color of the question text in poll builder."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_Q_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the text size on question by pixels."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_Q_FS" id="TotalSoft_Poll_5_Q_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_Q_FS_Output" for="TotalSoft_Poll_5_Q_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferable font family for question. Plugin has a fonts base."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_Q_FF" id="TotalSoft_Poll_5_Q_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the text position for social question."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_Q_TA" id="TotalSoft_Poll_5_Q_TA">
								<option value="left">   Left   </option>
								<option value="right">  Right  </option>
								<option value="center"> Center </option>
							</select>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Line After Question</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside social poll between question and answers you may have lines or remove them."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_5_LAQ_W" id="TotalSoft_Poll_5_LAQ_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_LAQ_W_Output" for="TotalSoft_Poll_5_LAQ_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_LAQ_H" id="TotalSoft_Poll_5_LAQ_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_LAQ_H_Output" for="TotalSoft_Poll_5_LAQ_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation between the question and answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_LAQ_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_LAQ_S" id="TotalSoft_Poll_5_LAQ_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1 TSPVIQ">Video in Question</div>
					<div class="TS_Poll_Option_Div1 TSPVIQ">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="It allows you to specify the prefered width for video."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_5_V_W" id="TotalSoft_Poll_5_V_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_V_W_Output" for="TotalSoft_Poll_5_V_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1 TSPIIQ">Image in Question</div>
					<div class="TS_Poll_Option_Div1 TSPIIQ">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="It allows you to specify the prefered height for image."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_I_H" id="TotalSoft_Poll_5_I_H" min="20" max="500" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_I_H_Output" for="TotalSoft_Poll_5_I_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 TSPIIQ">
						<div class="TS_Poll_Option_Name">Ratio <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="It allows you to specify the prefered ratio of the image."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_I_Ra" id="TotalSoft_Poll_5_I_Ra">
								<option value="1"> 1x1  </option>
								<option value="2"> 16x9 </option>
								<option value="3"> 9x16 </option>
								<option value="4"> 3x4  </option>
								<option value="5"> 4x3  </option>
								<option value="6"> 3x2  </option>
								<option value="7"> 2x3  </option>
								<option value="8"> 8x5  </option>
								<option value="9"> 5x8  </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_5_AO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Answer Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Colors from Main Menu <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This function allows to choose from admin page of the selected color to use for answer color, background color or nothing."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_A_CA">
								<option value="Nothing">    For Nothing    </option>
								<option value="Color">      For Color      </option>
								<option value="Background"> For Background </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This option is for the answers. You can select font size."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_A_FS" id="TotalSoft_Poll_5_A_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_A_FS_Output" for="TotalSoft_Poll_5_A_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the main background color of the element where answers is placed."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_A_MBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Use this option to change the background color."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_A_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the font color of element answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_A_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the width of the borders around the opinion container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_A_BW" id="TotalSoft_Poll_5_A_BW" min="0" max="8" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_A_BW_Output" for="TotalSoft_Poll_5_A_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the color of the borders around the opinion container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_A_BC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Set radius of the borders around answers container."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_A_BR" id="TotalSoft_Poll_5_A_BR" min="0" max="10" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_A_BR_Output" for="TotalSoft_Poll_5_A_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the font for the poll answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_BoxSh" id="TotalSoft_Poll_5_BoxSh">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Answer Hover Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Use this option to change the hover background color."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_A_HBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the font hover color for element answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_A_HC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Checkbox Options</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="The poll builder plugin allows to get most suitable check box that are most appropriate for your site. Select 4 different types for size."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_CH_S" id="TotalSoft_Poll_5_CH_S">
								<option value="small">    Small    </option>
								<option value="medium 1"> Medium 1 </option>
								<option value="medium 2"> Medium 2 </option>
								<option value="big">      Big      </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Type Before Checking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This field be used for selecting the values from a list of checkboxes."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_CH_TBC" style="font-family: 'FontAwesome', Arial;">
								<option value="f10c"> <?php echo '&#xf10c' . '&nbsp; ' . 'Circle O';?>       </option>
								<option value="f111"> <?php echo '&#xf111' . '&nbsp; ' . 'Circle';?>         </option>
								<option value="f096"> <?php echo '&#xf096' . '&nbsp; ' . 'Square O';?>       </option>
								<option value="f0c8"> <?php echo '&#xf0c8' . '&nbsp; ' . 'Square';?>         </option>
								<option value="f147"> <?php echo '&#xf147' . '&nbsp; ' . 'Minus Square O';?> </option>
								<option value="f146"> <?php echo '&#xf146' . '&nbsp; ' . 'Minus Square';?>   </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color Before Checking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select color for checkbox before checking."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_CH_CBC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Type After Clicking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This field be used for selecting the values from a list of checkboxes."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_CH_TAC" style="font-family: 'FontAwesome', Arial;">
								<option value="f00c"> <?php echo '&#xf00c' . '&nbsp; ' . 'Check';?>          </option>
								<option value="f058"> <?php echo '&#xf058' . '&nbsp; ' . 'Check Circle';?>   </option>
								<option value="f05d"> <?php echo '&#xf05d' . '&nbsp; ' . 'Check Circle O';?> </option>
								<option value="f14a"> <?php echo '&#xf14a' . '&nbsp; ' . 'Check Square';?>   </option>
								<option value="f046"> <?php echo '&#xf046' . '&nbsp; ' . 'Check Square O';?> </option>
								<option value="f111"> <?php echo '&#xf111' . '&nbsp; ' . 'Circle';?>         </option>
								<option value="f192"> <?php echo '&#xf192' . '&nbsp; ' . 'Dot Circle O';?>   </option>
								<option value="f196"> <?php echo '&#xf196' . '&nbsp; ' . 'Plus Square O';?>  </option>
								<option value="f0fe"> <?php echo '&#xf0fe' . '&nbsp; ' . 'Plus Square';?>    </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color After Clicking <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select color for checkbox after checking."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_CH_CAC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles Total_Soft_Poll_TMTitles1">Line After Answers</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Inside the poll after answer you may have lines or remove them."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangeper" name="TotalSoft_Poll_5_LAA_W" id="TotalSoft_Poll_5_LAA_W" min="0" max="100" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_LAA_W_Output" for="TotalSoft_Poll_5_LAA_W"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Height <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose the height for separation line."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_LAA_H" id="TotalSoft_Poll_5_LAA_H" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_LAA_H_Output" for="TotalSoft_Poll_5_LAA_H"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select your preferred color to show the line of separation after answers."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_LAA_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Style <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Identify the basic style of the line and you can change it at any time. Select 4 different types of line: solid, dotted, dashed, none."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_LAA_S" id="TotalSoft_Poll_5_LAA_S">
								<option value="none">   None   </option>
								<option value="solid">  Solid  </option>
								<option value="dotted"> Dotted </option>
								<option value="dashed"> Dashed </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div" id="Total_Soft_Poll_AMSetTable_5_TV">
				<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Total Votes</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Show <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose to show total votes or no."></i></div>
					<div class="TS_Poll_Option_Field">
						<div class="switch">
							<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_5_TV_Show" name="">
							<label for="TotalSoft_Poll_5_TV_Show" data-on="Yes" data-off="No"></label>
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the total votes text: right, left or center."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_TV_Pos" id="TotalSoft_Poll_5_TV_Pos">
							<option value="left">   Left   </option>
							<option value="right">  Right  </option>
							<option value="center"> Center </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" name="" id="TotalSoft_Poll_5_TV_C" class="Total_Soft_Poll_T_Color" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the total votes."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_TV_FS" id="TotalSoft_Poll_5_TV_FS" min="8" max="48" value="">
						<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_TV_FS_Output" for="TotalSoft_Poll_5_TV_FS"></output>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in total votes."></i></div>
					<div class="TS_Poll_Option_Field">
						<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_5_TV_Text" name="TotalSoft_Poll_5_TV_Text" value="">
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the total votes."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_VT_IT" style="font-family: 'FontAwesome', Arial;">
							<option value="">     None                                                            </option>
							<option value="f1fe"> <?php echo '&#xf1fe' . '&nbsp; ' . 'Area Chart';?>              </option>
							<option value="f0c9"> <?php echo '&#xf0c9' . '&nbsp; &nbsp;' . 'Bars';?>              </option>
							<option value="f1e5"> <?php echo '&#xf1e5' . '&nbsp; &nbsp;' . 'Binoculars';?>        </option>
							<option value="f080"> <?php echo '&#xf080' . '&nbsp; ' . 'Bar Chart';?>               </option>
							<option value="f084"> <?php echo '&#xf084' . '&nbsp; ' . 'Key';?>                     </option>
							<option value="f05a"> <?php echo '&#xf05a' . '&nbsp; &nbsp;' . 'Info Circle';?>       </option>
							<option value="f201"> <?php echo '&#xf201' . '&nbsp; ' . 'Line Chart';?>              </option>
							<option value="f129"> <?php echo '&#xf129' . '&nbsp; &nbsp; &nbsp;' . 'Info';?>       </option>
							<option value="f200"> <?php echo '&#xf200' . '&nbsp; ' . 'Pie Chart';?>               </option>
							<option value="f059"> <?php echo '&#xf059' . '&nbsp; &nbsp;' . 'Question Circle';?>   </option>
							<option value="f128"> <?php echo '&#xf128' . '&nbsp; &nbsp; ' . 'Question';?>         </option>
							<option value="f29c"> <?php echo '&#xf29c' . '&nbsp; &nbsp;' . 'Question Circle O';?> </option>
							<option value="f012"> <?php echo '&#xf012' . '&nbsp; &nbsp;' . 'Signal';?>            </option>
						</select>
					</div>
				</div>
				<div class="TS_Poll_Option_Div1">
					<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for total votes (left or right)."></i></div>
					<div class="TS_Poll_Option_Field">
						<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_VT_IA" id="TotalSoft_Poll_5_VT_IA">
							<option value="after">  After Text  </option>
							<option value="before"> Before Text </option>
						</select>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_5_VO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Vote Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Show <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose whether to show voting button in the container or no."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_5_VB_Show" name="">
								<label for="TotalSoft_Poll_5_VB_Show" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_VB_Pos" id="TotalSoft_Poll_5_VB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the vote button's border width."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_VB_BW" id="TotalSoft_Poll_5_VB_BW" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_VB_BW_Output" for="TotalSoft_Poll_5_VB_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_VB_BC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Install the border radius for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_VB_BR" id="TotalSoft_Poll_5_VB_BR" min="0" max="30" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_VB_BR_Output" for="TotalSoft_Poll_5_VB_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_VB_MBgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_VB_BgC" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_VB_C" class="Total_Soft_Poll_T_Color" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_VB_FS" id="TotalSoft_Poll_5_VB_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_VB_FS_Output" for="TotalSoft_Poll_5_VB_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select that font family which will make your social poll more beautiful."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_VB_FF" id="TotalSoft_Poll_5_VB_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_5_VB_Text" name="TotalSoft_Poll_5_VB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_VB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                         </option>
								<option value="f123"> <?php echo '&#xf123' . '&nbsp; ' . 'Star Half O';?>          </option>
								<option value="f0a1"> <?php echo '&#xf0a1' . '&nbsp; ' . 'Bullhorn';?>             </option>
								<option value="f0e5"> <?php echo '&#xf0e5' . '&nbsp; ' . 'Comment O';?>            </option>
								<option value="f06e"> <?php echo '&#xf06e' . '&nbsp; ' . 'Eye';?>                  </option>
								<option value="f0fb"> <?php echo '&#xf0fb' . '&nbsp; ' . 'Fighter Jet';?>          </option>
								<option value="f25a"> <?php echo '&#xf25a' . '&nbsp; ' . 'Hand Pointer O';?>       </option>
								<option value="f1d9"> <?php echo '&#xf1d9' . '&nbsp; ' . 'Paper Plane O';?>        </option>
								<option value="f124"> <?php echo '&#xf124' . '&nbsp; &nbsp;' . 'Location Arrow';?> </option>
								<option value="f1d8"> <?php echo '&#xf1d8' . '&nbsp; ' . 'Paper Plane';?>          </option>
								<option value="f005"> <?php echo '&#xf005' . '&nbsp; ' . 'Star';?>                 </option>
								<option value="f006"> <?php echo '&#xf006' . '&nbsp; ' . 'Star O';?>               </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for vote button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_VB_IA" id="TotalSoft_Poll_5_VB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the icon size regardless of the container. The plugin allows to get most suitable icon that are most appropriate for your site."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_VB_IS" id="TotalSoft_Poll_5_VB_IS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_VB_IS_Output" for="TotalSoft_Poll_5_VB_IS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select hover background color for vote button in the poll."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_VB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover color for vote button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_VB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Vote Option</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Colors from Main Menu <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="This function allows to choose from admin page of the selected color to use for answer color, background color or nothing."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_V_CA">
								<option value="Nothing">    For Nothing    </option>
								<option value="Color">      For Color      </option>
								<option value="Background"> For Background </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for the answers after voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_V_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select background color for the answers after voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_V_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select text color for the answers after voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_V_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Vote Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select preferable type for showing your voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_V_T">
								<option value="percent">    Percent             </option>
								<option value="percentlab"> Label + Percent     </option>
								<option value="count">      Votes Count         </option>
								<option value="countlab">   Label + Votes Count </option>
								<option value="both">       Both                </option>
								<option value="bothlab">    Label + Both        </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Vote Effect <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select preferable effect for showing your voting."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_V_Eff">
								<option value="0"> None     </option>
								<option value="1"> Effect 1 </option>
								<option value="2"> Effect 2 </option>
								<option value="3"> Effect 3 </option>
								<option value="4"> Effect 4 </option>
								<option value="5"> Effect 5 </option>
								<option value="6"> Effect 6 </option>
								<option value="7"> Effect 7 </option>
								<option value="8"> Effect 8 </option>
								<option value="9"> Effect 9 </option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="TS_Poll_Option_Div TS_Poll_Option_Divv" id="Total_Soft_Poll_AMSetTable_5_BO">
				<div class="TS_Poll_Option_Divv1">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Results Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Show <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select whether to see the result button or no."></i></div>
						<div class="TS_Poll_Option_Field">
							<div class="switch">
								<input class="cmn-toggle cmn-toggle-yes-no" type="checkbox" id="TotalSoft_Poll_5_RB_Show" name="">
								<label for="TotalSoft_Poll_5_RB_Show" data-on="Yes" data-off="No"></label>
							</div>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the result button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_RB_Pos" id="TotalSoft_Poll_5_RB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Width <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the result button's border width."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_RB_BW" id="TotalSoft_Poll_5_RB_BW" min="0" max="5" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_RB_BW_Output" for="TotalSoft_Poll_5_RB_BW"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_RB_BC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Radius <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Install the border radius for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_RB_BR" id="TotalSoft_Poll_5_RB_BR" min="0" max="30" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_RB_BR_Output" for="TotalSoft_Poll_5_RB_BR"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_RB_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_RB_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font size for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_RB_FS" id="TotalSoft_Poll_5_RB_FS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_RB_FS_Output" for="TotalSoft_Poll_5_RB_FS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Font Family <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select that font family which will make your social poll more beautiful."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_RB_FF" id="TotalSoft_Poll_5_RB_FF">
								<?php for($i = 0; $i < count($TotalSoftFontGCount); $i++) { ?>
									<option value='<?php echo $TotalSoftFontGCount[$i];?>' style="font-family: <?php echo $TotalSoftFontGCount[$i];?>;"><?php echo $TotalSoftFontCount[$i];?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_5_RB_Text" name="TotalSoft_Poll_5_RB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_RB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                            </option>
								<option value="f1fe"> <?php echo '&#xf1fe' . '&nbsp; ' . 'Area Chart';?>              </option>
								<option value="f0c9"> <?php echo '&#xf0c9' . '&nbsp; &nbsp;' . 'Bars';?>              </option>
								<option value="f1e5"> <?php echo '&#xf1e5' . '&nbsp; &nbsp;' . 'Binoculars';?>        </option>
								<option value="f080"> <?php echo '&#xf080' . '&nbsp; ' . 'Bar Chart';?>               </option>
								<option value="f084"> <?php echo '&#xf084' . '&nbsp; ' . 'Key';?>                     </option>
								<option value="f05a"> <?php echo '&#xf05a' . '&nbsp; &nbsp;' . 'Info Circle';?>       </option>
								<option value="f201"> <?php echo '&#xf201' . '&nbsp; ' . 'Line Chart';?>              </option>
								<option value="f129"> <?php echo '&#xf129' . '&nbsp; &nbsp; &nbsp;' . 'Info';?>       </option>
								<option value="f200"> <?php echo '&#xf200' . '&nbsp; ' . 'Pie Chart';?>               </option>
								<option value="f059"> <?php echo '&#xf059' . '&nbsp; &nbsp;' . 'Question Circle';?>   </option>
								<option value="f128"> <?php echo '&#xf128' . '&nbsp; &nbsp; ' . 'Question';?>         </option>
								<option value="f29c"> <?php echo '&#xf29c' . '&nbsp; &nbsp;' . 'Question Circle O';?> </option>
								<option value="f012"> <?php echo '&#xf012' . '&nbsp; &nbsp;' . 'Signal';?>            </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon alignment for result button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_RB_IA" id="TotalSoft_Poll_5_RB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Size <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Change the icon size regardless of the container. The plugin allows to get most suitable icon that are most appropriate for your site."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="range" class="TotalSoft_Poll_Range TotalSoft_Poll_Rangepx" name="TotalSoft_Poll_5_RB_IS" id="TotalSoft_Poll_5_RB_IS" min="8" max="48" value="">
							<output class="TotalSoft_Poll_Out" name="" id="TotalSoft_Poll_5_RB_IS_Output" for="TotalSoft_Poll_5_RB_IS"></output>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover background color for result button in the opinions."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_RB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select font hover color for result button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_RB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
				<div class="TS_Poll_Option_Divv2">
					<div class="TS_Poll_Option_Div1 Total_Soft_Poll_TMTitles">Back Button</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Main Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the main background color which is designed for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_BB_MBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Position <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Make a choice among the 3 positions for the back button: right, left or full."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_BB_Pos" id="TotalSoft_Poll_5_BB_Pos">
								<option value="left">  Left       </option>
								<option value="right"> Right      </option>
								<option value="full">  Full Width </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Border Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the border color which is in the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_BB_BC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Determine the background color which is designed for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_BB_BgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select the font color for the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_BB_C" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Text <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Enter the text that should be in back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" class="Total_Soft_Poll_Select" id="TotalSoft_Poll_5_BB_Text" name="TotalSoft_Poll_5_BB_Text" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Type <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="You can select icons from a variety of beautifully designed sets for the back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="" id="TotalSoft_Poll_5_BB_IT" style="font-family: 'FontAwesome', Arial;">
								<option value="">     None                                                         </option>
								<option value="f00d"> <?php echo '&#xf00d' . '&nbsp; &nbsp;' . 'Times';?>          </option>
								<option value="f015"> <?php echo '&#xf015' . '&nbsp; &nbsp;' . 'Home';?>           </option>
								<option value="f112"> <?php echo '&#xf112' . '&nbsp; &nbsp;' . 'Reply';?>          </option>
								<option value="f021"> <?php echo '&#xf021' . '&nbsp; &nbsp;' . 'Refresh';?>        </option>
								<option value="f100"> <?php echo '&#xf100' . '&nbsp; &nbsp; ' . 'Angle Double';?>  </option>
								<option value="f104"> <?php echo '&#xf104' . '&nbsp; &nbsp; &nbsp;' . 'Angle';?>   </option>
								<option value="f0a8"> <?php echo '&#xf0a8' . '&nbsp; &nbsp;' . 'Arrow Circle';?>   </option>
								<option value="f190"> <?php echo '&#xf190' . '&nbsp; &nbsp;' . 'Arrow Circle O';?> </option>
								<option value="f0d9"> <?php echo '&#xf0d9' . '&nbsp; &nbsp; &nbsp;' . 'Caret';?>   </option>
								<option value="f191"> <?php echo '&#xf191' . '&nbsp; &nbsp;' . 'Caret Square O';?> </option>
								<option value="f137"> <?php echo '&#xf137' . '&nbsp; &nbsp;' . 'Chevron Circle';?> </option>
								<option value="f053"> <?php echo '&#xf053' . '&nbsp; &nbsp;' . 'Chevron';?>        </option>
								<option value="f0a5"> <?php echo '&#xf0a5' . '&nbsp; ' . 'Hand O';?>               </option>
								<option value="f177"> <?php echo '&#xf177' . '&nbsp; ' . 'Long Arrow';?>           </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Icon Align <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Choose icon to align for back button (left or right)."></i></div>
						<div class="TS_Poll_Option_Field">
							<select class="Total_Soft_Poll_Select" name="TotalSoft_Poll_5_BB_IA" id="TotalSoft_Poll_5_BB_IA">
								<option value="after">  After Text  </option>
								<option value="before"> Before Text </option>
							</select>
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Background Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select hover background color for back button in the polling."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_BB_HBgC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
					<div class="TS_Poll_Option_Div1">
						<div class="TS_Poll_Option_Name">Hover Color <span class="TS_Free_version_Span">(Pro)</span> <i class="Total_Soft_Poll_Help1 totalsoft totalsoft-question-circle-o" title="Select hover color for back button."></i></div>
						<div class="TS_Poll_Option_Field">
							<input type="text" name="" id="TotalSoft_Poll_5_BB_HC" class="Total_Soft_Poll_T_Color_1" value="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>