<div class="page-inner">
                <div class="page-breadcrumb">
                    <ol class="breadcrumb container">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li><a href="<?=base_url('contacts')?>">Contatos</a></li>
                        <li class="active">Listagem</li>
                    </ol>
                </div>
                <div class="page-title">
                    <div class="container">
                        <h3>Contatos</h3>
                    </div>
                </div>
                <div id="main-wrapper" class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-sortable">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Nome</th>
                                                    <th>Telefone / Celular</th>
                                                    <th>Email</th>
                                                    <th>Mensagem</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                foreach($contacts as $i=>$contactitem){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?=date('d/m/Y H:i:s',strtotime($contactitem->datetime));?>
                                                    </td>
                                                    <td>
                                                        <?=$contactitem->name?>
                                                    </td>
                                                    <td>
                                                        <?=$contactitem->phone." / ".$contactitem->mobile?>
                                                    </td>
                                                    <td>
                                                        <?=$contactitem->email?>
                                                    </td>
                                                    <td>
                                                        <?=$contactitem->message?>
                                                    </td>
                                                    <!--<td>
                                                        <a href="<?=base_url('contacts/manage/'.$contactitem->id)?>" class="btn btn-success"><i class="fa fa-pencil"></i> Editar</a>
                                                        <form method="POST">
                                                            <input type="hidden" name="id" value="<?=$contactitem->id?>">
                                                            <button type="submit" class="btn btn-danger" name="launch-remove" value="1"><i class="fa fa-archive"></i> Arquivar</button>
                                                        </form>
                                                    </td>-->
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
