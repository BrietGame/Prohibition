$(document).ready(function () {
  // jquery on click submit button
  $("#submit").click(function (e) {
    e.preventDefault();
    //recup radio button value
    var radioValue = $("input[name='nbPlayer']:checked").val();
    //ajax request
    $.ajax({
      url: "ajax/PseudoAndRole.php",
      type: "POST",
      dataType: "json",
      data: { nbPlayer: radioValue, actualPlayer: 0, game: 0 },
      success: function (data) {
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
        $(document).on("click", "#next", function (e) {
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
            success: function (data) {
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
                  "<p>Distribué les cartes</p><p class='gamedirection'></p>"
                );

                //settimeout 5sec
                setTimeout(function () {
                  $(".gamedirection").html(
                    "Jouez dans le sens des aiguilles d'une montre"
                  );
                  $("#playboard").append(
                    "<button id='startgame'>Commencer</button>"
                  );
                }, 500);

                console.log(data.game);

                //jquery on click start game button
                $(document).on("click", "#startgame", function (e) {
                  e.preventDefault();
                  //ajax request
                  $.ajax({
                    url: "ajax/GameTurn.php",
                    type: "POST",
                    dataType: "json",
                    data: { game: data.game },
                    success: function (data) {
                      console.log(data);
                    },
                    error: function (data) {
                      console.log(data.responsetext);
                    },
                  });
                });
              }
            },
            error: function (data) {
              console.log(data.responsetext);
            },
          });
        });
      },
      error: function (data) {
        console.log(data.responsetext);
      },
    });
  });
});
