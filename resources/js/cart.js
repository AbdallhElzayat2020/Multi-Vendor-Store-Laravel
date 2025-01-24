(function ($) {
    $(".item-quantity").on("click", function (e) {
        $.ajax({
            URL: "cart/" + $(this).data("id"),
            method: "POST",
            data: {
                quantity: $(this).data("quantity"),
                _token: csrf_token,
            },
        });
    });
})(JQuery);
