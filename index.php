<!DOCTYPE doctype html>
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
                        <link href="css/samples.css?20140331" media="screen" rel="stylesheet">
                            <script data-jsfiddle="common" src="js/samples.js">
                            </script>
                            <script src="js/highlight/highlight.pack.js">
                            </script>
                            <link href="js/highlight/styles/github.css" media="screen" rel="stylesheet">
                                <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
                                    <script src="js/ga.js">
                                    </script>
                                    <!-- <script src="http://fts-dsk-062.ftsindia.in:8080/socket.io/socket.io.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script language="JavaScript">
var socket ="";var roomId ="";
  
        $(document).ready(function(){
           
             socket = io.connect( 'http://fts-dsk-062.ftsindia.in:8080' );
               socket.on('notifyeveryone',function(msg){
                    console.log("event" +JSON.stringify(msg));
                    alert(JSON.stringify(msg));
                    notifyMe(msg);
                  

            });

            function notifyMe(data){
              var res=data;
              console.log( res['user'][0][0]);
             // $('#example1').handsontable('setDataAtCell', res['user'][0][0], res['user'][0][1], res['user'][0][3]);


            }
        });
  </script> -->
                                </link>
                            </link>
                        </link>
                    </link>
                </link>
            </link>
        </meta>
    </head>
    <body>
        <div class="wrapper">
            <div class="wrapper-row">
                <div id="container">
                    <div class="columnLayout">
                        <div class="rowLayout">
                            <div class="descLayout">
                                <div class="pad" data-jsfiddle="example1">
                                    <div class="usertext">
                                    </div>
                                    <p>
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
                                    <input id="formula" name="formula" type="text" value="">
                                        <pre class="console" id="example1console">Click "Load" to load data from server</pre>
                                        <div id="example1">
                                        </div>
                                        <p>
                                            <button data-dump="#example1" data-instance="hot" name="dump" title="Prints current data source to Firebug/Chrome Dev Tools">
                                                Dump data to console
                                            </button>
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <script data-jsfiddle="example1">
                                var data1 =  [
                            ["login", 10, 15, 14, 13,"11","=C2/B2","22","33"],
                            ["feature1", 10, 11, 12, 13,"11","=C2/B2","22","33"],
                            ["feature2", 20, 11, 14, 13,"11","=C2/B2","22","33"],
                            ["feature3", 30, 15, 12, 13,"11","=C2/B2","22","33"]
                          ];
                var
                  $ = function(id) {
                      return document.getElementById(id);
                  },
                  container = $('example1'),
                  exampleConsole = $('example1console'),
                  autosave = $('autosave'),
                  load = $('load'),
                  save = $('save'),
                  autosaveNotification,
                  hot;
                  function update_last_row(){

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
                  startRows: 15,
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
                  fixedRowsTop: 2,
                  fixedColumnsLeft: 2,
                   comments: true,
                   formulas: true,
                   colHeaders: ['Features', 'Notes', 'Code and Unit Testing', 'Design','Testing and Debugging',
'BA','Total','Buffered','Effort'],
                    // columns: [
                    //   {
                    //     data: 'Features',
                    //     readOnly: true
                    //   },
                    //   {
                    //     data: 'year'
                    //   },
                    //   {
                    //     data: 'chassis'
                    //   },
                    //   {
                    //     data: 'bumper'
                    //   }
                    // ],
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
                      console.log(JSON.stringify({data: change}));
                       //socket.emit('comment added',{usertext : change});
                      exampleConsole.innerText  = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';
                      autosaveNotification = setTimeout(function() {
                        exampleConsole.innerText ='Changes will be autosaved';
                      }, 1000);
                    });
                  },
                   afterCreateRow:function(index,amount){
                  //console.log(index+' '+amount);

                  },beforeKeyDown:function(changes){
                  //  alert(2);

                  },
                   beforeSetRangeEnd:function(change, source){
                    console.log(JSON.stringify({data: change}));
                    
                 },
                    beforeChange: function (changes) {
                    var instance = hot,
                      ilen = changes.length,
                      clen = instance.colCount,
                      rowColumnSeen = {},
                      rowsToFill = {},
                      i,
                      c;
//alert(1);
                  /*  for (i = 0; i < ilen; i++) {
                      // if oldVal is empty
                      if (changes[i][2] === null && changes[i][3] !== null) {
                        if (isEmptyRow(instance, changes[i][0])) {
                          // add this row/col combination to cache so it will not be overwritten by template
                          rowColumnSeen[changes[i][0] + '/' + changes[i][1]] = true;
                          rowsToFill[changes[i][0]] = true;
                        }
                      }
                    }
                    for (var r in rowsToFill) {
                      if (rowsToFill.hasOwnProperty(r)) {
                        for (c = 0; c < clen; c++) {
                          // if it is not provided by user in this change set, take value from template
                          if (!rowColumnSeen[r + '/' + c]) {
                            changes.push([r, c, null, tpl[c]]);
                          }
                        }
                      }
                    }*/
                  }
                });
              resetState = document.querySelector('.reset-state');
              stateLoaded = document.querySelector('.state-loaded');

              Handsontable.Dom.addEvent(resetState, 'click', function() {
                hot.runHooks('persistentStateReset');
                hot.updateSettings({
                  columnSorting: true,
                  manualColumnMove:true,
                  manualColumnResize: true
                });
                stateLoaded.style.display = 'none';
                hot.render();
              });
              hot.runHooks('persistentStateLoad', '_persistentStateKeys', storedData);
                Handsontable.Dom.addEvent(load, 'click', function() {  alert(1);
                  ajax('json/load.json', 'GET', '', function(res) {
                    var data = JSON.parse(res.response);

                    hot.loadData(data.data);
                    exampleConsole.innerText = 'Data loaded';
                  });
                });

                Handsontable.Dom.addEvent(save, 'click', function() {
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

                Handsontable.Dom.addEvent(autosave, 'click', function() {
                  if (autosave.checked) {
                    exampleConsole.innerText = 'Changes will be autosaved';
                  }
                  else {
                    exampleConsole.innerText ='Changes will not be autosaved';
                  }
                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
        </script>
        <script language="JavaScript">
            $(document).ready(function(){
     $('td').click(function(){     
      var row_index = $(this).parent().index();    
      var col_index = $(this).index(); 
      console.log(row_index+"."+col_index); });
     // $('#formula').on('blur',function(){

     // });
   });
        </script>
    </body>
</html>
