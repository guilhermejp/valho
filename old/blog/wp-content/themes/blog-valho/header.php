<!DOCTYPE html>

<!--[if IE 7 | IE 8]>

<html class="ie" <?php language_attributes(); ?>>

<![endif]-->

<!--[if !(IE 7) | !(IE 8)  ]><!-->

<html <?php language_attributes(); ?>>

<!--<![endif]-->

<head>


<meta charset="<?php bloginfo( 'charset' ); ?>" />



<title><?php if(is_home() || is_search())  { bloginfo('name'); echo ' | '; bloginfo('description'); } else { wp_title(''); echo ' | '; bloginfo('name'); } ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico"/>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-theme.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/style.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/owl.theme.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">



<?php wp_head(); ?>






</head>



<body <?php body_class(); ?>>




<header>

<nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/logo-valho.png"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
       
          <ul class="nav navbar-nav navbar-right">
            <li><a href="valho.php">A VALHO</a></li>
            <li><a href="agende-inspecao.php"> VENDA SEU CARRO</a></li>
            <li><a href="como-funciona.php">COMO FUNCIONA</a></li>
            <li><a href="blog.php">BLOG</a></li>
             <li><a href="fale-conosco.php">FALE CONOSCO</a></li>
            
          
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    

</header>






