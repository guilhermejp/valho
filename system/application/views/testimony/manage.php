
                <div class="page-breadcrumb">
                    <ol class="breadcrumb container">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="<?=base_url('testimony')?>">Depoimentos</a></li>
                        <li class="active"><?=isset($testimony)?'Editar':'Cadastrar'?> depoimentos</li>
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
                            <div class="panel panel-white">
                                <div class="panel-body">
                                  <form enctype="multipart/form-data" method="POST" class="form-horizontal">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                        <label class="col-sm-3 control-label">Nome</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" placeholder="Nome" value="<?=isset($testimonials)?$testimonials->name:''?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-sm-3 control-label">Foto</label>
                                          <div class="col-sm-9">
                                            <input type="file" name="img" class="form-control" placeholder="Imagem">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-sm-3 control-label">Profiss&atilde;o</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="profission" class="form-control" placeholder="Profiss&atilde;o" value="<?=isset($testimonials)?$testimonials->profission:''?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-sm-3 control-label">Status</label>
                                          <div class="col-sm-9">
                                            <select name="status" class="form-control" required="">
                                              <option value="1" <?=isset($testimonials) && $testimonials->status == 1?'selected="selected"':''?>>Ativo</option>
                                              <option value="0" <?=isset($testimonials) && $testimonials->status == 0?'selected="selected"':''?>>Inativo</option>
                                            </select>
                                          </div>
                                        </div>
                                        </div>
                                        <div class="col-sm-9">
                                          <div class="form-group">
                                            <label class="col-sm-2 control-label">Depoimento</label>
                                            <div class="col-sm-9">
                                              <textarea rows="5" name="testimony" class="form-control" placeholder="Depoimento"><?=isset($testimonials)?$testimonials->testimony:''?></textarea> 
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