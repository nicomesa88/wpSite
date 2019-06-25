<?php get_header();
$title = get_the_title();
?>

<main id="main-content" style="background-color:#D3D3D3;">
<?php if($title){ ?>
    <h2>
        <?php echo $title; ?>
    </h2>
<?php }
    while ( have_posts() ) : the_post();?> 
    <h3>
    <?php echo the_content(); 
    endWhile;?>
    </h3>
</main>
<?php get_footer();?>