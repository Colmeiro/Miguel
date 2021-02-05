$(document).ready(function () {

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

  var datatable_user = $('#table-extended-dt.dt-user');
  var datatable_almacen = $('#table-extended-dt.dt-almacen');
  var datatable_bodega = $('#table-extended-dt.dt-bodega');
  var datatable_calidad = $('#table-extended-dt.dt-calidad');
  var datatable_inventario = $('#table-extended-dt.dt-inventario');
  var datatable_control = $('#table-extended-dt.dt-control');

  if(datatable_user.length == 1) {
    var dt_order = [[ 5, 'asc' ], [ 0, 'desc' ]];
    var colDefs = [{
        "targets": [6,7],
        "searchable": false
      }];
    var targets_ord = [6,7];
  } else if(datatable_almacen.length == 1) {
    var dt_order = [[ 2, 'desc' ]];
    var colDefs = [];
    var targets_ord = [];
    var hiddenCols = [];
    var exportCols = [ 0, 1, 2, 3, 4 ];
  } else if(datatable_bodega.length == 1) {
    var dt_order = [[ 5, 'desc' ]];
    var colDefs = [];
    var targets_ord = [];
    var hiddenCols = [];
    var exportCols = [ 0, 1, 2, 3, 4, 5, 6 ];
  } else if(datatable_calidad.length == 1) {
    var dt_order = [[ 6, 'desc' ]];
    var colDefs = [];
    var targets_ord = [];
    var hiddenCols = [];
    var exportCols = [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ];
  } else if(datatable_inventario.length == 1) {
    var dt_order = [[ 3, 'desc' ]];
    var colDefs = [];
    var targets_ord = [];
    var hiddenCols = [];
    var exportCols = [ 0, 1, 2, 3 ];
  } else if(datatable_control.length == 1) {
    var dt_order = [[ 1, 'asc' ]];
    var colDefs = [];
    var targets_ord = [ 0 ];
    var hiddenCols = [  ];
    var exportCols = [ 1, 2, 3, 4 ];
  }  else {
    var dt_order = [[ 0, "desc" ]];
    var colDefs = [];
    var targets_ord = [];
    var hiddenCols = [];
    var exportCols = [];
  }

  function updatePageInfo() {
    var info = tabla_dt.page.info();
    $('#buscartabla').attr('placeholder', info.recordsDisplay + ' Resultados');
    // if (info.recordsDisplay == 0) {
    //     $('#page-info-offset').html(info.start);
    // }
    // else {
    //     $('#page-info-offset').html(info.start + 1);
    // }
    // $('#page-info-limit').html(info.end);
    // $('#page-info-total').html(info.recordsDisplay);
  }

  // table extended transactions
  var tabla_dt = $('#table-extended-dt').on('init.dt', function () {
    $("#fullpage-loader").fadeOut(200);
    $('div.oculto').show('fast', updatePageInfo);
    // $('div.oculto').show('fast');
  }).DataTable({
    orderCellsTop: true,
    fixedHeader: true,
    "lengthMenu": [ 20, 50, 75, 100 ],
    "pageLength": 20,
    "order": dt_order,
    columnDefs: colDefs,
    "columnDefs": [
      { "orderable": false, "targets": targets_ord },
      { "visible": false, "targets": hiddenCols }
    ],
    "responsive": true,
    "paging": true,
    "bInfo": false,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    "oLanguage": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrando _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
    dom: '<"row"<"col-lg-4"l><"col-lg-8"B>>t<"row"<"col-lg-4"l><"col-lg-8"p>>',
    "buttons": [
      // { extend: 'copyHtml5', 'footer': true, exportOptions: { columns: [ 0, 1, 2, 3, 4 ] } },
      { extend: 'csvHtml5', 'footer': true, exportOptions: { columns: exportCols } },
      { extend: 'excelHtml5', 'footer': true, exportOptions: { columns: exportCols } },
      // { extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4', 'footer': true, exportOptions: { columns: exportCols } },
      { extend: 'pdfHtml5', orientation: 'vertical', pageSize: 'A4', 'footer': true, exportOptions: { columns: exportCols } },
      // { extend: 'colvis', text: 'Columns'},
    ]
  }).on('search.dt', updatePageInfo);;


  $('#buscartabla').keyup(function () {
    tabla_dt.search($(this).val()).draw();
  });


  // Setup - add a text input to each footer cell
  $('#table-extended-dt thead tr:eq(1) th:not(.no-search)').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="Buscar '+title+'" class="column_search" />' );
  } );

  // Apply the search
  $( '#table-extended-dt thead'  ).on( 'keyup', ".column_search",function () {
    tabla_dt.search($(this).val()).draw();
  } );

  // tabla_dt.columns().every(function () {
  //   var self = this;
  //   $( '.dt-footer input.datepicker', this.footer() ).on('dp.change', function (e) {
  //       // self.search( this.value ).draw();
  //       tabla_dt.search($(this).val()).draw();
  //   });
  //   $( '.dt-footer input:not(.datepicker)', this.footer() ).on('keyup change', function (e) {
  //       // var code = (e.keyCode ? e.keyCode : e.which);
  //       // if (((code == 13 && self.search() !== this.value) || (self.search() !== '' && this.value === ''))) {
  //           // tabla_dt.search($(this).val()).draw();
  //       // }
  //       tabla_dt.search($(this).val()).draw();
  //   });
  //   // $( '.dt-footer select', this.footer() ).on( 'change', function (e) {
  //   //     self.search( this.value ).draw();
  //   // });
  // });


  // Array to track the ids of the details displayed rows
  var detailRows = [];
 
  $('#table-extended-dt tbody').on( 'click', 'tr td.details-control', function () {
      var tr = $(this).closest('tr');
      var row = tabla_dt.row( tr );
      var idx = $.inArray( tr.attr('id'), detailRows );

      if ( row.child.isShown() ) {
          tr.removeClass( 'details' );
          row.child.hide();

          // Remove from the 'open' array
          detailRows.splice( idx, 1 );
      }
      else {
          tr.addClass( 'details' );
          var cajasPerdidas = tr.children('td.cajas-perdidas').html();
          row.child( '<div class="table-responsive">' + 
                        '<table>' + 
                          '<tr>' + 
                            '<td colspan="2">Lista de cajas perdidas</td>' + 
                            '<td>' + cajasPerdidas + '</td>' + 
                          '</tr>' +
                        '</table>' ).show();

          // Add to the 'open' array
          if ( idx === -1 ) {
              detailRows.push( tr.attr('id') );
          }
      }
  } );

  // On each draw, loop over the `detailRows` array and show any child rows
  tabla_dt.on( 'draw', function () {
      $.each( detailRows, function ( i, id ) {
          $('#'+id+' td.details-control').trigger( 'click' );
      } );
  } );


  $('#submit_post_check').on('click', function () {
    $('#post_check').val('1');
  });

});