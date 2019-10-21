(function() {
  "use strict";

  const commentbtn = document.getElementById("commentbtn");

  commentbtn.addEventListener("click", function() {
    ajaxsend();
  });

  function ajaxsend() {
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "http://192.168.33.10/view/index.php");
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
    xhr.send("comment=てすと");

    xhr.onreadystatechange = function() {

      console.log(xhr.readyState);
      if(xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
      }
    }
  }

})();
