/*  编辑模式里的隐藏显示  */
$('.bianjichakan').bind('click', function () {
	$(".bianji").hide();
	$(".xbianji").removeClass('panel_tags');
	$(".xbianji").removeClass('panel');
	$(this).addClass('hide');
	$('.rebianji').removeClass('hide');
});
$('.rebianji').bind('click', function () {
	$(".bianji").show();
	$(".xbianji").addClass('panel_tags');
	$(".xbianji").addClass('panel');
	$(this).addClass('hide');
	$('.bianjichakan').removeClass('hide');
});
/*    */
/*  Tjpizhu 提交批注  */

/*  段意
    ****   */

$('.J_duanyi_btn').bind('click', function () {
		var catid=$(this).data("catid");
		var pid=$(this).data("pid");
		var uid=$(this).data("uid");
		var duanid=$(this).data("duanid");
                $.ajax({
                    type: "POST",
                    url: "/index.php?g=Comments&m=Tjpizhu&a=C_duanyi",
                    dataType: "json",
                    jsonp: 'callback',
                    data: {
                        'catid': catid,
						'pid':pid,
						'uid':uid,
						'duanid':duanid,
                    },
                    success: function (backdata) {
					    $("#duan-"+duanid+"-tijiao").html(backdata.html);
						//把提交按钮给取消,绑定
                        postbtn(); 
                    },
					error: function (jxhr, msg, err) {
						alert("未知错误");
					}
                }); 
});
/*
*  
    概要
*
*/
$('.J_gaiyao_btn').bind('click', function () {

	            var pid=$(this).data("pid");
			    var uid=$(this).data("uid");
			    var catid=$(this).data("catid");

                $.ajax({
                    type: "POST",
                    url: "/index.php?g=Comments&m=Tjpizhu&a=C_gaiyao",
                    dataType: "json",
					jsonp: 'callback',
                    data: {
                        'catid': catid,
						'pid':pid,
						'uid':uid,
                    },
                    success: function (backdata) {
					    //alert("dd");
					    $("#gaiyao-tijiao").html(backdata.html);
						//把提交按钮给取消,绑定
						postbtn();
                    }
                }); 
				
				
				
});
$('.J_buchong_btn').bind('click', function () {
			    var catid=$(this).data("catid");
	            var pid=$(this).data("pid");
			    var uid=$(this).data("uid");
				var duanid=$(this).data("duanid");
                $.ajax({
                    type: "POST",
                    url: "/index.php?g=Comments&m=Tjpizhu&a=C_buchong",
                    dataType: "json",
                    jsonp: 'callback',
                    data: {
                        'catid': catid,
						'pid':pid,
						'uid':uid,
						'duanid':duanid,
                    },
                    success: function (backdata) {
					    if(backdata.lock==1){
						    alert(backdata.lockinfo);
						}else{
							$("#duan-"+duanid+"-tijiao").html(backdata.html);
							//把提交按钮给取消,绑定
							postbtn(); 
						}
                    },
					error: function (jxhr, msg, err) {
						alert("未知错误");
					}
                }); 		
});
/*  划句子
    ******  */
$('.J_huajuzi_btn').bind('click', function () {


    //获取选中的文字
	var txt = funcGetSelectText();
	            var pid=$(this).data("pid");
			    var uid=$(this).data("uid");
			    var catid=$(this).data("catid");
				var duanid=$(this).data("duanid");
                $.ajax({
                    type: "POST",
                    url: "/index.php?g=Comments&m=Tjpizhu&a=C_huaju",
                    dataType: "json",
                    jsonp: 'callback',
                    data: {
                        'catid': catid,
						'pid':pid,
						'uid':uid,
						'duanid':duanid,
						'txt':txt,
                    },
                    success: function (backdata) {
					    $("#duan-"+duanid+"-tijiao").html(backdata.html);
                        postbtn();
                    }
                }); 
});
/*  圈字
    ******  */
$('.J_quanzi_btn').bind('click', function () {
    //获取选中的文字
	var txt = funcGetSelectText();

	            var pid=$(this).data("pid");
			    var uid=$(this).data("uid");
			    var catid=$(this).data("catid");
				var duanid=$(this).data("duanid");
				
				
                $.ajax({
                    type: "POST",
                    url: "/index.php?g=Comments&m=Tjpizhu&a=C_quanzi",
                    dataType: "json",
                    jsonp: 'callback',
                    data: {
                        'catid': catid,
						'pid':pid,
						'uid':uid,
						'duanid':duanid,
						'txt':txt,
                    },
                    success: function (backdata) {
					    $("#duan-"+duanid+"-tijiao").html(backdata.html);
                        postbtn();
                    }
                }); 
});


