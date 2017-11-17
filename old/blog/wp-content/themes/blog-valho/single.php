<?php get_header(); ?>





<div class="hidden-xs hidden-sm" id="banner-blog">



<div class="container-fluid">
<div class="row">


 <?php
	query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page=3');
	if (have_posts()) : while (have_posts()) : the_post(); ?>

	
	
<div class="col-md-4">

<a   href="<?php echo get_permalink(); ?>"  rel="bookmark">
<div <?php

    if ( $thumbnail_id = get_post_thumbnail_id() ) {
        if ( $image_src = wp_get_attachment_image_src( $thumbnail_id, 'normal-bg' ) )
            printf( ' style="background-image: url(%s);"', $image_src[0] );     
    }
	

?> class="container-mini-banner">
<div class="inner-banner-blog">

<h1><?php the_title(); ?></h1>


<div class="meta"><?php the_time('j, F, Y') ?></div>

</div>

</div>

</a>
</div>


	<?php
	endwhile; endif;
	wp_reset_query();
?>














</div>

</div>

</div>

<main>




<div class="container">


<div class="row">
<div class="col-md-8">





    <?php if (have_posts()) : while (have_posts()) : the_post();  ?>


<div class="item-blog">

<div class="thumb">

<div class="data">

<div class="mes"><?php the_time('M') ?></div>
<div class="dia"><strong><?php the_time('j') ?></strong></div>

</div>

<a href="#">

 <?php the_post_thumbnail('th-blog');  ?>
  
  
  </a>
  
  </div>


<h1><?php the_title(); ?></a></h1>


 <?php the_content(); ?>


<div class="bt-share">

<div class="row">


<div class="col-md-12">

<ul class="share-blog">



<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="social-icon-blog"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

<li><a href="https://twitter.com/home?status=<?php the_permalink(); ?>"  class="social-icon-blog"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"  class="social-icon-blog"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
</ul>




</div>



</div>

</div>



</div>

<?php endwhile; endif; ?>

</div>

<div id="side-bar" class="col-md-4">
<aside>

<form role="search"  id="searchform">
        
      
      <div class="input-group">  
        
   
  
     <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input name="s" class="form-control" placeholder="Encontre no blog" type="text">
     
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            PESQUISAR
                        </button>
                    </span>
                </div>
            </div>
     
     
     
       
     
 
  </div></form>

</aside>



<aside>

<div  class="widget widget_categories">

<h2 >CATEGORIAS</h2>	
<ul>
	<li><a href="#">Conservação</a>
</li>
	<li ><a href="#">Curiosidades</a>
</li>
	<li ><a href="#">Dicas</a>
</li>
	<li> <a href="#">Geral</a>
</li>
	<li ><a href="#">Institucional</a>
</li>
	<li ><a href="#">Mecânica</a>
</li>
	<li ><a href="#">Segurança</a>
</li>
	<li ><a href="#">Trânsito</a>
</li>
		</ul>
</div>


</aside>

<aside>
<div id="tag_cloud-2" class="widget widget_tag_cloud"><h2 class="widgettitle">TAGS</h2><div class="tagcloud"><span class="st_tag"><a href="http://www.portalautoshopping.com.br/blog/tag/mecanica/" class="tag-link-9 tag-link-position-1" title="1 tópico" style="font-size: 8pt;">mecânica</a></span>
<span class="st_tag"><a href="http://www.portalautoshopping.com.br/blog/tag/pneus/" class="tag-link-10 tag-link-position-2" title="2 tópicos" style="font-size: 22pt;">pneus</a></span>
<span class="st_tag"><a href="http://www.portalautoshopping.com.br/blog/tag/seguranca/" class="tag-link-11 tag-link-position-3" title="1 tópico" style="font-size: 8pt;">segurança</a></span>
<span class="st_tag"><a href="http://www.portalautoshopping.com.br/blog/tag/seguro/" class="tag-link-8 tag-link-position-4" title="2 tópicos" style="font-size: 22pt;">seguro</a></span></div>
</div>


</aside>

</div>


</div>


</div>

</main>






<?php get_footer(); ?>
