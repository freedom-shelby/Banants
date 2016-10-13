$(document).ready(function () {
             $( "div[id$='diagram']" ).each(function() {
            var $team1 = $(this).attr("data-home-team-score");
            var $team2 = $(this).attr("data-away-team-score");
            var $class1 ='p' + $team1.toString();
            var $class2 ='p' + $team2.toString();
            if ($team1 > $team2){
               var $type1 = $([
  
  "  <div id='1-circle' class='c100",  $class1 , " grean'>",
  "  <div class='slice'>",
  "    <div class='bar'></div>",
  "    <div class='fill'></div>",
  "  </div>",
  "  </div>",
  "  <div id='1-1-circle' class='over c100", $class2 , "'>",
  "  <span>", $team1 ,"<span class='pr'>%</span></span>",
  "  <span class='arr'></span>",
  "  <div class='slice'>",
  "    <div class='bar'></div>",
  "    <div class='fill'></div>",
  "  </div>",
  "</div>"
].join("\n"));
            } else {
              var $type1 = $([
  "  <div id='1-circle' class='over c100",  $class1 , " red-arr blue'>",
  "  <span>", $team1 ,"<span class='pr'>%</span></span>",
  "  <span class='arr arr2'></span>",
  "  <div class='slice'>",
  "    <div class='bar'></div>",
  "    <div class='fill'></div>",
  "  </div>",
  "  </div>",
  "  <div id='1-1-circle' class='c100", $class2 , " red-arr'>",
  "  <div class='slice'>",
  "    <div class='bar'></div>",
  "    <div class='fill'></div>",
  "  </div>",
  "</div>"
].join("\n"));
            }
             
    $(this).append($type1);
            });
	var rotationMultiplier = 3.6;
	// For each div that its id ends with "circle", do the following.
	$( "div[id$='circle']" ).each(function() {
		// Save all of its classes in an array.
		var classList = $( this ).attr('class').split(/\s+/);
		// Iterate over the array
		for (var i = 0; i < classList.length; i++) {
		   /* If there's about a percentage class, take the actual percentage and apply the
				css transformations in all occurences of the specified percentage class,
				even for the divs without an id ending with "circle" */
		   if (classList[i].match("^p")) {
			var rotationPercentage = classList[i].substring(1, classList[i].length);
			var rotationDegrees = rotationMultiplier*rotationPercentage;
			$('.c100.p'+rotationPercentage+ ' .bar').css({
			  '-webkit-transform' : 'rotate(' + rotationDegrees + 'deg)',
			  '-moz-transform'    : 'rotate(' + rotationDegrees + 'deg)',
			  '-ms-transform'     : 'rotate(' + rotationDegrees + 'deg)',
			  '-o-transform'      : 'rotate(' + rotationDegrees + 'deg)',
			  'transform'         : 'rotate(' + rotationDegrees + 'deg)'
			});
                        
		   }

		}
	});
       
});