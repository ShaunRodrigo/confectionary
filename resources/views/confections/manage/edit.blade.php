

@include('confections.manage.partials.form', [
    'title' => 'Edit Confection',
    'action' => route('confections_manage.update', $confection),
    'method' => 'PUT',
    'confection' => $confection
])

