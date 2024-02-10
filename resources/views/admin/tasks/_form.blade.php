<form action="{{ $formAction }}" id="form" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-6">
                <label for="feature">Feature <span class="text-danger">*</span> </label>
                <input type="text" class="form-control @error('feature') is-invalid @enderror"
                    id="feature" placeholder="Masukan Feature" value="{{ old('feature', $task->feature ?? '') }}"
                    name="feature">
                @error('feature')
                    <div class="invalid-feedback">
                        {{ $errors->get('feature')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="budget">Budget <span class="text-danger">*</span> </label>
                <span class="input-grou-text">
                    <input type="text" class="form-control @error('budget') is-invalid @enderror"
                        id="budget" placeholder="Masukan Budget" value="{{ old('budget', $task->budget ?? '') }}"
                        name="budget">
                </span>
                @error('budget')
                    <div class="invalid-feedback">
                        {{ $errors->get('budget')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="summary">Summary <span class="text-danger">*</span> </label>
                <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" id="summary" rows="10"
                    cols="100">{{ old('summary', $task->summary ?? '') }}</textarea>
                @error('summary')
                    <div class="invalid-feedback">
                        {{ $errors->get('summary')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="project_id">Project <span class="text-danger">*</span></label>
                <select id="project" class="form-control @error('project_id') is-invalid @enderror"
                    name="project_id">
                    <option value="" selected>Without Project</option>
                    @foreach ($project as $d)
                        @if (old('project_id', $task->project_id ?? '') == (int) $d->id)
                            <option value="{{ (int) $d->id }}" selected>{{ $d->title }}
                            </option>
                        @else
                            <option value="{{ (int) $d->id }}">{{ $d->title }}</option>
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
            <div class="col-12">
                <label for="status">Status <span class="text-danger">*</span> </label>
                <select id="status" class="form-control @error('status') is-invalid @enderror"
                    name="status">
                    @php
                        $status = [['status' => 'Submit'], ['status' => 'Done']];
                    @endphp
                    <option value="" selected>Without Status</option>
                    @foreach ($status as $s)
                        @if (old('status', $task->status ?? '') == $s['status'])
                            <option value="{{ $s['status'] }}" selected>{{ $s['status'] }}
                            </option>
                        @else
                            <option value="{{ $s['status'] }}">{{ $s['status'] }}</option>
                        @endif
                    @endforeach
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $errors->get('status')[0] }}
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
@endpush

@push('js')
    <script src="{{ asset('assets/vendor/select2/js/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/angka.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#budget").on("keyup", function() {
                $("#budget").val(formatAngka(this.value));
            });

            $('#form').on('submit', function() {
                $("#budget").val(unformatAngka($("#budget").val()));
            });

            $('#project').select2();
            $('#status').select2();
        });
    </script>
@endpush
