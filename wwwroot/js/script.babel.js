'use strict';


var date = new Date();
date.setHours(0,0,0,0);
var sec = date.getSeconds();
var min = date.getMinutes();
var timeDisplay = "";
var handler = function() {
  if (++sec === 60) {
    sec = 0;
    if (++min === 60) min = 0;
  }
  timeDisplay = (min < 10 ? "0" + min : min) + ":" + (sec < 10 ? "0" + sec : sec);
  document.getElementById("time").innerHTML = timeDisplay;
};
//setInterval(handler, 1000);
//handler();
// timer works currently, TODO: find a way to display after clicking a card. - Matt

var masterArray = [{
  'name': 'American Dog',
  'img': 'img/Match_2.jpg'
}, {
  'name': 'Anntie Anne',
  'img': 'img/Match_3.jpg'
}, {
  'name': 'Berghoff',
  'img': 'img/Match_4.jpg'
}, {
  'name': 'BSmooth',
  'img': 'img/Match_5.jpg'
}, {
  'name': 'Barbaras',
  'img': 'img/Match_6.jpg'
}, {
  'name': 'Brighton',
  'img': 'img/Match_7.jpg'
}, {
  'name': 'Brooks Brothers',
  'img': 'img/Match_8.jpg'
}, {
  'name': 'Brookstone',
  'img': 'img/Match_9.jpg'
}, {
  'name': 'Burrito Beach',
  'img': 'img/Match_10.jpg'
}, {
  'name': 'CIBO',
  'img': 'img/Match_11.jpg'
}, {
  'name': 'CNN',
  'img': 'img/Match_12.jpg'
}, {
  'name': 'Coach',
  'img': 'img/Match_13.jpg'
}, {
  'name': 'Field',
  'img': 'img/Match_14.jpg'
}, {
  'name': 'Green Market',
  'img': 'img/Match_15.jpg'
}, {
  'name': 'Headphone Hub',
  'img': 'img/Match_16.jpg'
}, {
  'name': 'HoyPoloi',
  'img': 'img/Match_17.jpg'
}, {
  'name': 'Hudson',
  'img': 'img/Match_18.jpg'
}, {
  'name': 'InMotion',
  'img': 'img/Match_19.jpg'
}, {
  'name': 'Johnston',
  'img': 'img/Match_20.jpg'
}, {
  'name': 'MAC',
  'img': 'img/Match_21.jpg'
}, {
  'name': 'McDonalds',
  'img': 'img/Match_22.jpg'
}, {
  'name': 'Nuts on Clark',
  'img': 'img/Match_23.jpg'
}, {
  'name': 'Rocky Mountain',
  'img': 'img/Match_24.jpg'
}, {
  'name': 'Sarahs Candies',
  'img': 'img/Match_25.jpg'
}, {
  'name': 'Shoe Hospital',
  'img': 'img/Match_26.jpg'
}, {
  'name': 'Spirit of the Red Horse',
  'img': 'img/Match_27.jpg'
}, {
  'name': 'Talie',
  'img': 'img/Match_28.jpg'
}, {
  'name': 'Vosges',
  'img': 'img/Match_29.jpg'
}];

var tempArray = masterArray.slice();
var NUM_CARDS = 12;
var cardsArray = [];
for (var i = 0; i < NUM_CARDS; i++)
{
    var chosenCard = Math.floor(Math.random() * tempArray.length);
    cardsArray[i] = tempArray[chosenCard];
}

var gameGrid = cardsArray.concat(cardsArray).sort(function () {
  return 0.5 - Math.random();
});
var matchno = 0;
var firstGuess = '';
var secondGuess = '';
var count = 0;
var wrongGuesses = 0;
var previousTarget = null;
var delay = 1200;
var numTries = 0;
var game = document.getElementById('game');
var grid = document.createElement('section');
grid.setAttribute('class', 'grid');
game.appendChild(grid);

gameGrid.forEach(function (item) {
  var name = item.name,
      img = item.img;


  var card = document.createElement('div');
  card.classList.add('card');
  card.dataset.name = name;

  var front = document.createElement('div');
  front.classList.add('front');

  var back = document.createElement('div');
  back.classList.add('back');
  back.style.backgroundImage = 'url(' + img + ')';

  grid.appendChild(card);
  card.appendChild(front);
  card.appendChild(back);
});

var match = function match() {
  var selected = document.querySelectorAll('.selected');
  selected.forEach(function (card) {
    card.classList.add('match');
  });
};

var resetGuesses = function resetGuesses() {
  firstGuess = '';
  secondGuess = '';
  count = 0;
  previousTarget = null;

  var selected = document.querySelectorAll('.selected');
  selected.forEach(function (card) {
    card.classList.remove('selected');
  });
};

var timerStarted = false;
function startTimer()
{
	if (!timerStarted)
	{
		setInterval(handler, 1000);
		timerStarted = true;
	}
}

grid.addEventListener('click', function (event) {

	startTimer();
  var clicked = event.target;

  if (clicked.nodeName === 'SECTION' || clicked === previousTarget || clicked.parentNode.classList.contains('selected') || clicked.parentNode.classList.contains('match')) {
    return;
  }

  if (count < 2) {
    count++;
    if (count === 1) {
      firstGuess = clicked.parentNode.dataset.name;
      console.log(firstGuess);
      clicked.parentNode.classList.add('selected');
    } else {
	  numTries++;
	  secondGuess = clicked.parentNode.dataset.name;
      console.log(secondGuess);
      clicked.parentNode.classList.add('selected');
    }

    if (firstGuess && secondGuess) {
      if (firstGuess === secondGuess) {
        setTimeout(match, delay);
	  matchno = matchno + 1;
      }
	  else
	  {
          wrongGuesses++;
          document.getElementById("score").innerHTML = "Wrong guesses:  " + wrongGuesses;
	  }
      setTimeout(resetGuesses, delay);
	  
    }
    previousTarget = clicked;
	if (matchno === 12)
	{
		window.location.assign("memory_end.php?score="+wrongGuesses+"&time="+timeDisplay);
		//Memory game end page created sucessfully - Matt
		//window.location.assign("trivia_end.html");
		//setTimeout(
		//window.location.assign("game_end.php?score="+wrongGuesses),
		//delay);
	
	}
  }
});
