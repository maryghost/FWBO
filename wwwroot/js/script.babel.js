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

var masterArray = [
    {
      'name': 'American Dog',
      'img': 'img/img1.jpg'
    }, {
      'name': 'Anntie Anne',
      'img': 'img/img2.jpg'
    }, {
      'name': 'Berghoff',
      'img': 'img/img3.jpg'
    }, {
      'name': 'BSmooth',
      'img': 'img/img4.jpg'
    }, {
      'name': 'Barbaras',
      'img': 'img/img5.jpg'
    }, {
      'name': 'Brighton',
      'img': 'img/img6.jpg'
    }, {
      'name': 'Brooks Brothers',
      'img': 'img/img7.jpg'
    }, {
      'name': 'Brookstone',
      'img': 'img/img8.jpg'
    }, {
      'name': 'Burrito Beach',
      'img': 'img/img9.jpg'
    }, {
      'name': 'CIBO',
      'img': 'img/img10.jpg'
    }, {
      'name': 'CNN',
      'img': 'img/img11.jpg'
    }, {
      'name': 'Coach',
      'img': 'img/img12.jpg'
    }, {
      'name': 'Field',
      'img': 'img/img13.jpg'
    }, {
      'name': 'Green Market',
      'img': 'img/img14.jpg'
    }, {
      'name': 'Headphone Hub',
      'img': 'img/img15.jpg'
    }, {
      'name': 'HoyPoloi',
      'img': 'img/img16.jpg'
    }, {
      'name': 'Hudson',
      'img': 'img/img17.jpg'
    }, {
      'name': 'InMotion',
      'img': 'img/img18.jpg'
    }, {
      'name': 'Johnston',
      'img': 'img/img19.jpg'
    }, {
      'name': 'MAC',
      'img': 'img/img20.jpg'
    }, {
      'name': 'McDonalds',
      'img': 'img/img21.jpg'
    }, {
      'name': 'Nuts on Clark',
      'img': 'img/img22.jpg'
    }, {
      'name': 'Rocky Mountain',
      'img': 'img/img23.jpg'
    }, {
      'name': 'Sarahs Candies',
      'img': 'img/img24.jpg'
    }, {
      'name': 'Shoe Hospital',
      'img': 'img/img25.jpg'
    }, {
      'name': 'Spirit of the Red Horse',
      'img': 'img/img26.jpg'
    }, {
      'name': 'Talie',
      'img': 'img/img27.jpg'
    }, {
      'name': 'Vosges',
      'img': 'img/img28.jpg'
    }, {
      'name': 'SPA',
      'img': 'img/img29.jpg'
    }, {
      'name': 'Donkin Donuts',
      'img': 'img/img30.jpg'
    }, {
      'name': 'Dutty Free Store',
      'img': 'img/img31.jpg'
    }, {
      'name': 'Jamba Juice',
      'img': 'img/img32.jpg'
    }, {
      'name': 'Fresh Market',
      'img': 'img/img33.jpg'
    }, {
      'name': 'ICE',
      'img': 'img/img34.jpg'
    }, {
      'name': 'La Tapenade',
      'img': 'img/img35.jpg'
    }, {
        'name': 'Argo Tea',
        'img': 'img/img36.jpg'
    },
];

var tempArray = masterArray.slice();
var NUM_CARDS = 12;
var cardsArray = [];
for (var i = 0; i < NUM_CARDS; i++)
{
    var chosenCard = Math.floor(Math.random() * tempArray.length);
    cardsArray[i] = tempArray[chosenCard];
    tempArray.splice(chosenCard, 1);
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
