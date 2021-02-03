function Total_Soft_Poll_1_Ans_Fix_Close(overlay, el){
	overlay.style.height = 0;
	jQuery("."+el).css("width","0");
}

function Total_Soft_Poll_1_Ans_Fix_Close2(el, overlay){
	el.style.width = 0;
	jQuery("."+overlay).css("height","0");
}

function Total_Soft_Poll_Upcoming(Poll_ID)
{
	var datereal = new Date(),
	currentMonth = datereal.getMonth() + 1,
	currentYear = datereal.getFullYear(),
	currentDay = datereal.getDate();

	var TotalSoft_Poll_Set_02 = jQuery('#TotalSoft_Poll_Set_02_'+Poll_ID).val();
	var datestart = new Date(TotalSoft_Poll_Set_02),
	startMonth = datestart.getMonth() + 1,
	startYear = datestart.getFullYear(),
	startDay = datestart.getDate();

	var Total_Soft_Poll_Upcoming_Bool = false;
	if(currentYear < startYear)
	{
		Total_Soft_Poll_Upcoming_Bool = true;
	}
	else if(currentYear == startYear)
	{
		if(currentMonth < startMonth)
		{
			Total_Soft_Poll_Upcoming_Bool = true;
		}
		else if (currentMonth == startMonth)
		{
			if(currentDay < startDay)
			{
				Total_Soft_Poll_Upcoming_Bool = true;
			}
		}
	}

	if(Total_Soft_Poll_Upcoming_Bool === true)
	{
		jQuery('.TotalSoftPoll_Ans_ComingSoon_'+Poll_ID).css('display','block');
	}
	else
	{
		jQuery('.TotalSoftPoll_Ans_ComingSoon_'+Poll_ID).css('display','none');
	}
}
function Total_Soft_Poll_End_Poll(Poll_ID, Poll_Type)
{
	var datereal = new Date(),
	currentMonth = datereal.getMonth() + 1,
	currentYear = datereal.getFullYear(),
	currentDay = datereal.getDate();

	var TotalSoft_Poll_Set_03 = jQuery('#TotalSoft_Poll_Set_03_'+Poll_ID).val();
	var dateend = new Date(TotalSoft_Poll_Set_03),
	endMonth = dateend.getMonth() + 1,
	endYear = dateend.getFullYear(),
	endDay = dateend.getDate();

	var Total_Soft_Poll_End_Bool = false;
	if(currentYear > endYear)
	{
		Total_Soft_Poll_End_Bool = true;
	}
	else if(currentYear == endYear)
	{
		if(currentMonth > endMonth)
		{
			Total_Soft_Poll_End_Bool = true;
		}
		else if (currentMonth == endMonth)
		{
			if(currentDay > endDay)
			{
				Total_Soft_Poll_End_Bool = true;
			}
		}
	}

	if(Total_Soft_Poll_End_Bool === true)
	{
		if(Poll_Type == 'Standart')
		{
			Total_Soft_Poll_Ans_Div1(Poll_ID);
		}
		else if(Poll_Type == 'Image/Video')
		{
			Total_Soft_Poll_Ans_DivIm1(Poll_ID);
		}
		else if(Poll_Type == 'StandartWB')
		{
			Total_Soft_Poll_Ans_DivSt1(Poll_ID);
		}
		else if(Poll_Type == 'ImageWB/VideoWB')
		{
			Total_Soft_Poll_Ans_DivIV1(Poll_ID);
		}
		else if(Poll_Type == 'ImageIQ/VideoIQ')
		{
			Total_Soft_Poll_Ans_DivSt1(Poll_ID);
		}
	}
}


function Total_Soft_Poll_1_But_Vote(Poll_ID,event){
	// var Poll_ID = jQuery("#TotalSoft_Poll_1_ID").val();
	var voteOnce = jQuery("#TotalSoft_Poll_1_Vote").val();
	if(window.localStorage.getItem("tot_selected"+Poll_ID) && voteOnce=="true"){
		jQuery("#Total_Soft_Poll_1_But_Vote_"+Poll_ID).remove();
		return;
	}
	var TotalSoft_Poll_Set_01 = jQuery('#TotalSoft_Poll_Set_01_'+Poll_ID).val();
	var TotalSoft_Poll_Set_05 = jQuery('#TotalSoft_Poll_Set_05_'+Poll_ID).val();
	var Total_Soft_Poll_1_Ans_ID = '';
	if(jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).find('.Total_Soft_Poll_1_Ans_Check_Div').find('input').attr('type') == 'radio')
	{
		jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).find('.Total_Soft_Poll_1_Ans_Check_Div').find('input[type=radio]').each(function(){
			if(jQuery(this).attr('checked') || this.checked)
			{
				Total_Soft_Poll_1_Ans_ID = jQuery(this).val();
			}
		})
	}
	else if(jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).find('.Total_Soft_Poll_1_Ans_Check_Div').find('input').attr('type') == 'checkbox')
	{
		jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).find('.Total_Soft_Poll_1_Ans_Check_Div').find('input[type=checkbox]').each(function(){
			if(jQuery(this).attr('checked'))
			{
				Total_Soft_Poll_1_Ans_ID += jQuery(this).val() + '^*^';
			}
		})
	}

	if(Total_Soft_Poll_1_Ans_ID != '')
	{
		
		var e;
		event && event.type ? e=event.type : e="";
		jQuery.ajax({
			type: 'POST',
			url: object.ajaxurl,
			data: {
				action: 'TotalSoftPoll_1_Vote', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
				foobar: Total_Soft_Poll_1_Ans_ID, // translates into $_POST['foobar'] in PHP
				voteOnce: voteOnce,
				variable: e
			},
			beforeSend: function(){
				jQuery('.Total_Soft_Poll_1_Main_Div_'+Poll_ID + ' .TotalSoftPoll_Ans_loading').css('display','block');
			},
			success: function(response){
				jQuery('.Total_Soft_Poll_1_Main_Div_'+Poll_ID + ' .TotalSoftPoll_Ans_loading').css('display','none');
				var b=Array();
				var sumb = 0;
				var a=response.split('s] =>');
				for(var i=1;i<a.length;i++)
				{ b[b.length]=a[i].split(')')[0].trim(); }

				for(var i=0;i<b.length;i++)
				{ sumb += parseInt(b[i]); }

				var pvb = jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp3_'+Poll_ID).html();

				if(TotalSoft_Poll_Set_01 == 'true' || TotalSoft_Poll_Set_01 == '')
				{
					if(pvb.indexOf('%') > 0 && pvb.indexOf('(') > 0 && pvb.indexOf(')') > 0)
					{
						for(var i=0;i<b.length;i++)
						{
							jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp2_'+Poll_ID+'_'+i).css('width', parseFloat(parseInt(b[i])*100/sumb).toFixed(2)+'%');
							jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp3_'+Poll_ID+'_'+i).html(b[i]+ ' ( '+ parseFloat(parseInt(b[i])*100/sumb).toFixed(2)+' % )');
						}
					}
					else if(pvb.indexOf('%') > 0)
					{
						for(var i=0;i<b.length;i++)
						{
							jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp2_'+Poll_ID+'_'+i).css('width', parseFloat(parseInt(b[i])*100/sumb).toFixed(2)+'%');
							jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp3_'+Poll_ID+'_'+i).html(parseFloat(parseInt(b[i])*100/sumb).toFixed(2)+' %');
						}
					}
					else
					{
						for(var i=0;i<b.length;i++)
						{
							jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp2_'+Poll_ID+'_'+i).css('width', parseFloat(parseInt(b[i])*100/sumb).toFixed(2)+'%');
							jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp3_'+Poll_ID+'_'+i).html(b[i]);
						}
					}
				}
				else
				{
					for(var i=0;i<b.length;i++)
					{
						jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp2_'+Poll_ID+'_'+i).css('width', '100%');
						jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp3_'+Poll_ID+'_'+i).html(TotalSoft_Poll_Set_05);
					}
				}
				Total_Soft_Poll_Ans_Div(Poll_ID);
				jQuery("#Total_Soft_Poll_1_But_Vote_"+Poll_ID).remove();
				window.localStorage.setItem("tot_selected"+Poll_ID,"Yes")
			}
		});
	}
}


