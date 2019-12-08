var my_id;
var me;

$(window).on('load', function() {

  get_me().then(function(data) {
    my_id = data[0].userid;
    me = data[0].username;
  });

  load_bid().then(function (data){
    if (data) {
      const len = data.length;
      var item_price = document.getElementById("ItemBidPrice");
      item_price.innerHTML = '$ ' + data[len-1].Price;
      console.log(data[len-1].Price);

    }
  });

});

function get_price_input() {
  var modal_bid_price = document.getElementById("modal_bid_price");
  var bid_price_input = document.getElementById("BidPriceInput");
  modal_bid_price.innerHTML = '$ ' + bid_price_input.value;
  console.log(bid_price_input.value);
}

function load_bid() {
  return new Promise(function(resolve) {
    $.ajax({
      type: "POST",
      url: "bid.php",
      dataType: "JSON",
      data: {
        flag: 0,
        itemID: window.location.href.split('=')[1]
      },
      complete: function (data) {
        resolve(data);
      }
    });
  });

}

function place_bid() {
  var bid_price_input = document.getElementById("BidPriceInput");
  var item_bid_price = document.getElementById("ItemBidPrice");
  if (bid_price_input.value <= parseInt(item_bid_price.innerHTML.split(" ")[1])) {
    alert("Your bid price is lower than the current price! Please increase your bid price.");
    bid_price_input.value = "";
    return;
  }
  console.log(my_id);
  console.log(bid_price_input.value);
  $.ajax({
    type: "POST",
    url: "bid.php",
    dataType: "JSON",
    data: {
      flag: 1,
      itemID: parseInt(window.location.href.split('=')[1]),
      userID: my_id,
      price: bid_price_input.value
    },
    success: function (data) {
      //alert("Done post!");
      item_bid_price.innerHTML = '$ ' + bid_price_input.value;
      bid_price_input.value = "";
    },
    error: function (e) {
      console.log(e[0].itemid + e[0].userid + e[0].price);
    }
  });
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
