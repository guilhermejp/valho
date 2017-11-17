
                <div class="page-breadcrumb">
                    <ol class="breadcrumb container">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="<?=base_url('content/index/como_funciona')?>">Como Funciona</a></li>
                        <li class="active"> Editar pagina</li>
                    </ol>
                </div>
                <div class="page-title">
                    <div class="container">
                        <h3><?=@ucwords(str_replace("_", " ", $contents->id));?></h3>
                    </div>
                </div>
                <div id="main-wrapper" class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                  <form enctype="multipart/form-data" method="POST" class="form-horizontal">
                                        <div class="summernote"><?=@$contents->content;?></div>
                                        <div class="col-sm-12">
                                          <input type="hidden" name="content" id="content" />
                                          <button class="btn btn-success pull-right" type="submit">Salvar</button>
                                        </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>