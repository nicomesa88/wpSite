<?php

// check if the flexible content field has rows of data
if( have_rows('content') ):

     // loop through the rows of data
    while ( have_rows('content') ) : the_row(); ?>
    
    <div>
        <?php if( get_row_layout() == 'text' ):?>
        <div>
            <?php the_sub_field('text');
            the_sub_field('text_2'); ?>
        </div>
        <?php endif; ?>
    </div>

    <div>
        <?php if( get_row_layout() == 'image' ): ?>
        <div>
            <img src="<?php the_sub_field('image');?>">
            <?php the_sub_field('caption'); ?>
        </div>
        <?php endif; ?>
    </div>

    <div>
        <?php if( get_row_layout() == 'quote' ): ?>
        <div>
            <?php the_sub_field('quote');
            the_sub_field('name'); ?>
        </div>
       <?php endif; ?>
    </div>
    <?php endwhile;

else :

    // no layouts found

endif;

?>