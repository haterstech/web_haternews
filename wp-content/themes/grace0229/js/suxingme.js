jQuery(document).ready(function($) {
    $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
    $(document).on('click', '#comments-navi a',
    function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            beforeSend: function() {
                $('#comments-navi').remove();
                $('.commentlist').remove();
                $('#loading-comments').slideDown()
            },
            dataType: "html",
            success: function(out) {
                result = $(out).find('.commentlist');
                nextlink = $(out).find('#comments-navi');
                $('#loading-comments').slideUp(550);
                $('#loading-comments').after(result.fadeIn(800));
                $('.commentlist').after(nextlink)
            }
        })
    })

    	
    // 百度分享
    $('.J_showAllShareBtn').click(function(){
    	$('.bdsharebuttonbox').fadeToggle();
    	$('.bdsharebuttonbox a').siblings(".external").removeClass("external");

    	$('.bdsharebuttonbox a').parents(".hide-external").removeClass("hide-external")
    	setTimeout(function(){
    	$('.bdsharebuttonbox').focus();
    	}, 300);
    });






	//if(isMobile()){
	//处理iframe样式，主要是视频的处理
        var acWidth = isMobile() ? $('#page-content').width() : 700;
		var acHeight  = $('#page-content').height();
		//alert("acWidth:" + acWidth + ";acHeight:" + acHeight);
		$('#page-content').find("iframe").each(function(index, element) {
			//alert("acWidth:" + acWidth + ";acHeight:" + acHeight + ";$(this).width():" + $(this).width());
			if(acWidth != null && acWidth > 0 && acWidth < $(this).width()){
				var newWidth = parseInt(acWidth*0.88);
				var newHeight = $(this).height();
				if(newHeight / newWidth > 1.1){
				//如果宽高比有异常，则也把高度处理
					var proportion = $(this).width() / newWidth;
					newHeight = parseInt($(this).height() / proportion);
				}
				//alert("newWidth:" + newWidth + ";newHeight:" + newHeight + ";proportion:" + proportion + ";height:" + $(this).height());
				$(this).width(newWidth);
				$(this).height(newHeight);
			
			}
		});
	//}

	

	  



	
	//动态添加文章广告
	if($('#post-content').length > 0 && $('.app-hidden-ads').length == 0){
		var imgs = $('#post-content img');
		var insertAd = null;
        var adContent2 = "<div class='posts-cjtz content-cjtz clearfix' style='text-align:center;'></div>";




		 var adContent3 = "<div class='posts-cjtz content-cjtz clearfix' style='text-align:center;'></div>";

		 var adContent5 = "<div class='posts-cjtz content-cjtz clearfix' style='text-align:center;'></div>";


		 var mAdContent = '<div style="text-align:center;"><\/div>';


		 var zhiboContent = "<div class='posts-cjtz content-cjtz clearfix' style='text-align:center;'></div>";

		 var qpPcAd = "<script async src='\/\/pagead2.googlesyndication.com\/pagead\/js\/adsbygoogle.js'><\/script>" + 
			"<!-- PC-影片贴片 --><ins class='adsbygoogle' style='display:inline-block;width:336px;height:280px' data-ad-client='ca-pub-4059643053601138' " +
			"data-ad-slot='6040722332'><\/ins><script>(adsbygoogle = window.adsbygoogle || []).push({});<\/script>";

		var qpMobileAd = "<script async src='\/\/pagead2.googlesyndication.com\/pagead\/js\/adsbygoogle.js'><\/script>" + 
			"<!-- WEB-影片贴片 --><ins class='adsbygoogle' style='display:inline-block;width:200px;height:200px' data-ad-client='ca-pub-4059643053601138' " +
			"data-ad-slot='4679539205'><\/ins><script>(adsbygoogle = window.adsbygoogle || []).push({});<\/script>";

		
		/*if(imgs.length >= 2 && !$(imgs.get(1)).hasClass("cpi_ad_img")){
			$(imgs.get(1)).after(adContent2);
		}


        if(imgs.length >= 3 && !$(imgs.get(2)).hasClass("cpi_ad_img")){
            $(imgs.get(2)).after(adContent3);
        }

		if(imgs.length >= 5 && !$(imgs.get(4)).hasClass("cpi_ad_img")){
            $(imgs.get(4)).after(adContent5);
		}

		if(imgs.length >= 7 && !$(imgs.get(6)).hasClass("cpi_ad_img")){
            $(imgs.get(6)).after(adContent5);
		}

		if(imgs.length >= 9 && !$(imgs.get(8)).hasClass("cpi_ad_img")){
            $(imgs.get(8)).after(adContent5);
		}

		if(imgs.length >= 11 && !$(imgs.get(10)).hasClass("cpi_ad_img")){
            $(imgs.get(10)).after(adContent5);
		}

		if(imgs.length >= 13 && !$(imgs.get(12)).hasClass("cpi_ad_img")){
            $(imgs.get(12)).after(adContent5);
		}

		if(imgs.length >= 15 && !$(imgs.get(14)).hasClass("cpi_ad_img")){
            $(imgs.get(14)).after(adContent5);
		}

		if(imgs.length >= 17 && !$(imgs.get(16)).hasClass("cpi_ad_img")){
            $(imgs.get(16)).after(adContent5);
		}

		if(imgs.length >= 19 && !$(imgs.get(18)).hasClass("cpi_ad_img")){
            $(imgs.get(18)).after(adContent5);
		}

		if($('.players_box').length>0){
			$('.players_box').each(function(index, element) {
				$(this).before(zhiboContent);	
			});
		}*/




		

		

		//var iframes = $('#post-content iframe');
		//console.log(iframes.length);


		


        //var recommendedrPosts = $('#recommendedrPosts');
		//内文广告
		//if(insertAd){
		//	$(insertAd).after("<div class='posts-cjtz content-cjtz clearfix' style='text-align:center;'><script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script><ins class='adsbygoogle' style='display:inline-block;width:336px;height:280px' data-ad-client='ca-pub-4059643053601138' data-ad-slot='8532708803'></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div>	<div class='posts-cjtz content-cjtz-mini clearfix'><script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script><ins class='adsbygoogle'  style='display:inline-block;width:282px;height:235px' data-ad-client='ca-pub-4059643053601138' data-ad-slot='8929140803'></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div>");
		//}
		
		//alert($('#recommendedrPosts'));

		if($('#recommendedrPosts')){
			//pc内文3广告
			/*$('#recommendedrPosts').after("<div class='posts-cjtz content-cjtz clearfix'>
				"<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>" + 
				"<ins class='adsbygoogle' style='display:inline-block;width:336px;height:280px' data-ad-client='ca-pub-4059643053601138' data-ad-slot='1251597416' ></ins>"+
				"<script>(adsbygoogle = window.adsbygoogle || []).push({});</script><script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>"+
				"<ins class='adsbygoogle' style='display:inline-block;width:336px;height:280px;margin-left:30px' data-ad-client='ca-pub-4059643053601138' data-ad-slot='1251597416' ></ins>"+
				"<script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div><div class='heateorSssClear'></div>");*/
		}

        var heateorSssSharingContainer =  $('.heateor_sss_sharing_container');
        var formCopyrigth = $("#formCopyrigth");
        if(heateorSssSharingContainer && heateorSssSharingContainer.get(0)){
            $(heateorSssSharingContainer.get(0)).insertBefore($(formCopyrigth));
        }

		//alert(heateorSssSharingContainer);
        if($('#single_mobile_cpi_box')){
            var browser = {
                versions: function () {
                    var u = navigator.userAgent, app = navigator.appVersion;
					//alert("u" + u +  ";app:" + app);
                    return { //移动终端浏览器版本信息
                        ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                        android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
                        iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
                        iPad: u.indexOf('iPad') > -1, //是否iPad
                    };
                }(),
            }

            var androidLink = 'https://line.me/R/ti/p/%40kkg5212d';
            var iosLink = 'https://line.me/R/ti/p/%40kkg5212d';

            var cpiHref = androidLink;
            if (browser.versions.iPhone || browser.versions.iPad || browser.versions.ios) {
                cpiHref = iosLink;
            }

           // if (browser.versions.iPhone || browser.versions.iPad || browser.versions.ios) {
                //$("#single_mobile_cpi_box").attr("href",iosLink);
			//	//$("#single_mobile_cpi_box").removeAttr("class");
				$("#single_mobile_cpi_box").attr("href",iosLink);
          //  }else if (browser.versions.android) {
           //     $("#single_mobile_cpi_box").attr("href",androidLink);
          //  }

        }
	}else{
        var cpiBox = $('.single_mobile_cpi_box');
        if(cpiBox){
            for(var i=0 ; i<cpiBox.length ; i++){
                $(cpiBox[i]).hide();
            }
        }

    }
	
	
});

