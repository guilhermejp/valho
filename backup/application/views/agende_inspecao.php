<main>
<script src="https://apis.google.com/js/api:client.js"></script>
<script>
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '771838794842-cp4est8u68kdt1ama29hicokl6v833n5.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
      });
      attachSignin(document.getElementById('customBtn'));
    });
  };

  function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
            $('#name').val(googleUser.getBasicProfile().getName());
            $('#email').val(googleUser.getBasicProfile().getEmail());
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }
  </script>
<form name="formAgenda" id="formAgenda" method="POST" action="">
<input type="hidden" id="event" name="event" >
<input type="hidden" id="date" name="date" value="<?=@$date?>">
<input type="hidden" id="hour" name="hour" value="<?=@$hour?>">
<div id="title-internas" class="title">
AGENDE <strong>SUA INSPEÇÃO</strong>

<div class="traco"></div>

</div>

<div class="container">


<div class="row">

<div class="col-md-4">

<div class="col-agende">

<h5>Dados do Veículo</h5>

<div class="form-group">
<label>Marca</label>
 <select class="form-control" name="brand" id="brand" required onchange="vehicleOnChange('brand')">
  <option value="">Marca</option>
  <?php foreach($brand as $values){ ?>
    <option value="<?=$values->id;?>" <?=(@$brand_id == $values->id) ? 'selected': '';?> ><?=$values->name;?></option>
  <?php } ?>
 </select>
  </div>
  
  
  <div class="form-group">
  <label>Modelo</label>
  <select class="form-control" name="model" id="model" required onchange="vehicleOnChange('model') ">
  <option value="">Modelo</option>
  </select>
 </select>
  </div>
  
  
    <div class="form-group">
    <label>Ano</label>
 
  <select class="form-control" name="version" id="version" required onchange="enableVersion()">
  <option value="">Vers&atilde;o</option>
  </select>

  </div>

 </div>
 
  </div>
  
  
  
 <div class="col-md-4 col-xs-12">
 
 <div class="col-agende">

<h5>Dados Pessoais</h5>

<div class="logar-face">

<div class="row">

<a href="javascript: window.open('<?=$urlFacebook;?>','mywindowtitle','width=550,height=550,top=50,left=400'); void(0);"><div class="col-xs-6"><div class="social-icon-log log-face"><i class="fa fa-facebook" aria-hidden="true"></i></div><span> Facebook</span></div></a>


<a href="javascript:void(0);" id="customBtn"><div class="col-xs-6"><div class="social-icon-log log-google"><i class="fa fa-google-plus" aria-hidden="true"></i> </div><span>  Google+</span></div></a>
</div>
</div>
  
 <div class="form-group">
 
 <label>Nome</label>
   <input class="form-control" placeholder="Digite seu nome" required name="name" id="name" type="text" value="<?=@$name?>">
 </div>
 
  <div class="form-group">
 
 <label>E-mail</label>
   <input class="form-control" placeholder="exemplo@email.com" required name="email" id="email" type="text" value="<?=@$email?>">
 </div>
 
 
 
  <div class="form-group">
 
 <label>Celular</label>
   <input class="form-control phone" placeholder="(31) 9999-9999" required name="mobile" id="mobile" type="text" value="<?=@$mobile?>">
 </div>
 
  </div>
  
  </div>
  
  
  
  
  <div class="col-md-4">
 
 <div class="col-agende">

<h5>Data e Local da Inspeção</h5>

     <div class="form-group">
       <label>Local</label>
 <select class="form-control" name="place" id="place" required >
  <option value="">Escolha o local</option>
 <?php foreach($places as $values){ ?>
  <option value="<?=$values->id;?>" <?=(@$place_id == $values->id) ? 'selected': '';?> ><?=$values->place;?></option>
 <?php } ?>
 </select>
  </div>
  
  <hr>
  
  <div class="carousel-data owl-carousel owl-theme">

