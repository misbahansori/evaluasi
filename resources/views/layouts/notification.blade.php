@if (session('success'))
	<div class="alert badge-success text-white alert-dismissible fade show" role="alert" style="border-radius:0">
		<strong>Sukses!</strong> {{ session('success') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif
@if (session('danger'))
	<div class="alert badge-danger text-white alert-dismissible fade show" role="alert" style="border-radius:0">
		<strong>Peringatan!</strong> {{ session('danger') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif
