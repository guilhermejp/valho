<link href="../../../../assets/admin/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
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
                        <h3>Agenda</h3>
                    </div>
                </div>
                <div id="main-wrapper" class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Localidade</h3>
                                </div>
                                <div class="panel-body">
                                    <form action="" method="POST" name="formPlaces" id="formPlaces">
                                        <select id="place" name="place" onchange="javascript: formPlaces.submit();">
                                            <option value=""></option>
                                            <?php
                                                foreach($places as $value){
                                                    echo "<option value=\"".$value->id."\"";
                                                    echo ($value->id == $place ? "selected" : "");
                                                    echo " >".$value->place."</option>";
                                                }
                                            ?>
                                        </select>
                                    </form>
                                </div>
                                <div class="panel-heading">
                                    <h3 class="panel-title">Novo Evento</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="events">
                                        <div class="calendar-event" style="cursor:pointer;"><p>Bloqueio Agenda</p><a href="javascript:void(0);" class="remove-calendar-event"><i class="fa fa-remove"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div id="fullCalModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div id="modalBody" class="modal-body">
                    <p><b>Data </b><span id="modalData"></span></p>
                    <p><b>Cliente </b><span id="modalCliente"></span></p>
                    <p><b>Veículo </b><span id="modalVeiculo"></span></p>
                    <p><b>KM </b><span id="kmVeiculo"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteEvent">Excluir Evento</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
function calendarFunction(){

    var drag =  function() {
        $('.calendar-event').each(function() {

        // store data so the calendar knows to render an event upon drop
        /*$(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true // maintain when user navigates (see docs on the renderEvent method)
        });*/

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 1111999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 500  //  original position after the drag
        });
    });
    };
    
    drag();
    //removeEvent();
    
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var year = date.getFullYear();
    
    $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            eventLimit: true, // allow "more" link when too many events
            eventOverlap: false,
            hiddenDays: [ 0 ], // BLOQUEADO DOMINGO (removido do calendario)
            displayEventTime:false,
            events: '<?=base_url("agenda/get_events/".$place);?>'
            <?php 
                /*$return = array();
                foreach($agenda as $i=>$agendaitem){
                    $return[] = array(
                                        'id'=>$agendaitem->id,
                                        'title'=>$agendaitem->brand_name." ".$agendaitem->model_name." ".$agendaitem->name,
                                        'start'=>$agendaitem->datetime_start,
                                        'end'=>$agendaitem->datetime_end
                                    );
                }
                echo json_encode($return);*/
            ?>
            ,
            eventClick:  function(event, jsEvent, view) {
                $.ajax({
                  url: "<?=base_url('agenda/evento')?>"+"/"+event.id,
                  dataType: "json",
                  success: function(result){
                    $('#modalTitle').html(result[0].place_name);
                    $('#modalData').html(result[0].datetime_start+" a "+result[0].datetime_end);
                    $('#modalCliente').html(result[0].name+" / "+result[0].mobile+" / "+result[0].email);
                    $('#modalVeiculo').html(result[0].brand_name+" "+result[0].model_name+" "+result[0].version_name);
                    $('#kmVeiculo').html(result[0].km);
                    $('#fullCalModal').modal();
                    deleteEventFunction(event.id);
                  },
                  error: function(result){
                    alert(result);
                  }
                });
            },
            eventResize: function(event, delta, revertFunc) {
                $.ajax({
                  url: "<?=base_url('agenda/update')?>",
                  data: { id: event.id,
                          datetime_start: event.start.format(),
                          datetime_end: event.end.format()
                        },
                  method:"POST",
                  dataType: "json",
                  success: function(result){
                  },
                  error: function(result){
                  }
                });
            },
            eventDrop: function(event, delta, revertFunc) {
                $.ajax({
                  url: "<?=base_url('agenda/update')?>",
                  data: { id: event.id,
                          datetime_start: event.start.format(),
                          datetime_end: event.end.format()
                        },
                  method:"POST",
                  dataType: "json",
                  success: function(result){
                  },
                  error: function(result){
                  }
                });
            },
            drop: function(date) {
                $.ajax({
                  url: "<?=base_url('agenda/create')?>",
                  data: { name: 'BLOQUEIO',
                          place: $('#place').val(),
                          datetime: date.format()
                        },
                  method:"POST",
                  dataType: "json",
                  success: function(result){
                    $('#calendar').fullCalendar( 'revemoEvent' );
                    $('#calendar').fullCalendar( 'refetchEvents' );
                  },
                  error: function(result){
                  }
                });
            }
        });
}


function deleteEventFunction(parmId){
    $('#deleteEvent').unbind('click');
    $('#deleteEvent').click(function(){
        if(confirm("Deseja realmente excluir este Agendamento?")){
                $.ajax({
                  url: "<?=base_url('agenda/delete')?>",
                  data: { id: parmId },
                  method:"POST",
                  dataType: "json",
                  success: function(){
                    $('#calendar').fullCalendar('removeEvents',parmId);
                  },
                  error: function(){
                    alert("Erro ao excluir evento!");
                  }
                });
        }else{
            return false;
        }
    });
}

</script>