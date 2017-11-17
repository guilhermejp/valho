<!DOCTYPE html>
<html>
    <head>
        
        <!-- Title -->
        <title>Admin | Conartes</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="icon" href="<?=base_url('assets/images/icon.ico');?>">
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href="<?=base_url('assets/admin/plugins/pace-master/themes/blue/pace-theme-flash.css')?>" rel="stylesheet"/>
        <link href="<?=base_url('assets/admin/plugins/uniform/css/uniform.default.min.css')?>" rel="stylesheet"/>
        <link href="<?=base_url('assets/admin/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/admin/plugins/fontawesome/css/font-awesome.css')?>')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/line-icons/simple-line-icons.css')?>" rel="stylesheet" type="text/css"/>	
        <link href="<?=base_url('assets/admin/plugins/waves/waves.min.css')?>" rel="stylesheet" type="text/css"/>	
        <link href="<?=base_url('assets/admin/plugins/switchery/switchery.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/plugins/3d-bold-navigation/css/style.css')?>" rel="stylesheet" type="text/css"/>	
        
        <!-- Theme Styles -->
        <link href="<?=base_url('assets/admin/css/modern.min.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url('assets/admin/css/custom.css')?>" rel="stylesheet" type="text/css"/>
        
        <script src="<?=base_url('assets/admin/plugins/3d-bold-navigation/js/modernizr.js')?>"></script>
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="page-login">
        <main class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-3 center">
                            <div class="login-box">
                                <a href="<?=base_url('')?>" class="logo-name text-lg text-center">
                                    <img src="<?=base_url('assets/images/logo-valho.png')?>">
                                </a>
                                <p class="text-center m-t-md">Preencha com seus dados para acessar.</p>
                                <form class="m-t-md" method="POST">
                                    <?
                                    $login_feedback = $this->session->flashdata('login_feedback');
                                    if(!empty($login_feedback)){
                                        ?>
                                        <div class="alert alert-<?=$login_feedback['type']?>"><?=$login_feedback['message']?></div>
                                        <?
                                        $this->session->flashdata('login_feedback', FALSE);
                                    }
                                    ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Usuário" required name="username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" required name="password">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block">Login</button>
                                </form>
                                <p class="text-center m-t-xs text-sm"><?=date('Y')?> &copy; <a href="http://www.whydigital.com.br" target="_blank">Why Digital</a>.</p>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
	

        <!-- Javascripts -->
        <script src="<?=base_url('assets/admin/plugins/jquery/jquery-2.1.4.min.js')?>"></script>
        <script src="<?=base_url('assets/admin/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
        <script src="<?=base_url('assets/admin/plugins/pace-master/pace.min.js')?>"></script>
        <script src="<?=base_url('assets/admin/plugins/jquery-blockui/jquery.blockui.js')?>"></script>
        <script src="<?=base_url('assets/admin/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?=base_url('assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
        <script src="<?=base_url('assets/admin/plugins/switchery/switchery.min.js')?>"></script>
        <script src="<?=base_url('assets/admin/plugins/uniform/jquery.uniform.min.js')?>"></script>
        <script src="<?=base_url('assets/admin/plugins/classie/classie.js')?>"></script>
        <script src="<?=base_url('assets/admin/plugins/waves/waves.min.js')?>"></script>
        <script src="<?=base_url('assets/admin/js/modern.min.js')?>"></script>
        
    </body>
</html>