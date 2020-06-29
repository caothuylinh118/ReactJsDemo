$(function() {
	var questionCount = 1;
	$('#add_question').click(function() {

		var newRow = '<div class="box-body questions-group">';
		newRow += '<div class="form-group">';
		// newRow += 'Axis : <select class="question-axis" id="" data-count="' + questionCount + '"><option value="X">X Axis</option> <option value="Y">Y Axis</option></select><br>';
		newRow += '<label class="question-count"></label>';
		newRow += '<div class="row">';
		newRow += '<div class="col-xs-4">';
		newRow += '<input type="text" class="form-control question-txt-en" placeholder="English ..." name="">';
		newRow += '</div>';
		newRow += '<div class="col-xs-4">';
		newRow += '<input type="text" class="form-control question-txt-fr" placeholder="France ..." name="">';
		newRow += '</div>';
		newRow += '<div class="col-xs-4">';
		newRow += '<input type="text" class="form-control question-txt-vn" placeholder="Vietnamese ..." name="">';
		newRow += '</div>';
		newRow += '</div>';
		newRow += '</div>';

		// Answer 1
		newRow += '<div class="form-group">';
		newRow += '<label>Answer Positive: </label> <label class="question-axis-label" id="">+ X / + Y</label>';
		newRow += '<div class="row">';
		newRow += '<div class="col-xs-4">';
		newRow += '<input type="text" class="form-control answer-txt-1-en" placeholder="English ..." name="" value="">';
		newRow += '</div>';
		newRow += '<div class="col-xs-4">';
		newRow += '<input type="text" class="form-control answer-txt-1-fr" placeholder="France ..." name="" value="">';
		newRow += '</div>';
		newRow += '<div class="col-xs-4">';
		newRow += '<input type="text" class="form-control answer-txt-1-vn" placeholder="Vietnamese ..." name="" value="">';
		newRow += '</div>';
		newRow += '</div>';
		// Color Answer 1
		newRow += '<div class="row">';
		newRow += '<div class="col-xs-4">';
		newRow += '<select class="select-answer-1">';
		newRow += '</select>';
		newRow += '</div>';
		newRow += '</div>';
		newRow += '</div>';

		// Answer 2
		newRow += '<div class="form-group">';
		newRow += '<label>Answer Negative: </label> <label class="question-axis-label" id="">- X / - Y</label>';;
		newRow += '<div class="row">';
		newRow += '<div class="col-xs-4">';
		newRow += '<input type="text" class="form-control answer-txt-2-en" placeholder="English ..." name="" value="">';
		newRow += '</div>';
		newRow += '<div class="col-xs-4">';
		newRow += '<input type="text" class="form-control answer-txt-2-fr" placeholder="France ..." name="" value="">';
		newRow += '</div>';
		newRow += '<div class="col-xs-4">';
		newRow += '<input type="text" class="form-control answer-txt-2-vn" placeholder="Vietnamese ..." name="" value="">';
		newRow += '</div>';
		newRow += '</div>';
		// Color Answer 2
		newRow += '<div class="row">';
		newRow += '<div class="col-xs-4">';
		newRow += '<select class="select-answer-2">';
		newRow += '</select>';
		newRow += '</div>';
		newRow += '</div>';
		newRow += '</div>';

		// Answer 3
		// newRow += '<div class="form-group">';
		// newRow += '<label>Answer Normal</label>';
		// newRow += '<div class="row">';
		// newRow += '<div class="col-xs-4">';
		// newRow += '<input type="text" class="form-control answer-txt-3-en" placeholder="English ..." name="" value="">';
		// newRow += '</div>';
		// newRow += '<div class="col-xs-4">';
		// newRow += '<input type="text" class="form-control answer-txt-3-fr" placeholder="France ..." name="" value="">';
		// newRow += '</div>';
		// newRow += '<div class="col-xs-4">';
		// newRow += '<input type="text" class="form-control answer-txt-3-vn" placeholder="Vietnamese ..." name="" value="">';
		// newRow += '</div>';
		// newRow += '</div>';
		// // Color Answer 3
		// newRow += '<div class="row">';
		// newRow += '<div class="col-xs-4">';
		// newRow += '<select class="select-answer-3">';
		// newRow += '</select>';
		// newRow += '</div>';
		// newRow += '</div>';
		// newRow += '</div>';

		// Button Remove
		newRow += '<span class="input-group-btn">';
		newRow += '<button type="button" class="btn btn-info btn-flat remove-line">Remove Q.' + questionCount + '</button>;';
		newRow += '</span>';
		newRow += '</div>';

		$('#question_body').append(newRow);

		var $options = $("#colorsResult > option").clone();
		$('.select-answer-1').last().append($options);
		var $options = $("#colorsResult > option").clone();
		$('.select-answer-2').last().append($options);
		// var $options = $("#colorsResult > option").clone();
		// $('.select-answer-3').last().append($options);

		addRemoveLineClick ();
		sortQuestionOrder();

		$('.my-colorpicker2').colorpicker({
			format: "hex"
		});

		questionCount ++ ;
	});

	addRemoveLineClick ();

	function addRemoveLineClick () {
		// Admin Question
		$('.remove-line').click(function() {
			$(this).parents().eq(1).remove();
			sortQuestionOrder();
		});
	}

	//--------------------------------------

	$('#add_description').click(function() {
		var newRow = '<div class="input-group margin">';
		newRow += '<div class="form-group"><input type="text" class="form-control description_item" placeholder="Description ..."></div>';
		newRow += '<span class="input-group-btn">';
		newRow += '<button type="button" class="btn btn-info btn-flat remove-line">X</button>';
		newRow += '</span>';
		newRow += '</div>';
		$('#description_body').append(newRow);
		addRemoveLineClick ();
		sortDescriptionName();

	});

	$('#add_requirement').click(function() {
		var newRow = '<div class="input-group margin">';
		newRow += '<input type="text" class="form-control requirement_item" placeholder="Requirement ...">';
		newRow += '<span class="input-group-btn">';
		newRow += '<button type="button" class="btn btn-info btn-flat remove-line">X</button>';
		newRow += '</span>';
		newRow += '</div>';
		$('#requirement_body').append(newRow);
		addRemoveLineClick ();
		sortRequirementName();
	});

	$('#add_tag').click(function() {
		var newRow = '<div class="input-group margin">';
		newRow += '<input type="text" class="form-control tag_item" placeholder="Tag ...">';
		newRow += '<span class="input-group-btn">';
		newRow += '<button type="button" class="btn btn-info btn-flat">X</button>';
		newRow += '</span>';
		newRow += '</div>';
		$('#tag_body').append(newRow);
		sortTag();
	});

	// Admin TEAM MEMBER
	$('.remove-line_tm').click(function() {
		$(this).parents().eq(1).remove();
		sortTag();
	});

	//Date picker
	$('#datepicker').datepicker({
		autoclose: true
	});
  $('#datepicker_end').datepicker({
		autoclose: true
	});
});

