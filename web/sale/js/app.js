var app = angular.module("myApp", [
  "ngRoute",
  "ngBootbox",
  "ui.bootstrap",
  "ngSanitize",
  "siyfion.sfTypeahead",
]);
var getUrl = window.location;
var baseUrl =
  getUrl.protocol +
  "//" +
  getUrl.host +
  getUrl.pathname.split("/web")[0] +
  "/web/";
var param = getUrl.href;
param = param.split("?");
var sale_id = param[1].split("#");
sale_id = sale_id[0];
app.directive("disableOnPromise", function ($parse) {
  return {
    restrict: "C",
    compile: function ($element, attr) {
      var fn = $parse(attr.disableOnPromise);
      return function clickHandler(scope, element, attrs) {
        element.on("click", function (event) {
          attrs.$set("disabled", true);
          scope.$apply(function () {
            fn(scope, { $event: event }).finally(function () {
              attrs.$set("disabled", false);
            });
          });
        });
      };
    },
  };
});
app.factory("tabFocus", function ($timeout, $window) {
  return function (id) {
    // timeout makes sure that it is invoked after any other event has been triggered.
    // e.g. click events that need to run before the focus or
    // inputs elements that are in a disabled state but are enabled when those events
    // are triggered.

    var element = $window.document.getElementById(id);
    $timeout(function () {
      if (element) {
        element.focus();
      }
    });
  };
});
app.factory("tabSelect", function ($timeout, $window) {
  return function (id) {
    // timeout makes sure that it is invoked after any other event has been triggered.
    // e.g. click events that need to run before the focus or
    // inputs elements that are in a disabled state but are enabled when those events
    // are triggered.

    var element = $window.document.getElementById(id);
    $timeout(function () {
      if (element) {
        element.select();
      }
    });
  };
});
app.directive("myEnter", function () {
  return function (scope, element, attrs) {
    element.bind("keydown keypress", function (event) {
      if (event.which === 13) {
        scope.$apply(function () {
          scope.$eval(attrs.myEnter);
        });
        event.preventDefault();
      }
    });
  };
});
app.directive("hymn", function () {
  return {
    restrict: "E",
    link: function (scope, element, attrs) {
      // some ode
    },
    templateUrl: function (elem, attrs) {
      return baseUrl + "sale/views/numericCalculator.html";
    },
  };
});
app.directive("compile", [
  "$compile",
  function ($compile) {
    return function (scope, element, attrs) {
      scope.$watch(
        function (scope) {
          // watch the 'compile' expression for changes
          return scope.$eval(attrs.compile);
        },
        function (value) {
          // when the 'compile' expression changes
          // assign it into the current DOM
          element.html(value);
          // compile the new DOM and link it to the current
          // scope.
          // NOTE: we only compile .childNodes so that
          // we don't get into infinite loop compiling ourselves
          $compile(element.contents())(scope);
        }
      );
    };
  },
]);
app.directive("floatingNumberOnly", function () {
  return {
    require: "ngModel",
    link: function (scope, ele, attr, ctrl) {
      ctrl.$parsers.push(function (inputValue) {
        console.log(inputValue);
        var pattern = new RegExp("(^[0-9]{1,9})+(.[0-9]{1,4})?$", "g");
        if (inputValue == "") return "";
        var dotPattern = /^[.]*$/;
        if (dotPattern.test(inputValue)) {
          console.log("inside dot Pattern");
          ctrl.$setViewValue("");
          ctrl.$render();
          return "";
        }

        var newInput = inputValue.replace(/[^0-9.]/g, "");
        // newInput=inputValue.replace(/.+/g,'.');

        if (newInput != inputValue) {
          ctrl.$setViewValue(newInput);
          ctrl.$render();
        }
        //******************************************
        //***************Note***********************
        /*** If a same function call made twice,****
         *** erroneous result is to be expected ****/
        //******************************************
        //******************************************

        var result;
        var dotCount;
        var newInputLength = newInput.length;
        if ((result = pattern.test(newInput))) {
          //console.log("pattern " + result);
          dotCount = newInput.split(".").length - 1; // count of dots present
          if (dotCount == 0 && newInputLength > 9) {
            //condition to restrict "integer part" to 9 digit count
            newInput = newInput.slice(0, newInputLength - 1);
            ctrl.$setViewValue(newInput);
            ctrl.$render();
          }
        } else {
          //pattern failed
          //console.log("pattern " + result);
          // console.log(newInput.length);

          dotCount = newInput.split(".").length - 1; // count of dots present
          //console.log("dotCount  :  " + dotCount);
          if (newInputLength > 0 && dotCount > 1) {
            //condition to accept min of 1 dot
            //console.log("length>0");
            newInput = newInput.slice(0, newInputLength - 1);
            //console.log("newInput  : " + newInput);
          }
          if (newInput.slice(newInput.indexOf(".") + 1).length > 4) {
            //condition to restrict "fraction part" to 4 digit count only.
            newInput = newInput.slice(0, newInputLength - 1);
            //console.log("newInput  : " + newInput);
          }
          ctrl.$setViewValue(newInput);
          ctrl.$render();
        }

        return newInput;
      });
    },
  };
});
app.directive("slick", [
  "$timeout",
  function ($timeout) {
    return {
      restrict: "A",
      link: function (scope, el, atts) {
        $timeout(function () {
          el.slick({
            infinite: false,
            arrows: false,
            slidesToShow: 2,
            slidesToScroll: 2,
            variableWidth: true,
          });
          // Bind Next button
          angular
            .element(document)
            .find(".cat-next")
            .bind("click", function () {
              el.slick("slickNext");
            });
          // Bind Prev button
          angular
            .element(document)
            .find(".cat-prev")
            .bind("click", function () {
              el.slick("slickPrev");
            });
          angular.element(document).find("body").removeClass("m-page--loading");
        }, 3000);
      },
    };
  },
]);
app.directive("datatable", [
  "$timeout",
  function ($timeout) {
    return {
      restrict: "A",
      link: function (scope, el, atts) {
        $timeout(function () {
          var table = el.DataTable({
            scrollY: "350px",
            bInfo: false,
            bFilter: false,
            ordering: false,
            scrollCollapse: true,
            paging: false,
            searching: true,
            dom: "t",
            oLanguage: { sZeroRecords: "", sEmptyTable: "" },
            columnDefs: [
              {
                targets: [0, 3],
                visible: false,
                searchable: true,
              },
            ],
          });
          scope.table = table;
        }, 2000);
      },
    };
  },
]);
app.directive("orderdatatable", [
  "$timeout",
  function ($timeout) {
    return {
      restrict: "A",
      link: function (scope, el, atts) {
        $timeout(function () {
          var orderTable = el.DataTable({
            /*
                         "columnDefs": [
                         {
                         "targets": [ 0 ],
                         "visible": false,
                         "searchable": true
                         },
                         ],*/

            columns: [
              { width: "35%" },
              { className: "text-center" },
              { className: "text-center" },
              { className: "text-center" },
              { className: "text-center" },
            ],
            scrollY: "185px",
            bInfo: false,
            ordering: false,
            scrollCollapse: true,
            paging: false,
            searching: false,
            rowReorder: {
              selector: "tr",
            },
            oLanguage: { sZeroRecords: "", sEmptyTable: "" },
          });
          scope.orderTable = orderTable;
        }, 1000);
      },
    };
  },
]);
app.controller(
  "POS",
  function (
    $scope,
    $timeout,
    $http,
    $rootScope,
    $route,
    $ngBootbox,
    $uibModal
  ) {
    $scope.selectedPatient = "";
    $scope.checkPatientSelected = function () {
      console.log($scope.selectedPatient);
      if ($rootScope.patientID) {
        return true;
      }
    };
    $scope.paymentButttonEnable = function () {
      //console.log("Waqar"+$rootScope.orderlist.length);
      if ($rootScope.patientID && $rootScope.orderlist.length > 0) {
        return true;
      }
    };
    $rootScope.clear = function () {
      $rootScope.patientID = "";
      //$rootScope.referredId=1;
      //$rootScope.referredName ="By Self";
      $rootScope.patientName = "";
      $rootScope.patientReg = "";
      $rootScope.patientPhone = "";
      $rootScope.patientAge = "";
      $rootScope.orderlist = [];
      $scope.isSelected = [];
      $rootScope.discount = 0.0;
      $rootScope.discountType = "";
      $rootScope.discountAmount = 0;
      localStorage.setItem("discountReason", 0);
      $rootScope.total = 0.0;
      $rootScope.count = 0;
      $rootScope.tax = 0.0;
      $rootScope.grandTotal = 0.0;
      $rootScope.discountReason = 0;
      $rootScope.testDiscount = 0;
    };

    $scope.removePatinet = function () {
      console.log($scope.selectedPatient);
      $scope.selectedPatient = "";
      $rootScope.patientID = "";
      $rootScope.discount = 0.0;
      $rootScope.discountType = "";
      $rootScope.discountAmount = 0;
      localStorage.setItem("discountReason", 0);
      toastr.success("Patient Remove Successfully", "", {
        timeOut: 2000,
        closeButton: false,
        preventDuplicates: true,
      });
      console.log($scope.selectedPatient);
    };

    $scope.$watch("selectedPatient", function (newValue, oldValue) {
      if ($scope.selectedPatient.id) {
        toastr.success("Patient Successfully Added", "", {
          timeOut: 2000,
          closeButton: false,
          preventDuplicates: true,
        });
        $rootScope.patientID = newValue.id;
        $rootScope.patientName = $scope.selectedPatient.name;
        $rootScope.patientReg = $scope.selectedPatient.reg_no;
        $rootScope.patientPhone = $scope.selectedPatient.phone_no;
        $rootScope.patientAge = $scope.selectedPatient.age;
        $rootScope.referredId = 1;
        $rootScope.referredName = "By Self";
        if ($scope.selectedPatient.age > 600) {
          $rootScope.discount = 500;
          $rootScope.discountType = 1;
          $rootScope.discountAmount = 500;
        } else {
          $rootScope.discount = 0.0;
          $rootScope.discountType = "";
          $rootScope.discountAmount = 0;
        }
        console.log($rootScope);
      }
    });
    $scope.patientDataSet = {
      displayKey: "title",
      limit: 10,
      source: function (query, syncResults, asyncResults) {
        //return query;
        var req = {
          url: baseUrl + "ajax/search-patient?query=" + query,
          method: "GET",
        };
        return $http(req).then(
          function successCallback(response) {
            asyncResults(response.data);
            //console.log(response.data);
            //console.log(response.data);
          },
          function errorCallback(response) {
            console.log(response);
          }
        );
      },
      templates: {
        empty: [
          '<div class="tt-suggestion tt-empty-message">',
          '<span class="vd-colour-do vd-suggestion-query-container">',
          '<vd-icon icon="fa-plus-circle" class="vd-mrs fa fa-plus-circle"></vd-icon>',
          'No <span class="vd-suggestion-query">' +
            $scope.selectedPatient +
            "</span>",
          "Patient Found",
          "</span>",
          "</div>",
        ].join("\n"),
        suggestion: function (data) {
          return [
            '<div class="movie-card">',
            '<img class="movie-card-poster" src="' +
              baseUrl +
              'images/user.png">',
            '<div class="movie-card-details">',
            '<div class="movie-card-name">' + data.name + "</div>",
            '<div class="movie-card-plot">' +
              data.reg_no +
              " | " +
              data.phone_no +
              "</div>",
            "</div>",
            "</div>",
          ].join("\n");
        },
      },
    };
    $scope.showPatientSelectError = function () {
      if (!$rootScope.patientID) {
        toastr.error("Please Select Patient", "", {
          timeOut: 3000,
          closeButton: false,
          preventDuplicates: true,
        });
      } else {
        toastr.error("Please Add Some Tests", "", {
          timeOut: 3000,
          closeButton: false,
          preventDuplicates: true,
        });
      }
    };

    // $rootScope.referredId =1;
    // $rootScope.referredName = "By Self";
    $rootScope.orderlist = [];
    $rootScope.testDiscount = 0;
    $scope.isSelected = [];
    $scope.search = function (mysearch) {
      $scope.table.columns(1).search(mysearch).draw();
    };
    $scope.searchById = function (mysearch) {
      $scope.table.columns(0).search(mysearch).draw();
    };
    $scope.addItemDiscount = function (data) {
      console.log(data);
      //WaqarDiscount

      var modalInstance = $uibModal.open({
        animation: false,
        ariaLabelledBy: "modal-title",
        ariaDescribedBy: "modal-body",
        templateUrl: baseUrl + "sale/views/ItemDiscount.html",
        openedClass: "modal-open",
        scope: $scope,
        // backdropClass: 'modal fade show',
        controller: "ItemDiscountController",
        controllerAs: "pc",
        //size: size,
        resolve: {
          data: function () {
            return data;
          },
        },
      });
      modalInstance.result.then(function () {});
    };
    $scope.removeOrder = function (data) {
      var index = $rootScope.orderlist.indexOf(data);
      $rootScope.orderlist.splice(index, 1);
      //Selected Remove Class

      var id = -1;
      $scope.items.some(function (obj, i) {
        return obj.id === data.id ? (id = i) : false;
      });
      $scope.isSelected[id] = "";
      $scope.updateDiscount();
      $scope.updateOrder();
    };

    $rootScope.discount = 0.0;
    $rootScope.discountType = "";
    $rootScope.discountAmount = 0;
    $rootScope.discountReason = 0;
    localStorage.setItem("discountReason", 0);
    $scope.updateOrder = function () {
      $rootScope.total = 0.0;
      $rootScope.testDiscount = 0.0;
      $rootScope.count = 0;
      $rootScope.tax = 0.0;
      $rootScope.grandTotal = 0.0;
      $rootScope.count = $rootScope.orderlist.length;
      $rootScope.orderlist.forEach(function (obj) {
        $rootScope.total += parseInt(obj["rate"]);
      });
      $rootScope.orderlist.forEach(function (obj) {
        $rootScope.testDiscount += parseInt(obj["discount"]);
      });
      //console.log("Root Scope Test Discount" + $rootScope.testDiscount);
      $rootScope.tax = ($rootScope.total * 0) / 100;
      if ($rootScope.discountType == 2) {
        var grandtotal = $rootScope.total + $rootScope.tax;
        $rootScope.discountAmount = parseInt(
          (grandtotal * $rootScope.discount) / 100
        );
      }

      if ($rootScope.testDiscount > 0) {
        $rootScope.grandTotal =
          $rootScope.total + $rootScope.tax - $rootScope.testDiscount;
      } else {
        $rootScope.grandTotal =
          $rootScope.total + $rootScope.tax - $rootScope.discountAmount;
      }

      //console.log("Discount Reason in Update" + $rootScope.discountReason);
    };

    $scope.updateDiscount = function () {
      if ($rootScope.discountType == 1) {
        $rootScope.discount = 0.0;
        $rootScope.discountType = "";
        $rootScope.discountAmount = 0;
        $rootScope.discountReason = 0;
      }
    };

    $scope.addToCart = function (data, id) {
      //Add Class To TR Element To hightList It is Selected
      $scope.isSelected[id] =
        $scope.isSelected[id] == "selected" ? "" : "selected";
      //console.log(data);

      if ($scope.isSelected[id] == "selected") {
        //data.discount = 0;
        //data.dS = 1;
        data.total = data.rate - data.discount;
        $rootScope.orderlist.push(data);
        /*$scope.orderTable.row.add( [
             data.id,
             data.name,
             data.rate,
             '<i class="fa fa-comment tip pointer posdel" id="1528983789825" title="Comment" style="cursor:pointer;"></i>&nbsp;<i class="fa fa-times tip pointer posdel" id="1528983789825" title="Remove" style="cursor:pointer;"></i>',
             
             
             ] ).draw( false );*/
      } else {
        var index = -1;
        $rootScope.orderlist.some(function (obj, i) {
          return obj.id === data.id ? (index = i) : false;
        });
        $rootScope.orderlist.splice(index, 1);
        /* $scope.orderTable.
             rows( function ( idx, rowdata, node ) {
             console.log(rowdata);
             
             return rowdata[0] === data.id;
             } )
             .remove()
             .draw();*/
      }
      $scope.updateDiscount();
      $scope.updateOrder();
    };

    $rootScope.submit = function () {
      var Indata = {
        patient_id: $rootScope.patientID,
        referral_doctor_id: $rootScope.referredId,
        total_items: $rootScope.count,
        total: $rootScope.total,
        tax: $rootScope.tax,
        discount: $rootScope.discountAmount,
        discount_type:
          $rootScope.discountType == 1
            ? $rootScope.discount + "Rs"
            : $rootScope.discount + "%",
        grand_total: $rootScope.grandTotal,
        mop: $rootScope.mop,
        order_list: $rootScope.orderlist,
        test_discount: $rootScope.testDiscount,
        discountReason: localStorage.getItem("discountReason"),
      };

      $http.post(baseUrl + "ajax/submit-order?" + sale_id, Indata).then(
        function (data, status, headers, config) {
          if (data.data.status == "True") {
            var order_id = data.data.id;
            helper.printExternal(
              baseUrl + "site/print-bill?id=" + order_id + "",
              900,
              700
            );
            //$ngBootbox.hideAll();
            //Clear Alll $rootScope
            if ($rootScope.discountAmount > 0 || $rootScope.testDiscount > 0) {
              $http({
                url: baseUrl + "ajax/send-discount-sms?id=" + order_id + "",
                method: "GET",
              });
            }

            // $http({
            //     url: baseUrl + "ajax/send-patient-sms?id=" + order_id + "",
            //     method: "GET",
            // });
            $rootScope.clear();
          } else {
            alert("Error Occur");
          }
        },
        function (data, status, headers, config) {
          alert("error");
        }
      );
    };

    $scope.discountDialogOptions = {
      templateUrl: baseUrl + "sale/views/Discount.html",
      title: "Discount",
      scope: $scope,
      onEscape: function () {
        //console.log("Closed");
      },
      closeButton: true,
      animate: true,
      size: "small",
      buttons: {
        success: {
          label: "Apply",
          className: "btn-success",
          callback: function () {
            //                    console.log("Discount = " + $rootScope.discount);
            //                    console.log("Discount Type = " + $rootScope.discountType);
            //Check All Logic Discount Here

            if ($rootScope.discountType == 1) {
              //In Rs Discount

              if ($rootScope.discount > $rootScope.total + $rootScope.tax) {
                toastr.error("Enter Discount Is More Than Sale Total", "", {
                  timeOut: 3000,
                  closeButton: true,
                  preventDuplicates: true,
                });
                return false;
              } else if ($rootScope.discount > 0) {
                if (
                  $rootScope.discountReason == 0 ||
                  $rootScope.discountReason == null
                ) {
                  //                                console.log("Reason" + $rootScope.discount);
                  //                                console.log("Reason" + $rootScope.discountReason);
                  toastr.error("Select Discount Reason", "", {
                    timeOut: 3000,
                    closeButton: true,
                    preventDuplicates: true,
                  });
                  return false;
                } else {
                  $rootScope.discountAmount = $rootScope.discount;
                  localStorage.setItem(
                    "discountReason",
                    $rootScope.discountReason
                  );
                  $scope.updateOrder();
                  $scope.$apply();
                  return true;
                }
              }
            } else if ($rootScope.discountType == 2) {
              // In Percentage Discount
              if ($rootScope.discount > 100) {
                toastr.error("Enter Discount Is More Than Sale Total", "", {
                  timeOut: 3000,
                  closeButton: true,
                  preventDuplicates: true,
                });
                return false;
              } else if ($rootScope.discount > 0) {
                if (
                  $rootScope.discountReason == 0 ||
                  $rootScope.discountReason == null
                ) {
                  //                                console.log("Reason" + $rootScope.discount);
                  //                                console.log("Reason" + $rootScope.discountReason);
                  toastr.error("Select Discount Reason", "", {
                    timeOut: 3000,
                    closeButton: true,
                    preventDuplicates: true,
                  });
                  return false;
                } else {
                  var grandtotal = $rootScope.total + $rootScope.tax;
                  $rootScope.discountAmount = parseInt(
                    (grandtotal * $rootScope.discount) / 100
                  );
                  localStorage.setItem(
                    "discountReason",
                    $rootScope.discountReason
                  );
                  $scope.updateOrder();
                  $scope.$apply();
                  return true;
                }
              } else {
                var grandtotal = $rootScope.total + $rootScope.tax;
                $rootScope.discountAmount = parseInt(
                  (grandtotal * $rootScope.discount) / 100
                );
                //$rootScope.discountReason = '0';
                $scope.updateOrder();
                $scope.$apply();
                return true;
              }
            } else {
              // console.log("In Development");
            }

            // return false;
          },
        },
        warning: {
          label: "Cancel",
          className: "btn-warning",
          callback: function () {},
        },
      },
    };
    $scope.referredDialogOptions = {
      templateUrl: baseUrl + "sale/views/Referred.html",
      title: "Referred",
      scope: $scope,
      onEscape: true,
      closeButton: true,
      animate: true,
      size: "large",
      buttons: {
        success: {
          label: "Submit",
          className: "btn-primary",
          callback: function () {
            $rootScope.submitReferred();
            return false;
          },
        },
        warning: {
          label: "Cancel",
          className: "btn-warning",
          callback: function () {},
        },
      },
    };
    $scope.paymentDialogOptions = {
      templateUrl: baseUrl + "sale/views/Payment.html",
      title: "Payment",
      scope: $scope,
      onEscape: true,
      closeButton: true,
      animate: true,
      className: "right",
      size: "large",
      buttons: {
        success: {
          label: "Payment",
          className: "btn-primary disable-on-promise",
          callback: function (event) {
            //console.log(event);
            $ngBootbox.hideAll();
            //console.log("Discount Reason123" + $rootScope.discountReason);
            $rootScope.submit();
            return false;
          },
        },
        warning: {
          label: "Cancel",
          className: "btn-warning",
          callback: function () {},
        },
      },
    };
    //View Bill

    $scope.viewBillDialogOptions = {
      templateUrl: baseUrl + "sale/views/ViewBill.html",
      title: "View Bill",
      scope: $scope,
      onEscape: true,
      closeButton: true,
      animate: true,
      className: "right",
      size: "large",
      buttons: {
        warning: {
          label: "Cancel",
          className: "btn-warning",
          callback: function () {},
        },
      },
    };
    //Patient Dialogue Option
    $scope.getSaleItems = function () {
      $http.get(baseUrl + "ajax/get-items?" + sale_id).then(
        function (response) {
          angular.forEach(response.data.item, function (value, key) {
            //console.log(value);
            //                    angular.element('#items_'+value.id).trigger('click');
            $scope.addToCart(value, value.id);
          });
        },
        function (response) {
          //Second function handles error
          alert("Error Occur");
        }
      );
    };

    $scope.patientDialogOptions = {
      templateUrl: baseUrl + "sale/views/Patient.html",
      title: "Patients",
      scope: $scope,
      onEscape: function () {
        console.log("Closed");
      },
      closeButton: true,
      animate: true,
      className: "right",
      size: "large",
      buttons: {
        success: {
          label: "Submit",
          className: "btn-success",
          callback: function () {
            $rootScope.submitForm();
            //toastr.error("Inconceivable!", "Entered discount is more than the sale total.");
            return false;
          },
        },
        warning: {
          label: "Cancel",
          className: "btn-warning",
          callback: function () {},
        },
      },
    };
    //Get All Categories
    $http.get(baseUrl + "ajax/get-item-category").then(
      function (response) {
        $scope.category = response.data.category;
        //console.log(response);
      },
      function (response) {
        //Second function handles error
        alert("Error Occur");
      }
    );

    $http.get(baseUrl + "ajax/get-items").then(
      function (response) {
        $scope.items = response.data.item;
        //console.log("Items" + response);
        // $scope.getSaleItems();
      },
      function (response) {
        //Second function handles error
        alert("Error Occur");
      }
    );

    $http.get(baseUrl + "ajax/search-patient?" + sale_id).then(
      function (response) {
        //console.log(response.data[0].name);
        //                $scope.items = response.data.item;
        $rootScope.patientID = response.data[0].id;
        $rootScope.patientName = response.data[0].name;
        $rootScope.patientReg = response.data[0].reg_no;
        $rootScope.patientPhone = response.data[0].phone_no;
        $rootScope.patientAge = response.data[0].age;
        $rootScope.referredId = response.data[0].doctor_id;
        $rootScope.referredName = response.data[0].doctor_name;
      },
      function (response) {
        //Second function handles error
        alert("Error Occur");
      }
    );
    $http.get(baseUrl + "ajax/get-discount-key").then(
      function (response) {
        $rootScope.reason = response.data;
        //console.log("Items"+response);
      },
      function (response) {
        //Second function handles error
        alert("Error Occur");
      }
    );
    $scope.updateOrder();
    //console.log($scope);
  }
);
app.controller(
  "ItemDiscountController",
  function ($uibModalInstance, data, $rootScope, $scope) {
    //WaqarDiscount

    var index = $rootScope.orderlist.indexOf(data);
    console.log(data);
    //console.log($rootScope.orderlist[index]);
    $scope.testreason = $rootScope.orderlist[index].dS;
    console.log($scope.testreason);
    $scope.testdiscount = $rootScope.orderlist[index].discount;
    var pc = this;
    pc.data = data;
    pc.ok = function () {
      if ($scope.testdiscount > $rootScope.orderlist[index].rate) {
        toastr.error("Enter Discount Is More Than Test Cost", "", {
          timeOut: 3000,
          closeButton: true,
          preventDuplicates: true,
        });
      } else if ($scope.testreason == undefined || $scope.testreason == 0) {
        if ($scope.testdiscount == 0 || $scope.testdiscount == "") {
          $rootScope.orderlist[index].discount = 0;
          $rootScope.orderlist[index].dS = 0;
          $rootScope.orderlist[index].total =
            $rootScope.orderlist[index].rate -
            $rootScope.orderlist[index].discount;
          $scope.updateOrder();
          $uibModalInstance.close();
        } else {
          toastr.error("Please Select Discount Reason", "", {
            timeOut: 3000,
            closeButton: true,
            preventDuplicates: true,
          });
        }
      } else if ($scope.testdiscount == 0 || $scope.testdiscount == "") {
        if ($scope.testreason == undefined || $scope.testreason == 0) {
          $rootScope.orderlist[index].discount = 0;
          $rootScope.orderlist[index].dS = 0;
          $rootScope.orderlist[index].total =
            $rootScope.orderlist[index].rate -
            $rootScope.orderlist[index].discount;
          $scope.updateOrder();
          $uibModalInstance.close();
        } else {
          toastr.error("Please Type Discount", "", {
            timeOut: 3000,
            closeButton: true,
            preventDuplicates: true,
          });
        }
      } else {
        $rootScope.orderlist[index].discount = $scope.testdiscount;
        $rootScope.orderlist[index].dS = $scope.testreason;
        $rootScope.orderlist[index].total =
          $rootScope.orderlist[index].rate -
          $rootScope.orderlist[index].discount;
        $scope.updateOrder();
        console.log("Test Reason: " + $scope.testreason);
        $uibModalInstance.close();
      }

      //{...}
      // alert("You clicked the ok button.");
      // $uibModalInstance.close();
    };
    pc.cancel = function () {
      $uibModalInstance.close();
    };
  }
);
app.controller(
  "DiscountTab",
  function ($scope, $rootScope, $sce, $window, tabFocus, tabSelect) {
    console.log($scope);
    // alert($rootScope.discountReason);

    $scope.vm = {};
    $scope.vm.discountPer = $rootScope.discount;
    $scope.vm.discountRs = $rootScope.discount;
    // $scope.vm.discountRsReason = $rootScope.discountReason;
    // $scope.vm.discountPerReason = $rootScope.discountReason;

    var rsHtml =
      '<div class="form-group">' +
      '<div class="margin-bottom-10">Amount In Rs</div>' +
      '<input  type="text" id="rsdiscount" floating-number-only ng-pattern="/(^[0-9]{1,9})+(.[0-9]{1,4})?$/" ng-model="vm.discountRs" name="rs" class="form-control focus input-hike-large" format="decimal"  selected="true" style="">' +
      '</div><div class="form-group">' +
      '<div class="margin-bottom-10">Reason</div>' +
      '<select class="form-control"  ng-model="$root.discountReason" name="rsReason" >' +
      '<option ng-repeat="product in reason" value="{{product.id}}" >{{product.name}}' +
      "</select>" +
      "</div>";
    var perHtml =
      '<div class="form-group">' +
      '<div class="margin-bottom-10">Amount In Percentage</div>' +
      '<input  type="text" id="perdiscount" ng-model="vm.discountPer" floating-number-only ng-pattern="/(^[0-9]{1,9})+(.[0-9]{1,4})?$/" name="percentage" class="form-control input-hike-large " format="decimal"  selected="true" style="">' +
      '</div><div class="form-group">' +
      '<div class="margin-bottom-10">Reason</div>' +
      '<select class="form-control" ng-model="$root.discountReason" name="PerReason" >' +
      '<option ng-repeat="product in reason" value="{{product.id}}" >{{product.name}}' +
      "</select>" +
      "</div>";
    //ng-selected="{{product.id == vm.discountPerReason}}"
    console.log($rootScope.reason);
    $scope.discountTabs = [
      { id: 1, title: "RS", content: $sce.trustAsHtml(rsHtml), active: true },
      { id: 2, title: "%", content: $sce.trustAsHtml(perHtml), active: false },
    ];
    //Discount in Rs
    $scope.$watch("vm.discountRs", function (newValue, oldValue) {
      console.log("Discount Value Rs " + newValue);
      $rootScope.discount = newValue;
      //$scope.vm.discountPer = newValue;
      $scope.vm.discountRs = newValue;
    });
    /* $scope.$watch('vm.discountRsReason', function(newValue,oldValue) {
     
     $rootScope.discountReason = newValue;
     
     $scope.vm.discountRsReason = newValue;
     console.log("Watch Discount Reason");
     
     });
     $scope.$watch('vm.discountPerReason', function(newValue,oldValue) {
     
     $rootScope.discountReason = newValue;
     
     $scope.vm.discountPerReason = newValue;
     
     });
     */

    //Discount in Percentage
    $scope.$watch("vm.discountPer", function (newValue, oldValue) {
      console.log("Discount Value Per " + newValue);
      if (newValue > 100) {
        $scope.vm.discountPer = oldValue;
      } else {
        $rootScope.discount = newValue;
        $scope.vm.discountRs = newValue;
      }
    });
    $scope.setActive = function (discountId) {
      console.log("Discount Tab Change");
      switch (discountId) {
        case 1:
          $rootScope.discountType = 1;
          tabFocus("rsdiscount");
          tabSelect("rsdiscount");
          break;
        case 2:
          $rootScope.discountType = 2;
          if ($rootScope.discount > 100) {
            $scope.vm.discountPer = 0;
          }
          tabFocus("perdiscount");
          tabSelect("perdiscount");
          break;
        default:
          console.log("No FOCUS");
      }
    };
  }
);
app.controller(
  "patientChooseTab",
  function ($scope, $rootScope, $ngBootbox, $http) {
    $scope.genderNames = ["Male", "Female", "Other"];
    $scope.gender = "Male";
    $scope.relationNames = ["None", "Father", "Mother", "Other"];
    $scope.relation = "None";
    //$scope.ageNames = ["Year", "Month", "Day"];
    //var data = {foo: 'a',bar: 'b'};
    //$scope.ageNames = [{key: "Y",value: "Year" },{key: "M",value: "Month" },{key: "D",value: "Day" }];
    $scope.ageNames = { Y: "Year", M: "Month", D: "Day" };
    $scope.ageType = "Y";
    $scope.city = "Rawalpindi";
    $scope.country = "Pakistan";
    $scope.checkRelationSelected = function () {
      console.log($scope.relation);
      if ($scope.relation !== "Other") {
        return true;
      }
    };

    // function to submit the form after all validation has occurred
    $rootScope.submitForm = function () {
      if ($scope.patientForm.$valid) {
        $ngBootbox.hideAll();
        //Save Patient In Database
        var Indata = {
          fullname: $scope.fullname,
          cnic: $scope.cnic,
          phonenumber: $scope.phonenumber,
          gender: $scope.gender,
          age: $scope.age,
          ageType: $scope.ageType,
          relationship:
            $scope.relation == "Other"
              ? $scope.other_relation
              : $scope.relation,
          city: $scope.city,
          country: $scope.country,
          address: $scope.address,
          email: $scope.email,
          whatsapp: $scope.whatsapp,
        };

        $http.post(baseUrl + "ajax/save-patient", Indata).then(
          function (data, status, headers, config) {
            if (data.data.status == "True") {
              $rootScope.patientID = data.data.id;
              $rootScope.patientName = data.data.fullname;
              $rootScope.patientReg = data.data.reg_no;
              $rootScope.patientPhone = data.data.phone_no;
              $rootScope.patientAge = data.data.age;
              $rootScope.referredId = 1;
              $rootScope.referredName = "By Self";
              if ($scope.age > 600) {
                $rootScope.discount = 500;
                $rootScope.discountType = 1;
                $rootScope.discountAmount = 500;
              }
            } else {
              alert("Error Occur");
            }
          },
          function (data, status, headers, config) {
            alert("error");
          }
        );
      } else {
        alert("Please Submit All Fields");
      }
    };
  }
);
app.controller(
  "referredChooseTab",
  function ($scope, $rootScope, $ngBootbox, $http) {
    $scope.$watch("referred_name", function (newValue, oldValue) {
      if ($scope.referred_name.id) {
        $rootScope.referredId = newValue.id;
        $rootScope.referredName = newValue.name;
        $ngBootbox.hideAll();
        toastr.success("Referred Succesfully Selected", "", {
          timeOut: 2000,
          closeButton: false,
          preventDuplicates: true,
        });
        /*$rootScope.patientID =newValue.id;
             $rootScope.patientName = $scope.selectedPatient.name;
             $rootScope.patientReg = $scope.selectedPatient.reg_no;
             $rootScope.patientPhone = $scope.selectedPatient.phone_no;*/
        console.log("Selected" + $scope.referred_name.name);
      } else {
        console.log("NO Select" + newValue);
      }
    });
    $scope.referredDataSet = {
      displayKey: "title",
      limit: 10,
      source: function (query, syncResults, asyncResults) {
        var req = {
          url: baseUrl + "ajax/search-referred?query=" + query,
          method: "GET",
        };
        return $http(req).then(
          function successCallback(response) {
            asyncResults(response.data);
          },
          function errorCallback(response) {}
        );
      },
      templates: {
        empty: [
          '<div class="tt-suggestion tt-empty-message">',
          '<span class="vd-colour-do vd-suggestion-query-container">',
          '<vd-icon icon="fa-plus-circle" class="vd-mrs fa fa-cross"></vd-icon>',
          'No <span class="vd-suggestion-query"></span>',
          "Refferred Found",
          "</span>",
          "</div>",
        ].join("\n"),
        suggestion: function (data) {
          return [
            '<div class="movie-card">',
            '<div class="movie-card-name">' + data.name + "</div>",
            "</div>",
          ].join("\n");
        },
      },
    };
    // function to submit the form after all validation has occurred
    $rootScope.submitReferred = function () {
      if ($scope.referredForm.$valid) {
        //Save Patient In Database
        var Indata = {
          fullname: $scope.referred_name,
          cnic: $scope.referred_cnic,
          phonenumber: $scope.referred_phone,
          address: $scope.referred_address,
          email: $scope.referred_email,
          hospital: $scope.referred_hospital,
        };

        $http.post(baseUrl + "ajax/save-referred", Indata).then(
          function (data, status, headers, config) {
            if (data.data.status == "True") {
              toastr.success("Referred Succesfully Selected", "", {
                timeOut: 2000,
                closeButton: false,
                preventDuplicates: true,
              });
              $rootScope.referredId = data.data.id;
              $rootScope.referredName = data.data.fullname;
              $ngBootbox.hideAll();
            } else {
              alert("Error Occur");
            }
          },
          function (data, status, headers, config) {
            alert("error");
          }
        );
      } else {
        alert("Please Submit All Fields");
      }
    };
  }
);
app.controller(
  "PaymentChooseTab",
  function (
    $scope,
    $rootScope,
    $http,
    $sce,
    $ngBootbox,
    $window,
    $timeout,
    tabFocus,
    tabSelect
  ) {
    console.log(
      "Discount Reason in Payment Choose Tab" + $rootScope.discountReason
    );
    console.log($rootScope.discount);
    $scope.vm = {};
    $scope.vm.cash = $rootScope.grandTotal;
    $scope.vm.credit = $rootScope.grandTotal;
    $scope.vm.bank = $rootScope.grandTotal;
    $scope.vm.cheque = $rootScope.grandTotal;
    var header =
      '<div class="form-group">' + '<div class="margin-bottom-10">Amount</div>';
    var numericCalculator = '<hymn template-url="contentUrl"><hymn>';
    var fotter = "</div>";
    var cash =
      '<input  type="text"  floating-number-only  ng-model="vm.cash" my-enter="submitOrder()"   name="cash" class="form-control focus input-hike-large text-right" id="cash" style="">';
    var credit =
      '<input  type="text" id="credit" floating-number-only  ng-model="vm.credit"  name="credit" class="form-control input-hike-large text-right " style="">';
    var bank =
      '<input  type="text" floating-number-only ng-pattern="/(^[0-9]{1,9})+(.[0-9]{1,4})?$/" ng-model="vm.bank" name="bank" id="bank" class="form-control input-hike-large text-right " style="">';
    var cheque =
      '<input  type="text" floating-number-only ng-pattern="/(^[0-9]{1,9})+(.[0-9]{1,4})?$/" ng-model="vm.cheque" name="cheque" id="cheque" class="form-control input-hike-large text-right " style="">';
    $scope.submitOrder = function () {
      $rootScope.submit();
      //$ngBootbox.hideAll();
    };

    $scope.Paymenttabs = [
      {
        id: 1,
        title: "Cash",
        content: $sce.trustAsHtml(header + cash + numericCalculator + fotter),
        active: true,
      },
      {
        id: 2,
        title: "Credit",
        content: $sce.trustAsHtml(header + credit + numericCalculator + fotter),
      },
      {
        id: 3,
        title: "Bank",
        content: $sce.trustAsHtml(header + bank + numericCalculator + fotter),
      },
      {
        id: 4,
        title: "Cheque",
        content: $sce.trustAsHtml(header + cheque + numericCalculator + fotter),
      },
    ];
    var activePayment;
    $rootScope.mop = [];
    $scope.$watch("vm.cash", function (newValue, oldValue) {
      //console.log("Cash" + newValue);
      var index = helper.getArrayIndex(1, $rootScope.mop);
      $scope.updatePayment(index, newValue);
    });
    $scope.$watch("vm.credit", function (newValue, oldValue) {
      var index = helper.getArrayIndex(2, $rootScope.mop);
      $scope.updatePayment(index, newValue);
    });
    $scope.$watch("vm.bank", function (newValue, oldValue) {
      var index = helper.getArrayIndex(3, $rootScope.mop);
      $scope.updatePayment(index, newValue);
    });
    $scope.$watch("vm.cheque", function (newValue, oldValue) {
      var index = helper.getArrayIndex(4, $rootScope.mop);
      $scope.updatePayment(index, newValue);
    });
    $scope.updatePayment = function (index, newValue) {
      if (index !== -1) {
        $rootScope.mop[index].value = newValue;
        $scope.sumRemaining();
      }
    };

    $scope.sumRemaining = function () {
      $scope.toPay = helper.getSumPay($rootScope.mop, "value");
      $scope.remaining =
        parseInt($rootScope.grandTotal) - parseInt($scope.toPay);
    };

    $scope.setActive = function (pAymentTypeId) {
      //console.log("Tab Change"+pAymentTypeId);
      activePayment = pAymentTypeId;
      //Single Mode Of Payment
      $rootScope.mop = [];
      switch (activePayment) {
        case 1:
          tabFocus("cash");
          tabSelect("cash");
          var cash = { name: "Cash", id: activePayment, value: $scope.vm.cash };
          $rootScope.mop.push(cash);
          $scope.sumRemaining();
          break;
        case 2:
          tabFocus("credit");
          tabSelect("credit");
          var credit = {
            name: "Credit",
            id: activePayment,
            value: $scope.vm.credit,
          };
          $rootScope.mop.push(credit);
          $scope.sumRemaining();
          break;
        case 3:
          tabFocus("bank");
          tabSelect("bank");
          var bank = { name: "Bank", id: activePayment, value: $scope.vm.bank };
          $rootScope.mop.push(bank);
          $scope.sumRemaining();
          break;
        case 4:
          tabFocus("cheque");
          tabSelect("cheque");
          var cheque = {
            name: "Cheque",
            id: activePayment,
            value: $scope.vm.cheque,
          };
          $rootScope.mop.push(cheque);
          $scope.sumRemaining();
          break;
        default:
          console.log("No FOCUS");
      }
    };
    /* $scope.$watch('activeTab', function(newVal) {
     console.log(newVal);  
     });*/
    $scope.vm.set = function (key) {
      switch (activePayment) {
        case 1:
          tabFocus("cash");
          if (key == "C") {
            $scope.vm.cash = "";
          } else {
            $scope.vm.cash = $scope.vm.cash + key;
          }

          break;
        case 2:
          tabFocus("credit");
          if (key == "C") {
            $scope.vm.credit = "";
          } else {
            $scope.vm.credit = $scope.vm.credit + key;
          }

          break;
        case 3:
          tabFocus("bank");
          if (key == "C") {
            $scope.vm.bank = "";
          } else {
            $scope.vm.bank = $scope.vm.bank + key;
          }
          break;
        case 4:
          tabFocus("cheque");
          if (key == "C") {
            $scope.vm.cheque = "";
          } else {
            $scope.vm.cheque = $scope.vm.cheque + key;
          }
          break;
        default:
          console.log("No Selected Payment Method");
      }
    };
  }
);
app.config(function ($routeProvider) {
  $routeProvider.when("/", {
    templateUrl: baseUrl + "/sale/views/Pos.html",
    controller: "POS",
  });
});
