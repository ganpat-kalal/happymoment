function add_cartt(idd)
{
    //alert(idd);
    $data = {action: "add_cartt", id: idd};
    $.post("backend.php", $data, function (data)
        {
            if (data == "login")
            {
                window.location.href = "login.php";
            }
            if(data == 1)
            {
                //alert();
                $("#stat" + idd).html("<button class='btn btn-button global-bg white' style='padding:0px' title='Added to Cart' data-toggle='tooltip' data-placement='top'><i class='fa fa-shopping-cart' style='color:orangered'></i></button>");
            }
        });
}

function bbl(min,max)
{
    //alert(min+" "+max);
    var data = { action : "searchbill",type:"price", minprice:min, maxprice:max};
    $.post("backend.php",data,function(result)
    {
        //alert(result);
       $("#bill").html(result);
    });
}

function bill(act,idd)
{
    //alert(idd);
    var data = { action : "searchbill",type:act, id : idd };
    $.post("backend.php",data,function(result)
    {
       $("#bill").html(result);
    });
}

function set_seller_combo(act,idd)
{
    var data = { action : act, id : idd };
    $.post("backend.php",data,function(result){
        
        $("#"+act).html(result);
        
    });
}

function counter(id,count)
{
    var c = 0;
    var t=count;
    
    var set = setInterval(function(){
        
        if(c < t)
        {
            c++;
            $("#"+id).html(c);
        }
        else
        {
            clearInterval(set);
        }
        
        
    },-5);
    
    
}
