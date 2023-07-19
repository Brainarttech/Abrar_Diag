//console.log("Account Assets");
var getUrl = window.location;
//console.log(getUrl);
var baseUrl =
  getUrl.protocol +
  "//" +
  getUrl.host +
  getUrl.pathname.split("/web")[0] +
  "/web";
//console.log(startUrl);
//var startUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/";

// A $( document ).ready() block.
$(document).ready(function () {
  AjaxCall("Assets");

  //console.log("first time");
});

$("a.nav-link.m-tabs__link").click(function () {
  //console.log($(this).contents().get(0).nodeValue);
  AjaxCall($(this).contents().get(0).nodeValue);
});

//console.log(csrftoken);

$(".m-portlet__body.table_data").on(
  "click",
  ".Assets,.Liability,.Equity,.Income,.Expense",
  function (e) {
    //console.log($('a.nav-link.m-tabs__link.active').contents().get(0).nodeValue);
    //alert("success");
    e.preventDefault();
    //console.log(this.className);
    var classStr = this.className;
    var lastClass = classStr.substr(classStr.lastIndexOf(" ") + 1);
    //console.log(lastClass);
    var url = startUrl + $(this).attr("href");
    var dialog = bootbox.dialog({
      title: $(this).text(),
      message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
    });
    dialog.removeAttr("tabindex");
    //console.log(url);
    dialog.init(function () {
      //dialog.find('.bootbox-body').html(url);
      var request = $.ajax({
        url: url,
        method: "GET",
      });
      //console.log(url);
      request.done(function (msg) {
        //console.log(msg);
        dialog.find(".bootbox-body").html(msg);
      });

      /*$(document).on("submit", "#accountform", function (event) {
        	console.log("accountform");
        });*/
      //console.log("Submit Function");
      $(document).on("submit", "#accountform", function (event) {
        //console.log("beforeSubmit");
        event.preventDefault();
        event.stopImmediatePropagation();

        $form = $(this); //wrap this in jQuery
        //console.log($form);
        var url = $form.attr("action");
        //console.log(url);
        $.ajax({
          type: "POST",
          url: url,
          data: $("#accountform").serialize(),
          // serializes the form's elements.
          success: function (data) {
            //console.log(data);
            if (data == true) {
              //$.pjax.reload({container:'#p0'});
              //console.log(lastClass);
              AjaxCall(
                $("a.nav-link.m-tabs__link.active").contents().get(0).nodeValue
              );
              bootbox.hideAll();
            }
          },
        });
        // avoid to execute the actual submit of the form.
      });
    });
  }
);

function updateAccount(id, controller, title, event) {
  //console.log("updateAccount");
  //console.log(id+"-"+controller+"-"+title+"-"+event);
  event.preventDefault();
  var dialog = bootbox.dialog({
    title: title,
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading.....</p>',
  });
  dialog.removeAttr("tabindex");
  dialog.init(function () {
    //console.log(startUrl);
    //console.log(controller);
    var request = $.ajax({
      url: startUrl + "accounts/update?id=" + id, //startUrl+controller+
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
    });

    $(document).on("submit", "#accountform_update", function (event) {
      //console.log("Update Submit");
      event.preventDefault();

      $form = $(this); //wrap this in jQuery

      var url = $form.attr("action");

      $.ajax({
        type: "POST",
        url: url,
        data: $("#accountform_update").serialize(),
        // serializes the form's elements.
        success: function (data) {
          //console.log("data");
          if (data == true) {
            toastr.success("", "Update Successfully", { timeOut: 2000 });
            dialog.modal("hide");
            AjaxCall(
              $("a.nav-link.m-tabs__link.active").contents().get(0).nodeValue
            );
            //$.pjax.reload({container:'#p0'});
          } else {
            toastr.success("", "Some Error Occur", { timeOut: 2000 });
          }
        },
      });
      // avoid to execute the actual submit of the form.
    });
  });
}

