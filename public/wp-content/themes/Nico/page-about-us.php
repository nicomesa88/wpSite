<?php get_header();
$title = get_the_title();
?>

<main id="main-content" style="background-color:#D3D3D3;">
<?php if($title){ ?>
 
        <?php echo $title; ?>
    
<?php }
    while ( have_posts() ) : the_post();?> 
    
    <?php echo the_content(); 
    endWhile;?>
  
</main>
<?php get_footer();?>