
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

var back = (function () {

    var order = 'created_at'
    var direction = 'desc'

    var pagination = function (event, that, errorAjax) {
        event.preventDefault()
        var href = that.attr('href')
        if (href !== '#') {
            spin()
            load(href, errorAjax)
        }
    }

    var destroy = function (event, that, url, swalTitle, confirmButtonText, cancelButtonText, errorAjax) {
        event.preventDefault()
        swal({
            title: swalTitle,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: confirmButtonText,
            cancelButtonText: cancelButtonText
        }).then(function () {
            ajax(that.attr('href'), 'DELETE', url, errorAjax)
        })
    }

    var seen = function (url, that, errorAjax) {
        var urlSeen = url + '/seen/' + that.val()
        // If "new" is checked we must reload the page
        if(getCheckboxValueByName('new')) {
            ajax(urlSeen, 'PUT', url, errorAjax)
        } else {
            ajaxNoLoad(urlSeen, 'PUT', errorAjax, that)
        }
    }

    var status = function (url, that, errorAjax) {
        var urlActive = url + '/active/' + that.val()
        if(that.is(':checked')) {
            urlActive += '/1'
        }
        // If "active" is checked we must reload the page
        if(getCheckboxValueByName('active')) {
            ajax(urlActive, 'PUT', url, errorAjax)
        } else {
            ajaxNoLoad(urlActive, 'PUT', errorAjax)
        }
    }

    var ordering = function (url, that, errorAjax) {
        order = that.attr('id')
        direction = that.hasClass('fa-sort') || that.hasClass('fa-sort-desc') ? 'asc' : 'desc'
        // Reset selectors
        $('th span').removeClass().addClass('fa fa-fw fa-sort pull-right')
        // Adjust selected
        that.removeClass().addClass('fa fa-fw fa-sort-' + direction + ' pull-right')
        // Load page
        load(url, errorAjax)
    }

    var filters = function (url, errorAjax) {
        spin()
        load(url, errorAjax)
    }

    var ajax = function (target, verb, url, errorAjax) {
        spin()
        $.ajax({
            url: target,
            type: verb
        })
            .done(function () {
                load(url, errorAjax)
            })
            .fail(function () {
                fail(errorAjax)
            }
        )
    }

    var ajaxNoLoad = function (target, verb, errorAjax, that) {
        spin()
        $.ajax({
            url: target,
            type: verb
        })
            .done(function () {
                unSpin()
                that.prop('disabled', true)
            })
            .fail(function () {
                fail(errorAjax)
            })
    }

    var load = function (url, errorAjax) {
        $.get(url, buildParameters())
            .done(function (data) {
                done(data)
            })
            .fail(function () {
                fail(errorAjax)
            }
        )
    }

    var spin = function () {
        $('#spinner').html('<span class="fa fa-spinner fa-pulse fa-3x fa-fw"></span>')
    }

    var unSpin = function () {
        $('#spinner').empty()
    }

    var done = function (data) {
        $('#pannel').html(data.table)
        $('#pagination').html(data.pagination)
        unSpin()
    }

    var fail = function (errorAjax) {
        unSpin()
        swal({
            title: errorAjax,
            type: 'warning'
        })
    }

    var buildParameters = function () {
        return {
            role: getCheckboxValueByName('role'),
            valid: getCheckboxValueByName('valid'),
            confirmed: getCheckboxValueByName('confirmed'),
            new: getCheckboxValueByName('new'),
            active: getCheckboxValueByName('active'),
            order: order,
            direction: direction
        }
    }

    var getCheckboxValueByName = function (name) {
        return $(".box-header input[name='" + name + "']:checked").val()
    }

    return {
        ajax: ajax,
        destroy: destroy,
        pagination: pagination,
        seen: seen,
        status: status,
        ordering: ordering,
        filters: filters,
        spin: spin,
        unSpin: unSpin
    }

})()