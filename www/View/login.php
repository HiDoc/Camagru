<div class="container container-login">
  <div class="row">

    <div class="col-md-6" id="success">

    </div>

   <div class="col-md-6" id="login">
      <?php $form = new Form([
        'username' => ['required' => 1],
        'password' => ['required' => 1, 'type' => 'password']],
        "login",
        "Sign in");
        echo $form->__toString();
     ?>
    </div>

  </div>
</div>
<script type="text/javascript" >
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
document.getElementById("submit").addEventListener("click", function() {
	let login = document.getElementById('inputUsername').value;
	let password = document.getElementById('inputPassword').value;
	request({
		url: "/ajax/signin",
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, 
		method: "POST",
		body: 'login=' + login + '&password=' + password + '&submit=true'
	})
	.then(success => {
		document.getElementById('success').innerHTML = '<div class="alert alert-success" role="alert"> '+ success + ' </div>'
		if (success === 'Authentification successful !')
			document.getElementById('login').innerHTML = ''
	})
})
 </script>