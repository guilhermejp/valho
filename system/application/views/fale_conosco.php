<main>



<div id="title-internas" class="title">
FALE <strong>CONOSCO</strong>

<div class="traco"></div>

</div>






<div class="container">



<div class="txt"><?=$contents->content;?>
<hr/>


<div class="telefone-contato">

<div class="icon-tel">
<i class="fa fa-phone" aria-hidden="true"></i>

</div>

<strong>(31) 3142.9696</strong>
</div>

<form class="contact-form" method="POST" action="contact/insert">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Nome</label>
                            <input class="form-control" placeholder="Digite seu nome" required="" name="name" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>E-mail</label>
                            <input class="form-control" placeholder="exemplo@email.com" required="" name="email" type="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label>Telefone</label>
                        <div class="form-group">
                            <input class="form-control phone" placeholder="(31) 3333-3333" required="" name="phone" autocomplete="off" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Celular</label>
                            <input class="form-control phone" placeholder="(31) 9999-9999" name="mobile" autocomplete="off" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <label>Mensagem</label>
                    <textarea placeholder="Digite sua mensagem" class="form-control" name="message" rows="3"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <button class="btn-enviar btn btn-default btn-block" type="submit">Enviar Mensagem</button>
                    </div>
                </div>
            </form>





</div>









</main>
