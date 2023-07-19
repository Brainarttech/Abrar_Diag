var getUrl = window.location;
var baseUrl =
  getUrl.protocol +
  "//" +
  getUrl.host +
  getUrl.pathname.split("/web")[0] +
  "/web";
function viewmodal(obj, event) {
  event.preventDefault();
  var url = obj.getAttribute("href");
  console.log(url);
  var dialog = bootbox.dialog({
    title: $(this).text(),
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
    size: "large",
  });

  dialog.init(function () {
    var request = $.ajax({
      url: url,
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
    });
  });
}

$(".view-modal").click(function (event) {
  event.preventDefault();
  var url = $(this).attr("href");
  var dialog = bootbox.dialog({
    title: $(this).text(),
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
    size: "large",
  });

  dialog.init(function () {
    var request = $.ajax({
      url: url,
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
    });
  });
});

$(".add-later").click(function (event) {
  event.preventDefault();
  var url = $(this).attr("href");
  bootbox.confirm("Are You Sure Pay Later ?", function (result) {
    if (result == true) {
      $.ajax({
        type: "GET",
        url: url,
        data: $("#form").serialize(),
        // serializes the form's elements.
        success: function (data) {
          if (data == true) {
            window.location = baseUrl + "/site/pending-department-bill";
          }
        },
      });
    }
  });
});

$(".add-payment").click(function (event) {
  event.preventDefault();
  var url = $(this).attr("href");
  var dialog = bootbox.dialog({
    title: $(this).text(),
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
  });

  dialog.init(function () {
    var request = $.ajax({
      url: url,
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
    });

    $(document).on("submit", "#form", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();

      $form = $(this); //wrap this in jQuery

      var url = $form.attr("action");

      $.ajax({
        type: "POST",
        url: url,
        data: $("#form").serialize(),
        // serializes the form's elements.
        success: function (data) {
          var obj = JSON.parse(data);
          if (obj.status == true) {
            bootbox.hideAll();
            var url = baseUrl + "/site/print-bill?id=" + obj.id;
            var width = 900;
            var height = 700;
            console.log(
              "//////////////////////////////////// Print External ///////////////////////////////////////"
            );
            var printWindow = window.open(
              url,
              "Print",
              "left=100, top=100, width=" +
                width +
                ", height=" +
                height +
                ", toolbar=0, resizable=0"
            );
            printWindow.addEventListener(
              "load",
              function () {
                printWindow.print();
                printWindow.close();
              },
              true
            );

            toastr.success("", "Payment Sucessfully", { timeOut: 2000 });
          } else {
            toastr.success("", "Some Error Occur", { timeOut: 2000 });
          }

          location.reload();
        },
      });
      // avoid to execute the actual submit of the form.
    });
  });
});

$(".add-new").click(function (event) {
  event.preventDefault();
  var url = $(this).attr("href");
  var dialog = bootbox.dialog({
    title: $(this).text(),
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
  });

  dialog.init(function () {
    var request = $.ajax({
      url: url,
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
    });

    $(document).on("submit", "#form", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();

      $form = $(this); //wrap this in jQuery

      var url = $form.attr("action");

      $.ajax({
        type: "POST",
        url: url,
        data: $("#form").serialize(),
        // serializes the form's elements.
        success: function (data) {
          //console.log(data);
          if (data == true) {
            $.pjax.reload({ container: "#p0" });
            bootbox.hideAll();
          }
        },
      });
      // avoid to execute the actual submit of the form.
    });
  });
});