function AjaxCall(accType) {
  //console.log(startUrl);
  $.ajax({
    url: startUrl + "/accounts/account-detail",
    type: "post",
    data: {
      accounttype: accType,
      _csrf: csrftoken,
    },
    success: function (data) {
      //console.log(data);
      var obj = jQuery.parseJSON(data);
      //console.log(Object.keys(obj).length);
      $(".m-portlet__body.table_data").html("");

      /*for (i = 0; i < Object.keys(obj).length; i++) {
			}*/
      for (i = 0; i < Object.keys(obj).length; i++) {
        //console.log(obj[i]['accounts_type']);
        var rowTable = "";
        if (obj[i]["chartsOfAccounts"].length == 0) {
          rowTable +=
            "<tr>" +
            "<td>You don't have any account yet please add an account.</td>" +
            "</tr>";
        }
        //console.log((obj[i]['chartsOfAccounts']).length);
        for (j = 0; j < obj[i]["chartsOfAccounts"].length; j++) {
          rowTable +=
            "<tr>" +
            '<td id="' +
            obj[i]["chartsOfAccounts"][j]["id"] +
            '">' +
            obj[i]["chartsOfAccounts"][j]["account_name"] +
            '<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Update">' +
            '<i class="la la-edit" onclick="updateAccount(' +
            obj[i]["chartsOfAccounts"][j]["id"] +
            ",'accounts','Update Account',event)\"></i>" +
            "</a>" +
            "</td>" +
            "</tr>";
        }
        var htmlTable =
          '<table class="table">' +
          '<thead class="thead-light">' +
          "<tr>" +
          '<th scope="col">' +
          obj[i]["account_name"] +
          "</th>" +
          "</tr>" +
          "</thead>" +
          "<tbody>" +
          rowTable +
          "<tr>" +
          "<td>" +
          '<a class="btn m-btn--square  btn-outline-danger m-btn m-btn--custom ' +
          obj[i]["accounts_type"] +
          '" href="/accounts/create">Add New Account</a>' +
          //'<button type="button" class="btn m-btn--square  btn-outline-danger m-btn m-btn--custom '+obj[i]['accounts_type']+'">Add New Account</button>'+
          "</td>" +
          "</tr>" +
          "</tbody>" +
          "</table>";
        $(".m-portlet__body.table_data").append(htmlTable);
        //console.log(obj[i]['accounts_type']);
      }
      //console.log(obj[1]['id']);
    },
  });
}

//var getUrl = window.location;
//console.log(getUrl);
//var startUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/web/";
//var startUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/";

$(".add-new-income,.add-new-expense").click(function (event) {
  //console.log("Occur");
  event.preventDefault();
  var url = $(this).attr("href");
  var dialog = bootbox.dialog({
    title: $(this).text(),
    size: "large",
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
  });
  dialog.removeAttr("tabindex");
  dialog.init(function () {
    var request = $.ajax({
      url: url,
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
    });

    $(document).on("submit", "#form", function (event) {
      //console.log("Submit");
      event.preventDefault();
      event.stopImmediatePropagation();
      //console.log('new form');

      $form = $(this); //wrap this in jQuery

      var url = $form.attr("action");
      //console.log(url);

      $.ajax({
        type: "POST",
        url: url,
        data: $("#form").serialize(),
        // serializes the form's elements.
        success: function (data) {
          //console.log(url);
          //console.log(data);
          if (data == true) {
            $.pjax.reload({ container: "#p0" });
            bootbox.hideAll();
          }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log("Status: " + textStatus);
          console.log("Error: " + errorThrown);
        },
      });
      // avoid to execute the actual submit of the form.
    });
  });
});

function updateTransaction(id, controller, title, event) {
  //console.log("updateAccount");
  //console.log(id+"-"+controller+"-"+title+"-"+event);
  event.preventDefault();
  var dialog = bootbox.dialog({
    title: title,
    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading.....</p>',
  });
  dialog.removeAttr("tabindex");
  dialog.init(function () {
    //console.log(startUrl);
    //console.log(controller);
    var request = $.ajax({
      url: startUrl + "transactions/update?id=" + id, //startUrl+controller+
      method: "GET",
    });

    request.done(function (msg) {
      dialog.find(".bootbox-body").html(msg);
    });

    $(document).on("submit", "#form_update", function (event) {
      //console.log(title);
      /*if(title === 'update'){
                console.log(title);
            }*/
      //console.log("Update Submit");
      event.preventDefault();

      $form = $(this); //wrap this in jQuery

      var url = $form.attr("action");

      $.ajax({
        type: "POST",
        url: url,
        data: $("#form_update").serialize(),
        // serializes the form's elements.
        success: function (data) {
          //console.log("data");
          if (data == true) {
            toastr.success("", "Update Successfully", { timeOut: 2000 });
            $.pjax.reload({ container: "#p0" });
            dialog.modal("hide");
          } else {
            toastr.success("", "Some Error Occur", { timeOut: 2000 });
          }
        },
      });
      // avoid to execute the actual submit of the form.
    });
  });
}
