<?php
/**
 * Template part for displaying series posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroplay
 */

    global $query_series, $wp_query;

    $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : get_query_var('paged');

    $query_series = new WP_Query( tr_args($type=9, $paged) );

    if ( $query_series->have_posts() ) {

?>
<!--<section>-->

<!--</section>-->
<?php } ?>