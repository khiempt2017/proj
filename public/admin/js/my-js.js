$(document).ready(function() {
	let inputSearchField 	= $("input[name = search_field]"); //cái input type hidden của search field
	let inputSearchValue 	= $("input[name = search_value]"); //cái ô text box để nhập giá trị tìm kiếm 
	let selectDisplay		= $("select[name = select_change_display]");
	let selectLevel			= $("select[name = select_change_level]");
	let $btnSearch        	= $("#btn-search"); // Nút tìm kiếm
	let currentURL 			= window.location.href;
	console.log(currentURL);
	$("a.select-field").click(function(e) //Click vào giá trị của select-field sẽ lấy $this là chính đối tượng đó
	{
		e.preventDefault();
		let searchField = $(this).data("my-field"); //Lấy cái giá trị khi chọn ở phần select box
		let searchFieldName = $(this).html(); //Lấy cái đoạn text ra để gán vào ô tiêu đề
		$("button.btn-active-field").html(searchFieldName + '<span class="caret"></span>'); //Cập nhật lại cái đoạn test của search field để biết mình đang chọn ô nào
		inputSearchField.val(searchField); //Cập nhật giá trị cho cái hidden input để đưa field mình chọn lên URL
	})

	$("#btn-search").click(function(event){
		event.preventDefault();
		var pathName = window.location.pathname; //Lấy đường dẫn URL hiện tại (Ko lấy những cái tham số trên URL như ? về sau)

		let params   = ['filter_status']; //Bỏ những giá trị muốn search trên URL vào mảng 
		let searchParams= new URLSearchParams(window.location.search); //Tạo 1 đối tượng để search các biến trên URL
		var link = "";
		$.each( params, function( key, value ) {
			if (searchParams.has(value) ) { //Nếu search ra giá trị trong cái mảng (Tức là có tồn tại trên URL)
				link += value + "=" + searchParams.get(value) + "&" // value là tên cái biến trên URL, get(value) là lấy giá trị của cái biến đó ra.
			}
			
		});
		

		let search_field = inputSearchField.val();
		let search_value = inputSearchValue.val();

		//Ta đã có đường link chính, các tham số trên URL ==> Tiến hành gắn link và redirect
		let finalLink = pathName + "?" + link + 'search_field=' + search_field + '&' + 'search_value=' + search_value; 
		window.location.href = finalLink; //redirect. Xem như là submit
	  });

	$("#btn-clear").click(function(event){
	event.preventDefault();
	var pathName = window.location.pathname; //Lấy đường dẫn URL hiện tại (Ko lấy những cái tham số trên URL như ? về sau)

	let params   = ['filter_status']; //Bỏ những giá trị muốn search trên URL vào mảng 
	let searchParams= new URLSearchParams(window.location.search); //Tạo 1 đối tượng để search các biến trên URL
	var link = "";
	$.each( params, function( key, value ) {
		if (searchParams.has(value) ) { //Nếu search ra giá trị trong cái mảng (Tức là có tồn tại trên URL)
			link += value + "=" + searchParams.get(value) + "&" // value là tên cái biến trên URL, get(value) là lấy giá trị của cái biến đó ra.
		}
		console.log(link);
	});
	console.log(pathName);

	//Ta đã có đường link chính, các tham số trên URL ==> Tiến hành gắn link và redirect
	let finalLink = pathName + "?" + link;
	window.location.href = finalLink; //redirect. Xem như là submit
	});

	$(".btn-delete").click(function() //Hộp thoại hỏi xem có muốn xóa phần tử không
	{
		if(!confirm("Bạn có chắc muốn xóa phần tử không?"))
		return false;
	})

	$(selectDisplay).on('change',function() //Sự kiện 
	{
		let newValue 	= $(this).val(); //Lấy cái value mới sau khi đã chọn từ select box ra
		let linkURL 	= $(this).data("url"); //Lấy đường dẫn URL đã gắn vào select box ra. 
		linkURL 		= linkURL.replace('new_value',newValue); //Thay đổi cái chữ new_value trên URL thành value mới
		window.location.href = (linkURL);
	})

	$(selectLevel).on('change',function() //Sự kiện 
	{
		let newValue 	= $(this).val(); //Lấy cái value mới sau khi đã chọn từ select box ra
		let linkURL 	= $(this).data("url"); //Lấy đường dẫn URL đã gắn vào select box ra.
		linkURL 		= linkURL.replace('new_value',newValue); //Thay đổi cái chữ new_value trên URL thành value mới
		window.location.href = (linkURL);
	})
});