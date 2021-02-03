<?php get_header();?>
<div id="page-content">
	<div class="container">
		<div class="box404">
			<div class="page404-title">
				<h4>頁面即將載入，請稍等...</h4>
			</div>
			<div class="buttons">
				<div class="pull2-left">
					<a title="刷新頁面" href="javascript:window.location.reload();" class="btn btn-primary">立即重新進入</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function update()
{
window.location.reload();
}
setTimeout("update()",2000);
</script>
<?php get_footer(); ?>