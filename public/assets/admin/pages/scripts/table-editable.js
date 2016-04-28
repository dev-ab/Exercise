var TableEditable = function () {

    var handleTable = function (rowNumber, tableID, btnID) {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow, rowCount) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var counter = 0; counter <= rowCount; counter++) {
                jqTds[counter].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[counter] + '">';
            }

            jqTds[rowCount + 1].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[rowCount + 2].innerHTML = '<a class="cancel" href="">Cancel</a>';


        }

        function saveRow(oTable, nRow, rowCount) {
            var jqInputs = $('input', nRow);
            for (var counter = rowCount; counter <= rowCount; counter++) {
                oTable.fnUpdate(jqInputs[counter].value, nRow, counter, false);
            }
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, rowCount + 1, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, rowCount + 2, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow, rowCount) {
            var jqInputs = $('input', nRow);
            for (var counter = rowCount; counter <= rowCount; counter++) {
                oTable.fnUpdate(jqInputs[counter].value, nRow, counter, false);
                }
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, counter + 1 , false);
                oTable.fnDraw();
            }

            var table = $(tableID);

            var oTable = table.dataTable({
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // Or you can use remote translation file
                //"language": {
                //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                //},

                // set the initial value
                "pageLength": 10,
                "language": {
                    "lengthMenu": " _MENU_ records"
                },
                "columnDefs": [{// set default column settings
                        'orderable': true,
                        'targets': [0]
                    }, {
                        "searchable": true,
                        "targets": [0]
                    }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });

            var tableWrapper = $("#sample_editable_1_wrapper");

            tableWrapper.find(".dataTables_length select").select2({
                showSearchInput: true //hide search box with special css class
            }); // initialize select2 dropdown

            var nEditing = null;
            var nNew = false;

            $(btnID).click(function (e) {
                e.preventDefault();

                if (nNew && nEditing) {
                    if (confirm("Previose row not saved. Do you want to save it ?")) {
                        saveRow(oTable, nEditing,rowNumber); // save
                        $(nEditing).find("td:first").html("Untitled");
                        nEditing = null;
                        nNew = false;

                    } else {
                        oTable.fnDeleteRow(nEditing); // cancel
                        nEditing = null;
                        nNew = false;

                        return;
                    }
                }

                var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow, rowNumber);
                nEditing = nRow;
                nNew = true;
            });

            table.on('click', '.delete', function (e) {
                e.preventDefault();

                if (confirm("Are you sure to delete this row ?") == false) {
                    return;
                }

                var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
                alert("Deleted! Do not forget to do some ajax to sync with backend :)");
            });

            table.on('click', '.cancel', function (e) {
                e.preventDefault();
                if (nNew) {
                    oTable.fnDeleteRow(nEditing);
                    nEditing = null;
                    nNew = false;
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });

            table.on('click', '.edit', function (e) {
                e.preventDefault();

                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow, rowNumber);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "Save") {
                    /* Editing this row and want to save it */
                    saveRow(oTable, nEditing);
                    nEditing = null;
                    alert("Updated! Do not forget to do some ajax to sync with backend :)");
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow, rowNumber);
                    nEditing = nRow;
                }
            });
        }

        return {
            //main function to initiate the module
            init: function () {
                handleTable(0, '#editable_1', '#sample_editable_1_new');
                handleTable(0, '#editable_2', '#sample_editable_2_new');
                handleTable(1, '#editable_3', '#sample_editable_3_new');
                handleTable(0, '#editable_4', '#sample_editable_4_new');
                handleTable(0, '#editable_5', '#sample_editable_5_new');
                handleTable(0, '#editable_6', '#sample_editable_6_new');
                handleTable(0, '#editable_7', '#sample_editable_7_new');
                handleTable(1, '#editable_8', '#sample_editable_8_new');
                handleTable(1, '#editable_9', '#sample_editable_9_new');
                handleTable(0, '#editable_10', '#sample_editable_10_new');
                handleTable(0, '#editable_11', '#sample_editable_11_new');
                handleTable(1, '#editable_12', '#sample_editable_12_new');
                handleTable(0, '#editable_13', '#sample_editable_13_new');
                handleTable(0, '#editable_14', '#sample_editable_14_new');
            }

        };

}();

