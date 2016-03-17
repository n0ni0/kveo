$('#submitButton').on('click', function (e) {
    e.preventDefault();
    var $form = $('#commentForm');

    var $media = 13;

    $.ajax({
        type: "POST",
        dataType: "json",
        //url: Routing.generate('create_comment', { media: $media}),
        url : $form.attr('action'),
        data: $form.serialize(),
        cache: false,
        success: function (response) {
           // $('.comment-text').load(window.location + ' .comment-text >  *');
            location.reload();
            console.log(response);
        },
        error: function (response) {
            console.log(response);
        }
    });
});