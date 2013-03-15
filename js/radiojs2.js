
function loadBlankPage(){
	$.ajax({
	  url: "blank.php",
	  cache: false,
	  success: function(html){ }
	});
}

function loadBeritaDetail(id){
	$.ajax({
	  url: "detailberita2.php?idku="+id,
	  cache: false,
	  success: function(html){
		 $("#element_to_pop_up").html(html);
	   $('#element_to_pop_up').bPopup({
            modalColor: '#161616',
			position: [180, 310] 
        });
	  }
	});
}

function loadWelcome(id){
	scrollradio();
	//hideBox();
	loadvis();

	$.ajax({
	  url: "welcome2.php?idku="+id,
	  cache: false,
	  success: function(html){
		loadhid();
		$("#hal").html(html);
	  }
	});
}

function loadContact() {
	scrollradio();
	loadvis();

	$.ajax({
	  url: "contact.php",
	  cache: false,
	  success: function(html){
		loadhid();
		$("#hal").html(html);
	  }
	});
}

function loadJoin() {
	scrollradio();
	loadvis();

	$.ajax({
	  url: "join_us.php",
	  cache: false,
	  success: function(html){
		loadhid();
		$("#hal").html(html);
	  }
	});
}

function loadRadioDetail(id){
	$.ajax({
	  url: "detailradio.php?id="+id,
	  cache: false,
	  success: function(html){	
	  $("#element_to_pop_up").html(html);
	   $('#element_to_pop_up').bPopup({
            modalColor: '#161616',
			position: [180, 310] 
        });
	  }
	});
}
function loadpagehalaman(halaman){
	$.ajax({
	  url: halaman,
	  cache: false,
	  success: function(html){	
	  $("#element_to_pop_up").html(html);
	   $('#element_to_pop_up').bPopup({
			modalColor: '#161616',
			position: [180, 310] 
        });
	  }
	});
}
function radioinfo(id){
	$.ajax({
	  url: "radioinfo.php?id="+id,
	  cache: false,
	  success: function(html){	
	  $("#radio_img"+id).html(html);
	  }
	});
}
function delayed(id){
	$.ajax({
	  url: "normal.php?id="+id,
	  cache: false,
	  success: function(html){	
	  $("#radio_img"+id).hide();
	  $("#radio_img"+id).html(html);
	  	  $("#radio_img"+id).show();
	  }
	});
}

function backtonormal(id) {
    setTimeout(function() {
        delayed(id);
    }, 3000);
}
function loadTestimoni(page,kirim){
	scrollradio();
	loadvis();

	var temp="";
	if(page !='') {
		temp += temp + '?PageNo=' + page;
	}
	
	$.ajax({
	  url: "testimoni.php"+temp,
	  cache: false,
	  success: function(html){
		loadhid();
		$("#hal").html(html);
	  }
	});
}

function loadRadioList(id,kota) {
	
	$("#radiobox").hide("fast", function () {
        $.ajax({
		  url: "radiolist.php?id="+id,
		  cache: false,
		  success: function(html){
			$("#kt").text(kota);
			$("#radioboxall").html(html);
			$("#radioboxscroll").html(html);
			$("#radiobox").show("fast");
			
		  }
		});
    });
	
}

function loadBerita(page,kirim){
	var temp="";
	if(page !='') {
		temp += temp + '?PageNo=' + page;
	}
	
	$.ajax({
	  url: "index_berita.php"+temp,
	  cache: false,
	  success: function(html){
		$("#element_to_pop_up").html(html);
	   $('#element_to_pop_up').bPopup({
			modalColor: '#161616',
			position: [180, 310] 
        });
	  }
	});
}

function loadPage(jenis,page,kirim) {
	if(jenis == 'testimoni') {
		loadTestimoni(page,kirim);
	}else if(jenis == 'berita') {
		loadBerita(page,kirim);
	}
}

function loadHome(speed) {
	
	$("#hal").css("display","none");
	showBox(speed);
	
}

function stat(id) {
	
	$.ajax({
	  url: "stat.php",
	  type:'POST',
	  data:'id='+id,
	  success: function(html){
		
	  }
	});
	
}

function loadTerms(){
	scrollradio();
	loadvis();
	
	$.ajax({
	  url: "terms.php",
	  cache: false,
	  success: function(html){
		loadhid();
		$("#hal").html(html);
	  }
	});
}

