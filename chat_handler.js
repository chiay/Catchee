var current_num_of_msg = 0;
var me;
var you;
var my_id;
var count = 0;
var missing = 0;

$(document).ready(function() {

  get_me().then(function(data) {
    my_id = data[0].userid;
    me = data[0].username;
    load_recipients();
    //load_data();
  });

  setInterval(function() {
    //$("#messages").empty();
    load_data();
  }, 1000);

  var t = document.getElementById('MessageText');
  var b = document.getElementById('MessageSend');

  t.addEventListener("keyup", function(e) {
    if (e.keyCode == 13 && !e.shiftKey) {
      var msg = $(this).val();

      $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "chat_handler.php",
        data: {
          flag: 1,
          my_id: my_id,
          usr1: me,
          usr2: you,
          message: msg
        },
        success: function (data) {

          var len = data.length;

          if (count < len) {
            missing = len - count;
          }

          var chatroomid = data[len-1].chatroomid;
          var usrn1 = data[len-1].username1;
          var usrn2 = data[len-1].username2;
          var msg_context = data[len-1].msg;
          var dt = data[len-1].postTime;

          var str = '<div class="row my-3">';
          str += '<div class="col-6"></div>';
          str += '<div class="col-6">';
          str += '<div class="float-right rounded-pill bg-primary px-3 py-2 mx-3 text-white text-break">' + msg_context + '</div>';
          str += '</div></div>';

          $("#messages").append(str);
          count += 1;

          scroll_bottom();
        }
      });

      t.focus();
      t.value = "";

    }
  });

  b.addEventListener("click", function(e) {
    var msg = t.value;

    $.ajax({
      type: "POST",
      dataType: "JSON",
      url: "chat_handler.php",
      data: {
        flag: 1,
        my_id: my_id,
        usr1: me,
        usr2: you,
        message: msg
      },
      success: function (data) {
        var len = data.length;

        var chatroomid = data[len-1].chatroomid;
        var usrn1 = data[len-1].username1;
        var usrn2 = data[len-1].username2;
        var msg_context = data[len-1].msg;
        var dt = data[len-1].postTime;

        var str = '<div class="row my-3">';
        str += '<div class="col-6"></div>';
        str += '<div class="col-6">';
        str += '<div class="float-right rounded-pill bg-primary px-3 py-2 mx-3 text-white text-break">' + msg_context + '</div>';
        str += '</div></div>';

        $("#messages").append(str);

        scroll_bottom();
      }
    });

    t.focus();
    t.value = "";
  });
});

function scroll_bottom() {
  var s = document.getElementById("messages");
  s.scrollTop = s.scrollHeight;
}

function load_data() {
  $.ajax({
    type: "POST",
    url: "chat_handler.php",
    dataType: "JSON",
    data: {
      flag: 0,
      usr1: me,
      usr2: you
    },
    success: function (data) {
      if (data) {
        var len = data.length;

        for (var i = count; i < len; ++i) {
          var chatroomid = data[i].chatroomid;
          var usrn1 = data[i].username1;
          var usrn2 = data[i].username2;
          var owner = data[i].msgusr;
          var msg_context = data[i].msg;
          var dt = data[i].postTime;

          var str = "";

          if (owner == me) {
            str += '<div class="row my-3">';
            str += '<div class="col-6"></div>';
            str += '<div class="col-6">';
            str += '<div class="float-right rounded-pill bg-primary px-3 py-2 mx-3 text-white text-break">' + msg_context + '</div>';
            str += '</div></div>';
          } else {
            str += '<div class="row my-3">';
            str += '<div class="col-6">';
            str += '<div class="float-left rounded-pill bg-dark px-3 py-2 mx-3 text-light text-break">' + msg_context + '</div>';
            str += '</div>';
            str += '<div class="col-6"></div>';
            str += '</div>';
          }

          $("#messages").append(str);
        }
        count = len;
      }

      scroll_bottom();
    }
  });
}

function load_recipients() {
  $.ajax({
    type: "POST",
    url: "chat_handler.php",
    dataType: "JSON",
    data: {
      flag: 2,
      usr1: me
    },
    success: function(data) {
      if (data) {
        var len = data.length;
        you = data[0].username2;

        for (var i = 0; i < len; ++i) {
          var chatroomid = data[i].chatroomid;
          var usrn1 = data[i].username1;
          var usrn2 = data[i].username2;
          var str = "";
          var r;

          if (usrn1 == me) {
            r = usrn2;
          } else {
            r = usrn1;
          }

          str += '<button type="button" id="' + r + '" class="list-group-item list-group-item-action bg-light" onclick="get_recp(this.id)">';
          str += '<img src="logo_chat.svg" class="mr-3" style="width:35px;height:35px;">';
          str += '<span class="text-dark">' + r + '</span>';
          str += '</button>';

          $("#recipients").append(str);
        }
      }
    }
  });
}

function get_recp(id) {
  you = id;
  $("#messages").empty();
  load_data();
}

function get_me() {
  var tk = get_cookie();
  return new Promise(function(resolve) {
    $.ajax({
      type: "POST",
      url: "cookie_handler.php",
      dataType: "JSON",
      data: {
        token: tk
      },
      complete: function (data) {
        resolve(data);
      }
    });
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
