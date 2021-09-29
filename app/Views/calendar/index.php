<?=$this->extend('master');?>

<?=$this->section('template_user')?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/libs/calendar/css/fullcalendar.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/libs/calendar/css/fullcalendar.print.css"); ?>" media='print'>
<?=$this->endSection()?> 

<?=$this->section('content')?>
<style>
    .fc th {
    
        border-color: #fff !important; 
    }
    .fc th.fc-widget-header {
        background: #00c69e;
    }
        tr:first-child > td > .fc-day-grid-event {
        margin-top: 2px;
        margin-left: 2px;
        padding-left: 5px;
    } 
    tr > td > .fc-day-grid-event {
        margin-top: 2px;
        margin-left: 2px;
        padding-left: 5px;
    } 
    .fc-unthemed .fc-today {
        color:#000;
    }
    .fc-event, .fc-event:hover, .ui-widget .fc-event {
        color: #000;
    }
    .fc-event {
        line-height: 1.6 !important;
    }
    .fc-end{
        text-align: left !important;
    }

    /* .modal-lg {
        max-width: 1200px;
    } */
    </style>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">ข้อมูลผู้ใช้งาน</h4>
            </div>
        </div>
    </div>
    <?php 
		// $session = session();
		// $arr_menu = $session->get('user_menu');
		// $user_displaymenu = $session->get('user_displaymenu');
		// if($user_displaymenu == "A"){ 
		// 	foreach($arr_menu as $key=>$val){
		// 		foreach($val as $key2=>$val2){
		// 			if($val2['menu_code'] == $menu_code){
		// 				if($key > 0){
		// 					$link_back =  base_url("menu/".$key);	
		// 				}else{
		// 					$link_back =  base_url("menu");
		// 				}
		// 			}
		// 		}
		// 	}
		// }else{
		$link_back =  base_url("menu");
		// }
		// $gtxt_menu = "";
		// function m_get_parent($G,$arr_menu){
		// 	global $gtxt_menu;
		// 	foreach($arr_menu  as $k=>$val){
		// 		foreach($val as $kk=>$M){
		// 			if ($M['menu_code'] == $G){ 
		// 				$txt = " <li class=\"breadcrumb-item\"><a href=\"".base_url($M['menu_url'])."\">".$M['menu_name_th']."</a></li> ";
		// 				$gtxt_menu = $txt.$gtxt_menu;
		// 				if($k > 0){
		// 					m_get_parent($k,$arr_menu );
		// 				}
		// 			}
		// 		}
		// 	}
			
		// }

        if($isBreadcrumb){
    ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('menu/') ?>">หน้าแรก</a></li>
						<?php 
							//  m_get_parent(3,$arr_menu); 
							//  echo $gtxt_menu;
						?>
                      
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php        
        }
    ?>
    <div class="button-items text-right">
        <a href="<?php echo base_url('user_account/aut_group/create') ?>" class="btn btn-primary waves-effect waves-light"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>
        <a href="<?php echo $link_back; ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-home"></i> กลับหน้าหลัก</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <form name="form_search" id="form_search" method="post" action="<?php echo base_url('user_account/aut_group/') ?>">
                       
                        <div class="f-left">
                            <u>คำอธิบายเพิ่มเติม:</u><br>
                            <svg width="55" height="20"><rect width="55" height="20" style="fill:rgb(133, 200, 255);stroke-width:3;stroke:rgb(33, 50, 89 )"></rect><text x="15" y="15" fill="black" font-size="10pt">สีฟ้า</text></svg>&nbsp;คือ ลาราชการ&nbsp;
                            <svg width="55" height="20"><rect width="55" height="20" style="fill:rgb(245, 176, 0);stroke-width:3;stroke:rgb(245, 124, 0)"></rect><text x="15" y="15" fill="black" font-size="10pt">สีส้ม</text></svg>&nbsp;คือ ตารางกิจกรรม (ราชการ)
                            <svg width="55" height="20"><rect width="55" height="20" style="fill:rgb(246, 114, 0);stroke-width:3;stroke:rgb(245, 124, 0)"></rect><text x="15" y="15" fill="black" font-size="10pt">สีส้ม</text></svg>&nbsp;คือ ตารางกิจกรรม (ส่วนตัว)
                            <svg width="55" height="20"><rect width="55" height="20" style="fill:rgb(245, 176, 0);stroke-width:3;stroke:rgb(245, 124, 0)"></rect><text x="15" y="15" fill="black" font-size="10pt">สีส้ม</text></svg>&nbsp;คือ ยังไม่อนุมัติจองห้อง
                        </div>
                        <br>
                        <div id='calendar'></div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?=$this->endSection()?> 

