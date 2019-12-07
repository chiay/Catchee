var input_from_box;
var global_data;
var main_data;
var temp = 10;
var len = 0;
var category = "";

function search_submit() {
    $("#result").empty();
    input_from_box = document.getElementById('SearchBox').value;
    //console.log(input_from_box);
    category = '';
    $.ajax({
        type: "POST",
        url: "search_item.php",
        dataType: "JSON",
        data: {
            search_phrase: input_from_box
        },
        success: function(data) {
            global_data = data;
            main_data = data;
            len = data.length;
            //console.log(len);
            display_page(temp, 1, category);
        },
        error: function(){
            alert('Unable to get data');
        }

    });
}

function display_page(display, n, cat) {
    $("#result").empty();
    category = cat;
    item_list = [];
    temp = display;
    for (var i = 0; i < len; i++){
        if(category == "" || category == "All Categories"){
            category = "";
            item_list = main_data;
            break;
        }else{
            if(main_data[i].tag == category){
                item_list.push(main_data[i]);
            }
        }
    }
    global_data = item_list;


    side_bar()
    var low_bound = display*(n-1);
    var upp_bound;
    if (display*n > global_data.length){
        upp_bound = global_data.length;
    }else{
        upp_bound = display*n;
    }

    //console.log(low_bound)
    //console.log(upp_bound)

    //console.log("length");
    //console.log(global_data.length);

    if (global_data.length > 0){

    for (var i = low_bound; i < upp_bound; i++) {
        //console.log(global_data[i])
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
    //console.log(global_data.length)
    var max_page = Math.ceil(global_data.length/display);

    var str2 = '<br>';
    str2 += '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">';
    str2 += '<div class="btn-group" role="group">';

    for(var i = 0; i < max_page; i++){
        count += 1;
        str2 += '<button type="button" class="btn btn-secondary" id = "pagination_button" onclick="display_page('+temp+','+count+',\''+category+'\')" style="width: 300%;">'+ count.toString() +'</button>';
    }
    //str2 += '<button type="button" class="btn btn-secondary" style="width: 200%;">Next</button>';
    str2 += '</div>';
    str2 += '</div>';
    $("#result").append(str2);
    }
}

function side_bar() {
    $("#filter").empty();
    var str3 = '<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">'
    str3 += '<div class="nav-side-menu">'
    str3 += '<div class="filter">Filter</div>'
    str3 += '<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>'
    str3 += '<div class="menu-list">'
    str3 += '<ul id="menu-content" class="menu-content collapse out">'
//    str3 += '<li><a href="#"><i class="fa fa-dashboard fa-lg"></i> Dashboard </a></li>'
    str3 += '<li  data-toggle="collapse" data-target="#products" class="collapsed active">'
    str3 += '<a><i class="fa fa-bars fa-lg"></i>Categories</a>'
    str3 += '</li>'
    str3 += '<ul class="sub-menu" id="categories">'
    cat_list = ["All Categories", "Books", "Clothes/Shoes", "Electronic", "Furniture", "Toy", "Transportation", "Others"]
    cat_list_len = cat_list.length
    for(var j = 0; j < cat_list_len; j++){
        str3 += '<li><a onclick="display_page(5, 1, \''+cat_list[j]+'\')">'+cat_list[j]+'</a></li>'
    }
    str3 += '</ul>'
    str3 += '<li data-toggle="collapse" data-target="#service" class="collapsed active">'
    str3 += '<a><i class="fa fa-th fa-lg"></i> Item per Page </a>'
    str3 += '</li>'
    str3 += '<ul class="sub-menu" id="ItemPerPage">'
    str3 += '<li><a onclick="display_page(5, 1, category)">   5   </a></li>'
    str3 += '<li><a onclick="display_page(10, 1, category)">   10   </a></li>'
    str3 += '<li><a onclick="display_page(25, 1, category)">   25   </a></li>'
    str3 += '<li><a onclick="display_page(50, 1, category)">   50   </a></li>'
    str3 += '</ul>'
    str3 += '</div>'
    str3 += '</div>'

    $("#filter").append(str3);
}