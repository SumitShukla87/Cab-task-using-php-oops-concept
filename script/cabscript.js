$(document).ready(function () {
    $("#cab").change(function () {
        if ($(this).val() == 1) {
            $("#luggage").attr("disabled", "disabled");
            $("#luggage").val("");
            

        } else {
           
            $("#luggage").removeAttr("disabled");
            $("#luggage").focus();
        }
    });

    $('.lug').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });

    $('.mobile').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });

    $("#btn2").click(function (e) {
        var p = $("#pick").val();
        var d = $("#dr").val();
        var c = $("#cab").val();
        var l = $("#luggage").val();
        if (p == d) {
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
                    $("#res").html("Total fare Is: " + result);
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
