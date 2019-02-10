<div class="container">

  <h1 class="my-4">My posts</h1>
  <div class="row" id="result"></div>
  <?php hydratePictures();?>

</div>
<script>
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
const x = document.getElementsByClassName("remove");
for (i = 0; i < x.length; i++) {
  x[i].addEventListener('click', (y) => {
    const id = (y.srcElement.id.split('-')[1]);
    request({
      url: "/ajax/suppress_picture",
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, 
      method: "POST",
      body: 'id=' + id + '&submit=true'
    })
    .then(success => {
      document.getElementById('result').innerHTML = success
      document.getElementById('picture-' + id).remove();
    })
  })
}
</script>