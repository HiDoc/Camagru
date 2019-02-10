var mywidth = document.getElementById("container").offsetWidth - 30;
var constraints = { audio: false, video: { width: mywidth, height: 500 } };
var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
var video = document.querySelector('video');
document.getElementById('overlay').width = mywidth;

function addFilter(name) {
	var img = new Image(500, 500);
	img.onload = function() {
		let c = document.getElementById('overlay').getContext('2d');
		c.clearRect(0, 0, mywidth, 500);
		let x = 125
		let y = (name === 'wouf' || name === 'bald' || name === 'eye') ? 0 : 125;
    c.drawImage(img, x, y, 300, 300);
	}
	img.src = 'Storage/filters/' + name + '.png';
}

navigator.mediaDevices.getUserMedia(constraints)
	.then(function(mediaStream) {
		video.srcObject = mediaStream;
		video.onloadedmetadata = function(e) {
			video.play();
		};
	})
	.catch(function(err) { console.log(err.name + ": " + err.message); });


function getPixels() { return ctx.getImageData(0 , 0, canvas.width, canvas.height); };

function convertImageToCanvas(image) {
	let c = document.createElement("canvas");
	c.width = image.width;
	c.height = image.height;
	c.getContext("2d").drawImage(image, 0, 0);
	return c;
}

function convertCanvasToImage(canvas) {
	let img = new Image();
	img.src = canvas.toDataURL("image/png");
	return img;
}
