<div class="container container-explore">

  <h1>Trending</h1>
  <div id="result"></div>
  <?php hydratePictures();?>
</div>
<?php 
if (isset($_SESSION['user'])) :
?>
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
function setButtons() {
  const x = document.getElementsByClassName("push");
  for (i = 0; i < x.length; i++) {
    x[i].addEventListener('mousedown', (y) => {
      let current = y.srcElement
      if (y.srcElement.id === "")
        current = y.path[1];
      const box = document.getElementById(current.id)
      const id = (current.id.split('-')[1]);
      let path = (box.classList.contains('like')) ? 'like' : 'unlike';
      request({
        url: "/ajax/" + path + "_picture",
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, 
        method: "POST",
        body: 'id=' + id + '&submit=true'
      })
      .then(success => {
        console.log(success)
        if (success == "10")
          box.innerHTML = (parseInt(box.innerHTML) + (box.classList.contains('like')? 1 : -1))
          + ' <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>';
        box.classList.toggle("unlike")
        box.classList.toggle("like")
        console.dir(box)
      })
    })
  }
}
setButtons();
</script>
<?php
endif;
?>