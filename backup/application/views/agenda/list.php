<div class="page-inner">
                <div class="page-breadcrumb">
                    <ol class="breadcrumb container">
                        <li><a href="<?=base_url()?>">Home</a></li>
                        <li><a href="<?=base_url('agenda')?>">Agenda</a></li>
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
                                                    <th>Data / Hora</th>
                                                    <th>Cliente</th>
                                                    <th>Email</th>
                                                    <th>Telefone</th>
                                                    <th>Veículo</th>
                                                    <th>Local</th>
                                                    <!--<th>Ação</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                foreach($agenda as $i=>$agendaitem){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?=date('d/m/Y - H:i:s',strtotime($agendaitem->datetime));?>
                                                    </td>
                                                    <td>
                                                        <?=$agendaitem->name?>
                                                    </td>
                                                    <td>
                                                        <?=$agendaitem->email?>
                                                    </td>
                                                    <td>
                                                        <?=$agendaitem->mobile?>
                                                    </td>
                                                    <td>
                                                        <?=$agendaitem->brand_name." ".
                                                            $agendaitem->model_name." ".
                                                            $agendaitem->version_name ?>
                                                    </td>
                                                    <td>
                                                        <?=$agendaitem->place_name?>
                                                    </td>
                                                    <!--<td>
                                                        <a href="<?=base_url('agenda/manage/'.$agendaitem->id)?>" class="btn btn-success"><i class="fa fa-pencil"></i> Editar</a>
                                                        <form method="POST">
                                                            <input type="hidden" name="id" value="<?=$agendaitem->id?>">
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
