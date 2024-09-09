/*
 * global.js
 * -------------
 * Put global JS function here
 * 
 */

//-- Put subview elements here...
if (typeof(modalData) == 'undefined') {
	var modalData = {};
}

$(document).ready(function(){
	if (typeof(init_page) == 'function') init_page();
	
	//-- Prepare stacked modal
	$(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
	
	$(document).on('hidden.bs.modal', '.modal', function (event) {
		//-- Check if existing modal is open...
		if ($('.modal:visible').length > 0) {
			$('body').addClass('modal-open');
		}
    });
});

/* --- Global functions --- */
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
} 

/*
 * Scroll ke elemen tertentu
 */
function scrollToElmt(elmt) {
	$('html, body').animate({
        scrollTop: $(elmt).offset().top
    }, 250);
}

/*
 * Scroll dan screen mengarah ke elemen tertentu.
 * doFocus = set TRUE jika ingin elemen tersebut fokus.
 */
function focusTo(elmt, doFocus) {
	var el = $( elmt );
	var elOffset = el.offset().top;
	var elHeight = el.height();
	var windowHeight = $(window).height();
	var offset;
	
	if (elHeight < windowHeight) {
		offset = elOffset - ((windowHeight / 2) - (elHeight / 2));
	} else {
		offset = elOffset;
	}
	  
	$('html, body').animate({
        scrollTop: offset
    }, 500);
	if (doFocus) $(elmt).focus();
}

function _ui_run_initscript( viewElmt, callParam, tagName ) {
	var _tagName = tagName || 'initscript';
	
	var onInitFunc = $(viewElmt).data('oninitfunc');
	if ((typeof(onInitFunc) != 'undefined') && onInitFunc) {
		(typeof(window[onInitFunc])==='function') && window[onInitFunc].call( viewElmt, callParam );
	}
	
	var templateTag = $('template', viewElmt).first();
	var initFunc = (templateTag ? $(templateTag).data(_tagName) : null);
	
	if ((typeof(initFunc) != 'undefined') && initFunc) {
		(typeof(window[initFunc])==='function') && window[initFunc].call( viewElmt, callParam );
	}
	
	return initFunc;
}

/**
 * Tampilkan modal
 * 
 * @param formUrl URL view html. Use NULL to show local modal
 * @param postData Argumen request modal. If formUrl is NULL, these parameter can be used:<br />
 * 	&bull; targetModal	: Target modal. Ex: '#mymodal',<br />
 *  &bull; onInitModal : [Optional] Callback called immadiately before modal is shown<br />
 *  &bull; onPostInitModal : [Optional] Callback called after the modal is shown<br />
 * @param onSubmit Callback submit
 * @param onCancel Callback cancel
 * @returns
 * @version 1.2
 */
function _show_modal(formUrl, postData, onSubmit, onCancel) {
	var targetModal = '#web_global_modaldlg';
	if (formUrl === null) {
		//-- Open local modal
		targetModal = postData.targetModal;
	}
	
	//-- For injecting init parameter
	var initParam = null || (typeof(postData) === 'object') && (('_initParam' in postData) ? postData._initParam : null);
	$(targetModal).data('initparam', initParam);
	
	$(targetModal).unbind().on('shown.bs.modal', function (event) {
		var modal = $(this);
		
		if (formUrl !== null) {
			delete postData._initParam;
			
			$.ajax({
		    	method: 'POST',
				url: formUrl,
				data: postData,
				type: 'html'
			}).done(function(data) {
				var modalContentParent = $('#web_global_modaldlg .web_dialog_main').first();
				$(modalContentParent).html(data);
				
				if (typeof(postData.onInitModal) == 'function') {
					postData.onInitModal(modal, onSubmit, onCancel);
				}
				
				var initFunc = _ui_run_initscript(modalContentParent, {
					onSubmit: onSubmit,
					onCancel: onSubmit,
					initParam: initParam
				});
				
				if (!initFunc && typeof(init_modal)==='function') {
					init_modal(modal, onSubmit, onCancel);
				}
				
				$('#web_global_modaldlg .web_dialog_main').show();
				
				if (typeof(postData.onPostInitModal) == 'function') {
					postData.onPostInitModal(modal);
				}
				
				var postInitFunc = _ui_run_initscript(modalContentParent, {
					onSubmit: onSubmit,
					onCancel: onSubmit,
					initParam: initParam
				}, 'postinitscript');
				
				if (!postInitFunc && typeof(postinit_modal)==='function') {
					postinit_modal(modal);
	    		}
				
				$('#web_global_modaldlg').scrollTop(0);
				
			}).fail(function(jqXHR, textStatus, errorThrown){
				if (jqXHR.status == 401) { // Not logged in?
					alert('Session expired. Page will refresh and please relogin.');
					location.reload();
				} else {
					alert('Unexpected error happens.');
					$('#web_global_modaldlg').modal('hide');
					console.log(jqXHR.responseData);
				}
			}).always(function(){
				$('#web_global_modaldlg .hide-on-loading').show();
				$('#web_global_modaldlg .web_dialog_loader').hide();
			});
		} else {
			//-- Init modal using supplied callbacks
			var postInitFunc = _ui_run_initscript(modal, {
				onSubmit: onSubmit,
				onCancel: onSubmit,
				initParam: initParam
			}, 'postinitscript');
			
			if (typeof(postData.onPostInitModal) == 'function') {
				postData.onPostInitModal(modal);
			}
		}
		
	}).on('show.bs.modal', function (event){
		//-- Ignore if the modal is already shown
		if ($(this).is(':visible')) return;
		
		//-- Reset modal size
		var modalElmt = $(this);
		modalElmt.find('.modal-dialog').attr('class', 'modal-dialog');
		
		if (formUrl !== null) {
			$('#web_global_modaldlg .hide-on-loading').hide();
			
			$('#web_global_modaldlg .web_dialog_loader').show();
			$('#web_global_modaldlg .web_dialog_main').hide();
			//$(this).find('.modal-title').text('Memuat...');
		} else {
			var initFunc = _ui_run_initscript(modalElmt, {
				onSubmit: onSubmit,
				onCancel: onSubmit,
				initParam: initParam
			});
			
			if (typeof(postData.onInitModal) == 'function') {
				postData.onInitModal(modalElmt, onSubmit, onCancel);
			}
		}
	});
	
	$(targetModal).modal({
        keyboard: false,
        backdrop: 'static'
    });
}

