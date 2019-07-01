<?php get_header();?>

<main id="main-content" style="background-color:#D3D3D3;">
<?php if($title){ ?>
    <h2>
        <?php echo $title; ?>
    </h2>
<?php } 
    while ( have_posts() ) : the_post();?> 
    <?php echo the_content(); 
    endWhile;?>
    <p>This text is being hardcoded in while the text above is being pulled from the wordpress editor</p>
</main>

<?php get_footer();?>