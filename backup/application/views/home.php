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


<div class="row">

<div class="col-sm-6">

<a href="#">
<div class="thumb">

<div class="data">

<div class="mes">MAI</div>
<div class="dia"><strong>20</strong></div>

</div>

  <img class="img-responsive" src="<?=base_url('assets/images/th-home.jpg');?>" />
  
  
  
  
  </div>


<h1>LOREM IPSUM DOLOR SIT AMET</h1>


<p>
Vestibulum a feugiat felis, nec fermentum massa. Nulla finibus, magna id vehicula bibendum, mi ex pretium dui, non interdum arcu magna ac erat. 

</p>


</a>
</div>


<div class="col-sm-6">
<a href="#">
<div class="thumb">

<div class="data">

<div class="mes">MAI</div>
<div class="dia"><strong>20</strong></div>

</div>

  <img class="img-responsive" src="<?=base_url('assets/images/th-home.jpg');?>" />
  
  
  
  
  </div>


<h1>LOREM IPSUM DOLOR SIT AMET</h1>


<p>
Vestibulum a feugiat felis, nec fermentum massa. Nulla finibus, magna id vehicula bibendum, mi ex pretium dui, non interdum arcu magna ac erat. 

</p>

</a>

</div>

</div>

</div>




</section>



</main>