function _hide_modal( targetModal ) {
	var _target = '#web_global_modaldlg';
	if (typeof(targetModal) != 'undefined') _target = targetModal;
	$(_target).modal('hide');
}

/*
 * Fungsi digunakan untuk mengirim pesan ke server, tetapi hasil
 * feedbacknya tidak begitu penting untuk diproses.
 */
function _send_signal(_postdata, _requesturl) {
	var _reqURL = _requesturl;
	$.ajax({
		type: "POST",
		url: _reqURL,
		data: _postdata,
		dataType: 'json',
		beforeSend: function( xhr ) {
			// Add logic here
		},
		success: function(response){
			// Add logic here
		},
		error: function(jqXHR){
			// Add logic here
		}
	}).always(function() {
		// Add logic here
	});
}


function show_overlay(_msg) {
	if (_msg === '') {$("#global_ov_msg").html('Sedang memproses... Mohon tunggu...');}
	else $("#global_ov_msg").html(_msg);
	$("#global_overlay").show();
}
function hide_overlay() {
	$("#global_overlay").fadeOut(100);
}
function ov_change_msg(_msg) {
	$("#global_ov_msg").html(_msg);
}
function _ajax_send(_postdata, _finishcallback, _msg, _requesturl) {
	_ov_msg = _msg || 'Menyimpan...';
	var _reqURL = _requesturl;
	var beforeSendCallback = null;
	var alwaysCallback = null;
	var okCallback = null;
	var errorCallback = function(response) {
		alert("Error returned: "+response.message);
	};
	
	var useLoader = true;
	var ajaxType = "POST"; // Default is POST
	
	if (typeof(_finishcallback)=='function') {
		okCallback = _finishcallback;
	} else if (typeof(_finishcallback)=='object') {
		if ('beforeSend' in _finishcallback)
			beforeSendCallback = _finishcallback.beforeSend;
		if ('success' in _finishcallback)
			okCallback = _finishcallback.success;
		if ('error' in _finishcallback)
			errorCallback = _finishcallback.error;
		if ('always' in _finishcallback)
			alwaysCallback = _finishcallback.always;
		
		//-- Fetch parameters
		if ('useLoader' in _finishcallback) useLoader = _finishcallback.useLoader;
		if ('type' in _finishcallback) ajaxType = _finishcallback.type;
	}
	$.ajax({
		type: ajaxType,
		url: _reqURL,
		data: _postdata,
		dataType: 'json',
		beforeSend: function( xhr ) {
			if (typeof(beforeSendCallback)=='function')
				beforeSendCallback();
			if (useLoader) {
				is_processing = true;
				show_overlay(_ov_msg);
			}
		},
		success: function(response){
			if (response.status != 'ok') {
				if (typeof(errorCallback)=='function')
					errorCallback(response);
			} else {
				if (typeof(okCallback)=='function')
					okCallback(response);
			}
		},
		error: function(jqXHR){
			//-- Try to parse response as JSON
			var respData = null;
			try {
				respData = JSON.parse(jqXHR.responseText);
		    } catch (e) {
		    	respData = {
					status: jqXHR.status,
					message: "Request failed.",
					xhr: jqXHR,
					rawdata: jqXHR.responseText
				};
		    }
		    
			if (typeof(errorCallback)=='function') {
				errorCallback(respData);
			} else {
				alert("Request error: "+jqXHR.status + " " + jqXHR.statusText);
			}
		}
	}).always(function() {
		if (typeof(alwaysCallback)=='function')
			alwaysCallback();
		if (useLoader) {
			is_processing = false;
			hide_overlay();
		}
	});
}

