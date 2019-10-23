/*function tag_list() {
  var t = document.getElementbyId("ItemTag");
  var tags = ["Electronic", "Fashion", "Home & Garden", "Toy"];

  for (var i = 0; i < tags.length; i++) {
    var opt = document.createElement("option");
    opt.text = tags[i];
    opt.value = tags[i];
    t.add(opt);
  }
}*/

function isPrice(d) {
    var regExpression = /^(\d{1,3})?(,?\d{3})*(\.\d{2})?$/;
    if (!(d.value.match(regExpression))) {
      alert("Incorrect price format.");
      d.value = "";
      d.focus();
      return false;
    } else {
      return true;
    }
}

function Location_Selection() {

  var addr = '<div class="form-group">';
  addr += ' <label for="ItemAddressInput">Address Line 1:</label><br/>';
  addr += ' <input type="text" class="form-control" name="ItemAddress1"/>';
  addr += ' <label for="ItemAddressInput">Address Line 2:</label><br/>';
  addr += ' <input type="text" class="form-control" name="ItemAddress2"/>';
  addr += ' <label for="ItemAddressInput">City:</label><br/>';
  addr += ' <input type="text" class="form-control" name="ItemCity"/>';
  addr += ' <label for="ItemAddressInput">State:</label><br/>';
  addr += ' <input type="text" class="form-control" name="ItemState"/>';
  addr += ' <label for="ItemAddressInput">Country:</label><br/>';
  addr += ' <input type="text" class="form-control" name="ItemCountry"/>';
  addr += ' </div>';

  var gps = '<div class="form-group">';
  gps += ' <label for="ItemGPSLat">Latitude:</label><br/>';
  gps += ' <input type="text" class="form-control" name="ItemLatitude"/>';
  gps += ' <label for="ItemGPSLong">Longtitude:</label><br/>';
  gps += ' <input type="text" class="form-control" name="ItemLongtitude"/>';
  gps += ' </div>';

  $("input:radio[name='LocationRadio']").change(
    function() {
        $("#location").empty();
        if (this.checked && this.value == 'Address') {
          $("#location").append(addr);
        } else if (this.checked && this.value == 'GPS'){
          $("#location").append(gps);
        }
    });
}
