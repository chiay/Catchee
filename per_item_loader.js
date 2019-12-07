//const itemID = window.location.href.split('/')[4];
var itemID = 0;

$(document).ready(function() {
  itemID = load_itemid_session();
  load_per_item();
});

function get_category(id) {
  switch (id){
    case 1:
      return "Books";
    case 2:
      return "Clothes/Shoes";
    case 3:
      return "Electronic";
    case 4:
      return "Furniture";
    case 5:
      return "Toy";
    case 6:
       return "Transportation";
    default:
      return "0";
  }
}

function load_per_item() {
  $.ajax({
    type: "POST",
    url: "per_item_loader.php",
    dataType: "JSON",
    data: {
      itemID: itemID
    },
    success: function (data) {
      if (data) {
        const len = data.length;
        const category = get_category(data[0].tag);
        var item_name = document.getElementById('ItemName');
        var item_price = document.getElementById('ItemBidPrice');
        var item_image = document.getElementById('ItemImage');
        var item_tag = document.getElementById('ItemTag');
        var item_post_time = document.getElementById('ItemPostTime');
        var item_user = document.getElementById('ItemUser');
        var item_description = document.getElementById('ItemDescription');

        item_name.innerHTML = data[0].itemname;
        item_price.innerHTML = '$ ' + data[0].price;
        item_image.src = "data:image/jpeg;base64, " + data[0].image_data;
        item_tag.innerHTML = category;
        item_post_time.innerHTML = data[0].posttime;
        item_user.innerHTML = data[0].username;
        item_description.innerHTML = data[0].description;
      }
    },
    error: function (data) {
      alert("Unable to load item data.");
    }
  });
}

function load_itemid_session() {
  /*if (sessionStorage.getItem("view_item")) {
    itemID = sessionStorage.getItem("view_item");
    console.log(itemID);
    //sessionStorage.removeItem("view_item");
  }*/
  const id = window.location.href.split('=')[1];
  return id;
}
