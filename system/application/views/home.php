<div id="capa-home">


<div id="container-capa">

<div class="title-capa">

VENDA SEU CARRO EM MINUTOS

</div>

<span>Nós compramos com total segurança.</span>

<div class="container">

<div class="row">

<div class="col-sm-6 col-md-3 col-md-offset-3 col-sm-offset-0 col-btn">
<a class="bt-capa btn btn-block" href="<?=base_url('agende_inspecao');?>">Cotar o Meu Veículo</a>


</div>

<div class="col-sm-6 col-md-3 col-btn">


<a class="bt-capa btn  btn-block"  href="<?=base_url('como_funciona');?>">Como funciona</a>
</div>

</div>

</div>


</div>

</div>

<main>

<section id="como-funciona">

<div class="title">
COMO <strong>FUNCIONA</strong>

<div class="traco"></div>

</div>


<div id="como-content">



<div class="container">


<div class="col-sm-4 col-icon">

<div class="item-como">
<div class="icon icon-calendario"></div>

<div class="numero">1</div>
<div class="line-como"></div>
<p>Cadastre seu veículo e<br>
agende a avaliação</p>
</div>

</div>


<div class="col-sm-4 col-icon">

<div class="item-como">
<div class="icon icon-carro"></div>
<div class="numero">2</div>
<div class="line-como"></div>
<p>Leve seu carro<br>
para vistoria</p>
</div>

</div>



<div class="col-sm-4 col-icon">

<div class="item-como">
<div class="icon icon-moedas"></div>
<div class="numero">3</div>
<div class="line-como"></div>
<p>Receba a oferta na hora
<br>e aceite sim ou não</p>
</div>

</div>


<div class="text-center">
<a class="cotar btn" href="<?=base_url('agende_inspecao');?>">Cotar o Meu Veículo</a>
</div>



</div>

</div>



</section>

<section id="vantagens">

<div class="title">
VANTAGENS  <strong>VALHO</strong>

<div class="traco"></div>

</div>

<div id="vantagens-content">

<div class="container">

<div class="col-md-4 col-ball">

<div class="icon-ball">

<div class="icon icon-escudo"></div>

</div>

<h4>SEGURANÇA</h4>

<p>Vistoriados especializados no mercado farão a melhor avaliação do seu usado</p>


</div>



<div class="col-md-4 col-ball">

<div class="icon-ball">

<div class="icon icon-dinheiro"></div>

</div>

<h4>PAGAMENTO IMEDIATO</h4>

<p>Vistoriados especializados no mercado farão a melhor avaliação do seu usado</p>


</div>




<div class="col-md-4 col-ball">

<div class="icon-ball">

<div class="icon icon-clock"></div>

</div>

<h4>AGILIDADE</h4>

<p>Vistoriados especializados no mercado farão a melhor avaliação do seu usado</p>


</div>


<div class="text-center">
<a class="cotar btn" href="<?=base_url('agende_inspecao');?>">Cotar o Meu Veículo</a>
</div>


</div>

</div>


</section>

<section id="video-home">

<div id="capa-video">


<div id="inner-video">

<h4>Procedimento de compra em 1 minuto</h4>

<p>Assista ao vídeo a Valho</p>

<a href="https://www.youtube.com/watch?v=VpWM5-2KsrY" data-toggle="lightbox" data-width="1024"><div class="icon icon-player"></div></a>

<div class="duracao">

<strong>Duração:</strong> 1:01
</div>

</div>


</div>


</section>


<section id="depoimentos">

<div class="title">
DEPOIMENTOS

<div class="traco"></div>

</div>

<div class="container">

<div id="carousel-depoimentos" class="owl-carousel owl-theme">

<?php foreach($testimonials as $itens){ ?>
<div class="item-depoimentos">
  <div class="box-depoimentos">
    <div class="quote">
      <?= $itens->testimony; ?>
    </div>
  </div>
  <div class="container-foto-depo">
    <img src="<?=base_url('assets/uploads/testimonials/'.$itens->img);?>"/>  
    <div class="nome-depo">
      <strong><?= $itens->name; ?></strong>
      <span><?= $itens->profission; ?></span>
    </div>
  </div>
</div>

<?php }?>

</div>

</div>



</section>

<section id="posts-recentes">
  <div class="container">
    <div class="title">
      POSTS <strong>RECENTS</strong>
      <div class="traco"></div>
    </div>

<?php

  foreach($posts as $post){

?>    
<div class="row">
<div class="col-sm-6">
<a href="<?=$post->guid;?>">
<div class="thumb">
<div class="data">

<div class="mes"><?=strtoupper(date("M",strtotime($post->post_date)));?></div>
<div class="dia"><strong><?=date("d",strtotime($post->post_date));?></strong></div>

</div>
  <img class="img-responsive" src="<?=$post->guid;?>" />
  </div>
<h1><?=$post->post_title;?></h1>
<p>
<?=substr($post->post_content,0,150);?>
</p>


</a>
</div>
<?php } ?>

</div>

</div>




</section>



</main>

<?
/*                define('WP_USE_THEMES', false);
                //require(APPPATH.'../../blog/wp-load.php');
                require(APPPATH.'/../../blog/wp-load.php');
                query_posts( array( 'post_type' => 'post', 'posts_per_page' => 5) );
                if (have_posts()){
                  $count_row = 0;
                  while (have_posts()){
                    the_post();
                  if($count_row == 0){
                    ?>
            <div class="col-md-6 col-xs-12 item-masonry">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?
                        }else{
                          ?>
                    <div class="col-md-3 col-xs-12 item-masonry <?=$count_row == 1?'grid-sizer':''?>">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?
                    }
                     ?>
                <div class="container-desc">
                <div class="table-des">
                <div class="cell-desc">
                <h1><?php the_title(); ?></h1>
                <span><?php the_time('d'); ?> de <?php the_time('F'); ?> de <?php the_time('Y'); ?></span>
                </div>
                </div>
                </div>
                <?php the_post_thumbnail('th-blog-home');  ?>
                </a>
                </div>
                <?
                    $count_row++;
                      }
                    }
               */ ?>