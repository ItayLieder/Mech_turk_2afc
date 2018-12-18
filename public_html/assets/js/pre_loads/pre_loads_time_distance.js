// ######################## Start script only when JQuary finish loading ###########################


// =================================
// ******* Loading wavs ******* 
// =================================
var s1=[];  //containers for the wavs
var s2=[];
var preLoaded=0; // counter for parallel load
var fails=0;
//var ii;
var clearing = [];

var mode1 = [500,2000];
var numToLoad = mode1[1] - mode1[0] + 10;
// ===============================
// ******* Preloading ******* 
// ===============================
function preLoading() { 
		for (var ii=mode1[0];ii<mode1[1];ii++){ // looping number of total presentations
			//name1='//127.0.0.1/wav/'+ii+'_1.wav';
			name1='http://54.68.5.226/globalAssets/wav/'+ii+'_1.wav';

			s1[ii]= new Audio(name1);
			s1[ii].addEventListener('canplaythrough', isPreLoad); 
			s1[ii].addEventListener('error', failFunc(fails)); 
			s1[ii].removeEventListener('canplaythrough',function(){}); 	
	
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
			if (preLoaded==(mode1[1] - mode1[0])){
				for (var jj=1;jj<11;jj++){ // looping number of total presentations
					name2='http://54.68.5.226/globalAssets/Clearing_wavs/'+ jj +'.wav';
					clearing[jj]= new Audio(name2);
					clearing[jj].addEventListener('canplaythrough', isPreLoad); 
					clearing[jj].addEventListener('error', failFunc(fails)); 
					clearing[jj].removeEventListener('canplaythrough',function(){}); 	
				}		
			}	
	//console.log(preLoaded)
	//console.log(fails)
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




