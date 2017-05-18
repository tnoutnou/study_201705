$(function(){

$('#selectFile').on('click', function() {
  $('#inputFile').trigger('click');
});

$('#inputFile').change(function() {
  $('#selectedFile').val($(this).val());
});

	
});
