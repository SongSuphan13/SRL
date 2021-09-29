   <!-- JAVASCRIPT -->
   
    <script src="<?php echo base_url("assets/libs/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/libs/metismenu/metisMenu.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/libs/simplebar/simplebar.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/libs/node-waves/waves.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/libs/sweetalert/js/sweetalert.js"); ?>"></script>
    <script src="<?php echo base_url("assets/libs/jquery-mask-plugin/jquery.mask.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/libs/autonumeric/autoNumeric-min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/libs/select2/js/select2.full.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/libs/bootstrap-datepicker3/bootstrap-datepicker.js"); ?>"></script>
    <script src="<?php echo base_url("assets/libs/slimscroll/js/jquery.nicescroll.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/libs/slimscroll/js/jquery.slimscroll.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/app.js"); ?>"></script> 
    <script>
      $( document ).ready(function() {
            $(".autonumber").autoNumeric("init")   
            $(".num").autoNumeric('init', {aSep: '', aDec: ',', mDec: '0'});
            $('.datepicker').mask('99/99/9999');
            $('.datepicker:not([readonly])').datepicker({
                  format: "dd/mm/yyyy",
                  language: "th-th",
                  autoclose: true,
                  todayHighlight: true
            }); 
            $('.idcard').mask('9-9999-99999-99-9');  
            $('select.select2').select2({
                  allowClear: true,
                  placeholder: function(){
                        $(this).data('placeholder');
                  }
            });
            $("input[type='file'][multiple]").change(function (e,v){
                  var input = document.getElementById(this.id);
                  var img_name = [];
                  for (var x = 0; x < input.files.length; x++) {
                        img_name[x] = input.files[x].name;
                  }
                  // $(this).siblings('.custom-file-label').html(img_name.join(', '));
                 $(this).siblings('.custom-file-label').html('เลือกไฟล์ทั้งหมด '+img_name.length +' ไฟล์');
            });
            $("input[type='file'][single]").change(function (e,v){
                  var pathArray = $(this).val().split('\\');
                  var img_name=pathArray[pathArray.length - 1];
                  // $(this).siblings('.custom-file-label').html(img_name);
                  $(this).siblings('.custom-file-label').html('เลือกไฟล์ทั้งหมด '+pathArray.length +' ไฟล์');
            });
      });
         $(".idcard").blur(function (){
               var id_len = $(this).val().length;
               if(id_len > 0){
               var data = $(this).val().split('-');
               if(chkIDcard(data[0],data[1],data[2],data[3],data[4])){
                     $(this).addClass("bsf-success");
                     $(this).removeClass("is-invalid");
               }else{
                     $(this).addClass("is-invalid");
                     $(this).removeClass("bsf-success");
                     alert("กรุณากรอกข้อมูลให้ถูกต้อง");
                     $(this).val('');
                     $(this).focus();
               }
               }else{
                     $(this).removeClass("is-invalid");
                     $(this).removeClass("bsf-success");
               }
         });
         $(".email").blur(function (){
            var em_len = $(this).val().length;
            if(em_len > 0){
               if(valid2EMail($(this).val())){
                     $(this).addClass("bsf-success");
                     $(this).removeClass("is-invalid");
               }else{
                     $(this).addClass("is-invalid");
                     $(this).removeClass("bsf-success");
                     alert("กรุณากรอกข้อมูลให้ถูกต้อง");
                     $(this).val('');
                     $(this).focus();
               }
            }else{
                  $(this).removeClass("is-invalid");
                  $(this).removeClass("bsf-success");
            }
         });
         function valid2EMail(mailObj){
            if (validLength(mailObj,1,50)){
               //return false;
               if (mailObj.search("^.+@.+\\..+$") != -1)
                  return true;
               else return false;
            }
            return true;
         }
         function validLength(item,min,max){
            return (item.length >= min) && (item.length<=max)
         }
         function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                  return false;
            }
            return true;
         }
            function chkIDcard (SubCardID1,SubCardID2,SubCardID3,SubCardID4,SubCardID5) {
			var CardID=SubCardID1+SubCardID2+SubCardID3+SubCardID4+SubCardID5;
			var FcardID=(CardID.substr(0,1))*13;
			for(i=1;i<12;i++) {
				var subNum = CardID.substr(i,1);
				FcardID=parseInt(FcardID)+ (parseInt(subNum)*(14-(i+1)));
			}
			chk=CardID.substr(CardID.length-1,1);
			temp=11-(parseInt(FcardID)%11);
			temtStr=temp+'';
			chkAnswer=temtStr.substr(temtStr.length-1,1);
			if(parseInt(chk)==parseInt(chkAnswer)) {
				return true;
			} else {
				return false;
			}
	      }
         function get_amphure(province_obj,amphur_obj,tambon_obj,zipcode_obj,default_data){
            var dataString = 'province_code='+$('select#'+province_obj).val();
            var txt_a = 'เลือกอำเภอ';
            if($('select#'+province_obj).val()=='10'){ txt_a = ''; }
            $.ajax({
                  type: "POST",
                  url: baseUrl+"/Allprocess/getAmphure/",
                  data: dataString,
                  cache: false,
                  dataType: 'json',
                  success: function(html){
                        $('select#'+amphur_obj).html('').select2({data: [{id:'', text: txt_a,disabled: true,selected:true}]});
                        $('select#'+amphur_obj).select2({data: html});
                        $('select#'+amphur_obj).select2("open"); 
                        $('select#'+amphur_obj).select2("close"); 
                        if(tambon_obj != ""){
                              $('select#'+tambon_obj).html('').select2({data: [{id:'', text: '',disabled: true,selected:true}]});	
                        }
                        if(zipcode_obj != ""){
                              $('#'+zipcode_obj).val('');
                        }
                  }
            });
         }
         function get_tambon(province_obj,amphur_obj,tambon_obj,zipcode_obj,default_data){
            
               var dataString = 'amphure_code='+$('select#'+amphur_obj).val();
               var txt_a = 'เลือกตำบล';
               var txt_a = 'เลือกตำบล';
                  if($('select#'+amphur_obj).val() != ''){
                        if($('select#'+amphur_obj).val().substring(0, 2)=='10'){ txt_a = 'เลือกแขวง'; }
                  }

               $.ajax({
                        type: "POST",
                        url: baseUrl+"/Allprocess/getTambon/",
                        data: dataString,
                        cache: false,
                        dataType: 'json',
                        success: function(html){
                              $('select#'+tambon_obj).html('').select2({data: [{id:'', text: txt_a,disabled: false,selected:true}]});
                              $('select#'+tambon_obj).select2({ data: html,allowClear:true  });
                              $('select#'+tambon_obj).select2("open"); 
                              $('select#'+tambon_obj).select2("close");
                              if(zipcode_obj != ""){
                                    $('#'+zipcode_obj).val('');
                              }
                        }
               });
         }
         function get_zipcode(province_obj,amphur_obj,tambon_obj,zipcode_obj){
            if(zipcode_obj != "" ){
               var dataString = ' tambon_code='+$('#'+tambon_obj).val();
               $.ajax({
                     type: "POST",
                     url: baseUrl+"/Allprocess/getZipcode/",
                     data: dataString,
                     cache: false,
                     success: function(html){
                           $('#'+zipcode_obj).val(html);
                     } 
               });
            }
         }
         function showError(text){
            swal({
					title: text, 
					type: "error",
               showCancelButton: true,
               confirmButtonClass: "btn-danger",
               confirmButtonText: "ตกลง",
               closeOnConfirm: false,
               showCancelButton: false,
				});
         }
         function showSuccess(text,url){
            swal({
					title: text, 
					type: "success",
               showCancelButton: false,
               showConfirmButton: false
				});
            setTimeout(function(){
                  window.location.href= url;
            }, 800);
         }
      function number_format(num,digit) {
            var p = num.toFixed(digit).split(".");
            var x= p[0].split("").reverse().reduce(function(acc, num, i, orig) {
                   return  num + (i && !(i % 3) ? "," : "") + acc;
            }, "");
            if(digit > 0){
                  return x + "." + p[1];
            }else{
                  return x;
            }                
      }
      function show_modal(url, head, modal_id){
            var id = typeof modal_id === 'undefined' ? 'acaraiModal' : modal_id;
            $('#'+id+' .modal-title').text(head);
            $('#'+id+' .modal-body').load(url);
      }
      function search_modal(url,body_id,form_id){	
            // $.get(url,$('#'+form_id).serialize(),function(msg){
            //       $('#'+body_id).html(msg);			
            // });
      }
      $(".select2-single-amphur").select2({
            ajax: {
                  url: "../process/load_area.php",
                  dataType: 'json',
                  delay: 250,
                  data: function(params) { 
                        return {
                              qa: params.term
                        };
                  },
                  processResults: function (data) {
                  return {
                        results: $.map(data, function(obj) {
                              return { id: obj.id, text: obj.text };
                        })
                  };
                  },
                  cache: true
            },
            minimumInputLength: 2
      });
    </script>

