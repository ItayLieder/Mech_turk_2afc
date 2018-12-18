// ================
// ******* Training ******* 
// ================
var trainingLength=1; //30
var trainingTrial=0;
var trainCorrect=0;

// ====================
// ******* Task! ******* 
// =====================
var nTrials = 15; //300
var trial=0;
var block=0;
var pauseTime=5; //100
var breaks=0;

var response=[];
//response = range(0,299);
var acc = [];


var allow=false;

var feedbackTrial = 0;
var feedbackBlock = 1; 

// =====================
// ******* Adaptive ******* 
// =====================
var trig; var reversal; var step; var stepVec=[]; var success; var R;
initAdapt();

var R_block = 1.05;
var avg;
var feedstr;

// ================
// ******* 	Training ******* 
// ================
function startTaskTraining(){
	//console.log(onset)
	//console.log(duration)
	//console.log(ISI)

	//================end training================
	if (trainingTrial==trainingLength || trainCorrect==8) {		
			$('#inst3').show();$('#next5').show();$('.textQuestion').hide();	
	//================continue to play tones ================		
	}else {	
			trainingTrial++;
		// -----play first tone ------
		setTimeout(function () {s1[tone1Training[trainingTrial-1]].play()},onset[trainingTrial-1]);
		// -----stop first tone ------
		setTimeout(function () {s1[tone1Training[trainingTrial-1]].pause()},onset[trainingTrial-1]+duration[trainingTrial-1]+ISI[trainingTrial-1]-10);
		setTimeout(function () {s1[tone1Training[trainingTrial-1]].currentTime = 0},onset[trainingTrial-1]+duration[trainingTrial-1]+ISI[trainingTrial-1]-10);
		// -----play second tone ------
		setTimeout(function () {s2[tone2Training[trainingTrial-1]].play()},onset[trainingTrial-1]+duration[trainingTrial-1]+ISI[trainingTrial-1]);
		callTimeoutTraining(onset[trainingTrial-1]+duration[trainingTrial-1]+duration[trainingTrial-1]+ISI[trainingTrial-1],trial); 
	}
}


function callTimeoutTraining(time){ 
	setTimeout(function () {$('.Qbuttons').show();$('.textQuestion').show();},time);	
	// ******************************* response 1 -- ask questions ******************************************    
	document.getElementById('button1').onclick = function() {
		$('.Qbuttons').hide();
		if (tone1Training[trainingTrial-1]>tone2Training[trainingTrial-1]){
			$('#incorrect').show();
			trainCorrect=0;
		}else{
			$('#correct').show();
			trainCorrect++;
		}		
		setTimeout(function () {$('.feedback').hide();startTaskTraining();},500);
	} 	
	// ******************************* response 2 -- ask questions ******************************************    
	document.getElementById('button2').onclick = function() {
		$('.Qbuttons').hide();
		if (tone1Training[trainingTrial-1]>tone2Training[trainingTrial-1]){
			$('#correct').show();
			trainCorrect++;

		}else{
			$('#incorrect').show();
			trainCorrect=0;
		}
		setTimeout(function () {$('.feedback').hide();startTaskTraining();},500);
	} 	
}



// =====================
// ******* 	Task ******* 
// =====================
function startTask(){
	console.log('trial')
	console.log(trial)

// ========================= block over============================
	if (trial == nTrials){
			finish();
// ========================= continue to play tones============================
	}else {
		trial++;		

		//====== Trial adaptive =====
		/*if (trial>1){
			adapt(acc[trial-2]);
		}
		range = [800,1250];
		dfrange = [R,R];
		tones = sampleUniform(range,dfrange,2);
		tone1[trial-1] = tones[0];
		tone2[trial-1]= tones[1];*/
		//=======================

		//====== Block adaptive =====
		//range = [800,1250];
		//dfrange = [R_block,R_block];
		//tones = sampleUniform(range,dfrange,2);
		//tone1[trial-1] = tones[0];
		//tone2[trial-1]= tones[1];
		//=======================
		
		
		//console.log(tone1[trial-1])
		//console.log(tone2[trial-1])		
		// -----play first tone ------
		console.log(tone1[trial-1])

		setTimeout(function () {s1[tone1[trial-1]].play()},onset[trial-1]);
		// -----stop first tone ------
		setTimeout(function () {s1[tone1[trial-1]].pause()},onset[trial-1]+duration[trial-1]+ISI[trial-1]-10);
		setTimeout(function () {s1[tone1[trial-1]].currentTime = 0},onset[trial-1]+duration[trial-1]+ISI[trial-1]-10);
		// -----play second tone ------
		setTimeout(function () {s2[tone2[trial-1]].play()},onset[trial-1]+duration[trial-1]+ISI[trial-1]);
		callTimeout(onset[trial-1]+duration[trial-1]+duration[trial-1]+ISI[trial-1],trial); 
	}
}