function _ui_forminput_setenabled(formElmt, _enabled) {
	if (_enabled) {
		$('input:not(.always-disabled), textarea:not(.always-disabled), button:not(.always-disabled), select:not(.always-disabled)', formElmt)
		.removeAttr('disabled');
		$('input, textarea, button, select', formElmt).removeClass('always-disabled');
	} else {
		$('input:disabled, textarea:disabled, button:disabled, select:disabled', formElmt).addClass('always-disabled');
		$('input, textarea, button, select', formElmt).attr('disabled','disabled');
	}
}

function registerLeaveConfirmation() {
	$(window).on( 'beforeunload', function() {
	    return 'Perubahan telah dilakukan. Bila jendela ditutup, maka perubahan tidak tersimpan. Lanjut?';
	});
}
function unregisterLeaveConfirmation() {
	$(window).unbind('beforeunload');
}

function _web_toast(msg, onClose, toastTitle, toastType) {
	var _title = (typeof(toastTitle)==='undefined'?'Success':toastTitle);
	var _type = (typeof(toastType)==='undefined'?'success':toastType);
	
	if (_type == 'success') {
		toastr.success(msg, _title, {onHidden: onClose});
	} else if (_type == 'error') {
		toastr.error(msg, _title, {onHidden: onClose});
	}
	
	/*swal({
		title: _title,
		text: msg,
		type: _type,
		showConfirmButton: false,
		showCancelButton: false,
		timer: 1000,
		onClose: onClose
	});*/
}

function _web_ui_htmlalert(htmlContent, onClose, alertTitle, alertType, alertDontShowAgainIdentifier) {
	var _title = (typeof(alertTitle)==='undefined'?'Success':alertTitle);
	var _type = (typeof(alertType)==='undefined'?'success':alertType);
	var _footer = (typeof(alertDontShowAgainIdentifier)==='undefined'? false:'<div class="row" style="margin-left: auto;"><div class="col-md-12"><div class="float-right"><label for="'+alertDontShowAgainIdentifier+'"><input type="checkbox" id="'+alertDontShowAgainIdentifier+'" /> <u class="indigo">jangan tampilkan lagi</u></label></div></div></div>');
	
	Swal.fire({
		allowOutsideClick: false,
		allowEscapeKey: false,
		title: _title,
		html: htmlContent,
		type: _type,
		showCancelButton: false,
		confirmButtonColor: '#3d59ab',
		footer: _footer,
		confirmButtonText: "OK"
	}).then((result) => {
		// console.log(result);
		if (!result.value) {
			// console.log(typeof(onClose));
			if (typeof(onClose) == 'function') {
				onClose();
			}
		}else{
			// console.log(typeof(onClose));
			if (typeof(onClose) == 'function') {
				onClose();
			}
		}
	});
}


function _ui_toast(msg, onClose, toastTitle, toastType) {
	var _title = (typeof(toastTitle)==='undefined'?'Success':toastTitle);
	var _type = (typeof(toastType)==='undefined'?'success':toastType);
	
	var toastParam = {
			onHidden: onClose, positionClass: 'toast-top-center mt-2', containerId: 'toast-top-center'
	};
	if (_type == 'success') {
		toastr.success(msg, _title, toastParam);
	} else if (_type == 'error') {
		toastr.error(msg, _title, toastParam);
	}
}

function _ui_confirm(confirmHtml, confirmTitle, extraParams) {
	var _extraParams = (typeof(extraParams) === 'undefined' ? {} : extraParams);
	var _confirmButtonText = (typeof(_extraParams.confirmButtonText) === 'undefined' ?
			"Confirm" : _extraParams.confirmButtonText);
	var _cancelButtonText = (typeof(_extraParams.cancelButtonText) === 'undefined' ?
			"Cancel" : _extraParams.cancelButtonText);
	
	var confirmCallback = null;
	if (typeof(_extraParams) == 'function') {
		confirmCallback = _extraParams;
		_extraParams = {};
	} else {
		confirmCallback = _extraParams.onConfirm;
	}
	
	Swal.fire({
		allowOutsideClick: false,
		allowEscapeKey: false,
		title: confirmTitle,
		html: confirmHtml,
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
	  	cancelButtonColor: '#d33',
	  	confirmButtonText: _confirmButtonText,
	  	cancelButtonText: _cancelButtonText,
	  	showLoaderOnConfirm: true,
		preConfirm: function() {
		    return new Promise(function(resolve) {
		    	if (typeof(confirmCallback)==='function') {
		    		confirmCallback(resolve, function(msg) {
		    			Swal.disableLoading();
		    			Swal.showValidationMessage(msg);
					}, _ui_toast);
				} else {
					resolve();
				}
		    });
		},
	}).then((result) => {
		if (!result.value) {
			if (typeof(_extraParams.onCancel) == 'function') {
				_extraParams.onCancel();
			}
		}
	});
}

