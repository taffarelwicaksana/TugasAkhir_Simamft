$(document).ready(function(){$('.zero-configuration').DataTable();$('.default-ordering').DataTable({"order":[[3,"desc"]]});$('.multi-ordering').DataTable({columnDefs:[{targets:[0],orderData:[0,1]},{targets:[1],orderData:[1,0]},{targets:[4],orderData:[4,0]}]});$('.complex-headers').DataTable();$('.dom-positioning').DataTable({"dom":'<"top"i>rt<"bottom"flp><"clear">'});$('.alt-pagination').DataTable({"pagingType":"full_numbers"});$('.scroll-vertical').DataTable({"scrollY":"200px","scrollCollapse":true,"paging":false});$('.dynamic-height').DataTable({scrollY:'50vh',scrollCollapse:true,paging:false});$('.scroll-horizontal').DataTable({"scrollX":true});$('.scroll-horizontal-vertical').DataTable({"scrollY":200,"scrollX":true});$('.comma-decimal-place').DataTable({"language":{"decimal":",","thousands":"."}});});