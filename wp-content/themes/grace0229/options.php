<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */
function optionsframework_option_name() {
	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */
function optionsframework_options() {

// 將所有頁面（頁面）加入數組
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = '選擇頁面：';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	$wp_editor_settings = array(
		'wpautop' => true, // 默認
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	$topslide_array = array(		
		'DESC' => __('默認排序'),
		'date' => __('時間排序'),
		'rand' => __('隨機排序')
	);
	$avatar_array = array(		
		'one' => __('HTTPS加密線路'),
		'two' => __('調用SSL頭像鏈接'),
		
	);

	$options = array();
	
	/*****基本設置*****/
	$options[] = array(
		'name' => __('基本设置'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('顶部Logo'),
		'desc' => __('上传一个尺寸为宽220px，长50px的图片，或者直接输入图片地址'),
		'id' => 'suxingme_logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('后台登陆Logo'),
		'desc' => __('请上传一个尺寸为280*84的Logo文件或是输入文件URL'),
		'id' => 'suxingme_login_logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('网站Favicon地址'),
		'desc' => __('输入Favicon文件URL,或者直接替换主题img文件夹中的Favicon文件。制作Favicon文件请自行百度'),
		'id' => 'suxingme_favicon',
		'type' => 'upload');

	$options[] = array(
		'name' => __('网站统计代码'),
		'desc' => sprintf( __( '如百度统计、CNZZ、Google Analytics，不填则不显示' ) ),
		'id' => 'suxingme_statistics_code',
		'type' => 'textarea');

		
	$options[] = array(
		'name' => __('网站备案号'),
		'desc' => __('在显示网站底部，没有备案号可不填。不填则不显示'),
		'id' => 'suxingme_beian',
		"class" => "mini",
		'type' => 'text');
		
	/*****SEO优化*****/
	$options[] = array(
		'name' => __('SEO优化'),
		'type' => 'heading');
			
	$options[] = array(
		'name' => __('网站标题连接符'),
		'desc' => __('一经选择，切勿更改，对SEO不友好，一般为“-”或“_”'),
		'id' => 'page_sign',
		'std' => '-',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('网站描述'),
		'desc' => __('SEO设置，输入您的网站描述，一般不超过200字符'),
		'id' => 'suxingme_description',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('网站关键词'),
		'desc' => sprintf( __( 'SEO设置，输入您的网站关键词，以英文逗号(,)隔开。' ) ),
		'id' => 'suxingme_keywords',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('文章外链自动添加nofollow属性'),
		'id' => 'suxingme_autonofollow',
		'std' => false,
		'desc' => __('防止外链分散了网站内页的权重'),
		'type' => 'checkbox');
		
		
	$options[] = array(
		'name' => __('文章tag关键词自动描文本'),
		'id' => 'suxingme_keywordlink',
		'std' => false,
		'desc' => __('自动描文本,优化seo'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('自动给文章图片添加Alt信息'),
		'id' => 'friendly',
		'std' => true,
		'desc' => __(''),
		'type' => 'checkbox');

		/*****网站加速/优化设置*****/
	$options[] = array(
		'name' => __('网站加速/优化'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('开启苏醒主题安装提示'),
		'id' => 'suxingme_suxingsaid',
		'std' => true,
		'desc' => __(''),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('网站导航跟随固定'),
		'id' => 'suxingme_head_fixed',
		'std' => false,
		'desc' => __('默认关闭'),
		'type' => 'checkbox');	

	$options[] = array(
		'name' => __('点赞功能'),
		'id' => 'suxingme_post_like',
		'std' => true,
		'desc' => __('免插件文章点赞功能'),
		'type' => 'checkbox');	
	
	$options[] = array(
		'name' => __('文章分类显示文章TAG标签'),
		'id' => 'suxingme_post_tags',
		'std' => true,
		'desc' => __('默认开启'),
		'type' => 'checkbox');	

	$options[] = array(
		'name' => __('默认头像'),
		'desc' => __('新增自定义默认头像,自定义头像设置之后会存在等待缓存周期，请不要捉急。'),
		'id' => 'new_avatar_pic',
		'type' => 'upload');	
	
	$options[] = array(
		'name' => __('Gravatar 头像调用渠道'),
		'desc' => __('默认通过使用【Gravatar头像服务的（HTTPS）加密线路】，开启后使用【官方Gravatar头像调用ssl头像链接】'),
		'id' => 'suxingme_get_avatar',
		'std' => 'one',
		'type' => 'radio',	
		'options' => $avatar_array);	

	$options[] = array(
		'name' => __('文章页每段文字首行缩进2个字符'),
		'id' => 'suxingme_text_indent',
		'std' => false,
		'desc' => __(''),
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('根据上传时间重命名上传的图片文件'),
		'id' => 'suxingme_upload_filter',
		'std' => true,
		'desc' => __('', 'options_framework_theme）'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章列表使用TimThumb进行截取缩略图'),
		'id' => 'suxingme_timthumb',
		'desc' => __('设置后，请使用ftp工具或者putty或类似的SSH工具登陆VPS或服务器，给主题文件夹中的cache文件夹和TimThumb.php文件设置755权限，否则会出现图片无法读取显示的情况。'),
		'std' => false,
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('设置文章默认缩略图'),
		'id' => 'suxingme_post_thumbnail',
		'desc' => __('当文章无图或者没有指定特色图像的时候，默认显示该张图片作为文章缩略图'),
		'std' => '',
		'type' => 'upload');

	$options[] = array(
		'name' => __('文章列表AJAX加载文章'),
		'id' => 'suxingme_ajax_posts',
		'desc' => __(''),
		'std' => true,
		'desc' => __(' '),
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('文章页图片fancybox暗箱功能'),
		'id' => 'suxingme_fancybox',
		'std' => false,
		'desc' => __('打开后，文章中如带有图片链接的图片，点击都将是弹窗显示。'),
		'type' => 'checkbox');	
		
	$options[] = array(
		'name' => __('延迟加载首页/分类缩略图'),
		'id' => 'suxingme_timthumb_lazyload',
		'std' => false,
		'desc' => __(''),
		'type' => 'checkbox');	
		
	$options[] = array(
		'name' => __('延迟加载默认图片-小图'),
		'desc' => __('请上传一个尺寸为240*160的图片文件或是输入文件URL'),
		'id' => 'default_thumbnail',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('延迟加载默认图片-大图'),
		'desc' => __('请上传一个尺寸为760*300的图片文件或是输入文件URL'),
		'id' => 'default_thumbnail_700',
		'type' => 'upload');

	
	$options[] = array(
		'name' => __('禁用所有文章类型的修订版本'),
		'id' => 'revisions_to_keep',
		'std' => true,
		'desc' => __('', 'options_framework_theme）'),
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('删除 wp_head 中无关紧要的代码'),
		'id' => 'suxingme_wphead',
		'std' => true,
		'desc' => __(''),
		'type' => 'checkbox');



	/*****网站配色设置*************/
	$options[] = array(
		'name' => __('网站配色设置'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('网站整体变灰'),
		'id' => 'suxingme_site_gray',
		'std' => false,
		'desc' => __('使网站变灰，支持IE、Chrome，基本上覆盖了大部分用户，不会降低访问速度'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('网站换色功能'),
		'id' => 'suxingme_site_gray_turn',
		'std' => false,
		'desc' => __('开启之后支持网站主题风格自定义，默认关闭。'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __("主题风格"),
		'desc' => __("3种颜色供选择，点击选择你喜欢的颜色，保存后前端展示会有所改变。"),
		'id' => "theme_skin",
		'std' => "19B5FE",
		'type' => "colorradio",
		'options' => array(
			'273746' => 1,
			'19B5FE' => 2,
			'00D6AC' => 3,
		)
	);

	$options[] = array(
		'id' => 'theme_skin_custom',
		'std' => "",
		'desc' => __('不喜欢上面提供的颜色，你好可以在这里自定义设置，如果不用自定义颜色清空即可（默认不用自定义）'),
		'type' => "color");

	/*******CMS设置*******/
	$options[] = array(
		'name' => __('CMS设置'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('首页显示3个热门分类'),
		'desc' => __('开启后，请到[后台->文章->分类目录]中上传分类封面'),
		'id' => 'suxing_cat_index_on',
		'std' => false,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('首页显示3个热门分类-显示的分类'),
		'desc' => __('如果你想在首页显示指定分类及它的文章，填上分类id（数字）即可，多个分类用英文符号“,”隔开（例如：1,2）'),
		'id' => 'suxing_cat_index',
		"class" => "mini",
		'type' => 'text');	

	$options[] = array(
		'name' => __('首页不显示最新文章模块及右侧栏'),
		'id' => 'suxingme_new_post',
		'std' => true,
		'desc' => __('最新文章模块：在首页中，按时间排序显示全站文章。'),
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('不显示指定分类中的文章（从首页最新文章模块中）'),
		'desc' => __('在分类前打扣即不显示该分类的文章。'),
		'id' => 'notinhome',
		'options' => $options_categories,
		'type' => 'multicheck');


	$options[] = array(
		'name' => __('文章页显示作者信息'),
		'desc' => __('默认开启。开启后，作者信息将展示在右侧栏第一位'),
		'id' => 'suxingme_post_author_box',
		'std' => true,
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章页显示上下文图文链接'),
		'desc' => __('默认开启。'),
		'id' => 'nextprevposts',
		'std' => true,
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('文章页显示相关文章模块'),
		'desc' => __('默认开启。'),
		'id' => 'related-post',
		'std' => true,
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('作者页面页显示作者信息'),
		'desc' => __('默认开启。开启后，作者信息将展示在右侧栏第一位'),
		'id' => 'suxingme_author_box',
		'std' => true,
		'type' => 'checkbox');


	$options[] = array(
		'name' => __('首页并排显示2个分类列表-显示的分类', 'options_framework_theme'),
		'desc' => __('如果你想在首页显示指定分类及它的文章，填上分类id（数字）即可，多个分类用英文符号“,”隔开（例如：1,2）', 'options_framework_theme'),
		'id' => 'suxingme_cat_list',
		"class" => "mini",
		'type' => 'text');	

	$options[] = array(
		'name' => __('首页显示分类列表-显示的分类', 'options_framework_theme'),
		'desc' => __('如果你想在首页显示指定分类及它的文章，填上分类id（数字）即可，多个分类用英文符号“,”隔开（例如：1,2）', 'options_framework_theme'),
		'id' => 'suxingme_cat_list2',
		"class" => "mini",
		'type' => 'text');	


	/*******首页幻灯片设置*******/
	$options[] = array(
		'name' => __('首页幻灯片'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('首页幻灯片【自动获取文章版】'),
		'id' => 'suxingme_slide',
		'std' => true,
		'desc' => __('展示在首页,默认开启'),
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('幻灯片显示文章数量'),
		'desc' => __('首页幻灯片显示文章的数量，不要超过10篇，建议6篇'),
		'id' => 'suxingme_slide_number',
		'std' => '4',
		"class" => "mini",
		'type' => 'text');

	$options[] = array(
		'name' => __('显示指定分类的文章'),
		'desc' => __('首页幻灯片轮播指定分类中的文章，填上分类id（数字）即可，多个分类用英文符号“,”隔开（例如：1,2），不可留空。如果需要展示推荐的文章，可以在编辑文章时，下方的【文章拓展】中，勾选【推送至首页幻灯片】。'),
		'id' => 'suxingme_slide_fenlei',
		"class" => "mini",
		'type' => 'text');

	$options[] = array(
		'name' => __('显示文章信息（标题、作者信息、摘文等）'),
		'desc' => __('首页幻灯片轮播指定分类中的文章，填上分类id（数字）即可，多个分类用英文符号“,”隔开（例如：1,2），不可留空。如果需要展示推荐的文章，可以在编辑文章时，下方的【文章拓展】中，勾选【推送至首页幻灯片】。'),
		'id' => 'suxingme_slide_info',
		'std' => true,
		'type' => 'checkbox');


	$options[] = array(
		'name' => __('显示文章顺序'),
		'desc' => __(''),
		'id' => 'suxingme_slide_order',
		'std' => 'DESC',
		'type' => 'radio',
		'options' => $topslide_array);


		/*******页面设置*******/
	$options[] = array(
		'name' => __('页面设置'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('友情链接-页面模版-顶部背景图'),
		'desc' => __('找一个流弊的图片替换吧，图片宽度一定要大，一定要逼格！不填则使用默认图片'),
		'id' => 'links_banner_pic',
		'type' => 'upload');

	$options[] = array(
		'name' => __('热门标签-页面模版-顶部背景图'),
		'desc' => __('找一个流弊的图片替换吧，图片宽度一定要大，一定要逼格！不填则使用默认图片'),
		'id' => 'tags_banner_pic',
		'type' => 'upload');

	$options[] = array(
		'name' => __('热门文章列表-页面模版-顶部背景图'),
		'desc' => __('找一个流弊的图片替换吧，图片宽度一定要大，一定要逼格！不填则使用默认图片'),
		'id' => 'tags_banner_pic',
		'type' => 'upload');

	$options[] = array(
		'name' => __('网址导航页面-页面模版-顶部背景图'),
		'desc' => __('找一个流弊的图片替换吧，图片宽度一定要大，一定要逼格！不填则使用默认图片'),
		'id' => 'pagenav_banner_pic',
		'type' => 'upload');

	$options[] = array(
		'name' => __('留言板-页面模版-顶部背景图'),
		'desc' => __('找一个流弊的图片替换吧，图片宽度一定要大，一定要逼格！不填则使用默认图片'),
		'id' => 'readers_banner_pic',
		'type' => 'upload');

	$options[] = array(
		'name' => __('留言板-页面模版-统计时间'),
		'desc' => __('显示多少月内，网站留言过的朋友头像，直接填写数字即可，例如1月内，即填写数字：1'),
		'id' => 'readers_time',
		'std' => '30',
		"class" => "mini",
		'type' => 'text');

		$options[] = array(
		'name' => __('留言板-页面模版-统计数量'),
		'desc' => __('显示数量，显示多少个头像，直接填写数字即可，例如10个，即填写数字：10'),
		'id' => 'readers_number',
		'std' => '50',
		"class" => "mini",
		'type' => 'text');


	/****侧栏随动*****/
	$options[] = array(
		'name' => __('侧栏悬停'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('侧栏随动').__('首页'),
		'id' => 'sideroll_index_s',
		'std' => true,
		'desc' => __('开启'),
		'type' => 'checkbox');

	$options[] = array(
		'id' => 'sideroll_index',
		'std' => '1 2',
		'class' => 'mini',
		'desc' => __(' 设置随动模块，多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，所有模块的高度不要超过一屏，建议最多2个模块。'),
		'type' => 'text');

	$options[] = array(
		'name' => __('侧栏随动').__('分类|标签|搜索页'),
		'id' => 'sideroll_list_s',
		'std' => true,
		'desc' => __('开启'),
		'type' => 'checkbox');

	$options[] = array(
		'id' => 'sideroll_list',
		'std' => '1 2',
		'class' => 'mini',
		'desc' => __(' 设置随动模块，多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，所有模块的高度不要超过一屏，建议最多2个模块。'),
		'type' => 'text');

	$options[] = array(
		'name' => __('侧栏随动').__('文章页'),
		'id' => 'sideroll_post_s',
		'std' => true,
		'desc' => __('开启'),
		'type' => 'checkbox');

	$options[] = array(
		'id' => 'sideroll_post',
		'std' => '1 2',
		'class' => 'mini',
		'desc' => __(' 设置随动模块，多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，所有模块的高度不要超过一屏，建议最多2个模块。'),
		'type' => 'text');

	$options[] = array(
		'name' => __('侧栏随动').__('页面'),
		'id' => 'sideroll_page_s',
		'std' => true,
		'desc' => __('开启'),
		'type' => 'checkbox');

	$options[] = array(
		'id' => 'sideroll_page',
		'std' => '1 2',
		'class' => 'mini',
		'desc' => __(' 设置随动模块，多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，所有模块的高度不要超过一屏，建议最多2个模块。'),
		'type' => 'text');

	/*******社交链接设置*******/
	$options[] = array(
		'name' => __('社交工具'),
		'type' => 'heading' );
		
	$options[] = array(
		'name' => __('新浪微博链接'),
		'desc' => __('直接输入您的新浪微博链接，别忘了开头带 http:// '),
		'id' => 'suxingme_social_weibo',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('腾讯微博'),
		'desc' => __('直接输入您的腾讯微博链接，别忘了开头带 http://'),
		'id' => 'suxingme_social_qqweibo',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('QQ邮箱'),
		'desc' => __('直接输入QQ邮箱即可'),
		'id' => 'suxingme_social_email',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('QQ'),
		'desc' => __('直接输入QQ号即可'),
		'id' => 'suxingme_social_qq',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('微信图片'),
		'desc' => __('请上传一个尺寸为长宽160px图片文件或是输入文件URL'),
		'id' => 'suxingme_social_weixin',
		'type' => 'upload');
			
	/*******广告设置	*******/
	$options[] = array(
		'name' => __('PC端广告设置'),
		'type' => 'heading' );
	
	$options[] = array(
		'name' => __('文章列表中广告模块'),
		'id' => 'suxing_ad_posts_pc',
		'std' => true,
		'desc' => __('展示于文章列表的1个宽度为747.88px的广告位，有极高的点击率'),
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('展示于第几篇文章后？'),
		'desc' => __('自定义显示位置，例如输入7，则此图片出现于第七篇文章之后。'),
		'id' => 'suxing_ad_posts_pc_num',
		"class" => "mini",
		'std' => '3',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('文章列表中广告模块-广告代码'),
		'desc' => __('图片宽度为760px'),
		'id' => 'suxing_ad_posts_pc_url',
	
		"std" => '<a title="苏醒博客" href="http://www.suxing.me" target="_blank"><img src="http://www.vfilmtime.com/wp-content/uploads/2015/09/gg700.png" alt="苏醒博客" /></a>',
		'type' => 'textarea');	
		
	$options[] = array(
		'name' => __('文章下方广告模块'),
		'id' => 'suxing_ad_content_pc',
		'std' => true,
		'desc' => __('展示于文章列表的1个宽度为760px的广告位，有极高的点击率'),
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('文章下方广告模块-广告代码'),
		'desc' => __('图片宽度为760px'),
		'id' => 'suxing_ad_content_pc_url',
		"std" => '<a title="苏醒博客" href="http://www.suxing.me" target="_blank"><img src="http://www.vfilmtime.com/wp-content/uploads/2015/09/gg700.png" alt="苏醒博客" /></a>',
		'type' => 'textarea');		

	
	/******移动端广告设置*******/
	$options[] = array(
		'name' => __('移动端广告设置'),
		'type' => 'heading' );
		
	$options[] = array(
		'name' => __('【文章列表】广告模块'),
		'desc' => __('展示于文章列表，有极高的点击率。'),
		'id' => 'suxing_ad_posts_m',
		'std' => 'off',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('展示于第几篇文章后？'),
		'desc' => __('自定义显示位置，例如输入7，则此图片出现于第七篇文章之后。'),
		'id' => 'suxing_ad_posts_m_num',
		"class" => "mini",
		'type' => 'text');
		
	$options[] = array(
		'name' => __('广告代码'),
		'desc' => sprintf( __( '广告图片宽度为480px，图片高度自行决定。' ) ),
		'id' => 'suxing_ad_posts_m_url',
		"std" => '<a href="跳转链接" title="广告标题"><img src="图片链接" alt="图片描述"></a>',
		'type' => 'textarea');	

			
	$options[] = array(
		'name' => __('文章下方广告模块'),
		'id' => 'suxing_ad_content_mini',
		'std' => true,
		'desc' => __('展示于文章列表的1个宽度为760px的广告位，有极高的点击率'),
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('文章下方广告模块-广告代码'),
		'desc' => __('图片宽度为480px，图片高度自行决定。'),
		'id' => 'suxing_ad_content_mini_url',
		"std" => '<a title="苏醒博客" href="http://www.suxing.me" target="_blank"><img src="http://www.vfilmtime.com/wp-content/uploads/2015/09/gg700.png" alt="苏醒博客" /></a>',
		'type' => 'textarea');	
		
		
	/*******自定义Header/footer代码*******/
	$options[] = array(
		'name' => __('自定义代码'),
		'type' => 'heading');
		$options[] = array(
		'name' => __('自定义Header代码'),
		'desc' => __('如果有任何想添加在头部的代码，可以写在这里。例如一些调用JS的代码、css代码等。'),
		'id' => 'headcode',
		'std' => '',
		'type' => 'textarea');
		
		$options[] = array(
		'name' => __('自定义底部footer代码'),
		'desc' => __('如果有任何想添加在底部的代码，可以写在这里。例如一些调用JS的代码等。'),
		'id' => 'footcode',
		'std' => '',
		'type' => 'textarea');
		
		
	return $options;
}