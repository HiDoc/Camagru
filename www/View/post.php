<div class="container">

  <h1 class="my-4">Post</h1>
  <div class="row" id="result">
    <?php hydratePictures();?>
    <div class="col-md-4" id="comments">
      <?php hydrateComments();?>
    </div>
<?php if ($count == 0) :?>
    <div class="col-md-5">
      <div class="input-group w-100">
        <h4 class="input-group-text mb-2">Add a comment</h4>
        <textarea class="form-control mb-2" rows="4" aria-label="With textarea" id="mycomment"></textarea>
        <button class="btn btn-success" id="comment" type="button">Add a comment</button>
      </div>
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
      document.getElementById('comment').addEventListener('click', function(event) {
        content = document.getElementById('mycomment').value.trim()
        request({
          url: "/ajax/comment",
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, 
          method: "POST",
          body: 'id=10&content=' + content +'&submit=true'
        })
        .then(success => {
          let div = document.createElement('div')
          div.classList.add("row")
          div.innerHTML = success
          document.getElementById('comments').appendChild(div)
        })
      })
    </script>
<?php endif;?>
  </div>
</div>