// ================================================================
// ***************************************** Sampling stimuli ****************************************
// ================================================================

var tone1Training=[];
var tone2Training=[];

var sampleRange=[];
  for (ii=0;ii<length;ii++){
    sampleRange[ii]=ii+1;
    sampleRange[ii]=sampleRange[ii]%2
  }
sampleRange=shuffle(sampleRange);
// ===================
// ******* Sample tones ******* 
// ===================
//according to (may change): Uniform sampling of "s1" in the range "range" and 
// Uniform sampling of s2|s1 in the range of dfrange (copied the matlab code) 

function drawNewTrial(range,dfrange) {
//----------------- sampling s1 --------------
	var logrange = [Math.log(range[0]),Math.log(range[1])];
	var logdfrange = [Math.log(dfrange[0]),Math.log(dfrange[1])];
	var df = Math.random()*(logdfrange[1]-logdfrange[0])+logdfrange[0];
	//var df = (logdfrange[1]-logdfrange[0])+logdfrange[0];
	var f1 = Math.random()*(logrange[1]-logrange[0])+logrange[0];	
	var f2;

	if (Math.random()>0.5) {
		f2 = f1 + df;
	}else {
		f2 = f1 - df;
	}

	
	while (f2>logrange[1] || f2<logrange[0]){
		var f1 = Math.random()*(logrange[1]-logrange[0])+logrange[0];	
				
		if (Math.random()>0.5) {
			f2 = f1 + df;
		}else {
			f2 = f1 - df;
		}
	}

  
//----------------- deciding who is s1 and who is s2 --------------
	if (Math.random()>0.5) {
		t1 = Math.round(Math.exp(f1));
		t2 = Math.round(Math.exp(f2));
	} else {
		t2 = Math.round(Math.exp(f1));
		t1 = Math.round(Math.exp(f2));
	}
		
	return [t1,t2];
}

// ===========================
// ******* Sample tones for training ******* 
// ===========================
function loadTrainingTones(tone1Training,tone2Training){
	for (var jj=0;jj<50;jj++){ // looping number of total presentations	
			if (Math.random()>0.5){
		
				tones = drawNewTrial([700,1000],[1.2,1.2]); 
				if (side==1000){
					tone1Training[jj] = tones[0]+1000;
					tone2Training[jj]= tones[1]+1000;
				}else{
					tone1Training[jj] = tones[0];
					tone2Training[jj]= tones[1];
				}
				
			}else{
				
				tones = drawNewTrial([1000,1550],[1.2,1.2]); 
				if (side==1000){
					tone1Training[jj] = tones[0];
					tone2Training[jj]= tones[1];
				}else{
					tone1Training[jj] = tones[0]+1000;
					tone2Training[jj]= tones[1]+ 1000;
				}
			}		
		}
}




// =========================
// ******* Sample tones for task ******* 
// =========================
function loadTones(tone1,tone2,nTrials,sampleRange){
	for (var jj=0;jj<nTrials;jj++){ // looping number of total presentations
		if (sampleRange[jj]==1){
			tones = drawNewTrial([640,1000],[1.005,1.1]); 
				tone1[jj] = tones[0] +side;
				tone2[jj]= tones[1] + side;
		}else{
			tones = drawNewTrial([1000,1562],[1.005,1.1]); 
				tone1[jj] = tones[0] +(1000-side);
				tone2[jj]= tones[1] + (1000-side);
		}
	}
}