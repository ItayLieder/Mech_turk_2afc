// ================================================================
// ***************************************** Sampling stimuli ****************************************
// ================================================================
var tones = [];
var tone1Training=[];
var tone2Training=[];

var tone1 = [];
var tone2 = [];

var onset = [];
var duration = [];
var ISI = [];


// ===================================
// ******* 	Tones training ******* 
// ===================================
function loadTrainingTones(range){
	for (var jj=0;jj<50;jj++){ // looping number of total presentations		
				tones = sampleUniform(range,[1.2,1.2],2); 
					tone1Training[jj] = tones[0];
					tone2Training[jj]= tones[1];
	}
}

// ==================================
// ******* 	Tones task  ******* 
// ==================================
function loadTones(range,drange,nTrials2){
	var order = [1,2,3]
	order = shuffle(order)

	loadTones_3sets(range,drange,nTrials2,order[0])
	loadTones_3sets(range,drange,nTrials2,order[1])
	loadTones_3sets(range,drange,nTrials2,order[2])
}

function loadTones_3sets(range,drange,nTrials,method){
	
	var thresh1 = Math.log(1070) - Math.log(970)
	var thresh2 = Math.log(1180) - Math.log(970)
	var thresh3 = Math.log(1250) - Math.log(800)
	
	var mrange_close = [thresh1, thresh2]
	var mrange_far = [thresh3, Math.log(2000) - Math.log(500)]
	

	
	if (method == 1){
		var temp1 = []
		var temp2 = []
		var randomizer = randInt(1,100,20)
		for (var jj=0;jj<nTrials;jj++){ // looping number of total presentations
	      if (any(randomizer,[jj])){
	      	drange = [1.05,1.1];
	      }else{
	      	drange = [1.005,1.04]
	      }

				tones = sampleUniform(range,drange,2); 
					temp1[jj] = tones[0];
					temp2[jj]= tones[1];
		}
	tone1 = tone1.concat(temp1)
	tone2 = tone2.concat(temp2)

	}else if (method == 2){
		inner = 1
		tones = sample_s1_s2_markov(nTrials, range, drange, mrange_close, mrange_far,inner); 
		tone1 = tone1.concat(tones[0]);
		tone2 = tone2.concat(tones[1]);
	}else if (method == 3){
		inner = -1
		tones = sample_s1_s2_markov(nTrials, range, drange, mrange_close, mrange_far,inner); 
		tone1 = tone1.concat(tones[0]);
		tone2 = tone2.concat(tones[1]);
	}		
}


// ==============================
// ******* 	Onset  ******* 
// ==============================
function loadOnsets(range,nTrials){
	for (var jj=0;jj<nTrials;jj++){ // looping number of total presentations
			onset[jj] = sampleUniform(range,[0,0],1); 
	}
}

// ================================
// ******* 	Duration  ******* 
// ================================
function loadDurations(range,nTrials){
	for (var jj=0;jj<nTrials;jj++){ // looping number of total presentations
			duration[jj] = sampleUniform(range,[0,0],1); 
	}
}

// ============================
// ******* 	ISI  ******* 
// ============================
function loadISIs(range,nTrials){
	for (var jj=0;jj<nTrials;jj++){ // looping number of total presentations
			ISI[jj] = sampleUniform(range,[0,0],1); 
	}
}