function addnew(event, obj) {
  event.preventDefault();
  var url = obj.getAttribute("href");
  console.log(obj.text);
  var dialog = bootbox.dialog({
    title: obj.text,
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
  });

  dialog.init(function () {
    var request = $.ajax({
      url: url,
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
      //console.log("Yeah");
      //$(".bootbox.modal.fade.show").css( "border", "33px solid red" );
      //$(".bootbox.modal.fade.show").prop('tabIndex', '');
      $(".bootbox.modal.fade.show").removeAttr("tabIndex");
    });

    $(document).on("submit", "#form", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();

      $(this).submit(function () {
        return false;
      });

      $form = $(this); //wrap this in jQuery

      var url = $form.attr("action");

      $.ajax({
        type: "POST",
        url: url,
        data: $("#form").serialize(),
        // serializes the form's elements.
        success: function (data) {
          if (data == true) {
            $.pjax.defaults.timeout = 5000;
            $.pjax.reload({ container: "#p0" });
            bootbox.hideAll();
          }
        },
      });
      // avoid to execute the actual submit of the form.
    });
  });
  //console.log("Hi");
}
var reportDialog;
function feedback(event, url) {
  let feedback = prompt("please enter your feedback");
  generateReport(event, url, feedback);
}
function generateReport(event, obj, feedback = "") {
  var url;

  if (!feedback) {
    event.preventDefault();
    var url = obj.getAttribute("href");
  } else {
    $(".bootbox").modal("hide");
    url = obj;
  }
  url = `${url}&feedback=${feedback}`;

  // event.preventDefault();
  // var url = obj.getAttribute("href");
  console.log("In generated report method", obj.text);
  reportDialog = bootbox.dialog({
    title: obj.text,
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
  });

  reportDialog.init(function () {
    var request = $.ajax({
      url: url,
      method: "GET",
    });

    // request.done(function (msg) {
    //     console.log("response" , msg)
    //     var testPdf = `<div id="#PDF" >
    //       <object data="`+JSON.parse(msg).file+`" type="application/pdf"  height="700px" width="100%">
    //           alt : <a href="your.pdf">your.pdf</a>
    //       </object>
    //     </div><button class='btn btn-info' onclick='sendReport(\``+msg+`\` , \``+obj+`\`)'>Send</button>
    //      </div><button class='btn btn-info' onclick='feedback(\``+event+`\` , "`+url+`")'>Remarks</button>`;

    //     reportDialog.find('.bootbox-body').html(testPdf);
    //     //console.log("Yeah");
    //     //$(".bootbox.modal.fade.show").css( "border", "33px solid red" );
    //     //$(".bootbox.modal.fade.show").prop('tabIndex', '');
    //     $(".bootbox.modal.fade.show").removeAttr("tabIndex");
    // });

    request.done(function (msg) {
      console.log("response", msg);
      var testPdf =
        `<div id="#PDF" >
               <object data="` +
        JSON.parse(msg).file +
        `" type="application/pdf"  height="700px" width="100%">
                   alt : <a href="` +
        JSON.parse(msg).file +
        `">Report.pdf</a>
               </object>
            </div><button class='btn btn-info' onclick='sendReport(\`` +
        msg +
        `\` , \`` +
        obj +
        `\`)'>Send</button>
             </div>`;

      reportDialog.find(".bootbox-body").html(testPdf);
      //console.log("Yeah");
      //$(".bootbox.modal.fade.show").css( "border", "33px solid red" );
      //$(".bootbox.modal.fade.show").prop('tabIndex', '');
      $(".bootbox.modal.fade.show").removeAttr("tabIndex");
    });

    //console.log("Hi");
  });
}
function sendReport(jsonObj, obj) {
  jsonObj = JSON.parse(jsonObj);
  var dialog = bootbox.dialog({
    title: obj.text,
    message:
      '<p id="sendingReport"><i class="fa fa-spin fa-spinner"></i> Sending...</p>',
  });
  console.log("Send report clicked For ", jsonObj.regNo);
  var form = new FormData();
  form.append("regNo", jsonObj.regNo);
  form.append("email", jsonObj.email);
  form.append("phone", jsonObj.phone);
  form.append("file", jsonObj.file);
  form.append("url", obj);

  form.append("secret", "cnioaqws78219ydh1u28ckjk");
  $form = $(this); //wrap this in jQuery
  // var url = baseUrl+"../addService.php";
  var url = "../addService.php";
  console.log(url);

  $.ajax({
    method: "POST",
    url: url,
    processData: false,
    contentType: false,
    enctype: "multipart/form-data",
    data: form,
    // serializes the form's elements.
    success: function (data) {
      console.log("send report response data is");
      console.log(data);
      // if (data.search("Error") == -1)
      // {

      //     $.pjax.defaults.timeout = 5000;
      //     $.pjax.reload({container: '#p0'});
      //     console.log(bootbox);
      //     dialog.modal('hide');
      // }else{
      //     $("#sendingReport").html("Something went wrong while sending report please try again.");
      // }

      //updated by nabeel on 01-09-2020

      if (data == 1) {
        /*  $.pjax.defaults.timeout = 5000;
        $.pjax.reload({ container: "#p0" }); */
        console.log(bootbox);
        dialog.modal("hide");
      } else {
        $("#sendingReport").html(
          "Something went wrong while sending report please try again."
        );
      }
      reportDialog.modal("hide");

      // $(".bootbox.modal.fade.show").removeAttr("tabIndex");
    },
  });
  // avoid to execute the actual submit of the form.
}

