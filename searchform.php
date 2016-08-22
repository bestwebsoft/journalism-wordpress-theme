<?php
/**
 * Template for displaying search form
 *
 * @subpackage journalism
 * @since      journalism
 */
?>
<div class="journalism-search-wrap">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input id="search" class="journalism-search-field" type="text" placeholder="<?php esc_attr_e( 'Enter search keyword', 'journalism' ); ?>" name="s" value="<?php the_search_query(); ?>"  title=""/>
	</form>
</div>
