$(document).ready(function() {
  $.getJSON('userstats.php',function(data) {
    if (data[0]==0) {
      $('#likes').text('Get swiping!');
    } else {
      $('#likes').text(data[0] + " swipes");
    }
    if (data[1] == 0) {
      $('#yespercent').text('');
    } else {
      $('#yespercent').text(Math.floor(data[1]/data[0]*100) + "%");
    }
    
  });
});