<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Toroplay
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body id="Tf-Wp" <?php body_class(); ?>>

<!--<Tp-Wp>-->
<div class="Tp-Wp" id="Tp-Wp">

    <!--<Header>-->
    <header class="Header MnBrCn BgA">
        <div class="MnBr EcBgA">
            <div class="Container">
                <figure class="Logo">
                <a href="https://500ae88.club/"><img src="https://500ae88.club/wp-content/themes/toroplay/img/logo-linux.png" data-src="https://500ae88.club/wp-content/themes/toroplay/img/logo-linux.png" alt=" Anime Hay" class="custom-logo"></a>
                </figure>
                <span class="Button MenuBtn AAShwHdd-lnk CXHd" data-shwhdd="Tp-Wp"><i></i><i></i><i></i></span>
                <!--<Rght>-->
                <span class="MenuBtnClose AAShwHdd-lnk CXHd" data-shwhdd="Tp-Wp"></span>
                <div class="Rght BgA">
                   
                    <!--<Menu>-->
                    <nav class="Menu">
    <ul>
        <?php
        // Kết nối với cơ sở dữ liệu sử dụng $wpdb
        global $wpdb;

        // Lấy tất cả danh mục từ bảng category
        $categories = $wpdb->get_results("SELECT * FROM category ORDER BY name ASC");

        // Kiểm tra nếu có danh mục và hiển thị chúng
        if ($categories) {
            foreach ($categories as $category) {
                ?>
                <li class="cat-item cat-item-<?php echo esc_attr($category->id); ?>">
                    <a href="https://500ae88.club/category/<?php echo esc_attr(sanitize_title_with_dashes($category->id)); ?>">
                        <?php echo esc_html($category->name); ?>
                    </a>
                </li>
                <?php
            }
        } else {
            echo '<li>No categories found.</li>';
        }
        ?>
    </ul>
</nav>

                    <!--</Menu>-->
                </div>
                <!--</Rght>-->
            </div>
        </div>
    </header>
    <!--</Header>-->

    <!--<Body>-->
    <div class="Body Container">
        <div class="Content">
        <div class="Container">
        
        <?php tr_banners('ads_hd_bt'); ?>