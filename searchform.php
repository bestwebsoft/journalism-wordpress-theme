<!-- template to displaying a search form -->
<div class="journalism-search-wrap">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input id="search" class="journalism-search-field" type="text" onclick="this.value=''" name="s"  value="<?php the_search_query(); ?>"/>
	</form>
</div>
