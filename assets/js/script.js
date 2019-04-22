$(function () {
	$('.tampilModalDetail').on('click', function () {
		const id = $(this).data('id');

		$.ajax({
			url: 'http://[::1]/lesinaja.com/admin/getdetail',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (data) {
				$('#name1').html(data.name);
				$('#email1').html(data.email);
				$('#role_id1').html(data.role_id);
				$('#date_created1').html(data.date_created);
			}
		})
	});

	$('.tampilModalUbah').on('click', function () {

		const id = $(this).data('id');

		$.ajax({
			url: 'http://[::1]/lesinaja.com/admin/getubah',
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
		$('.modal-body form').attr('action', 'http://[::1]/lesinaja.com/menu/edit');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://[::1]/lesinaja.com/menu/getubah',
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
		$('.modal-body form').attr('action', 'http://[::1]/lesinaja.com/menu');

	});

	$('.TampilEditSubmenu').on('click', function () {
		$('#NewSubmenuModalLabel').html('Edit Submenu');
		$('.modal-footer button[type=submit]').html('Edit');
		$('.modal-body form').attr('action', 'http://[::1]/lesinaja.com/menu/editsub');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://[::1]/lesinaja.com/menu/getubahsub',
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
		$('.modal-body form').attr('action', 'http://[::1]/lesinaja.com/menu/submenu');

	});

	$('.TampilEditRole').on('click', function () {
		$('#NewRoleModalLabel').html('Edit Role');
		$('.modal-footer button[type=submit]').html('Edit');
		$('.modal-body form').attr('action', 'http://[::1]/lesinaja.com/admin/editrole');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://[::1]/lesinaja.com/admin/getubahrole',
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
		$('.modal-body form').attr('action', 'http://[::1]/lesinaja.com/admin/role');

	});


});