//文章点赞
jQuery(document).ready(function($) { 
	$.fn.postLike = function() {
	 if ($(this).hasClass('current')) {
     alert("您已經贊過啦:-)");
	 return false;
	 } else {
	 $(this).addClass('current');
	 var id = $(this).data("id"),
	 action = $(this).data('action'),
	 rateHolder = $(this).children('.count');
	 var ajax_data = {
	 action: "suxing_like",
	 um_id: id,
	 um_action: action
	 };
	 $.post(suxingme_url.url_ajax, ajax_data,
	 function(data) {
	 $(rateHolder).html(data);
	 });
	 return false;
	 }
	};
	$(document).on("click", "#Addlike",
	function() {
	 $(this).postLike();
	});
}); 





//tip
jQuery(document).ready(function($) { 
	$("#tooltip-weixin,#tooltip-qq,#tooltip-f-qq,#tooltip-f-weixin").click(
	function() {
		var e = $(this);
		setTimeout(function() {
			e.parents(".dropdown-menu-part").find(".dropdown-menu").toggleClass("visible");
		},
		"200");
	});

    $('.m-search').on('click', function(){
        $('.search-box').slideToggle(200, function(){
            if( $('.m-search').css('display') == 'block' ){
             $('.search-box .form-search').focus()
             }
        })
    })

//返回顶部
!function(o){"use strict";o.fn.toTop=function(t){var i=this,e=o(window),s=o("html, body"),n=o.extend({autohide:!0,offset:420,speed:500,position:!0,right:38,bottom:38},t);i.css({cursor:"pointer"}),n.autohide&&i.css("display","none"),n.position&&i.css({position:"fixed",right:n.right,bottom:n.bottom}),i.click(function(){s.animate({scrollTop:0},n.speed)}),e.scroll(function(){var o=e.scrollTop();n.autohide&&(o>n.offset?i.fadeIn(n.speed):i.fadeOut(n.speed))})}}(jQuery);
$(function() {
    $('.to-top').toTop();
});

}); 



