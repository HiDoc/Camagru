let request = obj => {
	return new Promise((resolve, reject) => {
			let xhr = new XMLHttpRequest();
			xhr.open(obj.method || "GET", obj.url);
			if (obj.headers) {
					Object.keys(obj.headers).forEach(key => {
							xhr.setRequestHeader(key, obj.headers[key]);
					});
			}
			xhr.onload = () => {
					if (xhr.status >= 200 && xhr.status < 300) {
							resolve(xhr.response);
					} else {
							reject(xhr.statusText);
					}
			};
			xhr.onerror = () => reject(xhr.statusText);
			xhr.send(obj.body);
	});
};

document.getElementById("snap").addEventListener("click", function() {
  let c = document.getElementById('overlay')
	let img = convertCanvasToImage(c)
	img.onload = function() {
		ctx.drawImage(video, 0, 0, 300, 300);
		ctx.drawImage(img, 0, 0, 300, 300)
	}
});

document.getElementById("save").addEventListener("click", function() {
	let canvas = document.getElementById('canvas');
	let description = document.getElementById('inputDescription');
	let title = document.getElementById('inputTitle');
	console.log(title, description)
	console.log('success');
	request({
		url: "/ajax/test",
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, 
		method: "POST",
		body: 'test=' + convertCanvasToImage(canvas).src +'&description=' + description.value.trim() + '&title=' + title.value.trim()
	})
	.then(success => { document.getElementById("demo").innerHTML = success; })
	.catch(err => {
		console.dir(err)
	})
})
