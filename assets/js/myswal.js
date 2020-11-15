$(function () {

	// Menu swals
	const succadd = $('.succadd').data('succadd');
	if (succadd) {
		Swal.fire({
			icon: 'success',
			width: 600,
			padding: '2em',
			title: 'Add ' + succadd + ' success!',
			html: "Congratulations, you have some new " + succadd + "."
		})
	}
	const failadd = $('.failadd').data('failadd');
	if (failadd) {
		Swal.fire({
			icon: 'warning',
			width: 600,
			padding: '2em',
			title: 'Add ' + failadd + ' fail!',
			html: "Please fill all the information that needed."
		})
	}
	const succupdate = $('.succupdate').data('succupdate');
	if (succupdate) {
		Swal.fire({
			icon: 'success',
			width: 600,
			padding: '2em',
			title: 'Update ' + succupdate + ' success!',
			html: "Congratulations, you have updated some " + succupdate + "."
		})
	}
	const failupdate = $('.failupdate').data('failupdate');
	if (failupdate) {
		Swal.fire({
			icon: 'warning',
			width: 600,
			padding: '2em',
			title: 'Update ' + failupdate + ' fail!',
			html: "Please fill all the information that needed."
		})
	}

	// Login swals
	const wrongEmail = $('.wrong-email').data('wemail');
	if (wrongEmail) {
		Swal.fire({
			icon: 'warning',
			width: 800,
			padding: '2em',
			title: 'Oops, email salah!',
			html: "<span class='text-primary'>" + wrongEmail + "</span> tidak terdaftar. Kamu harus registrasi dulu."
		})
	}
	const activeEmail = $('.active-email').data('aemail');
	if (activeEmail) {
		Swal.fire({
			icon: 'warning',
			width: 800,
			padding: '2em',
			title: 'Oops, email kamu belum aktif!',
			html: "<span class='text-primary'>" + activeEmail + "</span> belum diaktivasi. Silahkan cek email kamu untuk melakukan aktivasi"
		})
	}
	const wrongPassword = $('.wrong-password').data('wpass');
	if (wrongPassword) {
		Swal.fire({
			icon: 'warning',
			width: 600,
			padding: '2em',
			title: 'Oops, password salah!',
			html: "Kamu lupa password? mending kamu pakai fitur lupa passwordnya."
		})
	}

	// Register swals
	const registrationSuccess = $('.registration-success').data('regsucs');
	if (registrationSuccess) {
		Swal.fire({
			icon: 'success',
			width: 600,
			padding: '2em',
			title: 'Registrasi Berhasil!',
			html: "Silahkan cek email kamu untuk melakukan aktivasi. Email aktivasi akan expired dalam 24 jam."
		})
	}
	const wrongToken = $('.wrong-token').data('wtoken');
	if (wrongToken) {
		Swal.fire({
			icon: 'warning',
			width: 600,
			padding: '2em',
			title: wrongToken + " Failed!",
			html: "Your token is not valid for some reason."
		})
	}
	const expiredToken = $('.expired-token').data('etoken');
	if (expiredToken) {
		Swal.fire({
			icon: 'warning',
			width: 600,
			padding: '2em',
			title: 'Activation Failed!',
			html: "Your token is expired, please register again and make sure activate it before 24 hours."
		})
	}
	const successToken = $('.success-token').data('stoken');
	if (successToken) {
		Swal.fire({
			icon: 'success',
			width: 600,
			padding: '2em',
			title: 'Activation Success!',
			html: "<span class='text-primary'>" + successToken + "</span> activation success, please login."
		})
	}

	// Forgot password swals
	const successforgot = $('.success-forgot').data('sforgot');
	if (successforgot) {
		Swal.fire({
			icon: 'info',
			width: 800,
			padding: '2em',
			title: 'Forgot password success, but..!',
			html: "But itsn't finish yet, you must check your email to reset your password."
		})
	}
	const wrongforgot = $('.wrong-forgot').data('wforgot');
	if (wrongforgot) {
		Swal.fire({
			icon: 'warning',
			width: 600,
			padding: '2em',
			title: 'Oops, wrong email!',
			html: "<span class='text-primary'>" + wrongforgot + "</span> is not registered or activated."
		})
	}
	const exToken = $('.ex-token').data('extoken');
	if (exToken) {
		Swal.fire({
			icon: 'warning',
			width: 800,
			padding: '2em',
			title: 'Reset Password Failed!',
			html: "Your token is expired, please forgot password again and make sure use it before 24 hours."
		})
	}
	const successReset = $('.success-reset').data('sreset');
	if (successReset) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Reset Password Success!',
			html: "Please remember and keep your password carefully, and do not tell your password to anyone."
		})
	}

	// Logout swals
	const logout = $('.logout').data('logout');
	if (logout) {
		Swal.fire({
			icon: 'success',
			width: 600,
			padding: '2em',
			title: 'Logout Success!',
			html: "Goodbye, please come back soon! we miss you already."
		})
	}

	// Earning swals
	const successEarning = $('.success-earning').data('searning');
	if (successEarning) {
		Swal.fire({
			icon: 'success',
			width: 600,
			padding: '2em',
			title: 'Add new earning!',
			html: "Data transaksi kamu akan diakumulasikan setiap harinya."
		})
	}
	const deleteEarning = $('.delete-earning').data('delearning');
	if (deleteEarning) {
		Swal.fire({
			icon: 'success',
			width: 600,
			padding: '2em',
			title: 'Delete earning!',
			html: "Earning otomatis di akumulasikan dengan data yang kamu hapus"
		})
	}
	const editEarning = $('.edit-earning').data('edearning');
	if (editEarning) {
		Swal.fire({
			icon: 'success',
			width: 600,
			padding: '2em',
			title: 'Edit earning success!',
			html: "Edit earning kamu berhasil"
		})
	}

	// Produk swals
	const produkAdded = $('.success-add').data('produkadd');
	if (produkAdded) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Tambah Produk Berhasil!',
			html: 'Kamu berhasil menambahkan sebuah produk.'
		});
	}
	const produkUpdate = $('.success-update').data('produkupd');
	if (produkUpdate) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Edit Produk Berhasil!',
			html: 'Kamu berhasil mengedit produk <span class="text-primary">' + produkUpdate + '</span>'
		});
	}
	const produkDelete = $('.success-delete').data('produkdel');
	if (produkDelete) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Delete Produk Berhasil!',
			html: 'Kamu berhasil menghapus produk. Produk yang sudah dihapus tidak dapat dikembalikan.'
		});
	}

	// Cabang Swals
	const cabangAdd = $('.success-addCabang').data('cabangadd');
	if (cabangAdd) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Tambah Cabang Baru Berhasil!',
			html: 'Kamu berhasil menambah <span class="text-primary">' + cabangAdd + '</span>'
		});
	}
	const cabangEdit = $('.success-editCabang').data('cabangedit');
	if (cabangEdit) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Edit Cabang Berhasil!',
			html: 'Kamu berhasil merubah data <span class="text-primary">' + cabangEdit + '</span>'
		});
	}
	const cabangDelete = $('.success-deleteCabang').data('cabangdelete');
	if (cabangDelete) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Hapus Cabang Berhasil!',
			html: 'Kamu berhasil menghapus cabang. Cabang yang sudah kamu hapus tidak dapat dikembalikan.'
		});
	}

	// Order swals
	const formFail = $('.fail-form').data('failform');
	if (formFail) {
		console.log(formFail);

		// Sweet alert, untuk confirm yakin ingin dihapus
		Swal.fire({
			title: 'Oops, ' + formFail + ' gagal!',
			html: "Sepertinya data yang kamu kirimkan belum lengkap, silahkan coba lagi.",
			width: 650,
			padding: '2em',
			icon: 'warning'
		});
	}
	const orderAdd = $('.success-addorder').data('addorder');
	if (orderAdd) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Order Berhasil',
			html: 'Barang <i class="text-primary">' + orderAdd + '</i> berhasil di order, silahkan cek halaman order.'
		}).then((result) => {
			Swal.fire({
				title: 'Mau tambah order lagi?',
				text: "Jika tidak, kamu akan diarahkan ke halaman order.",
				width: '600px',
				padding: '2em',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, mau',
				cancelButtonText: 'Tidak, terima kasih'
			}).then((result) => {
				if (result.value) {

				} else {
					document.location.href = 'http://localhost/uanq/inventory/orders';
				}
			})
		})

	}
	const orderFail = $('.fail-addorder').data('failorder');
	if (orderFail) {
		// Sweet alert, untuk confirm yakin ingin dihapus
		Swal.fire({
			title: 'Oops, kamu sudah order barang ini!',
			html: "Barang <span class='text-primary'>" + orderFail + "</span> sudah pernah kamu order, mau cek?",
			width: 650,
			padding: '2em',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, cek order!',
			cancelButtonText: 'Tidak, terima kasih'
		}).then((result) => {
			// Jika tombol ya ditekan, maka redirect bedasarkan href tombol yang diklik
			if (result.value) {
				document.location.href = 'http://localhost/uanq/inventory/orders';
			}
		});
	}
	const deleteOrder = $('.delete-order').data('deleteorder');
	if (deleteOrder) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Order berhasil dihapus',
			html: 'Kamu berhasil menghapus sebuah order'
		});
	}
	const editOrder = $('.edit-order').data('editorder');
	if (editOrder) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Order berhasil diubah',
			html: 'Kamu berhasil mengubah sebuah order'
		});
	}
	const failEditOrder = $('.fail-edit-order').data('faileditorder');
	if (failEditOrder) {
		Swal.fire({
			icon: 'warning',
			width: 800,
			padding: '2em',
			title: 'Oops, edit order gagal!',
			html: 'Ada yang salah dengan quantity order yang kamu masukkan.'
		});
	}
	const prosesOrder = $('.proses-order').data('prosesorder');
	if (prosesOrder) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Order selesai',
			html: 'Kamu berhasil melakukan transaksi barang.'
		}).then((result) => {
			Swal.fire({
				title: 'Mau lihat data transaksi?',
				text: "Jika iya, kamu akan diarahkan ke halaman transaksi.",
				width: '600px',
				padding: '2em',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, mau',
				cancelButtonText: 'Tidak, terima kasih'
			}).then((result) => {
				if (result.value) {
					document.location.href = 'http://localhost/uanq/inventory/deals';
				}
			})
		})
	}

	const editDeals = $('.edit-deals').data('editdeals');
	if (editDeals) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Deals berhasil diupdate',
			html: 'Kamu berhasil mengupdate sebuah deals'
		});
	}
	const failEditDeals = $('.fail-edit-deals').data('faileditdeals');
	if (failEditDeals) {
		Swal.fire({
			icon: 'warning',
			width: 800,
			padding: '2em',
			title: 'Oops, edit deals gagal!',
			html: 'Kamu tidak bisa merubah data yang berstatus refund, kecuali merubahnya menjadi arrived.'
		});
	}

	// Admin swals
	const failAdd = $('.fail-add').data('failadd');
	if (failAdd) {
		Swal.fire({
			icon: 'warning',
			width: 800,
			padding: '2em',
			title: 'Oops, tambah data gagal',
			html: 'Tambah data ' + failAdd + ' gagal, sepertinya data yang kamu kirimkan belum lengkap.'
		});
	}
	const successAdd = $('.success-add').data('succadd');
	if (successAdd) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Tambah data berhasil',
			html: 'Sebuah data ' + successAdd + ' berhasil ditambahkan.'
		});
	}
	const successDelete = $('.success-delete').data('succdelete');
	if (successDelete) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Delete data berhasil',
			html: 'Sebuah data ' + successDelete + ' berhasil dihapus.'
		});
	}
	const successAddTeam = $('.success-add-team').data('succaddteam');
	if (successAddTeam) {
		Swal.fire({
			title: 'Hey, ' + successAddTeam + ' welcome to the jungle',
			html: 'Congratulation, your team has been made up. But first, please re-login.',
			width: '600px',
			padding: '2em',
			icon: 'question',
			showCancelButton: false,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Okay',
		}).then((result) => {
			if (result.value) {
				document.location.href = 'http://localhost/uanq/auth/logout';
			}
		});
	}
	const successEdit = $('.success-edit').data('succedit');
	if (successEdit) {
		Swal.fire({
			icon: 'success',
			width: 800,
			padding: '2em',
			title: 'Edit data berhasil',
			html: 'Sebuah data ' + successEdit + ' berhasil diperbarui.'
		});
	}
	// Universal swals

	// Delete button swals
	$('.tombolHapus').on('click', function (e) {
		e.preventDefault();

		const href = $(this).attr('href');

		// Sweet alert, untuk confirm yakin ingin dihapus
		Swal.fire({
			title: 'Yakin ingin dihapus?',
			text: "Kamu gak bisa mengembalikan data yang sudah dihapus.",
			icon: 'warning',
			width: 800,
			padding: '2em',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yaa, hapus data',
			cancelButtonText: 'Gak, gajadi'
		}).then((result) => {
			// Jika tombol ya ditekan, maka redirect bedasarkan href tombol yang diklik
			if (result.value) {
				document.location.href = href;
			}
		})
	});
});