$(document).ready(function() {
  var t = document.getElementById('MessageText');
  var b = document.getElementById('MessageSend');

  t.addEventListener("keyup", function(e) {
    if (e.keyCode == 13 && !e.shiftKey) {
      var msg = $(this).val();

      $("#message").empty();

      $.ajax({
        type: "POST",
        //dataType: "json",
        url: "chat_handler.php",
        data: {
          key: 13,
          message: msg
        },
        success: function (data) {
          $("#messages").append(data);
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
      success: function (html) {
        //alert("Inserted message to database!");
      }
    });

    t.focus();
    t.value = "";
  });
});
