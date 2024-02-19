<script src="js/app.js" type="text/javascript"></script>
<script src="js/backstretch.js"></script>
<script src="vendors/countupcircle/js/jquery.countupcircle.js" type="text/javascript"></script>
<script src="vendors/granim/js/granim.min.js" type="text/javascript"></script>
<script src="vendors/flotchart/js/jquery.flot.js" type="text/javascript"></script>
<script src="vendors/flotchart/js/jquery.flot.resize.js" type="text/javascript"></script>
<script src="vendors/flotchart/js/jquery.flot.time.js" type="text/javascript"></script>
<script src="vendors/flotchart/js/jquery.flot.symbol.js" type="text/javascript"></script>
<script src="vendors/flotchart/js/jquery.flot.pie.js" type="text/javascript"></script>
<script src="vendors/flotchart/js/jquery.flot.stack.js" type="text/javascript"></script>
<script src="vendors/flot.tooltip/js/jquery.flot.tooltip.js" type="text/javascript"></script>
<script src="vendors/flotspline/js/jquery.flot.spline.min.js" type="text/javascript"></script>
<script type="text/javascript" src="vendors/chartist/js/chartist.min.js"></script>
<script type="text/javascript" src="vendors/morrisjs/morris.min.js"></script>
<script type="text/javascript" src="vendors/d3/d3.min.js"></script>
<script type="text/javascript" src="vendors/nvd3/js/nv.d3.min.js"></script>
<script type="text/javascript" src="js/custom_js/stream_layers.js"></script>
<script src="vendors/bower-jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="vendors/bower-jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>
<script src="js/dashboard1.js" type="text/javascript"></script>
<script src="js/jquery.bvalidator.js" type="text/javascript"></script>
<script src="js/set.js" type="text/javascript"></script>
<script src="js/custom_js/jquery-3.2.0.min.js" type="text/javascript"></script>
<script type="text/javascript">

var cc = 1;
var c = 0;

function auto_logout()
{
    //alert(c);
        
    function increament()
    {
        //alert(cc);
        //$("#demo").html(cc);
        cc++;
        if(cc == 180)
        {            
            window.location.href = "logout.php";
        }
    }
        
    c++;
    if(c == 1)
    {
        s = setInterval(increament,1000);
    }
    else
    {
        cc = 0;
    }
}

<?php
    if(isset($_SESSION['user']))
    {
?>
    $(document).ready(function(){
        
        auto_logout();
        
        $("body").keyup(function(){
            //alert('ha press thyu');
            auto_logout();
        });
        
        $("body").click(function(){
            //alert('ha click thyu');
            auto_logout();
        });
    });
    
<?php
    }
?>
</script>