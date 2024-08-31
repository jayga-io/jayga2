<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Jaygaa Dashboard</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/feathericon.min.css')}}">

	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}"> 
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<!-- Place the first <script> tag in your HTML's <head> -->
	<script src="https://cdn.tiny.cloud/1/f805ktplgd3vcc1pvvh0ci648lo1ri7ouzb38bzo14donovl/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

	<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
	<script>
	tinymce.init({
		selector: '',
		plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
		toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
		tinycomments_mode: 'embedded',
		tinycomments_author: 'Author name',
		mergetags_list: [
		{ value: 'First.Name', title: 'First Name' },
		{ value: 'Email', title: 'Email' },
		],
		ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
	});
	</script>
    
	<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
	<div class="main-wrapper">
	
		@include('admin.sidebar')
		<div class="page-wrapper">
			<div class="content container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script>
		let tablee = new DataTable('#myTable',{
			scrollX: true
		});
	</script>
	<script>
		let tabley = new DataTable('#earningTable');
	</script>
	
	
	<script>
		let tableeeio = new DataTable('#myTable2');
	</script>
	<script>
		let table2 = new DataTable('#myTableRefunds',{
			  scrollX: true
			});
	</script>
	<script>
		let table3 = new DataTable('#pendingTable',{
			  scrollX: true
			});
	</script>

	<script>
		let table6 = new DataTable('#pendTable',{
			scrollX: true
		});
	</script>
	<script>
		let table5 = new DataTable('#approvedTable',{
			scrollX: true
		});
	</script>

	<script>
		function incrementValue(e) {
			e.preventDefault();
			var fieldName = $(e.target).data('field');
			var parent = $(e.target).closest('div');
			var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

			if (!isNaN(currentVal)) {
				parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
			} else {
				parent.find('input[name=' + fieldName + ']').val(0);
			}
		}

		function decrementValue(e) {
			e.preventDefault();
			var fieldName = $(e.target).data('field');
			var parent = $(e.target).closest('div');
			var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

			if (!isNaN(currentVal) && currentVal > 0) {
				parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
			} else {
				parent.find('input[name=' + fieldName + ']').val(0);
			}
		}

		$('.input-group').on('click', '.button-plus', function (e) {
			incrementValue(e);
		});

		$('.input-group').on('click', '.button-minus', function (e) {
			decrementValue(e);
		});

	</script>
   
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	
	<script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>