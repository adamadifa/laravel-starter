<form action="{{ route('siswa.store') }}" aria-autocomplete="false" id="formSiswa" method="POST">
  @csrf
  <div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="divider text-start">
        <div class="divider-text">
          <i class="ti ti-user"></i> Data Siswa
        </div>
      </div>
      <x-input-with-icon-label icon="ti ti-barcode" label="NISN" name="nisn" />
      <x-input-with-icon-label icon="ti ti-user" label="Nama Lengkap" name="nama_lengkap" />
      <div class="form-group mb-3">
        <label for="exampleFormControlInput1" style="font-weight: 600" class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
          <option value="">Jenis Kelamin</option>
          <option value="L">Laki - Laki</option>
          <option value="P">Perempuan</option>
        </select>
      </div>
      <x-input-with-icon-label icon="ti ti-map-pin" label="Tempat Lahir" name="tempat_lahir" />
      <x-input-with-icon-label icon="ti ti-calendar" label="Tanggal Lahir" name="tanggal_lahir" />
      <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
          <x-input-with-icon-label icon="ti ti-user" label="Anak Ke" name="anak_ke" />
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
          <x-input-with-icon-label icon="ti ti-users" label="Jumlah Saudara" name="jumlah_saudara" />
        </div>
      </div>
      <x-textarea-label name="alamat" label="Alamat" />
      <x-select-label label="Provinsi" name="id_province" :data="$provinsi" key="id" textShow="name"
        select2="select2Provinsi" upperCase="true" />
      <div class="form-group mb-3">
        <label style="font-weight: 600" class="form-label">Kabupaten / Kota</label>
        <select name="id_regency" id="id_regency" class="select2Regency form-select">
        </select>
      </div>
      <div class="form-group mb-3">
        <label style="font-weight: 600" class="form-label">Kecamatan</label>
        <select name="id_district" id="id_district" class="select2District form-select">
        </select>
      </div>
      <div class="form-group mb-3">
        <label style="font-weight: 600" class="form-label">Desa / Kelurahan</label>
        <select name="id_village" id="id_village" class="select2Village form-select">
        </select>
      </div>
      <x-input-with-icon-label icon="ti ti-barcode" label="Kode Pos" name="kode_pos" />
    </div>
    <div class="col-lg-1">
      <div class="divider divider-vertical">
        <div class="divider-text">
          <i class="ti ti-crown"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-5 col-md-12 col-sm-12">
      <div class="divider text-start">
        <div class="divider-text">
          <i class="ti ti-users"></i> Data Orangtua
        </div>
      </div>
      <x-input-with-icon-label icon="ti ti-barcode" label="No. KK" name="no_kk" />
      <x-input-with-icon-label icon="ti ti-credit-card" label="NIK. Ayah" name="nik_ayah" />
      <x-input-with-icon-label icon="ti ti-user" label="Nama Lengkap Ayah" name="nama_ayah" />
      <div class="form-group mb-3">
        <label style="font-weight: 600" class="form-label">Pendidikan Ayah</label>
        <select name="pendidikan_ayah" id="pendidikan_ayah" class="form-select">
          <option value="">Pendidikan Ayah</option>
          @foreach ($pendidikan as $p)
            <option value="{{ $p }}">{{ $p }}</option>
          @endforeach
        </select>
      </div>
      <x-input-with-icon-label icon="ti ti-building-skyscraper" label="Pekerjaan Ayah" name="pekerjaan_ayah" />


      <x-input-with-icon-label icon="ti ti-credit-card" label="NIK. Ibu" name="nik_ibu" />
      <x-input-with-icon-label icon="ti ti-user" label="Nama Lengkap Ibu" name="nama_ibu" />
      <div class="form-group mb-3">
        <label style="font-weight: 600" class="form-label">Pendidikan Ibu</label>
        <select name="pendidikan_ibu" id="pendidikan_ibu" class="form-select">
          <option value="">Pendidikan Ibu</option>
          @foreach ($pendidikan as $p)
            <option value="{{ $p }}">{{ $p }}</option>
          @endforeach
        </select>
      </div>
      <x-input-with-icon-label icon="ti ti-building-skyscraper" label="Pekerjaan Ibu" name="pekerjaan_ibu" />

      <x-input-with-icon-label icon="ti ti-phone" label="No. HP Orangtua" name="no_hp_orang_tua" />
      <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
          <ion-icon name="send-outline" class="me-1"></ion-icon>
          Submit
        </button>
      </div>
    </div>
  </div>

</form>
<script src="{{ asset('assets/js/pages/siswa.js') }}"></script>
<script>
  $(function() {
    const select2Provinsi = $('.select2Provinsi');
    if (select2Provinsi.length) {
      select2Provinsi.each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>').select2({
          placeholder: 'Pilih Provinsi',
          dropdownParent: $this.parent(),
          allowClear: true
        });
      });
    }

    const select2Regency = $('.select2Regency');
    if (select2Regency.length) {
      select2Regency.each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>').select2({
          placeholder: 'Pilih Kabupaten / Kota',
          dropdownParent: $this.parent(),
          allowClear: true
        });
      });
    }

    const select2District = $('.select2District');
    if (select2District.length) {
      select2District.each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>').select2({
          placeholder: 'Pilih Kecamatan',
          dropdownParent: $this.parent(),
          allowClear: true
        });
      });
    }

    const select2Village = $('.select2Village');
    if (select2Village.length) {
      select2Village.each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>').select2({
          placeholder: 'Pilih Desa / Kelurahan',
          dropdownParent: $this.parent(),
          allowClear: true
        });
      });
    }

    function getRegency() {
      var id_province = $("#formSiswa").find("#id_province").val();
      $.ajax({
        type: 'POST',
        url: '/regency/getregencybyprovince',
        data: {
          _token: "{{ csrf_token() }}",
          id_province: id_province,
        },
        cache: false,
        success: function(respond) {
          console.log(respond);
          $("#formSiswa").find("#id_regency").html(respond);
        }
      });
    }

    function getDistrict() {
      var id_regency = $("#formSiswa").find("#id_regency").val();
      $.ajax({
        type: 'POST',
        url: '/district/getdistrictbyregency',
        data: {
          _token: "{{ csrf_token() }}",
          id_regency: id_regency,
        },
        cache: false,
        success: function(respond) {
          console.log(respond);
          $("#formSiswa").find("#id_district").html(respond);
        }
      });
    }

    function getVillage() {
      var id_district = $("#formSiswa").find("#id_district").val();
      $.ajax({
        type: 'POST',
        url: '/village/getvillagebydistrict',
        data: {
          _token: "{{ csrf_token() }}",
          id_district: id_district,
        },
        cache: false,
        success: function(respond) {
          console.log(respond);
          $("#formSiswa").find("#id_village").html(respond);
        }
      });
    }

    getRegency();
    getDistrict();
    getVillage();

    $("#id_province").change(function() {
      getRegency();
    });

    $("#id_regency").change(function() {
      getDistrict();
    });

    $("#id_district").change(function() {
      getVillage();
    });
  });
</script>