<div class="modal fade modal-flex" id="srlModal1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog modal-xl " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close srl-close-modal" data-number="srlModal1" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body" id="srlbody1">
 
			</div>
			<div class="modal-footer">
                        <button type="button" class="btn btn-primary srl-save-modal" id="save-modal" >ตกลง</button>
				<button type="button" class="btn btn-danger srl-close-modal" data-number="srlModal1">ปิด</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-flex" id="srlModal2" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog modal-xl " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close srl-close-modal" data-number="srlModal2" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body" id="srlbody2">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger srl-close-modal" data-number="srlModal2">ปิด</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-flex" id="srlModal3" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close srl-close-modal" data-number="srlModal3" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body" id="srlbody3">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger srl-close-modal" data-number="srlModal3">ปิด</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-flex" id="srlModal4" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close srl-close-modal" data-number="srlModal4" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body" id="srlbody4">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger srl-close-modal" data-number="srlModal4">ปิด</button>
            </div>
        </div>
    </div>
</div>
<script>
      $('button.srl-close-modal').click(function() {
        var modal_number = $(this).attr('data-number');
        var modal_id = $(this).parents(':eq(3)').attr('id');

        $('#' + modal_number).modal('hide');
        $('#' + modal_id + ' .modal-title, #' + modal_id + ' .modal-body').html('');
      });
</script>
                     
