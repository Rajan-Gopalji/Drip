$(":radio").on("change", function(){
    var total = 0;
    $(":radio:checked").each(function(){
        total += Number(this.value);
    });

    $("#total").text(total);
});

