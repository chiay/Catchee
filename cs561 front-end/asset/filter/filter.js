
	//document.write(Date());

	/*if(document.getElementById("filter-update-button").clicked == true)
	{
	  document.write(Date());
	};*/


	var post  = document.getElementsByClassName("post");
	var postcontents  = document.getElementsByClassName("post-contents");
	var postimagecontainer  = document.getElementsByClassName("post-image-container");
	var postinfocontainer  = document.getElementsByClassName("post-info-container");
	var postprice  = document.getElementsByClassName("post-price");


	var posts = document.getElementById("posts");



	var nodelist1 = posts.childNodes[1];
	var nodelist2 = posts.childNodes[3];
	var nodelist3 = posts.childNodes[5];
	var nodelist4 = posts.childNodes[7];
	var nodelist5 = posts.childNodes[9];
	var nodelist6 = posts.childNodes[11];
	var nodelist7 = posts.childNodes[13];
	var nodelist8 = posts.childNodes[15];
	var nodelist = posts.childNodes[1];

	var dollar = [500,20,100,250,1,99,20000000,10000];





	/*
	if(document.getElementById("filter-city").selectedIndex = "1"){
	document.getElementById("filter-update-button").onclick = function() {ShowCorvallis()};
	};
	https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_option_index
	*/

	function myFunction() {
		var x = document.getElementById("filter-city").selectedIndex;
		var y = document.getElementById("filter-city").options;
		//alert("Index: " + y[x].index + " is " + y[x].text);
			
		while (posts.hasChildNodes()) {   
		posts.removeChild(posts.firstChild);
		}	
		
		//dataset
		var isNew = document.getElementById("filter-condition-new").checked;
		var isExcellent = document.getElementById("filter-condition-excellent").checked;
		var isGood = document.getElementById("filter-condition-good").checked;
		var isFair = document.getElementById("filter-condition-fair").checked;  
		var isPoor = document.getElementById("filter-condition-poor").checked;
		
		 var inputMax = document.getElementById("filter-max-price").value;
		 var inputMin = document.getElementById("filter-min-price").value;
		 var count = 0;
		 var temp = [0,0,0,0,0,0,0,0];
		 
		for (i = 0; i < 8; i++) {
		if( dollar[i]<=inputMax && dollar[i] >=inputMin){
		//count = count+1;
		temp[i]=666;	
		}
		}  
		
		if(y[x].index == 0&&isNew!=true&&isExcellent!=true&&isGood!=true&&isFair!=true&&isPoor!=true&&temp[0]==0
		&&temp[1]==0&&temp[2]==0&&temp[3]==0&&temp[4]==0&&temp[5]==0&&temp[6]==0&&temp[7]==0){ShowAny()};
		if(y[x].index == 1){ShowCorvallis()};
		if(y[x].index == 2){ShowAlbany()};
		if(y[x].index == 3){ShowEugene()};
		if(y[x].index == 4){ShowPortland()};
		if(y[x].index == 5){ShowSalem()};
		if(y[x].index == 6){ShowBend()};
		
					 
		  
		 
		  
		
		 //alert(isNew);
		  if(isNew == true&&y[x].index == 0){ShowNew()};      	
		  if(isExcellent == true&&y[x].index == 0){ShowExcellent()};	
		  if(isGood == true&&y[x].index == 0){ShowGood()};     
		  if(isFair == true&&y[x].index == 0){ShowFair()};      
		  if(isPoor == true&&y[x].index == 0){ShowPoor()};
		  
		 
		 
		
		if(temp[4]==666&&y[x].index == 0){posts.appendChild(nodelist5)};
		if(temp[1]==666&&y[x].index == 0){posts.appendChild(nodelist2)};
		if(temp[5]==666&&y[x].index == 0){posts.appendChild(nodelist6)};
		if(temp[2]==666&&y[x].index == 0){posts.appendChild(nodelist3)};
		if(temp[3]==666&&y[x].index == 0){posts.appendChild(nodelist4)};
		if(temp[0]==666&&y[x].index == 0){posts.appendChild(nodelist1)};
		if(temp[7]==666&&y[x].index == 0){posts.appendChild(nodelist8)};
		if(temp[6]==666&&y[x].index == 0){posts.appendChild(nodelist7)};
		
		
		
		//document.getElementById("filter-update-button").innerHTML = count;  
	}
	/*-----------------------------------------------------------------------------------------------------*/
	function myFunction2() {
	document.getElementById("modal-backdrop").style.display = "flex";
	document.getElementById("sell-something-modal").style.display = "flex";
	}
	/*-----------------------------------------------------------------------------------------------------*/

	function myFunction3() {
	document.getElementById("modal-backdrop").style.display = "none";
	document.getElementById("sell-something-modal").style.display = "none";
	document.getElementById("post-text-input").value = null;
	document.getElementById("post-photo-input").value = null;
	document.getElementById("post-price-input").value = null;
	document.getElementById("post-city-input").value = null;
	}

	/*------------------------------------------------------------------------------------------------------*/

	function myFunction4() {

	var description = document.getElementById("post-text-input").value;
	var picture = document.getElementById("post-photo-input").value;
	var money = document.getElementById("post-price-input").value;
	var city = document.getElementById("post-city-input").value;
	submitOK = "true";

	if(description==""){
			alert("Please enter description");
			submitOK = "false";
	}

	if(picture==""){
			alert("Please enter URL");
			submitOK = "false";
	}

		if (isNaN(money)||money==0 ) {
			alert("Please enter number");
			submitOK = "false";
		}
		if(city==""){
			alert("Please enter city");
			submitOK = "false";
	}
	if (submitOK == "false") {
			return false;
		}
	var oricity = document.getElementsByClassName("post-city")[0].innerHTML;
	var oriprice = document.getElementsByClassName("post-price")[0].innerHTML;
	var oritittle = document.getElementsByClassName("post-title")[0].innerHTML;
	var orisrc = document.getElementsByTagName("img")[1].getAttribute("src");
	document.getElementsByClassName("post-city")[0].innerHTML = city;
	document.getElementsByClassName("post-price")[0].innerHTML = money;
	document.getElementsByClassName("post-title")[0].innerHTML = description;
	document.getElementsByTagName("img")[1].setAttribute("src", picture); 

	var NewPost = nodelist.cloneNode(true);
	NewPost.dataset.price = money;
	NewPost.dataset.city = city;

	//var node = document.createTextNode(document.getElementsByClassName("post-price")[0].innerHTML);


	//NewPost.appendChild(node);
	posts.appendChild(NewPost);

	document.getElementsByClassName("post-city")[0].innerHTML = oricity;
	document.getElementsByClassName("post-price")[0].innerHTML = oriprice;
	document.getElementsByClassName("post-title")[0].innerHTML = oritittle;
	document.getElementsByTagName("img")[1].setAttribute("src", orisrc); 

		
		
	document.getElementById("modal-backdrop").style.display = "none";
	document.getElementById("sell-something-modal").style.display = "none";
	document.getElementById("post-text-input").value = null;
	document.getElementById("post-photo-input").value = null;
	document.getElementById("post-price-input").value = null;
	document.getElementById("post-city-input").value = null;
	}
	/*-----------------------------------------------------------main-------------------------------------------------------------------*/

	document.getElementById("filter-update-button").onclick = function() {myFunction()};
	document.getElementById("sell-something-button").onclick = function() {myFunction2()};
	document.getElementById("modal-cancel").onclick = function() {myFunction3()};
	document.getElementById("modal-close").onclick = function() {myFunction3()};
	document.getElementById("modal-accept").onclick = function() {myFunction4()};

	/*---------------------------------------------------------------------------------------------------------------------------------*/

	function ShowCorvallis(){    
		
		//posts.removeChild(posts.childNodes[0]);	
		
		
		posts.appendChild(nodelist2);
		posts.appendChild(nodelist8);
		
		//document.getElementById("filter-update-button").innerHTML = "YOU CLICKED ME!";	
	};

	function ShowAlbany(){    	
		
		while (posts.hasChildNodes()) {   
		posts.removeChild(posts.firstChild);
		}		
	};

	function ShowEugene(){    	
		
		while (posts.hasChildNodes()) {   
		posts.removeChild(posts.firstChild);
		}		
		posts.appendChild(nodelist1);
		posts.appendChild(nodelist7);
	};


	function ShowPortland(){    	
		
		while (posts.hasChildNodes()) {   
		posts.removeChild(posts.firstChild);
		}		
		posts.appendChild(nodelist3);
		posts.appendChild(nodelist6);
	};

	function ShowSalem(){    	
		
		while (posts.hasChildNodes()) {   
		posts.removeChild(posts.firstChild);
		}		
		posts.appendChild(nodelist4);	
	};



	function ShowBend(){    	
		
		while (posts.hasChildNodes()) {   
		posts.removeChild(posts.firstChild);
		}		
		posts.appendChild(nodelist5);	
	};

	function ShowAny(){    	
		
		while (posts.hasChildNodes()) {   
		posts.removeChild(posts.firstChild);
		}		
		posts.appendChild(nodelist1);
		posts.appendChild(nodelist2);
		posts.appendChild(nodelist3);
		posts.appendChild(nodelist4);
		posts.appendChild(nodelist5);
		posts.appendChild(nodelist6);
		posts.appendChild(nodelist7);
		posts.appendChild(nodelist8);
	};

	function ShowNew(){    	
			
		posts.appendChild(nodelist3);
		posts.appendChild(nodelist5);	
	};

	function ShowExcellent(){    	
			
			
		posts.appendChild(nodelist2);
		posts.appendChild(nodelist8);	
	};

	function ShowGood(){    	
		
		posts.appendChild(nodelist7);	
	};

	function ShowFair(){    	
		
			
		posts.appendChild(nodelist4);
		posts.appendChild(nodelist6);	
	};

	function ShowPoor(){    	
		
			
		posts.appendChild(nodelist1);	
	};
