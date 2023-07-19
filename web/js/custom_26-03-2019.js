


var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/web/";



function viewmodal(obj,event)
{
    event.preventDefault();
    var url = obj.getAttribute("href");
    console.log(url);
    var dialog = bootbox.dialog({
        title: $(this).text(),
        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
        size:'large',

    });

    dialog.init(function(){
        var request = $.ajax({
            url: url,
            method: "GET",
        });

        request.done(function( msg ) {
            dialog.find('.bootbox-body').html(msg);
        });

    });
}


$(".view-modal").click(function(event){
    event.preventDefault();
    var url = $(this).attr("href");
    var dialog = bootbox.dialog({
        title: $(this).text(),
        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
        size:'large',

    });

    dialog.init(function(){
        var request = $.ajax({
            url: url,
            method: "GET",
        });

        request.done(function( msg ) {
            dialog.find('.bootbox-body').html(msg);
        });

    });

});

$(".add-later").click(function(event){
    event.preventDefault();
    var url = $(this).attr("href");
    bootbox.confirm("Are You Sure Pay Later ?", function(result){ if(result==true){

        $.ajax({
            type: "GET",
            url: url,
            data: $("#form").serialize(),
            // serializes the form's elements.
            success: function(data)
            {
                if(data==true)
                {


                    window.location  = baseUrl+"site/pending-department-bill";

                }


            }
        });

    } });



});


$(".add-payment").click(function(event){
    event.preventDefault();
    var url = $(this).attr("href");
    var dialog = bootbox.dialog({
        title: $(this).text(),
        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',

    });

    dialog.init(function(){
        var request = $.ajax({
            url: url,
            method: "GET",
        });

        request.done(function( msg ) {
            dialog.find('.bootbox-body').html(msg);
        });

        $(document).on("submit", "#form", function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();


            $form = $(this); //wrap this in jQuery

            var url = $form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: $("#form").serialize(),
                // serializes the form's elements.
                success: function(data)
                {
                    var obj = JSON.parse(data);
                    if(obj.status==true)
                    {
                        bootbox.hideAll();
                        var url = baseUrl+"site/print-bill?id="+obj.id;
                        var width = 900;
                        var  height = 700;
                        console.log('//////////////////////////////////// Print External ///////////////////////////////////////');
                        var printWindow = window.open(url, 'Print', 'left=100, top=100, width=' + width + ', height=' + height + ', toolbar=0, resizable=0');
                        printWindow.addEventListener('load', function(){
                            printWindow.print();
                            printWindow.close();
                        }, true);

                        toastr.success('', 'Payment Sucessfully', {timeOut: 2000});
                        
                    }
                    else 
                    {
                        toastr.success('', 'Some Error Occur', {timeOut: 2000});

                    }
                    
                    location.reload();

                }
            });
            // avoid to execute the actual submit of the form.

        });

    });

});


$(".add-new").click(function(event){
    event.preventDefault();
    var url = $(this).attr("href");
    var dialog = bootbox.dialog({
        title: $(this).text(),
        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',

    });

    dialog.init(function(){
        var request = $.ajax({
            url: url,
            method: "GET",
        });

        request.done(function( msg ) {
            dialog.find('.bootbox-body').html(msg);
        });

        $(document).on("submit", "#form", function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();


            $form = $(this); //wrap this in jQuery

            var url = $form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: $("#form").serialize(),
                // serializes the form's elements.
                success: function(data)
                {
					//console.log(data);					
                    if(data==true)
                    {
                        $.pjax.reload({container:'#p0'});
                        bootbox.hideAll();
                    }


                }
            });
            // avoid to execute the actual submit of the form.

        });

    });

});



function addnew(event,obj) {

    event.preventDefault();
    var url = obj.getAttribute("href");
    console.log(obj.text);
    var dialog = bootbox.dialog({
        title: obj.text,
        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',

    });

    dialog.init(function(){
        var request = $.ajax({
            url: url,
            method: "GET",
        });

        request.done(function( msg ) {
            dialog.find('.bootbox-body').html(msg);
            //console.log("Yeah");
            //$(".bootbox.modal.fade.show").css( "border", "33px solid red" );
            //$(".bootbox.modal.fade.show").prop('tabIndex', '');
            $(".bootbox.modal.fade.show").removeAttr("tabIndex");											 
        });

        $(document).on("submit", "#form", function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $(this).submit(function() {
                return false;
            });



            $form = $(this); //wrap this in jQuery

            var url = $form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: $("#form").serialize(),
                // serializes the form's elements.
                success: function(data)
                {
                    if(data==true)
                    {
                        $.pjax.defaults.timeout = 5000;
                        $.pjax.reload({container:'#p0'});
                        bootbox.hideAll();
                    }


                }
            });
            // avoid to execute the actual submit of the form.

        });

    });
	//console.log("Hi");				

};