function Total_Soft_Poll_Ans_Div(Poll_ID)
{
	var TotalSoft_Poll_1_P_ShPop = jQuery('#TotalSoft_Poll_1_P_ShPop_'+Poll_ID).val();
	if( TotalSoft_Poll_1_P_ShPop == 'false' )
	{
		Total_Soft_Poll_Ans_Div1(Poll_ID);
	}
	else
	{
		Total_Soft_Poll_Ans_Div2(Poll_ID);
	}
}
function Total_Soft_Poll_Ans_Div1(Poll_ID)
{
	var TotalSoft_Poll_1_P_ShEff = jQuery('#TotalSoft_Poll_1_P_ShEff_'+Poll_ID).val();
	var TotalSoft_Poll_1_MW = jQuery('#TotalSoft_Poll_1_MW_'+Poll_ID).val();
	var TotalSoft_Poll_1_BR = jQuery('#TotalSoft_Poll_1_BR_'+Poll_ID).val();
	var TotalSoft_Poll_1_P_BW = jQuery('#TotalSoft_Poll_1_P_BW_'+Poll_ID).val();

	var TotalSoft_Poll_Set_01 = jQuery('#TotalSoft_Poll_Set_01_'+Poll_ID).val();
	var TotalSoft_Poll_Set_05 = jQuery('#TotalSoft_Poll_Set_05_'+Poll_ID).val();
	
	if(TotalSoft_Poll_Set_01 == 'false')
	{
		jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp2_'+Poll_ID).css('width', '100%');
		jQuery('.Total_Soft_Poll_1_Ans_Lab_Sp3_'+Poll_ID).html(TotalSoft_Poll_Set_05);
	}

	if( TotalSoft_Poll_1_P_ShEff == 'FTTB' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'translateY(0px)','-ms-transform': 'translateY(0px)', '-o-transform': 'translateY(0px)','-moz-transform': 'translateY(0px)','-webkit-transform': 'translateY(0px)','opacity':'1'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FLTR' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'translateX(0px)','-ms-transform': 'translateX(0px)', '-o-transform': 'translateX(0px)','-moz-transform': 'translateX(0px)','-webkit-transform': 'translateX(0px)'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FRTL' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'translateX(0px)','-ms-transform': 'translateX(0px)', '-o-transform': 'translateX(0px)','-moz-transform': 'translateX(0px)','-webkit-transform': 'translateX(0px)'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FCTA' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).animate({top: '0%', left: parseInt(100 - parseInt(TotalSoft_Poll_1_MW))/2 + '%', width: TotalSoft_Poll_1_MW + '%', height: '100%', borderRadius: TotalSoft_Poll_1_BR + 'px', borderWidth: TotalSoft_Poll_1_P_BW + 'px' },500);
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FTL' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'rotateY(0deg)','-ms-transform': 'rotateY(0deg)', '-o-transform': 'rotateY(0deg)','-moz-transform': 'rotateY(0deg)','-webkit-transform': 'rotateY(0deg)'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FTR' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'rotateX(0deg)','-ms-transform': 'rotateX(0deg)', '-o-transform': 'rotateX(0deg)','-moz-transform': 'rotateX(0deg)','-webkit-transform': 'rotateX(0deg)'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FBL' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'rotate(0deg)','-ms-transform': 'rotate(0deg)', '-o-transform': 'rotate(0deg)','-moz-transform': 'rotate(0deg)','-webkit-transform': 'rotate(0deg)', 'z-index': '9999'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FBR' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'skewX(0deg)','-ms-transform': 'skewX(0deg)', '-o-transform': 'skewX(0deg)','-moz-transform': 'skewX(0deg)','-webkit-transform': 'skewX(0deg)'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FBTT' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'skewY(0deg)','-ms-transform': 'skewY(0deg)', '-o-transform': 'skewY(0deg)','-moz-transform': 'skewY(0deg)','-webkit-transform': 'skewY(0deg)'});
	}
	jQuery('.Total_Soft_Poll_1_Main_Ans_Div_'+Poll_ID+ ' .Total_Soft_Poll_1_LAA_Div_'+Poll_ID).fadeOut(500);
	jQuery('.Total_Soft_Poll_1_Main_Ans_Div_'+Poll_ID+ ' .Total_Soft_Poll_1_But_MDiv_'+Poll_ID).fadeOut(500);
	jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).css('height','inherit');
}
function Total_Soft_Poll_Ans_Div2(Poll_ID)
{
	var TotalSoft_Poll_1_BR = jQuery('#TotalSoft_Poll_1_BR_'+Poll_ID).val();
	var TotalSoft_Poll_1_P_BW = jQuery('#TotalSoft_Poll_1_P_BW_'+Poll_ID).val();
	var TotalSoft_Poll_1_P_ShEff = jQuery('#TotalSoft_Poll_1_P_ShEff_'+Poll_ID).val();
	if( TotalSoft_Poll_1_P_ShEff == 'FTTB' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
		jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'translateY(0px)','-ms-transform': 'translateY(0px)', '-o-transform': 'translateY(0px)','-moz-transform': 'translateY(0px)','-webkit-transform': 'translateY(0px)', 'opacity':'1'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FLTR' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
		jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'translateX(0px)','-ms-transform': 'translateX(0px)', '-o-transform': 'translateX(0px)','-moz-transform': 'translateX(0px)','-webkit-transform': 'translateX(0px)'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FRTL' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
		jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'translateX(0px)','-ms-transform': 'translateX(0px)', '-o-transform': 'translateX(0px)','-moz-transform': 'translateX(0px)','-webkit-transform': 'translateX(0px)'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FCTA' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
		jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).animate({maxWidth: '750px' , width: '100%', height: '100%', borderRadius: TotalSoft_Poll_1_BR + 'px', borderWidth: TotalSoft_Poll_1_P_BW + 'px' },500);
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css('position', 'relative');
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FTL' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
		jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'rotateY(0deg)','-ms-transform': 'rotateY(0deg)', '-o-transform': 'rotateY(0deg)','-moz-transform': 'rotateY(0deg)','-webkit-transform': 'rotateY(0deg)'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FTR' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
		jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'rotateX(0deg)','-ms-transform': 'rotateX(0deg)', '-o-transform': 'rotateX(0deg)','-moz-transform': 'rotateX(0deg)','-webkit-transform': 'rotateX(0deg)'});
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FBL' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'rotate(0deg)','-ms-transform': 'rotate(0deg)', '-o-transform': 'rotate(0deg)','-moz-transform': 'rotate(0deg)','-webkit-transform': 'rotate(0deg)', 'opacity': '1'});
		jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
		jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FBR' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'skewX(0deg)','-ms-transform': 'skewX(0deg)', '-o-transform': 'skewX(0deg)','-moz-transform': 'skewX(0deg)','-webkit-transform': 'skewX(0deg)'});
		jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
		jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
	}
	else if( TotalSoft_Poll_1_P_ShEff == 'FBTT' )
	{
		jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'skewY(0deg)','-ms-transform': 'skewY(0deg)', '-o-transform': 'skewY(0deg)','-moz-transform': 'skewY(0deg)','-webkit-transform': 'skewY(0deg)'});
		jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
		jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
	}
	jQuery('.Total_Soft_Poll_1_Main_Ans_Div_Fix_'+Poll_ID+ ' .Total_Soft_Poll_1_LAA_Div_'+Poll_ID).css('display','none');
	jQuery('.Total_Soft_Poll_1_Main_Ans_Div_Fix_'+Poll_ID+ ' .Total_Soft_Poll_1_But_MDiv_'+Poll_ID).css('display','none');
	jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).css('height','inherit');
}
function Total_Soft_Poll_1_Result(Poll_ID)
{
	var TotalSoft_Poll_1_P_ShPop = jQuery('#TotalSoft_Poll_1_P_ShPop_'+Poll_ID).val();
	var TotalSoft_Poll_1_P_ShEff = jQuery('#TotalSoft_Poll_1_P_ShEff_'+Poll_ID).val();
	var TotalSoft_Poll_1_MW = jQuery('#TotalSoft_Poll_1_MW_'+Poll_ID).val();
	var TotalSoft_Poll_1_BR = jQuery('#TotalSoft_Poll_1_BR_'+Poll_ID).val();
	var TotalSoft_Poll_1_P_BW = jQuery('#TotalSoft_Poll_1_P_BW_'+Poll_ID).val();
	var TotalSoft_Poll_1_Pos = jQuery('#TotalSoft_Poll_1_Pos_'+Poll_ID).val();
	if( TotalSoft_Poll_1_P_ShPop == 'false')
	{
		if( TotalSoft_Poll_1_P_ShEff == 'FTTB' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'translateY(0px)','-ms-transform': 'translateY(0px)', '-o-transform': 'translateY(0px)','-moz-transform': 'translateY(0px)','-webkit-transform': 'translateY(0px)', 'opacity':'1'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FLTR' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'translateX(0px)','-ms-transform': 'translateX(0px)', '-o-transform': 'translateX(0px)','-moz-transform': 'translateX(0px)','-webkit-transform': 'translateX(0px)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FRTL' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'translateX(0px)','-ms-transform': 'translateX(0px)', '-o-transform': 'translateX(0px)','-moz-transform': 'translateX(0px)','-webkit-transform': 'translateX(0px)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FCTA' )
		{
			if( TotalSoft_Poll_1_Pos == 'left' )
			{
				jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).animate({ width: TotalSoft_Poll_1_MW + '%', left: '0%', height: '100%', top: '0%', borderRadius: TotalSoft_Poll_1_BR + 'px', borderWidth: TotalSoft_Poll_1_P_BW + 'px' },500);
			}
			else if( TotalSoft_Poll_1_Pos == 'right' )
			{
				jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).animate({ width: TotalSoft_Poll_1_MW + '%', right: '0%', height: '100%', top: '0%', borderRadius: TotalSoft_Poll_1_BR + 'px', borderWidth: TotalSoft_Poll_1_P_BW + 'px' },500);
			}
			else
			{
				jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).animate({ width: TotalSoft_Poll_1_MW + '%', left: parseInt(100 - parseInt(TotalSoft_Poll_1_MW))/2 + '%', height: '100%', top: '0%', borderRadius: TotalSoft_Poll_1_BR + 'px', borderWidth: TotalSoft_Poll_1_P_BW + 'px' },500);
			}
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FTL' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'rotateY(0deg)','-ms-transform': 'rotateY(0deg)', '-o-transform': 'rotateY(0deg)','-moz-transform': 'rotateY(0deg)','-webkit-transform': 'rotateY(0deg)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FTR' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'rotateX(0deg)','-ms-transform': 'rotateX(0deg)', '-o-transform': 'rotateX(0deg)','-moz-transform': 'rotateX(0deg)','-webkit-transform': 'rotateX(0deg)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBL' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'rotate(0deg)','-ms-transform': 'rotate(0deg)', '-o-transform': 'rotate(0deg)','-moz-transform': 'rotate(0deg)','-webkit-transform': 'rotate(0deg)', 'z-index': '9999'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBR' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'skewX(0deg)','-ms-transform': 'skewX(0deg)', '-o-transform': 'skewX(0deg)','-moz-transform': 'skewX(0deg)','-webkit-transform': 'skewX(0deg)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBTT' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'skewY(0deg)','-ms-transform': 'skewY(0deg)', '-o-transform': 'skewY(0deg)','-moz-transform': 'skewY(0deg)','-webkit-transform': 'skewY(0deg)'});
		}
	}
	else
	{
		if( TotalSoft_Poll_1_P_ShEff == 'FTTB' )
		{
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
			jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'translateY(0px)','-ms-transform': 'translateY(0px)', '-o-transform': 'translateY(0px)','-moz-transform': 'translateY(0px)','-webkit-transform': 'translateY(0px)', 'opacity':'1'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FLTR' )
		{
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
			jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'translateX(0px)','-ms-transform': 'translateX(0px)', '-o-transform': 'translateX(0px)','-moz-transform': 'translateX(0px)','-webkit-transform': 'translateX(0px)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FRTL' )
		{
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
			jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'translateX(0px)','-ms-transform': 'translateX(0px)', '-o-transform': 'translateX(0px)','-moz-transform': 'translateX(0px)','-webkit-transform': 'translateX(0px)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FCTA' )
		{
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
			jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).animate({maxWidth: '750px' , width: '100%', height: '100%', borderRadius: TotalSoft_Poll_1_BR + 'px', borderWidth: TotalSoft_Poll_1_P_BW + 'px' },500);
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css('position', 'relative');
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FTL' )
		{
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
			jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'rotateY(0deg)','-ms-transform': 'rotateY(0deg)', '-o-transform': 'rotateY(0deg)','-moz-transform': 'rotateY(0deg)','-webkit-transform': 'rotateY(0deg)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FTR' )
		{
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
			jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'rotateX(0deg)','-ms-transform': 'rotateX(0deg)', '-o-transform': 'rotateX(0deg)','-moz-transform': 'rotateX(0deg)','-webkit-transform': 'rotateX(0deg)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBL' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'rotate(0deg)','-ms-transform': 'rotate(0deg)', '-o-transform': 'rotate(0deg)','-moz-transform': 'rotate(0deg)','-webkit-transform': 'rotate(0deg)', 'opacity': '1'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
			jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBR' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'skewX(0deg)','-ms-transform': 'skewX(0deg)', '-o-transform': 'skewX(0deg)','-moz-transform': 'skewX(0deg)','-webkit-transform': 'skewX(0deg)'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
			jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBTT' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'skewY(0deg)','-ms-transform': 'skewY(0deg)', '-o-transform': 'skewY(0deg)','-moz-transform': 'skewY(0deg)','-webkit-transform': 'skewY(0deg)'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '100%'},300);
			jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','100%');
		}
	}
}
function Total_Soft_Poll_1_Back(Poll_ID)
{
	var TotalSoft_Poll_1_P_ShPop = jQuery('#TotalSoft_Poll_1_P_ShPop_'+Poll_ID).val();
	var TotalSoft_Poll_1_P_ShEff = jQuery('#TotalSoft_Poll_1_P_ShEff_'+Poll_ID).val();
	var TotalSoft_Poll_1_MW = jQuery('#TotalSoft_Poll_1_MW_'+Poll_ID).val();
	var TotalSoft_Poll_1_Pos = jQuery('#TotalSoft_Poll_1_Pos_'+Poll_ID).val();

	if( TotalSoft_Poll_1_P_ShPop == 'false')
	{
		if( TotalSoft_Poll_1_P_ShEff == 'FTTB' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'translateY(-12000px)','-ms-transform': 'translateY(-12000px)', '-o-transform': 'translateY(-12000px)','-moz-transform': 'translateY(-12000px)','-webkit-transform': 'translateY(-12000px)','opacity':'0'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FLTR' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'translateX(-12000px)','-ms-transform': 'translateX(-12000px)', '-o-transform': 'translateX(-12000px)','-moz-transform': 'translateX(-12000px)','-webkit-transform': 'translateX(-12000px)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FRTL' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'translateX(12000px)','-ms-transform': 'translateX(12000px)', '-o-transform': 'translateX(12000px)','-moz-transform': 'translateX(12000px)','-webkit-transform': 'translateX(12000px)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FCTA' )
		{
			if( TotalSoft_Poll_1_Pos == 'left' )
			{
				jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).animate({width: '0', height: '0', left: parseInt(50 - parseInt(100 - parseInt(TotalSoft_Poll_1_MW))/2) + '%', top: '50%', borderRadius: '0px', borderWidth: '0px' },100);
			}
			else if( TotalSoft_Poll_1_Pos == 'right' )
			{
				jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).animate({width: '0', height: '0', right: parseInt(50 - parseInt(100 - parseInt(TotalSoft_Poll_1_MW))/2) + '%', top: '50%', borderRadius: '0px', borderWidth: '0px' },100);
			}
			else
			{
				jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).animate({width: '0', height: '0', left: '50%', top: '50%', borderRadius: '0px', borderWidth: '0px' },100);
			}
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FTL' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'rotateY(-90deg)','-ms-transform': 'rotateY(-90deg)', '-o-transform': 'rotateY(-90deg)','-moz-transform': 'rotateY(-90deg)','-webkit-transform': 'rotateY(-90deg)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FTR' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'rotateX(-90deg)','-ms-transform': 'rotateX(-90deg)', '-o-transform': 'rotateX(-90deg)','-moz-transform': 'rotateX(-90deg)','-webkit-transform': 'rotateX(-90deg)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBL' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'rotate(-180deg)','-ms-transform': 'rotate(-180deg)', '-o-transform': 'rotate(-180deg)','-moz-transform': 'rotate(-180deg)','-webkit-transform': 'rotate(-180deg)', 'z-index': '-1'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBR' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'skewX(90deg)','-ms-transform': 'skewX(90deg)', '-o-transform': 'skewX(90deg)','-moz-transform': 'skewX(90deg)','-webkit-transform': 'skewX(90deg)'});
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBTT' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_"+Poll_ID).css({'transform':'skewY(90deg)','-ms-transform': 'skewY(90deg)', '-o-transform': 'skewY(90deg)','-moz-transform': 'skewY(90deg)','-webkit-transform': 'skewY(90deg)'});
		}
	}
	else
	{
		if( TotalSoft_Poll_1_P_ShEff == 'FTTB' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'translateY(-12000px)','-ms-transform': 'translateY(-12000px)', '-o-transform': 'translateY(-12000px)','-moz-transform': 'translateY(-12000px)','-webkit-transform': 'translateY(-12000px)','opacity':'1'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '0%'},300);
			setTimeout(function(){
				jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','0%');
			},200)
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FLTR' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'translateX(-12000px)','-ms-transform': 'translateX(-12000px)', '-o-transform': 'translateX(-12000px)','-moz-transform': 'translateX(-12000px)','-webkit-transform': 'translateX(-12000px)'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '0%'},300);
			setTimeout(function(){
				jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','0%');
			},200)
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FRTL' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'translateX(12000px)','-ms-transform': 'translateX(12000px)', '-o-transform': 'translateX(12000px)','-moz-transform': 'translateX(12000px)','-webkit-transform': 'translateX(12000px)'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '0%'},300);
			setTimeout(function(){
				jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','0%');
			},200)
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FCTA' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).animate({width: '0%', height: '0%', borderRadius: '0px', borderWidth: '0px' },500);
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '0%'},300);
			setTimeout(function(){
				jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css('position', 'absolute');
				jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','0%');
			},200)
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FTL' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'rotateY(-90deg)','-ms-transform': 'rotateY(-90deg)', '-o-transform': 'rotateY(-90deg)','-moz-transform': 'rotateY(-90deg)','-webkit-transform': 'rotateY(-90deg)'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '0%'},300);
			setTimeout(function(){
				jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','0%');
			},400)
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FTR' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'rotateX(-90deg)','-ms-transform': 'rotateX(-90deg)', '-o-transform': 'rotateX(-90deg)','-moz-transform': 'rotateX(-90deg)','-webkit-transform': 'rotateX(-90deg)'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '0%'},300);
			setTimeout(function(){
				jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','0%');
			},600)
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBL' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'rotate(-180deg)','-ms-transform': 'rotate(-180deg)', '-o-transform': 'rotate(-180deg)','-moz-transform': 'rotate(-180deg)','-webkit-transform': 'rotate(-180deg)', 'opacity': '0'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '0%'},300);
			setTimeout(function(){
				jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','0%');
			},600)
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBR' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'skewX(90deg)','-ms-transform': 'skewX(90deg)', '-o-transform': 'skewX(90deg)','-moz-transform': 'skewX(90deg)','-webkit-transform': 'skewX(90deg)'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '0%'},300);
			setTimeout(function(){
				jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','0%');
			},600)
		}
		else if( TotalSoft_Poll_1_P_ShEff == 'FBTT' )
		{
			jQuery(".Total_Soft_Poll_1_Main_Ans_Div_Fix_"+Poll_ID).css({'transform':'skewY(90deg)','-ms-transform': 'skewY(90deg)', '-o-transform': 'skewY(90deg)','-moz-transform': 'skewY(90deg)','-webkit-transform': 'skewY(90deg)'});
			jQuery(".Total_Soft_Poll_1_Ans_Fix_"+Poll_ID).animate({height: '0%'},300);
			setTimeout(function(){
				jQuery(".Total_Soft_Poll_1_Ans_Fix_1_"+Poll_ID).css('width','0%');
			},600)
		}
	}
}

