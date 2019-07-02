<?php

// check if the flexible content field has rows of data
if( have_rows('content') ):

     // loop through the rows of data
    while ( have_rows('content') ) : the_row(); ?>

        <?php if( get_row_layout() == 'text' ):?>
        <div>
            <?php the_sub_field('text');
            the_sub_field('text_2'); ?>
        </div>
        <?php endif; ?>
   
        <?php if( get_row_layout() == 'image' ): 
        $image = get_sub_field('image');
        // echo'<pre>';
        // var_dump($image);
        // echo '</pre>';
        ?>
        <div>
            <img src="<?php echo $image['sizes']['thumbnail'];?>">
            <?php the_sub_field('caption'); ?>
        </div>
        <?php endif; ?>
    
        <?php if( get_row_layout() == 'quote' ): ?>
        <div>
            <?php the_sub_field('quote');
            the_sub_field('name'); ?>
        </div>
       <?php endif; ?>
       
    <?php endwhile;

else :

    // no layouts found

endif;

?>