function addWithAttachment(event,obj) {

    event.preventDefault();
    var url = obj.getAttribute("href");
    console.log(obj.text);
    var dialog = bootbox.dialog({
        title: obj.text,
        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',

    });

    dialog.init(function(){
        var request = $.ajax({
            url: url,
            method: "GET",
        });

        request.done(function( msg ) {
            dialog.find('.bootbox-body').html(msg);
        });

        $(document).on("submit", "#form", function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $(this).submit(function() {
                return false;
            });



            $form = $(this); //wrap this in jQuery

            var url = $form.attr('action');

            var data = new FormData($('#form')[0]);

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                processData: false,
                contentType: false,
                // serializes the form's elements.
                success: function(data)
                {
                    if(data==true)
                    {
                        $.pjax.defaults.timeout = 5000;
                        $.pjax.reload({container:'#p0'});
                        bootbox.hideAll();
                    }


                }
            });
            // avoid to execute the actual submit of the form.

        });

    });

};

/*function updateRecord(id,controller,title,event) {

    event.preventDefault();
    var dialog = bootbox.dialog({
        title: title,
        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
        

    });


    dialog.init(function(){
        var request = $.ajax({
            url: baseUrl+controller+"/update?id="+id,
            method: "GET",
        });

        request.done(function( msg ) {
            dialog.find('.bootbox-body').html(msg);


        });

        $(document).on("submit", "#form", function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();

                $form = $(this); //wrap this in jQuery

                var url = $form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#form").serialize(),
                    // serializes the form's elements.
                    success: function(data)
                    {
                        if(data==true)
                        {
                            toastr.success('', 'Update Successfully', {timeOut: 2000});
                            $.pjax.reload({container:'#p0'});
                            bootbox.hideAll();
                        }
                        else
                        {
                            toastr.success('', 'Some Error Occur', {timeOut: 2000});
                        }


                    }
                });
                // avoid to execute the actual submit of the form.
        });

    });

}*/

function updateRecord(id,controller,title,event,action) {

    event.preventDefault();
    //console.log(typeof(action));
    //console.log(action);
    var dialog = bootbox.dialog({
        title: title,
        message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
    });


    dialog.init(function(){
        if(action){
            //console.log("Yes");
            var request = $.ajax({
                url: baseUrl+controller+"/"+action+"?id="+id,
                method: "GET",
            });
        }
        else{
            //console.log("No");
            var request = $.ajax({
                url: baseUrl+controller+"/update?id="+id,
                method: "GET",
            });
        }
        request.done(function( msg ) {
            dialog.find('.bootbox-body').html(msg);


        });

        $(document).on("submit", "#form", function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();

                $form = $(this); //wrap this in jQuery

                var url = $form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#form").serialize(),
                    // serializes the form's elements.
                    success: function(data)
                    {
                        if(data==true)
                        {
                            toastr.success('', 'Update Successfully', {timeOut: 2000});
                            $.pjax.reload({container:'#p0'});
                            bootbox.hideAll();
                        }
                        else
                        {
                            toastr.success('', 'Some Error Occur', {timeOut: 2000});
                        }


                    }
                });
                // avoid to execute the actual submit of the form.
        });

    });

}

function gridViewDate() {
    $("#m_datepicker_5").datepicker( {
        format: 'dd/mm/yyyy',templates: {
            leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'
        }
    }).change(dateChanged).on('changeDate', dateChanged);
}


$("#m_datepicker_5").datepicker( {
    format: 'dd/mm/yyyy',templates: {
            leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'
        }
    }).change(dateChanged).on('changeDate', dateChanged);

function dateChanged(ev) {
    ev.stopImmediatePropagation();
    var from = $("#startdate").val();
    var to = $("#enddate").val();


    var old = $("#submitPicker").attr("href");

    old = old.substr(0, old.lastIndexOf("?"));

    $("#submitPicker").attr("href", old+"?from="+from+"&to="+to);
}

$(function() {
	//console.log("Yeah");
	// setInterval(function() {
		// $("#m_topbar_notification_icon .m-nav__link-icon").addClass("m-animate-shake"),
		// $("#m_topbar_notification_icon .m-nav__link-badge").addClass("m-animate-blink")
	// }, 3e3);
	$("#m_topbar_notification_icon").click(function() {
		($('span.m-nav__link-badge.m-badge.m-badge--dot.m-badge--dot-small.m-badge--danger').length
			? $( "span.m-nav__link-badge.m-badge.m-badge--dot.m-badge--dot-small.m-badge--danger" ).remove()
			: true),
		$("#m_topbar_notification_icon .m-nav__link-icon").removeClass("m-animate-shake"),
		$("#m_topbar_notification_icon .m-nav__link-badge").removeClass("m-animate-blink")
	});
});