function Total_Soft_Poll_2_But_Vote(Poll_ID, event){

	// var Poll_ID = this.dataset.id;
	// var voteOnce = this.dataset.vote;
	var voteOnce = jQuery("#TotalSoft_Poll_Vote").val();

	if(window.localStorage.getItem("tot_selected"+Poll_ID) && voteOnce=="true"){
		jQuery("#Total_Soft_Poll_1_But_Vote_"+Poll_ID).remove();
		return;
	}
	var TotalSoft_Poll_Set_01 = jQuery('#TotalSoft_Poll_Set_01_'+Poll_ID).val();
	var TotalSoft_Poll_Set_05 = jQuery('#TotalSoft_Poll_Set_05_'+Poll_ID).val();
	var Total_Soft_Poll_1_Ans_ID = '';
	if(jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).find('.Total_Soft_Poll_1_Ans_Check_Div').find('input').attr('type') == 'radio')
	{
		jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).find('.Total_Soft_Poll_1_Ans_Check_Div').find('input[type=radio]').each(function(){
			if(jQuery(this).attr('checked'))
			{
				Total_Soft_Poll_1_Ans_ID = jQuery(this).val();
			}
		})
	}
	else if(jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).find('.Total_Soft_Poll_1_Ans_Check_Div').find('input').attr('type') == 'checkbox')
	{
		jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).find('.Total_Soft_Poll_1_Ans_Check_Div').find('input[type=checkbox]').each(function(){
			if(jQuery(this).attr('checked'))
			{
				Total_Soft_Poll_1_Ans_ID += jQuery(this).val() + '^*^';
			}
		})
	}
	if(Total_Soft_Poll_1_Ans_ID != '')
	{
		var e;
		event && event.type ? e=event.type : e="";
		jQuery.ajax({
			type: 'POST',
			url: object.ajaxurl,
			data: {
				action: 'TotalSoftPoll_1_Vote', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
				foobar: Total_Soft_Poll_1_Ans_ID, // translates into $_POST['foobar'] in PHP
				voteOnce: voteOnce,
				variable: e
			},
			beforeSend: function(){
				jQuery('.Total_Soft_Poll_1_Main_Div_'+Poll_ID + ' .TotalSoftPoll_Ans_loading').css('display','block');
			},
			success: function(response){
				jQuery('.Total_Soft_Poll_1_Main_Div_'+Poll_ID + ' .TotalSoftPoll_Ans_loading').css('display','none');
				var b=Array();
				var sumb = 0;
				var a=response.split('s] =>');
				for(var i=1;i<a.length;i++)
				{ b[b.length]=a[i].split(')')[0].trim(); }

				for(var i=0;i<b.length;i++)
				{ sumb += parseInt(b[i]); }

				var pvb = jQuery('.Total_Soft_Poll_1_Ans_Div_Ov_Lab1_'+Poll_ID).html();

				if(TotalSoft_Poll_Set_01 == 'true' || TotalSoft_Poll_Set_01 == '')
				{
					if(pvb.indexOf('%') > 0 && pvb.indexOf('(') > 0 && pvb.indexOf(')') > 0)
					{
						for(var i=0;i<b.length;i++)
						{
							jQuery('.Total_Soft_Poll_1_Ans_Div_Ov_Lab1_'+Poll_ID+'_'+i).html(b[i]+ ' ( '+ parseFloat(parseInt(b[i])*100/sumb).toFixed(2)+' % )');
						}
					}
					else if(pvb.indexOf('%') > 0)
					{
						for(var i=0;i<b.length;i++)
						{
							jQuery('.Total_Soft_Poll_1_Ans_Div_Ov_Lab1_'+Poll_ID+'_'+i).html(parseFloat(parseInt(b[i])*100/sumb).toFixed(2)+' %');
						}
					}
					else
					{
						for(var i=0;i<b.length;i++)
						{
							jQuery('.Total_Soft_Poll_1_Ans_Div_Ov_Lab1_'+Poll_ID+'_'+i).html(b[i]);
						}
					}
				}
				else
				{
					for(var i=0;i<b.length;i++)
					{
						jQuery('.Total_Soft_Poll_1_Ans_Div_Ov_Lab1_'+Poll_ID+'_'+i).html(TotalSoft_Poll_Set_05);
					}
				}
				Total_Soft_Poll_Ans_DivIm1(Poll_ID);
				
				jQuery("#Total_Soft_Poll_1_But_Vote_"+Poll_ID).remove();
				window.localStorage.setItem("tot_selected"+Poll_ID,"Yes")
			}
		});
	}
}	


