$(document).ready(function(){
			function buttonUp(){
				 var valux = $('.ExpInput').val(); 
					valux = $.trim(valux).length;
					if(valux !== 0){
						$('.Expbtn').css('z-index','99');
					} else{
						$('.ExpInput').val(''); 
						$('.Expbtn').css('z-index','-999');
					}
			}
			});
			
			$(document).ready(function(){
				var submitIcon = $('.ExpIcon');
				var submitInput = $('.ExpInput');
				var searchBox = $('.Exp-serach');
				var isOpen = false;
				
				$(document).mouseup(function(){
					if(isOpen == true){
					submitInput.val('');
					$('.Expbtn').css('z-index','-999');
					submitIcon.click();
					}
				});
				
				submitIcon.mouseup(function(){
					return false;
				});
				
				searchBox.mouseup(function(){
					return false;
				});
						
				submitIcon.click(function(){
					if(isOpen == false){
						searchBox.addClass('Exp-serach-open');
						isOpen = true;
					} else {
						searchBox.removeClass('Exp-serach-open');
						isOpen = false;
					}
			});
			
			});