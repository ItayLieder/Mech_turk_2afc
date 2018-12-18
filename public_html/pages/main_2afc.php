<!-- ======================================= HTML======================================== -->

<!-- title -->
<h3 id="title1" >Auditory perception</h3>

<!-- ############### INST CLASS ################ -->

<!-- headphones -->
<div id="instHeadphones" class="inst">
<p>Please make sure you have your headphones set up and on you.</p>
<p>IMPORTANT: If you do not have a set of headphones, please do not proceed with the experiment</p>
<p>Press next to continue. To exit, simply close the tab</p>
</div>
<input type="button" id="next1" class = "passButtons" value="Next"  />


<!-- inst1 -->
<div id="inst1" class="inst">
<p><strong>In our lab we study auditory perception. You are now going to participate in the key task of our lab!!</strong></p>
<p>In this experiment I will play two tones (beeps) on each trial/question</p>
<p>Then I will ask you which of the two is higher in pitch and which is lower</p>
</div>
<input type="button" id="next2" class = "passButtons" value="Next"  />

<!-- demo -->
<div id="demo" class="inst">
<p>What do I mean by "high" and "low" pitch? </p>
 <p>Lets get a feeling of "higher" and "lower" tones by pressing on these squares</p>
 <p>The tones <strong>increase</strong> in pitch from left to right - try it! :)</p>
 <p>Got it? great - press next</p>
</div>
<!-- demo buttons-->
<input type="button" id="Dbutton1" class = "Dbuttons" name = "button1" value=""  />
<input type="button"  id="Dbutton2" class = "Dbuttons" name = "button2" value=""  />
<input type="button" id="Dbutton3" class = "Dbuttons" name = "button3" value=""  />
<input type="button"  id="Dbutton4" class = "Dbuttons" name = "button4" value=""  />


<input type="button" id="next3" class = "passButtons" value="Next"  />

<!-- inst2 -->
<div id="inst2" class="inst">
<p>The task:</p>
<p>On each trial (question), two tones will be played consecutively: tone 1 --> tone 2</p>
<p>Then I ask: which of the two tones had the higher pitch? </p>
<p><strong>If the first tone had a higher pitch - press 1, otherwise press 2</strong></p>
<p>We will begin with a short training session.</p>
</div>
<input type="button" id="next4" class = "passButtons" value="Next"  />

<!-- inst3 -->
<!-- <div id="inst3" class="inst">
<p>Good job, now we can start the real task</p>
<ul>
<li>Its going to be a little different - each trial(question) will start with some wierd sounds, then a single tone will be played. 
	<br>Only then the tones you need to compare will be played:</li>
<br><li><strong>Wierd sounds -> single tone -> two tones you need to compare (like you did before)</strong></li>
<br><li>The time between the single tone and the two target tones will vary (could be up to a few seconds).</li>
<br><li>When the first tone to be compared will be played, a cue <strong>"Start trial!"</strong> will be displayed</li>
<br><li>The task will last for ~30 minutes, 6 blocks of 50 trials with breaks in between</li>
<br><li><strong>Note:</strong> Trials will be much harder now (there is always a correct answer), if you dont know the answer - that's ok, just guess </li>
<br><li>You can now also use the keyboard keys "1" and "2", the ones on the left of the keyboad (not the numped)</li>
</ul>
</div>-->

<!-- inst3 -->
<div id="inst3" class="inst">
<p>Good job, now we can start the real task</p>
<p>The task will last for ~10 minutes, 3 blocks of 50 trials with breaks in between</p>
<p><strong>Note:</strong> Trials will be much harder now (there is always a correct answer), if you dont know the answer - that's ok, just guess </p>
<p>You can now also use the keyboard keys "1" and "2", the ones on the left of the keyboad (not the numped)<p>
<p>Lastly - this time there will be  <strong>NO</strong> feedback after each trial, but only after each block</p>
</div>



<input type="button" id="next5" class = "passButtons" value="Next"  />


<!-- inst3 -->
<div id="inst4" class="inst">
<p>Great! you have finished the first block, only one more to go!</p>
<p>Take a minute to freshen up, when ready click next</p>
</div>
<input type="button" id="next6" class = "passButtons" value="Next"  />

<!-- demo2 -->
<div id="axis" class="inst">
<p>LOWER <------------------       ------------------ > HIGHER</p>
</div>

<!-- demo2 -->
<div id="demo2" class="inst">
<p>The corrent answer is number 2</p>
</div>

<!-- break-->
<div  id="break" class="inst">
<p>You finished a block, Good work!</p>
<p>Before continuing, maybe take a minute or two to freshen up.</p>
</div>
<input type="button" id="continue" class = "passButtons" value="Continue"  />

<div  id="break2" class="inst">
<p>One more block to go!</p>
<p>Before continuing, maybe take a minute or two to freshen up.</p>
</div>

<div  id="thanks" class="thanks">
<p>Thats it!</p>
<p>Many thanks for participating.</p>
<p>M-turk password: hello newman.</p>
<p>You may close this window now.</p>
</div>

<p id="blockFeed"> </p>
<!-- ############### OTHER CLASSES ################ -->

<!-- Question -->
<div  class="textQuestion">
<p> Which of the two tones was higher? </p>
<p id="counter"> </p>
</div>
<input type="image" id="button1"  class = "Qbuttons" src="assets/img/1.png" alt="1">
<input type="image" id="button2" class = "Qbuttons"src="assets/img/2.png" alt="2">

<!-- Loading -->
<div  class="loading">
<p>Loading....</p>
<p>This may take 4-5 minutes to complete, please be patient</p>
</div>


<!-- Task cue -->
<div  class="taskCue">
<p>Start trial!</p>
</div>

<!-- Prgress bar-->
<div id="progressbarPre"></div>

<!-- @@@@@@@@ images @@@@@@-->
<!-- Feedback -->
<p><img alt="" id='correct' class="feedback" src="assets/img/correct.png" alt="correct"></p>
<p><img alt="" id='incorrect' class="feedback" src="assets/img/incorrect.png" alt="incorrect"></p>
<!-- Headphones -->
<p><img alt="" id='headphones' class="headphones" src="assets/img/headphones.jpg" alt="headphones"></p>
<!-- @@@@@@@@ links @@@@@@-->
<!--<a href="main_routing_test.php" name="thanks" id="thanks" class="passButtons" alt="thanks">Finish and submit!</a>-->

<script>
$('.inst').hide();
$('.headphones').hide();
$('.passButtons').hide();
$('.Dbuttons').hide();
$('.textQuestion').hide();
$('.Qbuttons').hide();
$('.feedback').hide();
$('#blockFeed').hide();
$('#title1').hide();
$('.thanks').hide();
</script>



