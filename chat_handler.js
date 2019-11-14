$(document).ready(function() {

  load_recipients();
  load_data();

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
      flag: 0
    },
    success: function (data) {
      var len = data.length;

      for (var i = 0; i < len; ++i) {
        var chatroomid = data[i].chatroomid;
        var usrn1 = data[i].username1;
        var usrn2 = data[i].username2;
        var msg_context = data[i].msg;
        var dt = data[i].postTime;

        var str = '<div class="row my-3">';
        str += '<div class="col-6"></div>';
        str += '<div class="col-6">';
        str += '<div class="float-right rounded-pill bg-primary px-3 py-2 mx-3 text-white text-break">' + msg_context + '</div>';
        str += '</div></div>';

        $("#messages").append(str);
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
      flag: 2
    },
    success: function (data) {
      var len = data.length;

      for (var i = 0; i < len; ++i) {
        var chatroomid = data[i].chatroomid;
        var usrn1 = data[i].username1;
        var usrn2 = data[i].username2;

        var str = '<div class="row">';
        str += '<div class="col">';
        str += '<div class="rounded bg-light"><img class="ml-1 mr-3" src="logo_chat.svg" style="width:50px;height:50px;">' + usrn2 + '</div>';
        str += '</div>';

        $("#recipients").append(str);
      }
    }
  });
}
