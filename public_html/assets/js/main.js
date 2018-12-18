// ######################## Start script only when JQuary finish loading ###########################
(function($){
$(document).ready(function(){
	

// ======================
// ******* Preparing stimuli ******* 
// ======================
// when JQuary finishes loading, preLoading functions is called from "pre_loads.js", 
//where all the initial loading preloading of stimuli happens 

$( "#progressbarPre" ).progressbar({value: 0.01});
$(window).load(function(){
	preLoading() 

}); 


// ========================
// ******* Start experiment flow ******* 
// ========================
// When all tones.wav are loaded we see the headphones
// instructions and next1 button


// ============================
// ******* Click next1 --> Instructions ******* 
// ============================
document.getElementById('next1').onclick = function() {
	$('#next1').hide();$('#headphones').hide(); $('#instHeadphones').hide();
	$('#inst1').show();$('#next2').show();
} 

// ============================
// ******* Click next2 --> Demo ******* 
// ============================
document.getElementById('next2').onclick = function (){
	$('#next2').hide();$('#inst1').hide();$('#title1').hide(); // hide stuff
	$('.Dbuttons').show(); $('#next3').show(); $('#demo').show();$('#axis').show();
	
// ============================
// ******* Click next3 --> Instructions ******* 
// ============================
	document.getElementById('next3').onclick = function (){
	$('#next3').hide();$('.Dbuttons').hide();$('#demo').hide();$('#axis').hide();
	$('#inst2').show();$('#next4').show();
	}
}

// ============================
// ******* Click next4 --> Training ******* 
// ============================
document.getElementById('next4').onclick = function() {
	$('#inst2').hide();$('#next4').hide();
	// ================= Sampling initialization===================
loadTrainingTones([700,1550]);
loadOnsets([500,500],nTrials); //500
loadDurations([220,220],nTrials); //220
loadISIs([800,800],nTrials); //800
// ==================================================
	startTaskTraining();

} 

// ============================
// ******* Click next5 --> Task block1 ******* 
// ============================

document.getElementById('next5').onclick = function (){
	$('#next5').hide();$('#inst3').hide();
// ================= Sampling initialization===================
loadTones([500,2000],[1.005,1.1],nTrials); // Vincent and Itay

// ==================================================
//finish(); // for automatic testing
	startTask(); 
}


});
}(jQuery));

function finish(){

	$('.textQuestion').hide()
	document.getElementById("counter").innerHTML = "";

	$('#thanks').show()
	
	$.post('data_collector', {postTone1: tone1, postTone2: tone2, postResponse: response, postDuration: duration, postOnset: onset, postISI: ISI}, function(data){
	      //console.log(data);	       
     });
}
