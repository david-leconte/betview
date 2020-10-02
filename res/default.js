// Partie gérant le panier de matchs

function gamesTable(add, gameID, gameTitle, betOdds) { // ajoute ou supprime le match de la barre de navigation
  if (add) {
    var navTable = document.querySelector("nav table");

    var gameLine = document.createElement("tr");
    gameLine.className = "gameSelected";
    gameLine.id = "id-" + gameID;
    if (localStorage["premium"]) gameLine.classList.add("premiumBackground");

    var cell = document.createElement("td");
    cell.innerHTML = gameTitle + ' @ ' + betOdds;
    if (localStorage["premium"]) cell.classList.add("premiumColor");
    var delBt = document.createElement("i");
    delBt.className = "material-icons delGame";
    delBt.innerHTML = "delete_forever";
    cell.appendChild(delBt);

    gameLine.appendChild(cell);
    navTable.appendChild(gameLine);

    var total = document.querySelector("nav i.total").innerHTML;
    total = (total * betOdds).toFixed(2);
    document.querySelector("nav i.total").innerHTML = total;
  } else {
    if (document.querySelector("tr#" + "id-" + gameID)) {
      document.querySelector("tr#" + "id-" + gameID).remove();
      var total = document.querySelector("nav i.total").innerHTML;
      total = (total / betOdds).toFixed(2);
      document.querySelector("nav i.total").innerHTML = total;
    }
  }

  var delButtons = document.querySelectorAll(".delGame");
  //console.log(delButtons);
  delButtons.forEach(delGame);
}


function delGame(button) {
  var elID = button.parentElement.parentElement.id;
  var gameID = elID.replace("id-", "");

  button.addEventListener("click", function () {
    selectedGames.splice(selectedGames.indexOf(gameID), 1);
    console.log(selectedGames.splice(selectedGames.indexOf(gameID), 1));
		
		var gameInfo = getGameInfo(gameID);
    gamesTable(false, gameID, gameInfo["title"], gameInfo["odds"]); // false pour enlever un match

    if (document.querySelector('.tableHomepage #' + elID)) {
      document.querySelector('.tableHomepage #' + elID).innerHTML = "add";
    } else if (document.querySelector('h2 #' + elID)) {
      document.querySelector('h2 #' + elID).innerHTML = "add";
    }

    //console.log(selectedGames);
    localStorage["selectedGames"] = JSON.stringify(selectedGames);
  });
}

function getGameInfo(gameID) {
  var request = new XMLHttpRequest();
  request.open("GET", "https://" + path + "/?page=get-bets-json&id=" + gameID, false);
  request.send(null);

  //console.log(gameID);
  console.log(request.responseText);


  var jsonGAME = JSON.parse(request.responseText);

  if(jsonGAME['bet'] != "") return jsonGAME;
  else return false;
}

// Redirige du www. ... à sans le www

if(location.hostname.substring(0,3) == "www") location.href = "https://" + location.hostname.substring(4) + location.pathname;

if(location.protocol != "https:") location.href = "https://" + location.hostname + location.pathname;

var path = location.hostname == "localhost" ? "localhost/betview" : window.location.hostname;

if (localStorage["selectedGames"] && localStorage["selectedGames"] != "[]") {
  var selectedGames = JSON.parse(localStorage["selectedGames"]);
  //console.log(selectedGames);

  for (gameID of selectedGames) {
    var gameInfo = getGameInfo(gameID);

    if(gameInfo != false) gamesTable(true, gameID, gameInfo["title"], gameInfo["odds"]);
  }
} else var selectedGames = [];

var addButtons = document.querySelectorAll(".addGame");

addButtons.forEach(function(button) {
  var elID = button.id;
  var gameID = elID.replace("id-", "");
  var gameInfo = getGameInfo(gameID);

  if (selectedGames.includes(gameID)) {
    button.innerHTML = "check";
  }

  button.addEventListener("click", function () {
    if (!selectedGames.includes(gameID)) {
      selectedGames.push(gameID);
      button.innerHTML = "check";

      gamesTable(true, gameID, gameInfo["title"], gameInfo["odds"]); // true pour ajouter un match
    } else {
      selectedGames.splice(selectedGames.indexOf(gameID), 1);
      button.innerHTML = "add";
      gamesTable(false, gameID, gameInfo["title"], gameInfo["odds"]); // false pour enlever un match
    }

    //console.log(selectedGames);
    localStorage["selectedGames"] = JSON.stringify(selectedGames);
  });
});

var delButtons = document.querySelectorAll(".delGame");
//console.log(delButtons);
delButtons.forEach(delGame);

/* Partie gérant la version mobile */

var body = document.querySelector("body");
var menuIcon = document.querySelector("h1 .menuIcon");
var navMenu = document.querySelector("nav");

menuIcon.addEventListener("click", function () {
  if (navMenu.style.display == "none") {
    navMenu.style.display = "block";
    body.style.overflow = "hidden";
  } else {
    navMenu.style.display = "none";
    body.style.overflow = "visible";
  }
})