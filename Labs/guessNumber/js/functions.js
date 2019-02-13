            var randomNumber= Math.floor(Math.random()*99)+1;
            

            var guesses= document.querySelector('#guesses');
            var lastResult= document.querySelector('#lastResult');
            var lowOrHi = document.querySelector('#lowOrHi');
            var stats= document.querySelector("#stats");

            var guessSubmit= document.querySelector('.guessSubmit');
            var guessField= document.querySelector('.guessField');

            var guessCount=1;
            var wins=0;
            var loses=0;
            var resetButton = document.querySelector('#reset');
            guessField.focus();


            function checkGuess(){

                var userGuess= Number(guessField.value);

                if(guessCount==1){
                    $('#guesses').html('Previous Guesses: ');

                        // guesses.innerHTML= ' Previous guesses: ';
                }

                if(userGuess>99|| isNaN(userGuess)){
                    // lastResult.innerHTML = 'That number is not valid!'
                    $('#lastResult').html("That number is not valid!");
                    guessCount--;
                    guesses.innerHTML+=userGuess+ ' ';
                    lastResult.style.backgroundColor='black';
                }
                else{


                    guesses.innerHTML+=userGuess+ ' ';
                    $('#stats').html("Wins: "+ wins+ "\n"+"Loses: "+ loses );
                    if(userGuess==randomNumber){
                        wins++;
                        // lastResult.innerHTML= ' Congratulations! You got it right!';
                        $('#lastResult').html("Congratulations! You got it right!");
                        lastResult.style.backgroundColor='green';
                        // lowOrHi.innerHTML= '';

                        // $('#stats').html("Loses: "+ loses);

                        $('#lowOrHi').html('');
                        setGameOver();
                    }

                    else if(guessCount===7){
                        loses++;
                        // lastResult.innerHTML='Sorry, you lost!';
                        $('#lastResult').html("Sorry, you lost!");
                   

                        setGameOver();
                    }

                    else{
                        // lastResult.innerHTML= "Wrong!";
                        $('#lastResult').html("Wrong!");

                        lastResult.style.backgroundColor= 'red';

                        if(userGuess<randomNumber){
                            // lowOrHi.innerHTML= ' Last Guess was too low!';
                            $('#lowOrHi').html('Last guess was too low');
                        }
                        else if(userGuess>randomNumber){
                            // lowOrHi.innerHTML= 'Last guess was too high!';
                            $('#lowOrHi').html('Last guess was too high');
                        }
                    }
                }

                    guessCount++;
                    guessField.value='';
                    guessField.focus();
            }

            guessSubmit.addEventListener('click',checkGuess);

            function setGameOver(){

                guessField.disabled=true;
                guessSubmit.disabled=true;
                resetButton.style.display='inline';
                resetButton.addEventListener('click',resetGame);
            }

            function resetGame(){

                guessCount=1;

                var resetParas= document.querySelectorAll('.resultParas p');

                for (var i=0;i<resetParas.length;i++){
                    resetParas[i].textContent='';
                }

                resetButton.style.display='none';

                guessField.disabled=false;
                guessSubmit.disabled=false;
                guessField.value='';
                guessField.focus();

                lastResult.style.backgroundColor='white';

                randomNumber= Math.floor(Math.random()*99)+1;
            }
            // JavaScript File