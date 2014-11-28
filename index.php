<?php
error_reporting(E_ALL^E_NOTICE);
require_once("bootstrap.php");
require_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.1/jquery.qtip.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.1/jquery.qtip.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #d2d1d0;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        }
        .called-in {
            color:#444;
            font-size: 11px;
            font-style: italic;
        }
        .code-url
        {
            color: #0084b4 !important;
            text-decoration: none !important;
        }
        .line-nr {
            color: #000000;
        }
        .sub-section {
            display: none;
            cursor: pointer;
            background-color: #f5f5f5;
        }
        ul {
            list-style: none;
        }
        .list-group-item {
            border-right: 0 !important;
            border-bottom: 0 !important;
            border-top: 0 !important;
            background-color: #f5f5f5;
        }
        .list-group {
            background-color: #f5f5f5;
        }
        .glyphicon {
            margin-left: -15px !important;
        }
        .header-part {
            padding-left:50px;
        }
        .modal-body{
            max-height: 100%;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            //code browser; open model; load file
            $(".code-url").click(function(event) {
                event.stopPropagation();
                var src = $(this).attr('data-src');
                var line = $(this).attr('data-line');
                $('#code-text').load('get_code.php?file=' + encodeURIComponent(src) +'&hline=' + encodeURIComponent(line), function(){
                    $(".modal").animate({ scrollTop: $('#highlightedline').offset().top }, 1000, function(){
                        $('.modal-backdrop').css('height',$('.modal-content').height());
                    });

                });
                $('#modalCode').modal('show');
            });

            //coder browse lines
            $(".list-group-item").click(function(event){
                event.stopPropagation();
                $(this).children(".sub-section").toggle('fast', function(){
                    if ($(this).siblings('.glyphicon').hasClass('glyphicon-chevron-right'))
                        $(this).siblings('.glyphicon').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
                    else
                        $(this).siblings('.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');

                });
            });

            //show first line
            $(".sub-section").first().show('fast', function(){
                $(this).siblings('.glyphicon').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
            });

            //toolip for parameters
            $(document).on('mouseover', '.call-params', function(event) {
                // Bind the qTip within the event handler
                $(this).qtip({
                    overwrite: false, // Make sure the tooltip won't be overridden once created
                    content: {
                        text: function(event, api) {
                            // Retrieve content from custom attribute of the $('.selector') elements.
                            return $(this).attr('qtip-content');
                        }
                        //button: true
                    },
                    show: {
                        event: event.type, // Use the same show event as the one that triggered the event handler
                        ready: true // Show the tooltip as soon as it's bound, vital so it shows up the first time you hover!
                    }
                }, event); // Pass through our original event to qTip
            })
                // Store our title attribute in 'oldtitle' attribute instead
                .each(function(i) {
                    $.attr(this, 'oldtitle', $.attr(this, 'title'));
                    /*$(this).removeAttribute('title'); */
                });
        });

    </script>
</head>
<body>
<!-- Modal -->
<div class="modal fade" style="position: fixed;" id="modalCode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Code Browser</h4>
            </div>
            <div class="modal-body"><div class="code-text" id="code-text"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
$cfg         = new Config($config);
$file        = new SplFileObject($cfg->path . $cfg->file, "r");
$linePrinter = new LinePrinter($cfg->exclude_path);
$fileReader  = new FileReader($file, $linePrinter);
$header      = new HeaderPrinter();

$header->printHeader($file);
?>

<ul class='list-group'>
    <?php
        $fileReader->printLines();
    ?>
</ul>