function Total_Soft_Poll_2_Result(Poll_ID)
{
	jQuery('.Total_Soft_Poll_1_BBut_MDiv_'+Poll_ID).css('z-index','9999');
	jQuery('.Total_Soft_Poll_1_BBut_MDiv_'+Poll_ID).animate({'opacity':'1'},500);
	var TotalSoft_Poll_2_P_A_VEff = jQuery('#TotalSoft_Poll_2_P_A_VEff_' + Poll_ID).val();

	var TotalSoft_Poll_Set_01 = jQuery('#TotalSoft_Poll_Set_01_'+Poll_ID).val();
	var TotalSoft_Poll_Set_05 = jQuery('#TotalSoft_Poll_Set_05_'+Poll_ID).val();

	if(TotalSoft_Poll_Set_01 == 'false')
	{
		jQuery('.Total_Soft_Poll_1_Ans_Div_Ov_Lab1_'+Poll_ID).html(TotalSoft_Poll_Set_05);
	}

	if( TotalSoft_Poll_2_P_A_VEff == '0' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Div_Overlay_" + Poll_ID).css('display','block');
	}
	else if( TotalSoft_Poll_2_P_A_VEff == '1' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Check_Div_BO_" + Poll_ID).css({'transform':'rotateY(-90deg)','-ms-transform': 'rotateY(-90deg)', '-o-transform': 'rotateY(-90deg)','-moz-transform': 'rotateY(-90deg)','-webkit-transform': 'rotateY(-90deg)'});
		setTimeout(function(){
			jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Check_Div_BO_" + Poll_ID).css({'transform':'rotateY(0deg)','-ms-transform': 'rotateY(0deg)', '-o-transform': 'rotateY(0deg)','-moz-transform': 'rotateY(0deg)','-webkit-transform': 'rotateY(0deg)'});
			jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Div_Overlay_" + Poll_ID).css({'transform':'rotateY(0deg)','-ms-transform': 'rotateY(0deg)', '-o-transform': 'rotateY(0deg)','-moz-transform': 'rotateY(0deg)','-webkit-transform': 'rotateY(0deg)'});
		},500)
	}
	else if( TotalSoft_Poll_2_P_A_VEff == '2' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Check_Div_BO_" + Poll_ID).css({'transform':'rotateX(-90deg)','-ms-transform': 'rotateX(-90deg)', '-o-transform': 'rotateX(-90deg)','-moz-transform': 'rotateX(-90deg)','-webkit-transform': 'rotateX(-90deg)'});
		setTimeout(function(){
			jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Check_Div_BO_" + Poll_ID).css({'transform':'rotateX(0deg)','-ms-transform': 'rotateX(0deg)', '-o-transform': 'rotateX(0deg)','-moz-transform': 'rotateX(0deg)','-webkit-transform': 'rotateX(0deg)'});
			jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Div_Overlay_" + Poll_ID).css({'transform':'rotateX(0deg)','-ms-transform': 'rotateX(0deg)', '-o-transform': 'rotateX(0deg)','-moz-transform': 'rotateX(0deg)','-webkit-transform': 'rotateX(0deg)'});
		},500)
	}
}
function Total_Soft_Poll_2_Back(Poll_ID)
{
	jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'0'},500);
	setTimeout(function(){
		jQuery('.Total_Soft_Poll_1_BBut_MDiv_'+Poll_ID).css('z-index','-1');
	},500)
	var TotalSoft_Poll_2_P_A_VEff = jQuery('#TotalSoft_Poll_2_P_A_VEff_' + Poll_ID).val();
	if( TotalSoft_Poll_2_P_A_VEff == '0' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Div_Overlay_" + Poll_ID).css('display','none');
	}
	else if( TotalSoft_Poll_2_P_A_VEff == '1' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Check_Div_BO_" + Poll_ID).css({'transform':'rotateY(-90deg)','-ms-transform': 'rotateY(-90deg)', '-o-transform': 'rotateY(-90deg)','-moz-transform': 'rotateY(-90deg)','-webkit-transform': 'rotateY(-90deg)'});
		jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Div_Overlay_" + Poll_ID).css({'transform':'rotateY(-90deg)','-ms-transform': 'rotateY(-90deg)', '-o-transform': 'rotateY(-90deg)','-moz-transform': 'rotateY(-90deg)','-webkit-transform': 'rotateY(-90deg)'});
		setTimeout(function(){
		jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Check_Div_BO_" + Poll_ID).css({'transform':'rotateY(0deg)','-ms-transform': 'rotateY(0deg)', '-o-transform': 'rotateY(0deg)','-moz-transform': 'rotateY(0deg)','-webkit-transform': 'rotateY(0deg)'});
		},500)
	}
	else if( TotalSoft_Poll_2_P_A_VEff == '2' )
	{
		jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Check_Div_BO_" + Poll_ID).css({'transform':'rotateX(-90deg)','-ms-transform': 'rotateX(-90deg)', '-o-transform': 'rotateX(-90deg)','-moz-transform': 'rotateX(-90deg)','-webkit-transform': 'rotateX(-90deg)'});
		jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Div_Overlay_" + Poll_ID).css({'transform':'rotateX(-90deg)','-ms-transform': 'rotateX(-90deg)', '-o-transform': 'rotateX(-90deg)','-moz-transform': 'rotateX(-90deg)','-webkit-transform': 'rotateX(-90deg)'});
		setTimeout(function(){
		jQuery(".Total_Soft_Poll_1_Ans_Div_" + Poll_ID + " .Total_Soft_Poll_1_Ans_Check_Div_BO_" + Poll_ID).css({'transform':'rotateX(0deg)','-ms-transform': 'rotateX(0deg)', '-o-transform': 'rotateX(0deg)','-moz-transform': 'rotateX(0deg)','-webkit-transform': 'rotateX(0deg)'});
		},500)
	}
}
function Total_Soft_Poll_Ans_DivIm1(Poll_ID)
{
	Total_Soft_Poll_2_Result(Poll_ID);
	jQuery('.Total_Soft_Poll_1_Div_Cook_' + Poll_ID).css('z-index','999999');
}
function Total_Soft_Poll_Video_Hove(Poll_ID, Div_Num)
{
	jQuery('.Total_Soft_Poll_1_Ans_Div_Play_Overlay_' + Poll_ID + '_' + Div_Num).show();
}
function Total_Soft_Poll_Video_Out(Poll_ID, Div_Num)
{
	jQuery('.Total_Soft_Poll_1_Ans_Div_Play_Overlay_' + Poll_ID + '_' + Div_Num).hide();
}
function Total_Soft_Poll_Video_Play(Poll_ID, Video_Src)
{
	jQuery('.Total_Soft_Poll_1_Ans_Fix_' + Poll_ID).show();
	jQuery('.Total_Soft_Poll_1_Ans_Fix_1_' + Poll_ID + ' iframe').attr('src',Video_Src);
	setTimeout(function(){
		jQuery('.Total_Soft_Poll_1_Ans_Fix_1_' + Poll_ID).show();
	},300)
}
function Total_Soft_Poll_Video_Close(Poll_ID)
{
	jQuery('.Total_Soft_Poll_1_Ans_Fix_1_' + Poll_ID).hide();
	setTimeout(function(){
		jQuery('.Total_Soft_Poll_1_Ans_Fix_' + Poll_ID).hide();
		jQuery('.Total_Soft_Poll_1_Ans_Fix_1_' + Poll_ID + ' iframe').attr('src','');
	},300)
}
function Total_Soft_Poll_Ans_DivSt1(Poll_ID) // Poll 3 Vote
{
	Total_Soft_Poll_3_Result(Poll_ID);
	jQuery('.Total_Soft_Poll_1_Div_Cook_' + Poll_ID).css('z-index','999999');
}



