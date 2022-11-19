$(document).ready(function(){
  $(".step").click(function(){
    var id = $(this).prop("id");
    var cActive_step = $("#cActive_step").val();

    $(".ket_step").slideUp();
    if(id!=cActive_step){
      $("#ket_"+id).slideDown();
      $("#cActive_step").val(id);

    }else{
      $("#cActive_step").val("cActive_step");

    }

  })

})