/**
 * Init AjaxForm. Require jquery.form.min.js (http://malsup.com/jquery/form/)
 *
 * @param elmtForm Target form to be assigned
 * @param opts The options
 */
function _web_ajaxform(elmtForm, opts) {
	var defaultOpts = {
		url: null,
		dataType: 'json',
		clearForm: true,
		progressElmt: '#web_upload_progress',
		_progressBar: null,
		progressValueClass: '.progress_val',
		errorElmt: '#web_upload_error',
		error: null,
		errorPrefix: '<div><i class="fa fa-times"></i> ',
		errorPostfix: '</div>',
		beforeSend: null,
		uploadProgress: function( percentage, progressLabel ){ },
		success: null,
		complete: null
	};
	var callParam = $.extend( defaultOpts, opts );
	
	if (callParam._progressBar === null) callParam._progressBar = $(callParam.progressElmt).find('.progress-bar').first();
	callParam._updateProgress = function( percentage, progressLabel ) {
		$(callParam._progressBar).width(percentage+'%');
		$(callParam._progressBar).html(percentage+"%");
		$(callParam.progressElmt).find(callParam.progressValueClass).text(percentage);
		
		callParam.uploadProgress.call( elmtForm, percentage, progressLabel );
	};
	
	callParam._updateError = function( respData ) {
		if (callParam.errorElmt) {
			$(callParam.errorElmt).html(callParam.errorPrefix + respData.message + callParam.errorPostfix).show();
		}
		
		if (typeof(callParam.error) == 'function') callParam.error.call( respData );
	};
	
	var ajaxFormOpts = {
		url: callParam.url,
		dataType: callParam.dataType,
		clearForm: callParam.clearForm,
		beforeSend: function() 
		{
			_ui_forminput_setenabled( elmtForm, false );
			
			//-- Clear everything
			callParam._updateProgress( 0, 'Initializing...' );
			$(callParam.progressElmt).show();
			$(callParam.errorElmt).empty().hide();
			
			if (typeof(callParam.beforeSend) == 'function') callParam.beforeSend.call( elmtForm );
		},
		uploadProgress: function(event, position, total, percentComplete) 
		{
			callParam._updateProgress( percentComplete, 'Uploading...' );
		},
		success: function(response) 
		{
			var respStatus = response.status;
			if (respStatus === 'ok') {
				if (typeof(callParam.success) == 'function') callParam.success.call( elmtForm, response );
			} else {
				callParam._updateError( response );
			}
		},
		complete: function() 
		{
			callParam._updateProgress( 100, 'Finished' );
			$(callParam.progressElmt).hide();
			
			_ui_forminput_setenabled( elmtForm, true );
			
			if (typeof(callParam.complete) == 'function') callParam.complete.call( elmtForm );
		},
		error: function( jqXHR, txtError )
		{
			//-- Try to parse response as JSON
			var respData = null;
			try {
				respData = JSON.parse(jqXHR.responseText);
		    } catch (e) {
		    	respData = {
					status: jqXHR.status,
					message: "Runtime error: " + txtError,
					xhr: jqXHR,
					rawdata: jqXHR.responseText
				};
		    }
			
			callParam._updateError( respData );
		}
	};
	
	return $(elmtForm).ajaxForm( ajaxFormOpts );
}

/**
 * Assign init trigger for tab panes (on tab shown)
 *
 * @author Nur Hardyanto
 */
 function setupInitTabTrigger(elmtTabContainer, initCallParam) {

    //-- Init tab activations...
    $(elmtTabContainer).find('.nav-link').on('shown.bs.tab', function (e) {
        var tabContainerHref = $(e.target).data('target');
        if (!tabContainerHref) tabContainerHref = $(e.target).attr('href');

        var tabContainer = $( tabContainerHref );

        if (!$(e.target).hasClass('initialized')) {
            _ui_run_initscript(tabContainer, initCallParam);
            $(e.target).addClass('initialized');
        }
    });

    $(elmtTabContainer).find('.nav-link.active').trigger('shown.bs.tab');
}
