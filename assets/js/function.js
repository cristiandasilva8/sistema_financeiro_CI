$(document).ready(function(){
    var entradas = 0;
    var saidas = 0;
    var d = new Date();
    var mes = d.getMonth() + 1;
    var ano = d.getFullYear();
    $.ajax({
        url: "/Movimentacao/SomaValor/",
        type: "POST",
        data: {
            valor: 1,
            mes: mes,
            ano: ano
        },
        dateType: "json",
        success:function(response){
            res = JSON.parse(response);
            $("#entradas").text(res.total);

        },
         error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log(XMLHttpRequest);
        }
    });
    $.ajax({
        url: "/Movimentacao/SomaValor/",
        type: "POST",
        data: {
            valor: 0,
            mes: mes,
            ano: ano
        },
        dateType: "json",
        success:function(response){
            res = JSON.parse(response);
            $("#saidas").text(res.total);
            $("#resultado_mes").text(res.resultado_mes);
            $("#resultado_mes").addClass(res.status);

        },
         error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log(XMLHttpRequest);
        } 
    });
    $.ajax({
        url: "/Movimentacao/SomaValorTotal/",
        type: "POST",
        data: {
            valor: 0,
            ano: ano
        },
        dateType: "json",
        success:function(response){
            res = JSON.parse(response);
            $("#saidas_total").text(res.soma_total);
        },
         error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log(XMLHttpRequest);
        } 
    });
    $.ajax({
        url: "/Movimentacao/SomaValorTotal/",
        type: "POST",
        data: {
            valor: 1,
            ano: ano
        },
        dateType: "json",
        success:function(response){
            res = JSON.parse(response);
            $("#entradas_total").text(res.soma_total);
            $("#resultado_geral").text(res.resultado_geral);
            $("#resultado_geral").addClass(res.status);
            $("#ano").text(res.ano);
        },
         error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log(XMLHttpRequest);
        } 
    });
});



