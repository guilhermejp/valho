<div class="page-inner">
                <div class="page-breadcrumb">
                    <ol class="breadcrumb container">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li><a href="<?=base_url('place')?>">Localidades</a></li>
                        <li class="active">Listagem</li>
                    </ol>
                </div>
                <div class="page-title">
                    <div class="container">
                        <h3>Localidades</h3>
                    </div>
                </div>
                <div id="main-wrapper" class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group pull-right">
                                <a class="btn btn-success" href="<?=base_url('place/manage')?>">Cadastrar</a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-sortable">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                foreach($places as $i=>$placeitem){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?=$placeitem->place?>
                                                    </td>
                                                    <td width="20%">
                                                    <form method="POST">
                                                        <a href="<?=base_url('place/manage/'.$placeitem->id)?>" class="btn btn-success"><i class="fa fa-pencil"></i> Editar</a>
                                                            <input type="hidden" name="id" value="<?=$placeitem->id?>">
                                                            <button type="submit" class="btn btn-danger" name="launch-remove" value="1"><i class="fa fa-archive"></i> Arquivar</button>
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