/*   kuaisuliulang 快速浏览  */
	        $('a.ksliulan').bind('click', function (e) {

				var pid=$(this).attr("data-pid");
			    var uid=$(this).attr("data-uid");
			    var mokuai=$(this).attr("data-mokuai");
			    //ajax
                $.ajax({
				    //获取用GET方便测试
                    type: "POST",
					//获取url路径
                    url: "/index.php?g=Comments&m=Tihuan&a=json",
                    dataType: "jsonp",
                    jsonp: 'callback',
                    data: {
                        'mokuai': mokuai,
						'pid':pid,
						'uid':uid,
                    },
                    success: function (backdata) {
                        if (backdata.status) {
						    //alert("assds");
						    //概要html
						    gaiyao_html="<div class='panel-heading'><i>用户("+backdata.username+")的简要说明：</i>";
							gaiyao_html+="<p class='text-primary'>"+backdata.gydata.gaiyao+"</p></div>";
							$('#gaiyao').html(gaiyao_html);
                            //内容html
						    content_html="";
							$.each(backdata.data, function (key, duan) {
							    content_html += "<div id='duan-"+duan.whichduan+"' >";
								if(duan.leixing=="1"){
								     content_html += "<div id='duan-"+duan.whichduan+"-yuanwen' class='hottimg' >";
								     content_html +=duan.c_name+"<p></p>\
									                  </div>";
								}else{
								     content_html += "<div id='duan-"+duan.whichduan+"-yuanwen' class='hotten' >";
								     content_html +="<p>"+duan.c_name+"</p>\
									                  </div>";
								}
								if(duan.duanyi){
								    content_html +="<div id='duan-"+duan.whichduan+"-duanyi' class='row hottcn' >";
									content_html +="<div class='alert alert-info col-md-10 col-md-offset-2'>"+duan.duanyi+"</div></div>";
								}
								    content_html += "</div>"
                            })

                            $('#content_bd').html(content_html);
                        }
						
                        //绑定ajax回来的
						    //激活tooltip
                            $('a[rel=tooltip]').tooltip({});
							//激活popover
	                        $('.jiexiceng').popover();

                    }
                });
            });
/*   tomyurl 进入我的页面  */
	        $('a.intomyurl').bind('click', function (e) {
			    
				var pid=$(this).attr("data-pid");
			    var mokuai=$(this).attr("data-mokuai");

				
                $.ajax({
				    //获取用GET方便测试
                    type: "GET",
					//获取url路径
                    url: "/index.php?g=Comments&m=Intomyurl&a=makeurl",
                    dataType: "jsonp",
                    jsonp: 'callback',
                    data: {
                        'mokuai': mokuai,
						'pid':pid,
                    },
                    success: function (backdata) {
                        if (backdata.url) {
							window.location.href=backdata.url;
                        }else if(backdata.no_uid){
						    alert("请在前台登录");
						}

                    }
                });
			});

//重新刷新页面，使用location.reload()有可能导致重新提交
function reloadPage(win) {
    var location = win.location;
    location.href = location.pathname + location.search;
}
//获取选中文字
function funcGetSelectText(){
			var txt = '';
			if(document.selection){
				txt = document.selection.createRange().text;//ie
			}else{
				txt = document.getSelection();
			}
			return txt.toString();
}