function Total_Soft_Poll_1_Ans_Lab(Total_Soft_Poll_1_Ans_ID, Poll_ID, event){
	// var Poll_ID = jQuery("#TotalSoft_Poll_3_ID").val()
	var voteOnce = jQuery("#TotalSoft_Poll_3_Vote").val()
	if( window.localStorage.getItem("tot_selected"+Poll_ID) && voteOnce == "true"){
		jQuery(".Total_Soft_Poll_1_Ans_Lab_"+Poll_ID).remove();
		return;
	}
	var TotalSoft_Poll_Set_01 = jQuery('#TotalSoft_Poll_Set_01_'+Poll_ID).val();
	var TotalSoft_Poll_Set_05 = jQuery('#TotalSoft_Poll_Set_05_'+Poll_ID).val();
	var e;
	event && event.type ? e = event.type : e="";
	jQuery.ajax({
		type: 'POST',
		url: object.ajaxurl,
		data: {
			action: 'TotalSoftPoll_1_Vote', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
			foobar: Total_Soft_Poll_1_Ans_ID, // translates into $_POST['foobar'] in PHP
			voteOnce: voteOnce,
			variable: e
		},
		beforeSend: function(){
			jQuery('.Total_Soft_Poll_1_Main_Div_'+Poll_ID + ' .TotalSoftPoll_Ans_loading').css('display','block');
		},
		success: function(response){
			jQuery('.Total_Soft_Poll_1_Main_Div_'+Poll_ID + ' .TotalSoftPoll_Ans_loading').css('display','none');
			var b=Array();
			var sumb = 0;
			var a=response.split('s] =>');
			for(var i=1;i<a.length;i++)
			{ b[b.length]=a[i].split(')')[0].trim(); }

			for(var i=0;i<b.length;i++)
			{ sumb += parseInt(b[i]); }

			var pvb = jQuery('.Total_Soft_Poll_3_Span4_'+Poll_ID).html();

			if(TotalSoft_Poll_Set_01 == 'true' || TotalSoft_Poll_Set_01 == '')
			{
				if( pvb.indexOf('%') > 0 && pvb.indexOf('(') > 0 && pvb.indexOf(')') > 0 )
				{
					for(var i = 0; i < b.length; i++)
					{
						jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(b[i] + ' ( ' + parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + ' % )');
					}
				}
				else if( pvb.indexOf('%') > 0 )
				{
					for(var i = 0; i < b.length; i++)
					{
						jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + ' %');
					}
				}
				else
				{
					for(var i=0;i<b.length;i++)
					{
						jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(b[i]);
					}
				}
				jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).css('z-index','9999');
				jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'1'},500);
				jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).css('z-index','9999');
				jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).animate({'opacity':'1'},500);
				var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();

				for(var i = 0; i < b.length; i++)
				{
					if( TotalSoft_Poll_3_V_Eff == '1' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '2' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span5_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '3' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span6_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '4' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span7_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '5' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span8_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '6' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span9_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '7' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span10_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '8' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span11_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '9' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span12_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
				}
			}
			else
			{
				for(var i=0;i<b.length;i++)
				{
					jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(TotalSoft_Poll_Set_05);
				}
				jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).css('z-index','9999');
				jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'1'},500);
				jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).css('z-index','9999');
				jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).animate({'opacity':'1'},500);
				var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();
				for(var i = 0; i < b.length; i++)
				{
					if( TotalSoft_Poll_3_V_Eff == '1' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '2' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span5_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '3' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span6_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '4' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span7_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '5' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span8_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '6' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span9_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '7' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span10_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '8' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span11_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '9' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span12_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
				}
			}
			jQuery(".Total_Soft_Poll_1_Ans_Lab_"+Poll_ID).remove();
			window.localStorage.setItem("tot_selected"+Poll_ID,"yes");
		}
	});
	jQuery('.Total_Soft_Poll_1_Div_Cook_' + Poll_ID).css('z-index','999999');

}

