<div class="page-inner">
                <div class="page-breadcrumb">
                    <ol class="breadcrumb container">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li><a href="<?=base_url('testimony')?>">Depoimentos</a></li>
                        <li class="active">Listagem</li>
                    </ol>
                </div>
                <div class="page-title">
                    <div class="container">
                        <h3>Depoimentos</h3>
                    </div>
                </div>
                <div id="main-wrapper" class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group pull-right">
                                <a class="btn btn-success" href="<?=base_url('testimony/manage')?>">Cadastrar</a>
                            </div>
                            <div class="form-group pull-right ">
                                <button class="btn btn-success btn-save-launch-order" type="button">Salvar ordenação</button>
                                <div style="display: table; clear: both"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-sortable">
                                            <thead>
                                                <tr>
                                                    <th>Foto</th>
                                                    <th>Nome</th>
                                                    <th>Profiss&atilde;o</th>
                                                    <th>Depoimento</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                foreach($testimonials as $i=>$testimonyitem){
                                                ?>
                                                <tr>
                                                    <th><img src="<?=base_url('assets/uploads/testimonials/'.$testimonyitem->img)?>" class="img-responsive"></th>
                                                    <td>
                                                        <?=$testimonyitem->name?>
                                                    </td>
                                                    <td>
                                                        <?=$testimonyitem->profission?>
                                                    </td>
                                                    <td>
                                                        <?=$testimonyitem->testimony?>
                                                    </td>
                                                    <td>
                                                        <a href="<?=base_url('testimony/manage/'.$testimonyitem->id)?>" class="btn btn-success"><i class="fa fa-pencil"></i> Editar</a>
                                                        <form method="POST">
                                                            <input type="hidden" name="id" value="<?=$testimonyitem->id?>">
                                                            <button type="submit" class="btn btn-danger" name="launch-remove" value="1">&times; Remover</button>
                                                        </form>
                                                        <form method="POST">
                                                            <input type="hidden" name="position[]" value="<?=$testimonyitem->id?>">
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