<?=$this->section('combottom_js_user')?>
<script src="<?php echo base_url("assets/libs/calendar/js/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/libs/calendar/js/fullcalendar.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/libs/calendar/js/locale-all.js"); ?>"></script> 
<script>
window.CallParent = function(id,title) {
	$('#external-events').append('<div class="fc-event ui-draggable ui-draggable-handle" data-id="'+id+'" data-color="#F9EA57">'+title+'</div>');
	  $('#external-events .fc-event').each(function() {

    // store data so the calendar knows to render an event upon drop
    $(this).data('event', {
      title: $.trim($(this).text()), // use the element's text as the event title
      stick: true, // maintain when user navigates (see docs on the renderEvent method)
	  id: $(this).data("id"),
      color: $(this).data("color")
	  
    });

    // make the event draggable using jQuery UI
    /*$(this).draggable({
      zIndex: 999,
      revert: true, // will cause the event to go back to its
      revertDuration: 0 //  original position after the drag
    });*/

  });
}
$(document).ready(function() {

var initialLocaleCode = 'th';
  /* initialize the external events
  -----------------------------------------------------------------*/

  $('#external-events .fc-event').each(function() {

    // store data so the calendar knows to render an event upon drop
    $(this).data('event', {
      title: $.trim($(this).text()), // use the element's text as the event title
      stick: true, // maintain when user navigates (see docs on the renderEvent method)
	  id: $(this).data("id"),
      color: $(this).data("color")
    });

    // make the event draggable using jQuery UI
    /*$(this).draggable({
      zIndex: 999,
      revert: true, // will cause the event to go back to its
      revertDuration: 0 //  original position after the drag
    });*/

  });


  /* initialize the calendar
  -----------------------------------------------------------------*/
	//var myColor;

  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title', 
      right: '' //month,agendaWeek,agendaDay,listMonth
    },
	height:850,
//	timeZone: 'UTC',
	defaultDate: '2021-06-17', 
    locale: initialLocaleCode,
	businessHours: true,
    /*editable: true,
    droppable: true, // this allows things to be dropped onto the calendar
    drop: function(start) {
	console.log("drop");
    var myID = $(this).data("id");
	var startFix= $.fullCalendar.formatDate(start, 'YYYY-MM-DD');
	var endFix= '';*/
	// update_calendar(myID,startFix,endFix);
    // $(this).remove();
    /*},*/
    events: [],//'../save/profile_calendar.php'
	eventRender: function(eventObj, $el) { 
        $el.popover({
          html : true,
          content: eventObj.description,
          trigger: 'hover',
          placement: 'top',
          container: 'body'
        });
    },
    eventClick: function(event) {
        window.open(event.url, 'gcalevent', 'width=760,height=500, scrollbars=yes, resizable=yes');
        return false;
	},
	dayClick: function(date, jsEvent, view) { 
		// var startFix= $.fullCalendar.formatDate(date, 'YYYY-MM-DD');
		// var room_id = "";
		// if(room_id != ''){ room_s = "&ROOM_NO="+room_id; }else{ room_s = ''; }
		// var d = new Date(startFix);
		// var meeting_date = ('0' + d.getDate()).slice(-2) + '/' + ('0' + (d.getMonth()+1)).slice(-2) + '/' + (d.getFullYear()+543);
		// window.location.href = "../workflow/meeting_calendar_report.php?W=6682&TPAGE=calendar"+room_s+"&MEETING_DATE="+meeting_date;
    },loading: function(bool) {
    //   alert()
    }

    
  });
  
	// $( ".fc-prev-button" ).click(function() {
	// 	console.log($(".fc-center").find('h2').html());
	// 	var text_center = $(".fc-center").find('h2').html();
	// 	var room_id = "";
	// 	get_list_meeting(text_center,room_id);
	// });
	// $( ".fc-next-button" ).click(function() {
	// 	console.log($(".fc-center").find('h2').html());
	// 	var text_center = $(".fc-center").find('h2').html();
	// 	var room_id = "";
	// 	get_list_meeting(text_center,room_id);
	// });

});
</script>
<?=$this->endSection()?> 
