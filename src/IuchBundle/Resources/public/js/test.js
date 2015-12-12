$(document).ready(function(){
    $('td:contains("médecine")').siblings().eq(4).css('background','black');
    var td = $('td:contains("médecine")').siblings().eq(4).children().children().eq(0).css('background', 'red');

});