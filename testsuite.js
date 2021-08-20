// prepare base perf object
if (typeof window.performance === 'undefined') {
  window.performance = {};
}

if (!window.performance.now) {
  var nowOffset = Date.now();

  if (performance.timing && performance.timing.navigationStart) {
    nowOffset = performance.timing.navigationStart;
  }

  window.performance.now = function now() {
    return Date.now() - nowOffset;
  };
}

var processed = {};
var options = { debug: true, width: 400, height: 250 };
$.getJSON('images/images.json', function(images) {
  

  var totalTime = 0;
  var totalmpix = 0;
  var totalCrops = 0;

  $('#analyzer img').each(function() {
    $(this).on('load', function() {
      window.setTimeout(
        function() {
          var img = this;
          if (processed[img.src]) return;
          processed[img.src] = true;
          var t = performance.now();
          smartcrop.crop(img, options, function(result) {
            totalTime += (performance.now() - t) / 1e3;
            totalmpix += img.naturalWidth * img.naturalHeight / 1e6;
            totalCrops++;
			console.log(img.alt)
            $('#perf').text(
              'processed ' +
                totalCrops +
                ' imagessss, ' +
                Math.round(totalTime * 1000 / totalCrops) +
                ' ms/image, ' +
                Math.round(100 * totalmpix / totalTime) / 100 +
                ' mega pixel/s'
            );
            // console.log(img.src, result);
            var crop = result.topCrop;
            var canvas = $('<canvas>')[0];
            var ctx = canvas.getContext('2d');
            canvas.width = options.width;
            canvas.height = options.height;

            ctx.drawImage(
              img,
              crop.x,
              crop.y,
              crop.width,
              crop.height,
              0,
              0,
              canvas.width,
              canvas.height
            );
			
			console.log(canvas)

			var imagelink=img.alt; 
			var analyzer_string = '';
			var completeAnalyzerString=analyzer_string.concat('.aianalysis',imagelink);
			
			var output_string = '';
			var completeOutputString=output_string.concat('.output',imagelink);
			
			
			
            $(completeAnalyzerString)
				.append(debugDraw(result, true));
              
             
			  
			$(completeOutputString)
				.append(canvas)
            //  .parent()
            //  .append($('<pre>').text(JSON.stringify(crop.score)));
			
			
			
			var dataURL = canvas.toDataURL();
			//console.log(dataURL);
			var imageNamer=img.alt;
			console.log(imageNamer);
			
			
			
			
			$.ajax({
      type: "POST",
      url: "creator.php",
      data: { 
         imgBase64: dataURL,
		 imageName: imageNamer
      }
    }).done(function(o) {
      console.log('saved'); 
      // If you want the file to be visible in the browser 
      // - please modify the callback in javascript. All you
      // need is to return the url to the file, you just saved 
      // and than put the image in your browser.
    });
			
          });
        }.bind(this),
        100
      );
    });
    if (this.complete) {
      $(this).trigger('load');
    }
  });
});