var t = null;
/* function ajaxChatRefresh() {
	clearTimeout(t);
	var id = $("#ajaxChatForm>input[name=id]").val();
	$.ajax({
		url: "chat.php",
		type: "POST",
		data: "aksi=view&id="+id+"&lid="+$("#ajaxChatForm>input[name=lid]").attr("value"),
		error: function() {
			alert("Error. Please try again later.");
		},
		success: function(message) {
			var arrMessage = message.split("|");
			if (arrMessage[0]=="1") {
				$("#ajaxChatForm>input[name=dari]").attr("readonly",null);
				$("#ajaxChatForm>input[name=pesan]").attr("readonly",null);
				$("#ajaxChatForm>input[name=button]").attr("disabled",null);
				$("#chatMenu").show();
				t=setTimeout("ajaxChatRefresh()",60000);
			} else {
				$("#ajaxChatForm>input[name=dari]").attr("readonly","readonly");
				$("#ajaxChatForm>input[name=pesan]").attr("readonly","readonly");
				$("#ajaxChatForm>input[name=button]").attr("disabled","disabled");
				$("#chatMenu").hide();
			}
			$("#ajaxChatForm>input[name=lid]").attr("value",arrMessage[1]);
			if (arrMessage[1]!="0") {
				$("#chatMenu>#chatIsi").append(arrMessage[2]);
				$("#chatMenu>#chatIsi").scrollTop($("#chatMenu>#chatIsi")[0].scrollHeight);
			} else {
				$("#chatMenu>#chatIsi").html(arrMessage[2]);
			}
		}
	});
	return false;
} */

/* function loadChat(id){
	$.ajax({
		url: "chat.php",
		type: "GET",
		data: "cs=1&id="+id,
		success: function(message) {
			$("#chatDJ").text(message);
		}
	});	
	// $("#chatMenu").show();
	$("#ajaxChatForm>input[name=id]").attr("value",id);
	/*
	$("#chatMenu>#chatIsi").html("<b style='color:#FF0000;'>DJ</b> is offline.");
	if (chatNeedRefresh) { ajaxChatRefresh(); }
	chatNeedRefresh = false;
	*-/
	ajaxChatRefresh();
} */

function loadAdv(){
	scrollradio();
	loadvis();

	
	$.ajax({
	  url: "adv.php",
	  cache: false,
	  success: function(html){
		loadhid();
		$("#hal").html(html);
	  }
	});
}

function loadRequest(){
	$("#requestMenu").css("display","block");
	$("#requestMenu>.loading").css("display","block");
	$("#requestMenu>.isi").empty();
	$.ajax({
	  url: "request.php",
	  cache: false,
	  type: "POST",
	  data: "step=1",
	  success: function(html){
		$("#requestMenu>.loading").css("display","none");
		$("#requestMenu>.isi").html(html);
	  }
	});
	return false;
}

function loadvis() {
	$("#loading").css("display","block");
	$("#hal").css("display","none");
}

function loadhid() {
	$("#loading").css("display","none");
	$("#hal").css("display","block");
}

function scrollradio() {
	
	$("#radiobox").animate({ 
		height:'140px'
	}, 800 ,'',function(){
		$("#radioboxall").hide();
		$("#radioboxscroll").show();
	});
	
	
}

function hideBox() {
	$("#radiobox").hide("fast");
}

function showBox(speed) {
	$("#radiobox").show("fast");
	$("#radiobox").css("height","auto");
	$("#radioboxscroll").hide();
	$("#radioboxall").show("fast");
}

/*-------------------------- get Height width browser ----------------------------------------*/

function getWidth() {
	 var viewportwidth;
	 var viewportheight;
	 
	 // the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight
	 
	 if (typeof window.innerWidth != 'undefined')
	 {
	      viewportwidth = window.innerWidth,
	      viewportheight = window.innerHeight
	 }
	 
// IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document)

	 else if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0)
	 {
	       viewportwidth = document.documentElement.clientWidth,
	       viewportheight = document.documentElement.clientHeight
	 }
	 
	 // older versions of IE
	 
	 else
	 {
	       viewportwidth = document.getElementsByTagName('body')[0].clientWidth,
	       viewportheight = document.getElementsByTagName('body')[0].clientHeight
	 }
	//document.write('<p>Your viewport width is '+viewportwidth+'x'+viewportheight+'</p>');
	
	var panj = Math.ceil(viewportwidth / 2);
	var ting = Math.ceil(viewportheight / 2);
	
	return panj+"----"+ting;

}

function ajaxRankRefresh() {
				clearTimeout(t);
				$.ajax({
						type: "post",
						url: "top_rank.php",
						data: "toprank=1",
						dataType: "json",
						success: function(result) {
							if (result.sukses == "1") {
								$('#top_rank').html('');
								var a = 0;
								var ui= "<ol class=\"ranking\">"
								for(a=0;a < result.data.length; a++)
									{			
									ui +='<li>'+result.data[a].nama+'</li>';
									}		
									ui +='</ol>';
									$('#top_rank').append(ui);
									t=setTimeout("ajaxRankRefresh()",1200000);														
								
							} else if (result.sukses == "0") {
								alert(result.alasan);
							}
						},
						error: function(result) {
							alert("ada error");
						}
					});			
	}

