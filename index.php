<!DOCTYPE doctype html>
<?php

include('config.php');
include('validate_token.php');
$project_id = isset($_GET['project_id'])? $_GET['project_id']:'';
?>
<html>
    <head> 
        <meta charset="utf-8">
        <!--
Loading Handsontable (full distribution that includes all dependencies apart from jQuery)
        -->
        <link data-jsfiddle="common" href="dist/handsontable.css" media="screen" rel="stylesheet">
        <link data-jsfiddle="common" href="dist/pikaday/pikaday.css" media="screen" rel="stylesheet">
        <script data-jsfiddle="common" src="dist/pikaday/pikaday.js">
        </script>
        <script data-jsfiddle="common" src="dist/moment/moment.js">
        </script>
        <script data-jsfiddle="common" src="dist/zeroclipboard/ZeroClipboard.js">
        </script>
        <script data-jsfiddle="common" src="dist/numbro/numbro.js">
        </script>
        <script data-jsfiddle="common" src="dist/numbro/languages.js">
        </script>
        <script data-jsfiddle="common" src="dist/handsontable.js">
        </script>
        <!-- arun -->
        <script data-jsfiddle="common" src="rules/bower_components/ruleJS/dist/full/ruleJS.all.full.js">
        </script>
        <script data-jsfiddle="common" src="rules/src/handsontable.formula.js">
        </script>
        <link href="rules/src/handsontable.formula.css" media="screen" rel="stylesheet">
        <!-- arun -->
        <!--
