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

document.getElementById('modify').addEventListener('click', () => {
	request({
		url: "/ajax/profile_edit",
		method: "GET",
	})
	.then(success => {
		document.getElementById("edit").innerHTML = success;
		setScript();
	})
	.catch(err => { console.dir(err) })
})
function setScript() {
	document.getElementById("modifyProfile").addEventListener('click', () => {
    let bio = document.getElementById("inputBio").value
    let location = document.getElementById("inputLocation").value
    let name = document.getElementById("inputName").value
    request({
      url: "/ajax/modify",
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, 
      method: "POST",
      body: 'bio=' + bio + '&name=' + name + '&location=' + location + '&submit=true'
    })
    .then(data => { document.getElementById("edit").innerHTML = data; })
	})
}