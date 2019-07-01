<?php 
global $post;

$menuLocations = get_nav_menu_locations();
$menuID = $menuLocations['main-menu'];
$menuitems = wp_get_nav_menu_items( $menuID, array( 'order' => 'DESC' ) );
$submenu = false;
$sub_parent = false;
$no_sub_parent = false;
$sub_parent_ID;
$count = 0;

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
        <header>
            <nav>
                <ul>
                    <?php
                        foreach($menuitems as $item){
                            $link = $item->url;
                            $title = $item->title;
                            $next_item_parent = $menuitems[$count + 1]->menu_item_parent;

                            if( !$item->menu_item_parent){
                                $parent_id = $item->ID;
                                $full_nav = get_field('full_width', $item); ?>
                                <li class="<?php if($full_nav){ echo'full_menu '; } if(site_url().$_SERVER['REQUEST_URI']==$link){ echo'active'; } ?>"><a href="<?php echo $link; ?>" class="<?php if(site_url().$_SERVER['REQUEST_URI']==$link){ echo'active'; } ?>"><?php echo $title; ?></a>  
                            <?php } 
                        }
                    ?>    
                </ul>
            </nav>
        </header>
