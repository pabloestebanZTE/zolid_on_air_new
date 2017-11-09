$("#valid").click(function() {
  var username = document.getElementById("username").value;
  var pass = document.getElementById("password").value;
  var project = document.getElementById("projectList").value;
  if(username != "" && pass != "" && project != ""){
    $(".admin").addClass("up").delay(100).fadeOut(100);
    $(".cms").addClass("down").delay(150).fadeOut(100);
  }
});
