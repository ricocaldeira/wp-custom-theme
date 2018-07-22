<form action="<?php echo esc_url( home_url( '/'  ) );?>" class="searchform" id="prsearchform" method="get">
	<div>
		<input type="text" id="s" name="s" value="" placeholder="<?php esc_html_e('Search', 'wp-elementy') ?>">
		<button type="submit" id="searchsubmit"><i class="icon_search"></i></button>
	</div>
</form>