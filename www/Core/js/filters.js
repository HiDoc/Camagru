document.getElementById("grayscale").addEventListener("click", function() {
  var pixels = getPixels();
  var d = pixels.data;
  for (var i = 0; i < d.length; i += 4) {
   var r = d[i];
   var g = d[i+1];
   var b = d[i+2];
   var v = 0.2126 * r + 0.7152 * g + 0.0722 * b;
   d[i] = d[i+1] = d[i+2] = v;
 }
 ctx.putImageData(pixels, 0, 0);
});

document.getElementById("brightness").addEventListener("click", function() {
  var pixels = getPixels();
  var d = pixels.data;
  for (var i=0; i<d.length; i+=4) {
    d[i] += 40;
    d[i+1] += 40;
    d[i+2] += 40;
  }
 ctx.putImageData(pixels, 0, 0);
});