function Total_Soft_Poll_3_Vote(Poll_ID, Total_Soft_Poll_1_Ans_ID, voteOnce)
{
	
}
function Total_Soft_Poll_3_Back(Poll_ID)
{
	jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'0'},500);
	jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).animate({'opacity':'0'},500);
	var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();

	setTimeout(function(){
		jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).css('z-index','-1');
		jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).css('z-index','-1');
		if( TotalSoft_Poll_3_V_Eff != '0' )
		{
			jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID).css('width','0');
		}
	},500)
}
function Total_Soft_Poll_3_Result(Poll_ID)
{
	jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).css('z-index','9999');
	jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'1'},500);
	jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).css('z-index','9999');
	jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).animate({'opacity':'1'},500);
	var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();
	var TotalSoftPoll_Ans_C = jQuery('#TotalSoftPoll_Ans_C_' + Poll_ID).val();

	var TotalSoft_Poll_Set_01 = jQuery('#TotalSoft_Poll_Set_01_'+Poll_ID).val();
	var TotalSoft_Poll_Set_05 = jQuery('#TotalSoft_Poll_Set_05_'+Poll_ID).val();
	if(TotalSoft_Poll_Set_01 == 'false')
	{
		jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID).html(TotalSoft_Poll_Set_05);
	}

	var ajaxurl = object.ajaxurl;
	var data = {
	action: 'TotalSoftPoll_1_Results', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
	foobar: Poll_ID, // translates into $_POST['foobar'] in PHP
	};
	jQuery.post(ajaxurl, data, function(response) {
		var b = Array();
		var sumb = 0;
		var a = response.split('s] =>');
		for( var i = 1; i < a.length; i++ )
		{ b[b.length] = a[i].split(')')[0].trim(); }

		for( var i = 0; i < b.length; i++)
		{ sumb += parseInt(b[i]); }
		var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();

		if(TotalSoft_Poll_Set_01 == 'false')
		{
			for(var i = 0; i < b.length; i++)
			{
				if( TotalSoft_Poll_3_V_Eff == '1' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '2' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span5_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '3' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span6_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '4' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span7_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '5' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span8_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '6' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span9_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '7' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span10_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '8' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span11_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '9' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span12_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
			}
		}
		else
		{
			for(var i = 0; i < b.length; i++)
			{
				if( TotalSoft_Poll_3_V_Eff == '1' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '2' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span5_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '3' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span6_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '4' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span7_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '5' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span8_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '6' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span9_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '7' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span10_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '8' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span11_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '9' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span12_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
			}
		}
	})
}

// Poll 4 Vote

function Total_Soft_Poll_1_Ans_Check_Div2(Total_Soft_Poll_1_Ans_ID, Poll_ID, event){
	var voteOnce = jQuery("#TotalSoft_Poll_3_IV_Vote").val();
	if(window.localStorage.getItem("tot_selected"+Poll_ID) && voteOnce == "true"){
		jQuery(".Total_Soft_Poll_1_Ans_Check_Div2_" + Poll_ID).remove();
		return;
	}
	var TotalSoft_Poll_Set_01 = jQuery('#TotalSoft_Poll_Set_01_'+Poll_ID).val();
	var TotalSoft_Poll_Set_05 = jQuery('#TotalSoft_Poll_Set_05_'+Poll_ID).val();
	var e;
	event && event.type ? e = event.type : e = "";

	jQuery.ajax({
		type: 'POST',
		url: object.ajaxurl,
		data: {
			action: 'TotalSoftPoll_1_Vote', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
			foobar: Total_Soft_Poll_1_Ans_ID, // translates into $_POST['foobar'] in PHP
			voteOnce: voteOnce,
			variable: e
		},
		beforeSend: function(){
			jQuery('.Total_Soft_Poll_1_Main_Div_'+Poll_ID + ' .TotalSoftPoll_Ans_loading').css('display','block');
		},
		success: function(response){
			jQuery('.Total_Soft_Poll_1_Main_Div_'+Poll_ID + ' .TotalSoftPoll_Ans_loading').css('display','none');
			var b=Array();
			var sumb = 0;
			var a=response.split('s] =>');
			for(var i=1;i<a.length;i++)
			{ b[b.length]=a[i].split(')')[0].trim(); }

			for(var i=0;i<b.length;i++)
			{ sumb += parseInt(b[i]); }

			var pvb = jQuery('.Total_Soft_Poll_3_Span4_'+Poll_ID).html();

			if(TotalSoft_Poll_Set_01 == 'true' || TotalSoft_Poll_Set_01 == '')
			{
				if( pvb.indexOf('%') > 0 && pvb.indexOf('(') > 0 && pvb.indexOf(')') > 0 )
				{
					for(var i = 0; i < b.length; i++)
					{
						jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(b[i] + ' ( ' + parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + ' % )');
					}
				}
				else if( pvb.indexOf('%') > 0 )
				{
					for(var i = 0; i < b.length; i++)
					{
						jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + ' %');
					}
				}
				else
				{
					for(var i=0;i<b.length;i++)
					{
						jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(b[i]);
					}
				}
				jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).css('z-index','999');
				jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'1'},500);
				jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).css('z-index','9999');
				jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).animate({'opacity':'1'},500);

				jQuery('.Total_Soft_Poll_1_Ans_Div_' + Poll_ID + ' .Total_Soft_Poll_1_Ans_Check_Div1').css('z-index','9999');
				jQuery('.Total_Soft_Poll_1_Div_Cook_' + Poll_ID).css('z-index','999');
				var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();

				for(var i = 0; i < b.length; i++)
				{
					if( TotalSoft_Poll_3_V_Eff == '1' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '2' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span5_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '3' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span6_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '4' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span7_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '5' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span8_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '6' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span9_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '7' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span10_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '8' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span11_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '9' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span12_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
					}
				}
			}
			else
			{
				for(var i=0;i<b.length;i++)
				{
					jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(TotalSoft_Poll_Set_05);
				}
				jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).css('z-index','999');
				jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'1'},500);
				jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).css('z-index','9999');
				jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).animate({'opacity':'1'},500);

				jQuery('.Total_Soft_Poll_1_Ans_Div_' + Poll_ID + ' .Total_Soft_Poll_1_Ans_Check_Div1').css('z-index','9999');
				jQuery('.Total_Soft_Poll_1_Div_Cook_' + Poll_ID).css('z-index','999');
				var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();

				for(var i = 0; i < b.length; i++)
				{
					if( TotalSoft_Poll_3_V_Eff == '1' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '2' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span5_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '3' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span6_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '4' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span7_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '5' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span8_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '6' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span9_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '7' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span10_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '8' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span11_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
					else if( TotalSoft_Poll_3_V_Eff == '9' )
					{
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span12_' + Poll_ID);
						jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
					}
				}
			}
			jQuery('.Total_Soft_Poll_1_Div_Cook_' + Poll_ID).css('z-index','999');
			jQuery(".Total_Soft_Poll_1_Ans_Check_Div2_" + Poll_ID).remove();
			window.localStorage.setItem("tot_selected"+Poll_ID,"yes");
		}
	});
}


