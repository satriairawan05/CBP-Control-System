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
                        @if (old('project_id', $contract->project_id ?? '') == (int) $d->id)
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
                        @if (old('first', $contract->first ?? '') == $d->id)
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
                        @if (old('second', $contract->second ?? '') == $d->id)
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
                        value="{{ $contract->effective_date ?? old('effective_date') }}">
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
                        value="{{ $contract->expiration_date ?? old('expiration_date') }}">
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
            <div class="col-12">
                <table class="table-bordered table" id="contract-details">
                    <thead>
                        <tr>
                            <th>Pasal</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @if (count($contractDetail) > 0)
                        <tbody>
                            @foreach ($contractDetail as $detail)
                                <tr>
                                    <td>{{ $detail->pasal }}</td>
                                    <td>{{ $detail->title }}</td>
                                    <td>{!! $detail->description !!}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                    <tbody>
                        <tr>
                            <td>
                                <input type="text"
                                    class="form-control @error('pasal') is-invalid @enderror"
                                    id="pasal" placeholder="Masukan Pasal" value="{{ old('pasal[]') }}"
                                    name="pasal[]">
                                @error('pasal')
                                    <div class="invalid-feedback">
                                        {{ $errors->get('pasal')[0] }}
                                    </div>
                                @enderror
                            </td>
                            <td>
                                <input type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title" placeholder="Masukan Title" value="{{ old('title[]') }}"
                                    name="title[]">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $errors->get('title')[0] }}
                                    </div>
                                @enderror
                            </td>
                            <td>
                                <textarea name="description[]" placeholder="Masukan Description"
                                    class="form-control @error('description') is-invalid @enderror" id="description" rows="10" cols="50">{{ old('description[]') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $errors->get('description')[0] }}
                                    </div>
                                @enderror
                            </td>
                            <td id="btn-details">
                                <button class="btn btn-sm btn-dark d-none" id="removeDetail">-</button>
                                <button class="btn btn-sm btn-dark" id="addDetail">+</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
            // CKEDITOR.replace('description');

            $('#project').select2();
            $('#first').select2();
            $('#second').select2();

            flatpickr("#effective_date", {
                dateFormat: "Y-m-d",
                defaultDate: "today"
            });

            flatpickr("#expiration_date", {
                dateFormat: "Y-m-d",
            });

            $(document).on('click', '#addDetail', function(e) {
                e.preventDefault();
                const newRow = $('#contract-details tbody tr:first').clone();
                newRow.find('input, textarea').val('');
                newRow.find('td:eq(3)').empty();
                $('#contract-details tbody').append(newRow);
                $('#removeDetail').removeClass('d-none');
            });

            $(document).on('click', '#removeDetail', function(e) {
                e.preventDefault();
                const contractDetailCount = $('#contract-details tbody tr').length;

                $('#contract-details tbody tr:last').remove();

                if (contractDetailCount <= 2) {
                    $('#removeDetail').addClass('d-none');
                }
            });
        });
    </script>
@endpush
