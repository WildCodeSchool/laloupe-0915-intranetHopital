$(document).ready(function(){
    console.log($('.sonata-ba-field').eq(0).children().attr('name').split('[')[0]);

    var uniqid = $('.sonata-ba-field').eq(0).children().attr('name').split('[')[0];

    $('#field_actions_'+uniqid+'_fonction').children().eq(1).children().eq(1).css('background','black');

});
