<!DOCTYPE doctype html>
<?php
include('config.php');
include('validate_token.php');
$project_id = isset($_GET['project_id']) ? $_GET['project_id'] : '';
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
       <!--  <link href="css/samples.css?20140331" media="screen" rel="stylesheet"> -->
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

           input {height:30px}
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
                <span class="email-title" ><?php echo $_SESSION['google_data']['email']; ?> | <a href="logout.php" style="color:white;text-decoration:none;">Logout</a></span>
            </div>

        </header>

        <div class="wrapper">
            <div class="wrapper-row">
                <div id="container"  style="widht:100%;">
                    <div class="columnLayout">
                        <div class="rowLayout">
                            <div class="descLayout">
                                <div class="pad" data-jsfiddle="example1">
                                      <div class="usertext ">
                                            Project Name : <input  class="form-control" type="text" name="project_name" id="project_name" value="LMS Project" onblur="changeProjectName()">
                                            Sheet Name   : <input  type="text" name="sheet_name" id="sheet_name" value="Sheet1">
                                        </div>
                                    <p style="display:none;">
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
                                    </p>
                                     <div style="float:right">
                                                    <input type="button" value="Share 1" class="btn-info btn-md"  data-toggle="modal" data-target="#myModal">
                                                     <input type="button" value="Export" class="btn-info btn-md"  onclick="export_sheet();">
                                                     <input type="button" value="Overview" class="btn-info btn-md" data-toggle="modal" data-target="#overview">
                                                </div></div>
                                    
                                    <br></br><br>
                                    <div class="tabbable tabs-below" >
                                        <!-- <div class="tab-content">  -->
                                        
                                       <div class="tab-content" >  
                                            <div id="example1" style="height:750px;widht:100%;">
                                            </div>
                                        </div> 

                                        <ul class="nav nav-tabs" id="sheetlist">
                                           <!--  <li><a href="" data-toggle="tab">One</a></li>
                                            <li><a href="" data-toggle="tab">Two</a></li>
                                            <li><a href="" data-toggle="tab">Twee</a></li> -->
                                        </ul>
                                        <!-- </div> -->


                                    </div> 
                                       <p>
                                        <button data-dump="#example1" data-instance="hot" name="dump" title="Prints current data source to Firebug/Chrome Dev Tools">
                                           save
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
                                    ["Export plans", "- User should be able to export lesson(s) ", 180, "=C2*20/100", "=C2*30/100", "=C2*25/100", "=SUM(C2:F2)", "=SUM(C2:F2)",'=IF(H2>80,"H",(IF(H2>8,"M","L")))'],
                                    ["Sync with main online server", "- All contents and lessons will be housed in a central server.", 240, "=C3*20/100", "=C3*30/100", "=C3*25/100", "=SUM(C3:F3)", "=SUM(C3:F3)",'=IF(H3>80,"H",(IF(H3>8,"M","L")))'],
                                    ["Manual Grading for Objective Assessment", "- All contents and lessons will be housed in a central server.", 24, "=C4*20/100", "=C4*30/100", "=C4*25/100", "=SUM(C4:F4)", "=SUM(C4:F4)",'=IF(H4>80,"H",(IF(H4>8,"M","L")))'],
                                    ["Assessment status", "- All contents and lessons will be housed in a central server.", 10, "=C5*20/100", "=C5*30/100", "=C5*25/100", "=SUM(C5:F5)", "=SUM(C5:F5)", '=IF(H5>80,"H",(IF(H5>8,"M","L")))'],
                                    ["Rename assessments", "- All contents and lessons will be housed in a central server.", 4, "=C6*20/100", "=C6*30/100", "=C6*25/100", "=SUM(C6:F6)", "=SUM(C6:F6)", '=IF(H6>80,"H",(IF(H6>8,"M","L")))'],
                                    ["Add Academic Cooridnator role", "- All contents and lessons will be housed in a central server.", 70,"=C7*20/100", "=C7*30/100", "=C7*25/100", "=SUM(C7:F7)", "=SUM(C7:F7)", '=IF(H7>80,"H",(IF(H7>8,"M","L")))'],
                                    ["Rename Local admin and Teacher", "- All contents and lessons will be housed in a central server.", 8, "=C8*20/100", "=C8*30/100", "=C8*25/100", "=SUM(C8:F8)", "=SUM(C8:F8)", '=IF(H8>80,"H",(IF(H8>8,"M","L")))'],
                                    ["Media player", "- User would like to play the video content that is stored locally in a server.- The media player will let the user play/pause/seek a video that's available in the resource library or lesson.", 40, "=C9*20/100", "=C9*30/100", "=C9*25/100", "=SUM(C9:F9)", "=SUM(C9:F9)", '=IF(H9>80,"H",(IF(H9>8,"M","L")))'],
                                    ["", "", 0, "=C10*20/100", "=C10*30/100", "=C10*25/100", "=SUM(C10:F10)", "=SUM(C10:F10)", '=IF(H10>80,"H",(IF(H10>8,"M","L")))'],
                                   ["", "", 0, "=C11*20/100", "=C11*30/100", "=C11*25/100", "=SUM(C11:F11)", "=SUM(C11:F11)", '=IF(H11>80,"H",(IF(H11>8,"M","L")))'],
                                    ["", "", 0, "=C12*20/100", "=C12*30/100", "=C12*25/100", "=SUM(C12:F12)", "=SUM(C12:F12)", '=IF(H12>80,"H",(IF(H12>8,"M","L")))'],
                                    ["", "", 0, "=C13*20/100", "=C13*30/100", "=C13*25/100", "=SUM(C13:F13)", "=SUM(C13:F13)", '=IF(H13>80,"H",(IF(H13>8,"M","L")))'],
                                    ["", "", 0, "=C14*20/100", "=C14*30/100", "=C14*25/100", "=SUM(C14:F14)", "=SUM(C14:F14)", '=IF(H14>80,"H",(IF(H14>8,"M","L")))'],
                                    ["", "", 0, "=C15*20/100", "=C15*30/100", "=C15*25/100", "=SUM(C15:F15)", "=SUM(C15:F15)", '=IF(H15>80,"H",(IF(H15>8,"M","L")))'],
                                    ["", "", 0, "=C16*20/100", "=C16*30/100", "=C16*25/100", "=SUM(C16:F16)", "=SUM(C16:F16)", '=IF(H16>80,"H",(IF(H16>8,"M","L")))'],
                                    ["", "", 0, "=C17*20/100", "=C17*30/100", "=C17*25/100", "=SUM(C17:F17)", "=SUM(C17:F17)", '=IF(H17>80,"H",(IF(H17>8,"M","L")))'],
                                    ["", "", 0, "=C18*20/100", "=C18*30/100", "=C18*25/100", "=SUM(C18:F18)", "=SUM(C18:F18)", '=IF(H18>80,"H",(IF(H18>8,"M","L")))'],
                                    ["", "", 0, "=C19*20/100", "=C19*30/100", "=C19*25/100", "=SUM(C19:F19)", "=SUM(C19:F19)", '=IF(H19>80,"H",(IF(H19>8,"M","L")))'],
                                    ["", "", 0, "=C20*20/100", "=C20*30/100", "=C20*25/100", "=SUM(C20:F20)", "=SUM(C20:F20)", '=IF(H20>80,"H",(IF(H20>8,"M","L")))'],
                                    ["", "", 0, "=C21*20/100", "=C21*30/100", "=C21*25/100", "=SUM(C21:F21)", "=SUM(C21:F21)", '=IF(H21>80,"H",(IF(H21>8,"M","L")))'],
                                    ["", "", 0, "=C22*20/100", "=C22*30/100", "=C22*25/100", "=SUM(C22:F22)", "=SUM(C22:F22)", '=IF(H22>80,"H",(IF(H22>8,"M","L")))'],
                                    
                                    
                                    ["Total", "", 0, "=SUM(C2:C51)", "=SUM(D2:D51)", "=SUM(E1:E51)", "=SUM(F1:F51)", "=SUM(G1:G51)", ""]

                                ];                                var total_row = data1.length;
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
                                    minSpareRows: 0,
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
                                                socket.emit('comment added', {usertext: change});
                                            }
                                           /* exampleConsole.innerText = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';*/
                                            autosaveNotification = setTimeout(function () {
                                                exampleConsole.innerText = 'Changes will be autosaved';
                                            }, 1000);
                                        });
                                    },
                                    afterCreateRow: function (index, amount) {
                                        total_row++;
                                        // console.log(index+' '+amount);

                                    }, afterRemoveRow: function (index, amount) {
                                        total_row--;
                                    }, beforeKeyDown: function (changes) {
                                        //  alert(2);

                                    },
                                    beforeSetRangeEnd: function (change, source) {
                                        console.log(JSON.stringify({data: change}));
                                        socket.emit('comment added', {usertext: change});
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
                                        if (r === 21)
                                            cellProperties.readOnly = true;
                                        // cellProperties.renderer = firstRowRenderer;
                                        return cellProperties;
                                    }

                                });

                                /*     function firstRowRenderer(instance, td, row, col, prop, value, cellProperties) {
                                 Handsontable.renderers.TextRenderer.apply(this, arguments);
                                 if((!value || value === '' || value == null) && col=='3' && row=='4') {  console.log(col);                       
                                 //       td.innerHTML = "0";
                                 } 
                                 
                                 }
                                 */
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
    <script src="http://fts-dsk-062.ftsindia.in:8080/socket.io/socket.io.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script language="JavaScript">
                                var socket = "";
                                var roomId = "";
                                var valz = "";
                                $(document).ready(function () {

                                    socket = io.connect('http://fts-dsk-062.ftsindia.in:8080');
                                    socket.on('notifyeveryone', function (msg) {
                                        //  console.log("event" + JSON.stringify(msg));
                                        // alert(JSON.stringify(msg));
                                        notifyMe(msg);

                                        recieve = false;
                                    });

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
                                    var project_id = '<?php echo $project_id; ?>';
                                    $.ajax({
                                        url: "actions.php",
                                        type: 'post',
                                        data: 'project_id=' + project_id + '&action=get_sheets',
                                        success: function (result) {
                                            var sheetData = $.parseJSON(result);
                                            var sheetTabString = '';
                                            $.each(sheetData, function (key, value) {
                                                sheetClass = '';
                                                if (key == 0) {
                                                    sheetClass = ' class="active "';
                                                }
                                                sheetTabString += '<li id="' + value.sheet_id + '" ' + sheetClass + ' ><a href="" data-toggle="tab">' + value.sheet_name + '</a></li>';
                                            });
                                            sheetTabString += '<li ><a href="" data-toggle="tab"><b>+</b></a></li>';
                                            $("#sheetlist").html(sheetTabString);

                                        }
                                    });


                                });


                                                function changeSheet(sheet_id) {

                                                    $("#sheetlist").find("li").removeClass('active');
                                                    $("#" + sheet_id).addClass('active');

                                                    $.ajax({
                                                        url: "actions.php",
                                                        type: 'post',
                                                        data: 'sheet_id=' + sheet_id + '&action=get_sheet_data',
                                                        success: function (result) {
                                                            if (result) {
                                                                var resultData = $.parseJSON(result);
                                                                var sheet_name = resultData['sheet_name'];
                                                                $("#sheet_name").val(sheet_name);
                                                            }


                                                        }
                                                    });
                                                }

                                                function changeProjectName() {
                                                    var project_name = $("#project_name").val();

                                                    $.ajax({
                                                        url: "actions.php",
                                                        type: 'post',
                                                        data: 'project_id=' + project_id + '&project_name=' + project_name + '&action=save_project_name',
                                                        success: function (result) {

                                                        }
                                                    });
                                                }





                                                function getProjectDetails(project_id) {
                                                    $.ajax({
                                                        url: "actions.php",
                                                        type: 'post',
                                                        data: 'project_id=' + project_id + '&action=get_project_details',
                                                        success: function (result) {
                                                            if (result) {
                                                                var resultData = $.parseJSON(result);
                                                                var project_name = resultData['project_name'];
                                                                $("#project_name").val(project_name);
                                                            }


                                                        }
                                                    });
                                                }

                                                function createNewSheet() {
                                                    $.ajax({
                                                        url: "actions.php",
                                                        type: 'post',
                                                        data: 'project_id=' + project_id + '&action=new_sheet',
                                                        success: function (result) {
                                                            if (result) {
                                                                var resultData = $.parseJSON(result);
                                                                var sheet_name = resultData['project_name'];
                                                                $("#sheet_name").val(sheet_name);
                                                            }


                                                        }
                                                    });
                                                }

                                                function export_sheet(){
                                                  var sheet_id = $("#sheetlist li.active").attr('id');
                                                  window.location = "http://localhost:1111/create_excel/"+sheet_id;
                                                }
                                                var getUrlParameter = function getUrlParameter(sParam) {
                                                    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                                                            sURLVariables = sPageURL.split('&'),
                                                            sParameterName,
                                                            i;

                                                    for (i = 0; i < sURLVariables.length; i++) {
                                                        sParameterName = sURLVariables[i].split('=');

                                                        if (sParameterName[0] === sParam) {
                                                            return sParameterName[1] === undefined ? true : sParameterName[1];
                                                        }
                                                    }
                                                }

                                                function sharewith()
                                                {
                                                    $.post("share.php",
                                                            {
                                                                shares: $('#shares').val(),
                                                                sheet_id: getUrlParameter('project_id')
                                                            },
                                                            function (data, status) {
                                                                alert("Data: " + data + "\nStatus: " + status);
                                                            });
                                                }
    </script>
        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Share with others</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="shares" id="shares" placeholder="Enter emails separated by comma" style="width: 100%;" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="shares" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn" id="shares" data-dismiss="modal" onclick="sharewith()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div id="overview" class="modal fade" role="dialog" style="margin-left:-400px;width:800px">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Overview</h4>
                </div>
                <div class="modal-body">
                    <div class="jumbotron" style="float:left;width:100%">
                        <table style="float:left;width:50%">
                            <tr>
                                <th>
                                    Domain
                                </th>
                                <th>
                                    Estimate
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    Code and Unit Testing
                                </td>
                                <td class="estimate_value" id="dev_val">
                                    0
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Design
                                </td>
                                <td class="estimate_value" id="design_val">
                                    0
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Testing and Debugging
                                </td>
                                <td class="estimate_value" id="testing_val">
                                    0
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    BA
                                </td>
                                <td class="estimate_value" id="ba_val">
                                    0
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Total
                                </td>
                                <td class="estimate_value" id="total_val">
                                    0
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Buffered
                                </td>
                                <td class="estimate_value" id="buffer_val">
                                    0
                                </td>
                            </tr>
                        </table>
                        <table style="float:right;width:50%">
                            <tr>
                                <th>
                                    Domain
                                </th>
                                <th>
                                    Estimate
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    Design
                                </td>
                                <td class="estimate_text_td">
                                    <input type="text"  data-id="3" data-attr="d" class="estimate_text numeric" value="25" id="design_val_text" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Testing and Debugging
                                </td>
                                <td class="estimate_text_td" >
                                    <input type="text"  data-id="4" data-attr="e" class="estimate_text numeric" value="40" id="testing_val_text" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    BA
                                </td>
                                <td class="estimate_text_td">
                                    <input type="text"  data-id="5" data-attr="f" class="estimate_text numeric" value ="40" id="ba_val_text" >
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>
                                    Total
                                </td>
                                <td class="estimate_text_td">
                                   <input type="text"  data-id="6" data-attr="g" class="estimate_text" id="total_val_text" >
                                </td>
                            </tr> -->
                            <tr>
                                <td>
                                    Buffered
                                </td>
                                <td class="estimate_text_td">
                                    <input type="text"  data-id="7" data-attr="h" class="estimate_text numeric" value="30" id="buffer_val_text" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    High
                                </td>
                                <td class="estimate_text_td">
                                    <input type="text"  data-id="8" data-attr="i" class="range_text numeric" value="80" id="high_val_text" >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Low
                                </td>
                                <td class="estimate_text_td">
                                    <input type="text"  data-id="8" data-attr="i" class="range_text numeric" value="8" id="low_val_text" >
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        $('#overview').modal('show');
        $('#overview').modal('hide');
        $('#modal').modal('show');
        $('#modal').modal('hide');
    </script>
</body>
</html>