<?php $title = get_the_title();
?>

<?php get_header();?>

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


    <?php 
    // the query
    $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1)); ?>
    
    <?php if ( $wpb_all_query->have_posts() ) : ?>
    
    <ul>
    
        <!-- the loop -->
        <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
        <!-- end of the loop -->
    
    </ul>
    
        <?php wp_reset_postdata(); ?>
    
    <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
</main>

<?php get_footer();?>