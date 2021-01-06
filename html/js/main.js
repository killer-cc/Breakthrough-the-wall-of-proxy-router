function loadProxyData(){
	$.post("api.php?action=getDatas",{},function(data){
		var jsondata = JSON.parse(data);
		window.proxyData = jsondata;
	});
}

function updateList(){
	if (window.proxyData == undefined){
		loadProxyData();
		setTimeout(updateList,200);
	}else if (proxyData.domain != null || proxyData.ip != null){
		$("table tbody").html("<tr><th>TYPE</th><th>IP / DOMAIN</th></tr>");
		if (proxyData.domain != null){
			for (var i = 0; i < proxyData.domain.length; i++){
				$("table tbody").html($("table tbody").html()+"<tr><td>Domain</td><td>"+proxyData.domain[i].domain+"</td></tr>");
			}
		}
		
		if (proxyData.ip != null){
			for (var i = 0; i < proxyData.ip.length; i++){
				$("table tbody").html($("table tbody").html()+"<tr><td>IP</td><td>"+proxyData.ip[i].ip+"</td></tr>");
			}
		}
	}else{
		$("table tbody").html($("table tbody").html()+"<tr><td colspan=\"2\">沒有資料</td></tr>");
	}
}

function submitServer(form){
	$(form).ajaxSubmit(function(data){
		var jsondata = JSON.parse(data);
		if (jsondata.status == "done"){
			window.location = "index.html";
		}else{
			$("#error").text("已存在");
			$("#error").show();
		}
	});
	return false;
}