function addWithAttachment(event, obj) {
  event.preventDefault();
  var url = obj.getAttribute("href");
  console.log(obj.text);
  var dialog = bootbox.dialog({
    title: obj.text,
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
  });

  dialog.init(function () {
    var request = $.ajax({
      url: url,
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
    });

    $(document).on("submit", "#form", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();

      $(this).submit(function () {
        return false;
      });

      $form = $(this); //wrap this in jQuery

      var url = $form.attr("action");

      var data = new FormData($("#form")[0]);

      $.ajax({
        type: "POST",
        url: url,
        data: data,
        processData: false,
        contentType: false,
        // serializes the form's elements.
        success: function (data) {
          if (data == true) {
            $.pjax.defaults.timeout = 5000;
            $.pjax.reload({ container: "#p0" });
            bootbox.hideAll();
          }
        },
      });
      // avoid to execute the actual submit of the form.
    });
  });
}
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

function updateRecord(id, controller, title, event, action) {
  event.preventDefault();
  //console.log(typeof(action));
  //console.log(action);
  var dialog = bootbox.dialog({
    title: title,
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
  });

  dialog.init(function () {
    if (action) {
      //console.log("Yes");
      var request = $.ajax({
        url: baseUrl + "/" + controller + "/" + action + "?id=" + id,
        method: "GET",
      });
    } else {
      //console.log("No");
      var request = $.ajax({
        url: baseUrl + "/" + controller + "/update?id=" + id,
        method: "GET",
      });
    }
    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
    });

    $(document).on("submit", "#form", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();

      $form = $(this); //wrap this in jQuery

      var url = $form.attr("action");

      $.ajax({
        type: "POST",
        url: url,
        data: $("#form").serialize(),
        // serializes the form's elements.
        success: function (data) {
          if (data == true) {
            toastr.success("", "Update Successfully", { timeOut: 2000 });
            $.pjax.reload({ container: "#p0" });
            bootbox.hideAll();
          } else {
            toastr.success("", "Some Error Occur", { timeOut: 2000 });
          }
        },
      });
      // avoid to execute the actual submit of the form.
    });
  });
}

function gridViewDate() {
  $("#m_datepicker_5")
    .datepicker({
      format: "dd/mm/yyyy",
      templates: {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>',
      },
    })
    .change(dateChanged)
    .on("changeDate", dateChanged);
}

$("#m_datepicker_5")
  .datepicker({
    format: "dd/mm/yyyy",
    templates: {
      leftArrow: '<i class="la la-angle-left"></i>',
      rightArrow: '<i class="la la-angle-right"></i>',
    },
  })
  .change(dateChanged)
  .on("changeDate", dateChanged);

function dateChanged(ev) {
  ev.stopImmediatePropagation();
  var from = $("#startdate").val();
  var to = $("#enddate").val();

  var old = $("#submitPicker").attr("href");

  old = old.substr(0, old.lastIndexOf("?"));

  $("#submitPicker").attr("href", old + "?from=" + from + "&to=" + to);
}

$(function () {
  //console.log("Yeah");
  // setInterval(function() {
  // $("#m_topbar_notification_icon .m-nav__link-icon").addClass("m-animate-shake"),
  // $("#m_topbar_notification_icon .m-nav__link-badge").addClass("m-animate-blink")
  // }, 3e3);
  $("#m_topbar_notification_icon").click(function () {
    $(
      "span.m-nav__link-badge.m-badge.m-badge--dot.m-badge--dot-small.m-badge--danger"
    ).length
      ? $(
          "span.m-nav__link-badge.m-badge.m-badge--dot.m-badge--dot-small.m-badge--danger"
        ).remove()
      : true,
      $("#m_topbar_notification_icon .m-nav__link-icon").removeClass(
        "m-animate-shake"
      ),
      $("#m_topbar_notification_icon .m-nav__link-badge").removeClass(
        "m-animate-blink"
      );
  });
});

