<form action="{{ route('users.store') }}" id="formcreateUser" method="POST">
    @csrf
    <x-input-with-icon icon="ti ti-user" label="Nama User" name="name" />
    <x-input-with-icon icon="ti ti-user" label="Username" name="username" />
    <x-input-with-icon icon="ti ti-mail" label="Email" name="email" />
    <x-input-with-icon icon="ti ti-key" label="Password" name="password" type="password" />
    <x-select label="Role" name="role" :data="$roles" key="name" textShow="name" />
    <x-select label="Unit" name="kode_unit" :data="$unit" key="kode_unit" textShow="nama_unit" upperCase="true" />
    <x-select label="Departemen" name="kode_dept" :data="$dept" key="kode_dept" textShow="nama_dept" upperCase="true" />
    <x-select label="Jabatan" name="kode_jabatan" :data="$jabatan" key="kode_jabatan" textShow="nama_jabatan" upperCase="true" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>

<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/users/create.js') }}"></script>
