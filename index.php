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
                                    <div class="usertext ">
                                    Project Name : <input  class="form-control" type="text" name="project_name" id="project_name" value="" onblur="changeProjectName()">
                                    Sheet Name   : <input  type="text" name="sheet_name" id="sheet_name" value="">
                                    </div>

                                    <p style="display:none;">

                                    <div style="float:right">
                                        <input type="button" value="Share 1" class="btn-info btn-md"  data-toggle="modal" data-target="#myModal">
                                </div></div>
                                    
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
                             <script src="http://fts-dsk-062.ftsindia.in:8080/socket.io/socket.io.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                            <script data-jsfiddle="example1">

                            $(document).ready(function () { alert(1);
                                var sheetval='';
                               var project_id = '<?php echo $project_id; ?>';
                                    $.ajax({
                                        url: "actions.php",
                                        type: 'post',
                                        async :false,
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
                                                    sheetval=value.sheet_id; 
                                                }
                                                sheetTabString += '<li id="' + value.sheet_id + '" ' + sheetClass + ' ><a  data-toggle="tab" onclick="changeSheet('+value.sheet_id+');">' + value.sheet_name + '</a></li>';
                                            });
                                            sheetTabString += '<li ><a href="" data-toggle="tab"><b>+</b></a></li>';
                                            $("#sheetlist").html(sheetTabString);

                                        }
                                    });


                                 // var sheet_id=$("#sheetlist li.active").attr('id');
                                 
                                    $.ajax({
                                              url: "actions.php",
                                              type: 'post',
                                              data: 'action=get_sheet_data&sheet_id='+sheetval,
                                              success: function (result) {
                                                    console.log("result="+result);
                                              }
                                        });
                                    });
                                 
                                var recieve = true;
                                var row = "";
                                var col = "";
                                var data1 = [
                                    ['Features', 'Notes', 'Code and Unit Testing', 'Design', 'Testing and Debugging', 'BA', 'Total', 'Buffered', 'Effort'],
                                    ["", "", 0, "=C2*20/100", "=C2*30/100", "=C2*25/100", "=SUM(C2:F2)", "=SUM(C2:F2)",'=IF(H2>80,"H",(IF(H2>8,"M","L")))'],
                                    ["", "", 0, "=C3*20/100", "=C3*30/100", "=C3*25/100", "=SUM(C3:F3)", "=SUM(C3:F3)",'=IF(H3>80,"H",(IF(H3>8,"M","L")))'],
                                    ["", "", 0, "=C4*20/100", "=C4*30/100", "=C4*25/100", "=SUM(C4:F4)", "=SUM(C4:F4)",'=IF(H4>80,"H",(IF(H4>8,"M","L")))'],
                                    ["", "", 0, "=C5*20/100", "=C5*30/100", "=C5*25/100", "=SUM(C5:F5)", "=SUM(C5:F5)", '=IF(H5>80,"H",(IF(H5>8,"M","L")))'],
                                    ["", "", 0, "=C6*20/100", "=C6*30/100", "=C6*25/100", "=SUM(C6:F6)", "=SUM(C6:F6)", '=IF(H6>80,"H",(IF(H6>8,"M","L")))'],
                                    ["", "", 0, "=C7*20/100", "=C7*30/100", "=C7*25/100", "=SUM(C7:F7)", "=SUM(C7:F7)", '=IF(H7>80,"H",(IF(H7>8,"M","L")))'],
                                    ["", "", 0, "=C8*20/100", "=C8*30/100", "=C8*25/100", "=SUM(C8:F8)", "=SUM(C8:F8)", '=IF(H8>80,"H",(IF(H8>8,"M","L")))'],
                                    ["", "", 0, "=C9*20/100", "=C9*30/100", "=C9*25/100", "=SUM(C9:F9)", "=SUM(C9:F9)", '=IF(H9>80,"H",(IF(H9>8,"M","L")))'],
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
                                    ["", "", 0, "=C23*20/100", "=C23*30/100", "=C23*25/100", "=SUM(C23:F23)", "=SUM(C23:F23)", '=IF(H23>80,"H",(IF(H23>8,"M","L")))'],
                                    ["", "", 0, "=C24*20/100", "=C24*30/100", "=C24*25/100", "=SUM(C24:F24)", "=SUM(C24:F24)", '=IF(H24>80,"H",(IF(H24>8,"M","L")))'],
                                    ["", "", 0, "=C25*20/100", "=C25*30/100", "=C25*25/100", "=SUM(C25:F25)", "=SUM(C25:F25)", '=IF(H25>80,"H",(IF(H25>8,"M","L")))'],
                                    ["", "", 0, "=C26*20/100", "=C26*30/100", "=C26*25/100", "=SUM(C26:F26)", "=SUM(C26:F26)", '=IF(H26>80,"H",(IF(H26>8,"M","L")))'],
                                    ["", "", 0, "=C27*20/100", "=C27*30/100", "=C27*25/100", "=SUM(C27:F27)", "=SUM(C27:F27)", '=IF(H27>80,"H",(IF(H27>8,"M","L")))'],
                                    ["", "", 0, "=C28*20/100", "=C28*30/100", "=C28*25/100", "=SUM(C28:F28)", "=SUM(C28:F28)", '=IF(H28>80,"H",(IF(H28>8,"M","L")))'],
                                    ["", "", 0, "=C29*20/100", "=C29*30/100", "=C29*25/100", "=SUM(C29:F29)", "=SUM(C29:F29)", '=IF(H29>80,"H",(IF(H29>8,"M","L")))'],
                                    ["", "", 0, "=C30*20/100", "=C30*30/100", "=C30*25/100", "=SUM(C30:F30)", "=SUM(C30:F30)", '=IF(H30>80,"H",(IF(H30>8,"M","L")))'],
                                    ["", "", 0, "=C31*20/100", "=C31*30/100", "=C31*25/100", "=SUM(C31:F31)", "=SUM(C31:F31)", '=IF(H31>80,"H",(IF(H31>8,"M","L")))'],
                                    ["", "", 0, "=C32*20/100", "=C32*30/100", "=C32*25/100", "=SUM(C32:F32)", "=SUM(C32:F32)", '=IF(H32>80,"H",(IF(H32>8,"M","L")))'],
                                    ["", "", 0, "=C33*20/100", "=C33*30/100", "=C33*25/100", "=SUM(C33:F33)", "=SUM(C33:F33)", '=IF(H33>80,"H",(IF(H33>8,"M","L")))'],
                                    ["", "", 0, "=C34*20/100", "=C34*30/100", "=C34*25/100", "=SUM(C34:F34)", "=SUM(C34:F34)", '=IF(H34>80,"H",(IF(H34>8,"M","L")))'],
                                    ["", "", 0, "=C35*20/100", "=C35*30/100", "=C35*25/100", "=SUM(C35:F35)", "=SUM(C35:F35)", '=IF(H35>80,"H",(IF(H35>8,"M","L")))'],
                                    ["", "", 0, "=C36*20/100", "=C36*30/100", "=C36*25/100", "=SUM(C36:F36)", "=SUM(C36:F36)", '=IF(H36>80,"H",(IF(H36>8,"M","L")))'],
                                    ["", "", 0, "=C37*20/100", "=C37*30/100", "=C37*25/100", "=SUM(C37:F37)", "=SUM(C37:F37)", '=IF(H37>80,"H",(IF(H37>8,"M","L")))'],
                                    ["", "", 0, "=C38*20/100", "=C38*30/100", "=C38*25/100", "=SUM(C38:F38)", "=SUM(C38:F38)", '=IF(H38>80,"H",(IF(H38>8,"M","L")))'],
                                    ["", "", 0, "=C39*20/100", "=C39*30/100", "=C39*25/100", "=SUM(C39:F39)", "=SUM(C39:F39)", '=IF(H39>80,"H",(IF(H39>8,"M","L")))'],
                                    ["", "", 0, "=C40*20/100", "=C40*30/100", "=C40*25/100", "=SUM(C40:F40)", "=SUM(C40:F40)", '=IF(H40>80,"H",(IF(H40>8,"M","L")))'],
                                    ["", "", 0, "=C41*20/100", "=C41*30/100", "=C41*25/100", "=SUM(C41:F41)", "=SUM(C41:F41)", '=IF(H41>80,"H",(IF(H41>8,"M","L")))'],
                                    ["", "", 0, "=C42*20/100", "=C42*30/100", "=C42*25/100", "=SUM(C42:F42)", "=SUM(C42:F42)", '=IF(H42>80,"H",(IF(H42>8,"M","L")))'],
                                    ["", "", 0, "=C43*20/100", "=C43*30/100", "=C43*25/100", "=SUM(C43:F43)", "=SUM(C43:F43)", '=IF(H43>80,"H",(IF(H43>8,"M","L")))'],
                                    ["", "", 0, "=C44*20/100", "=C44*30/100", "=C44*25/100", "=SUM(C44:F44)", "=SUM(C44:F44)", '=IF(H44>80,"H",(IF(H44>8,"M","L")))'],
                                    ["", "", 0, "=C45*20/100", "=C45*30/100", "=C45*25/100", "=SUM(C45:F45)", "=SUM(C45:F45)", '=IF(H45>80,"H",(IF(H45>8,"M","L")))'],
                                    ["", "", 0, "=C46*20/100", "=C46*30/100", "=C46*25/100", "=SUM(C46:F46)", "=SUM(C46:F46)", '=IF(H46>80,"H",(IF(H46>8,"M","L")))'],
                                    ["", "", 0, "=C47*20/100", "=C47*30/100", "=C47*25/100", "=SUM(C47:F47)", "=SUM(C47:F47)", '=IF(H47>80,"H",(IF(H47>8,"M","L")))'],
                                    ["", "", 0, "=C48*20/100", "=C48*30/100", "=C48*25/100", "=SUM(C48:F48)", "=SUM(C48:F48)", '=IF(H48>80,"H",(IF(H48>8,"M","L")))'],
                                    ["", "", 0, "=C49*20/100", "=C49*30/100", "=C49*25/100", "=SUM(C49:F49)", "=SUM(C49:F49)", '=IF(H49>80,"H",(IF(H49>8,"M","L")))'],
                                    ["", "", 0, "=C50*20/100", "=C50*30/100", "=C50*25/100", "=SUM(C50:F50)", "=SUM(C50:F50)", '=IF(H50>80,"H",(IF(H50>8,"M","L")))'],
                                    ["", "", 0, "=C51*20/100", "=C51*30/100", "=C51*25/100", "=SUM(C51:F51)", "=SUM(C51:F51)", '=IF(H51>80,"H",(IF(H51>8,"M","L")))'],
                                    ["Total", "", 0, "=SUM(C2:C51)", "=SUM(D2:D51)", "=SUM(E1:E51)", "=SUM(F1:F51)", "=SUM(G1:G51)", ""]

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
                                        var sheet_id=$("#sheetlist li.active").attr('id');
                                        ajax('json/save.json', 'GET', JSON.stringify({data: change}), function (data) {
                                            if (recieve) {// alert(change);
                                                socket.emit('comment added', {usertext: change,sheetid : sheet_id});
                                            }
                                         /*   //exampleConsole.innerText = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';
                                            autosaveNotification = setTimeout(function () {
                                                exampleConsole.innerText = 'Changes will be autosaved';
                                            }, 1000);*/
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
                                        var sheet_id=$("#sheetlist li.active").attr('id');
                                        // alert($("#sheetlist li.active").attr('id'));
                                        socket.emit('comment added', {usertext: change,sheetid : sheet_id});
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

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>

    <script language="JavaScript">
                                var socket = "";
                                var roomId = "";
                                var valz = "";
                                var sheetsArray = [];
                                var project_id = "";
                                $(document).ready(function () {

                                    socket = io.connect('http://fts-dsk-062.ftsindia.in:8080');
                                    var sheet_id1=$("#sheetlist li.active").attr('id');
                                    socket.on('notifyeveryone', function (msg) {
                                        //  console.log("event" + JSON.stringify(msg));
                                        // alert(JSON.stringify(msg));
                                        //alert(msg.id);
                                        if(msg.id == sheet_id1){
                                            notifyMe(msg);    
                                        }
                                        

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
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Share with others</h4>
      </div>
      <div class="modal-body">
          <input type="text" name="shares" data-role="tagsinput" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>
</html>
