$(document).ready(function() {

  load_data(2);

  var t = document.getElementById('MessageText');
  var b = document.getElementById('MessageSend');

  t.addEventListener("keyup", function(e) {
    if (e.keyCode == 13 && !e.shiftKey) {
      var msg = $(this).val();

      $.ajax({
        type: "POST",
        //dataType: "json",
        url: "chat_handler.php",
        data: {
          key: 13,
          message: msg
        },
        success: function (data) {
          $("#messages").empty();
          $("#messages").append(data);
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
      //dataType: "json",
      url: "chat_handler.php",
      data: {
        key: 13,
        message: msg
      },
      success: function (data) {
        $("#messages").empty();
        $("#messages").append(data);
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

function load_data(f) {
  $.ajax({
    type: "POST",
    url: "chat_handler.php",
    data: {
      flag: f
    },
    success: function (data) {
      $("#messages").append(data);
      scroll_bottom();
    }
  });
}
