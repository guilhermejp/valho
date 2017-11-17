
                <div class="page-breadcrumb">
                    <ol class="breadcrumb container">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="<?=base_url('place')?>">Localidades</a></li>
                        <li class="active"><?=isset($place)?'Editar':'Cadastrar'?> localidades</li>
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
                            <div class="panel panel-white">
                                <div class="panel-body">
                                  <form enctype="multipart/form-data" method="POST" class="form-horizontal">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                        <label class="col-sm-3 control-label">Nome</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" placeholder="Nome" value="<?=isset($places)?$places->place:''?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">
                                        <button class="btn btn-success pull-right" type="submit">Salvar</button>
                                      </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>