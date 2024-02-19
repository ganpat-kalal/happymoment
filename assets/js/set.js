

function main_search()
{
    //alert(value);
    var value = $("#transcript").val();
    if(value == "")
    {
        $(".search").html("");
    }
    else
    {
        $(".search").html("<center><img src='image/p.gif' width='15%' /></center>");
    c = 0;

    var s = setInterval(function () {
        c++;
        if (c == 1)
        {
            clearInterval(s);
            $data = {action: "main_search", id: $("#transcript").val()};
            $.post("backend.php", $data, function (data)
            {
                $(".search").html(data);
            });
        }
    }, 500);
    }
    
}

$(document).on("click","#filter-form input[type='checkbox']",function(){
    $data = $("#filter-form").serialize();
    pro($data);
});


var filter_url = "";
var read_more_url  ="";
var lmt = 9;
function load_pro(data)
{
    filter_url = data;
    pro();
}
function pro(data)
{
    var data = data+"&"+filter_url+"&action=pro";
    read_more_url = data;
    //alert(data);
    $.post("backend.php",data,function(result)
    {
       $("#filter-data").html(result);
    });
}
function view_more()
{
    $("#read_more").remove();
    var data = read_more_url+"&limit="+lmt;
    //alert(data);
    $.post("backend.php",data,function(result)
    {
       $("#filter-data").append(result);
    });
    lmt+=3;
}

function promo(idd)
{
    //alert(idd);
    var data = {action: "promo", id: idd};
    $.post("backend.php", data, function (result)
    {
        //alert(result);
        $("#setpromo").html(result);
    });
}

function c_address(idd)
{
    //alert(idd);
    $("#setaddress").html('<div style="padding: 20px"><center><i class="fa fa-shopping-bag" style="color: #ddd; font-size: 50px" ></i><br/><h1 style="color: #ddd">Loading....!</h1></center></div>');
    
    var data = {action: "c_address", id: idd};
    $.post("backend.php", data, function (result)
    {
        //alert(result);
        $("#setaddress").html(result);
    });

}

function add_wish(idd)
{
    $("#status" + idd).html("<img src='./image/heart.gif' style='width:35px; height:35px'/>");
    c = 0;

    var s = setInterval(function () {
        c++;
        if (c == 1)
        {
            clearInterval(s);
            $data = {action: "add_wish", id: idd};
            $.post("backend.php", $data, function (data)
            {
                if (data == "login")
                {
                    window.location.href = "login.php";
                }
                if(data == 1)
                {
                //  alert(data);
                $("#status" + idd).html("<button title='Wished' data-placement='top' data-toggle='tooltip' style='border: none;background: red;margin-left: -1px;margin-top:-2px;border-radius: 13px;padding: 4px 7px;' type='button'><i class='fa fa-heart'></i></button>");
                $(document).ready(function ()
                    {
                        $(".back-layer3").css("display","block");
                    });
                }
            });
        }
    }, 1000);
}

function add_cart(idd)
{
    
    $("#stat" + idd).html("<img src='./image/heart.gif' style='width:35px; height:35px'/>");
    c = 0;

    var s = setInterval(function () {
        c++;
        if (c == 1)
        {
            clearInterval(s);
            $data = {action: "add_cart", id: idd};
            $.post("backend.php", $data, function (data)
            {
                if (data == "login")
                {
                    window.location.href = "login.php";
                }
                if(data == 1)
                {
                    //alert();
                    header_cart();
                    $("#stat" + idd).html("<button title='Carted' data-placement='top' data-toggle='tooltip' data-placement='top' style='border: none;background: red;margin-left: -4px;border-radius: 13px;padding: 4px 6px;' type='button'><i class='fa fa-shopping-basket'></i></button>");
                    $(document).ready(function ()
                    {
                        $(".back-layer2").css("display","block");
                    });
                }
            });
        }
    }, 1000);
}

function qty_change(idd, qtyy)
{
    var data = {action: "qty_change", id: idd, qty: qtyy};
    $.post("backend.php", data, function (result) {
        cart_data();
    });
}

function cart_data()
{
    var data = {action: "cart_data"};
    $.post("backend.php", data, function (result)
    {
        $("#cart_data").html(result);
    });
}

function remove_cart(idd)
{
    //alert(idd);
    if (confirm("Are you sure to want remove !"))
    {

        $("#cart_data").html('<div style="padding: 40px"><center><i class="fa fa-shopping-bag" style="color: #ddd; font-size: 40px" ></i><br/><h1 style="color: #ddd">Your cart is updating....!</h1></center></div>');
        c = 0
        var s = setInterval(function ()
        {
            c++;
            if (c == 1)
            {
                var data = {action: "remove_cart", id: idd};
                $.post("backend.php", data, function (result)
                {
                    cart_data();

                });
            }
        }, 1000);
    }
}

function add_sub(id) {

    var email = document.getElementById('sub_email').value;

    var ptn = /^([a-zA-Z\d_\.\-\+%])+\@(([a-zA-Z\d\-])+\.)+([a-zA-Z\d]{2,4})+$/;

    if (email.match(ptn))
    {
        var data = {action: 'add_subscriber', id: email};
        $.post("backend.php", data, function (result) 
        {
            //$("#" + id).html(result);
            if(result === "insert")
                {
                    //alert(result);
                    $(document).ready(function ()
                    {
                        $(".back-layer5").css("display","block");
                    });
                }
            if(result == "already")
                {
                    $(document).ready(function ()
                    {
                        $(".back-layer7").css("display","block");
                    });
                }
        });
    } 
    else
    {
       $(document).ready(function ()
        {
            $(".back-layer6").css("display","block");
        });
    }

}

function add_review(idd)
{
    var msg = document.getElementById('review-msg').value;

    if (msg !== "")
    {
        $data = {action: 'review_msg', id: idd, value: msg};
        $.post("backend.php", $data, function (data)
        {
            //alert(data);
            if(data === '1')
                {
                    //alert(result);
                    $(document).ready(function ()
                    {
                        $(".back-layer4").css("display","block");
                    });
                }
        });
    } else
    {
        alert("plz insert review!");
    }
}

function img_preview(idd)
{
    var data = {action: "img_preview", id: idd};
    $.post("backend.php", data, function (result) {
        //alert(result);
        $("#img-preview").html(result);

    });
}

function close_layer(id)
{
    $("."+id).css("display","none");
}

function header_cart()
{
    var data = {action: "header_cart"};
    $.post("backend.php", data, function (result) {
        //alert(result);
        $("#header_cart").html(result);

    });
}