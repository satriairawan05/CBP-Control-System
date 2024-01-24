<form action="{{ $formAction }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-6">
                <label for="name">Name <span class="text-danger">*</span> </label>
                <input type="text"
                    class="form-control form-control-sm @error('name')
                                    is-invalid
                                @enderror"
                    id="name" placeholder="Masukan Nama" value="{{ old('name', $user->name ?? '') }}" name="name"
                    required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $errors->get('name')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="email">Email <span class="text-danger">*</span>
                </label>
                <input type="email"
                    class="form-control form-control-sm @error('email')
                                    is-invalid
                                @enderror"
                    id="email" placeholder="Masukan Email" value="{{ old('email', $user->email ?? '') }}"
                    name="email" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $errors->get('email')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="password">Password <span class="text-danger">*</span></label>
                <div id="showHidePassword" class="input-group">
                    <input type="password"
                        class="form-control form-control-sm @error('password')
                                    is-invalid
                                @enderror"
                        id="password" placeholder="Masukan Password" value="{{ old('password') }}" name="password"
                        required autocomplete="new-password">
                    <span class="input-group-text">
                        <a href="javascript:;" id="togglePassword"><i class="bx bx-lock text-4 text-dark"></i></a>
                    </span>
                </div>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $errors->get('password')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="password-confirm">Confirm Password <span class="text-danger">*</span></label>
                <div id="showHidePassword" class="input-group">
                    <input type="password"
                        class="form-control form-control-sm @error('password')
                                    is-invalid
                                @enderror"
                        id="passwordConfirm" placeholder="Masukan Password" value="{{ old('password') }}"
                        name="password_confirmation" required autocomplete="new-password">
                    <span class="input-group-text">
                        <a href="javascript:;" id="togglePasswordConfirm"><i
                                class="bx bx-lock text-4 text-dark"></i></a>
                    </span>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="address">Address <span class="text-danger">*</span> </label>
                <input type="text"
                    class="form-control form-control-sm @error('address')
                                    is-invalid
                                @enderror"
                    id="address" placeholder="Masukan Alamat" value="{{ old('address', $user->address ?? '') }}"
                    name="address" required>
                @error('address')
                    <div class="invalid-feedback">
                        {{ $errors->get('address')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="phone_number">Phone Number <span class="text-danger">*</span>
                </label>
                <input type="text"
                    class="form-control form-control-sm @error('phone_number')
                                    is-invalid
                                @enderror"
                    id="phone_number" placeholder="Masukan Nomor Handphone"
                    value="{{ old('phone_number', $user->phone_number ?? '') }}" name="phone_number" required>
                @error('phone_number')
                    <div class="invalid-feedback">
                        {{ $errors->get('phone_number')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="pob">Place of Birth <span class="text-danger">*</span> </label>
                <input type="text"
                    class="form-control form-control-sm @error('pob')
                                    is-invalid
                                @enderror"
                    id="pob" placeholder="Masukan Tempat Lahir" value="{{ old('pob', $user->pob ?? '') }}"
                    name="pob" required>
                @error('pob')
                    <div class="invalid-feedback">
                        {{ $errors->get('pob')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="dob">Date of Birth <span class="text-danger">*</span>
                </label>
                <input type="date"
                    class="form-control form-control-sm @error('dob')
                                    is-invalid
                                @enderror"
                    id="dob" placeholder="Masukan Tanggal Lahir" value="{{ old('dob', $user->dob ?? '') }}"
                    name="dob" required>
                @error('dob')
                    <div class="invalid-feedback">
                        {{ $errors->get('dob')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="nik">NIK <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control form-control-sm @error('nik')
                                    is-invalid
                                @enderror"
                    id="nik" placeholder="Masukan NIK" value="{{ old('nik', $user->nik ?? '') }}"
                    name="nik" required>
                @error('nik')
                    <div class="invalid-feedback">
                        {{ $errors->get('nik')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="group_id">Role <span class="text-danger">*</span></label>
                <select id="group" class="form-control form-control-sm" name="group_id">
                    @foreach ($group as $d)
                        @if (old('group_id', $user->group_id ?? '') == $d->group_id)
                            <option value="{{ $d->group_id }}" selected>{{ $d->group_name }}
                            </option>
                        @else
                            <option value="{{ $d->group_id }}">{{ $d->group_name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('group_id')
                    <div class="invalid-feedback">
                        {{ $errors->get('group_id')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ $cancelRoute }}" class="btn btn-sm btn-info mx-2"><i class="fa fa-reply-all"></i></a>
                <button type="submit" id="btnsubmit" class="btn btn-sm btn-success">{{ $submitButton }}</button>
            </div>
        </div>
    </div>
</form>
