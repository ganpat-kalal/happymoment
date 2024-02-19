
function report(act,idd)
{
    //alert(act+" "+idd);
    var data = { action : "searchreport",type:act, id : idd };
    $.post("backend.php",data,function(result)
    {
        //alert(result);
       $("#bill").html(result);
    });
}

function rp(min,max)
{
    //alert(min+" "+max);
    var data = { action : "searchreport",type:"price", minprice:min, maxprice:max};
    $.post("backend.php",data,function(result)
    {
        //alert(result);
       $("#bill").html(result);
    });
}

function bll(min,max)
{
    //alert(min+" "+max);
    var data = { action : "searchbill",type:"price", minprice:min, maxprice:max};
    $.post("backend.php",data,function(result)
    {
        //alert(result);
       $("#bill").html(result);
    });
}

function billss(act,idd)
{
    //alert(act+" "+idd);
    var data = { action : "searchbill",type:act, id : idd };
    $.post("backend.php",data,function(result)
    {
        //alert(result);
       $("#bill").html(result);
    });
}

function activation(act,st,idd)
{
    //alert(act+" "+st+" "+idd);
    var data = { action : act, status : st,id : idd };
    $.post("backend.php",data,function(result){
        
        //alert(result);
        $("#"+act).html(result);
    });
}

function set_combo(act,idd)
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