$(function () {

	function addCommas(nStr) {
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}

	let cekTeam = $('.cek-exist').data('teamexist');
	if (cekTeam < 1) {
		$('.tombol-team').html(`<a href="" class="btn btn-primary mb-3 tombolCreateTeam float-left" data-toggle="modal" data-target="#createTeam">Create new Team</a>`);
		$('.search-field, .table-team, .opsi-team').addClass('d-none');
	} else {
		$('.tombol-team').html(`<a href="" class="btn btn-primary mb-3 tombolRecruit float-left" data-toggle="modal" data-target="#formModal">Recruit new Crew</a>`);
		$('.search-field, .table-team, .opsi-team').removeClass('d-none');
	}

	$('#list-harga').on('change', function () {
		var idPricelist = $('#list-harga').val();

		$.ajax({
			url: 'http://localhost/uanq/inventory/ajaxGetHarga',
			data: {
				idJson: idPricelist
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {

				console.log(data);
				$('#hargaBeli').val(data.hargaBeli);
				$('#hargaJual').val(data.hargaJual);
				$('#hargaReseller').val(data.hargaReseller);
			}
		})
	});

	$('.tombolCreateTeam').on('click', function () {
		$('.judulModalcreateTeam').html('Create new Team');

		$('.form-team').attr('action', 'http://localhost/uanq/user/addTeam');

		$('#bisnis').val(0);
		$('#nama-team').val('');
	});

	$('#email-crew').keyup(function () {
		let emailCrew = $(this).val();

		$.ajax({
			url: 'http://localhost/uanq/user/ajaxCheckUser',
			data: {
				idJson: emailCrew
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {

				console.log(data);
				if (data === 'User available.') {
					$('.crew-footer').html(`<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitData">Submit</button>`);
				} else {
					$('.crew-footer').html('');
				}
			}
		});
	});

	// Tombol choose file, ahar bisa mengeluarkan nama file
	$('.custom-file-input').on('change', function () {
		// Ambil nama file
		let fileName = $(this).val().split('\\').pop();

		// Lalu nama filenya isi kedalam file inputnya
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	});

	// Tombol edit menu
	$('.tombolEditMenu').on('click', function () {
		$('.judulModalMenu').html('Edit New Menu');
		$('.submitMenu').html('Edit Menu');

		$('.formActive').attr('action', 'http://localhost/uanq/menu/menuedit');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/uanq/menu/getmenuedit',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {

				$('#idMenu').val(data.idMenu);
				$('#menu').val(data.namaMenu);

			}
		});

	});
	// Tombol tambah menu
	$('.tombolTambahMenu').on('click', function () {
		$('.judulModalMenu').html('Add New Menu');
		$('.submitMenu').html('Add Menu');

		$('.formActive').attr('action', 'http://localhost/uanq/menu');

		$('#idMenu').val('');
		$('#menu').val('');

	});


	// Tombol edit sub menu
	$('.tombolEditSubmenu').on('click', function () {
		$('.judulModalSubmenu').html('Edit New Submenu');
		$('.submitSubmenu').html('Edit Submenu');

		$('.formActive').attr('action', 'http://localhost/uanq/menu/submenuedit');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/uanq/menu/getsubmenuedit',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {

				$('#idSubmenu').val(data.idSubMenu);
				$('#judulSubmenu').val(data.judulSubMenu);
				$('#menu_id').val(data.idMenu);
				$('#urlSubmenu').val(data.urlSubMenu);
				$('#iconSubmenu').val(data.iconSubMenu);
				$('#isActive').val(data.isActiveMenu);
			}
		});

	});
	// Tombol tambah sub menu
	$('.tombolTambahSubmenu').on('click', function () {
		$('.judulModalSubmenu').html('Add New Submenu');
		$('.submitSubmenu').html('Add Submenu');

		$('.formActive').attr('action', 'http://localhost/uanq/menu/submenu');

		$('#idSubmenu').val('');
		$('#judulSubmenu').val('');
		$('#menu_id').val('');
		$('#urlSubmenu').val('');
		$('#iconSubmenu').val('');
	});


	// Tombol checkbox dari roleAccess
	$('.cekbox').on('click', function () {

		// Tangkap idMenu dan idRole yang dikirimkan
		const menuId = $(this).data('menu');
		const roleId = $(this).data('role');

		// Lalu oper lagi ke method changeAccess() dengan type POST
		$.ajax({
			url: 'http://localhost/uanq/admin/changeaccess',
			type: 'POST',
			data: {
				menuId: menuId,
				roleId: roleId
			},
			success: function () {
				document.location.href = 'http://localhost/uanq/admin/roleaccess/' + roleId;
			}

		});
	});


	// Tombol edit sub menu
	$('.tombolEditEarning').on('click', function () {
		$('.judulModalEarning').html('Edit New Earning');
		$('.submitEarning').html('Edit Earning');

		$('.formActive').attr('action', 'http://localhost/uanq/user/earningEdit');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/uanq/user/earningGetAjax',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {

				$('#idEarning').val(data.idEarning);
				$('#judulTransaksi').val(data.transaksi);
				$('#incomeTransaksi').val(data.income);
				$('#outcomeTransaksi').val(data.outcome);
				$('#dateCreated').val(data.dateCreated);

			}
		});

	});
	// Tombol tambah sub menu
	$('.tombolTambahEarning').on('click', function () {
		$('.judulModalEarning').html('Add New Earning');
		$('.submitEarning').html('Add Earning');

		$('.formActive').attr('action', 'http://localhost/uanq/user/earning');

		$('#judulTransaksi').val('');
		$('#incomeTransaksi').val('');
		$('#outcomeTransaksi').val('');
	});



	// Tombol order untuk inventory
	$('.tombolOrder').on('click', function () {

		const id = $(this).data('idorder');

		$.ajax({
			url: 'http://localhost/uanq/inventory/ajaxGetProduk',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {

				$('#idProduks').val(data.idProduk);
				$('#produk').val(data.namaProduk);
				$('#stoky').val(data.stokProduk);
				$('#qty').attr('max', data.stokProduk);

				$('#qty').keyup(function () {
					let qty = parseInt($('#qty').val());

					if (qty > data.stokProduk) {
						$('#qty').val(data.stokProduk);
					} else {
						qty;
					}
				})
			}
		});
	});
	// Edit Produk
	$('.tombolEditProduk').on('click', function () {
		$('.judulModalTambahProduk').html('Edit Data Produk');
		$('.submitProduk').html('Edit Produk');

		$('.formActive').attr('action', 'http://localhost/uanq/inventory/editProduk');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/uanq/inventory/ajaxGetProduk',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('#email').val(data.email);
				$('#idProduk').val(data.idProduk);
				$('#cabang').val(data.idCabang);
				$('#namaProduk').val(data.namaProduk);
				$('#stokProduk').val(data.stokProduk);
				$('#hargaBeli').val(data.hargaBeli);
				$('#hargaJual').val(data.hargaJual);
				$('#dateCreated').val(data.dateCreated);

			}
		});
	});
	// Tambah Produk
	$('.tombolTambahProduk').on('click', function () {
		$('.judulModalTambahProduk').html('Tambah Data Produk');
		$('.submitProduk').html('Tambah Produk');

		$('.formActive').attr('action', 'http://localhost/uanq/inventory');

		$('#email').val('');
		$('#idProduks').val('');
		$('#cabang').val('0');
		$('#namaProduk').val('');
		$('#stokProduk').val('');
		$('#hargaBeli').val('');
		$('#hargaJual').val('');
		$('#dateCreated').val('');
		$('#dateModified').val('');
	});

	// Tambah Barang
	$('.tombolTambahBarang').on('click', function () {
		$('.judulModalTambahBarang').html('Tambah Data Barang');
		$('.submitBarang').html('Tambah Barang');

		$('.formActive').attr('action', 'http://localhost/uanq/inventory/products');

		$('#produkID').val('');
		$('#produkNama').val('');
		$('#cabang').val(0);
		$('#list-harga').val(0);
		$('#hargaBeli').val('');
		$('#hargaJual').val('');
		$('#hargaReseller').val('');
	});
	// Edit Barang
	$('.tombolEditBarang').on('click', function () {
		$('.judulModalTambahBarang').html('Edit Data Barang');
		$('.submitBarang').html('Edit Barang');

		$('.formActive').attr('action', 'http://localhost/uanq/inventory/editBarang');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/uanq/inventory/ajaxGetBarang',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('#produkID').val(data.produkID);
				$('#produkNama').val(data.produkNama);
				$('#cabang').val(data.cabangID);
				$('#list-harga').val(data.hargaID);
				$('#hargaBeli').val(data.hargaBeli);
				$('#hargaJual').val(data.hargaJual);
				$('#hargaReseller').val(data.hargaReseller);
			}
		});
	});
	// Tombol order untuk barang
	$('.tombolOrderBarang').on('click', function () {

		const id = $(this).data('idorder');

		$.ajax({
			url: 'http://localhost/uanq/inventory/ajaxGetBarang',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				console.log(data);
				$('#produkIDs').val(data.produkID);
				$('#cabangID').val(data.cabangID);
				$('#produk').val(data.produkNama);
				$('#hargaModal').val(data.hargaBeli);
				$('#harga').html(`
					<option value="`+ data.hargaBeli + `">Harga Beli &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.hargaBeli) + `</option>
					<option value="`+ data.hargaJual + `">Harga Jual &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.hargaJual) + `</option>
					<option value="`+ data.hargaReseller + `">Harga Reseller &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.hargaReseller) + `</option>
				`);
			}
		});
	});
	// Quantity
	$('#quantity').on('keyup', function () {
		var qty = parseInt($('#quantity').val());
		var harga = parseInt($('#harga').val());
		var totalHarga = qty * harga;

		$('#totalHarga').val(totalHarga);
	});
	// Select Harga
	$('#harga').on('change', function () {
		var qty = parseInt($('#quantity').val());
		var harga = parseInt($('#harga').val());
		var totalHarga = qty * harga;

		$('#totalHarga').val(totalHarga);
	})

	// Tambah Harga
	$('.tombolTambahHarga').on('click', function () {
		$('.judulModalTambahHarga').html('Tambah Data Harga');
		$('.submitHarga').html('Tambah Harga');

		$('.formActive').attr('action', 'http://localhost/uanq/inventory/pricelist');

		$('#hargaID').val('');
		$('#hargaTipe').val('');
		$('#hargaBeli').val('');
		$('#hargaJual').val('');
		$('#hargaReseller').val('');
	});
	// Edit Harga
	$('.tombolEditHarga').on('click', function () {
		$('.judulModalTambahHarga').html('Edit Data Harga');
		$('.submitHarga').html('Edit Harga');

		$('.formActive').attr('action', 'http://localhost/uanq/inventory/editHarga');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/uanq/inventory/ajaxGetHarga',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('#hargaID').val(data.hargaID);
				$('#hargaTipe').val(data.hargaTipe);
				$('#hargaBeli').val(data.hargaBeli);
				$('#hargaJual').val(data.hargaJual);
				$('#hargaReseller').val(data.hargaReseller);
			}
		});
	});


	// Tombol Tambah Cabang
	$('.tombolTambahCabang').on('click', function () {
		$('.judulModalTambahCabang').html('Tambah Data Cabang');
		$('.submitCabang').html('Tambah Cabang');

		$('.formActive').attr('action', 'http://localhost/uanq/inventory/cabang');

		$('#namaCabang').val('');
		$('#alamatCabang').val('');
		$('#telpCabang').val('');
	});
	// Tombol Edit Cabang
	$('.tombolEditCabang').on('click', function () {
		$('.judulModalTambahCabang').html('Edit Data Cabang');
		$('.submitCabang').html('Edit Cabang');

		$('.formActive').attr('action', 'http://localhost/uanq/inventory/editCabang');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/uanq/inventory/ajaxGetCabang',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {

				$('#idCabang').val(data.idCabang);
				$('#namaCabang').val(data.namaCabang);
				$('#alamatCabang').val(data.alamatCabang);
				$('#telpCabang').val(data.telpCabang);
			}
		});
	});


	// Date Picker Start Date
	let $startdate = $('#datepicker').datepicker({
		format: 'yyyy-mm-dd',
		uiLibrary: 'bootstrap4',
		iconsLibrary: 'fontawesome'
	});
	// Date Picker End Date
	$('#datepicker').on('change', function () {
		$('.end-date').html(`<label for="datepickers">Sampai tanggal</label><input type="text" width="276" autocomplete="off" class="form-control" id="datepickers" name="end-date">`);
		$('#datepickers').datepicker({
			format: 'yyyy-mm-dd',
			minDate: $startdate.value(),
			uiLibrary: 'bootstrap4',
			iconsLibrary: 'fontawesome'
		});
	});


	// Orders
	let cekOrder = $('#tombolOrder').data('order');
	if (cekOrder < 1) {

		Swal.fire({
			title: 'Order kamu kosong!',
			html: 'Kamu bisa buat order baru melalui halaman inventory atau klik tombol <span class="text-primary">Tambah Order Baru</span>.',
			width: 800,
			padding: '2em',
			icon: 'info'
		});

		$('#tombolOrder').html('<a href="http://localhost/uanq/inventory" title="Tambah order baru" class="btn btn-primary">Tambah Order Baru</a><a href="http://localhost/uanq/inventory/deals" title="Cek transaksi" class="btn btn-secondary ml-2">Cek Transaksi</a>');
	} else {
		$('#tombolOrder').html('<a href="" class="btn btn-primary tombolProsesOrder" title="Proses seluruh order" data-toggle="modal" data-target="#formModal">Proses Order</a><a href="http://localhost/uanq/inventory/cancelOrder" title="Tombol ini akan menghapus seluruh order" class="btn btn-secondary ml-2 tombolHapus">Batalkan Order</a>');
	}
	// Ketika tombol edit ditekan, ambil data produk menggunakan ajax
	$('.tombolEditOrder').on('click', function () {
		$('.judulModalOrder').html('Edit Data Order');
		$('.editOrder').html('Edit Order');

		$('.formActive').attr('action', 'http://localhost/uanq/inventory/editOrder');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/uanq/inventory/ajaxGetOrder',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('#harga').html(`
					<option value="`+ data.hargaBeli + `">Harga Beli &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.hargaBeli) + `</option>
					<option value="`+ data.hargaJual + `">Harga Jual &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.hargaJual) + `</option>
					<option value="`+ data.hargaReseller + `">Harga Reseller &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.hargaReseller) + `</option>
				`);
				$('#idOrders').val(data.idOrder);
				$('#customerName').val(data.customerName);
				$('#namaBarang').val(data.namaBarang);
				$('#hargaJual').val(data.hargaJual);
				$('#quantity').val(data.qtyOrder);
				$('#harga').val(data.hargaJual);
				$('#totalHarga').val(data.totalHarga);
				$('#hargaModal').val(data.hargaBeli);
			}
		});
	});
	// Ketika tombol edit ditekan, ambil data produk menggunakan ajax
	$('.tombolUpdateOrder').on('click', function () {
		$('.judulModalOrder').html('Update Data Order');
		$('.editOrder').show();
		$('.editOrder').html('Update Order');

		$('.formActive').attr('action', 'http://localhost/uanq/inventory/updateOrder');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/uanq/inventory/ajaxGetOrder',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {

				if (data.status == 2) {
					$('#status').html(`
						<option value="2" selected disabled>REFUND</option>
						<option value="9">ARRIVED</option>
					`);
				} else {
					$('#status').html(`
						<option value="1">PROCESS</option>
						<option value="2">REFUND</option>
						<option value="9">ARRIVED</option>
					`);
				}

				$('#harga').html(`
					<option value="`+ data.hargaBeli + `">Harga Beli &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.hargaBeli) + `</option>
					<option value="`+ data.hargaJual + `">Harga Jual &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.hargaJual) + `</option>
					<option value="`+ data.hargaReseller + `">Harga Reseller &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.hargaReseller) + `</option>
				`);
				$('#idOrders').val(data.idOrder);
				$('#idProduk').val(data.produkID);
				$('#customerName').val(data.customerName);
				$('#namaBarang').val(data.namaBarang);
				$('#hargaJual').val(data.hargaJual);
				$('#quantity').val(data.qtyOrder);
				$('#harga').val(data.hargaJual);
				$('#totalHarga').val(data.totalHarga);
				$('#hargaModal').val(data.hargaBeli);
				$('#status').val(data.status);
				$('#keterangan').html(data.keterangan);

				$('#customerName').removeAttr('readonly', 'true');
				$('#status').removeAttr('disabled', 'true');
				$('#keterangan').removeAttr('readonly', 'true');
			}
		});
	});
	// Ketika tombol edit ditekan, ambil data produk menggunakan ajax
	$('.tombolDetail').on('click', function () {
		$('.judulModalOrder').html('Detail Data Order');
		$('.editOrder').hide();

		$('.formActive').attr('action', '');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/uanq/inventory/ajaxGetOrder',
			data: {
				idJson: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {

				if (data.order.status == 2) {
					$('#status').html(`
						<option value="2" selected disabled>REFUND</option>
						<option value="9">ARRIVED</option>
					`);
				} else {
					$('#status').html(`
						<option value="1">PROCESS</option>
						<option value="2">REFUND</option>
						<option value="9">ARRIVED</option>
					`);
				}

				$('#harga').html(`
					<option value="`+ data.harga.hargaBeli + `">Harga Beli &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.harga.hargaBeli) + `</option>
					<option value="`+ data.harga.hargaJual + `">Harga Jual &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.harga.hargaJual) + `</option>
					<option value="`+ data.harga.hargaReseller + `">Harga Reseller &#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199;&#8199; ` + addCommas(data.harga.hargaReseller) + `</option>
				`);
				$('#customerName').val(data.order.customerName);
				$('#namaBarang').val(data.order.namaBarang);
				$('#hargaJual').val(data.harga.hargaJual);
				$('#quantity').val(data.order.qtyOrder);
				$('#harga').val(data.order.hargaJual);
				$('#totalHarga').val(data.order.totalHarga);
				$('#hargaModal').val(data.harga.hargaBeli);
				$('#status').val(data.order.status);
				$('#keterangan').html(data.order.keterangan);

				$('#customerName').attr('readonly', 'true');
				$('#status').attr('disabled', 'true');
				$('#keterangan').attr('readonly', 'true');
			}
		});
	});
	// Ketika nilai qty di form edit di ubah maka otomatis kalkulasi stok dan total harga
	$('#qtyOrder').on('change', function () {

		let qty = parseInt($('#qtyOrder').val());
		let stokAsli = parseInt($('#stokAsli').val());

		if (isNaN(qty)) {
			$('#stokBarang').val(stokAsli);
		} else {
			if (qty > stokAsli) {
				$('#qtyOrder').val(stokAsli)
				qty = stokAsli;
			} else {
				qty;
			}

			let hargaJual = parseInt($('#hargaJual').val());
			let total = qty * hargaJual;
			let stokBarang = stokAsli - qty;

			$('#totalHarga').val(total);
			$('#stokBarang').val(stokBarang);
		}
	});
	$('#uangDiterima').autoNumeric('init', {
		aPad: false,
		vMin: '0.00'
	});
	$('#total-belanja').autoNumeric('init', {
		aPad: false,
		vMin: '0.00'
	});
	$('#kembalian').autoNumeric('init', {
		aPad: false,
		vMin: '-999999999999999.99'
	});

	$('#uangDiterima').keyup(function () {
		let bayar = parseInt($('#uangDiterima').autoNumeric('get'));
		let total = parseInt($('#total-belanja').autoNumeric('get'));
		let kembalian = bayar - total;
		console.log(kembalian);


		$('#kembalian').autoNumeric('set', kembalian);
	});

	// Deals
	let cekTransaksi = $('#tombolDeals').data('deals');
	if (cekTransaksi < 1) {
		Swal.fire({
			title: 'Transaksi kamu kosong!',
			html: 'Kamu bisa buat transaksi baru melalui halaman inventory atau klik tombol <span class="text-primary">Tambah Transaksi Baru</span>.',
			width: 800,
			padding: '2em',
			icon: 'info'
		});
	}

	let $mindate = $('#start-date').datepicker({
		format: 'yyyy-mm-dd',
		uiLibrary: 'bootstrap4',
		iconsLibrary: 'fontawesome'
	})
	$('#start-date').on('change', function () {
		$('#end-date').attr('readonly', false);
		$('.end-date-picker').html('<label for="end-date">End Date</label> <input type="text" autocomplete="off" class="form-control" name="end-date" id="end-date">')
		$('#end-date').datepicker({
			format: 'yyyy-mm-dd',
			uiLibrary: 'bootstrap4',
			minDate: $mindate.value(),
			iconsLibrary: 'fontawesome'
		});
	});



});
