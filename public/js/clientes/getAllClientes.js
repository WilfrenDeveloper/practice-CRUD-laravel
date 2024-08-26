function getAllClientes (){
    $.ajax({
        type: "GET",
        url: "/clientes",
        success: function (response){
            
        },
        error: function(err){
            console.error(err);
        }
    });

}