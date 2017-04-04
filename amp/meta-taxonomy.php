<?php $categories = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'amp' ), '', $this->ID ); ?>
<?php if ( $categories ) : ?>
	<div class="amp-wp-meta amp-wp-tax-category">
		<?php printf( esc_html__( 'Categorie: %s', 'amp' ), $categories ); ?>
	</div>
<?php endif; ?>

<?php
$tags = get_the_tag_list(
	'',
	_x( ', ', 'Used between list items, there is a space after the comma.', 'amp' ),
	'',
	$this->ID
); ?>
<?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
	<div class="amp-wp-meta amp-wp-tax-tag">
		<?php printf( esc_html__( 'Tags: %s', 'amp' ), $tags ); ?>
	</div>
<?php endif; ?>

<?php
$onderwerp = get_the_term_list(
        $this->ID,
	'onderwerp',
	'',
        ', '
); ?>
<?php if ( $onderwerp && ! is_wp_error( $onderwerp ) ) : ?>
        <div class="amp-wp-meta amp-wp-tax-onderwerp">
                <?php printf( esc_html__( 'Onderwerp: %s', 'amp' ), $onderwerp ); ?>
        </div>
<?php endif; ?>

<?php
$locatie = get_the_term_list(
        $this->ID,
        'locatie',
        '',
        ', '
); ?>
<?php if ( $locatie && ! is_wp_error( $locatie ) ) : ?>
        <div class="amp-wp-meta amp-wp-tax-locatie">
                <?php printf( esc_html__( 'Locatie: %s', 'amp' ), $locatie ); ?>
        </div>
<?php endif; ?>

<?php
$software = get_the_term_list(
        $this->ID,
        'software',
        '',
        ', '
); ?>
<?php if ( $software && ! is_wp_error( $software ) ) : ?>
        <div class="amp-wp-meta amp-wp-tax-software">
                <?php printf( esc_html__( 'Software: %s', 'amp' ), $software ); ?>
        </div>
<?php endif; ?>


<?php if( !is_singular( 'fotoapparatuur' ) ) { ?>
<div class="amp-wp-meta amp-wp-related-posts">
<h2><?php esc_html_e( 'Relevante artikelen', 'mvdk' ); ?></h2>
<?php
$get_post_tag_terms_from_post = get_the_terms( $post->ID, 'post_tag' );
if( $get_post_tag_terms_from_post ) {
	$post_tag_ids = wp_list_pluck( $get_post_tag_terms_from_post, 'term_id' );
}
$get_onderwerp_terms_from_post = get_the_terms( $post->ID, 'onderwerp' );
if( $get_onderwerp_terms_from_post ) {
	$onderwerp_ids = wp_list_pluck( $get_onderwerp_terms_from_post, 'term_id' );
}
$get_software_terms_from_post = get_the_terms( $post->ID, 'software' );
if( $get_software_terms_from_post ) {
	$software_ids = wp_list_pluck( $get_software_terms_from_post, 'term_id' );
}
$get_locatie_terms_from_post = get_the_terms( $post->ID, 'locatie' );
if( $get_locatie_terms_from_post ) {
	$locatie_ids = wp_list_pluck( $get_locatie_terms_from_post, 'term_id' );
}
$term_args = [
'update_post_term_cache' => false,
'update_post_meta_cache' => false,
'no_found_rows' => true,
'orderby' => 'rand',
'post__not_in' => [$post->ID],
'posts_per_page'=> 6,
'tax_query' => [
'relation' => 'OR',
[
'taxonomy' => 'post_tag',
'terms'    => $post_tag_ids,
'include_children' => false,
],
[
'taxonomy' => 'onderwerp',
'terms'    => $onderwerp_ids,
],
[
'taxonomy' => 'software',
'terms'    => $software_ids,
'include_children' => false,
],
[
'taxonomy' => 'locatie',
'terms'    => $locatie_ids,
'include_children' => false,
],
],
];
$term_query = new WP_Query($term_args);
if( $term_query->have_posts() ) { ?>
<ul>
<?php while ( $term_query->have_posts() ) {
$term_query->the_post();
printf( '<li><a href="%1$s" rel="bookmark">%2$s</a></li>', esc_url( get_permalink() . AMP_QUERY_VAR . '/' ), get_the_title() );
}
?>
</ul>
<?php } else { ?>
<p><?php esc_html_e( 'Voor dit artikel zijn geen relevante artikelen beschikbaar', 'mvdk' ); ?></p>
<?php } ?>
</div>
<?php } // Einde check is_singular( 'fotoapparatuur' ); ?>