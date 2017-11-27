'use strict';


/*****************demarrage du script lorsque la page est complétement chargé*********/
$(document).ready(function(){
    /******************autocompletion******************/
    $('#research').autocomplete({
        source : function(request,response){
            $.ajax({
                source :'index.php?action=research' ,
                type : 'post',
                dataType : 'json',
                data : { input: request["term"]},
                done : function(data){
                    var result = $.parseJSON(data);
                    console.log(result);
                    response($.map(data, function (objet) {
                        return objet.name;
                    }))
                },
                fail : function(){
                    console.log('error')
                }
            });

    }
       // source : 'index.php?action=research'

});
/************************ rafraichissement de la page   *****************/
/***** va rafraichir la page entière ***********/
    $("#refresh").on("click",function(e){

        location.reload();
    });

/************************** triage des articles ****************/
    $("#order").on("click", function(e){
         e.preventDefault(); // Le navigateur ne peut pas envoyer le formulaire
        var order = $(".order:checked").data('order');
        $.post({
            url: 'index.php?action=order',
            data : { order : order}
        })
            .done(function (data) {
                var result = $.parseJSON(data);
                $('#result').empty();
                var articles = result['articles'];
                var c = articles.length;
                for (var i = 0; i < c; i++){
                    $('#result').append('<div class="row article">' +
                        '<div class="col-xs-12 col-md-4">' +
                        '   <img src="img/'+articles[i]['Img1']+'" class="img-responsive img">' +
                        '</div>' +
                        '<div class="col-xs-12 col-md-4">' +
                            '<p><strong>'+articles[i]['NameArticle']+'</strong></p>' +
                            '<p><strong>Description du produit: </strong></p>'+
                            '<p>'+articles[i]['Description']+'</p>' +
                            '<p class="categorylist"><strong>Catégorie(s) :</strong></p>' +
                            '<p>'+articles[i]['cat']+'</p>' +
                        '</div>' +
                        '<div class="col-xs-12 col-md-4">' +
                            '<p><strong>Poids : </strong>'+articles[i]['Weight']+' </p>' +
                            '<p><strong>Prix : </strong>'+articles[i]['Price']+' Euros</p>' +
                            '<p><a href="index.php?action=product&id='+articles[i]['Id_article']+'" >En savoir plus</a></p><' +
                        '/div>' +
                        '</div>');
                }
            })
            .fail(function() {
                $('#content').append('oups une erreur est survenue! Veuillez réassayer.');
                console.log("error");
            })

    });
    /*******************filtrage des articles **************/
    $(document).on("click",'.filter', function (e) {
        e.preventDefault();
        var filter  =$(".filter:checked").data('filter');
        $.post({
            url: 'index.php?action=filter',
            data : {filter : filter}
        })
            .done(function (data) {
                var result = $.parseJSON(data);
                $('#result').empty();
                var articles = result['articles'];
                var c = articles.length;
                for (var i = 0; i < c; i++){
                    $('#result').append('<div class="row article">' +
                        '<div class="col-xs-12 col-md-4">' +
                        '   <img src="img/'+articles[i]['Img1']+'" class="img-responsive img">' +
                        '</div>' +
                        '<div class="col-xs-12 col-md-4">' +
                        '<p><strong>'+articles[i]['NameArticle']+'</strong></p>' +
                        '<p><strong>Description du produit: </strong></p>'+
                        '<p>'+articles[i]['Description']+'</p>' +
                        '<p class="categorylist"><strong>Catégorie(s) :</strong></p>' +
                        '<p>'+articles[i]['cat']+'</p>' +
                        '</div>' +
                        '<div class="col-xs-12 col-md-4">' +
                        '<p><strong>Poids : </strong>'+articles[i]['Weight']+'</p>' +
                        '<p><strong>Prix : </strong>'+articles[i]['Price']+' Euros</p>' +
                        '<p><a href="index.php?action=product&id='+articles[i]['Id_article']+'" >En savoir plus</a></p><' +
                        '/div>' +
                        '</div>');
                }
            })
            .fail(function() {
                $('#content').append('oups une erreur est survenue! Veuillez réassayer.');
                console.log("error");
            })

    });

    /***************précharger le formulaire Article********/
    $("#onChange").on("click", function(e) {
        e.preventDefault();
        var select =$('#selectArt option:selected').data('index')
        $.post({
            url: 'index.php?action=editFormArt',
            data : {idArt : select}
        })
            .done(function (data) {
                var result = $.parseJSON(data);
                console.log(result);
                $('#action').val(result['actionArt']);
                $('#name').val(result['article']['NameArticle']).append('<input type="hidden"  name="art" value="'+select+'"></li>');
                $('#description').val(result['article']['Description']);
                $('#weight').val(result['article']['Weight']);
                $('#price').val(result['article']['Price']);


            })


    });
    /***********************supprimer Article*********************/
    $("#ClearArt").on("click", function(e) {
        e.preventDefault();
        var select =$('#selectArt option:selected').data('index');
        $.post({
            url: 'index.php?action=delArt',
            data : {idArt : select}
        })
            .done(function () {
                //$('#selectArt option:selected').empty();
                location.reload();
            })


    });
    /***********************précharger le formulaire catégorie*****************/
    $("#onChangeCat").on("click", function(e) {
        e.preventDefault();
        var select =$('#catlist option:selected').val();
        $.post({
            url: 'index.php?action=editFormCat',
            data : {listcat : select}
        })
            .done(function (data) {
                console.log(data);
                var result = $.parseJSON(data);
                $('#actionCat').val(result['actionCat']);
                $('#nameCat').empty()
                    .val(result['cat']['Name'])
                    .append('<input type="hidden"  name="cat" value="'+select+'"></li>');

            })


    });
    /*************************editer Catégorie*********************************/
  /*  $("#onChangeCat").on("click", function(e) {
        e.preventDefault();
        var select =$('#catlist option:selected').val();
        $.post({
            url: 'index.php?action=addCat',
            data : {catlist : select}
        })
            .done(function (data) {
                console.log(data);
                location.reload();
            })


    });*/
    /***************************supprimer Catégorie*******************************/
    $("#delCat").on("click", function(e) {
        e.preventDefault();
        var select =$('#catlist option:selected').val();
        $.post({
            url: 'index.php?action=delCat',
            data : {listcat : select}
        })
            .done(function (data) {
                console.log(data);
                location.reload();
            })


    });
});
