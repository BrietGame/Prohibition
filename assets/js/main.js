let score = 0;
let count = 0;
let json;

$(document).ready(function() {
    // jquery on click submit button
    $("#submit").click(function(e) {
        e.preventDefault();
        //recup radio button value
        var radioValue = $("input[name='nbPlayer']:checked").val();
        //ajax request
        $.ajax({
            url: "ajax/PseudoAndRole.php",
            type: "POST",
            dataType: "json",
            data: { nbPlayer: radioValue, actualPlayer: 0, game: 0 },
            success: function(data) {
                //btn suivant
                $("#playboard").html(
                    "<p>Pseudo : " +
                    data.game.players[data.actualplayer].PSEUDO +
                    "</p> <p>Role : " +
                    data.game.players[data.actualplayer].ROLE +
                    "</p><button id='next' data-idplayer='" +
                    1 +
                    "'>Suivant</button>"
                );

                // jquery on click next button
                $(document).on("click", "#next", function(e) {
                    e.preventDefault();
                    actual_player = $(this).data("idplayer");

                    $.ajax({
                        url: "ajax/PseudoAndRole.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            nbPlayer: radioValue,
                            actualPlayer: actual_player,
                            game: data.game,
                        },
                        success: function(data) {
                            if (data.gamestart == 0) {
                                $("#playboard").html(
                                    "<p>Pseudo : " +
                                    data.game.players[data.actualplayer].PSEUDO +
                                    "</p> <p>Role : " +
                                    data.game.players[data.actualplayer].ROLE +
                                    "</p><button id='next' data-idplayer='" +
                                    (data.actualplayer + 1) +
                                    "'>Suivant</button>"
                                );
                            } else {
                                $("#playboard").html(
                                    "<p>Distribué les cartes</p><p class='gamedirection'></p><p class='cardLine'></p>"
                                );

                                //settimeout 5sec
                                setTimeout(function() {
                                    $(".gamedirection").html(
                                        "Jouez dans le sens des aiguilles d'une montre"
                                    );
                                    $(".cardLine").html(
                                        "Basez-vous sur la ligne du haut pour les cartes"
                                    );
                                    $("#playboard").append(
                                        "<button id='startgame'>Commencer</button>"
                                    );
                                }, 500);


                                //jquery on click start game button
                                json = data;
                                main("#startgame");
                            }
                        },
                        error: function(data) {
                            console.log(data.responsetext);
                        },
                    });
                });
            },
            error: function(data) {
                console.log(data.responsetext);
            },
        });
    });
});

function main(name) {
    if (count < 2) {
        newTurn(json, name);
    }
}

$(document).on("click", "#reveal", function(e) {
    $("#inspected").show();
    $("#reveal").hide();
    $("#playboard").append("<forms><input type='number' id='scoring'></forms>");
    $("#playboard").append("<button type='submit'id='nextTurn'>Next</button>")

});
$(document).on("click", "#nextTurn", function(e) {
    score += parseInt($("#scoring").val());
    count++;
    $("#playboard").html("");
    $("#playboard").append("<button type='submit' id='turn'>Next round</button>");

});


$(document).on("click", "#turn", function(e) {
    main("#turn");
});


function newTurn(json, name) {
    //jquery on click start game button
    $(document).on("click", name, function(e) {
        e.preventDefault();
        if (count < 2) {
            //ajax request
            $.ajax({
                url: "ajax/GameTurn.php",
                type: "POST",
                dataType: "json",
                data: { game: json.game },
                success: function(data) {
                    let inspect = "";
                    let select = "";
                    for (let i = 0; i < data.inspected.length; i++) {
                        inspect += data.inspected[i].PSEUDO;
                        if (i != data.inspected.length - 1) {
                            inspect += ', ';
                        }
                    }
                    for (let i = 0; i < data.selected.length; i++) {
                        select += data.selected[i].PSEUDO;
                        select += ', ';
                    }
                    $("#playboard").html(
                        "<p>Selected people : " +
                        select +
                        "</p> <p>Action : " +
                        data.action +
                        "</p> <p>Card : " +
                        data.cards +
                        "'</p><br><button id='reveal'>Suivant</button>" +
                        " <p id='inspected' style='display:none' > Inspected people: " +
                        inspect + "</p>"
                    );

                },
                error: function(data) {
                    console.log(data.responsetext);
                },
            });
        } else {
            $("#playboard").html("<p>Fin de partie, comptage des points de l'IA : " +
                score +
                "</p>");
        }

    });
}