<form action="{{ $formAction }}" id="form" method="post" onsubmit="btnsubmit.disabled=true; return true;">
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
                    id="name" placeholder="Masukan Task Name" value="{{ old('name', $task->name ?? '') }}"
                    name="name" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $errors->get('name')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="amount">Amount <span class="text-danger">*</span> </label>
                <span class="input-grou-text">
                    <input type="text" class="form-control form-control-sm @error('amount') is-invalid @enderror" id="amount" placeholder="Masukan Amount" value="{{ old('amount', $task->amount ?? '') }}"
                        name="amount" required>
                </span>
                @error('amount')
                    <div class="invalid-feedback">
                        {{ $errors->get('amount')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="summary">Summary <span class="text-danger">*</span> </label>
                <textarea name="summary" id="summary" rows="10" cols="100" required>{{ old('summary', $task->summary ?? '') }}</textarea>
                @error('summary')
                    <div class="invalid-feedback">
                        {{ $errors->get('summary')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="description">Description <span class="text-danger">*</span> </label>
                <textarea name="description" id="description" rows="10" cols="100" required>{{ old('description', $task->description ?? '') }}</textarea>
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
                <select id="project" class="form-control form-control-sm" name="project_id">
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
            $("#amount").on("keyup", function() {
                $("#amount").val(formatAngka(this.value));
            });

            $('#form').on('submit', function() {
                $("#amount").val(unformatAngka($("#amount").val()));
            });

            CKEDITOR.replace('summary');
            CKEDITOR.replace('description');
        });
    </script>
@endpush
