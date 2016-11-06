 $(document).ready(function() {
     // $('#container').on('focusout', '.estimate_text', function() {
     //     var id_name = $(this).attr('id');
     //     var cel_name = $(this).data('attr');
     //     var col_index = $(this).data('id');
     //     // var formula_def = "=SUM("+cel_name+"1:"+cel_name+String(total_index)+")";
     //     var formula_def = $(this).val();
     //     update_cells(id_name, cel_name, col_index, formula_def);
     // });
     // $('#example1').on('focusout', 'td', function() {

     // });

      $('#container').on('blur', '.range_text', function() {
      	// =IF($H13>'Overview(Phase1)'!$B$20,"H",(IF($H13>'Overview(Phase1)'!$B$21,"M","L")))
         var id_name = $(this).attr('id');
         var cel_name = $(this).data('attr');
         var col_index = $(this).data('id');
         // var formula_def = "=SUM("+cel_name+"1:"+cel_name+String(total_index)+")";
         // var formula_def = $(this).val();
         update_range();
     });
      $('#container').on('blur', '.estimate_text', function() {
         var id_name = $(this).attr('id');
         var cel_name = $(this).data('attr');
         var col_index = $(this).data('id');
         // var formula_def = "=SUM("+cel_name+"1:"+cel_name+String(total_index)+")";
         // var formula_def = $(this).val();
         update_cells(col_index);
     });
     $('.estimate_text').trigger('blur');
 });
function insert_new_row(index){
	hot.setDataAtCell(index, 0, '');
	hot.setDataAtCell(index, 1, '');
	hot.setDataAtCell(index, 2, 0);
	hot.setDataAtCell(index, 3, '=C1*0%');
	hot.setDataAtCell(index, 4, '=C1*0%');
	hot.setDataAtCell(index, 5, '=C1*0%');
	hot.setDataAtCell(index, 6, "=SUM(C1:F1)");
	hot.setDataAtCell(index, 7, "=G1");
	hot.setDataAtCell(index, 8, "=IF(H1>100,'H',(IF(H1>10,'M','L')))");
}
 function update_range() {
 	var low_val = $('#low_val_text').val()!=''?$('#low_val_text').val():0;
 	var high_val = $('#high_val_text').val()!=''?$('#high_val_text').val():0;
 	// =IF($H13>$B$20,"H",(IF($H13>$B$21,"M","L")))
 	// =IF(H4>10,'H',(IF(H4>0'M','L')))
 	var i=0;
		var total_index = total_row - 1;
		for(i=0;i<total_index;i++){
			var range_formula_val ="=IF(H"+parseInt(i+1)+">"+high_val+",'H',(IF(H"+parseInt(i+1)+">"+low_val+",'M','L')))";
			hot.setDataAtCell(i, 8, range_formula_val);
		}
 }
 function apply_formula(index){
 	console.log();
 }
