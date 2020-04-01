function getOptions() {
    var obj = document.getElementById("mySelect");
    var role_user = (users|json_encode()|raw );
    document.getElementById("demo").innerHTML = 
    "tu a choisi le role: " + obj.options[obj.selectedIndex].text + role_user[2].nom;
    location.reload(true);
    window.location.assign("http://localhost:8000/user/" + obj.options[obj.selectedIndex].text);
  }
  function searchName() {
    var name = document.getElementById("sb").text;
    alert(name);
    window.location.assign("http://localhost:8000/name/abdou2" );
  }