$('a#mes').click(function(){
    mes = $(this).attr('data');
    ano = $('#sel').val();

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

        },
         error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log(XMLHttpRequest);
        } 
    });
});

$('#sel').on('change', function() {
  var ano = this.value;

    $.ajax({
        url: "/Movimentacao/SomaValor/",
        type: "POST",
        data: {
            valor: 1,
            mes: 1,
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
            mes: 1,
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
            $("#ano").addClass(res.ano);
        },
         error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log(XMLHttpRequest);
        } 
    });
});

$( "#add-movimentacao" ).click(function() {
        $.ajax({
        url: "/Movimentacao/loadView/",
        type: "POST",
        data: {},
        dateType: "json",
        success:function(response){
            res = JSON.parse(response);
            $(".salvar").attr("data-controller", "Movimentacao");
            $(".modal-body").html(res.html);
        },
         error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log(XMLHttpRequest);
        } 
    });
});

$( "#add-categoria" ).click(function() {
        $.ajax({
        url: "/Categoria/loadView/",
        type: "POST",
        data: {},
        dateType: "json",
        success:function(response){
            res = JSON.parse(response);
            $(".salvar").attr("data-controller", "Categoria");
            $(".modal-body").html(res.html);
        },
         error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log(XMLHttpRequest);
        } 
    });
});

$( ".salvar" ).click(function() {
    controller = $(this).attr('data-controller');
    var post;
    if(controller === "Movimentacao"){
        post = 
        {   data:       $("#data").val(),
            tipo:       $('input[name=tipo_receita]:checked').val(),
            cat:        $('.cat').find(":selected").val(),
            descricao : $("#descricao").val(),
            valor:      $("#valor").val(),
            id:         $("#id").val(),
        }
    }else if( controller === "Categoria"){
        post = 
        {   nome:   $("#nome").val(),
            id:     $("#id").val()
        }
    }

    $.ajax({
        url: controller+"/create_action",
        type: "POST",
        data: post,
        dateType: "json",
        success:function(response){
            alert("Salvo com Sucesso!");
        },
         error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log(XMLHttpRequest);
        } 
    });

});