$(document).ready(function(){
    
    $(".list-group-item").click(function(){
        if(!$("#helpContent").hasClass("hidden"))
            $("#helpContent").addClass("hidden");
        var $ul = $(this).next("ul");
        if($ul.hasClass("hidden"))
        {
            $(".list-group ul").each(function(){
                if($(this) !== $ul)
                    $(this).addClass("hidden");
            });
            $ul.removeClass("hidden");
        }
        else
            $ul.addClass("hidden");
    });
    
    $(".list-group ul li a").click(function(){
        $("#helpContent").removeClass("hidden");
    });
});