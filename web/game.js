$(document).ready(function(){
    $('.cell').click(
        function(){
            makeHumanMove($(this), 'o');
        }
    );
});


function setGame(game) {

    console.log(game);
    $('.cell').each(function (index, value) {
        var el = $(value);
        var coords = el.data('coords').split('-');
        el.html(game[parseInt(coords[0])][parseInt(coords[1])])
    });


}
function makeAiMove(game) {
    $.ajax({
        url : '/v1/game/makeMove',
        type: "POST",
        data: JSON.stringify(game),
        contentType: "application/json; charset=utf-8",
        dataType   : "json",
        success    : function(resp){
            setGame(resp);
            checkWinner(false);
        }
    });
}
function checkWinner(human) {
    var game = getGameField();

    $.ajax({
        url : '/v1/game/checkStatus',
        type: "POST",
        data: JSON.stringify(game),
        contentType: "application/json; charset=utf-8",
        dataType   : "json",
        success    : function(resp){
            if (resp == true) {
                $('.message').html('We have a winner').show();
            } else if (human)
                makeAiMove(game);
            }
    });
}

function makeHumanMove(el, char) {
    if (el.html() != '') {
        return;
    }
    var coords = el.data('coords').split('-');
    el.html(char);
    checkWinner(true);
}


function getGameField() {
    var data = [[],[],[]];

    $('.cell').each(function (index, value) {
        var el = $(value);
        var coords = el.data('coords').split('-');
        data[parseInt(coords[0])][parseInt(coords[1])] = el.html();
    });

    return data;
}

