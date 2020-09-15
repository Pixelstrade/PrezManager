$(".confirm").click(function(e){
   if(!confirm("Confimer cette action ?")){
       e.preventDefault();
   }

});