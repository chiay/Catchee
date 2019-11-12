var navSignup = document.getElementById("nav_signup");
var navLogin = document.getElementById("nav_login");
var navListHome = document.getElementById("nav_list_home");
var navListSell = document.getElementById("nav_list_sell");
var navListChat = document.getElementById("nav_list_chat");
var navListHelp = document.getElementById("nav_list_help");

$(document).ready(function() {
  check_user();
});

function check_user() {
  var tk = get_cookie();

  var str_sell = "<li class='nav-item mr-3' id='nav_list_sell'>";
  str_sell += "<a class='nav-link' href='test_sell.html'>";
  str_sell += "<i class='fas fa-cube mr-1'></i>";
  str_sell += "Sell</a></li>";

  var str_chat = "<li class='nav-item mr-3' id='nav_list_chat'>";
  str_chat += "<a class='nav-link' href='test_chat.html'>";
  str_chat += "<i class='fas fa-comments mr-1'></i>";
  str_chat += "Chat</a></li>";

  $.ajax({
    type: "POST",
    url: "cookie_handler.php",
    dataType: "JSON",
    data: {
      token: tk
    },
    success: function (data) {
      var len = data.length;

      if (len >= 1) {
        var usrid = data[0].userid;
        var usrname = data[0].username;

        navLogin.innerHTML = "<i class='fas fa-user mr-1'></i>" + usrname;
        navLogin.href = "#";
        navSignup.innerHTML = "<i class='fas fa-sign-out-alt mr-1'></i>Sign Out";
        navSignup.href = "logout.php";

        if (!navListSell && !navListChat){
          $("#nav_list_home").after(str_sell);
          $("#nav_list_sell").after(str_chat);
        }
      }
    }
  });
}

function get_cookie() {
  var name = "usr=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; ++i) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
