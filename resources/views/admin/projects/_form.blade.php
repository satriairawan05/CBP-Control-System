<form action="{{ $formAction }}" id="form" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-12">
                <label for="title">Title <span class="text-danger">*</span> </label>
                <input type="text"
                    class="form-control form-control-sm @error('title')
                                    is-invalid
                                @enderror"
                    id="title" placeholder="Masukan Project Title" value="{{ old('title', $project->title ?? '') }}"
                    name="title" required>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $errors->get('title')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="summary">Summary <span class="text-danger">*</span> </label>
                <textarea name="summary" id="summary" rows="10" cols="100" required>{{ old('summary', $project->summary ?? '') }}</textarea>
                @error('summary')
                    <div class="invalid-feedback">
                        {{ $errors->get('summary')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="description">Description <span class="text-danger">*</span> </label>
                <textarea name="description" id="description" rows="10" cols="100" required>{{ old('description', $project->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $errors->get('description')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="deadline">Deadline <span class="text-danger">*</span> </label>
                <input type="date" class="form-control form-control-sm @error('deadline') is-invalid @enderror"
                    id="deadline" placeholder="Masukan Deadline" value="{{ old('deadline', $project->deadline ?? '') }}"
                    name="deadline" required>
                @error('deadline')
                    <div class="invalid-feedback">
                        {{ $errors->get('deadline')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="type">Type <span class="text-danger">*</span> </label>
                <select id="type" class="form-control form-control-sm" name="type">
                    @php
                        $type = [['name'=>'Magang'],['name'=>'Skripsi']];
                    @endphp
                    @foreach ($type as $t)
                        @if (old('type', $project->type ?? '') == $t['name'])
                            <option value="{{ $t['name'] }}" selected>{{ $t['name'] }}
                            </option>
                        @else
                            <option value="{{ $t['name'] }}">{{ $t['name'] }}</option>
                        @endif
                    @endforeach
                </select>
                @error('type')
                    <div class="invalid-feedback">
                        {{ $errors->get('type')[0] }}
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            CKEDITOR.replace('summary');
            CKEDITOR.replace('description');
            $('#type').select2();
        });
    </script>
@endpush