function update_cells(col_index) {
	var col_vals = {3:'d',4:'e',5:'f',6:'g',7:'h',8:'i'};
	var text_vals ={1:'',2:'',3:'design_val_text',4:'testing_val_text',5:'ba_val_text',6:'total_val_text',7:'buffer_val_text',8:''}; 
	var formula_def = '';
	if(typeof(col_index)!='undefined' && text_vals.col_index!=''){
		var text_id = text_vals[col_index];
		formula_def = $('#'+text_id).val()+'%';
	}
	if(formula_def!='' && formula_def!='%'){
		var i=0;
		var total_index = total_row - 1;
		for(i=0;i<total_index;i++){
			var code_cal = hot.getDataAtCell(i, 2);
			var code_formula = Math.round(((code_cal*formula_def)/100),5);
			var code_formula_val ="=C"+parseInt(i+1)+"*"+formula_def+"";
			hot.setDataAtCell(i, col_index, code_formula_val);
			var total_code_formula ="=SUM(C"+parseInt(i+1)+":F"+parseInt(i+1)+")";
			hot.setDataAtCell(i, 6, total_code_formula);
			if($('#buffer_val_text').val() > 0 ){
				var buffer_value = $('#buffer_val_text').val()+'%';
				var total_col_ind_val = hot.getCell(parseInt(i), 6).innerHTML;
 				var buffer_val = "=G"+parseInt(i+1)+"+"+buffer_value+"*G"+parseInt(i+1);
				hot.setDataAtCell(i, 7, buffer_val);
			}
		}
	}
	update_total();
 //     var col_formula_def = "=SUM("+cel_name+"1:"+cel_name+String(total_index)+")";
 //     hot.setDataAtCell(total_index, col_index, col_formula_def);
 }

 // function update_total1(id_name, cel_name, col_index, formula_def) {
 //     var total_index = total_row - 1;
 //     // var formula_def = "=SUM("+cel_name+"1:"+cel_name+String(total_index)+")";
 //     hot.setDataAtCell(total_index, col_index, formula_def);
 //     hot.setDataAtCell(total_index, 0, "Total : ");
 //     hot.setDataAtCell(total_index, 1, "");
 //     hot.setDataAtCell(total_index, 8, "");
 //     hot.setDataAtCell(total_index, col_index, formula_def);
 //     var dev_val = hot.getDataAtCell(total_index, 2) != null ? hot.getDataAtCell(total_index, 2) : 0;
 //     var design_val = hot.getDataAtCell(total_index, 3) != null ? hot.getDataAtCell(total_index, 3) : 0;
 //     // console.log(hot.getDataAtCell(total_index, 3));
 //     var testing_val = hot.getDataAtCell(total_index, 4) != null ? hot.getDataAtCell(total_index, 4) : 0;
 //     var ba_val = hot.getDataAtCell(total_index, 5) != null ? hot.getDataAtCell(total_index, 5) : 0;
 //     var total_val = hot.getDataAtCell(total_index, 6) != null ? hot.getDataAtCell(total_index, 6) : 0;
 //     var buffer_val = hot.getDataAtCell(total_index, 7) != null ? hot.getDataAtCell(total_index, 7) : 0;
 //     $('#dev_val').html(dev_val);
 //     $('#design_val').html(design_val);
 //     $('#testing_val').html(testing_val);
 //     $('#ba_val').html(ba_val);
 //     $('#total_val').html(total_val);
 //     $('#buffer_val').html(buffer_val);
 // }
 function update_total(){

 	var col_vals = {2:'c',3:'d',4:'e',5:'f',6:'g',7:'h'};
 	var total_index = total_row ;
 	$.each(col_vals,function(key,value){
 		     var col_formula_def = "=SUM("+value+"1:"+value+String(total_index)+")";
 		     // console.log(col_formula_def+"   "+total_index+ " " +key);
		    	hot.setDataAtCell(total_index, parseInt(key), col_formula_def);
 	});
 	var dev_val = hot.getCell(total_index, 2).innerHTML != null ? hot.getCell(total_index, 2).innerHTML : 0;
     var design_val = hot.getCell(total_index, 3).innerHTML != null ? hot.getCell(total_index, 3).innerHTML : 0;
     // console.log(hot.getDataAtCell(total_index, 3));
     var testing_val = hot.getCell(total_index, 4).innerHTML != null ? hot.getCell(total_index, 4).innerHTML : 0;
     var ba_val = hot.getCell(total_index, 5).innerHTML != null ? hot.getCell(total_index, 5).innerHTML : 0;
     var total_val = hot.getCell(total_index, 6).innerHTML != null ? hot.getCell(total_index, 6).innerHTML : 0;
     var buffer_val = hot.getCell(total_index, 7).innerHTML != null ? hot.getCell(total_index, 7).innerHTML : 0;
     $('#dev_val').html(dev_val);
     $('#design_val').html(design_val);
     $('#testing_val').html(testing_val);
     $('#ba_val').html(ba_val);
     $('#total_val').html(total_val);
     $('#buffer_val').html(buffer_val);

 }
 $(document).on('keypress', ".numeric", function(e) {
        if (window.event) {

            var charCode = window.event.keyCode;
            //var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
        }
        else if (e) {

            var charCode = e.which;
        }
        else {
            return true;
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 45 && charCode != 46) {
            return false;
        }
        return true;
    });