function addnew1(event, obj) {
  event.preventDefault();
  var parent_id = obj.closest("div[data-pjax-container]").getAttribute("id");

  var url = obj.getAttribute("href");
  console.log(obj.text);
  var dialog = bootbox.dialog({
    title: obj.text,
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
  });

  dialog.init(function () {
    var request = $.ajax({
      url: url,
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
      //console.log("Yeah");
      //$(".bootbox.modal.fade.show").css( "border", "33px solid red" );
      //$(".bootbox.modal.fade.show").prop('tabIndex', '');
      $(".bootbox.modal.fade.show").removeAttr("tabIndex");
    });

    $(document).on("submit", "#form", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();

      $(this).submit(function () {
        return false;
      });

      $form = $(this); //wrap this in jQuery

      var url = $form.attr("action");

      $.ajax({
        type: "POST",
        url: url,
        data: $("#form").serialize(),
        // serializes the form's elements.
        success: function (data) {
          if (data) {
            $.pjax.defaults.timeout = 5000;
            $.pjax.reload({ container: "#" + parent_id });
            bootbox.hideAll();
          }
        },
      });
      // avoid to execute the actual submit of the form.
    });
  });

  //console.log("Hi");
}
function addnew_expense(event, obj) {
  event.preventDefault();
  //var parent_id = obj.closest("div[data-pjax-container]").getAttribute('id');

  var url = obj.getAttribute("href");
  console.log(obj.text);
  var dialog = bootbox.dialog({
    title: obj.text,
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
  });

  dialog.init(function () {
    var request = $.ajax({
      url: url,
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
      //console.log("Yeah");
      //$(".bootbox.modal.fade.show").css( "border", "33px solid red" );
      //$(".bootbox.modal.fade.show").prop('tabIndex', '');
      $(".bootbox.modal.fade.show").removeAttr("tabIndex");
    });

    $(document).on("submit", "#form", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();

      $(this).submit(function () {
        return false;
      });

      $form = $(this); //wrap this in jQuery

      var url = $form.attr("action");

      $.ajax({
        type: "POST",
        url: url,
        data: $("#form").serialize(),
        // serializes the form's elements.
        success: function (data) {
          if (data) {
            //                        $.pjax.defaults.timeout = 5000;
            //                        $.pjax.reload({container: '#' + parent_id});
            bootbox.hideAll();
          }
        },
      });
      // avoid to execute the actual submit of the form.
    });
  });

  //console.log("Hi");
}
function remove_variant(id) {
  id = id.split(",");
  $("#" + id[0]).remove();
  if ($("#warehouse").html() === " ") {
    $("#hidden_warehouse").hide();
  }
}

$(document).ready(function () {
  if ($("#warehouse").html() !== " ") {
    $("#hidden_warehouse").show();
  }
});
//function variants(id)
//{
//    div = id;
//    id = id.split('-');
//
//    $('.variant_name').text(id[1]);
//    bootbox.dialog({
//        title: "This is a form in a modal.",
////        message:'<div class="col-md-12"> ' +
////                '<form class="form-horizontal"> ' +
////                '<div class="form-group"> ' +
////                '<label class=" control-label" for="name">Name</label> ' +
////                '<div class=""> ' +
////                '<input id="name" name="quantity" type="text" placeholder="Your name" class="form-control input-md"> ' +
////                '<span class="help-block">Here goes your name</span> </div> ' +
////                '</div> ' +
////                '<div class="form-group"> ' +
////                '<label class="col-md-4 control-label" for="awesomeness">How awesome is this?</label> ' +
////                '<div class="col-md-4"> <div class="radio"> <label for="awesomeness-0"> ' +
////                '<input type="radio" name="awesomeness" id="awesomeness-0" value="Really awesome" checked="checked"> ' +
////                'Really awesome </label> ' +
////                '</div><div class="radio"> <label for="awesomeness-1"> '
////                '<?php echo Html::dropDownList("warehouse_id", null, ArrayHelper::map(\app\models\Department::find()->where(["warehouse" => 1])->all(), "id", "name"), ["class" => "form-control", "prompt" => "Select a Warehouse"])'?>'+</label> ' +
////                '</div> ' +
////                '</div> </div>' +
////                '</form> </div>',
//        message: $('#form').html(),
//        buttons: {
//            success: {
//                label: "Save",
//                className: "btn-success",
//                callback: function () {
//
//                    var quantity;
//                    $('.quantity').each(function () {
//                        quantity = $(this).val();
//                    });
//                    var warehouse;
//                    $('.warehouse option:selected').each(function () {
//                        warehouse = $(this).val();
//                    });
//                    alert(id[0]);
//                    $('#'+div+' #quantity').val(quantity);
//                    $('#'+div+' #variant_warehouse').text(warehouse);
//                    var answer = $("input[name='awesomeness']:checked").val();
//                    $('.Example').show().html("Hello " + name + ". You've chosen <b>" + answer + "</b").fadeOut(5000);
//                }
//            }
//        }
//    }
//    );
//}

