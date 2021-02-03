<?php

defined('ABSPATH') or die('No script kiddies please!');

$theopt = filter_input(INPUT_POST, 'purge_opt', FILTER_SANITIZE_STRING);

if(isset($_POST['submit'])){
 update_option("miksco_fcp", ($theopt ? (in_array($theopt, array(1,2)) ? $theopt : '2') : '2'));
 echo '	<div class="updated"><p>Settings saved!</p></div>';
}

$opt = get_option("miksco_fcp");
?>
<div class="wrap">
	<h1>FB Cache Cleaner</h1>
	<form action="?page=pem_impostazioni" method="post">
	 <table class="form-table">
	  <tr>
	   <th>Clear cache for:</th>
	   <td>
	    <label>
		 <input type="radio" name="purge_opt" value="1"<?php if($opt == '1'){ echo ' checked'; } ?>>
		 <span>Only public posts</span>
		</label>
		
		<br>

	    <label>
		 <input type="radio" name="purge_opt" value="2"<?php if($opt == '2'){ echo ' checked'; } ?>>
		 <span>Public and password protected</span>
		</label>
	   </td>
	  </tr>
	  </table>
	  <input class="button button-primary" name="submit" type="submit" value="Save Settings">
	</form>
	
	<h2 style="margin-top:20px">Clear cache for all posts</h2>

<?php
 if(filter_input(INPUT_GET, 'cache', FILTER_SANITIZE_STRING) == "all"){
  set_time_limit(0);
  
  global $post;
  $all_post = get_posts();
  
  foreach($all_post as $post){
   setup_postdata($post);
   
   ob_start();
    the_permalink();
    $permalink = ob_get_contents();
   ob_end_clean();
   
   wp_remote_post("https://graph.facebook.com?id=".$permalink."&scrape=true");
  }

?>
	<div class="updated"><p>Cache cleared for all posts!</p></div>
<?php
 }
?>

	<p class="update-nag" style="width:90%">By clicking on the follow button you clear the cache for all posts.
	<br>This operation can take more than a minute, depending on the speed of server.
	<br>Is recommended to use this feature unless necessary.</p>
	
	<p style="clear:both">
	 <a href="?page=miksco_fcp&cache=all" class="button button-primary" style="background-color:#C00000; border-color:#C00000;">Clear all</a>
	</p>
</div>