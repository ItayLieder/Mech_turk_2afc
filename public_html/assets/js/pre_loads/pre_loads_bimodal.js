// ######################## Start script only when JQuary finish loading ###########################


// ===================
// ******* Loading wavs ******* 
// ===================
var s1=[];  //containers for the wavs
var s2=[];
var preLoaded=0; // counter for parallel load
var fails=0;
//var ii;


//  ===== Complex tones ======
if (Math.random()>0.5){
	side = 0;
}else{
	side = 1000;
}

var mode1 = [630,1002];
var mode2 = [998,1565]; 
var numToLoad = mode1[1] - mode1[0] + mode2[1] - mode2[0];

// =================
// ******* Preloading ******* 
// =================
function preLoading() { 
	if (side==0){
		for (var ii=mode1[0];ii<mode1[1];ii++){ // looping number of total presentations
			name1='http://54.68.5.226/complexPrior/Matlab/wav/'+ii+'_1.wav';
			s1[ii]= new Audio(name1);
			s1[ii].addEventListener('canplaythrough', isPreLoad); 
			s1[ii].addEventListener('error', failFunc(fails)); 
			s1[ii].removeEventListener('canplaythrough',function(){}); 		
		}		
		
			for (var ii=mode2[0];ii<mode2[1];ii++){ // looping number of total presentations
			name2='http://54.68.5.226/complexPrior/Matlab/wav/'+ii+'_4.wav';
			
			s1[ii+1000]= new Audio(name2);
			s1[ii+1000].addEventListener('canplaythrough', isPreLoad)
			s1[ii+1000].removeEventListener('canplaythrough',function(){}); 
	
		}	
	} else if(side == 1000){
			for (var ii=mode2[0];ii<mode2[1];ii++){ // looping number of total presentations
			name1='http://54.68.5.226/complexPrior/Matlab/wav/'+ii+'_1.wav';
			s1[ii]= new Audio(name1);
			s1[ii].addEventListener('canplaythrough', isPreLoad); 
			s1[ii].addEventListener('error', failFunc(fails)); 
			s1[ii].removeEventListener('canplaythrough',function(){}); 		
		}		
		
			for (var ii=mode1[0];ii<mode1[1];ii++){ // looping number of total presentations
			name2='http://54.68.5.226/complexPrior/Matlab/wav/'+ii+'_4.wav';	
			s1[ii+1000]= new Audio(name2);
			s1[ii+1000].addEventListener('canplaythrough', isPreLoad); 
			s1[ii+1000].addEventListener('error', failFunc(fails)); 
			s1[ii+1000].removeEventListener('canplaythrough',function(){}); 
	
		}			
	}
		
}
// =================================
// ******* this functions counts parllel wav loading 
// and informs the pre-progressbar ******* 
// ================================
function failFunc(fails) {
	fails++;
}

function isPreLoad() {
	preLoaded++;
	console.log(preLoaded)
	console.log(fails)
	drawProgressPre(preLoaded);
	if (fails>0 && preLoaded==(numToLoad-fails)){
				location.reload();
	}	
	if (preLoaded==numToLoad) {
		s2=s1;
		$('.loading').hide(); 
		$("#progressbarPre").progressbar( "destroy" ); 
		$("#progressbarPre").hide();
		$('#next1').show();$('#headphones').show();$('#instHeadphones').show();
	}
}




