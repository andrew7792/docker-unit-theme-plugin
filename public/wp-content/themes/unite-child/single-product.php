<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package unite
 */

get_header(); ?>

<div id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option( 'site_layout' ); ?>">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>


            <?php $_params =  get_post_custom() ;

            $_country = get_the_terms( $post, 'country' );
            $_genre = get_the_terms( $post, 'genre' ) ;

            ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span class="subtitleFilm">Стоимость сеанса:</span><?=$_params['Стоимость сеанса:'][0]?>;
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span class="subtitleFilm">Дата выхода в прокат:</span><?=$_params['Дата выхода в прокат:'][0]?>;
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span class="subtitleFilm">Страна:</span><?=$_country[0]->name?>;
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <span class="subtitleFilm">Жанр:</span><?=$_genre[0]->name?>.
                </div>
            </div>
            <div class="postContent">
                <?php get_template_part( 'content', 'page' ); ?>
            </div>
            <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || '0' != get_comments_number() ) :
                comments_template();
            endif;
            ?>






        <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
</div><!-- #primary -->


<?php get_sidebar(); ?>
<?php get_footer(); ?>
