<?php
/**
 * Slider
 *
 * @package Toroplay
 */

    if( get_theme_mod( 'tp_slidermoved', 1 ) != 1 ) return;

    if(is_front_page() and is_home() and !is_paged() and !isset($_GET['r_sortby']) and !isset($_GET['v_sortby']) and get_theme_mod('show_slider', 1)==1){
    if ( false === ( $trslidermoved_query_results = get_transient( 'trslidermoved_query_results' ) ) ) {
        
        if( get_theme_mod('slider_orderby', 1) == 1 ){
        
            $args=array(

                'posts_per_page'=> get_theme_mod('posts_per_slider', 4),
                'orderby' => 'rand',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' )

            );
            
        }elseif( get_theme_mod('slider_orderby', 1) == 2 ){
            
            $args=array(

                'posts_per_page'=> get_theme_mod('posts_per_slider', 4),
                'orderby' => 'desc',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' )

            );
            
        }elseif( get_theme_mod('slider_orderby', 1) == 3 ){
            
            $args=array( 
                'meta_key' => 'ratings_average',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' ),
                'posts_per_page'=> get_theme_mod('posts_per_slider', 4),
            );
            
        }elseif( get_theme_mod('slider_orderby', 1) == 4 ){
            
            $args=array( 
                'meta_key' => 'views',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' ),
                'posts_per_page'=> get_theme_mod('posts_per_slider', 4),
            );
            
        }elseif( get_theme_mod('slider_orderby', 1) == 5 ){
            
            $sticky = get_option( 'sticky_posts' );
            
            $args=array(
                'post__in' => $sticky,
                'ignore_sticky_posts'=> 1,
                'post_type' => array( 'series', 'movies' ),
                'posts_per_page'=> get_theme_mod('posts_per_slider', 4),                
            );
            
        }
        
        // The Query
        $trslidermoved_query_results = new WP_Query( $args );
        set_transient( 'trslidermoved_query_results', $trslidermoved_query_results, 12 * HOUR_IN_SECONDS );
    }

    // The Loop
    if ($trslidermoved_query_results->have_posts() ) :

?>

<?php
	/* Restore original Post Data */
    wp_reset_postdata();

    endif;
    }
?>