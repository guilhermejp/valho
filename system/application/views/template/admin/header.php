<!DOCTYPE html>
<html>
    <head>

        <!-- Title -->
        <title>Dashboard - Valho</title>

        <link rel="icon" href="<?=base_url('assets/images/icon.ico');?>">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />

        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href="<?=base_url('assets/admin/plugins/pace-master/themes/blue/pace-theme-flash.css')?>" rel="stylesheet"/>
        <link href="<?=base_url('assets/admin/plugins/uniform/css/uniform.default.min.css')?>" rel="stylesheet"/>
        <link href="<?=base_url('assets/admin/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/fontawesome/css/font-awesome.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/line-icons/simple-line-icons.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/waves/waves.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/switchery/switchery.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/3d-bold-navigation/css/style.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/slidepushmenus/css/component.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/weather-icons-master/css/weather-icons.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/metrojs/MetroJs.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/toastr/toastr.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/sortable/sortable.css')?>" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/fileupload/css/blueimp-gallery.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/fileupload/css/jquery.fileupload.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/fileupload/css/jquery.fileupload-ui.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/admin/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')?>">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- CSS adjustments for browsers with JavaScript disabled -->
        <noscript><link rel="stylesheet" href="<?=base_url('assets/admin/plugins/fileupload/css/jquery.fileupload-noscript.css')?>"></noscript>
        <noscript><link rel="stylesheet" href="<?=base_url('assets/admin/plugins/fileupload/css/jquery.fileupload-ui-noscript.css')?>"></noscript>

        <!-- Calendar -->
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/admin/plugins/fullcalendar/fullcalendar.min.css');?>" />
        <!-- Theme Styles -->
        <link href="<?=base_url('assets/admin/css/modern.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/css/custom.css')?>" rel="stylesheet" type="text/css"/>

        <!-- Summernote -->
        <link href="<?=base_url('assets/admin/dist/summernote.css')?>" rel="stylesheet" type="text/css"/>

        <script src="<?=base_url('assets/admin/plugins/3d-bold-navigation/js/modernizr.js')?>"></script>


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
        var base_url = '<?=base_url('admin')?>';
        </script>

    </head>
    <body class="page-header-fixed compact-menu page-horizontal-bar">
        <div class="overlay"></div>
        <main class="page-content content-wrap">
            <div class="navbar">
                <div class="navbar-inner container">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="<?=base_url('admin')?>" class="logo-text"><span><img class="img-responsive" src="<?=base_url('assets/images/logo-valho.png');?>"/></span></a>
                    </div><!-- Logo Box -->
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-left">
                                <li>
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <span class="user-name"><?=$this->session->userdata('name')?><i class="fa fa-angle-down"></i></span>
                                        <img class="img-circle avatar" src="<?=base_url('assets/admin/images/avatar1.png')?>" width="40" height="40" alt="">
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <?/*
                                        <li role="presentation"><a href="profile.html"><i class="fa fa-user"></i>Profile</a></li>
                                        <li role="presentation"><a href="calendar.html"><i class="fa fa-calendar"></i>Calendar</a></li>
                                        <li role="presentation"><a href="inbox.html"><i class="fa fa-envelope"></i>Inbox<span class="badge badge-success pull-right">4</span></a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock screen</a></li>
                                        */?>
                                        <li role="presentation"><a href="<?=base_url('user/logout')?>"><i class="fa fa-sign-out m-r-xs"></i>Sair</a></li>
                                    </ul>
                                </li>
                            </ul><!-- Nav -->
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div><!-- Navbar -->
            <div class="page-sidebar sidebar horizontal-bar">
                <div class="page-sidebar-inner">
                    <ul class="menu accordion-menu">
                        <li class="nav-heading"><span>Navigation</span></li>
                        <li><a href="<?=base_url('admin')?>"><span class="menu-icon icon-speedometer"></span><p>Dashboard</p></a></li>
                        <li><a href="#"><span class="menu-icon icon-home"></span>Editar Conte&uacute;do P&aacute;ginas</a>
                            <ul class="dropdown-list" >
                                <li><a href="<?=base_url('testimony')?>"><span class="menu-icon icon-book-open"></span><p>Depoimentos</p></a></li>
                                <li><a href="<?=base_url('content/index/a_valho')?>"><span class="menu-icon icon-home"></span><p>A Valho</p></a></li>
                                <li><a href="<?=base_url('content/index/como_funciona')?>"><span class="menu-icon icon-puzzle"></span><p>Como Funciona</p></a></li>
                                <li><a href="<?=base_url('content/index/fale_conosco')?>"><span class="menu-icon icon-bubble"></span><p>Fala Conosco</p></a></li>
                            </ul>
                        </li>
                        <li><a href="<?=base_url('agenda')?>"><span class="menu-icon icon-calendar"></span><p>Agenda</p></a></li>
                        <li><a href="<?=base_url('contact')?>"><span class="menu-icon icon-users"></span><p>Contatos</p></a></li>
                        <li><a href="<?=base_url('place')?>"><span class="menu-icon icon-pin"></span><p>Localidades</p></a></li>
                    </ul>
                </div><!-- Page Sidebar Inner -->
            </div>
            <div class="page-inner">