<?php
  foreach($days as $value){
?>
    <div class="item-data <?=(($value['date']==@$date)? "selected" : ""); ?>" date="<?=$value['date']?>">
    <div class="semana"><?=substr($value['day'],0,3)?></div>
    <div class="dia"><?=$value['number']?></div>
    <div class="mes"><?=substr($value['month'],0,3)?></div>
    </div>
<?php
  }

?>

</div>


 <hr>
 
 <h6>Segunda 31 de Outubro</h6>
 
 <?php

  foreach($hours as $value){
    echo "<div class=\"horarios col-sm-6 ".(($value == @$hour) ? "selected" : "")."\" hour=\"$value\">$value</div>";
  }

 ?>
  
  </div>


  

 
  </div>
  
  
  </div>
  
  
<div class="row">


<div class="col-xs-12">
<hr>
<div class="bg-danger message"></div>
</div>
<div class="col-md-4 col-md-offset-4">
<button class="btn-enviar btn btn-default btn-block" onclick="javascript: formSubmit(); void(0);">Agende sua avaliação</button>
</div>


</div>

  
  
  
  
  </div>
  
  
</div>



</div>

</form>

</main>

<script>

  $('.message').hide();

  $('#model').attr('disabled','disabled');
  $('#version').attr('disabled','disabled');

  $('#name').attr('disabled','disabled');
  $('#email').attr('disabled','disabled');
  $('#mobile').attr('disabled','disabled');

  $('#place').attr('disabled','disabled');

  function vehicleOnChange(event){
    $('#event').val(event);

    $.ajax({
      url: "<?=base_url('agende_inspecao')?>",
      type: "POST",
      data: $('#formAgenda').serialize(),
      success: function(result){
        switch(event){
          case "brand":
            returnBrand(result);
            $('#model').removeAttr('disabled');
          break;

          case "model":
            returnModel(result);
            $('#version').removeAttr('disabled');
          break;

        }
      }
    });
  }

  function enableVersion(){
    $('#name').removeAttr('disabled');
    $('#email').removeAttr('disabled');
    $('#mobile').removeAttr('disabled');
    $('#place').removeAttr('disabled');
  }

  function returnBrand(json){
    $.each($.parseJSON(json), function(){
      inner = '<option value="'+this.id+'">'+this.name+'</option>';
      $('#model').append(inner);
    });
  }

  function returnModel(json){
    $.each($.parseJSON(json), function(){
      inner = '<option value="'+this.fipe_codigo+'">'+this.name+'</option>';
      $('#version').append(inner);
    });
  }

 <?php
  if($message != ""){
    if($error == true){
      echo "  $('.message').removeClass('bg-info');
              $('.message').addClass('bg-danger');
              $('.message').text(\"$message\");
              $('.message').show();";
    }else{
      echo "  document.getElementById('formAgenda').reset();
              $('.message').removeClass('bg-danger');
              $('.message').addClass('bg-info');
              $('.message').text(\"$message\");
              $('.message').show();";
    }
  }

 ?>
  function returnFacebook(name, email){
    
    $('#name').val(name);
    $('#email').val(email);
    $('#mobile').focus();
  }

  $('.item-data').click(function(){
    $('.item-data').removeClass('selected');
    $(this).addClass('selected');
    $(this).attr('date');
    $('#date').val($('.item-data.selected').attr('date'));
  });

  $('.horarios').click(function(){
    $('.horarios').removeClass('selected');
    $(this).addClass('selected');
    $(this).attr('date');
    $('#hour').val($('.horarios.selected').attr('hour'));
  });

  function formSubmit(){
    if($('#date').val() == "" || $('#hour').val() == ""){
        $('.message').removeClass('bg-info');
        $('.message').addClass('bg-danger');
        $('.message').text("Data e Hora devem ser selecionados!");
        $('.message').show();
        return false;
    }else{
      document.getElementById("event").value = "submit";
      document.formAgenda.submit();
    }

  }

startApp();
</script>