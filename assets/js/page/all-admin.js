"use strict";

function table_checkboxes(){
  $('[data-checkboxes]').each(function() {
    var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

    me.change(function() {
      var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

      if(role == 'dad') {
        if(me.is(':checked')) {
          all.prop('checked', true);
        }else{
          all.prop('checked', false);
        }
      }else{
        if(checked_length >= total) {
          dad.prop('checked', true);
        }else{
          dad.prop('checked', false);
        }
      }
    });
  });
}

$('#all-admin-table').on('change', function(){
  $('#delete-button').toggle($('input:checkbox:checked').length > 0);
});

$('#delete-button').on('click', function() {
  var username = '';
  var checkedValues = $("input:checkbox:checked", "#all-admin-table-body").map(function() {
    return $(this).val();
  }).get();
  var checkedDataVal = $("input:checkbox:checked", "#all-admin-table-body").map(function() {
    return $(this).attr('data-val');
  }).get();
  $.each(checkedDataVal, function (index, value) {
    username = username + '<span class="badge badge-outline-primary">' + value + '</span>';
  });
  $('#selected_hash').val(checkedValues.join(','));
  $('#selected_username').html(username);
  $('#delete_modal').modal('show');
});

$('#all-admin-table').on('click', '.delete-link', function(e) {
  e.preventDefault();
  var data_hash = $(this).attr('data-hash');
  var data_username = $(this).attr('data-username');
  $('#selected_hash').val(data_hash);
  $('#selected_username').html('<span class="badge badge-outline-primary">' + data_username + '</span>');
  $('#delete_modal').modal('show');
});

$('#all-admin-table').DataTable({
  // Processing indicator
  "processing": true,
  // DataTables server-side processing mode
  "serverSide": true,
  // Initial no order.
  "order": [],
  // Load data from an Ajax source
  "ajax": {
    "url": "get_admins",
    "type": "POST"
  },
  //Hide pagination if row count lower than limit
  "fnDrawCallback": function(oSettings) {
    if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
      $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
    }else{
      $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
    }
  },
  //Set column definition initialisation properties
  "columnDefs": [
    {"targets": [0], "orderable": false},
    {"className": "text-center align-middle", "targets": [ 0 ]},
    {"className": "align-middle username-td", "targets": [ 1 ]},
    {"className": "align-middle", "targets": [ 2 ]},
    {"className": "align-middle", "targets": [ 3 ]},
    {"className": "text-center align-middle", "targets": [ 4 ]}
  ],
  //Call function after complete
  "initComplete": function(settings, json) {
    table_checkboxes();
  }
});
