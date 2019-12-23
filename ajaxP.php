<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Siana.siatiger's Garden :: Study Page :: 페이지 정열 </title>
	<style type="text/css">
	.clickable {cursor: pointer;}
	.hover {text-decoration: underline;}
	table{text-align:left;}
	th{ background:#F90;}
	.odd{ background: #FFC;}
	.even{ background: #FF9;}
	.active{ width:10px; height:10px; background:#0CC;}
	</style>
	<script src="assets/js/jquery.min.js"></script>
	<script type="text/javascript">
	 
	 jQuery.fn.alternateRowColors = function() {
	   $('tbody tr:odd', this)
		 .removeClass('even').addClass('odd');
	   $('tbody tr:even', this)
		 .removeClass('odd').addClass('even');
	   return this;
	 };
	 
	 $(document).ready(function() {
	   $('table.sortable').each(function() {
		 var $table = $(this);
		 $table.alternateRowColors();
		 $('th', $table).each(function(column) {
		   var $header = $(this);
		   
		   var findSortKey;
		   if ($header.is('.sort-basic')) {
			 findSortKey = function($cell) {
			   return $cell.text().toUpperCase();
			 };
		   }
		   else if ($header.is('.sort-ranking')) {
			 findSortKey = function($cell) {
			   var key = $cell.text();
			   key = parseFloat(key);
			   return isNaN(key) ? 0 : key;
			 };
		   }     
			   
		   if (findSortKey) {
			 $header.addClass('clickable').hover(function() {
			   $header.addClass('hover');
			 }, function() {
			   $header.removeClass('hover');
			 }).click(function() {
				 
				 var sortDirection = 1;
			   if ($header.is('.sorted-asc')) {
				 sortDirection = -1;
			   }
				 
				 
			   var rows = $table.find('tbody > tr').get();
			   $.each(rows, function(index, row) {
				 var $cell = $(row).children('td').eq(column);
				 row.sortKey = findSortKey($cell);
			   });
			   
			   rows.sort(function(a, b) {
				 if (a.sortKey < b.sortKey) return -sortDirection;
				 if (a.sortKey > b.sortKey) return sortDirection;
				 return 0;
			   });
			   $.each(rows, function(index, row) {
				 $table.children('tbody').append(row);
				 row.sortKey = null;
			   });
			   
			   $table.find('th').removeClass('sorted-asc')
				 .removeClass('sorted-desc');
			   if (sortDirection == 1) {
				 $header.addClass('sorted-asc');
			   }
			   else {
				 $header.addClass('sorted-desc');
			   }
			   $table.alternateRowColors();
			   $table.trigger('repaginate');
			
			 });
		   }
		 });
	   });
	 });



	 $(document).ready(function() {
	  $('table.paginated').each(function() {
		var currentPage = 0;
		var numPerPage = 5;
		var $table = $(this);

	/*     $table.find('tbody tr').hide()
	       .slice(currentPage * numPerPage,
	         (currentPage + 1) * numPerPage)
	       .show();
	
	   $table.bind('repaginate', function() {
	      $table.find('tbody tr').hide()
	        .slice(currentPage * numPerPage,
	          (currentPage + 1) * numPerPage)
	        .show();
	*/		
		$table.bind('repaginate', function() {
		  $table.find('tbody tr').hide()
			.slice(currentPage * numPerPage,
			  (currentPage + 1) * numPerPage)
			.show();
		});

		var numRows = $table.find('tbody tr').length;
		var numPages = Math.ceil(numRows / numPerPage);
		var $pager = $('<div class="pager"></div>');
		for (var page = 0; page < numPages; page++) {
		  $('<span class="page-number"></span>').text(page + 1)
			.bind('click', {newPage: page}, function(event) {
			  currentPage = event.data['newPage'];
			  $table.trigger('repaginate');
			  $(this).addClass('active')
				.siblings().removeClass('active');
			}).appendTo($pager).addClass('clickable');
		}
		$pager.insertBefore($table)
		  .find('span.page-number:first').addClass('active');
	  });
	});	
	</script>

</head>

<body>
<table class="sortable paginated">
<caption>베스트셀러</caption>
    <thead>
      <tr>
        <th>이미지</th>
        <th class="sort-ranking">순위</th>
        <th class="sort-basic">책제목</th>
        <th class="sort-basic">저자</th>
        <th class="sort-basic">출판사</th>
        <th class="sort-ranking">가격</th>
      </tr>
    </thead>
    <tbody>
      <tr>
       <td><img src="http://bookthumb.phinf.naver.net/cover/061/864/06186469.jpg?type=m1" /></td>
       <td>1</td>
       <td>덕혜옹주</td>
       <td>권비영</td>
       <td>다산책방</td>
       <td>11,800원</td>
      </tr>
      <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/062/277/06227737.jpg?type=m1" /></td>
       <td>2</td>
       <td>삼성을 생각한다</td>
       <td>김용철</td>
       <td>사회평론</td>
       <td>22,000원</td>
      </tr>
      <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/061/962/06196209.jpg?type=m1" /></td>
       <td>3</td>
       <td>죽을 때 후회하는 스물다섯 가지</td>
       <td>오츠 슈이치</td>
       <td>21세기북스</td>
       <td>12,000원</td>
      </tr>
      <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/062/123/06212320.jpg?type=m1" /></td>
       <td>4</td>
       <td>시크릿 두 번째 이야기</td>
       <td>폴 해링턴</td>
       <td>살림</td>
       <td>12,000원</td>
      </tr>
      <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/060/537/06053729.jpg?type=m1" /></td>
       <td>5</td>
       <td>1Q84</td>
       <td>무라카미 하루키</td>
       <td>문학동네</td>
       <td>14,800원</td>
      </tr>
      
        <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/061/932/06193283.jpg?type=m1" /></td>
       <td>6</td>
       <td>마법의 돈관리</td>
       <td>고득영</td>
       <td>국일미디어</td>
       <td>12,000원</td>
      </tr>
      
        <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/061/972/06197265.jpg?type=m1" /></td>
       <td>7</td>
       <td>박철범의 하루공부법</td>
       <td>박철범</td>
       <td>다산에듀</td>
       <td>12,000원</td>
      </tr>
      
        <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/049/791/04979122.jpg?type=m1" /></td>
       <td>8</td>
       <td>엄마를 부탁해</td>
       <td>신경숙</td>
       <td>창비</td>
       <td>10,000원</td>
      </tr>
      
        <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/060/474/06047439.jpg?type=m1" /></td>
       <td>9</td>
       <td>아이의 사생활</td>
       <td>EBS</td>
       <td>지식채널</td>
       <td>16,800원</td>
      </tr>
      
        <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/060/376/06037660.jpg?type=m1" /></td>
       <td>10</td>
       <td>그건, 사랑이였네</td>
       <td>한비야</td>
       <td>푸른숲</td>
       <td>12,000원</td>
      </tr>
      
        <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/062/246/06224688.jpg?type=m1" /></td>
       <td>11</td>
       <td>김연아의 7분 드라마</td>
       <td>김연아</td>
       <td>중아출판사</td>
       <td>15,000원</td>
      </tr>
      
        <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/062/171/06217189.jpg?type=m1" /></td>
       <td>12</td>
       <td>아버지의 눈물</td>
       <td>김정현</td>
       <td>문이당</td>
       <td>11,000원</td>
      </tr>
      
        <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/029/108/02910899.jpg?type=m1" /></td>
       <td>13</td>
       <td>쓸만한 아이</td>
       <td>이금이</td>
       <td>푸른책들</td>
       <td>8,800원</td>
      </tr>
      
        <tr>
      <td><img src="http://bookthumb.phinf.naver.net/cover/052/586/05258669.jpg?type=m1" /></td>
       <td>14</td>
       <td>일본전산이야기</td>
       <td>감성호</td>
       <td>쌤앤파커스</td>
       <td>14,500원</td>
      </tr>
      
    </tbody>
  </table>

</body>
</html>