$("#reportrange").daterangepicker(
  {
    opens: "left",
    startDate: moment().subtract("days", 29),
    endDate: moment(),
    //minDate: '01/01/2012',
    //maxDate: '12/31/2014',
    dateLimit: {
      days: 60,
    },
    showDropdowns: true,
    showWeekNumbers: true,
    timePicker: false,
    timePickerIncrement: 1,
    timePicker12Hour: true,
    ranges: {
      Today: [moment(), moment()],
      Yesterday: [moment().subtract("days", 1), moment().subtract("days", 1)],
      "Last 7 Days": [moment().subtract("days", 6), moment()],
      "Last 30 Days": [moment().subtract("days", 29), moment()],
      "This Month": [moment().startOf("month"), moment().endOf("month")],
      "Last Month": [
        moment().subtract("month", 1).startOf("month"),
        moment().subtract("month", 1).endOf("month"),
      ],
    },
    buttonClasses: ["btn"],
    applyClass: "green",
    cancelClass: "default",
    format: "MM/DD/YYYY",
    separator: " to ",
    locale: {
      applyLabel: "Apply",
      fromLabel: "From",
      toLabel: "To",
      customRangeLabel: "Custom Range",
      daysOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
      monthNames: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],
      firstDay: 1,
    },
  },
  function (start, end) {
    $("#reportrange span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );
  }
);

let saleReportTable = $("#sale_report").DataTable({
  responsive: true,
  processing: true,
  serverSide: true,
  ajax: {
    url: `${baseUrl}/site/report`,
    type: "post",
    data: function (d) {
      return $.extend({}, d, {
        _csrf: $('meta[name="csrf-token"]').attr("content"),
        department_id: $("#department-id").val(),
        item_id: $("#item-id").val(),
        start_date: $("#reportrange")
          .data("daterangepicker")
          .startDate.format("Y-M-D"),
        end_date: $("#reportrange")
          .data("daterangepicker")
          .endDate.format("Y-M-D"),
      });
    },
    error: function (e) {
      // alert("Error");
      console.log(e);
    },
  },
  columns: [
    { data: "patient_id" }, // 0
    { data: "patient_name" }, // 1
    { data: "department" }, // 2
    { data: "item_name" }, // 3
    { data: "item_price" }, // 4
    { data: "date" }, // 5
    { data: "status" }, // 6
    { data: "complete_date" }, // 7
    { data: "complete_by" }, // 8
    // {data: "status"}, // 9
    // {data: "action"}
  ],
  columnDefs: [
    // {
    //     targets:-1, title:"Actions", orderable:!1, render:function(a, e, t, n) {
    //         return '\n<a href="'+$('input[name="baseUrl"]').attr("value")+'/forms/plots-sale-update?id='+t.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">\n<i class="la la-edit"></i>\n</a>'+
    //         '\n<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill sale_plots_delete_btn" title="Delete" value="'+t.id+'">\n<i class="la la-trash"></i>\n</button>';
    //     }
    // },
    {
      targets: 0,
      title: "Patient ID",
      render: function (a, e, t, n) {
        if (t.sale) {
          return t.sale.invoice_no;
        }
        return null;
      },
    },
    {
      targets: 1,
      title: "Patient Name",
      render: function (a, e, t, n) {
        if (t.sale) {
          return t.sale.patient.name;
        }
        return null;
      },
    },
    {
      targets: 2,
      title: "Department",
      render: function (a, e, t, n) {
        if (t.item) {
          return t.item.category.department.name;
        }
        return null;
      },
    },
    {
      targets: 5,
      title: "Date",
      render: function (a, e, t, n) {
        if (t.created_on) {
          return t.created_on;
        }
        return null;
      },
    },
    {
      targets: 6,
      title: "Status",
      render: function (a, e, t, n) {
        if (t.test_status) {
          if (t.test_status == 2) {
            return '<span class="m-badge m-badge--success m-badge--wide">Complete</span>';
          }
          return t.test_status;
        }
        return null;
      },
    },
    {
      targets: 7,
      title: "complete date",
      render: function (a, e, t, n) {
        if (t.updated_on) {
          return t.updated_on;
        }
        return null;
      },
    },
    {
      targets: 8,
      title: "complete by",
      render: function (a, e, t, n) {
        if (t.user) {
          return t.user.username;
        }
        return null;
      },
    },
  ],
});