jQuery(document).on("click", "#fa-loadmore", function($) {
    var _self = jQuery(this),
        _postlistWrap = jQuery('.posts-con'),
        _button = jQuery('#fa-loadmore'),
        _data = _self.data();
    if (_self.hasClass('is-loading')) {
        return false
    } else {
        _button.html('<i class="icon-spin6 animate-spin"></i> 加載中...');
        _self.addClass('is-loading');
        jQuery.ajax({
            url: suxingme_url.url_ajax,//注意该文件路径
            data: _data,
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data.code == 500) {
                    _button.data("paged", data.next).html('加載更多');
                    alert('服務器正在努力找回自我  o(∩_∩)o')
                } else if (data.code == 200) {
                    _postlistWrap.append(data.postlist);
                    if( jQuery.isFunction(jQuery.fn.lazyload) ){  
                        jQuery("img.lazy").lazyload({ effect: "fadeIn",});
                    } 
                    if (data.next) {
                        _button.data("paged", data.next).html('加載更多')
                    } else {
                        _button.remove()
                    }
                }
                _self.removeClass('is-loading')
            },
            error:function(data){
                console.log(data.responseText);
                console.log(data);
            }
        })
    }
});




jQuery(document).ready(function($) { 

$(function() {
    FastClick.attach(document.body);
    var top = $("html, body");
    $(".mobile_menu").click(function() {
        $("html").toggleClass("open");
        $(".mobile_nav").slideToggle("fast");
        return false;
    });

});

var elments = {
    sidebar: $('.sidebar'),
    footer: $('#footer')
}
if( elments.sidebar.length > 0 && suxingme_url.roll ){

    suxingme_url.roll = suxingme_url.roll.split(' ')

    if(suxingme_url.headfixed == 1){
        
        var h1 = 90, h2 = 115, h3 = 90;

        if( $('body').hasClass('home') ){
            var xxx = 760
        }
        else{
            var xxx = 75
        }
    }
    else{
        var h1 = 25, h2 = 50, h3 = 25;
        if( $('body').hasClass('home') ){
            var xxx = 826
        }
        else{
            var xxx = 140
        }
    }
   

    var rollFirst = elments.sidebar.find('.widget:eq('+(Number(suxingme_url.roll[0])-1)+')');
    var sheight = rollFirst[0].offsetHeight;
    rollFirst.on('affix-top.bs.affix', function(){
        rollFirst.css({top: 0}); 
        sheight = rollFirst[0].offsetHeight;

        for (var i = 1; i < suxingme_url.roll.length; i++) {
            var item = Number(suxingme_url.roll[i])-1;
            var current = elments.sidebar.find('.widget:eq('+item+')');
            current.removeClass('affix').css({top: 0});
        };
    });

    rollFirst.on('affix.bs.affix', function(){
        rollFirst.css({top: h1}); 

        for (var i = 1; i < suxingme_url.roll.length; i++) {
            var item = Number(suxingme_url.roll[i]) - 1;
            var current = elments.sidebar.find('.widget:eq('+item+')');
            current.addClass('affix').css({top: sheight+h2});
            sheight += current[0].offsetHeight + h3;
        };
    });

    rollFirst.affix({
        offset: {
            top: elments.sidebar.height() + xxx ,
            bottom: elments.footer.outerHeight(true) + 40 ,
        }
    });
   
}

});