function sortQuestionOrder() {
	var count = 0;
	$( ".questions-group" ).each(function( index ) {
		// change AXIS select
		var changeAxis = $(this).find('.form-group').find('.question-axis');
  	// console.log( index + ": " + $( this ).text() );
		var questionCountLbl = $(this).find('.form-group').find('.question-count');
		var questionInput_en = $(this).find('.form-group').find('.question-txt-en');
		var questionInput_fr = $(this).find('.form-group').find('.question-txt-fr');
		var questionInput_vn = $(this).find('.form-group').find('.question-txt-vn');

		// Answer A
		var answerA_en = $(this).find('.form-group').find('.answer-txt-1-en');
		var answerA_fr = $(this).find('.form-group').find('.answer-txt-1-fr');
		var answerA_vn = $(this).find('.form-group').find('.answer-txt-1-vn');
		var answerAColor = $(this).find('.select-answer-1');

		// Answer B
		var answerB_en = $(this).find('.form-group').find('.answer-txt-2-en');
		var answerB_fr = $(this).find('.form-group').find('.answer-txt-2-fr');
		var answerB_vn = $(this).find('.form-group').find('.answer-txt-2-vn');
		var answerBColor = $(this).find('.select-answer-2');

		// // Answer B
		// var answerC_en = $(this).find('.form-group').find('.answer-txt-3-en');
		// var answerC_fr = $(this).find('.form-group').find('.answer-txt-3-fr');
		// var answerC_vn = $(this).find('.form-group').find('.answer-txt-3-vn');
		// var answerCColor = $(this).find('.select-answer-3');

		var removeBtn = $(this).find('.input-group-btn').find('.remove-line');
		$(changeAxis).attr('id', 'questions-axis_'+ index);
		$(changeAxis).attr('data-count', index);
		// var questionInput = $(this + '  ');
		 $(questionInput_en).attr('name', 'questions_'+ index + '_en');
		 $(questionInput_fr).attr('name', 'questions_'+ index + '_fr');
		 $(questionInput_vn).attr('name', 'questions_'+ index + '_vn');
		 $(answerA_en).attr('name', 'answer_1_'+ index + '_en');
		 $(answerA_fr).attr('name', 'answer_1_'+ index + '_fr');
		 $(answerA_vn).attr('name', 'answer_1_'+ index + '_vn');
		 $(answerB_en).attr('name', 'answer_2_'+ index + '_en');
		 $(answerB_fr).attr('name', 'answer_2_'+ index + '_fr');
		 $(answerB_vn).attr('name', 'answer_2_'+ index + '_vn');
		 // $(answerC_en).attr('name', 'answer_3_'+ index + '_en');
		 // $(answerC_fr).attr('name', 'answer_3_'+ index + '_fr');
		 // $(answerC_vn).attr('name', 'answer_3_'+ index + '_vn');
		 $(answerAColor).attr('name', 'answer_color_1_'+ index);
		 $(answerBColor).attr('name', 'answer_color_2_'+ index);
		 // $(answerCColor).attr('name', 'answer_color_3_'+ index);
		 $(questionCountLbl).text('Question.' + (count+1));
		 $(removeBtn).text('Remove Q.' + (count+1));
		 count++;
	});

	$('#qeCount').val(count);
	// setOnChangeAxisQuestion ();
}