Loading demo dependencies. They are used here only to enhance the examples on this page
        -->
        <!-- <link href="css/samples.css?20140331" media="screen" rel="stylesheet"> -->
        <script data-jsfiddle="common" src="js/samples.js">
        </script>
        <script src="js/highlight/highlight.pack.js">
        </script>
        <link href="js/highlight/styles/github.css" media="screen" rel="stylesheet">
        <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/custom/demo.css">
        <link rel="stylesheet" href="css/custom/header-basic.css">
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
        <script src="js/ga.js">
        </script>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            .tabs-below > .nav-tabs,
            .tabs-right > .nav-tabs,
            .tabs-left > .nav-tabs {
                border-bottom: 0;
            }

            .tab-content > .tab-pane,
            .pill-content > .pill-pane {
                display: none;
            }

            .tab-content > .active,
            .pill-content > .active {
                display: block;
            }

            .tabs-below > .nav-tabs {
                border-top: 1px solid #ddd;
            }

            .tabs-below > .nav-tabs > li {
                margin-top: -1px;
                margin-bottom: 0;
            }

            .tabs-below > .nav-tabs > li > a {
                -webkit-border-radius: 0 0 4px 4px;
                -moz-border-radius: 0 0 4px 4px;
                border-radius: 0 0 4px 4px;
            }

            .tabs-below > .nav-tabs > li > a:hover,
            .tabs-below > .nav-tabs > li > a:focus {
                border-top-color: #ddd;
                border-bottom-color: transparent;
            }

            .tabs-below > .nav-tabs > .active > a,
            .tabs-below > .nav-tabs > .active > a:hover,
            .tabs-below > .nav-tabs > .active > a:focus {
                border-color: transparent #ddd #ddd #ddd;
                font-weight: bold;
            }

            .header-title{
              color:white !important;
              font-size:20px !important;
              float:left;
            }
            .email-title{
              color:white;
              float:right !important;
            }
            .usertext{
              padding:5px;
              float:left
            }

        </style>

    </head>
    <body>
    <header class="header-basic">

      <!-- <div class="header-limiter">
        <nav>
          <a href="#" style="float:left">Fingent Sheets</a>         
        </nav>
      </div> -->

      <div>
      <a class="header-title" href="projects.php" style="text-decoration:none">Fingent Sheets</a>
      <span class="email-title" ><?php echo $_SESSION['google_data']['email'];?> | <a href="logout.php" style="color:white;text-decoration:none;">Logout</a></span>
      </div>

    </header>
        <div class="wrapper">
            <div class="wrapper-row">
                <div id="container" style="widht:100%;">
                    <div class="columnLayout">
                        <div class="rowLayout">
                            <div class="descLayout">
                                <div class="pad" data-jsfiddle="example1">
                                    <div style="overflow: auto;padding:5px;">
                                    <div class="usertext">
                                    Project Name : <input  class="form-control" type="text" name="project_name" id="project_name" value="" onblur="changeProjectName()"><br>
                                    Sheet Name : <input  type="text" name="sheet_name" id="sheet_name" value="">
                                    </div>
                                    <div style="float:right">
                                        <input type="button" value="Share 1" class="btn-info btn-md">
                                </div></div>
                                    <!-- <p>
                                        <button id="load" name="load">
                                            Load
                                        </button>
                                        <button id="save" name="save">
                                            Save
                                        </button>
                                        <label>
                                            <input autocomplete="off" checked="checked" id="autosave" name="autosave" type="checkbox">
                                            Autosave
                                            </input>
                                        </label>
                                    </p> -->
                                    <!-- <input id="formula" name="formula" type="text" value="">
                                    <pre class="console" id="example1console">Click "Load" to load data from server</pre> -->
                                    <div class="tabbable tabs-below" >
                                         <div class="tab-content" >  
                                          <div id="example1" style="height:750px;widht:100%;">
                                          </div>
                                         </div> 
                                        <ul class="nav nav-tabs" id="sheetlist">
                                            <!-- <li><a href="" data-toggle="tab">One</a></li>
                                            <li><a href="" data-toggle="tab">Two</a></li>
                                            <li><a href="" data-toggle="tab">Twee</a></li> -->
                                        </ul>                                         
                                    </div> 
                                    <p>
                                        <button data-dump="#example1" data-instance="hot" name="dump" title="Prints current data source to Firebug/Chrome Dev Tools">
                                            Save
                                        </button>
                                    </p>
                                    </input>
                                </div>
                            </div>
                            <script data-jsfiddle="example1">
                                var recieve = true;
                                var row = "";
                                var col = "";
                                var data1 = [
                                    ['Features', 'Notes', 'Code and Unit Testing', 'Design', 'Testing and Debugging', 'BA', 'Total', 'Buffered', 'Effort'],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["", "", 0, "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100", "=C2*20/100"],
                                    ["Total", "", 0, "=SUM(D1:D33)", "=SUM(E1:E33)", "=SUM(F1:F33)", "=SUM(G1:G33)", "=SUM(H1:H33)", "=SUM(I1:I33)"]

                                ];

                                var $ = function (id) {
                                    return document.getElementById(id);
                                },
                                        container = $('example1'),
                                        exampleConsole = $('example1console'),
                                        autosave = $('autosave'),
                                        load = $('load'),
                                        save = $('save'),
                                        autosaveNotification,
                                        hot;
                                function update_last_row() {

                                    console.log(data1.length);
                                }
                                function isEmptyRow(instance, row) {
                                    var rowData = instance.getData()[row];

                                    for (var i = 0, ilen = rowData.length; i < ilen; i++) {
                                        if (rowData[i] !== null) {
                                            return false;
                                        }
                                    }

                                    return true;
                                }


                                hot = new Handsontable(container, {
                                    data: data1,
                                    startRows: 0,
                                    startCols: 20,
                                    rowHeaders: true,
                                    colHeaders: true,
                                    minSpareRows: 1,
                                    contextMenu: true,
                                    manualColumnResize: true,
                                    manualRowResize: true,
                                    manualColumnMove: true,
                                    manualRowMove: true,
                                    contextMenu: true,
                                            persistentState: true,
                                    manualColumnFreeze: true,
                                    fixedRowsTop: 1,
                                    fixedRowsBottom: 2,
//                                    maxRows: 52,
                                    comments: true,
                                    formulas: true,
                                    cell: [
                                    ],
                                    dropdownMenu: true,
                                    mergeCells: [
                                    ],
                                    currentRowClassName: 'currentRow',
                                    currentColClassName: 'currentCol',
                                    afterChange: function (change, source) {
                                        if (source === 'loadData') {
                                            return; //don't save this change
                                        }
                                        if (!autosave.checked) {
                                            return;
                                        }
                                        clearTimeout(autosaveNotification);
                                        ajax('json/save.json', 'GET', JSON.stringify({data: change}), function (data) {
                                            if (recieve) {// alert(change);
                                             //   socket.emit('comment added', {usertext: change});
                                            }
                                            exampleConsole.innerText = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';
                                            autosaveNotification = setTimeout(function () {
                                                exampleConsole.innerText = 'Changes will be autosaved';
                                            }, 1000);
                                        });
                                    },
                                    afterCreateRow: function (index, amount) {
                                        update_last_row();
                                        // console.log(index+' '+amount);

                                    }, afterRemoveRow: function (index, amount) {
                                        update_last_row();
                                    }, beforeKeyDown: function (changes) {
                                        //  alert(2);

                                    },
                                    beforeSetRangeEnd: function (change, source) {
                                        console.log(JSON.stringify({data: change}));
                                      //  socket.emit('comment added', {usertext: change});
                                        recieve = true;
                                    },
                                    beforeChange: function (changes) {
                                        var instance = hot,
                                                ilen = changes.length,
                                                clen = instance.colCount,
                                                rowColumnSeen = {},
                                                rowsToFill = {},
                                                i,
                                                c;

                                    },
                                    cells: function (r, c, prop) {
                                        var cellProperties = {};
                                        //        console.log(hot.getData()[r][prop]);
                                        if (r === 51)
                                            cellProperties.readOnly = true;
                                        return cellProperties;
                                    }

                                });
                                //     resetState = document.querySelector('.reset-state');
                                stateLoaded = document.querySelector('.state-loaded');

                                /*  Handsontable.Dom.addEvent(resetState, 'click', function() {
                                 hot.runHooks('persistentStateReset');
                                 hot.updateSettings({
                                 columnSorting: true,
                                 manualColumnMove:true,
                                 manualColumnResize: true
                                 });
                                 stateLoaded.style.display = 'none';
                                 hot.render();
                                 });
                                 hot.runHooks('persistentStateLoad', '_persistentStateKeys', storedData);*/
                                Handsontable.Dom.addEvent(load, 'click', function () {
                                    ajax('json/load.json', 'GET', '', function (res) {
                                        var data = JSON.parse(res.response);

                                        hot.loadData(data.data);
                                        exampleConsole.innerText = 'Data loaded';
                                    });
                                });

                                Handsontable.Dom.addEvent(save, 'click', function () {
                                    // save all cell's data
                                    ajax('json/save.json', 'GET', JSON.stringify({data: hot.getData()}), function (res) {
                                        var response = JSON.parse(res.response);

                                        if (response.result === 'ok') {
                                            exampleConsole.innerText = 'Data saved';
                                        }
                                        else {
                                            exampleConsole.innerText = 'Save error';
                                        }
                                    });
                                });

                                Handsontable.Dom.addEvent(autosave, 'click', function () {
                                    if (autosave.checked) {
                                        exampleConsole.innerText = 'Changes will be autosaved';
                                    }
                                    else {
                                        exampleConsole.innerText = 'Changes will not be autosaved';
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </script>
  <!--  <script src="http://fts-dsk-062.ftsindia.in:8080/socket.io/socket.io.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script language="JavaScript">
                                var socket = "";
                                var roomId = "";
                                var valz = "";
                                var sheetsArray = [];
                                var project_id = "";
                                $(document).ready(function () {
/*
                                    socket = io.connect('http://fts-dsk-062.ftsindia.in:8080');
                                    socket.on('notifyeveryone', function (msg) {
                                        //  console.log("event" + JSON.stringify(msg));
                                        // alert(JSON.stringify(msg));
                                        notifyMe(msg);

                                        recieve = false;
                                    });
*/
                                    function notifyMe(data) {// alert(1);
                                        var res = data;
                                        console.log(JSON.stringify(res));
                                        $.each(res.user, function (k, v) {

                                            row = v[0];
                                            col = v[1];
                                            valz = v[3];
                                            console.log(row + '--' + col);
                                            /*    $('#example1 td').each(function(key,val) { 
                                             var index=((row)*9)+(col); //console.log(key+'-gg-'+index);
                                             if(key==index){ //alert(2);
                                             
                                             // $(this).css('border', '1px solid red');
                                             }
                                             
                                             
                                             });*/
                                            if (valz) {
                                                hot.setDataAtCell(row, col, valz);
                                            }



                                        });
                                        $.each(res.user, function (k, v) {
                                            console.log(k + '--' + v);
                                            if (k == "row") {
                                                row = v;
                                            } else if (k == 'col') {
                                                col = v;
                                            }
                                            $('#example1 td').each(function (key, val) {
                                                var index = ((row) * 9) + (col); //console.log(key+'-gg-'+index);
                                                if (key == index) {
                                                

                                                    $(this).css('border', '1px solid red');
                                                } else {
                                                    $(this).css('border-color', '#E6E6E6');
                                                }


                                            });
                                        });


                                    }
                                    project_id = '<?php echo $project_id; ?>';
                                    getProjectDetails(project_id);
                                    $.ajax({
                                        url: "actions.php",
                                        type: 'post',
                                        data: 'project_id=' + project_id + '&action=get_sheets',
                                        success: function (result) {
                                            var sheetData = $.parseJSON(result);
                                            sheetsArray  =  sheetData;
                                            var sheetTabString = '';
                                            $.each(sheetData, function (key, value) {
                                                sheetClass = '';
                                                if (key == 0) {
                                                    sheetClass = ' class="active "';
                                                    $("#sheet_name").val(value.sheet_name);
                                                }
                                                sheetTabString += '<li id="' + value.sheet_id + '" ' + sheetClass + ' ><a  data-toggle="tab" onclick="changeSheet('+value.sheet_id+');">' + value.sheet_name + '</a></li>';
                                            });
                                            sheetTabString += '<li ><a data-toggle="tab" href="actions.php?project_id='+project_id+'&action=new_sheet"><b> + </b></a></li>';
                                            $("#sheetlist").html(sheetTabString);

                                        }
                                    });

                                });

    function changeSheet(sheet_id){

        $("#sheetlist").find("li").removeClass('active');
        $("#"+sheet_id).addClass('active');

        $.ajax({
              url: "actions.php",
              type: 'post',
              data: 'sheet_id='+sheet_id+'&action=get_sheet_data',
              success: function (result) {
                if(result){
                  var resultData = $.parseJSON(result);
                  var sheet_name = resultData['sheet_name']; 
                  $("#sheet_name").val(sheet_name);
                }
                

              }
        });
    }

    function changeProjectName(){
      var project_name = $("#project_name").val();

        $.ajax({
              url: "actions.php",
              type: 'post',
              data: 'project_id='+project_id+'&project_name='+project_name+'&action=save_project_name',
              success: function (result) {

              }
        });
    }

    function getProjectDetails(project_id){
      $.ajax({
              url: "actions.php",
              type: 'post',
              data: 'project_id='+project_id+'&action=get_project_details',
              success: function (result) {
                if(result){
                  var resultData = $.parseJSON(result);
                  var project_name = resultData['project_name']; 
                  $("#project_name").val(project_name);
                }
                

              }
        });
    }
    function createNewSheet(){
      $.ajax({
              url: "actions.php",
              type: 'post',
              data: 'project_id='+project_id+'&action=new_sheet',
              success: function (result) {
                if(result){
                  var resultData = $.parseJSON(result);
                  var sheet_name = resultData['project_name']; 
                  $("#sheet_name").val(sheet_name);
                }
                

              }
      });
    }
    </script>
</body>
</html>