function Total_Soft_Poll_4_Vote(Poll_ID, Total_Soft_Poll_1_Ans_ID, voteOnce)
{
	
}
function Total_Soft_Poll_Ans_DivIV1(Poll_ID)
{
	Total_Soft_Poll_4_Result(Poll_ID);
	jQuery('.Total_Soft_Poll_1_Ans_Div_' + Poll_ID + ' .Total_Soft_Poll_1_Ans_Check_Div1').css('z-index','9999');
	jQuery('.Total_Soft_Poll_1_Div_Cook_' + Poll_ID).css('z-index','999');
}
function Total_Soft_Poll_4_Back(Poll_ID)
{
	jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'0'},500);
	jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).animate({'opacity':'0'},500);
	var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();

	setTimeout(function(){
		jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).css('z-index','-1');
		jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).css('z-index','-1');
		if( TotalSoft_Poll_3_V_Eff != '0' )
		{
			jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID).css('width','0');
		}
	},500)
}
function Total_Soft_Poll_4_Result(Poll_ID)
{
	jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).css('z-index','999');
	jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'1'},500);
	jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).css('z-index','999');
	jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).animate({'opacity':'1'},500);
	var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();
	var TotalSoftPoll_Ans_C = jQuery('#TotalSoftPoll_Ans_C_' + Poll_ID).val();

	var TotalSoft_Poll_Set_01 = jQuery('#TotalSoft_Poll_Set_01_'+Poll_ID).val();
	var TotalSoft_Poll_Set_05 = jQuery('#TotalSoft_Poll_Set_05_'+Poll_ID).val();
	if(TotalSoft_Poll_Set_01 == 'false')
	{
		jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID).html(TotalSoft_Poll_Set_05);
	}

	var ajaxurl = object.ajaxurl;
	var data = {
	action: 'TotalSoftPoll_1_Results', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
	foobar: Poll_ID, // translates into $_POST['foobar'] in PHP
	};
	jQuery.post(ajaxurl, data, function(response) {
		var b = Array();
		var sumb = 0;
		var a = response.split('s] =>');
		for( var i = 1; i < a.length; i++ )
		{ b[b.length] = a[i].split(')')[0].trim(); }

		for( var i = 0; i < b.length; i++)
		{ sumb += parseInt(b[i]); }
		var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();
		
		if(TotalSoft_Poll_Set_01 == 'false')
		{
			for(var i = 0; i < b.length; i++)
			{
				if( TotalSoft_Poll_3_V_Eff == '1' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '2' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span5_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '3' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span6_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '4' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span7_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '5' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span8_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '6' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span9_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '7' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span10_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '8' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span11_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '9' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span12_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
				}
			}
		}
		else
		{
			for(var i = 0; i < b.length; i++)
			{
				if( TotalSoft_Poll_3_V_Eff == '1' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '2' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span5_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '3' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span6_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '4' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span7_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '5' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span8_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '6' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span9_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '7' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span10_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '8' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span11_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
				else if( TotalSoft_Poll_3_V_Eff == '9' )
				{
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span12_' + Poll_ID);
					jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
				}
			}
		}
	})
}
function Total_Soft_Poll_4_Popup_VI(Poll_ID, Video_Src)
{
	jQuery('.Total_Soft_Poll_1_Ans_Fix_' + Poll_ID).show();
	jQuery('.Total_Soft_Poll_1_Ans_Fix_1_' + Poll_ID + ' iframe').attr('src',Video_Src);
	setTimeout(function(){
		jQuery('.Total_Soft_Poll_1_Ans_Fix_1_' + Poll_ID).show();
	},300)
}

