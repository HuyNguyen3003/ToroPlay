<?php
/**
 * Template part for displaying episodes terms
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroplay
 */
    
    $type = is_page_template( 'pages/template-episodes.php' ) ? 5 : 4;
    $paged = isset($wp_query->query['paged']) ?  $wp_query->query['paged'] : get_query_var('paged');

    $episodes = get_terms( tr_args( $type, $paged ) );
    if( !empty ( $episodes ) ) {
?>
<!--<section>-->

<!--</section>-->
<?php } ?>