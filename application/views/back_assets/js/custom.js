
// $(function() {
// 	$('.submit_btn').click(function(e){
// 		e.preventDefault();
// 		$("#form1").submit();
// 	});
// });

function save_form(form_id,action){
	$('#'+form_id+' input[name=action]').val(action);
	$('#'+form_id).submit();
	return false;
}

function resubmit_false(){
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
}

function check_uncheck_main(){
	$('.checkbox_main').change(function (){
		if($(this).prop("checked") == true){
			$(".ids_check").prop("checked",true);
		}else{
			$(".ids_check").prop("checked",false);
		}
	});
}

function confirmDelete(frm, id, item_name)
{
	// console.log(frm);
	// console.log(id);
	// console.log(item_name);
	// return false;
	var html  = '<div class="modal-dialog">'+
					'<div class="modal-content">'+
						'<div class="modal-header">'+
							'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>'+
							'<h4 class="modal-title">Delete Confirmation</h4>'+
						'</div>'+
				
						'<div class="modal-body">'+
							'<div id="modal_error"></div>'+
							'<p>Are you sure to delete this '+item_name+'? </p>'+
						'</div>'+
				
						'<div class="modal-footer with-border">'+
							'<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>'+
							'<button class="btn btn-danger btn-flat send_btn" onclick="delete_items(\''+frm+'\',\''+id+'\')"> Delete</button>'+
						'</div>'+
					'</div>'+
				'</div>';

	$('#confirm_model').html(html);
	$('#confirm_model').modal('show');
}

function delete_items(frm,id){
	// console.log(frm);
	$("#id").val(id);
	$("#action").val("delete");
	$("#"+frm).submit();
}

function confirmPublishStatus(frm, id, publish)
{
	// console.log(frm);
	// console.log(id);
	// console.log(item_name);
	// return false;
	var html  = '<div class="modal-dialog">'+
					'<div class="modal-content">'+
						'<div class="modal-header">'+
							'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>'+
							'<h4 class="modal-title"> Status Confirmation</h4>'+
						'</div>'+
				
						'<div class="modal-body">'+
							'<div id="modal_error"></div>'+
							'<p>Are you sure to change status? </p>'+
						'</div>'+
				
						'<div class="modal-footer with-border">'+
							'<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>'+
							'<button class="btn btn-success btn-flat send_btn" onclick="change_status(\''+frm+'\',\''+id+'\',\''+publish+'\')"> Change</button>'+
						'</div>'+
					'</div>'+
				'</div>';

	$('#confirm_model').html(html);
	$('#confirm_model').modal('show');
}

function change_status(frm,id,publish){
	// console.log(frm);
	$("#id").val(id);
	$("#action").val("change_publish");
	$("#publish").val(publish);
	$("#"+frm).submit();
}

// ================ bulk part ================
$('.bulk_status_box').hide();
$('[name=bulk_action]').change(function(){
	bulk_val = $(this).val();
	if(bulk_val == "bulk_status_update"){
		$('.bulk_status_box').show();
	}else{
		$('.bulk_status_box').hide();
	}
});


function load_custom_modal(title,body,footer){
	var html  = '<div class="modal-dialog">'+
					'<div class="modal-content">'+
						'<div class="modal-header">'+
							'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>'+
							'<h4 class="modal-title"> '+title+'</h4>'+
						'</div>'+
						'<div class="modal-body">'+body+'</div>'+
						'<div class="modal-footer with-border">'+footer+'</div>'+
					'</div>'+
				'</div>';

	$('#confirm_model').html(html);
	$('#confirm_model').modal('show');
}

function confirmBulk(frm){

	var checkIDs = $("#"+frm+" input[name*=ids].ids_check:checked").map(function(){
		return $(this).val();
	}).get();

	title="";body="";footer="";
	if (checkIDs.length === 0) {
		title = 'Alert!';
		body = '<p>Please select atleast one row to perform bulk action.</p>';
		footer = '<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal">Close</button>';
	}else{
		bulk_val = $("#"+frm+" select[name=bulk_action]").val();

		if(bulk_val == ""){
			title = 'Alert!';
			body = '<p>Please select bulk action.</p>';
			footer = '<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal">Close</button>';
		}else if(bulk_val == "bulk_delete"){
			title = 'Delete Confirmation';
			body = '<p> Are you sure to delete selected rows? </p>';
			footer = '<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>';
			footer += '<button class="btn btn-danger btn-flat send_btn" onclick="bulk_action(\''+frm+'\',\''+bulk_val+'\')"> Delete</button>';
		}else if(bulk_val == "bulk_status_update"){

			bulk_status_val = $("#"+frm+" select[name=bulk_status]").val();
			if(bulk_status_val == ""){
				title = 'Alert!';
				body = '<p>Please select status to change.</p>';
				footer = '<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal">Close</button>';
			}else{
				title = 'Status Confirmation';
				body = '<p>Are you sure to change status? </p>';
				footer = '<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>';
				footer += '<button class="btn btn-success btn-flat send_btn" onclick="bulk_action(\''+frm+'\',\''+bulk_val+'\')"> Change</button>';
			}

		}
	}

	load_custom_modal(title,body,footer);
	return false;
}

function bulk_action(frm,bulk_val,publish){
	// console.log(frm);
	$("#action").val(bulk_val);
	$("#"+frm).submit();
}
// ======================= bulk part end ============================
