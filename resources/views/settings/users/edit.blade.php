<form action="{{ route('users.update', Crypt::encrypt($user->id)) }}" id="formeditUser" method="POST">
    @csrf
    @method('PUT')
    <x-input-with-icon icon="ti ti-user" label="Nama User" name="name" value="{{ $user->name }}" />
    <x-input-with-icon icon="ti ti-user" label="Username" name="username" value="{{ $user->username }}" />
    <x-input-with-icon icon="ti ti-mail" label="Email" name="email" value="{{ $user->email }}" />
    <x-input-with-icon icon="ti ti-key" label="Password" name="password" type="password" />
    <x-select label="Role" name="role" :data="$roles" key="name" textShow="name" />
    <x-select label="Unit" name="kode_unit" :data="$unit" key="kode_unit" textShow="nama_unit" upperCase="true"
        selected="{{ $user->kode_unit }}" />
    <x-select label="Departemen" name="kode_dept" :data="$dept" key="kode_dept" textShow="nama_dept" upperCase="true"
        selected="{{ $user->kode_dept }}" />
    <x-select label="Jabatan" name="kode_jabatan" :data="$jabatan" key="kode_jabatan" textShow="nama_jabatan" upperCase="true"
        selected="{{ $user->kode_jabatan }}" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="repeat-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>

<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/users/edit.js') }}"></script>