function callTimeout(time,trial){ 
	setTimeout(function () {
		$('.Qbuttons').show();$('.textQuestion').show();
		var writeTrials=(trial-pauseTime*breaks);
		document.getElementById("counter").innerHTML = "Trial:  "+writeTrials+ "/" +pauseTime;
	

		// ******************************* KEYBOARD responses ******************************************    
		allow=true;
		$( document ).keyup(function(e) { 
		if(e.which == 49 && allow==true) {
			keyAnswer1();
			allow=false;   

		} 
		else if (e.which == 50 && allow==true) {
			keyAnswer2();
			allow=false;   	
		}	
	});
	},time);	

	// ******************************* MOUSE response 1 ******************************************    
	document.getElementById('button1').onclick = function() {		
		response[trial-1]=1;
		
		if (tone1[trial-1]>tone2[trial-1]){
			acc[trial-1] = 0;
		}else{
			acc[trial-1] = 1;
		}	
		pressButton();
	} 	
	// ******************************* MOUSE response 2 ******************************************    
	document.getElementById('button2').onclick = function() {	
		response[trial-1]=0;
		
		if (tone1[trial-1]>tone2[trial-1]){
			acc[trial-1] = 1;
		}else{
			acc[trial-1] = 0;
		}	
		pressButton();
	} 	
}
//============================================================
function pressButton(){
	$('.Qbuttons').hide();
	if (feedbackTrial == 1){
	// ====FEEDBACK======
		if (acc[trial-1]==0){
		$('#incorrect').show();
		}else{
		$('#correct').show();
		}
	}
	//=====================
	if (trial%pauseTime==0) {		
		doBreak();
	} else {
		setTimeout(function () {$('.feedback').hide();startTask();},500);
	}
}

function doBreak(){
	$('.Qbuttons').hide();$('.textQuestion').hide();$('.feedback').hide(); // hide linking to the next page
	if (breaks==(nTrials/pauseTime-2)){
		$('#break2').show();
	} else if (breaks==(nTrials/pauseTime-1)) {
		$('#break3').show();
	} else {
		$('#break').show();
	}
	//===================== showing block feedback=============
	var sum = 0;
	for (var ii = trial - pauseTime; ii < trial; ii++){
	    sum =sum+ acc[ii]; //don't forget to add the base
	}	
	avg = Math.round(sum/pauseTime*100);
	
	blockFeedbackAdaptivity(avg);

	if (feedbackBlock == 1){		
		console.log("You performed " + avg + feedstr)
		document.getElementById("blockFeed").innerHTML = "You performed " + avg + feedstr;
		$('#blockFeed').show();
	}
	//========================================================
	breaks++;
	$('#continue').show();
	document.getElementById('continue').onclick = function (){
		$('.inst').hide();$('#continue').hide();$('#blockFeed').hide();
		startTask();
	}
}



//=================== Keyboard pressing functions - needed because keyup cannot pass the variable trial ==================
function keyAnswer1(){
	response[trial-1]=0;
	if (tone1[trial-1]>tone2[trial-1]){
		acc[trial-1] = 1;
	}else{
		acc[trial-1] = 0;
	}
	pressButton();
}
function keyAnswer2(){
	response[trial-1]=1;
	if (tone1[trial-1]>tone2[trial-1]){
		acc[trial-1] = 0;
	}else{
		acc[trial-1] = 1;
	}
	pressButton();
}





