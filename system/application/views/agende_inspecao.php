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
<div class="bg-danger message"></div>
</div>

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
 
  <select class="form-control" name="version" id="version" required onchange="enableKM()">
  <option value="">Vers&atilde;o</option>
  </select>

  </div>
  <div class="form-group">
    <label>KM</label>
  <select class="form-control" name="km" id="km" required onchange="enableVersion()">
  <option value="">KM</option>
  <option value="de 0 até 10.000">de 0 até 10.000</option>
  <option value="de 10.000 até 20.000">de 10.000 até 20.000</option>
  <option value="de 20.000 até 30.000">de 20.000 até 30.000</option>
  <option value="de 30.000 até 40.000">de 30.000 até 40.000</option>
  <option value="de 40.000 até 50.000">de 40.000 até 50.000</option>
  <option value="de 50.000 até 60.000">de 50.000 até 60.000</option>
  <option value="de 60.000 até 70.000">de 60.000 até 70.000</option>
  <option value="de 70.000 até 80.000">de 70.000 até 80.000</option>
  <option value="de 80.000 até 90.000">de 80.000 até 90.000</option>
  <option value="de 90.000 até 100.000">de 90.000 até 100.000</option>
  <option value="acima de 100.000">acima de 100.000</option>
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
    if($value['disabled'] == "true"){
      continue;
    }
?>
    <div class="item-data <?=(($value['date']==@$date)? "selected" : ""); ?>" date="<?=$value['date']?>" onclick="javascript: loadHours(this,'<?=$value['date']?>');">
    <div class="semana"><?=substr($value['day'],0,3)?></div>
    <div class="dia"><?=$value['number']?></div>
    <div class="mes"><?=substr($value['month'],0,3)?></div>
    </div>
<?php
  }

?>

</div>


 <hr>
 
 <!--<h6>Segunda 31 de Outubro</h6>-->
 
 <?php
/*if(isset($hours)){
  foreach($hours as $value){
    echo "<div class=\"horarios col-sm-6 ".(($value == @$hour) ? "selected" : "")."\" hour=\"$value\">$value</div>";
  }
}*/

 ?>
<div class="main-hours">
</div>
  
  </div>


  

 
  </div>
  
  
  </div>
  
  
<div class="row">


<div class="col-xs-12">
<hr>
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
  $('#km').attr('disabled','disabled');

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

  function enableKM(){
    $('#km').removeAttr('disabled');
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

  function loadHours(div, date){
    if($('#place').val() == ""){
      alert("Selecione primeiro o Local da Inspeção!");
      return false;
    }

    $('#event').val("getHours");
    $('#date').val(date);

    $.ajax({
      url: "<?=base_url('agende_inspecao')?>",
      type: "POST",
      data: $('#formAgenda').serialize(),
      success: function(result){
        if($.parseJSON(result).length == 0){
          $('.main-hours').html("Não há horários disponíveis, selecione outro dia!");
          return false;
        }
        $('.main-hours').html("");
          $.each($.parseJSON(result),function(){
            $('.main-hours').append('<div class="horarios col-sm-6" hour="'+this+'">'+this+'</div>');
          });

          $('.horarios').click(function(){
            $('.horarios').removeClass('selected');
            $(this).addClass('selected');
            $(this).attr('date');
            $('#hour').val($('.horarios.selected').attr('hour'));
          });

      }
    });

    
  }
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

  function formSubmit(){
    if($('#date').val() == "" || $('#hour').val() == ""){
        $('.message').removeClass('bg-info');
        $('.message').addClass('bg-danger');
        $('.message').text("Data e Hora devem ser selecionados!");
        $('.message').show();
        return false;
    }else if( $('#brand').val() == "" ||
              $('#model').val() == "" ||
              $('#version').val() == "" ||
              $('#name').val() == "" ||
              $('#email').val() == "" ||
              $('#mobile').val() == "" ||
              $('#place').val() == ""){
      $('.message').removeClass('bg-info');
      $('.message').addClass('bg-danger');
      $('.message').text("Todos os campos devem ser preenchidos!");
      $('.message').show();
      return false;
    }else{
      document.getElementById("event").value = "submit";
      document.formAgenda.submit();
    }

  }

startApp();
</script>