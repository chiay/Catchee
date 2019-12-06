var input_from_box;
var global_data;
var temp = 5;
var len = 0;

function search_submit() {
    $("#result").empty();
    input_from_box = document.getElementById('SearchBox').value;
    console.log(input_from_box);
    $.ajax({
        type: "POST",
        url: "search_item.php",
        dataType: "JSON",
        data: {
            search_phrase: input_from_box
        },
        success: function(data) {
            global_data = data;
            len = data.length;
            console.log(len);
            display_page(temp, 1);
            },
        error: function(){
            alert('Unable to get data');
        }

    });
}

function display_page(display, n) {
    $("#result").empty();
    var low_bound = display*(n-1);
    var upp_bound;
    if (display*n > len){
        upp_bound = len
    }else{
        upp_bound = display*n
    }

    console.log(low_bound)
    console.log(upp_bound)


    for (var i = low_bound; i < upp_bound; i++) {
        var name = global_data[i].name;
        var description = global_data[i].description;
        var tag = global_data[i].tag;
        var price = global_data[i].price;
        var image = global_data[i].image;

        var str = '<div class="row">';
        str += '<div class="col-xl-4">';
        str += '<img src="data:image/jpeg;base64,' + image + '" style=" max-width: 85%;">';

//                str += '<img src="data:image/jpeg;base64,' + image + '" class="card-img-top" alt="" width="100px" height="130px">';
        str += '</div>';

        str += '<div class="col-xl-8">';
        str += '<p><b>Product Name       : </b>' + name + '</p>';
        str += '<p><b>Product Description: </b>' + description + '</p>';
        str += '<p><b>Product Category   : </b>' + tag + '</p>';
        str += '<p><b>Price              : </b>' + '$' + price + '</p> ';
        str += '</div>';

        str += '</div>';

        $("#result").append(str);
    }
    var count = 0;
    var max_page = Math.ceil(len/5);
    var str2 = '<br>';
    str2 += '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">';
    str2 += '<div class="btn-group" role="group">';

    for(var i = 0; i < max_page; i++){
        count += 1;
        str2 += '<button type="button" class="btn btn-secondary" onclick="display_page('+display+','+count+')" style="width: 300%;">'+ count.toString() +'</button>';
    }
    //str2 += '<button type="button" class="btn btn-secondary" style="width: 200%;">Next</button>';
    str2 += '</div>';
    str2 += '</div>';
    $("#result").append(str2);
}
