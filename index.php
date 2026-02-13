 <?php get_header();
    
    
if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        // Your loop code
    endwhile;
else :
    echo 'toto';
endif;

 get_footer();?>