jQuery(document).ready(function($) { 
    if(suxingme_url.headfixed == 1){
        $(document).on('scroll', function(){
            
            var st = $(this).scrollTop(),
                nav_point = 90,
                $nav = $('#header');

                if( st >= nav_point ){
                    $nav.addClass('headfixed');
                }
                else{
                    $nav.removeClass('headfixed');
                }

        });
    }
    else
    {
        return false;
    }
});
document.addEventListener('DOMContentLoaded', function(){
   var aluContainer = document.querySelector('.comment-form-smilies');
    if ( !aluContainer ) return;
    aluContainer.addEventListener('click',function(e){
    var myField,
        _self = e.target.dataset.smilies ? e.target : e.target.parentNode,
        tag = ' ' + _self.dataset.smilies + ' ';
        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
            myField = document.getElementById('comment')
        } else {
            return false
        }
        if (document.selection) {
            myField.focus();
            sel = document.selection.createRange();
            sel.text = tag;
            myField.focus()
        } else if (myField.selectionStart || myField.selectionStart == '0') {
            var startPos = myField.selectionStart;
            var endPos = myField.selectionEnd;
            var cursorPos = endPos;
            myField.value = myField.value.substring(0, startPos) + tag + myField.value.substring(endPos, myField.value.length);
            cursorPos += tag.length;
            myField.focus();
            myField.selectionStart = cursorPos;
            myField.selectionEnd = cursorPos
        } else {
            myField.value += tag;
            myField.focus()
        }
    });
 });
jQuery(document).on("click", ".facetoggle", function($) {
    jQuery(".comment-form-smilies").toggle();
});

function isMobile()  
{  //alert("ispc");
   var userAgentInfo = navigator.userAgent;  
   var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod");  
   var flag = false;  
   for (var v = 0; v < Agents.length; v++) {  
       if (userAgentInfo.indexOf(Agents[v]) > 0) { 
	   		flag = true; 
			break; 
	   }  
   }  
   return flag;  
} 





/**如果需要设定自定义过期时间
这是有设定过期时间的使用示例：
s20是代表20秒
h是指小时，如12小时则是：h12
d是天数，30天则：d30
**/
function setCookie96(name,value,time)
{
	var strsec = getsec96(time);
	var exp = new Date();
	exp.setTime(exp.getTime() + strsec*1);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString()+";path=/";
}


/*读取cookies*/
function getCookie96(name)
{
	var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	if(arr=document.cookie.match(reg))
		return unescape(arr[2]);
	else
		return null;
}

/*删除cookies*/
function delCookie96(name)
{
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval=getCookie96(name);
	if(cval!=null)
		document.cookie= name + "="+cval+";expires="+exp.toGMTString()+";path=/";
}


function getsec96(str)
{
	//alert(str);
	var str1=str.substring(1,str.length)*1;
	var str2=str.substring(0,1);
	if (str2=="s")
	{
		return str1*1000;
	}
	else if (str2=="h")
	{
		return str1*60*60*1000;
	}
	else if (str2=="d")
	{
		return str1*24*60*60*1000;
	}
}


/*function singleMobileCpi1(e){
	//内文第三个广告
		//var ad_link1 = $('#single_mobile_cpi1');
		//if(ad_link1.length > 0){
			var browser = {
				versions: function () {
					var u = navigator.userAgent, app = navigator.appVersion;
					return { //移动终端浏览器版本信息 
						ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端 
						android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器 
						iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器 
						iPad: u.indexOf('iPad') > -1, //是否iPad 
					};
				}(),
			}
			
			//$('#single_mobile_cpi1').find("a").each(function(index, element) {
				if (browser.versions.iPhone || browser.versions.iPad || browser.versions.ios) {
					$(e).attr("href","http://tracking.lenzmx.com/click?mb_pl=ios&mb_nt=cb8159&mb_campid=bt_tz_tw_ios");
				}else if (browser.versions.android) {
					$(e).attr("href","http://tracking.lenzmx.com/click?mb_pl=android&mb_nt=cb8159&mb_campid=bt_tz_tw");
				}
			//});	
		//}
}*/
