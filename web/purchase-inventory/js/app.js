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
console.log(baseUrl);
app.directive("orderdatatable", [
  "$timeout",
  function ($timeout) {
    return {
      restrict: "A",

      link: function (scope, el, atts) {
        $timeout(function () {
          var orderTable = el.DataTable({
            columns: [
              { className: "text-left" },
              { className: "text-center" },
              { className: "text-center" },
              { className: "text-center" },
              { className: "text-center" },
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
    angular.element(document).find("body").removeClass("m-page--loading");

    $scope.selectedProduct = "";

    $scope.checkProductSelected = function () {
      console.log($scope.selectedProduct);
      if ($rootScope.productID) {
        return true;
      }
    };

    $rootScope.clear = function () {
      $rootScope.productID = "";
      //$rootScope.referredId=1;
      //$rootScope.referredName ="By Self";
      $rootScope.productName = "";
      $rootScope.productCode = "";
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

    $scope.removeProduct = function () {
      console.log($scope.selectedProduct);
      $scope.selectedProduct = "";
      $rootScope.productID = "";
      $rootScope.discount = 0.0;
      $rootScope.discountType = "";
      $rootScope.discountAmount = 0;
      localStorage.setItem("discountReason", 0);
      toastr.success("Product Remove Successfully", "", {
        timeOut: 2000,
        closeButton: false,
        preventDuplicates: true,
      });
      console.log($scope.selectedProduct);
    };

    $scope.$watch("selectedProduct", function (newValue, oldValue) {
      if ($scope.selectedProduct.id) {
        $scope.addToCart($scope.selectedProduct);
        console.log($rootScope);
      }
    });

    $scope.productDataSet = {
      displayKey: "title",
      limit: 10,
      source: function (query, syncResults, asyncResults) {
        var req = {
          url: baseUrl + "ajax/search-product?query=" + query,
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
        suggestion: function (data) {
          return [
            '<div class="movie-card"  >',
            '<img class="movie-card-poster" src="' +
              baseUrl +
              'images/user.png">',
            '<div class="movie-card-details">',
            '<div class="movie-card-name">' + data.name + "</div>",
            '<div class="movie-card-plot">' + data.variant_name + "</div>",
            '<div class="movie-card-plot">' + data.code + "</div>",
            "</div>",
            "</div>",
          ].join("\n");
        },
      },
    };

    $scope.units = [];

    $http({
      method: "GET",
      url: baseUrl + "ajax/all-unit",
    }).then(
      function (response) {
        console.log(response.data);
        $scope.units = response.data;
      },
      function (error) {}
    );

    $scope.showProductSelectError = function () {
      if (!$rootScope.productID) {
        toastr.error("Please Select Product", "", {
          timeOut: 3000,
          closeButton: false,
          preventDuplicates: true,
        });
      } else {
        toastr.error("Please Add Some Products", "", {
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

    $scope.removeOrder = function (data) {
      var index = $rootScope.orderlist.indexOf(data);
      $rootScope.orderlist.splice(index, 1);

      //Selected Remove Class

      var id = -1;

      $scope.updateOrder();
    };

    $scope.updateOrder = function () {
      $rootScope.total = 0.0;
      $rootScope.orderDiscount = 0.0;
      $rootScope.count = 0;
      $rootScope.tax = 0.0;
      $rootScope.grandTotal = 0.0;
      $rootScope.count = $rootScope.orderlist.length;
      $rootScope.orderlist.forEach(function (obj) {
        $rootScope.total += parseInt(obj.quantity * (obj.cost - obj.discount));
      });
      $rootScope.orderDiscount = $scope.orderDiscount;
      $rootScope.tax = $scope.tax;
      $rootScope.grandTotal = parseInt(
        $rootScope.total - $rootScope.orderDiscount + $rootScope.tax
      );
    };

    $scope.addToCart = function (data) {
      if ($rootScope.orderlist.length > 0) {
        var i = 0;
        $rootScope.orderlist.forEach(function (obj) {
          if ($scope.selectedProduct.id == parseInt(obj["id"])) {
            i++;
          }
        });
        if (!i) {
          toastr.success("Product Successfully Added", "", {
            timeOut: 2000,
            closeButton: false,
            preventDuplicates: true,
          });

          data.discount = 0;
          data.dS = 0;
          data.total = data.rate;
          $rootScope.orderlist.push(data);

          $scope.updateOrder();
        } else {
          toastr.error("Product Already Added", "", {
            timeOut: 2000,
            closeButton: false,
            preventDuplicates: true,
          });
        }
      } else {
        toastr.success("Product Successfully Added", "", {
          timeOut: 2000,
          closeButton: false,
          preventDuplicates: true,
        });

        data.discount = 0;
        data.dS = 0;
        data.total = data.rate;
        $rootScope.orderlist.push(data);

        $scope.updateOrder();
      }
    };

    $rootScope.submit = function () {
      var Indata = {
        patient_id: $rootScope.productID,
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

      $http.post(baseUrl + "ajax/submit-order", Indata).then(
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
    $scope.updateOrder();
    console.log($scope);
  }
);

app.config(function ($routeProvider) {
  $routeProvider.when("/", {
    templateUrl: baseUrl + "purchase-inventory/views/Inventory.html",
    controller: "POS",
  });
});
