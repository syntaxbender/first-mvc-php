var lockes = {};
function addList(){
	if (lockes["addList"] === true) return;
	lockes["addList"] = true;
    $.ajax({ type: "POST", url: ROOT_DIR+"/lists/create", data: {'title': $("#title").val(), 'content': $("#content").val() }, dataType: "json", contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    	success: function(data){
    		if (data[0] === true){
				$( "#mess" ).slideUp(250, function(){
					$("#mess").html("<div class=\"mess-success\">"+data[1]+"</div>");
					$("#mess").slideDown(250);
				});
				getList();
				$('#newnote').fadeOut(200);
				$('#title').val('');
				$('#content').val('');
    		}else{
				$( "#mess" ).slideUp(250, function() {
					$("#mess").html("<div class=\"mess-error\">"+data[1]+"</div>");
					$("#mess").slideDown(250);
				});
    		}
    		lockes["addList"] = false;
	    },
	    error: function(errMsg) {
			$( "#mess" ).slideUp(250, function() {
				$("#mess").html("<div class=\"mess-success\">An error has occurred. Please try again later!</div>");
				$("#mess").slideDown(250);
			});
			lockes["addList"] = false;
	    }
	});
}

function readList(id){
	if (lockes["readList"] === true) return;
	lockes["readList"] = true;
	$('div#readnote').fadeIn(200);
	$.ajax({ type: "POST", url: ROOT_DIR+"/lists/read", data: {'id': id}, dataType: "json", contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		success: function(data){
			if (data[0] === true){
				 $('div#readnote h3').html(data[1]["title"]);
				 $('div#readnote textarea').html(data[1]["content"]);
			}else{
				$( "#mess" ).slideUp(250, function(){
					$("#mess").html("<div class=\"mess-error\">"+data[1]+"</div>");
					$("#mess").slideDown(250);
				});
			}
			lockes["readList"] = false;
		},
		error: function(errMsg){
			$( "#mess" ).slideUp(250, function(){
				$("#mess").html("<div class=\"mess-error\">An error has occurred. Please try again later!</div>");
				$("#mess").slideDown(250);
			});
			lockes["readList"] = false;
		}
	});
}

function getList(){
    $.ajax({ type: "GET", url: ROOT_DIR+"/lists/get", dataType: "json", 
    	success: function(data){
    		temp = "";
    		if(data.length>0){
				for (var i = 0; i < data.length; i++) {
					temp += "<div><div onclick=\"readList('"+data[i]["id"]+"');\">"+data[i]["title"]+"</div><div><i onclick=\"$('#newnote').fadeIn(200);\" class=\"fa fa-plus\" aria-hidden=\"true\"></i><i onclick=\"deleteList('"+data[i]["id"]+"'); return;\" class=\"fa fa-trash\" aria-hidden=\"true\"></i></div></div>";
				}
				$("#notes").html(temp);
				$('#notes').slimscroll({
				  alwaysVisible: true,
				  height: 'calc(100% - 20px)',
				  wheelStep: 5,
				  color: '#4aa8d3'
				});
			}else{
				$("#notes").html("<div style=\"padding: 10px;text-align: center;color: #696969;background: #80808061;    border: none;cursor:pointer;\" onclick=\"$('#newnote').fadeIn(200);\">Hiçbir notunuz bulunmuyor. Yeni eklemek için tıklayınız.</div>");
			}
	    },
	    error: function(errMsg) {
	    	alert("An error has occurred. Please try again later!");
	    }
	});
}
function deleteList(id){
	if (lockes["deleteList"] != null && lockes["deleteList"][id] === true) return;
	var check = confirm("Do you want to delete this note?");
	if (check === true) {
		if(lockes["deleteList"] == null) lockes["deleteList"] = {};
		lockes["deleteList"][id] = true;
		$.ajax({ type: "POST", url: ROOT_DIR+"/lists/delete", data: {'id': id}, dataType: "json", contentType: "application/x-www-form-urlencoded; charset=UTF-8",
	    	success: function(data){
	    		if (data[0] === true){

					$( "#mess" ).slideUp(250, function(){
						$("#mess").html("<div class=\"mess-success\">"+data[1]+"</div>");
						$("#mess").slideDown(250);
						getList();
					});
	    		}else{
					$( "#mess" ).slideUp(250, function(){
						$("#mess").html("<div class=\"mess-error\">"+data[1]+"</div>");
						$("#mess").slideDown(250);
					});
	    		}
	    		lockes["deleteList"][id] = false;
		    },
		    error: function(errMsg){
				$( "#mess" ).slideUp(250, function(){
					$("#mess").html("<div class=\"mess-error\">An error has occurred. Please try again later!</div>");
					$("#mess").slideDown(250);
					lockes["deleteList"][id] = false;
				});

		    }
		});
	}
}
function login(){
	if (lockes["login"] === true) return;
	lockes["login"] = true;
    $.ajax({ type: "POST", url: ROOT_DIR+"/login", data: {'username': $("#username").val(), 'password': $("#password").val() }, dataType: "json", contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    	success: function(data){
    		if (data[0] === true){
				$( "#mess" ).slideUp(250, function() {
					$("#mess").html("<div class=\"mess-success\">"+data[1]+"</div>");
					$("#mess").slideDown(250);
				});
				setTimeout(function(){ 
					window.location.replace(ROOT_DIR+"/lists");
				}, 1000);
    		}else{

				$( "#mess" ).slideUp(250, function() {
					$("#mess").html("<div class=\"mess-error\">"+data[1]+"</div>");
					$("#mess").slideDown(250);
				});
    		}
    		lockes["login"] = false;
	    },
	    error: function(errMsg) {

			$( "#mess" ).slideUp(250, function() {
				$("#mess").html("<div class=\"mess-error\">An error has occurred. Please try again later!</div>");
				$("#mess").slideDown(250);
			});
			lockes["login"] = false;
	    }
	});
} 
function register(){
	if (lockes["register"] === true) return;
	lockes["register"] = true;
    $.ajax({ type: "POST", url: ROOT_DIR+"/register", data: {'username': $("#username").val(), 'password': $("#password").val(), 'repassword': $("#repassword").val() }, dataType: "json", contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    	success: function(data){
    		if (data[0] === true){
					$( "#mess" ).slideUp(250, function() {
					$("#mess").html("<div class=\"mess-success\">"+data[1]+"</div>");	
					$("#mess").slideDown(250);
					setTimeout(function(){ 
						window.location.replace(ROOT_DIR+"/login");
					}, 1000);
				});
    		}else{
    			var callb = "";
    			for (var i = 0; i <= data[1].length-1; i++) {
    				callb += "<div class=\"mess-error\">"+data[1][i]+"</div>";
    				if (data[1].length-1 == i) {
    					$( "#mess" ).slideUp(250, function() {
							$("#mess").html(callb);
							$("#mess").slideDown(250);
						});
    				}
    			}
    		}
    		lockes["register"] = false;
	    },
	    error: function(errMsg) {
			$( "#mess" ).slideUp(250, function() {
				$("#mess").html("<div class=\"mess-error\">An error has occurred. Please try again later!</div>");
				$("#mess").slideDown(250);
			});
			lockes["register"] = false;
	    }
	});
} 
mess_toggle = true;
setInterval(function(){

	if($('#mess').css('display') == 'block' && mess_toggle === false){
		mess_toggle = true;
	}else if(mess_toggle == true){
		$("#mess").slideUp(250);
		mess_toggle = false;
	}
}, 8000);