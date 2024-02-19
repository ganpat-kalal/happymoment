
var targetName="nova-pagging";
var M_target; // Main target : table

var perpage=""; // ketla record te samaye dekhava joiye
var search_box=""; // searching 
var column_hs=""; // column ne hide ane show karva mate
var get_report=""; // report melavava mate : excel , pdf , text
var paginate=""; // page no ni tab banavava mate : same as google footer tab
var rec_detail=""; // record found thay 6 teni details
var perpage_val=[5,10,25,50,100,"All"];
var total_rec=0;
var paginate_tab=0;
var tbodydata;
var base=0;
var start=0;
var end=0;
var search_val;
var tot_found_rec=0;


var limit =0;


try{
    limit=mylimit;
}
catch(e){
    limit=5;
}


$(document).ready(function(){
   
    if($("table").hasClass(targetName))
        {
            M_target=$("."+targetName);
            $.fn.createExtraTag();
            
            perpage.change(function(){
               
                $.fn.createpagination(1);
                
            });
            search_box.keyup(function(){
               search_val=$(this).val();
                $.fn.crateSearching();
            });
            
            column_hs.find("input").click(function () {
                
                var myval=parseInt($(this).val());
                $("." + targetName + " tbody tr td:nth-child(" + (myval+1) + ")").fadeToggle(1000);
                $("." + targetName + " thead tr th:nth-child(" + (myval+1) + ")").fadeToggle(1000);
                
            });
            /*paginate.find("li").on("click",paginate.find(".hello"),function(){
               alert(); 
            });*/
        }
});

$.fn.createExtraTag=function()
{
    
    
    
    // header
    
    // perpage select karva mate
    perpage='<span class="input-group-addon header" >';
        perpage+='<select class="'+targetName+'-perpage"></select>';
    perpage+='</span>';
    
    // searching box 
    search_box='<input type="search" class="form-control '+targetName+'-search_box header" placeholder="Search Here....."/> ';
    
    //column hide / show karva mate
    
    column_hs='<div class="input-group-btn header">';
    column_hs+='<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column hide / show <span class="caret"></span></button>';
    column_hs+='<ul class="dropdown-menu dropdown-menu-right '+targetName+'-column_hs"></ul></div>';
    
    
    
    // report mate : excel | pdf | text
    get_report='<div class="input-group-btn header">';
    get_report+='<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Get Report In <span class="caret"></span></button>';
    get_report+='<ul class="dropdown-menu dropdown-menu-right '+targetName+'-get_report">';
    get_report+='<li class="pdfme"><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>';
    get_report+='<li class="excelme"><a href="#"><i class="fa fa-file-excel-o"></i> Excel</a></li>';
    get_report+='<li class="textme"><a href="#"><i class="fa fa-file-text-o"></i> Text</a></li>';
    get_report+='</ul>';
    get_report+='</div>';
    
    M_target.before(perpage).before(search_box).before(column_hs).before(get_report);
    
    perpage=$("."+targetName+"-perpage");
    search_box=$("."+targetName+"-search_box");
    column_hs=$("."+targetName+"-column_hs");
    get_report=$("."+targetName+"-get_report");
    
    
    perpage.parent("span").add(search_box).add(column_hs.parent("div")).add(get_report.parent("div")).wrapAll('<div class="input-group"></div>');
    
    
    //$(".header").wrapAll('<div class="input-group"></div>');
    
    // footer
    
    paginate='<nav aria-label="Page navigation"><ul class="pagination '+targetName+'-paginate"></ul>';
    
    rec_detail=paginate+'<div class="'+targetName+'-rec_detail" style="float:right;">Record 1 to 5 from 44</div><div style="clear:both;"></div></nav>';
    
    
    M_target.after(rec_detail);
    
    paginate=$("."+targetName+"-paginate");
    rec_detail=$("."+targetName+"-rec_detail");
    
    //fill perpage select box
    perpage_val.forEach(function(ppv)
    {
       perpage.append("<option value='"+ppv+"'>"+ppv+"</option>");
    });
    
    tbodydata=M_target.find("tbody").find("tr");
    
    
    
    var colname;
    M_target.find("thead").find("th").each(function(){
        
        var col_val=column_arr[$(this).index()];
        
        colname = $(this).text();
        if(col_val==0 || col_val==1)
            {
                $(this).attr(targetName+"-search",col_val);  
            }
        else{
                $(this).attr(targetName+"-search","1");  
            }
        
        if(col_val==1 || col_val!=0)
            {
                column_hs.append("<li><label><input type='checkbox' checked value='" +$(this).index()  + "'/> " + colname + "</label></li>");
            }
        
        
    });
    
    
    var mycss="";
    mycss+="<style type='text/css'>";
    mycss+="."+targetName+" + nav ul li{";
    mycss+="padding:10px;\n\
            margin-right:5px;\n\
            cursor:pointer;";
    mycss+="}";
    mycss+="."+targetName+" + nav ul li.active{";
    mycss+="border-bottom:solid 2px #c03;\n\
            ";
    mycss+="}";
    mycss+="</style>";
    
    
    
    
    $("body").append(mycss);
    
    
    
    $.fn.createpagination(1);
    
    
};

