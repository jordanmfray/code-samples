var join_button = document.getElementById("join_zoom"),
    meeting_info = document.getElementById("meeting_info");

function countDownTimer(seconds_till_unlock) {
    var countDown = parseInt(seconds_till_unlock), 
    	minutes,	    	
    	tick = setInterval(function () {
	        minutes = parseInt(countDown / 60, 10);

	        if ( countDown > 0 ) {
	            --countDown
	        } else {
	        	
  				join_button.classList.remove("lock_button");
	        	join_button.innerHTML = "Join Zoom Meeting";
	        	clearInterval(tick);
	        }
 
	       	if( countDown < 3600 && countDown >= 60 ) { // If the gathering starts in less than an hour
		    	join_button.classList.add('lock_button');
		    	join_button.innerHTML("Join in " + (minutes+1) + " minutes");
		    } else if( countDown <= 59 && countDown >= 1  ) { // If the gathering starts in less than one minute
		    	join_button.classList.add('lock_button');
		    	join_button.innerHTML("Join in " + countDown + " seconds");
		    } else if( countDown == 0 ) {
		    	join_button.classList.remove("lock_button");
		    	meeting_info.classList.remove('hidden');
	    		join_button.innerHTML = "Join Zoom Meeting";
		    }
	    }, 1000);
    
    if (countDown > 0 ) {
    	join_button.innerHTML("Zoom Meeting Locked");
	    join_button.classList.add('lock_button');
	    meeting_info.classList.add('hidden');
	    tick;
    } else {
	    join_button.classList.remove('lock_button');
	    join_button.innerHTML("Join Zoom Meeting");
	    $('#meeting_info').classList.remove('hidden');
	    clearInterval(tick);
	}
}

var seconds_till_unlock_attribute = parseInt( join_button.getAttribute('data-seconds_till_unlock') );

countDownTimer(seconds_till_unlock_attribute);