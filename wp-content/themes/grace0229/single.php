<?php get_header(); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
<script src="https://cdn.jsdelivr.net/clappr.level-selector/latest/level-selector.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//cdn.doublemax.net/image/creative/20190613/basketball_like.css">

<script>
var cfua = navigator.userAgent;
	var isM =　{
		Android: function() {
            return cfua.match(/Android/i)
        },
        BlackBerry: function() {
            return cfua.match(/BlackBerry/i)
        },
        iOS: function() {
            return cfua.match(/iPhone|iPad|iPod/i)
        },
        Opera: function() {
            return cfua.match(/Opera Mini/i)
        },
        Windows: function() {
            return cfua.match(/IEMobile/i)
        },
        any: function() {
            return (isM.Android() || isM.BlackBerry() || isM.iOS() || isM.Opera() || isM.Windows())
        }
	};

</script>

<div  class="posts-cjtz content-cjtz clearfix" style='text-align:center;margin-top:15px;'>


</div>

<div id="page-content">
	<!-- cf浮标
	<ins class="clickforceads" style="display:inline-block;width:150px;height:150px;" data-ad-zone="9433"></ins>
	<script async type="text/javascript" src="//cdn.doublemax.net/js/init.js"></script> -->
	<div class="container">
	  
		<div class="post-box">
			<div class="post">
				<?php if(have_posts()): while(have_posts()):the_post();  ?>
				<div class="post-title">
					<?php the_tags('<div class="post-entry-categories">','','</div>'); ?>
					<h1 class="title"><?php the_title(); ?></h1>
					<div class="post_icon"> 
						<span  class="postcat"><i class=" icon-list-1"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></span>
						<span class="postclock"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span>
						<span class="posteye"><i class=" icon-eye-3"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></span>
						<span class="postcomment"><i class="icon-comment-1"></i> <a href="<?php the_permalink(); ?>" title="評論"><?php comments_popup_link( __( '0' ) , __( '1'), __( '%') ); ?></a></span>
						<?php edit_post_link('[編輯]'); ?>
					</div>
				</div>
				<div class="posts-cjtz content-cjtz clearfix" style='text-align:center;'>
					<!-- PC-內文上方-728*90 -->



				</div>
				<div class="posts-cjtz content-cjtz-mini clearfix" style="text-align:center;">

                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- noh-web-内文1 -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:300px;height:250px"
                         data-ad-client="ca-pub-4059643053601138"
                         data-ad-slot="6118307327"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

				</div>	
				<div id="post-content" class="post-content">
					<?php if(has_excerpt()): ?>
						<p class="post-abstract"><span class="abstract-tit">摘要：</span><?php echo get_the_excerpt(); ?></p>
					<?php endif;?>
					<?php 
						the_content();
                    ?>
                    <?php
                    suxing_link_pages('before=<div class="page-links">&after=&next_or_number=next&previouspagelink=上一頁&nextpagelink=');  suxing_link_pages('before=&after='); suxing_link_pages('before=&after=</div>&next_or_number=next&previouspagelink=&nextpagelink=下一頁');
                    ?>

					<!--
					<br />
					<br />

					<h2>往下看更多新聞！</h2>
					<br />-->
					<?php 
						/*$next_post1 = get_next_post(true,'');
						if(!empty( $next_post1 )){
							$post1 = get_post($next_post1->ID);
						}*/
	
						/*$postTags = get_the_tags();
						$tagIds = array();
                        if ($postTags) {
                            $i = 0;
                            foreach($postTags as $tag) {
                                $tagIds[i] = $tag->term_id;
                                $i++;
                            }

                            $args = array(
                                'post_status' => 'publish', // 只选公开的文章.
                                'ignore_sticky_posts' => 1, // 排除置頂文章.
                                'orderby' => 'date',
                                'posts_per_page' =>3,
                                'post__not_in' => array( $post->ID ),
                                'tag__in' => $tagIds,
                            );

                            query_posts($args);
                            if (have_posts()) {
                               while (have_posts()) {
                                   the_post();
                                   update_post_caches($posts); */
									?>
                                     
					       <!--<h3 style="text-align:center"><?php //the_title(); ?></h3>
							<br />
							<div class="posts-cjtz content-cjtz-mini clearfix" style="text-align:center;">
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						
						<ins class="adsbygoogle"
							 style="display:inline-block;width:300px;height:250px"
							 data-ad-client="ca-pub-4059643053601138"
							 data-ad-slot="9077840137"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
					</div>-->
						   <?php 
								//the_content(); 
								//suxing_link_pages('before=<div class="page-links">&after=&next_or_number=next&previouspagelink=上一頁&nextpagelink=');  //suxing_link_pages('before=&after='); //suxing_link_pages('before=&after=</div>&next_or_number=next&previouspagelink=&nextpagelink=下一頁');
								//break;

						   ?>

                    <?php 
                               // }
                            //}
                       // }
                    ?>
	

                    <a id="single_mobile_cpi_box"  target="_blank" href="" class="posts-cjtz content-cjtz-mini clearfix">
                        <div class="single_mobile_cpi_box_boders content-cjtz-mini">
                           <h3>推薦</h3>
                           <h4>NBA直播、熱門新聞不錯過，加我們官方Line好友↓↓↓</h4>
                           <div></div>
                           <div style="text-align:center"><img class="cpi_ad_img" height="36" border="0" alt="添加好友" src="https://scdn.line-apps.com/n/line_add_friends/btn/zh-Hans.png" />
						   </div>
                           <div style="padding-bottom: 30px;"><span class="cpiDes" > </span><!--<span class="installBut">立即添加</span>--></div>
                        </div>
                    </a>
					<!--<div class="posts-cjtz content-cjtz-mini clearfix">
							 <a href="https://line.me/R/ti/p/%40kkg5212d"><img height="36" border="0" alt="添加好友" src="https://scdn.line-apps.com/n/line_add_friends/btn/zh-Hans.png"></a>
					</div>-->
                    <div id="recommendedrPosts" class="clearfix" style="margin-bottom:10px;" >
                        <h3>相關閱讀</h3>
                         <?php
                        $postTags = get_the_tags();
                        if ($postTags) {
                            $tagIds = array();
                            $i = 0;
                            foreach($postTags as $tag) {
                                $tagIds[i] = $tag->term_id;
                                $i++;
                            }
                            $args = array(
                                'post_status' => 'publish', // 只选公开的文章.
                                'ignore_sticky_posts' => 1, // 排除置頂文章.
                                'orderby' => 'date',
                                'posts_per_page' =>3,
                                'post__not_in' => array( $post->ID ),
                                'tag__in' => $tagIds,
                            );
                            query_posts($args);
                            if (have_posts()) {
                                while (have_posts()) {
                                    the_post();
                                    update_post_caches($posts);?>
                                    <a href="<?php the_permalink(); ?>"title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php
                    //echo single_pc_ad_pic();
                    ?>

					<div class="posts-cjtz content-cjtz clearfix" style='text-align:center;'>
					


					</div>
					
                    <div class="posts-cjtz content-cjtz-mini clearfix" style="text-align:center;">
                       
						
                    </div>

              

				</div>
				<div id="formCopyrigth" style="display:block">
				<?php
					$copyright = get_post_meta($post->ID, 'copyright', true);
     				$source = get_post_meta($post->ID, 'source', true);
					if($copyright){
        				echo '<br /><br />來源：'."<a href='$source' target='blank' rel='nofllow'>$copyright</a>";
     				}else{
						echo '<br /><br />來源：網路';
					}
				?>
				</div>
				<?php 
				//echo single_pc_ad_pic();
				//echo single_mini_ad_pic();
				?>
				<!--<div class="posts-cjtz content-cjtz-mini clearfix">
					<div class="onelist">
						<h3 class="list-title">推薦應用</h3>
						<ul>
							<li>
								<div id="single_mobile_cpi" class="box">
									
								</div>
							</li>
						</ul>
					</div>
				</div>-->
				
				<?php if(suxingme('nextprevposts',true)) { ?>
					<div class="next-prev-posts clearfix">
						<div class="prev-post"> 
							<?php 	
								$prev_post = get_previous_post(true,'');//与当前文章同分类的上一篇文章 
								if ( !empty( $prev_post ) ) : ?>
									<a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo $prev_post->post_title; ?>" target="_blank" class="next has-background" style="height:158px; background-image: url(<?php echo get_post_thumbnail_url($prev_post->ID); ?>)" alt="<?php echo $prev_post->post_title; ?>">	
										<span>上一篇</span><h4><?php echo $prev_post->post_title; ?></h4>
									</a> 
								<?php  else:?> 
									<a href="javascript:;" class="prev has-background" style="height:158px; cursor:not-allowed; background-image:url();" >	
										<h4>沒有啦!</h4>
									</a> 
							<?php endif;?>
						</div> 
						<div class="next-post">
						<?php 	
							$next_post = get_next_post(true,'');
							if(!empty( $next_post )): ?>
								<a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo $next_post->post_title; ?>"  target="_blank" class="next has-background" style="height: 158px; background-image: url(<?php echo get_post_thumbnail_url($next_post->ID); ?>)" alt="<?php echo $next_post->post_title; ?>">	
									<span>下一篇</span><h4><?php echo $next_post->post_title; ?></h4>
								</a> 
							<?php  else:?>
								<a href="javascript:;" class="next has-background" style="height: 158px;cursor:not-allowed;  background-image: url();" >	
									<h4>没有啦</h4>
								</a> 
							<?php endif;?>
						</div> 
					</div>
				<?php } ?>	 


				<!--<div class="posts-cjtz content-cjtz clearfix">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- PC-匹配广告
						<ins class="adsbygoogle"
							 style="display:block"
							 data-ad-client="ca-pub-4059643053601138"
							 data-ad-slot="5412522808"
							 data-ad-format="auto"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div> -->

				<!--<div class="posts-cjtz content-cjtz-mini clearfix" style="text-align:center;">
				    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- WEB-匹配内容
						<ins class="adsbygoogle"
							 style="display:inline-block;width:282px;height:235px"
							 data-ad-client="ca-pub-4059643053601138"
							 data-ad-slot="8226388403"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>	1 -->
			</div>
			
			<?php if(suxingme('related-post',true)) { ?>
			<div class="onelist">
				<h3 class="list-title">猜你喜歡</h3>
				<ul>
				<?php include get_template_directory() . '/includes/relatepost.php';?>
                </ul>
			</div>
			<?php }?>

<?php if(suxingme('suxingme_new_post',true)) { ?>
			<div class="onelist">
				<h3 class="list-title">最新熱點</h3>
				<ul>
   <?php
	$cats = 17;
	if ($cats) {
		$args = array(
			  'post_status' => 'publish', // 只选公开的文章.
			  'ignore_sticky_posts' => 1, // 排除置頂文章.
			  'cat'     => $catid,
			  'order'            => DESC,
			  'showposts' => 9,
			  'post__not_in' => array( $post->ID ),
		  );
	  query_posts($args);
	  if (have_posts()) {
		while (have_posts()) {
		  the_post(); update_post_caches($posts); ?>  
			<li>
				<div class="box">
					<a class="pic" href="<?php the_permalink(); ?>"title="<?php the_title(); ?>" target="_blank" style="background:url(<?php echo post_thumbnail_src();?>) no-repeat center top; background-size:cover;"></a>               
					<h2><a href="<?php the_permalink(); ?>"title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h2>
					<div class="meta">
						<span class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span>
						<span class="ico-eye"><i class="icon-eye-1"></i> <?php if(function_exists('the_views')){the_views(); }//post_views('',''); ?></span>		
					</div>
				</div>
			</li>
	<?php
		}
	  } 
	  else {
		echo '<li>暫無相關文章</li>';
	  }
	  wp_reset_query(); 
	}
	else {
	  echo '<li>暫無相關文章</li>';
	}
?>
                </ul>
			</div>
<?php } ?>


			<div class="clear"></div>
			<?php /*if (comments_open()) comments_template( '', true );*/ endwhile;  endif; ?>	
		</div>	
		<?php get_sidebar(); ?>
	</div>
</div>
  <div id="pbads"></div>
<div id="clickforceads_6286"></div>
<div id="vponads_div"></div>


 <script>


 var cplayerId = "#cplayer";
	  if($(cplayerId).length>0){
		var cpInitW = 700; 
		var cpInitH = 500; 
		var cpWidth = isM.any()  ? ($('#page-content').width() * 0.88 ) : cpInitW; 
		var cpSource = $(cplayerId).attr("data-source");

		if(!cpSource){
			cpSource = $(cplayerId).attr("title");
		}
	  
		var cpHeight = cpInitH; var cpproportion = cpInitH / cpWidth; if(cpproportion > 1.1){
			//如果宽高比有异常，则也把高度处理
			cpHeight = parseInt(cpInitH / cpproportion);
		}
		var player = new Clappr.Player({source: cpSource, 
		width:cpWidth, 
		height:cpHeight, 
		mediacontrol: {seekbar:"#0040ff",buttons:"#0040ff"}, 
		plugins: {'core': [LevelSelector]}, 
		parentId: cplayerId});
	  }
</script>
	
	<!--<script type="text/javascript" src="//ad.sitemaji.com/native/hater.js"></script>-->

<?php get_footer(); ?>