function loadRank(){
	if (chatNeedRefresh) { ajaxRankRefresh(); }
	chatNeedRefresh = false;
	ajaxRankRefresh();
} 
function radiodetail(id) {
	$.ajax({
	  url: "radio.php",
	  type:'GET',
	  data:'id='+id,
	  success: function(html){
		
	  }
	});
}

function plays(id,stereo) {
	$('#tabs-1').hide();
	bannerradio(id);
	$.ajax({
	  url: "radio_data.php?id="+id+"&stereo="+stereo,
	  success: function(html){
		  setTimeout(function() {
		 $('#bannerradio').hide();
		 $('#tabs-1').show();
		  }, 30000);//30 detik
	  	$("#players").html(html);	
		
	  }
	});
}

function tutupiklan(){
	 $('#bannerradio').hide();
     $('#tabs-1').show();
}
function plays2(id,stereo) {
	$('#tabs-2').hide();
	bannerradio(id);
	$.ajax({
	  url: "radio_data.php?id="+id+"&stereo="+stereo,
	  success: function(html){
		  setTimeout(function() {
		 $('#bannerradio').hide();
		 $('#tabs-2').show();
		  }, 30000);//30 detik
	  	$("#players").html(html);	
		
	  }
	});
}
function bannerradio(id) {
		$.ajax({
	  url: "bannerplay.php?id="+id,
	  success: function(html){
        $('#bannerradio').show();
	  	$("#bannerradio").html(html);	
	  }
	});
	
}
function jumlah(q,jum) {
	$('#tabs-1').hide();
	$('#loadico').show();
<!--window.location.assign(url+'view'+jum)-->
	$.ajax({
				    url: "daftarradio.php?action=list&jumlah="+jum+'&q='+q,
					type:'GET',
					dataType:'html',
	  success: function(msg){
	
	        	$('#loadico').hide();
				$('#tabs-1').show();
				$('#stationlist').show();
	if (jum == 10){
	 	var tinggi='230px';
	 }
	else if(jum==20){
		var tinggi='500px';
	 }
	 else{
		var tinggi='1000px';
	}
	$('#tabs-1').stop().animate({height:tinggi,"min-height": tinggi},{queue:false,duration:400});
    $('#tabs-1').html(msg);
          }
	});
}

function loadcontent(jum) {
	$('#tabs-1').hide();
	$('#loadico').show();
<!--window.location.assign(url+'view'+jum)-->
$.ajax({
				    url: "daftarradio.php?action=list&jumlah="+jum,
					type:'GET',
					dataType:'html',
	  success: function(msg){
	
	        	$('#loadico').hide();
				$('#stationlist').show();
				$('#tabs-1').show();
				if (jum == 10){
	 	var tinggi='230px';
	 }
	else if(jum==20){
		var tinggi='500px';
	 }
	 else{
		var tinggi='1000px';
	}
		  	$('#tabs-1').stop().animate({height:tinggi,"min-height": tinggi},{queue:false,duration:400});
             $('#tabs-1').html(msg);
                }
	});
}

function carikota(key,jum) {
	$('#tabs-1').hide();
	$('#loadico').show();
<!--window.location.assign(url+'view'+jum)-->
$.ajax({
		url: "daftarradio.php?action=list&q="+key+'&jumlah='+jum,
		type:'GET',
		dataType:'html',
	    success: function(msg){
	        	$('#loadico').hide();
				$('#stationlist').show();
				$('#tabs-1').show();
					if (jum == 10){
						var tinggi='230px';
	 				}
					else if(jum==20){
						var tinggi='500px';
					}
					else if(jum==50){
						var tinggi='1000px';
					}
					else{
						var tinggi='230px';
					}
				$('#tabs-1').stop().animate({height:tinggi,"min-height": tinggi},{queue:false,duration:400});
 				$('#tabs-1').html(msg);
                }
	});
}


function paging(page,jumlah,arah) {
	$.ajax({
				    url: "daftarradio.php?action=paging&page="+page+"&jumlah="+jumlah,
					type:'GET',
					dataType:'html',
	  success: function(msg){
         $('#stationlist').html(msg); 
		 	$('#tabs-2').hide();
                }
				});
}
function cariradio(nama,url) {
window.location.assign(url+nama)
}
function AlpaNumerik(obj){
    a=obj.value;   
    if(a!=null&&a!=''){
        var reg=new RegExp(/^[a-zA-Z0-9 ]+$/g);
        var b=a.substr(a.length-1,1);
        var c=b.match(reg,'');
        if(c!=null){
            obj.value=a;
        }else{
            obj.value=a.substr(0,a.length-1);
        }
        
    }else{
        obj.value='';
    }
       
}