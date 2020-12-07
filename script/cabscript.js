$(document).ready(function () {
    $("#cab").change(function () {
        $("#res").val(0);
        $("#res").hide();
        $("#book").hide();

        if ($(this).val() == 1) {
            $("#luggage").attr("disabled", "disabled");
            $("#luggage").val("");
            

        } else {
           
            $("#luggage").removeAttr("disabled");
            $("#luggage").focus();
        }
    });

    $("#pick").change(function () {
        $("#res").val(0);
        $("#res").hide();
        $("#book").hide();
        
    });
    $("#dr").change(function () {
        $("#res").val(0);
        $("#res").hide();
        $("#book").hide();
      
    });
    $("#luggage").focus(function () {
        $("#res").val(0);
        $("#res").hide();
        $("#book").hide();
        
    });

    $('.lug').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    $('.mobile').keyup(function () {
        this.value = this.value.replace(/[^0-9]/g,'');
    });
    $('.nameclass').keydown(function (e) {
        if (e.ctrlKey || e.altKey) {
            e.preventDefault();
        } else {
            var key = e.keyCode;
            if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                e.preventDefault();
            }
        }
    });
    $("#uname").keyup(function() {
        $(this).val($(this).val().replace(/\s/g, ""));
    });
    $("#lname").keyup(function() {
        $(this).val($(this).val().replace(/\s/g, ""));
    });

    $("#fname").keyup(function() {
        $(this).val($(this).val().replace(/  +/g, ' '));
    });

$(document).on('keypress','.mobile',function(e){
    if($(e.target).prop('value').length>=10){
    if(e.keyCode!=32)
    {return false} 
    }
});

    $("#btn2").click(function (e) {
        var p = $("#pick").val();
        var d = $("#dr").val();
        var c = $("#cab").val();
        var l = $("#luggage").val();
        if (p == d) {
            $("#res").show();
            $("#res").css("display:block");
            $("#res").html("Pick Up and destination can not be same");
        } else {
            $.ajax({
                url: "ajaxdata.php",
                type: 'POST',
                dataType: "text",
                data: {
                    pick: p,
                    dr: d,
                    car: c,
                    w: l

                },
                success: function (result) {
                    $("#res").show();
                    $("#res").html("Total fare Is: Rs." + result );
                    $("#book").show();
                },
                error: function () {

                    alert(error);
                }


            });

        }
        e.preventDefault();

    });
});
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}



