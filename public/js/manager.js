$(document).ready(function(){
  /* ---------- Datable ---------- */
  if($('.datatable')) {
    var sort_column = 0;
    var sort_direction = 'asc';
    if($('.datatable').data('sort-column') != '') {
      sort_column = $('.datatable').data('sort-column');
    }
    if($('.datatable').data('sort-direction') != '') {
      sort_direction = $('.datatable').data('sort-direction');
    }
  } 
  $('.datatable').dataTable({
    "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-12'i><'col-lg-12 center'p>>",
    "sPaginationType": "bootstrap",
    "aaSorting": [[ sort_column, sort_direction ]],
    "oLanguage": {
      "sLengthMenu": "_MENU_ registros por página",
      "sZeroRecords": "Nenhum registro",
      "sInfo": "Mostrando _START_ até _END_ de _TOTAL_ resultados",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 resultados",
      "sInfoFiltered": "(filtrado de um total de _MAX_ registros)",
      "sSearch": "Busca:",
      "oPaginate": {
        "sPrevious": "Anterior",
        "sNext": "Próxima"
      }
    }
  });

   $('.delete').click(function(e){
    e.preventDefault();
    $('#delete-form').attr('action', $(this).attr('href'));
    $('#delete-modal').modal('show');
  });

  /* ---------- Text editor ---------- */
  $('.cleditor').cleditor();

  /* ---------- Datapicker ---------- */
  $('.date-picker').datepicker();

  /* ---------- Choosen ---------- */
  $('[data-rel="chosen"],[rel="chosen"]').chosen();

  /* ---------- Placeholder Fix for IE ---------- */
  $('input, textarea').placeholder();

  /* ---------- Auto Height texarea ---------- */
  $('textarea').autosize();
  
  /* ---------- Masked Input ---------- */
  $("#date").mask("99/99/9999");
  $("#phone").mask("(999) 999-9999");
  $("#tin").mask("99-9999999");
  $("#ssn").mask("999-99-9999");
  
  $.mask.definitions['~']='[+-]';
  $("#eyescript").mask("~9.99 ~9.99 999");
  
  /* ---------- Textarea with limits ---------- */
  $('#limit').inputlimiter({
    limit: 10,
    limitBy: 'words',
    remText: 'Você tem %n word%s palavras restantes...',
    limitText: 'Campo limitado em %n word%s.'
  });
  
  /* ---------- Timepicker for Bootstrap ---------- */
  $('#timepicker1').timepicker();
  
  /* ---------- DateRangepicker for Bootstrap ---------- */
  $('#daterange').daterangepicker();
  
  /* ---------- Bootstrap Wysiwig ---------- */
  $('.editor').wysiwyg();
  
  /* ---------- Colorpicker for Bootstrap ---------- */
  $('#colorpicker1').colorpicker();

});