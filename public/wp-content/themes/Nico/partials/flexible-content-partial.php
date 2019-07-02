<?php

// check if the flexible content field has rows of data
if( have_rows('content') ):

     // loop through the rows of data
    while ( have_rows('content') ) : the_row();

        if( get_row_layout() == 'text' ):

            the_sub_field('columns');
            the_sub_field('text');
            the_sub_field('text_2');
        endif;

        if( get_row_layout() == 'image' ):

            the_sub_field('image');
            the_sub_field('caption');
        endif;

        if( get_row_layout() == 'quote' ):

            the_sub_field('quote');
            the_sub_field('name');
        endif;

    endwhile;

else :

    // no layouts found

endif;

?>