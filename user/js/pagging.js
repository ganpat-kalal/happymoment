var mydata = "";

for (var i = 1; i <= 44; i++)
{
    mydata += "<tr >";
    mydata += "<td>" + i + "</td>";
    mydata += "<td>Roshan" + i + "</td>";
    mydata += "<td>Varachha" + i + "</td>";
    mydata += "</tr>";
}

$(".mydata").html(mydata);

var classname = "hm-pagging";
var M_target;
var select_box = "";
var search_box = "";
var columm_hd = "";
var report_in = "";
var paginate = "";
var rec_detail = "";
var totcolumm = 0;
var totrec = 0;
var perpage = 5;
var total_page = 0;
var perpage_value = ["5", "10", "25", "50"];
var page_no = 0;
var start = 0;
var end = 0;

$(document).ready(function () {
    if ($("table").hasClass(classname)) {
        M_target = $("." + classname);
        $.fn.createExtraTag();
        select_box.change(function () {
            $.fn.pagination(1);
        });
        search_box.keyup(function () {
            alert("searching");
        });
        columm_hd.find("input").click(function () {
            $("." + classname + " tbody tr td:nth-\n\
        child(" + $(this).val() + ")").fadeToggle(1000);
            $("." + classname + " thead tr th:nth-\n\
        child(" + $(this).val() + ")").fadeToggle(1000);
        });
    }
});
$.fn.createExtraTag = function ()
{
    select_box = "<div class='input-group-addon'><select class='" + classname + "-perpage'></select></div>";
    search_box = '<input class="' + classname + '-search form-control" placeholder="search here....">';

    columm_hd = '<div class="input-group-btn">';
    columm_hd = '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span></button>';
    columm_hd = '<ul class="' + classname + '-colummhd dropdown-menu dropdown-menu-right"><li><a href="#">Action</a></li></ul></div><div>';

    report_in = '<div class="input-group-btn">';
    report_in += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Get Report In <Span class="caret"></span></button>';
    report_in += '<ul class="' + classname + '-reportin dropdown-menu dropdown-menu-right">';
    report_in += '<li><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>';
    report_in += '<li><a href="#"><i class="fa fa-file-excel-o"></i> Excel</a></li>';
    report_in += '<li><a href="#"><i class="fa fa-file-text-o"></i> Text</a></li>';
    report_in += '</ul></div></div>';

    M_target.before(select_box).before(search_box).before(columm_hd).before(report_in);
    select_box = $("." + classname + "-perpage");
    search_box = $("." + classname + "-search");
    columm_hd = $("." + classname + "-colummhd");
    report_in = $("." + classname + "-reportin");

    select_box.parent("div").add(search_box).add(columm_hd.parent("div")).add(report_in.parent("div")).wrapAll("<div class='input-group'></div>");

    paginate = '<ul class="pagination' + classname + '-paginate" style="margin:0;"></ul>';
    rec_detail = '<span style="float:right;">Recored 1 to 5 from 44 </span><div style="clear:both"></div>';
    M_target.after(rec_detail).after(paginate);
    paginate = $("." + classname + "-paginate");

    perpage_value.forEach(function (myval)
    {
        select_box.append("<option value='" + myval + "'>" + myval + "</option>");
    });

    select_box.append("<option value='All'>All</option>");

    totrec = M_target.find("tbody").find("tr").length;

    totcolumm = M_target.find("thead").find("th").length;

    var colname;
    for (var i = 1; i <= totcolumm; i++)
    {
        colname = M_target.find("thead").find("th").eq(i - 1).text();

        columm_hd.append("<li><label><input type='checkbox' checked value='" + i + "'/> " + colname + "</label></li>");
    }

    $.fn.pagination(1);
};
$.fn.pagination = function (base) {
    page_no = base;

    paginate.empty();

    perpage = select_box.val();
    end = perpage * page_no;
    start = end - perpage;
    end--;

    if (page_no === 1)
    {
        paginate.append("<li style='display:none;' ><a href='#'><i class='fa fa-caret-left'></i></a></li>");
    } else {
        paginate.append("<li><a href='#'><i class='fa fa-caret-left'></i></a></li>");
    }
    total_page = (Math.ceil(totrec / perpage));
    for (var i = 1; i <= total_page; i++) {
        paginate.append("<li><a href='#'>" + i + "</a></li>");
    }
    if (page_no === total_page)
    {
        paginate.append("<li style='display:none;' ><a href='#'><i class='fa fa-caret-right'></i></a></li>");
    } else {
        paginate.append("<li><a href='#'><i class='fa fa-caret-right'></i></a></li>");
    }

    paginate.find("li").eq(page_no).addClass("active");

    paginate.find("li").click(function () {

        var ind = $(this).index();
        var activeno = 0;
        var lastactive = paginate.find(".active").text();
        activeno = $(this).text();

        if (ind === 0)
        {
            activeno = parseInt(lastactive) - 1;
        } else if ((total_page + 1) === ind) {
            activeno = parseInt(lastactive) + 1;
        }

        $.fn.pagination(activeno);
    });

    M_target.find("tbody").find("tr").hide();

    for (var i = start; i <= end; i++)
    {
        M_target.find("tbody").find("tr").eq(i).show();
    }
};