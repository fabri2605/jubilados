$(function() {
    $("body").on('click', "stepOne", function(){
        let action = this.attr("data-id");
        if(action == 1){
            $("#firstQuestion").hide("slow");
            $("#formulario").show("slow");
        }else{
            $("#firstQuestion").hide("slow");
            $("#autogestion").show("slow");
        }
    });
  
});