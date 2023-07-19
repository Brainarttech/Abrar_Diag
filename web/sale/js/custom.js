var helper = {};

helper.getArrayIndex = function (searchName,searchArray)
{
	var index = searchArray.findIndex(x => x.id==searchName);
	return index;
}

helper.getSumPay = function(items, prop){
    return items.reduce( function(a, b){
        return parseInt(a) + parseInt(b[prop]);
    }, 0);
};

helper.printExternal = function (url,width,height) {
    console.log('//////////////////////////////////// Print External ///////////////////////////////////////');
    var printWindow = window.open(url, 'Print', 'left=100, top=100, width=' + width + ', height=' + height + ', toolbar=0, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
          printWindow.close();
    }, true);
}






