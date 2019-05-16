$(function () {
	$('.tampilMentorEdit').on('click', function () {
		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/lesinaja.com/user/getmentoredit',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('#jurusan').val(data.jurusan);
				$('#angkatan').val(data.angkatan);
				$('#pengajar').val(data.matkul);
				$('#ipk').val(data.grade);
				$('#alamat').val(data.address);
				$('#telp').val(data.phone);
			}
		})
	})

	$('.tampilModalDetail').on('click', function () {
		const id = $(this).data('id');
		console.log(id);
		$.ajax({
			url: 'http://localhost/lesinaja.com/admin/getdetail',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				var date = data.date_created;
				var time = parseInt(date);
				var time2 = time * 1000;
				var tanggal = new Date(time2)
				$('.card-img').attr('src', 'http://localhost/lesinaja.com/assets/img/profile/' + String(data.image));
				$('#name1').html('Name :' + data.name);
				$('#email1').html('Email :' + data.email);
				$('#role_id1').html('Role ID :' + data.role_id);
				$('#date_created1').html('Date Created :' + tanggal);
			}
		})
	});

	$('.tampilModalUbah').on('click', function () {

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/lesinaja.com/admin/getubah',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('#name').val(data.name);
				$('#email').val(data.email);
				$('#role_id').val(data.role_id);
				$('#id').val(data.id);
			}
		})
	});

	$('.TampilEditMenu').on('click', function () {
		$('#NewMenuModalLabel').html('Edit Menu');
		$('.modal-footer button[type=submit]').html('Edit')
		$('.modal-body form').attr('action', 'http://localhost/lesinaja.com/menu/edit');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/lesinaja.com/menu/getubah',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('#menu').val(data.menu);
				$('#id').val(data.id);
			}
		})
	});

	$('.tombolTambahMenu').on('click', function () {
		$('#NewMenuModalLabel').html('Add New Menu');
		$('.modal-footer button[type=submit]').html('Add');
		$('.modal-body form').attr('action', 'http://localhost/lesinaja.com/menu');

	});

	$('.TampilEditSubmenu').on('click', function () {
		$('#NewSubmenuModalLabel').html('Edit Submenu');
		$('.modal-footer button[type=submit]').html('Edit');
		$('.modal-body form').attr('action', 'http://localhost/lesinaja.com/menu/editsub');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/lesinaja.com/menu/getubahsub',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('#title').val(data.title);
				$('#menu_id').val(data.menu_id);
				$('#url').val(data.url);
				$('#icon').val(data.icon);
				$('#is_active').val(data.is_active);
				$('#id').val(data.id);
			}
		})
	});

	$('.tombolTambahSubmenu').on('click', function () {
		$('#NewSubmenuModalLabel').html('Add New Submenu');
		$('.modal-footer button[type=submit]').html('Add');
		$('.modal-body form').attr('action', 'http://localhost/lesinaja.com/menu/submenu');

	});

	$('.TampilEditRole').on('click', function () {
		$('#NewRoleModalLabel').html('Edit Role');
		$('.modal-footer button[type=submit]').html('Edit');
		$('.modal-body form').attr('action', 'http://localhost/lesinaja.com/admin/editrole');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/lesinaja.com/admin/getubahrole',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('#role').val(data.role);
				$('#id').val(data.id);
			}
		})
	});

	$('.tombolTambahRole').on('click', function () {
		$('#NewRoleModalLabel').html('Add New Role');
		$('.modal-footer button[type=submit]').html('Add');
		$('.modal-body form').attr('action', 'http://localhost/lesinaja.com/admin/role');

	});

	$('.DetailOrder').on('click', function () {

		const id = $(this).data('id');
		console.log(id);
		$.ajax({
			url: 'http://localhost/lesinaja.com/admin/orderdetail',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('#order_id').val(data.order_id);
				$('#mentor_id').val(data.mentor_id);
				$('#note').val(data.note);
				$('#email').val(data.email);
				$('#address').val(data.address);
				$('#date').val(data.date);
				$('#hour').val(data.hour);
				$('#minute').val(data.minute);
				$('#timestamp').val(data.timestamp);
				$('.card-img').attr('src', 'http://localhost/lesinaja.com/assets/img/order/' + String(data.upload));
			}
		})
	});
});
