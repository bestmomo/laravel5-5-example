@if (auth()->check())
    <script src="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.js"></script>

    <script>

    var post = (function () {

        var onReady = function () {
            $('body').on('click', 'a.deletecomment', deleteComment)
                .on('click', 'a.editcomment', editComment)
                .on('click', '.btnescape', escapeComment)
                .on('submit', '.comment-form', submitComment)
                .on('click', 'a.reply', replyCreation)
                .on('click', '.btnescapereply', escapeReply)
                .on('submit', '.reply-form', submitReply)
        }

        var toggleEditControls = function (id) {
            $('#comment-edit' + id).toggle()
            $('#comment-body' + id).toggle('slow')
            $('#comment-form' + id).toggle('slow')
        }

        // Delete comment
        var deleteComment = function (event) {
            event.preventDefault()
            var that = $(this)
            swal({
                title: "{!! __('Really delete this comment ?') !!}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{!! __('Yes') !!}",
                cancelButtonText: "{!! __('No') !!}"
            }).then(function () {
                that.next('form').submit()
            })
        }

        // Set comment edition
        var editComment = function (event) {
            event.preventDefault()
            var i = $(this).attr('id').substring(12);
            $('form.comment-form textarea#message' + i).val($('#comment-body' + i).text())
            toggleEditControls(i)
        }

        // Escape comment edition
        var escapeComment = function (event) {
            event.preventDefault()
            var i = $(this).attr('id').substring(14)
            toggleEditControls(i)
            $('form.comment-form textarea#message' + i).prev().text('')
        }

        // Submit comment
        var submitComment = function (event) {
            event.preventDefault();
            $.ajax({
                method: 'put',
                url: $(this).attr('action'),
                data: $(this).serialize()
            })
                .done(function (data) {
                    $('#comment-body' + data.id).text(data.message)
                    toggleEditControls(data.id)
                })
                .fail(function(data) {
                    var errors = data.responseJSON
                    $.each(errors, function(index, value) {
                        value = value[0].replace(index, '@lang('message')')
                        $('form.comment-form textarea[name="' + index + '"]').prev().text(value)
                    });
                });
        }

        // Set reply creation
        var replyCreation = function (event) {
            event.preventDefault()
            var i = $(this).attr('id').substring(12)
            $('form.reply-form textarea#message' + i).val('')
            $('#reply-form' + i).toggle('slow')
        }

        // Escape reply creation
        var escapeReply = function (event) {
            event.preventDefault()
            var i = $(this).attr('id').substring(12)
            $('#reply-form' + i).toggle('slow')
        }

        // Submit reply
        var submitReply = function (event) {
            event.preventDefault()
            $.ajax({
                method: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize()
            })
                .done(function (data) {
                    document.location.reload(true)
                })
                .fail(function(data) {
                    var errors = data.responseJSON
                    $.each(errors, function(index, value) {
                        value = value[0].replace(index, '@lang('message')')
                        $('form.reply-form textarea[name="' + index + '"]').prev().text(value)
                    });
                });
        }

        return {
            onReady: onReady
        }

    })()

    $(document).ready(post.onReady)

    </script>
@endif



<script>
    $(function() {
        // Get next comments
        $('#nextcomments').click (function(event) {
            event.preventDefault()
            $('#morebutton').hide()
            $('#moreicon').show()
            $.get($(this).attr('href'))
                .done(function(data) {
                    $('ol.commentlist').append(data.html)
                    if(data.href !== 'none') {
                        $('#nextcomments').attr('href', data.href)
                        $('#morebutton').show()
                    }
                    $('#moreicon').hide()
                })
        })
    })
</script>
