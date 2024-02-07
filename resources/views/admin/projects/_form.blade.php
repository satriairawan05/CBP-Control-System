<form action="{{ $formAction }}" id="form" method="post" onsubmit="btnsubmit.disabled=true; return true;"
    enctype="multipart/form-data">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-12">
                <label for="title">Title <span class="text-danger">*</span> </label>
                <input type="text"
                    class="form-control @error('title')
                                    is-invalid
                                @enderror"
                    id="title" placeholder="Masukan Project Title" value="{{ old('title', $project->title ?? '') }}"
                    name="title">
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
                <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" id="summary" rows="10"
                    cols="100">{{ old('summary', $project->summary ?? '') }}</textarea>
                @error('summary')
                    <div class="invalid-feedback">
                        {{ $errors->get('summary')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="description">Description <span class="text-danger">*</span> </label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                    rows="10" cols="100">{{ old('description', $project->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $errors->get('description')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="deadline">Deadline <span class="text-danger">*</span> </label>
                <div class="input-group">
                    <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                        id="deadline" placeholder="Masukan Deadline"
                        value="{{ old('deadline', $project->deadline ?? '') }}" name="deadline">
                    <span class="input-group-text">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    @error('deadline')
                        <div class="invalid-feedback">
                            {{ $errors->get('deadline')[0] }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="size">Size <span class="text-danger">*</span> </label>
                <select id="size" class="form-control @error('size') is-invalid @enderror"
                    name="size">
                    @php
                        $size = [['size' => 'Small'], ['size' => 'Medium'], ['size' => 'Large']];
                    @endphp
                    <option value="" selected>Without Size</option>
                    @foreach ($size as $s)
                        @if (old('size', $project->size ?? '') == $s['size'])
                            <option value="{{ $s['size'] }}" selected>{{ $s['size'] }}
                            </option>
                        @else
                            <option value="{{ $s['size'] }}">{{ $s['size'] }}</option>
                        @endif
                    @endforeach
                </select>
                @error('size')
                    <div class="invalid-feedback">
                        {{ $errors->get('size')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="type">Type <span class="text-danger">*</span> </label>
                <select id="type" class="form-control @error('type') is-invalid @enderror"
                    name="type">
                    @php
                        $type = [['name' => 'Project Base Learning'],['name' => 'Magang'], ['name' => 'Skripsi']];
                    @endphp
                    <option value="" selected>Without Type</option>
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
        <div class="row mb-3">
            <div class="col-4">
                <label for="flowchart">Flowchart</label><br>
                <img id="flowchartPreview" class="d-none" alt="Flowchart Preview"
                    style="max-width: 100%; max-height: 150px;">
                <p id="flowchartFileName" class="d-none"></p>
                <input type="file" id="flowchart"
                    class="form-control @error('flowchart') is-invalid @enderror" name="flowchart"
                    accept=".zip, .rar">
                @error('flowchart')
                    <div class="invalid-feedback">
                        {{ $errors->get('flowchart')[0] }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Diagram -->
            <div class="col-4">
                <label for="diagram">Diagram</label><br>
                <input type="file" id="diagram"
                    class="form-control @error('diagram') is-invalid @enderror" name="diagram"
                    accept=".zip, .rar">
                @error('diagram')
                    <div class="invalid-feedback">
                        {{ $errors->get('diagram')[0] }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Mockup -->
            <div class="col-4">
                <label for="mockup">Mockup</label><br>
                <input type="file" id="mockup" name="mockup"
                    class="form-control @error('mockup') is-invalid @enderror" accept=".zip, .rar">
                @error('mockup')
                    <div class="invalid-feedback">
                        {{ $errors->get('mockup')[0] }}
                    </div>
                @enderror
                <!-- Menampilkan nama file yang dipilih -->
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="status">Status <span class="text-danger">*</span> </label>
                <select id="status" class="form-control @error('status') is-invalid @enderror"
                    name="status">
                    @php
                        $status = [['status' => 'Submit']];
                    @endphp
                    <option value="" selected>Without Status</option>
                    @foreach ($status as $s)
                        @if (old('status', $project->status ?? '') == $s['status'])
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            CKEDITOR.replace('summary');
            CKEDITOR.replace('description');
            flatpickr("#deadline", {
                dateFormat: "Y-m-d",
            });
            $('#type').select2();
            $('#size').select2();
            $('#status').select2();
        });
    </script>
@endpush
