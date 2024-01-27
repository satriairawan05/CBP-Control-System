<form action="{{ $formAction }}" id="form" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-6">
                <label for="feature">Feature <span class="text-danger">*</span> </label>
                <input type="text"
                    class="form-control form-control-sm @error('feature') is-invalid @enderror"
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
                    <input type="text" class="form-control form-control-sm @error('budget') is-invalid @enderror"
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
            <div class="col-6">
                <label for="summary">Summary <span class="text-danger">*</span> </label>
                <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" id="summary" rows="10" cols="100">{{ old('summary', $task->summary ?? '') }}</textarea>
                @error('summary')
                    <div class="invalid-feedback">
                        {{ $errors->get('summary')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="description">Description <span class="text-danger">*</span> </label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="10" cols="100">{{ old('description', $task->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $errors->get('description')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="project_id">Project <span class="text-danger">*</span></label>
                <select id="project" class="form-control @error('project_id') is-invalid @enderror form-control-sm" name="project_id">
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
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ $cancelRoute }}" class="btn btn-sm btn-info mx-2"><i class="fa fa-reply-all"></i></a>
                <button type="submit" id="btnsubmit" class="btn btn-sm btn-success">{{ $submitButton }}</button>
            </div>
        </div>
    </div>
</form>

@push('js')
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/angka.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#budget").on("keyup", function() {
                $("#budget").val(formatAngka(this.value));
            });

            $('#form').on('submit', function() {
                $("#budget").val(unformatAngka($("#budget").val()));
            });

            CKEDITOR.replace('summary');
            CKEDITOR.replace('description');
        });
    </script>
@endpush
