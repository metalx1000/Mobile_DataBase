<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mobile Data Entry</title>
	<link rel="stylesheet" href="themes/basic.min.css" />
	<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile.structure-1.4.3.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>

        <script>
            $(document).ready(function(){
                $("#submit").click(function(){
                    <?php include('submit.js.php');?>
                    var key=generateKey();

                    $.post( "add.php", { 
                        <?php include('post.js.php');?>
                        key_id: key
                    }).done(function( data ) {
                        $("#msg").html(data);
                        clear_msg();

                        <?php include("done.js.php");?>

                        get_json();
                    });                
                });
           
                //click or swipe
                //comment out the one you don't want 
                $("#listview").on('click','li',remove_item);
                $("#listview").on('swipe','li',remove_item);
                
                get_json();
                
            });


            function remove_item(event){
                var pid=$(this).attr("pid");
                $("[pid='" + pid + "']").remove();
                $.post( "remove.php", {
                    PID:pid
                }).done(function( data ) {
                    $("#msg").html(data);
                    clear_msg();
                    get_json();
                });

            }
            function get_json(){
                var url="get.php";
                $.getJSON( url, function( data ) {
                    $('ul').empty();
                    for(var i = 0;i<data.length;i++){
                        <?php include('get.js.php');?>
                        var pid=data[i].PID;

                        var info = '<li pid="' + pid + '" class="rm_item"><a>';
                        info += 'PID is ' + pid;
                        info += '</a></li>';
                        $('ul').append(info);
                    }

                    $('ul').listview('refresh');             
                });
            }

            function generateKey() {
                var length = 8,
                    charset = "abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                    retVal = "";
                for (var i = 0, n = charset.length; i < length; ++i) {
                    retVal += charset.charAt(Math.floor(Math.random() * n));
                }
                return retVal;
            }


            function clear_msg(){
                setTimeout(function(){
                    $("#msg").html('');
                },5000);
            }

            
        </script>
</head>
<body>
	<div data-role="page" data-theme="a">
		<div data-role="header" data-position="inline">
			<h1>Enter Something!</h1>
                        <div id="msg" data-theme="b"></div>
		</div>
		<div data-role="content" data-theme="a">
                    <?php include('content.js.php');?>

                    <button id="submit">Submit</button>

                <hr>
                <div data-role="header" data-position="inline">
                        <h1>Recent Entries</h1>
                </div>

                    <ul id="listview" data-role="listview" data-filter="true" data-inset="true">

                    </ul>
 
		</div>
	</div>
</body>
</html>
