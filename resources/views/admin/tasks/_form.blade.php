<form action="{{ $formAction }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if(isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-6">
                <label for="task_name">Name <span class="text-danger">*</span> </label>
                <input type="text"
                    class="form-control form-control-sm @error('task_name')
                                    is-invalid
                                @enderror"
                    id="task_name" placeholder="Masukan Task Name" value="{{ old('task_name', $task->task_name ?? '') }}" name="task_name"
                    required>
                @error('task_name')
                    <div class="invalid-feedback">
                        {{ $errors->get('task_name')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
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