$("#search").click(function () {
  $.ajax({
    type: "POST",
    url: `${baseUrl}/site/report-stats`,
    data: {
      department_id: $("#department-id").val(),
      item_id: $("#item-id").val(),
      start: $("#reportrange")
        .data("daterangepicker")
        .startDate.format("Y-M-D"),
      end: $("#reportrange").data("daterangepicker").endDate.format("Y-M-D"),
    },
    success: function (data) {
      saleReportTable.ajax.reload();
      $("#test-count").html(data.count);
      $("#department-name").html(data.name);
      $("#item-name").html(data.item_name);
      $("#total-price").html(data.total_price);
    },
  });
});

$("#print").click(function () {
  var w = window.open();
  $.ajax({
    type: "POST",
    url: `${baseUrl}/site/report-stats`,
    data: {
      department_id: $("#department-id").val(),
      item_id: $("#item-id").val(),
      start: $("#reportrange")
        .data("daterangepicker")
        .startDate.format("Y-M-D"),
      end: $("#reportrange").data("daterangepicker").endDate.format("Y-M-D"),
    },
    success: function (data) {
      var html = `<!DOCTYPE HTML>
                    <html lang="en-us">
                        <head>
                            <link href="${baseUrl}/css/boot.min.css" rel="stylesheet" type='text/css' id="bootstrap-css">
                            <link rel="stylesheet" type='text/css' href="${baseUrl}/css/print_bill.css">
                            <style>
                                table, td, th {
                                    border: 1px solid;
                                }
                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }
                                .table td, .table th{
                                    padding: 0.0rem !important;
                                }
                        
                                .table-sm td, .table-sm th{
                                    padding: 0.2rem !important;
                                }
                        
                                .font{
                                    font-size: 12px;
                                }
                        
                                .container{
                                    background: white;
                                }
                            </style>
                        </head>
                        <body class="font">
                            <page size="A4" layout="portrait">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <h4>
                                                Abrar Diagnostic Centre
                                            </h4>
                                            <p style="margin-top: -7px;">
                                                <strong>
                                                    312-E Charing Cross,<br>Peshawar Road, Rawalpindi Cantt
                                                </strong>
                                            </p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p >Tel: 5470205, 5167015, 5473543<br>Fax: 051-8317450, Cell: 0331-5261588
                                            <br>
                                            Email: mri_ct@hotmail.com
                                            <br>
                                            Web: www.abrardiagnostics.com.pk
                                        </p>
                                    </div>
                                </div>
                                <table>
                                    <tr>
                                        <td>
                                            <b>
                                                Start From
                                            </b>
                                        </td>
                                        <td>
                                            ${$("#reportrange")
                                              .data("daterangepicker")
                                              .startDate.format("ll")}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                To
                                            </b>
                                        </td>
                                        <td>
                                            ${$("#reportrange")
                                              .data("daterangepicker")
                                              .endDate.format("ll")}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                No of Tests
                                            </b>
                                        </td>
                                        <td>
                                            ${data.count}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                Department
                                            </b>
                                        </td>
                                        <td>
                                            ${data.name}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                Test Name
                                            </b>
                                        </td>
                                        <td>
                                            ${data.item_name}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                Total Price
                                            </b>
                                        </td>
                                        <td>
                                            ${data.total_price}
                                        </td>
                                    </tr>
                                </table>
                            </page>
                        </body>
                    </html>
                `;
      w.document.write(html);
      w.window.print();
      w.document.close();
    },
  });
});
