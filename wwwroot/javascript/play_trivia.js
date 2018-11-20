$(function () {
    var questions = [{
            question: "Which list contains words that are NOT names of shoe types?",
            choices: [ "A. Oxford, jelly, boat, clogs, stiletto, mary jane",
				       "B. Loafer, gladiator, wedge, mule, platform",
				       "C. Pump, moccasin, wingtip, sneaker, derby, monk",
				       "D. Chalupa, dogler, hamster, croonley, frankfurt",
				     ],
            correctAnswer: 3
        }, {            
			question: "O'Hare store: Johnston & Murphy has been custom designing shoes for every US President since 1850. Who was the President in 1850?",
            choices: ["A. James Buchanan",
		      "B. Franklin Pierce",
                      "C. Millard Fillmore",
		      "D. Zachary Taylor"],
            correctAnswer: 2
        }, {
            question: "Which US President wore the largest Johnston & Murphy shoe (so far)?",
            choices: ["A. Barack Obama",
		      "B. George Washington",
                      "C. Richard Nixon",
		      "D. Abraham Lincoln"],
            correctAnswer: 3
        }, {
            question: "Who created the cloud gate Sculpture?",
            choices: ["A. Anish Kapoor",
		      "B. ARMINE AGHAYAN",
                      "C. Jimmy Wales",
                      "D. Zelalem Gebre"],
            correctAnswer: 1
        }, { 
		question: "who founded chicago?",
			choices: ["A. Abraham Lincoln",
				  "B. Jean-Baptist-Point Du Sable",
				  "C. John Wilkes Booth",
			          "D. Mary Todd Lincoln"],
		correctAnswer: 2
					  
	}, {
			 question: "Who was the 16th President of the United States?",
            choices: ["A. Robert E. Lee",
		      "B. Barak Obama",
                      "C. Andrew Johnson",
                      "D. Abraham Lincoln"],
            correctAnswer: 4
        }, {
		
            question: "What is the difference between Deep Tissue and Swedish Massage?",
            choices: ["A. Deep Tissue massage is performed in deep waters off the Mediterranean Sea.",
		      "B. Swedish Massage can only be performed by people born in Sweden.",
                      "C. Deep tissue is firm and more therapeutic, while Swedish is lighter and more relaxing. Both are available at O'Hare."],
            correctAnswer: 2
        }, {
            question: "In what year was prohibition in the US repealed?",
            choices: ["A. 1932 - (Amelia Earhart lands in Ireland in the first transatlantic solo flight by a woman)",
		      "B. 1933 - (1st Flight of all-metal Boeing 247)",
                      "C. 1942 - (Edward 'Butch' O'Hare receives the Medal of Honor from President Franklin D. Roosevelt)",
                      "D. 1963 - ( President Kennedy dedicates O'Hare International Airport in honor of Edward 'Butch'' O'Hare)"],
            correctAnswer: 1
        }, {
            question: "Which animal can you find roaming around O'Hare property?",
            choices: ["A. Cow",
		      "B. Ostrich",
                      "C. Goats",
                      "D. Giraffes"],
            correctAnswer: 2
        }, {
            question: "What word is derived from the Arabic word “qandi” and means made of sugar?",
            choices: ["A. Soda Pop",
		      "B. Candy",
                      "C. Chocolate"],
            correctAnswer: 1
        }, {
            question: "It’s summer time and I forgot my sunglasses. I should go to:",
            choices: ["A. Oakley",
	              "B. Hudson News & Gifts stores and CNN Stores",
                      "C. Jenny''s Cool Spectacles",
                      "D. Sunglass Hut",
                      "E. A, B, and D only"],
            correctAnswer: 4
        }, {
            question: "O'Hare is home to bees, goats and a dinosaur.",
            choices: ["A. True",
		      "B. False",
                     ],
            correctAnswer: 0
        }, {
            question: "Plants can grow without soil at O'Hare.",
            choices: ["A. True",
		      "B. False",
                     ],
            correctAnswer: 0
        }
        ];
    

    
  
  
  	var questionCounter = 0; //Tracks question number
    var selections = []; //Array containing user choices
    var quiz = $('#quiz'); //Quiz div object
   
  // Display initial question
    displayNext();
  
  // Click handler for the 'next' button
    $('#next').on('click', function (e) {
        e.preventDefault();
    
    // Suspend click listener during fade animation
        if (quiz.is(':animated')) {       
            return false;
        }
        choose();
    
    // If no user selection, progress is stopped
        if (isNaN(selections[questionCounter])) {
            alert('Please make a selection!');
        } else {
            questionCounter++;
            displayNext();
        }
    });
  
  // Click handler for the 'prev' button
    $('#prev').on('click', function (e) {
        e.preventDefault(); 
    
        if (quiz.is(':animated')) {
            return false;
        }
        choose();
        questionCounter--;
        displayNext();
    });
  

  
  // Creates and returns the div that contains the questions and 
  // the answer selections
    function createQuestionElement(index) {
        var qElement = $('<div></div>', {
            id: 'question'
        });
    
        var header = $('<h2>Question ' + (index + 1) + ':</h2>');
        qElement.append(header);
    
        var question = $('<p>').append(questions[index].question);
        qElement.append(question);
    
        var radioButtons = createRadios(index);
        qElement.append(radioButtons);
    
        return qElement;
    }
  
  // Creates a list of the answer choices as radio inputs
    function createRadios(index) {
        var radioList = $('<ul>');
        var item;
        var input = '';
        for (var i = 0; i < questions[index].choices.length; i++) {
      item = $('<li>');
      input = '<input type="radio" name="answer" value=' + i + ' />';
      input += questions[index].choices[i];
      item.append(input);
      radioList.append(item);
    }
    return radioList;
  }
  
  // Reads the user selection and pushes the value to an array
  function choose() {
    selections[questionCounter] = +$('input[name="answer"]:checked').val();
  }
  
  // Displays next requested element
  function displayNext() {
    quiz.fadeOut(function() {
      $('#question').remove();
      
      if(questionCounter < questions.length){
        var nextQuestion = createQuestionElement(questionCounter);
        quiz.append(nextQuestion).fadeIn();
        if (!(isNaN(selections[questionCounter]))) {
          $('input[value='+selections[questionCounter]+']').prop('checked', true);
        }
        
        // Controls display of 'prev' button
        if(questionCounter === 1){
          $('#prev').show();
        } else if(questionCounter === 0){
          
          $('#prev').hide();
          $('#next').show();
        }
      }else {
        var scoreElem = displayScore();
        quiz.append(scoreElem).fadeIn();
        $('#next').hide();
        $('#prev').hide();
        $('#start').show();
      }
    });
  }
  
  // Computes score and returns a paragraph element to be displayed
  function displayScore() {
    var score = $('<p>',{id: 'question'});
    
    var numCorrect = 0;
    for (var i = 0; i < selections.length; i++) {
      if (selections[i] === questions[i].correctAnswer) {
        numCorrect++;
      }
    }
    
    score.append('You got ' + numCorrect + ' questions out of ' +
                 questions.length + ' right!!!');
    return score;
  }   
    
});

