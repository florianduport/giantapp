$(document).ready(function(){
    $("#displayUpdatePassword").click(function(){
        $(this).addClass("hidden");
        $(this).next("div").removeClass("hidden");
        $("input[name=updatePassword]").val(true);
        $("input[name=newPassword]").attr("required", "required");
        $("input[name=newPassword]").attr("autofocus", "autofocus");
    });
});