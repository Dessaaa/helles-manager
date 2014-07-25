var actions = {
  bind_delete: function() {
    $('.delete').on('click', function(e){
      e.preventDefault();
      $('#delete-form').attr('action', $(this).attr('href'));
      $('#delete-modal').modal('show');
    });
  }
}
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
    },
    "fnDrawCallback": function() {
      actions.bind_delete();
    }
  });

  actions.bind_delete();

  /* ---------- Text editor ---------- */
  if($('.richtext').length) {

    tinymce.init({
          relative_urls : false,
          language : 'pt_BR',
          selector: ".richtext",
          height: 250,
          plugins: [
              "advlist autolink lists link image charmap print preview anchor",
              "searchreplace visualblocks code fullscreen",
              "insertdatetime media table contextmenu paste"
          ],
          toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
          // image_advtab: true ,

          // external_filemanager_path:"/link_to_filemanager/filemanager/",
          // filemanager_title:"Responsive Filemanager" ,
          // external_plugins: { "filemanager" : "/link_to_filemanager/filemanager/plugin.min.js"},
          // filemanager_access_key: '587456b6c8867531647f9e9c368c285a'
        });

    $('form').bind('form-pre-serialize', function(e) {
        tinyMCE.triggerSave();
    });

  }

  /* ---------- Datapicker ---------- */
  $.fn.datepicker.dates['pt-BR'] = {
    days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"],
    daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
    daysMin: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa", "Do"],
    months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
    monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
    today: "Hoje",
    clear: "Limpar"
  };
  $('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    language: 'pt-BR',
    weekStart: 1
  });

  /* ---------- Choosen ---------- */
  $('[data-rel="chosen"],[rel="chosen"]').chosen();

  /* ---------- Placeholder Fix for IE ---------- */
  $('input, textarea').placeholder();

  /* ---------- Auto Height texarea ---------- */
  $('textarea').autosize();
  
  /* ---------- Masked Input ---------- */
  $(".date-mask").mask("99/99/9999");
  
  $.mask.definitions['~']='[+-]';
  $(".eyescript").mask("~9.99 ~9.99 999");
  
  /* ---------- Textarea with limits ---------- */
  $('.limit_text').inputlimiter({
    limit: 10,
    limitBy: 'words',
    remText: 'Você tem %n word%s palavras restantes...',
    limitText: 'Campo limitado em %n word%s.'
  });
  
  /* ---------- Timepicker for Bootstrap ---------- */
  $('.timepicker').timepicker();
  
  /* ---------- DateRangepicker for Bootstrap ---------- */
  $('.daterange').daterangepicker();
  
  /* ---------- Colorpicker for Bootstrap ---------- */
  $('.colorpicker').colorpicker();

});
