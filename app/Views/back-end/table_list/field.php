<?=$this->extend('master');?>

<?=$this->section('template_user')?>

<?=$this->endSection()?> 


<?=$this->section('content')?>
<link rel="stylesheet" href="<?php echo base_url("assets/libs/gridstack/gridstack.css"); ?>"/>


<style>
.gridframe{
	border:3px solid #E3E0E0;
}
.grid-stack{
	min-height:40px;
}
.grid-stack-item{
	height:140px;
} 
.grid-stack_hide{ 
	color:#666666;
	opacity:80%;
}
</style>
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18"> นำเข้า Excel</h4>
            </div>
        </div>
    </div>
    <div class="button-items text-right">
        <a href="<?php echo base_url('back-end/table_list/') ?>" class="btn btn-danger btn-md waves-effect waves-light"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div id="wf_space" class="card-body">
                    <div class="card-block">
                        <div class="grid-stack">
                            <!-- <div class="grid-stack grid-stack-instance-7585" data-gs-current-height="1" style="height: 75px;">
                                <div data-gs-x="0" data-gs-y="0" data-gs-width="3" data-gs-height="1" class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide">
                                    <div class="grid-stack-item-content ui-draggable-handle">0</div>
                                    <div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90; display: none;"></div>
                                </div>
                                <div data-gs-x="3" data-gs-y="0" data-gs-width="3" data-gs-height="1" class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide">
                                    <div class="grid-stack-item-content ui-draggable-handle">1</div>
                                    <div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90; display: none;"></div>
                                </div>
                                <div data-gs-x="6" data-gs-y="0" data-gs-width="3" data-gs-height="1" class="grid-stack-item ui-draggable ui-resizable ui-resizable-autohide">
                                    <div class="grid-stack-item-content ui-draggable-handle">2</div>
                                    <div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90; display: none;"></div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-sm-right">
                <a href="#!" onclick="get_save()" class="btn btn-success">
                    <i class="fas fa-check"></i> บันทึก
                </a>
            </div>
        </div> <!-- end col -->
    </div>

</div>

<?=$this->endSection()?> 

<?=$this->section('combottom_js_user')?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>
<script src="<?php echo base_url("assets/libs/gridstack/gridstack.js"); ?>"></script>
<script src="<?php echo base_url("assets/libs/gridstack/gridstack.jQueryUI.js"); ?>"></script>  
<script type="text/javascript">
$('.grid-stack').gridstack({
    width: 12,
    cellHeight: 75,
    alwaysShowResizeHandle: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
});

 $(function () {
            // thanks to http://stackoverflow.com/a/22885503
            var waitForFinalEvent=function(){var b={};return function(c,d,a){a||(a="I am a banana!");b[a]&&clearTimeout(b[a]);b[a]=setTimeout(c,d)}}();
            var fullDateString = new Date();
            function isBreakpoint(alias) {
                return $('.device-' + alias).is(':visible');
            }
            var options = {
                float: false
            };
            $('.grid-stack').gridstack(options);
            function resizeGrid() {
                var grid = $('.grid-stack').data('gridstack');
                if (isBreakpoint('xs')) {
                    $('#grid-size').text('One column mode');
                } else if (isBreakpoint('sm')) {
                    grid.setGridWidth(3);
                    $('#grid-size').text(3);
                } else if (isBreakpoint('md')) {
                    grid.setGridWidth(6);
                    $('#grid-size').text(6);
                } else if (isBreakpoint('lg')) {
                    grid.setGridWidth(12);
                    $('#grid-size').text(12);
                }
            };
            $(window).resize(function () {
                // waitForFinalEvent(function() {
                //     resizeGrid();
                // }, 300, fullDateString.getTime());
            });
            new function () {
                this.serializedData = [
                    {x: 0, y: 0, width: 3, height: 1},
                    {x: 3, y: 0, width: 3, height: 1},
                    {x: 6, y: 0, width: 3, height: 1},
                ];
                this.grid = $('.grid-stack').data('gridstack');
                this.loadGrid = function () {
                    this.grid.removeAll();
                    var items = GridStackUI.Utils.sort(this.serializedData);
                    _.each(items, function (node, i) {
                        this.grid.addWidget($('<div><div class="grid-stack-item-content" data-gs-no-resize="true"><div class="">ทดสอบ<span ondblclick="bsf_label();"><i class="fa fa-comment-o"></i></span></div>' + i + '</div></div>'),
                            node.x, node.y, node.width, node.height);
                    }, this);
                    return false;
                }.bind(this);

                this.loadGrid();
                resizeGrid();
            };
        });
      
</script>


<?=$this->endSection()?> 