function postbtn(){
    //所有的ajax form提交,由于大多业务逻辑都是一样的，故统一处理
    var ajaxForm_list = $('form.J_ajaxForm');
            $('button.J_ajax_submit_btn').on('click', function (e) {
                e.preventDefault();
                //alert("gasdf");
                var btn = $(this),
                form = btn.parents('form.J_ajaxForm');

                form.ajaxSubmit({
                    url: btn.data('action') ? btn.data('action') : form.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
                    dataType: 'json',
					jsonp: 'callback',
                    beforeSubmit: function (arr, $form, options) {
                        var text = btn.text();
                        //按钮文案、状态修改
                        btn.text(text + '中...').prop('disabled', true).addClass('disabled');
                    },
                    success: function (data, statusText, xhr, $form) {
                        var text = btn.text();
                        //按钮文案、状态修改
                        btn.removeClass('disabled').prop('disabled', false).text(text.replace('中...', '')).parent().find('span').remove();
                        if(data.btn=="duanyi"){
							$('<span class="tips_success">' + data.info + '</span>').appendTo("#duan-btn-"+data.duanid).fadeIn('slow').delay(1000).fadeOut(function () {
								//关闭提交层
								$(".close").click();
								//直接显示提交
								$("#duan-"+data.duanid+"-duanyi").html('<div class="alert alert-info col-md-10 col-md-offset-2">'+data.duanyi+'</div>');
							});
						}else if(data.btn=="gaiyao"){
                            $('<span class="tips_success">' + data.info + '</span>').appendTo("#gaiyao-btn").fadeIn('slow').delay(1000).fadeOut(function () {
								//关闭提交层
								$(".close").click();
								//直接显示提交
								$("#gaiyao div:first-child").html("<i>简要说明：</i><p class='text-primary'>"+data.gaiyao+"</p>");
                            });
						}else if(data.btn=="huaju"){
                            $('<span class="tips_success">' + data.info + '</span>').appendTo("#duan-btn-"+data.duanid).fadeIn('slow').delay(1000).fadeOut(function () {
								//关闭提交层
								$(".close").click();
								//刷新当前页
								reloadPage(window);
                            });
						}else if(data.btn=="quanzi"){
                            $('<span class="tips_success">' + data.info + '</span>').appendTo("#duan-btn-"+data.duanid).fadeIn('slow').delay(1000).fadeOut(function () {
								//关闭提交层
								$(".close").click();
								//刷新当前页
								reloadPage(window);
                            });
						}else if(data.btn=="buchong"){
                            $('<span class="tips_success">' + data.info + '</span>').appendTo("#duan-btn-"+data.duanid).fadeIn('slow').delay(1000).fadeOut(function () {
								//关闭提交层
								$(".close").click();
								//刷新当前页
								reloadPage(window);
                            });
						}
                    }
                });
            });

}
/********ajax返回绑定快速浏览********/
function ksllbind(catid,id){
	//评星
	//pingxingstar(catid,id);	
	loadarticlestars(catid,id);
/*   kuaisuliulang 快速浏览  */
	        $('a.ksliulan').bind('click', function (e) {

				var pid=$(this).attr("data-pid");
			    var uid=$(this).attr("data-uid");
			    var mokuai=$(this).attr("data-mokuai");
				
			
			    //ajax
                $.ajax({
				    //获取用GET方便测试
                    type: "POST",
					//获取url路径
                    url: "/index.php?g=comments&m=Tihuan&a=json",
                    dataType: "jsonp",
                    jsonp: 'callback',
                    data: {
                        'mokuai': mokuai,
						'pid':pid,
						'uid':uid,
                    },
                    success: function (backdata) {
                        if (backdata.status) {
						    //alert("assds");
						    //概要html
						    gaiyao_html="<div class='panel-heading'><i>用户("+backdata.username+")的简要说明：</i>";
							gaiyao_html+="<p class='text-primary'>"+backdata.gydata.gaiyao+"</p></div>";
							$('#gaiyao').html(gaiyao_html);
                            //内容html
						    content_html="";
							$.each(backdata.data, function (key, duan) {
							    content_html += "<div id='duan-"+duan.whichduan+"' >";
								if(duan.leixing=="1"){
								     content_html += "<div id='duan-"+duan.whichduan+"-yuanwen' class='hottimg' >";
								     content_html +=duan.c_name+"<p></p>\
									                  </div>";
								}else{
								     content_html += "<div id='duan-"+duan.whichduan+"-yuanwen' class='hotten' >";
								     content_html +="<p>"+duan.c_name+"</p>\
									                  </div>";
								}
								if(duan.duanyi){
								    content_html +="<div id='duan-"+duan.whichduan+"-duanyi' class='row hottcn' >";
									content_html +="<div class='alert alert-info col-md-10 col-md-offset-2'>"+duan.duanyi+"</div></div>";
								}
								    content_html += "</div>"
                            })

                            $('#content_bd').html(content_html);
                        }
						
                        //绑定ajax回来的
						    //激活tooltip
                            $('a[rel=tooltip]').tooltip({});
							//激活popover
	                        $('.jiexiceng').popover();
							


                    }
                });
            });

}
var description = new Array("非常差","真的是差","一般","很好","太完美了");
function loadarticlestars(catid,id){

			    //ajax
                $.ajax({
                    type: "POST",
					//获取url路径
                    url: "/index.php?g=comments&m=pingxing&a=cha",
                    dataType: "json",
                    jsonp: 'callback',
                    data: {
                        'catid': catid,
						'id':id,
                    },
                    success: function (backdata) {
					    //当前会员的评星数
						ustar=backdata.xingxing;
						islogin=backdata.islogin;
						//所有会员的评星，及人数
						$(".panel-pingjia").append("<div id='pstars' class='rateit' data-rateit-value='0' title='0' data-rateit-ispreset='true' data-rateit-readonly='true'></div><font>("+backdata.renshu+"人评价)</font>");
						//$('div.rateit').rateit();
						$("#pstars").data("rateit-value",backdata.pingjunfen).rateit();
						$("#pstars").attr("title",backdata.pingjunfen);
						
						if(ustar!==0){
						     //显示星数
						     $("#mystars").data("rateit-value",ustar).rateit();
							 $(".description").text("您当前的评价为："+description[ustar-1]);
							 //设置不可评分
							 $("#mystars").data("rateit-readonly",true).rateit();
						}else{
						     //可评分
						     $("#mystars").data("rateit-readonly",false).rateit();
							 //提交几星
							 tijiaojixing(catid,id,islogin);
							 $('.description').text('是好是差，请您打个分！');
						}

                    }
                });	
}
function tijiaojixing(catid,id,islogin){
	//未点击前
	$("#mystars").bind('over', function (event, value) {
			if(value>0){
			    $('.description').text(description[value-1]); 
			}else{
			    $('.description').text('');
			}
	});
    //点击
    $('#mystars').bind('rated', function (e) {
         var ri = $(this);
         var value = ri.rateit('value');

		 //判断是否登录
		 if(!islogin){
              alert("请登录后再评分！敬请原谅");
		 }else{
			 //锁定评分
			 ri.rateit('readonly', true);
			 //ajax
			  $.ajax({
				url: "/index.php?g=comments&m=pingxing&a=dian",
				data: { "catid": catid,"id":id, "jixing": value }, 
				type: 'POST',
				dataType: "json",
				jsonp: 'callback',
				success: function (backdata) {
					//所有会员的评星，及人数
					$(".panel-pingjia").html("<span class='glyphicon glyphicon-thumbs-up mr10'></span><font>本文评价</font><div id='jstars' class='rateit' data-rateit-value='0' title='0' data-rateit-ispreset='true' data-rateit-readonly='true'></div><font>("+backdata.renshu+"人评价)</font>");
					$("#jstars").data("rateit-value",backdata.pingjunfen).rateit();
					$("#jstars").attr("title",backdata.pingjunfen);
					$('.description').text('您当前的评价为：' + description[value-1]); 
				},
				error: function (jxhr, msg, err) {
					alert("未知错误");
				}
			 });
		 }
     });
}


    $('.pizhudz').bind('click', function (e) {
	    var catid=$(this).data("catid");
		var id=$(this).data("id");
		var jxid=$(this).data("jxid");
		var jxid=$(this).data("jxid");
		var zan=$(this).data("zan");
			    //ajax
                $.ajax({
                    type: "POST",
					//获取url路径
                    url: "/index.php?g=comments&m=jxdianzan&a=dian",
                    dataType: "json",
                    jsonp: 'callback',
                    data: {
                        'catid': catid,
						'id':id,
						'jxid':jxid,
						'zan':zan
                    },
                    success: function (backdata) {
 					    //当前会员的评星数
						iszan=backdata.iszan;
						islogin=backdata.islogin;
							 //判断是否登录
							 if(!islogin){
								  alert("请登录后再评分！敬请原谅");
							 }else{
								if(iszan){
                                    alert("您已经点赞过");
								}else{
									if(zan==1){
									    $("#jxid-"+jxid+"-up").html(backdata.uprenshu);
									}else{
									    $("#jxid-"+jxid+"-down").html(backdata.downrenshu);
									}
									//alert("点赞成功！");
								}
							 }
                    },
					error: function (jxhr, msg, err) {
						alert("未知错误");
					}
                });	
     });