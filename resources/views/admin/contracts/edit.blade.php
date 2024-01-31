@extends('admin.layouts.app')

@section('breadcrumb')
    <header class="page-header">
        <h2>{{ $name . 's' }}</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ route('home') }}">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><a href="{{ route('contract.index') }}" class="text-decoration-none">{{ $name . 's' }}</a></li>
                <li><span>Edit</span></li>
            </ol>
            <div class="sidebar-right-toggle">
            </div>
        </div>
    </header>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.contracts._form',[
                        'submitButton' => 'Submit',
                        'cancelRoute' => route('contract.index'),
                        'formAction' => route('project.update',$contract->id),
                        'formMethod' => 'PUT',
                        'project' => $project,
                        'first' => $first,
                        'second' => $second,
                        'contractDetail' => $contract->contractDetails()->get()
                    ]);
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        const contractDetailCount = 3;
        const existingRows = $('#contract-details tbody tr').length;

        $(document).ready(function(){
            for (let i = existingRows; i < contractDetailCount; i++) {
                const newRow = $('#contract-details tbody tr:first').clone();
                newRow.find('td:eq(2)').empty();
                newRow.find('input[name="pasal"]').val({{ $contractDetail->pasal ?? '' }});
                newRow.find('input[name="title"]').val({{ $contractDetail->title ?? '' }});
                newRow.find('textarea[name="description"]').val({{ $contract->description ?? '' }});
                $('#contract-details tbody').append(newRow);
            }
        });
    </script>
@endpush
