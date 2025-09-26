/*     
	12/20/08
	Form Validator
	Jquery plugin for form validation and quick contact forms
	Copyright (C) 2008 Jeremy Fry
*/

jQuery.iFormValidate = {
	build : function(user_options)
	{
		var defaults = {
			ajax: false,
			validCheck: false,
			phpFile:"",
			afterURL:"",
			callbackFunc:"",
			callbackFailed:{use_popup:'', otherFunc: ''},
			agreement: false,
			txtTOS: "you should check the agreement",
			txtInvalid: "Please check input with red border..",
			txtAjax: "Data is updated..",
			txtSaving: "saving..",
			txtContainer: ".confirmtxt",
			cssContainer: ".confirmtxt",
			agreementId: "#userAgree"
		};
		return jQuery(this).each(
			function() {
			var options = jQuery.extend(defaults, user_options);
			var $inputs = "";
			var $inputs = new Array;
			if(options.validCheck){
				$inputs[this.name] = jQuery(this).find(":input").filter(":not(:submit)").filter(":not(:checkbox)").filter(":not(.novalid)");
			}else{
				$inputs[this.name] = jQuery(this).find(":input").filter(":not(:submit)").filter(":not(:checkbox)");
			}
			
			
			//catch the submit
			jQuery(this).submit(function(){
				
				jQuery(options.cssContainer).removeClass('error info warning success loading');
				jQuery(options.txtContainer).html(options.txtSaving);
				jQuery(options.cssContainer).addClass('loading');
				
				//we need to do a seperate analysis for checboxes
				$checkboxes = jQuery(this).find(":checkbox");
				//we test all our inputs
				var isValid = jQuery.iFormValidate.validateForm($inputs[this.name]);

				if(options.agreement){
					if(jQuery(options.agreementId).attr("checked")){
						var fromValid = '';
					}else
					{
						var fromValid = 'agree';
						isValid = false;
					}
				}
				
				//if any of them come back false we quit
				if(!isValid){
					
					var addText='';
					if(fromValid=='agree'){
						addText+=options.txtTOS;
					}
					if(addText==''){
						addText+=options.txtInvalid;
					}else
					{
						//addText+="<br>Please check input with red line..";
					}
					
					jQuery(options.cssContainer).removeClass('error info warning success loading');
					jQuery(options.txtContainer).html(addText);
					jQuery(options.cssContainer).addClass('error');
					
					if(options.callbackFailed.use_popup == 'modal'){
						$.modal({
							content: jQuery(options.txtContainer).html(),
							draggable:false,
							resizable:false,
							width: 300
						});
					}	
						
					if(options.callbackFailed.use_popup == 'alert'){
						alert(addText);
					}	
						
					return false;
				}
				
				if(options.ajax){
					var data = {};
					$inputs[this.name].each(function(){
						data[this.name] = this.value;
					});
					$checkboxes.each(function(){
						if(jQuery(this).is(':checked')){
							data[this.name] = this.value;
						}else{
							data[this.name] = "";
						}
						//data[this.name] = this.value;
					});
					
					jQuery(options.cssContainer).addClass('loading');
					
						//ajax login here
						jQuery.ajax({
						   type: "POST",
						   url: options.phpFile,
						   //data: data,
						   data: jQuery(this).serialize(),
						   success: function(msg){
						    jQuery(options.cssContainer).removeClass('error info warning success loading');
							if(msg=='success'){
								jQuery(options.txtContainer).html(options.txtAjax);
								jQuery(options.cssContainer).addClass('success');
								if(options.afterURL != ''){
									window.location=options.afterURL;
								}

								if(options.callbackFunc != ''){
									var newfunc = options.callbackFunc+'();';
									eval(newfunc);
								}
							}else
							{
								jQuery(options.cssContainer).addClass('info');
								if(options.callbackFailed.otherFunc != ''){
									var newfunc = options.callbackFailed.otherFunc+'();';
									eval(newfunc);
								}else{
									
									jQuery(options.cssContainer).removeClass('error info warning success loading');
									jQuery(options.txtContainer).html(msg);
									jQuery(options.cssContainer).addClass('error');
										
									if(options.callbackFailed.use_popup == 'modal'){
										$.modal({
											content: jQuery(options.txtContainer).html(),
											draggable:false,
											resizable:false,
											width: 300
										});
									}

									if(options.callbackFailed.use_popup == 'alert'){
										alert(msg);
									}
								}	
							}
						   }
						 });
					return false;
				
				}else{
					
					jQuery(options.txtContainer).html(options.txtSaving);
					jQuery(options.cssContainer).addClass('loading');
					return true;
					
				}
			});
			
			$inputs[this.name].bind("keyup", jQuery.iFormValidate.validate);
			$inputs[this.name].filter("select").bind("change", jQuery.iFormValidate.validate);
		});
	},
	validateForm : function($inputsx)
	{
		var isValid = true; //benifit of the doubt?
		
		$inputsx.filter(".is_required").each(jQuery.iFormValidate.validate);		
		if($inputsx.filter(".is_required").hasClass("invalid")){isValid=false;}
		if($inputsx.filter(".vemail").hasClass("invalid")){isValid=false;}
		if($inputsx.filter(".vzip").hasClass("invalid")){isValid=false;}
		//if($inputsx.filter(".vcaptcha").hasClass("invalid")){isValid=false;}
		if($inputsx.filter(".vname").hasClass("invalid")){isValid=false;}
		if($inputsx.filter(".vusername").hasClass("invalid")){isValid=false;}
		if($inputsx.filter(".vpasswd").hasClass("invalid")){isValid=false;}
		if($inputsx.filter(".vpasswdl").hasClass("invalid")){isValid=false;}
		
		return isValid;
	},
		
	validate : function(){
		var $val = jQuery(this).val();
		var isValid = true;
		var varnull = 'no';
		if(jQuery(this).hasClass('vdate')){
		//Regex for DATE
			var Regex = /^([\d]|1[0,1,2]|0[1-9])(\-|\/|\.)([0-9]|[0,1,2][0-9]|3[0,1])(\-|\/|\.)\d{4}$/;
			isValid = Regex.test($val);		
		}else if(jQuery(this).hasClass('vemail') && $val.length > 0){
		//Regex for Email
			var Regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!Regex.test($val)){isValid = false;}		
		}else if(jQuery(this).hasClass('vconfirm_email') && $val.length > 0){
			var Regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
			if(!Regex.test($val)){isValid = false;}		
			if(strtolower($val)!=strtolower(jQuery('#email').val())){isValid = false;}
			
		//Check for not empty empty
		}else if(jQuery(this).hasClass('vphone')){
		//Regex for Phone
			var Regex = /^\(?[2-9]\d{2}[ \-\)] ?\d{3}[\- ]?\d{4}$/;
			if(!Regex.test($val)){isValid = false;}
		}else if(jQuery(this).hasClass('vzip')){
		//Check for U.S. 5 digit zip code
			var Regex = /^\d{5}$/;
			if(!Regex.test($val)){isValid = false;}
		}else if(jQuery(this).hasClass('vyear')){
		//Check for 4 digit year code
			var Regex = /^\d{4}$/;
			if(!Regex.test($val)){isValid = false;}
		}else if(jQuery(this).hasClass('vstate')){
		//Check for state
			var Regex = /^[a-zA-Z]{2}$/;
			if(!Regex.test($val)){isValid = false;}
		}else if(jQuery(this).hasClass('vname')){
		//Check for name	
			var Regex = /^[a-zA-Z0-9\ ']*$/;
			if(!Regex.test($val)){isValid = false;}
			if($val=='' || $val.length === 0){ isValid = false; }
		}else if(jQuery(this).hasClass('vusername')){
		//Check for user name	
			var Regex = /^[a-zA-Z0-9\ ']*$/;
			if(!Regex.test($val)){isValid = false;}
			if($val=='' || $val.length === 0){ isValid = false; }
		//Check for captcha
		}else if(jQuery(this).hasClass('vcaptcha')){
			//alert($val+' - '+jQuery('#captchax').val());
			if(strtolower($val)!=strtolower(jQuery('#captchax').val())){isValid = false;}
		//Check for not empty empty
		}else if(jQuery(this).hasClass('vpasswdl')){
			//alert($val+' - '+jQuery('#captchax').val());
			var Regex = /^[a-zA-Z0-9\ ']*$/;
			if(!Regex.test($val)){isValid = false;}
			if($val.length<6){isValid = false;}	
		//Check for not empty empty
		}else if(jQuery(this).hasClass('vpasswd')){
			//alert($val+' - '+jQuery('#captchax').val());
			if($val.length<6){isValid = false;}	
			if(strtolower($val)!=strtolower(jQuery('#password').val())){isValid = false;}
			
		//Check for not empty empty
		}else if(jQuery(this).hasClass('vchecked')){
			//alert(jQuery(this).attr("checked"));
		}else if(jQuery(this).hasClass('is_checkvalue') && jQuery(this).hasClass('invalid') && $val.length > 0){
			isValid = false;
		}else if(jQuery(this).hasClass('is_required')){
			if($val.length === 0){
				isValid = false;
			}
		}else
		{
			varnull = 'yes';
		}
		
		if(varnull == 'no'){
			if(isValid){
				jQuery(this).removeClass("invalid");
				//jQuery(this).addClass("valid");
			}else{
				//jQuery(this).removeClass("valid");
				jQuery(this).addClass("invalid");
			}
		}else
		{
			jQuery(this).removeClass("invalid");
			jQuery(this).removeClass("valid");
		}
	}	
}