$.fn.createpagination=function(b/*base*/){
    base=b;
    
    paginate.empty();
    
    total_rec=tbodydata.length;
    
    if(tot_found_rec!=0 || search_box.val()!="")
        {
            total_rec=tot_found_rec;
        }
    
    
    perpage_val=perpage.val();
    
    paginate_tab=Math.ceil(total_rec/perpage_val);
    
    
    var st = base - (Math.floor(limit / 2));
    var ed = parseInt(base) + (Math.floor(limit / 2));
    
    if (paginate_tab > limit) {
        if (st <= 1) {
            st = 1;
            ed = limit;
        }
        if (ed >= paginate_tab) {
            ed = paginate_tab;
            st = ed - limit + 1;
        }
    }
    else{
        st=1;
        ed=paginate_tab;
    }
    
    
    
    var dis=(base==1)?"hidden":"visible";
    
    paginate.append("<li class='btn-first ' style='visibility:"+dis+"'><</li>");
    paginate.append("<li class='btn-prev ' style='visibility:"+dis+"'><<</li>");
    
    for(var i=st;i<=ed;i++)
        {
            var ac=(i==base)?"active":"";
            paginate.append("<li class='"+ac+"'>"+i+"</li>");
        }
    
    var dis=(base==paginate_tab)?"hidden":"visible";
    
    if(total_rec!=0)
    {
    paginate.append("<li class='btn-next' style='visibility:"+dis+"'>>></li>");
    paginate.append("<li class='btn-last' style='visibility:"+dis+"'>></li>");
    }
    
    
    
    
    
    paginate.find("li").click(function(){
        
        
        if($(this).hasClass("btn-first"))
            {
                $.fn.createpagination(1);
                return false;
            }
        
        if($(this).hasClass("btn-last"))
            {
                $.fn.createpagination(paginate_tab);
                return false;
            }
        
        if($(this).hasClass("btn-prev"))
            {
                $.fn.createpagination(base-1);
                return false;
            }
        if($(this).hasClass("btn-next"))
            {
                $.fn.createpagination((base+1));
                return false;
            }
        
        var base_val=parseInt($(this).text());
        $.fn.createpagination(base_val);
        
    });
    
    
    
    end=base*perpage_val;
    start=end-perpage_val;
    
    
    tbodydata.hide();
    
    for(var i=start;i<=(end-1);i++)
        {
            if(tot_found_rec!=0 || search_box.val()!="")
                {
            tbodydata.filter(".syes").eq(i).fadeIn(1000);
                }
            else{
                tbodydata.eq(i).fadeIn(1000);
            }
        }
    
    if(total_rec<end)
        {
            end=total_rec;
        }
    
    var rec=(total_rec==0)?"<font color='red'>Recored Not Found</font>":"Record "+(start+1)+" to "+end+" from "+total_rec;
    
    rec_detail.html(rec);
    
    
};
$.fn.crateSearching=function(){
    var found=false;
    tbodydata.each(function(){
        
        $(this).find("td").each(function(){
           var container_val=$(this).text();
            //rec_detail.append(container_val);
            
            var chk_column=(1==M_target.find("thead").find("th").eq($(this).index()).attr(targetName+"-search"))?true:false;
            
            if(chk_column)
            {
            var regexp=new RegExp(search_val,'i');
           
            if(regexp.test(container_val))
                {
                    found=true;
                    return false;
                }
            else{
                
                found=false;
            }
            }
            
        });
        
        if(found==true)
            {
                $(this).show();
                if(!$(this).hasClass("syes"))
                {
                    $(this).addClass("syes");
                }
                
            }
        else{
            $(this).hide();
                if($(this).hasClass("syes"))
                {
                    $(this).removeClass("syes");
                }
        }
        
    });
    
    //tot_found_rec=M_target.find("tbody").find("tr").filter(".syes").length;
    tot_found_rec=M_target.find("tbody").find(".syes").length;
    $.fn.createpagination(1);
};






