function sortDescriptionName() {
	var count = 0;
	$( ".description_item" ).each(function( index ) {
  	// console.log( index + ": " + $( this ).text() );
		 $(this).attr('name', 'requirement_item_'+ index);
		 count++;
	});
	$('#deCount').val(count);
}

function sortRequirementName() {
	var count = 0;
	$( ".questions-group" ).each(function( index ) {
  	// console.log( index + ": " + $( this ).text() );

		$(this).attr('name', 'requirement_item_'+ index);
		count++;
	});
	$('#reCount').val(count);
}

function sortTag() {
	var count = 0;
	$(".tag_item").each(function( index ) {
  	// console.log( index + ": " + $( this ).text() );
		 $(this).attr('name', 'tag_item_'+ index);
		 count++;
	});
	$('#tagCount').val(count);
}

function setOnChangeAxisQuestion () {

	// console.log( index + ": " + $( this ).text() );
	$(".question-axis").each (function () {
		$(this).off('change');
	})
	$(".question-axis").change(function() {
		var this_index = $(this).data('count');
	  var this_val = $(this).val();
		// console.log("Index : " + this_index);
		var select_anwser_1 =  $('select[name=answer_color_1_'+this_index+']');
		// console.log($(select_anwser_1).val());
		$('select[name=answer_color_1_'+this_index+'] option').each(function(index,value) {
			var disable_condition = "";
			if (this_val == "X") {
				disable_condition = index > 2;
			} else {
				disable_condition = index <= 2;
			}
			if(disable_condition) {
					$(this).attr('disabled', true);
			} else {
				 $(this).attr('disabled', false);
			}
		});
		$('select[name=answer_color_2_'+this_index+'] option').each(function(index,value) {
			var disable_condition = "";
			if (this_val == "X") {
				disable_condition = index > 2;
			} else {
				disable_condition = index <= 2;
			}
			if(disable_condition) {
					$(this).attr('disabled', true);
			} else {
				 $(this).attr('disabled', false);
			}
		});
	});
	// $(this).attr('name', 'tag_item_'+ index);
	// count++;

}