function Total_Soft_Poll_4_Popup_Im(Poll_ID, Img_Src)
{
	jQuery('.Total_Soft_Poll_1_Ans_Fix_' + Poll_ID).show();
	jQuery('.Total_Soft_Poll_1_Ans_Fix_3_' + Poll_ID + ' img').attr('src',Img_Src);
	setTimeout(function(){
		jQuery('.Total_Soft_Poll_1_Ans_Fix_3_' + Poll_ID).show();
	},300)
}

function Total_Soft_Poll_Image_Close(Poll_ID)
{
	jQuery('.Total_Soft_Poll_1_Ans_Fix_' + Poll_ID).hide();
	jQuery('.Total_Soft_Poll_1_Ans_Fix_3_' + Poll_ID).hide();
	setTimeout(function(){
		jQuery('.Total_Soft_Poll_1_Ans_Fix_3_' + Poll_ID + ' img').attr('src','');
	},300)
}

function Total_Soft_Poll_5_But_Vote(Poll_ID, event){
	var voteOnce = jQuery("#TotalSoft_Poll_5_IV_Vote").val();
	var Total_Soft_Poll_1_Ans_ID = '';
	jQuery('.Total_Soft_Poll_1_Ans_Div_'+Poll_ID).find('.Total_Soft_Poll_1_Ans_Check_Div').find('input[type=radio]').each(function(){
		if(jQuery(this).attr('checked'))
		{
			Total_Soft_Poll_1_Ans_ID = jQuery(this).val();
		}
	})
	if(Total_Soft_Poll_1_Ans_ID != '')
	{
		if( window.localStorage.getItem("tot_selected"+Poll_ID) && voteOnce == "true"){
			return;
		}
		var TotalSoft_Poll_Set_01 = jQuery('#TotalSoft_Poll_Set_01_'+Poll_ID).val();
		var TotalSoft_Poll_Set_05 = jQuery('#TotalSoft_Poll_Set_05_'+Poll_ID).val();
		var e;
		event && event.type ? e = event.type : e="";
		jQuery.ajax({
			type: 'POST',
			url: object.ajaxurl,
			data: {
				action: 'TotalSoftPoll_1_Vote', // wp_ajax_my_action / wp_ajax_nopriv_my_action in ajax.php. Can be named anything.
				foobar: Total_Soft_Poll_1_Ans_ID, // translates into $_POST['foobar'] in PHP
				voteOnce: voteOnce,
				variable: e
			},
			beforeSend: function(){
				jQuery('.Total_Soft_Poll_1_Main_Div_'+Poll_ID + ' .TotalSoftPoll_Ans_loading').css('display','block');
			},
			success: function(response){
				jQuery('.Total_Soft_Poll_1_Main_Div_'+Poll_ID + ' .TotalSoftPoll_Ans_loading').css('display','none');
				var b=Array();
				var sumb = 0;
				var a=response.split('s] =>');
				for(var i=1;i<a.length;i++)
				{ b[b.length]=a[i].split(')')[0].trim(); }

				for(var i=0;i<b.length;i++)
				{ sumb += parseInt(b[i]); }

				var pvb = jQuery('.Total_Soft_Poll_3_Span4_'+Poll_ID).html();

				if(TotalSoft_Poll_Set_01 == 'true' || TotalSoft_Poll_Set_01 == '')
				{
					if( pvb.indexOf('%') > 0 && pvb.indexOf('(') > 0 && pvb.indexOf(')') > 0 )
					{
						for(var i = 0; i < b.length; i++)
						{
							jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(b[i] + ' ( ' + parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + ' % )');
						}
					}
					else if( pvb.indexOf('%') > 0 )
					{
						for(var i = 0; i < b.length; i++)
						{
							jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + ' %');
						}
					}
					else
					{
						for(var i=0;i<b.length;i++)
						{
							jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(b[i]);
						}
					}
					jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).css('z-index','9999');
					jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'1'},500);
					jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).css('z-index','9999');
					jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).animate({'opacity':'1'},500);
					var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();

					for(var i = 0; i < b.length; i++)
					{
						if( TotalSoft_Poll_3_V_Eff == '1' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '2' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span5_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '3' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span6_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '4' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span7_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '5' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span8_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '6' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span9_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '7' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span10_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '8' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span11_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '9' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span12_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':parseFloat(parseInt(b[i])*100/sumb).toFixed(2) + '%'},1500);
						}
					}
				}
				else
				{
					for(var i=0;i<b.length;i++)
					{
						jQuery('.Total_Soft_Poll_3_Span4_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).html(TotalSoft_Poll_Set_05);
					}
					jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).css('z-index','9999');
					jQuery('.Total_Soft_Poll_1_BBut_MDiv_' + Poll_ID).animate({'opacity':'1'},500);
					jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).css('z-index','9999');
					jQuery('.Total_Soft_Poll_3_Span_' + Poll_ID).animate({'opacity':'1'},500);
					var TotalSoft_Poll_3_V_Eff = jQuery('#TotalSoft_Poll_3_V_Eff_' + Poll_ID).val();
					for(var i = 0; i < b.length; i++)
					{
						if( TotalSoft_Poll_3_V_Eff == '1' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '2' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span5_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '3' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span6_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '4' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span7_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '5' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span8_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '6' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span9_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '7' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span10_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '8' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span11_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
						}
						else if( TotalSoft_Poll_3_V_Eff == '9' )
						{
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).addClass('Total_Soft_Poll_3_Span12_' + Poll_ID);
							jQuery('.Total_Soft_Poll_3_Span1_' + Poll_ID + '_' + parseInt(parseInt(i)+1)).animate({'width':'100%'},1500);
						}
					}
				}
				window.localStorage.setItem("tot_selected"+Poll_ID,"yes");
			}
		});
		jQuery('.Total_Soft_Poll_1_Div_Cook_' + Poll_ID).css('z-index','999999');


		var TotalSoft_Poll_5_TV_Show = jQuery('#TotalSoft_Poll_5_TV_Show_'+Poll_ID).val();
		if(TotalSoft_Poll_5_TV_Show == 'true')
		{
			var TotalSoftPoll_TVotes = jQuery('.Total_Soft_Poll_1_But_MDiv_'+Poll_ID).find('.Total_Soft_Poll_1_Total_View_But_Icon').find('span').html().split(':');
			jQuery('.Total_Soft_Poll_1_But_MDiv_'+Poll_ID).find('.Total_Soft_Poll_1_Total_View_But_Icon').find('span').html(TotalSoftPoll_TVotes[0] + ' : ' + parseInt(parseInt(TotalSoftPoll_TVotes[1])+1));
		}
	}
}