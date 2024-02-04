<form action="{{ $formAction }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-12">
                <label for="project_id">Project <span class="text-danger">*</span></label>
                <select id="project" class="form-control @error('project_id') is-invalid @enderror"
                    name="project_id">
                    <option value="" selected>Without Project</option>
                    @foreach ($project as $d)
                        @if (old('project_id', $invoice->project_id ?? '') == (int) $d->id)
                            <option value="{{ $d->id }}" selected>{{ $d->title }} - {{ $d->code }}
                            </option>
                        @else
                            <option value="{{ $d->id }}">{{ $d->title }} - {{ $d->code }}</option>
                        @endif
                    @endforeach
                </select>
                @error('project_id')
                    <div class="invalid-feedback">
                        {{ $errors->get('project_id')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="first">First Party <span class="text-danger">*</span></label>
                <select id="first" class="form-control @error('first') is-invalid @enderror"
                    name="first">
                    <option value="" selected>Without User</option>
                    @foreach ($first as $d)
                        @if (old('first', $invoice->first ?? '') == $d->id)
                            <option value="{{ $d->id }}" selected>{{ $d->name }}
                            </option>
                        @else
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('first')
                    <div class="invalid-feedback">
                        {{ $errors->get('first')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="second">Second Party <span class="text-danger">*</span></label>
                <select id="second" class="form-control date @error('second') is-invalid @enderror"
                    name="second">
                    <option value="" selected>Without User</option>
                    @foreach ($second as $d)
                        @if (old('second', $invoice->second ?? '') == $d->id)
                            <option value="{{ $d->id }}" selected>{{ $d->name }}
                            </option>
                        @else
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('second')
                    <div class="invalid-feedback">
                        {{ $errors->get('second')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="effective_date">Effective Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="date" name="effective_date" placeholder="Effective Date" id="effective_date"
                        class="form-control @error('effective_date') is-invalid @enderror"
                        value="{{ $invoice->effective_date ?? old('effective_date') }}">
                    <span class="input-group-text">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    @error('effective_date')
                        <div class="invalid-feedback">
                            {{ $errors->get('effective_date')[0] }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <label for="expiration_date">Expired Date <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="date" name="expiration_date" placeholder="Expiration Date" id="expiration_date"
                        class="form-control @error('expiration_date') is-invalid @enderror"
                        value="{{ $invoice->expiration_date ?? old('expiration_date') }}">
                    <span class="input-group-text">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    @error('expiration_date')
                        <div class="invalid-feedback">
                            {{ $errors->get('expiration_date')[0] }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="payment">Payment Method <span class="text-danger">*</span></label>
                <select id="payment" class="form-control @error('payment') is-invalid @enderror"
                    name="payment">
                    @php
                        $type = [['type' => 'Down Payment'], ['type' => 'Redemption'], ['type' => 'Cash'], ['type' => 'Transfer']];
                    @endphp
                    <option value="" selected>Without Payment Method</option>
                    @foreach ($type as $d)
                        @if (old('payment', $invoice->payment ?? '') == $d['type'])
                            <option value="{{ $d['type'] }}" selected>{{ $d['type'] }}
                            </option>
                        @else
                            <option value="{{ $d['type'] }}">{{ $d['type'] }}</option>
                        @endif
                    @endforeach
                </select>
                @error('second')
                    <div class="invalid-feedback">
                        {{ $errors->get('second')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="account_number">Account Number</label>
                <input type="text" name="account_number" id="account_number"
                    class="form-control @error('account_number') is-invalid @enderror"
                    value="{{ $invoice->account_number ?? old('account_number') }}">
                @error('account_number')
                    <div class="invalid-feedback">
                        {{ $errors->get('account_number')[0] }}
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

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script type="text/javascript" src="{{ asset('assets/vendor/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}">
    </script>
    <script src="{{ asset('assets/vendor/jquery-maskedinput/jquery.maskedinput.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#project').select2();
            $('#first').select2();
            $('#second').select2();
            $('#payment').select2();

            flatpickr("#effective_date", {
                dateFormat: "Y-m-d",
                defaultDate: "today"
            });

            flatpickr("#expiration_date", {
                dateFormat: "Y-m-d",
            });
        });
    </script>
@endpush
